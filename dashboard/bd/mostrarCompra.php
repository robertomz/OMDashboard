<?php
    if (isset($_POST['Upload'])) {
        $target = "img/facturas/".basename($_FILES['image']['name']);
        $image = $_FILES['image']['name'];

        if ($image == "" || empty($_POST['vNoFactura']) ) {
            echo "<script> alert('Llene todos los campos o cargue la factura!')</script>";
        } else {
            date_default_timezone_set("America/Tegucigalpa");
            $datee =  date('Y-m-d H:i:s');

            $numberF = $_POST['vNoFactura'];
            $image = $_FILES['image']['name'];

            $query5 = "INSERT INTO comprobante (Id, NoFactura, Fecha, Comprobante) VALUES (NULL,'$numberF','$datee','$image')";

            $result5 = $conexion->prepare($query5);
            $result5->execute();
            
            $query6 = "UPDATE compras SET IdEstado = '4' WHERE compras.NoFactura = '$numberF'";
            $result6 = $conexion->prepare($query6);
            $result6->execute();

            if ($result5 && $result6 && move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                echo '<script type="text/javascript">';
                echo 'swal("", "Factura Cargada!", "success");';
                echo '</script>';
            }
            else {
                echo '<script type="text/javascript">';
                echo 'swal("", "Factura NO Cargada!", "error");';
                echo '</script>';
            }
        }        
    }
?>

<?php
    if (isset($_POST['ChangeStatus'])) {
        $factura = $_POST['aNoFactura'];
        $estado = $_POST['estado'];

        $query4 = "UPDATE compras SET IdEstado = '$estado' WHERE NoFactura = '$factura'";
        $result4 = $conexion->prepare($query4);
        $result4->execute();

        if ($estado == 2) {
            include_once 'AdminMail.php';
        }
    }
    if (isset($_POST['Details'])) {
        $No = $_POST['NoFactura'];
        $status = $_POST['estado'];

        $query2 = "SELECT * FROM detallescompra WHERE NoFactura = '$No'";
        $result2 = $conexion->prepare($query2);
        $result2->execute();
                        
        $data2 = $result2->fetchAll(PDO::FETCH_ASSOC);

        $query7 = "SELECT * FROM comprobante WHERE NoFactura = '$No'";
        $result7 = $conexion->prepare($query7);
        $result7->execute();

        $data7 = $result7->fetchAll(PDO::FETCH_ASSOC);
?>

<br>
<hr>
<br>
    <h3> Detalles de Compra #<?php echo $No; ?> </h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed" style="width:100%">
            <thead>
                <tr>
                    <th> Categoria </th>
                    <th> Producto </th>
                    <th> Cantidad </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($data2 as $dat2) { 
                ?>
                <tr>
                    <td><?php echo $dat2['Categoria']; ?></td>
                    <td><?php echo $dat2['Producto']; ?></td>
                    <td><?php echo $dat2['Cantidad']; ?></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

<?php
        if (($status == 'Pendiente') && ($_SESSION['tipo'] == 1)) {
            include 'vistas/status.php';
        }
        else if (($status == 'Aprobada') && ($_SESSION['tipo'] == 2)) {
?>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-4">
                <input type="hidden"id="vNoFactura" name="vNoFactura" value="<?php echo $No; ?>">
                    <label> Cargar Factura </label>
                        <input type="file" id="real-file" name="image"/>
                        <br><br>
                        <button type="submit" id="submiteUpload" name="Upload" class="btn btn-danger"> Cargar Pago </button>
                    <br>
                </div>
            </div>
        </form>
<?php
        }
        else if (($status == 'Pagada')) {
?>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label> Detalles del Pago </label>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDetallesPago"> Mostrar Pago </button>
                    <br>
                </div>
            </div>
<?php
        }
?>
    <!-- Modal PAGO -->
    <div class="modal fade" id="modalDetallesPago" tabindex="-1" aria-labelledby="modalDetallesPagoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetallesPagoLabel"> Detalles del Pago </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="card">
                <?php 
                    foreach ($data7 as $dat7) {
                ?>
                    <img src="img/facturas/<?php echo $dat7['Comprobante']; ?>" class="">
                    <div class="card-body">
                        <h5 class="card-title"> Factura #<?php echo $No; ?> </h5> 
                        <p class="card-text"> Fecha de Pago: <?php echo $dat7['Fecha']; ?></p>
                    </div>
                </div>
                <?php 
                    }
                ?>
            </div>
            </div>
        </div>
    </div>
<?php
    }
?>


<script type="text/javascript">
    const realFileBtn = document.getElementById("real-file");
    const customBtn = document.getElementById("custom-button");
    const customTxt = document.getElementById("custom-text");
    const submitUploadBtn = document.getElementById("submitUpload");

    customBtn.addEventListener("click", function() {
        realFileBtn.click();
        submitUploadBtn.click();
    });

    realFileBtn.addEventListener("change", function() {
        if (realFileBtn.value) {
            customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1]; 
        } else {
            customTxt.innerHTML = "Comprobando no cargado aún.";
        }
    });
</script>