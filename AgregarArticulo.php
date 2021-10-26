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

$articulos->cod_interno = $_POST['cod_interno'];
$articulos->cod_barras = $_POST['cod_barras'];
$articulos->descripcion = $_POST['descripcion'];
$articulos->costo_neto = $_POST['c_costo_neto'];
$articulos->costo_imp = $_POST['c_costo_imp'];
$articulos->venta_neto = $_POST['c_venta_neto'];
$articulos->venta_imp = $_POST['c_venta_imp'];
$articulos->stock = $_POST['stock'];
$articulos->activo = $_POST['activo'];

//print_r($_POST);
array_push($arrayarticulos, $articulos);
$articulo = new Articulos();
$articulo->AgregarArticulos($arrayarticulos, $_POST['enlace']);

?>
