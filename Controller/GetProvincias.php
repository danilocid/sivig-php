<?php
include '../Model/dbConection.php';
include 'ProvinciasController.php';

$idregion = $_POST['idregion'];

$provincia = new Provincias();
$provincias = $provincia->GetProvinciasPorRegion($idregion);

$html = "<option value=''>Seleccionar Provincia</option>";

foreach ($provincias as $p) {
   $html.= '<option value='. $p->id . '>' . $p->provincia . '</option>';
	
}

echo $html;

?>