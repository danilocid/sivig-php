<?php
ob_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>A simple, clean, and responsive HTML invoice template</title>

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

			.invoice-box table tr td:nth-child(2) {
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
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
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
					<td colspan="3">
						<table>
							<tr>
								<td class="title">
									<img src="$_SERVER['SERVER_NAME']https://www.sparksuite.com/images/logo.png" style="width: 100%; max-width: 300px" />
								</td>
                                
								<td >
									Invoice #: 123<br />
									Created: 08/11/2021<br />
									Due: February 1, 2015
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="3">
						<table>
							<tr>
								<td>
									Sparksuite, Inc.<br />
									12345 Sunny Road<br />
									Sunnyville, CA 12345
								</td>

								<td>
									Acme Corp.<br />
									John Doe<br />
									john@example.com
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td colspan="2">Payment Method</td>

					<td>Check #</td>
				</tr>

				<tr class="details">
					<td>Check</td>
                    
					<td colspan="2">1000</td>
				</tr>
                

				<tr class="heading">
					<td>Item</td>
                    <td>cantidad</td>
					<td>Price</td>
				</tr>

				<tr class="item">
					<td>Website design</td>
                    <td>1</td>
					<td>$300</td>
				</tr>
                <tr class="item">
					<td>Website design</td>
                    <td>1</td>
					<td>$300.00</td>
				</tr>
                <tr class="item">
					<td>Website design</td>
                    <td>1</td>
					<td>$300.00</td>
				</tr>
                

				
                <tr class="total">
				
					<td></td>
					<td colspan="1">Total: $385.00</td>
				</tr>
				<tr class="total">
				
					<td></td>
					<td colspan="2">Total: $385.00</td>
				</tr>
				<tr class="total">
				
					<td></td>
					<td colspan="3">Total: $385.00</td>
				</tr>
				
			</table>
		</div>
	</body>
</html>


<?php

$html = ob_get_clean();

require_once 'dompdf/autoload.inc.php';
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
$dompdf->stream("archivo.pdf",array("Attachment" => false));


?>