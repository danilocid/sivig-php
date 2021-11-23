<?php
include '../Model/dbConection.php';
include 'ComunasController.php';

$idregion = $_POST['idregion'];

$comuna = new Comunas();
$comunas = $comuna->GetComunaPorRegion($idregion);

$html = "<option value=''>Seleccionar Comuna</option>";

foreach ($comunas as $c) {
   $html.= '<option value='. $c->Id . '>' . $c->Comuna . '</option>';
	
}

echo $html;

?>