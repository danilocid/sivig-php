<?php
include '../Model/dbConection.php';
include 'VentasController.php';

$tipo_documento = $_POST['tipo_documento'];

$venta = new Ventas();
$documento = $venta->GetSiguienteDocumento($tipo_documento);
echo $documento;

?>