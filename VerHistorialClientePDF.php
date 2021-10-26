
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
include 'Controller/ComunasController.php';
include 'Controller/ProvinciasController.php';
include 'Controller/RegionesController.php';
$rut = "";
if (isset($_GET['rut'])) {
    $rut = $_GET['rut'];
    //echo 'get';
}
if (isset($_POST['rut'])) {
   $rut = $_POST['rut'];
   //echo 'post';
}
$cliente = new Cliente();
$datoscliente  = $cliente->GetClientesPorRUT($rut);
$ventas = new Ventas();
$ventascliente = $ventas->GetVentasPorRut($rut);
$mediodepago = new MediosDePago();
$tipodocumento = new TiposDocumentos();
$usuarios = new Usuario();

$comunas = new Comunas();
//$comuna = $comunas->GetComunaPorId($datoscliente['comuna']);
$provincias = new Provincias();
//$provincia = $provincias->GetProvinciaPorId($datoscliente[0]['provincia']);
$regiones = new Regiones();
//$region  = $regiones->GetRegionPorId($datoscliente[0]['region']);
$articulos = new Articulos();
//print_r($ventascliente);
$total_ventas_neto = 0;
$total_ventas_imp = 0;
require('PDF/HistorialPDF.php');
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
//$pdf->AddDocumento( $tipos->GetTiposDocumentosPorId($venta[0]['tipo_documento']), $venta[0]['documento'] );
//Se agregan los dato del cliente
$nombrecliente = "";

foreach ($datoscliente as $c){
    $nombrecliente = $c['nombre'];
    
$pdf->AddCliente($nombrecliente, $c['rut'], $c['giro'], $c['direccion']);
}
//print_r($datoscliente);
$pdf->AddCliente($nombrecliente, $datoscliente[0]['rut'], $c['giro'], $c['direccion']);
//se agrega el medio de pago
//$pdf->AddMedioDePago($mediodepago);
//Se agrega la fecha de venta
//$pdf->addFechaVenta($venta[0]['fecha']);
//se agrega el usuario que realiza la venta
//$pdf->addUsuarioVenta($usuario[0]['Nombre'].' '.$usuario[0]['Apellidos']);
//Se agregan las columnas y su alineacion
$cols=array( "FECHA"    => 25,
            "USUARIO"    => 25,
             "DOCUMENTO"  => 50,
             "NUMERO"     => 19,
             "MEDIO DE PAGO"      => 32,
             "NETO" => 15,
             "IVA" => 15,
             "TOTAL" => 15 );
$pdf->addCols( $cols);
$cols=array( "FECHA"    => "L",
            "USUARIO"    => "L",
             "DOCUMENTO"  => "L",
             "NUMERO"     => "C",
             "MEDIO DE PAGO"      => "R",
             "NETO" => "R",
             "IVA" => "R",
             "TOTAL"          => "C" );
//$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
//posicion donde comienza el detalle
$y    = 80;
//se agregan los datos a la tabla
foreach ($ventascliente as $d) {
    $usuario = $usuarios->GetUsuarioPorId($d['usuario']);
    
    $nombreusuario = $usuario[0]['Nombre']." ". $usuario[0]['Apellidos'];
               $line = array( "FECHA"    => $d['fecha'],
               "USUARIO"  => $nombreusuario,
               "DOCUMENTO"  => $tipodocumento->GetTiposDocumentosPorId($d['tipo_documento']),
               "NUMERO"     =>  $d['documento'],
               "MEDIO DE PAGO"      =>$mediodepago->GetMediosDePagoPorId($d['medio_pago']),
               "NETO" => '$'.number_format($d['monto_neto'], 0, ',', '.'),
               "IVA" => '$'.number_format($d['monto_imp'], 0, ',', '.'),
               "TOTAL"          => "$".number_format(($d['monto_neto'] + $d['monto_imp']), 0, ',', '.') );
               
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;
$total_ventas_neto = $total_ventas_neto + $d['monto_neto'];
$total_ventas_imp = $total_ventas_imp + $d['monto_imp'];
}





$pdf->addImpuestos('$'.number_format($total_ventas_neto, 0, ',', '.'), 
'$'.number_format(($total_ventas_imp), 0, ',', '.'), 
'$'.number_format(($total_ventas_imp + $total_ventas_neto), 0, ',', '.'));
$pdf->Output("I", "detalle_venta.pdf", true);
?>