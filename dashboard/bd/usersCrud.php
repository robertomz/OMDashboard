<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$identidad = (isset($_POST['identidad'])) ? $_POST['identidad'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$apellido = (isset($_POST['apellido'])) ? $_POST['apellido'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$sucursal = (isset($_POST['sucursal'])) ? $_POST['sucursal'] : '';
$rol = (isset($_POST['rol'])) ? $_POST['rol'] : '';
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';


switch($opcion){
    case 1:
        $query = "INSERT INTO usuarios (id, Identidad, Nombres, Apellidos, Direccion, Correo, Telefono, IdSucursal, IdRol) VALUES(null, '$identidad', '$nombre', '$apellido', '$direccion', '$correo', '$telefono', '$sucursal', '$rol')";			
        $result = $conexion->prepare($query);
        $result->execute();

        $query1 = "INSERT INTO login (Id, Identidad, usuario, password) VALUES(null, '$identidad', '$usuario', MD5('$password'))";			
        $result1 = $conexion->prepare($query1);
        $result1->execute();
        
        $query = "SELECT * FROM usuarios U INNER JOIN sucursales S ON U.IdSucursal = S.IdSucursal INNER JOIN roles R ON U.IdRol = R.IdRol INNER JOIN login L ON U.Identidad = L.Identidad ORDER BY U.id DESC LIMIT 1";
        $result = $conexion->prepare($query);
        $result->execute();
        $data=$result->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:      
        $query = "DELETE FROM usuarios WHERE id ='$user_id' ";		
        $result = $conexion->prepare($query);
        $result->execute();

        $query = "DELETE FROM login WHERE Identidad ='$identidad' ";		
        $result = $conexion->prepare($query);
        $result->execute();

        $query = "SELECT * FROM usuarios U INNER JOIN sucursales S ON U.IdSucursal = S.IdSucursal INNER JOIN roles R ON U.IdRol = R.IdRol INNER JOIN login L ON U.Identidad = L.Identidad ORDER BY U.id DESC LIMIT 1";
        $result = $conexion->prepare($query);
        $result->execute();
        $data=$result->fetchAll(PDO::FETCH_ASSOC);  
        break;
    case 3:    
        $query = "SELECT * FROM usuarios U INNER JOIN sucursales S ON U.IdSucursal = S.IdSucursal INNER JOIN roles R ON U.IdRol = R.IdRol INNER JOIN login L ON U.Identidad = L.Identidad";
        $result = $conexion->prepare($query);
        $result->execute();        
        $data=$result->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion=null;