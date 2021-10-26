
<?php
// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF
include 'Model/dbConection.php';
include 'Controller/UsuariosController.php';
include 'Controller/ArticulosController.php';
include 'Controller/AjustesDeInventarioController.php';
include 'PDF/DetallePDF.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_POST['id'])) {
   $id = $_POST['id'];
}
$articulos = new Articulos();
$usuarios = new Usuario;
$ajustes = new AjustesDeInventario();
$ajuste = $ajustes->GetAjustePorId($id);
$usuario = $usuarios->GetUsuarioPorId($ajuste[0]['usuario']);
$detalleajuste = $ajustes->GetDetalleAjustePorId($id);


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
$datoscliente = "";
//foreach ($cliente as $c){
 //   $nombrecliente = $c['nombre'];
    

////$pdf->AddCliente($nombrecliente, $c['rut'], $c['giro'], $c['direccion']);
//}
//se agrega el medio de pago
//$pdf->AddMedioDePago($mediodepago);
//Se agrega la fecha de venta
$pdf->addFechaVenta($ajuste[0]['fecha']);
//se agrega el usuario que realiza la venta
$pdf->addUsuarioVenta($usuario[0]['Nombre'].' '.$usuario[0]['Apellidos']);
//Se agregan las columnas y su alineacion
$cols=array( "CODIGO"    => 22,
             "DESCRIPCION"  => 95,
             "CANTIDAD"     => 19,
             "NETO" => 20,
             "IVA" => 20,
             "TOTAL"          => 20 );
$pdf->addCols( $cols);
$cols=array( "CODIGO"    => "L",
             "DESCRIPCION"  => "L",
             "CANTIDAD"     => "L",
            
             "NETO" => "R",
             "IVA" => "R",
             "TOTAL"          => "C" );
$pdf->addLineFormat( $cols);
//posicion donde comienza el detalle
$y    = 80;
//se agregan los datos a la tabla
foreach ($detalleajuste as $d) {
    $line = array( "CODIGO"    => $d['articulo'],
               "DESCRIPCION"  => $articulos->GetDescripcionArticuloPorId($d['articulo']),
               "CANTIDAD"     => $d['cantidad'],
               
               "NETO" => '$'.number_format($d['monto_neto'], 0, ',', '.'),
               "IVA" => '$'.number_format($d['monto_imp'], 0, ',', '.'),
               "TOTAL"          => "$".number_format(($d['monto_neto'] + $d['monto_imp']) * (-$d['cantidad']), 0, ',', '.') );
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;
}





$pdf->addImpuestos('$'.number_format($ajuste[0]['monto_neto'], 0, ',', '.'), 
'$'.number_format($ajuste[0]['monto_imp'], 0, ',', '.'), 
'$'.number_format($ajuste[0]['monto_imp'] + $ajuste[0]['monto_neto'], 0, ',', '.'));
$pdf->Output("I", "detalle_venta.pdf", true);
?>