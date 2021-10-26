<?php
include 'includes/partials/header.php';
Class ArticuloAjuste{
    public $id;
    public $cantidad;
}

$existe = false;
$articulofrm = array();

if (isset($_SESSION['articulo'])) {
    $articulofrm = $_SESSION['articulo'];
    $articulofrm2 = array();
    
    foreach ($articulofrm as $ar) {
        
        if ($ar->id != $_POST['id']) {
            $articulo = new ArticuloAjuste();
            $articulo->id = $ar->id;
            $articulo->cantidad = $ar->cantidad;
            array_push($articulofrm2, $articulo);
            unset($articulo);
        }
    }
    try {
        $_SESSION['articulo'] = $articulofrm2;
    } catch (\Throwable $th) {
      
    } 
}
echo '<script type="text/javascript">
                   window.location="AgregarAjuste";
                </script>';

?>