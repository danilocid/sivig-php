<?php
include 'Model/dbConection.php';

include 'Controller/PermisosController.php';



//print_r($_POST);

$id = $_POST["IdUsuario"];
$permiso = new Permiso();
$permiso->ModificaPermisos($id, $_POST);