<?php

$titulo = 'Agregar ajuste';
$idpagina = 1;
include 'includes/partials/header.php';
Class ArticuloAjuste{
    public $id;
    public $cantidad;  
}
include 'includes/partials/menu.php';
include 'Controller/ArticulosController.php';
include 'Controller/AjustesDeInventarioController.php';
$articulo = new Articulos();
$ajustes = new AjustesDeInventario();
$ajustes->AgregarAjuste($_POST['monto_neto'],$_POST['monto_imp'], $_POST['tipo_movimiento'], $_POST['observaciones'], 
$_POST['total_articulos']);
?>