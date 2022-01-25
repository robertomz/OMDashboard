<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$sucursal = (isset($_POST['sucursal'])) ? $_POST['sucursal'] : '';
$ubicacion = (isset($_POST['ubicacion'])) ? $_POST['ubicacion'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$store_id = (isset($_POST['store_id'])) ? $_POST['store_id'] : '';


switch($opcion){
    case 1:
        $query = "INSERT INTO sucursales (IdSucursal, Sucursal, Ubicacion) VALUES(null, '$sucursal', '$ubicacion')";		
        $result = $conexion->prepare($query);
        $result->execute();
        
        $query = "SELECT * FROM sucursales ORDER BY U.id DESC LIMIT 1";
        $result = $conexion->prepare($query);
        $result->execute();
        $data=$result->fetchAll(PDO::FETCH_ASSOC);  
        break;    
    case 2:      
        $query = "UPDATE sucursales SET Sucursal='$sucursal', Ubicacion='$ubicacion' WHERE IdSucursal = '$store_id'";		
        $result = $conexion->prepare($query);
        $result->execute();

        $query = "SELECT * FROM sucursales";
        $result = $conexion->prepare($query);
        $result->execute();
        $data=$result->fetchAll(PDO::FETCH_ASSOC);  
        break;
    case 3:
        $query = "DELETE FROM sucursales WHERE IdSucursal = '$store_id' ";		
        $result = $conexion->prepare($query);
        $result->execute();

        $query = "SELECT * FROM sucursales";
        $result = $conexion->prepare($query);
        $result->execute();
        $data=$result->fetchAll(PDO::FETCH_ASSOC);  
        break;
    case 4:    
        $query = "SELECT * FROM sucursales";
        $result = $conexion->prepare($query);
        $result->execute();        
        $data=$result->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion=null;