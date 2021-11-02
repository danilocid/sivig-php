<?php
include 'Model/dbConection.php';
include 'Controller/ArticulosController.php';
$arrayarticulos = array();
class Articulo{
    public $cod_interno;
    public $cod_barras;
    public $descripcion;
    public $costo_neto;
    public $costo_imp;
    public $venta_neto;
    public $venta_imp;
    public $stock;
    public $activo;

}

$articulos = new Articulo();
$articulos->id = $_POST['id'];
$articulos->cod_interno = $_POST['cod_interno'];
$articulos->cod_barras = $_POST['cod_barras'];
$articulos->descripcion = $_POST['descripcion'];
$articulos->venta_neto = $_POST['venta_neto'];
$articulos->venta_imp = $_POST['venta_imp'];
$articulos->activo = $_POST['activo'];


array_push($arrayarticulos, $articulos);
$articulo = new Articulos();
$articulo->EditarArticulo($arrayarticulos);

?>
