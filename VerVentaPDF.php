
<?php
// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF
include 'Model/dbConection.php';
include 'Controller/TipoDocumentoController.php';
include 'Controller/UsuariosController.php';
include 'Controller/VentasController.php';
include 'Controller/ArticulosController.php';
include 'Controller/ClientesController.php';
include 'Controller/DetalleVentasController.php';
include 'Controller/MediosDePagoController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_POST['id'])) {
   $id = $_POST['id'];
}
$tipos = new TiposDocumentos();
$articulos = new Articulos();
$ventas  = new Ventas();
$usuarios = new Usuario;
$clientes = new Cliente();
$detallesventas =  new DetallesVentas();
$venta = $ventas->GetVentasPorId($id);
$detalleventa = $detallesventas->GetDetalleVentaPorId($id);
//$venta = $ventas->GetVentasPorId(7);

$cliente = $clientes->GetClientesPorRUT($venta[0]['cliente']);


//$detalleventa = $detallesventas->GetDetalleVentaPorId(7);

$mediosdepago = new MediosDePago();
$mediodepago = $mediosdepago->GetMediosDePagoPorId($venta[0]['medio_pago']);
$usuario = $usuarios->GetUsuarioPorId($venta[0]['usuario']);

require('PDF/DetallePDF.php');
//se llama el constructor
$pdf = new PDF_Invoice( 'P', 'mm', 'Letter' );
//Se agrega una pagina
$pdf->AddPage();
//se agregan los datos de la empresa
$pdf->AddEmpresa( "Llamativo.cl",
                  "Cid y Badilla Limitada\n" .
                  "76.341.652-6\n".
                  "Avenida Cayumanqui 685, local 6\n" .
                  "Quillon");
//Se agrega el tipo y numero de documento
$pdf->AddDocumento( $tipos->GetTiposDocumentosPorId($venta[0]['tipo_documento']), $venta[0]['documento'] );
//Se agregan los dato del cliente
$nombrecliente = "";
$datoscliente = "";
foreach ($cliente as $c){
    $nombrecliente = $c['nombre'];
    

$pdf->AddCliente($nombrecliente, $c['rut'], $c['giro'], $c['direccion']);
}
//se agrega el medio de pago
$pdf->AddMedioDePago($mediodepago);
//Se agrega la fecha de venta
$pdf->addFechaVenta($venta[0]['fecha']);
//se agrega el usuario que realiza la venta
$pdf->addUsuarioVenta($usuario[0]['Nombre'].' '.$usuario[0]['Apellidos']);
//Se agregan las columnas y su alineacion
$cols=array( "CODIGO"    => 21,
             "DESCRIPCION"  => 78,
             "CANTIDAD"     => 19,
             "PRECIO UNITARIO"      => 34,
             "NETO" => 15,
             "IVA" => 15,
             "TOTAL"          => 15 );
$pdf->addCols( $cols);
$cols=array( "CODIGO"    => "L",
             "DESCRIPCION"  => "L",
             "CANTIDAD"     => "C",
             "PRECIO UNITARIO"      => "R",
             "NETO" => "R",
             "IVA" => "R",
             "TOTAL"          => "C" );
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
//posicion donde comienza el detalle
$y    = 80;
//se agregan los datos a la tabla
foreach ($detalleventa as $d) {
    $line = array( "CODIGO"    => $d['articulo'],
               "DESCRIPCION"  => $articulos->GetDescripcionArticuloPorId($d['articulo']),
               "CANTIDAD"     => $d['cantidad'],
               "PRECIO UNITARIO"      => '$'.number_format($d['precio_neto'], 0, ',', '.'),
               "NETO" => '$'.number_format($d['precio_neto'], 0, ',', '.'),
               "IVA" => '$'.number_format($d['precio_imp'], 0, ',', '.'),
               "TOTAL"          => "$".number_format(($d['precio_neto'] + $d['precio_imp']) * $d['cantidad'], 0, ',', '.') );
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;
}





$pdf->addImpuestos('$'.number_format($venta[0]['monto_neto'], 0, ',', '.'), 
'$'.number_format($venta[0]['monto_imp'], 0, ',', '.'), 
'$'.number_format($venta[0]['monto_imp'] + $venta[0]['monto_neto'], 0, ',', '.'));
$pdf->Output("I", "detalle_venta.pdf", true);
?>