
<?php
// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF
include 'Model/dbConection.php';
include 'Controller/ArticulosController.php';
$articulos = new Articulos();
require('PDF/ResumenPDF.php');
//se llama el constructor
$pdf = new PDF_Invoice( 'P', 'mm', 'Letter' );
//Se agrega una pagina
$pdf->AddPage();
//Se define el timezone que sea necesario
date_default_timezone_set('America/Argentina/Buenos_Aires');

//Dia-Mes-Año Hora:Minutos:Segundos
$fecha = date('d-m-Y H:i');
//$fecha = date("d-M-Y");
//se agregan los datos de la empresa
$pdf->AddEmpresa( "Llamativo.cl",
                  "Cid y Badilla Limitada\n" .
                  "76.341.652-6\n".
                  "Avenida Cayumanqui 685, local 6\n" .
                  "Quillon");


$pdf->addFechaVenta($fecha);
//se agrega el usuario que realiza la venta
//$pdf->addUsuarioVenta($usuario[0]['Nombre'].' '.$usuario[0]['Apellidos']);
//Se agregan las columnas y su alineacion
$cols=array( "Id"    => 10,
            "Codigo"    => 25,
            "Descripcion"    => 80,
             "Stock"  => 16,
             "Costo"     => 19,
             "T Costo" => 15,
             "P.V.P." => 15,
             "T P.V.P." => 16 );
$pdf->addCols( $cols);
$cols=array( "Id"    => "L",
            "Codigo"    => "L",
            "Descripcion"    => "L",
             "Stock"  => "C",
             "Costo"     => "C",
             "T Costo" => "R",
             "P.V.P." => "R",
             "T P.V.P."          => "C" );
//$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
$page = 1;
$pdf->addPageNumber( $page );
//posicion donde comienza el detalle
$y    = 50;

//se agregan los datos a la tabla
$arrayarticulos = $articulos->GetArticulos();
$total_ventas = 0;
foreach ($arrayarticulos as $a) {
    
    
   
               $line = array( "Id"    => $a['id'],
               "Codigo"  => $a['cod_interno'],
               "Descripcion"  => $a['descripcion'],
               "Stock"  => $a['stock'],
               "Costo"     =>  '$'.number_format($a['costo_neto'], 0, ',', '.'),
               "T Costo" => '$'.number_format($a['costo_neto'] * $a['stock'], 0, ',', '.'),
               "P.V.P." => '$'.number_format($a['venta_neto'], 0, ',', '.'),
               "T P.V.P."          => "$".number_format($a['venta_neto'] * $a['stock'], 0, ',', '.') );
               
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;
if ($y > 220) {
    $pdf->addImpuestos('$'.number_format($total_ventas/1.19, 0, ',', '.'), 
    '$'.number_format(($total_ventas - $total_ventas/1.19), 0, ',', '.'), 
    '$'.number_format($total_ventas, 0, ',', '.'));
        $pdf->AddPage();
        $y = 50;
        $cols=array( "Id"    => 10,
            "Codigo"    => 25,
            "Descripcion"    => 80,
             "Stock"  => 16,
             "Costo"     => 19,
             "T Costo" => 15,
             "P.V.P." => 15,
             "T P.V.P." => 16 );
$pdf->addCols( $cols);
$cols=array( "Id"    => "L",
            "Codigo"    => "L",
            "Descripcion"    => "L",
             "Stock"  => "C",
             "Costo"     => "C",
             "T Costo" => "R",
             "P.V.P." => "R",
             "T P.V.P."          => "C" );
    //$pdf->addLineFormat( $cols);
    $pdf->addLineFormat($cols);
    $pdf->AddEmpresa( "Llamativo.cl",
                    "Cid y Badilla Limitada\n" .
                    "76.341.652-6\n".
                    "Avenida Cayumanqui 685, local 6\n" .
                    "Quillon");


    $pdf->addFechaVenta($fecha);
    $page++;
    $pdf->addPageNumber( $page );
}
$total_ventas = $total_ventas + ($a['venta_neto'] * $a['stock']);

}





$pdf->addImpuestos('$'.number_format($total_ventas/1.19, 0, ',', '.'), 
'$'.number_format(($total_ventas - $total_ventas/1.19), 0, ',', '.'), 
'$'.number_format($total_ventas, 0, ',', '.'));
$pdf->Output("I", "detalle_venta.pdf", true);
?>