
<?php
// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF
include 'Model/dbConection.php';
include 'Controller/ArticulosController.php';
include 'Controller/MovimientosArticulosController.php';
include 'Controller/TipoMovimientoController.php';
include 'Controller/UsuariosController.php';
$id = "11";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //echo 'get';
}
if (isset($_POST['id'])) {
   $id = $_POST['id'];
   //echo 'post';
}

$articulos = new Articulos();
$articulo = $articulos->GetArticulosPorId($id);
$movimientos = new MovimientosArticulos();
$detallemovimiento = $movimientos->GetMovimientosPorArticulo($id);
$tipomovimiento = new TiposMovimientos();
$usuario = new Usuario();
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

$pdf->AddProducto($articulo[0]['id'],$articulo[0]['cod_interno'],
$articulo[0]['descripcion'], $articulo[0]['stock'], $articulo[0]['venta_neto'],
$articulo[0]['venta_imp'],$articulo[0]['costo_neto'],$articulo[0]['costo_imp']);

//Se agregan las columnas y su alineacion
$cols=array( "N"    => 15,
            "ARTICULO"    => 50,
             "MOVIMIENTO"  => 50,
             "CANTIDAD"     => 19,
             "FECHA"      => 32,
             "USUARIO" => 30
             );
$pdf->addCols( $cols);
$cols=array( "N"    => "C",
            "ARTICULO"    => "L",
             "MOVIMIENTO"  => "L",
             "CANTIDAD"     => "C",
             "FECHA"      => "L",
             "USUARIO" => "L"
             );
//$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
//posicion donde comienza el detalle
$y    = 80;
//se agregan los datos a la tabla
$contador = 1;
foreach ($detallemovimiento as $a) {
    $nombreusuario = $usuario->GetUsuarioPorId($a['usuario']);
               $line = array( "N"    => $contador,
               "ARTICULO"  => $articulos->GetDescripcionArticuloPorId($a['articulo']),
               "MOVIMIENTO"  => $tipomovimiento->GetTiposMovimientosId($a['movimiento']),
               "CANTIDAD"     =>  number_format($a['unidades'], 0, ',', '.'),
               "FECHA" => $a['fecha'],
               "USUARIO" => $nombreusuario[0]['Nombre'].' '.$nombreusuario[0]['Apellidos']
               );
               
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;
$contador++;
}






$pdf->Output("I", "detalle_venta.pdf", true);
?>