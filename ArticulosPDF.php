<?php
include 'Model/dbConection.php';
include 'Controller/ArticulosController.php';
$articulos = new Articulos();
date_default_timezone_set('America/Santiago');
$fecha = date('d-m-Y H:i');
ob_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>SIVIG - Ver articulos</title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(3) td:nth-child(4) {
				text-align: right;
				
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
				
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.datos {
				border: 1.5px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(3) {
				
				border: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: right;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
		<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td>
						<table>
							<tr>
								<td class="title">
									<img src="http://sivig.multitiendallamativo.cl/images/Logo%20web%202.png" style="width: 100%; max-width: 150px" />
								</td>
                                
								<td class="datos" style="text-align: right;">
                               
									<strong>Cid y Badilla Limitada</strong><br />
									76341652-6<br />
									Quillon<br />
                                    <?php echo $fecha; ?>

								</td>
								
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<br />
			
			<table cellpadding="0" cellspacing="0" >
                

				<tr class="heading">
					<td>Item</td>
                    <td>Cantidad</td>
					<td>Costo</td>
                    <td>P.V.P</td>
				</tr>
				<?php
                $arrayarticulos = $articulos->GetArticulosSinStock();
                
				foreach ($arrayarticulos as $d) {
					echo '<tr class="datos">
						<td class="datos">' . $d['descripcion'] . '</td>
            	        <td class="datos" style="text-align: right;">' . $d['stock'] . '</td>
						<td class="datos" style="text-align: right;">' . "$" . number_format(($d['costo_neto'] + $d['costo_imp']), 0, ',', '.') . '</td>
                        <td class="datos" style="text-align: right;">' . "$" . number_format(($d['venta_neto'] + $d['venta_imp']), 0, ',', '.') . '</td>
					</tr>';
				} ?>
				
                

			
                
				
				
			</table>
		</div>
	</body>
</html>


<?php

$html = ob_get_clean();
//echo $html;
require_once 'PDF/dompdf/autoload.inc.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$optins = $dompdf->getOptions();
$optins->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($optins);


$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('letter', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("articulos.pdf",array("Attachment" => false));


?>
