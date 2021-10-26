<?php
include 'Model/dbConection.php';
include 'Controller/UsuariosController.php';
if ($_POST["activo"]=='Activo') {
    $Activo = 1;
} else {
    $Activo = 0;
}

$User = $_POST["user"];
$Password = $_POST["password"];
$Nombre = $_POST["Nombre"];
$Apellidos = $_POST["apellidos"];



$usuario = new Usuario();


$usuario->AgregarUsuario( $User, $Password, $Nombre, $Apellidos, $Activo);

?>