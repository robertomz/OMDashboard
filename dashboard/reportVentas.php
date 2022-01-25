<?php require_once "vistas/parte_superior.php"?>

<?php
    include_once './bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $query = "SELECT * FROM compras c INNER JOIN estadocompra ec ON c.IdEstado = ec.IdEstado WHERE c.IdEstado = '4'";
    $result = $conexion->prepare($query);
    $result->execute();

    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    $query3 = "SELECT * FROM estadocompra";
    $result3 = $conexion->prepare($query3);
    $result3->execute();

    $data3= $result3->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1> <i class='fa fa-file-pdf'></i> Reporte de Ventas </h1>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tableComprasPDF" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead>
                            <tr>
                                <th> Estado </th>
                                <th> Fecha/Hora </th>
                                <th> No Factura </th>
                                <th> Pedido por </th>
                                <th> Subtotal </th>
                                <th> ISV </th>
                                <th> Total </th>
                                <th> Acciones </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach ($data as $dat) {
                        ?>
                            <tr>
                                <td><?php echo $dat['Estado']; ?></td>
                                <td><?php echo $dat['Fecha']; ?></td>
                                <td><?php echo $dat['NoFactura']; ?></td>
                                <td><?php echo $dat['Comprador']; ?></td>
                                <td><?php echo $dat['Subtotal']; ?></td>
                                <td><?php echo $dat['ISV']; ?></td>
                                <td><?php echo $dat['Total']; ?></td>
                                <td> 
                                    <div class='text-center'>
                                        <div class='btn-group'>                                            
                                            <form method="POST">                                            
                                                <input type="hidden"id="NoFactura" name="NoFactura" value="<?php echo $dat['NoFactura']; ?>">
                                                
                                                <input type="hidden"id="estado" name="estado" value="<?php echo $dat['Estado']; ?>">
                                                
                                                <button class='btn btn-danger' name="Details" data-bs-toggle="modal" data-bs-target="#modalDetalles<?php echo $dat['NoFactura']; ?>" onclick="TableRowClickCompras(therow)"> Detalles </button>
                                            </form>

                                            <form method="GET" action="reportXdetalle.php">                                
                                                <input type="hidden"id="NoFacturaPDF" name="NoFacturaPDF" value="<?php echo $dat['NoFactura']; ?>">
                                                
                                                <button class='btn btn-danger' name="PDF" onclick="TableRowClickCompras(therow)"> PDF </button>
                                            </form>                                  
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php include './bd/mostrarCompra.php'; ?>
                </div>
            <a href="reporteXventas.php" target="blank"> <button class='btn btn-danger'> Reporte de Todas las Compras </button> </a>
            </div>
        </div>
    </div>
</div>

<script>
    $('#tableComprasPDF').DataTable();
</script>

<?php require_once "vistas/parte_inferior.php"?>