<?php
Class AgregarRecepcion{
       
    public $proveedor;
    public $tipo_documento;
    public $documento;
    public $observaciones;
    public $unidades_total;
    public $monto_neto;
    public $monto_imp;
    
    
}
Class ArticuloRecepcion{
    public $id;
    public $costo_neto;
    public $costo_imp;
    public $cantidad;
   
  }
$datos = new AgregarRecepcion();

$datos->proveedor = $_POST['proveedor'];
$datos->tipo_documento = $_POST['tipo_documento'];
$datos->documento = $_POST['numero_documento'];
$datos->monto_neto = $_POST['monto_neto'];
$datos->monto_imp = $_POST['monto_imp'];
$datos->unidades_total = $_POST['total_articulos'];
$datos->observaciones = $_POST['observaciones'];
$titulo = 'Agregar recepcion';
$idpagina = 8;
include 'Includes/partials/header.php';
include 'Model/dbConection.php';
include 'Controller/RecepcionesController.php';
print_r($datos);
print_r($_SESSION['articulo']);
$recepcion = new Recepciones();
$recepcion->AgregarRecepcion($datos);

?>