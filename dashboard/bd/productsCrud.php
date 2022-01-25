<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$producto = (isset($_POST['producto'])) ? $_POST['producto'] : '';
$precio = (isset($_POST['precio'])) ? $_POST['precio'] : '';
$categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$ice_id = (isset($_POST['ice_id'])) ? $_POST['ice_id'] : '';


switch($opcion){
    case 1:
        $query = "INSERT INTO productos (Producto, Precio, IdCategoria) VALUES('$producto', '$precio', '$categoria')";
        $result = $conexion->prepare($query);
        $result->execute();
        
        $query = "SELECT * FROM productos P INNER JOIN categorias C ON P.IdCategoria = C.IdCategoria ORDER BY P.Id DESC LIMIT 1";
        $result = $conexion->prepare($query);
        $result->execute();
        $data=$result->fetchAll(PDO::FETCH_ASSOC);  
        break;    
    case 2:      
        $query = "UPDATE productos SET Producto='$producto', Precio='$precio' WHERE Id = '$ice_id'";		
        $result = $conexion->prepare($query);
        $result->execute();

        $query = "SELECT * FROM productos P INNER JOIN categorias C ON P.IdCategoria = C.IdCategoria";
        $result = $conexion->prepare($query);
        $result->execute();
        $data=$result->fetchAll(PDO::FETCH_ASSOC);  
        break;
    case 3:
        $query = "DELETE FROM productos WHERE Id = '$ice_id' ";		
        $result = $conexion->prepare($query);
        $result->execute();

        $query = "SELECT * FROM productos P INNER JOIN categorias C ON P.IdCategoria = C.IdCategoria";
        $result = $conexion->prepare($query);
        $result->execute();
        $data=$result->fetchAll(PDO::FETCH_ASSOC);  
        break;
    case 4:    
        $query = "SELECT * FROM productos P INNER JOIN categorias C ON P.IdCategoria = C.IdCategoria";
        $result = $conexion->prepare($query);
        $result->execute();        
        $data=$result->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion=null;