
<?php
// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF
include 'Model/dbConection.php';
include 'Controller/TipoDocumentoController.php';
include 'Controller/UsuariosController.php';
include 'Controller/ProveedoresController.php';
include 'Controller/RecepcionesController.php';
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
$proveedor = new Proveedores();
$datosproveedor  = $proveedor->GetProveedorPorRut($rut);
$recepciones = new Recepciones();
$datosrecepciones = $recepciones->GetRecepcionesPorRUT($rut);
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

foreach ($datosproveedor as $c){
       
$pdf->AddCliente($c['nombre'], $c['rut'], $c['giro'], $c['direccion']);
}
//print_r($datoscliente);
//$pdf->AddCliente($$c['nombre'], $datoscliente[0]['rut'], $c['giro'], $c['direccion']);
//se agrega el medio de pago
//$pdf->AddMedioDePago($mediodepago);
//Se agrega la fecha de venta
//$pdf->addFechaVenta($venta[0]['fecha']);
//se agrega el usuario que realiza la venta
//$pdf->addUsuarioVenta($usuario[0]['Nombre'].' '.$usuario[0]['Apellidos']);
//Se agregan las columnas y su alineacion
$cols=array( "FECHA"    => 25,
            "USUARIO"    => 25,
             "DOCUMENTO"  => 40,
             "NUMERO"     => 18,
             "OBSERVACIONES"      => 32,
             "NETO" => 20,
             "IVA" => 16,
             "TOTAL" => 20 );
$pdf->addCols( $cols);
$cols=array( "FECHA"    => "L",
            "USUARIO"    => "L",
             "DOCUMENTO"  => "L",
             "NUMERO"     => "C",
             "OBSERVACIONES"      => "L",
             "NETO" => "R",
             "IVA" => "R",
             "TOTAL"          => "C" );
//$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
//posicion donde comienza el detalle
$y    = 80;
//se agregan los datos a la tabla
foreach ($datosrecepciones as $d) {
    $usuario = $usuarios->GetUsuarioPorId($d['usuario']);
    
    $nombreusuario = $usuario[0]['Nombre']." ". $usuario[0]['Apellidos'];
               $line = array( "FECHA"    => $d['fecha'],
               "USUARIO"  => $nombreusuario,
               "DOCUMENTO"  => $tipodocumento->GetTiposDocumentosPorId($d['tipo_documento']),
               "NUMERO"     =>  $d['documento'],
               "OBSERVACIONES"      =>$d['observaciones'],
               "NETO" => '$'.number_format($d['total_neto'], 0, ',', '.'),
               "IVA" => '$'.number_format($d['total_imp'], 0, ',', '.'),
               "TOTAL"          => "$".number_format(($d['total_neto'] + $d['total_imp']), 0, ',', '.') );
               
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;
$total_ventas_neto = $total_ventas_neto + $d['total_neto'];
$total_ventas_imp = $total_ventas_imp + $d['total_imp'];
}





$pdf->addImpuestos('$'.number_format($total_ventas_neto, 0, ',', '.'), 
'$'.number_format(($total_ventas_imp), 0, ',', '.'), 
'$'.number_format(($total_ventas_imp + $total_ventas_neto), 0, ',', '.'));
$pdf->Output("I", "detalle_venta.pdf", true);
?>