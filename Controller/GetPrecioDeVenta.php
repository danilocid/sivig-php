<?php
include '../Model/dbConection.php';
include 'ArticulosController.php';

$id = $_POST['id'];

$articulo = new Articulos();
$precio = $articulo->GetPrecioDeVentaArticuloPorId($id);

echo $precio;

?>