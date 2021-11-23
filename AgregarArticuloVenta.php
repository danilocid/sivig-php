<?php
include 'Includes/partials/header.php';
Class ArticuloVenta{
    public $id;
    public $venta_neto;
    public $venta_imp;
    public $cantidad;
    public $total;
   
}

$existe = false;
$articulofrm = array();

if (isset($_SESSION['articulo'])) {
    $articulofrm = $_SESSION['articulo'];
    $articulofrm2 = array();
    
    foreach ($articulofrm as $ar) {
       
       
        if ($ar->id == $_POST['articulo']) {
            $articulo = new ArticuloVenta();
            $articulo->id = $_POST['articulo'];
            $articulo->venta_neto = $_POST['precioventa'] / 1.19;
            $articulo->venta_imp = $_POST['precioventa'] - ($_POST['precioventa'] / 1.19);
            $articulo->cantidad = $_POST['cantidad'] + $ar->cantidad;
            $articulo->total = $_POST['precioventa'] * $articulo->cantidad;
           
            array_push($articulofrm2, $articulo);
            unset($articulo);
            $existe = true;
           
        }else{
            $articulo = new ArticuloVenta();
            $articulo->id = $ar->id;
            $articulo->venta_imp = $ar->venta_imp;
            $articulo->venta_neto = $ar->venta_neto;
            $articulo->cantidad = $ar->cantidad;
            $articulo->total = $ar->total;
            array_push($articulofrm2, $articulo);
           
            unset($articulo);
           
            
        }
    }
    try {
      
        $_SESSION['articulo'] = $articulofrm2;
    } catch (\Throwable $th) {
     
    }
    
  
    
    
    if ($existe == false) {
    
        $articulofrm2 = $_SESSION['articulo'];
        $articulo = new ArticuloVenta();
        $articulo->id = $_POST['articulo'];
        $articulo->venta_neto = $_POST['precioventa'] / 1.19;
        $articulo->venta_imp = $_POST['precioventa'] - ($_POST['precioventa'] / 1.19);
        $articulo->cantidad = $_POST['cantidad'];
        $articulo->total = $_POST['precioventa'] * $articulo->cantidad;
        array_push($articulofrm2, $articulo);
      
      
        try {
            
            $_SESSION['articulo'] = $articulofrm2;
        } catch (\Throwable $th) {
         
        }
       
        
    }
}else{
    $articulofrm = array();
    $articulo = new ArticuloVenta();
    $articulo->id = $_POST['articulo'];
    $articulo->venta_neto = $_POST['precioventa'] / 1.19;
    $articulo->venta_imp = $_POST['precioventa'] - ($_POST['precioventa'] / 1.19);
    $articulo->cantidad = $_POST['cantidad'];
    $articulo->total = $_POST['precioventa'] * $articulo->cantidad;
    array_push($articulofrm, $articulo);
   
    $_SESSION['articulo'] = $articulofrm;
    
    echo '<script type="text/javascript">
                   window.location="AgregarVenta";
</script>';
}




echo '<script type="text/javascript">
        window.location="AgregarVenta";
       </script>';

