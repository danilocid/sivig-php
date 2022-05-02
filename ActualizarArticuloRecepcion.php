<?php
include 'Includes/partials/header.php';
Class ArticuloRecepcion{
    public $id;
    public $costo_neto;
    public $costo_imp;
    public $cantidad;
      
}

$existe = false;
$articulofrm = array();

if (isset($_SESSION['articulo'])) {
    $articulofrm = $_SESSION['articulo'];
    $articulofrm2 = array();
    
    foreach ($articulofrm as $ar) {
        
        if ($ar->id != $_POST['id']) {
            $articulo = new ArticuloRecepcion();
            $articulo->id = $ar->id;
            $articulo->costo_neto = $ar->costo_neto;
            $articulo->costo_imp = $ar->costo_imp;
            $articulo->cantidad = $ar->cantidad;
            array_push($articulofrm2, $articulo);
            unset($articulo);
    
        }else {
            $articulo = new ArticuloRecepcion();
            $articulo->id = $ar->id;
            $articulo->costo_neto = $_POST['costo_neto_t'];
            $articulo->costo_imp = $_POST['costo_imp_t'];
            $articulo->cantidad = $_POST['cantidad'];
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
                  window.location="AgregarRecepcion";
                </script>';