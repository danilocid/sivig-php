
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
$rut = "111111-1";
if (isset($_GET['rut'])) {
    $rut = $_GET['rut'];
    //echo 'get';
}
if (isset($_POST['rut'])) {
   $rut = $_POST['rut'];
   //echo 'post';
}
$proveedor = new Proveedores();
$datosproveedor = $proveedor->GetProveedorPorRut($rut);
$recepciones = new Recepciones();
$recepcionesproveedor = $recepciones->GetRecepcionesPorRUT($rut);
$datosrecepciones = $recepciones->GetDetalleRecepcionesPorRUT($recepcionesproveedor);
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
//$pdf->AddCliente($nombrecliente, $datoscliente[0]['rut'], $c['giro'], $c['direccion']);
//se agrega el medio de pago
//$pdf->AddMedioDePago($mediodepago);
//Se agrega la fecha de venta
//$pdf->addFechaVenta($venta[0]['fecha']);
//se agrega el usuario que realiza la venta
//$pdf->addUsuarioVenta($usuario[0]['Nombre'].' '.$usuario[0]['Apellidos']);
//Se agregan las columnas y su alineacion
$cols=array( "N"    => 8,
            "CODIGO"    => 25,
            "ARTICULO"    => 60,
             "UNITARIO"  => 35,
             "CANTIDAD"     => 19,
             "NETO" => 17,
             "IVA" => 15,
             "TOTAL" => 17 );
$pdf->addCols( $cols);
$cols=array( "N"    => "L",
            "CODIGO"    => "L",
            "ARTICULO"    => "L",
             "UNITARIO"  => "L",
             "CANTIDAD"     => "C",
             "NETO" => "R",
             "IVA" => "R",
             "TOTAL"          => "C" );
//$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
//posicion donde comienza el detalle
$y    = 80;
//se agregan los datos a la tabla
$contador = 1;
foreach ($datosrecepciones as $a) {
    
    
   
               $line = array( "N"    => $contador,
               "CODIGO"  => $a['articulo'],
               "ARTICULO"  => $articulos->GetDescripcionArticuloPorId($a['articulo']),
               "UNITARIO"  => '$'.number_format($a['compra_neto'], 0, ',', '.'),
               "CANTIDAD"     =>  $a['cantidad'],
               "NETO" => '$'.number_format($a['compra_neto'] * $a['cantidad'], 0, ',', '.'),
               "IVA" => '$'.number_format($a['compra_imp'] * $a['cantidad'], 0, ',', '.'),
               "TOTAL"          => "$".number_format(($a['compra_neto'] + $a['compra_imp']) * $a['cantidad'], 0, ',', '.') );
               
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;
$total_ventas_neto = $total_ventas_neto + ($a['compra_neto'] * $a['cantidad']);
$total_ventas_imp = $total_ventas_imp + ($a['compra_imp'] * $a['cantidad']);
$contador++;
}





$pdf->addImpuestos('$'.number_format($total_ventas_neto, 0, ',', '.'), 
'$'.number_format(($total_ventas_imp), 0, ',', '.'), 
'$'.number_format($total_ventas_neto + $total_ventas_imp, 0, ',', '.'));
$pdf->Output("I", "detalle_venta.pdf", true);
?>