<?php
Class ArticuloVenta{
  public $id;
  public $precio_venta;
  public $cantidad;
  public $total;
 
}

$titulo = 'Agregar venta';
$idpagina = 1;
include 'includes/partials/header.php';
include 'includes/partials/menu.php';
include 'Controller/TipoDocumentoController.php';
include 'Controller/ArticulosController.php';
include 'Controller/ClientesController.php';
include 'Controller/ComunasController.php';
include 'Controller/RegionesController.php';
include 'Controller/VentasController.php';



$tipos = new TiposDocumentos();
$articulos = new Articulos();
$clientes = new Cliente();
$venta = new Ventas();
$monto_total = 0;
$total_articulos = 0;

if ($venta->VerificaVentaExiste($_POST['tipo_documento'], $_POST['numero_documento'])) {
  echo '<script type="text/javascript">
                window.location="AgregarVenta?m=3";
              </script>';

}else{
$monto_neto = $_POST['monto_total'] / 1.19;
$monto_imp = $_POST['monto_total'] - ($_POST['monto_total'] / 1.19);
$venta->AgregarVenta($monto_neto, $monto_imp, $_POST['tipo_documento'], $_POST['numero_documento'], 
$_POST['cliente'], $_POST['mediopago']);
}



?>
