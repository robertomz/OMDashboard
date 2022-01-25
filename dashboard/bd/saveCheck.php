<?php
    include ("addCart.php");

    include 'conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    
    if (isset($_POST['buy'])) {
        date_default_timezone_set("America/Tegucigalpa");
        $date = date('Y-m-d H:i:s');

        $identidad = $_POST['identidad'];
        $name = $_POST['name'];
        $rtn = $_POST['rtn'];
        $sucursal = $_POST['sucursal'];
        $buyName = $_POST['buyName'];
        $nota = $_POST['nota'];

        $subtotal = $_POST['hidden_subtotal'];
        $isv = $_POST['hidden_isv'];
        $totalC = $_POST['hidden_total'];

        $query = "INSERT INTO compras (NoFactura, Sucursal, Fecha, Comprador, NombreFactura, RTN, Identidad, Nota, Subtotal, ISV, Total, IdEstado) VALUES (NULL,'$sucursal','$date','$name','$buyName','$rtn','$identidad','$nota','$subtotal','$isv','$totalC', 1)";        
        
        $result = $conexion->prepare($query);
        $result->execute();

        $query2 = "SELECT NoFactura FROM compras ORDER BY NoFactura DESC LIMIT 1";

        $result2 = $conexion->prepare($query2);
        $result2->execute();
        $data2 = $result2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data2 as $dat) {
            $NoFactura = $dat['NoFactura'];
        }
        $total = 0;
        
        foreach($_SESSION["shopping_cart"] as $keys => $values) {
            $idP = $values["item_id"];
            $categoria = $values["item_category"];
            $producto = $values["item_name"];
            $precio = $values["item_price"];
            $cant = $values["item_quantity"];
            $total = ($values["item_quantity"] * $values["item_price"]);

            $query3 = "INSERT INTO detallescompra(Id, NoFactura, IdProducto, Categoria, Producto, Precio, Cantidad, Total) VALUES (NULL,'$NoFactura','$idP','$categoria','$producto','$precio','$cant','$total')";

           /*  $query4 = "UPDATE productos SET Inventario = (Inventario - $cant) WHERE Id = '$idP'";
 */
            $result3 = $conexion->prepare($query3);
            $result3->execute();
        }
        
        
        if ($result && $result2 && $result3) {
            echo '<script type="text/javascript">';
            echo 'swal("", "Compra Realizada!", "success");';
            echo '</script>';            
?>
           <script>
                window.location = "index.php";
            </script>
<?php
        }
        else {
            echo '<script type="text/javascript">';
            echo 'swal("", "Compra NO Realizada!", "error");';
            echo '</script>';
        }
    }
?>