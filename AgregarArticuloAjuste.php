<?php
include 'Includes/partials/header.php';
Class ArticuloAjuste{
    public $id;
    public $cantidad;  
}

$existe = false;
$articulofrm = array();
if($_POST['cantidad'] == 0){
    echo '<script type="text/javascript">
                   window.location="AgregarAjuste";
                </script>';
    exit();
}
if (isset($_SESSION['articulo'])) {
    $articulofrm = $_SESSION['articulo'];
    $articulofrm2 = array();
    
    foreach ($articulofrm as $ar) {
       
       
        if ($ar->id == $_POST['articulo']) {
            $articulo = new ArticuloAjuste();
            $articulo->id = $_POST['articulo'];
            $articulo->cantidad = $_POST['cantidad'] + $ar->cantidad;
            array_push($articulofrm2, $articulo);
            unset($articulo);
            $existe = true;
           
        }else{
            $articulo = new ArticuloAjuste();
            $articulo->id = $ar->id;
            $articulo->cantidad = $ar->cantidad;
            array_push($articulofrm2, $articulo);
         
        }
    }
    try {
      
        $_SESSION['articulo'] = $articulofrm2;
    } catch (\Throwable $th) {
     
    }
   if ($existe == false) {
    
        $articulofrm2 = $_SESSION['articulo'];
        $articulo = new ArticuloAjuste();
        $articulo->id = $_POST['articulo'];
        $articulo->cantidad = $_POST['cantidad'];
        array_push($articulofrm2, $articulo);
      
      
        try {
            
            $_SESSION['articulo'] = $articulofrm2;
        } catch (\Throwable $th) {
         
        }
       
        
    }
}else{
    $articulofrm = array();
    $articulo = new ArticuloAjuste();
    $articulo->id = $_POST['articulo'];
    $articulo->cantidad = $_POST['cantidad'];
    array_push($articulofrm, $articulo);
   
    $_SESSION['articulo'] = $articulofrm;
    
    echo '<script type="text/javascript">
                   window.location="AgregarAjuste";
                </script>';
}




echo '<script type="text/javascript">
                   window.location="AgregarAjuste";
                </script>';

?>