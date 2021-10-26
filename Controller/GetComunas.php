<?php
include '../Model/dbConection.php';
include 'ComunasController.php';

$idprovincia = $_POST['idprovincia'];

$comuna = new Comunas();
$comunas = $comuna->GetComunaPorProvincia($idprovincia);

$html = "<option value=''>Seleccionar Comuna</option>";

foreach ($comunas as $c) {
   $html.= '<option value='. $c->Id . '>' . $c->Comuna . '</option>';
	
}

echo $html;

?>