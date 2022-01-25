<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$identidad = (isset($_POST['identidad'])) ? $_POST['identidad'] : '';
$nombres = (isset($_POST['nombres'])) ? $_POST['nombres'] : '';
$apellidos = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';

$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
    case 1:
        $query = "UPDATE usuarios SET Nombres='$nombres', Apellidos='$apellidos', Direccion='$direccion', Correo='$correo', Telefono='$telefono' WHERE Identidad='$identidad'";			
        $result = $conexion->prepare($query);
        $result->execute();

        $query1 = "UPDATE login SET usuario='$usuario', password=MD5('$password') WHERE Identidad='$identidad'";			
        $result1 = $conexion->prepare($query1);
        $result1->execute();    
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion=null;