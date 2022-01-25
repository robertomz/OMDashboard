<?php
session_start();

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';

$pass = md5($password);

$consulta = "SELECT * FROM usuarios u INNER JOIN login l ON u.Identidad =l.identidad INNER JOIN sucursales s ON u.IdSucursal = s.IdSucursal WHERE l.usuario='$usuario' AND l.password='$pass'";

$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($data as $dat) {
        $identidad = $dat['Identidad'];
        $nombres = $dat['Nombres'];
        $apellidos = $dat['Apellidos'];
        $correo = $dat['Correo'];
        $direccion = $dat['Direccion'];
        $telefono = $dat['Telefono'];
        $tipo = $dat['IdRol'];
        $idsucursal = $dat['IdSucursal'];
        $sucursal = $dat['Sucursal'];
        $ubicacion = $dat['Ubicacion'];
    }

    $_SESSION['identidad'] = $identidad;
    $_SESSION['nombre'] = $nombres;
    $_SESSION['apellido'] = $apellidos;
    $_SESSION['correo'] = $correo;
    $_SESSION['direccion'] = $direccion;
    $_SESSION['telefono'] = $telefono;
    $_SESSION["s_usuario"] = $usuario;
    $_SESSION["password"] = $password;
    $_SESSION["idsucursal"] = $idsucursal;
    $_SESSION['sucursal'] = $sucursal;
    $_SESSION['ubicacion'] = $ubicacion;
    $_SESSION['tipo'] = $tipo;
}
else {
    $_SESSION["s_usuario"] = null;
    $data = null;
}

print json_encode($data);
$conexion=null;