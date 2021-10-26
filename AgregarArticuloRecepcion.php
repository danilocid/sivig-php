<?php
include 'includes/partials/header.php';
Class ArticuloRecepcion{
    public $id;
    public $costo_neto;
    public $costo_imp;
    public $cantidad;
      
}

$articulo = new ArticuloRecepcion();
$articulofrm = array();
if (isset($_SESSION['articulo'])) {
    $articulofrm = $_SESSION['articulo'];
} 
$existe = false;
$articulofrm = array();
if($_POST['cantidad'] == 0){
    echo '<script type="text/javascript">
                    window.location="AgregarRecepcion";
                </script>';
    exit();
}
if (isset($_SESSION['articulo'])) {
    $articulofrm = $_SESSION['articulo'];
    $articulofrm2 = array();
    
    foreach ($articulofrm as $ar) {
        
        
        if ($ar->id == $_POST['articulo']) {
            $articulo = new ArticuloRecepcion();
            $articulo->id = $_POST['articulo'];
            $articulo->cantidad = $_POST['cantidad'] + $ar->cantidad;
            $articulo->costo_neto = $_POST['costo_neto'];
            $articulo->costo_imp = $_POST['costo_imp'];
            array_push($articulofrm2, $articulo);
            unset($articulo);
            $existe = true;
            
        }else{
            $articulo = new ArticuloRecepcion();
            $articulo->id = $ar->id;
            $articulo->cantidad = $ar->cantidad;
            $articulo->costo_neto = $ar->costo_neto;
            $articulo->costo_imp = $ar->costo_imp;
            array_push($articulofrm2, $articulo);
        
        }
    }
    try {
    
        $_SESSION['articulo'] = $articulofrm2;
    } catch (\Throwable $th) {
    
    }
    if ($existe == false) {
    
        $articulofrm2 = $_SESSION['articulo'];
        $articulo = new ArticuloRecepcion();
        $articulo->id = $_POST['articulo'];
        $articulo->costo_neto = $_POST['costo_neto'];
        $articulo->costo_imp = $_POST['costo_imp'];
        $articulo->cantidad = $_POST['cantidad'];
        array_push($articulofrm2, $articulo);
    
    
        try {
            
            $_SESSION['articulo'] = $articulofrm2;
        } catch (\Throwable $th) {
        
        }
        
        
    }
}else{
    $articulofrm = array();
    $articulo = new ArticuloRecepcion();
    $articulo->id = $_POST['articulo'];
    $articulo->costo_neto = $_POST['costo_neto'];
    $articulo->costo_imp = $_POST['costo_imp'];
    $articulo->cantidad = $_POST['cantidad'];
    array_push($articulofrm, $articulo);
    
    $_SESSION['articulo'] = $articulofrm;
    
   
}
echo '<script type="text/javascript">
window.location="AgregarRecepcion";
</script>';
?>