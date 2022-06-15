<?php
include 'Model/dbConection.php';
class Permisos2{
    public $IdPagina;
    public $Permiso;
    public $IdPermiso;
}
include 'Controller/PermisosController.php';


$arraypermisos = array();
for ($i=1; $i <= $_POST['contador'] ; $i++) { 
    $p = new Permisos2;
    $p->IdPagina = $i;
    $p->Permiso = $_POST[$i];
   // $p->IdPermiso = $_POST["permiso".$i];
    array_push($arraypermisos, $p);
}
//print_r($arraypermisos);
$id = $_POST["IdUsuario"];
$permiso = new Permiso();
$permiso->ModificaPermisos($id, $arraypermisos);