
<?php
// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF
include 'Model/dbConection.php';

$id = 3;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_POST['id'])) {
   $id = $_POST['id'];
}
include 'Controller/RecepcionesController.php';
include 'Controller/ProveedoresController.php';
include 'Controller/TipoDocumentoController.php';
include 'Controller/UsuariosController.php';
include 'Controller/DetalleRecepcionesController.php';

$proveedores = new Proveedores();
$tipos = new TiposDocumentos();
$articulos = new Articulos();
$recepciones = new Recepciones();
$usuarios = new Usuario;
$recepcion = $recepciones->GetRecepcionesPorId($id);

$detallerecepcion = new DetallesRecepciones();
$detallesrecepcion = $detallerecepcion->GetDetalleRecepcionPorId($id);

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
$pdf->AddDocumento( $tipos->GetTiposDocumentosPorId($recepcion[0]['tipo_documento']), $recepcion[0]['documento'] );
//Se agregan los dato del proveedor

$pdf->AddCliente($proveedores->GetNombreProveedorPorRut($recepcion[0]['proveedor']), 'Monto total: $' .number_format($recepcion[0]['total_neto'] + $recepcion[0]['total_imp'], 0, ',', '.'),
'Total articulos: ' .number_format($recepcion[0]['unidades_total'], 0, ',', '.'), 'Observaciones: ' .$recepcion[0]['observaciones']);


//Se agrega la fecha de venta
$pdf->addFechaVenta($recepcion[0]['fecha']);
//se agrega el usuario que realiza la venta
$usuario = $usuarios->GetUsuarioPorId($recepcion[0]['usuario']);
$pdf->addUsuarioVenta($usuario[0]['Nombre'].' '.$usuario[0]['Apellidos']);
//Se agregan las columnas y su alineacion
$cols=array("N"    => 8, 
            "CODIGO"    => 21,
             "DESCRIPCION"  => 74,
             "CANTIDAD"     => 19,
             "COSTO"      => 25,
             "NETO" => 15,
             "IVA" => 15,
             "TOTAL"          => 19 );
$pdf->addCols( $cols);
$cols=array( "N"    => "L",
             "CODIGO"    => "L",
             "DESCRIPCION"  => "L",
             "CANTIDAD"     => "C",
             "COSTO"      => "R",
             "NETO" => "R",
             "IVA" => "R",
             "TOTAL"          => "C" );
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
//posicion donde comienza el detalle
$y    = 80;
//se agregan los datos a la tabla
$contador = 1;
foreach ($detallesrecepcion as $a) {
    $line = array("N"    => $contador,
                "CODIGO"    => $a['articulo'],
               "DESCRIPCION"  => $articulos->GetDescripcionArticuloPorId($a['articulo']),
               "CANTIDAD"     => $a['cantidad'],
               "COSTO"      => '$'.number_format($a['compra_neto'] + $a['compra_imp'], 0, ',', '.'),
               "NETO" => '$'.number_format($a['compra_neto'], 0, ',', '.'),
               "IVA" => '$'.number_format(($a['compra_imp']), 0, ',', '.'),
               "TOTAL"          => "$".number_format(($a['compra_imp'] + $a['compra_neto']) * $a['cantidad'], 0, ',', '.') );
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;
$contador++;
}





$pdf->addImpuestos('$'.number_format($recepcion[0]['total_neto']/1.19, 0, ',', '.'), 
'$'.number_format(($recepcion[0]['total_imp']), 0, ',', '.'), 
'$'.number_format($recepcion[0]['total_neto'] + $recepcion[0]['total_imp'], 0, ',', '.'));
$pdf->Output("I", "detalle_venta.pdf", true);
?>