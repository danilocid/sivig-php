<?php
include 'includes/partials/header.php';
Class ArticuloVenta{
    public $id;
    public $precio_venta;
    public $cantidad;
    public $total;
   
}

$existe = false;
$articulofrm = array();

if (isset($_SESSION['articulo'])) {
    $articulofrm = $_SESSION['articulo'];
    $articulofrm2 = array();
    
    foreach ($articulofrm as $ar) {
        
        if ($ar->id != $_POST['id']) {
            $articulo = new ArticuloVenta();
            $articulo->id = $ar->id;
            $articulo->precio_venta = $ar->precio_venta;
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


    
       
        
    
}




echo '<script type="text/javascript">
                   window.location="AgregarVenta";
                </script>';

?>