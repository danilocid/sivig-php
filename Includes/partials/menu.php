<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index" class="nav-link">Inicio</a>
        </li>
        
      </ul>
  <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
          <a href="Controller/LogoutController.php" class="nav-link">Cerrar sesion</a>
        </li>
       
        
      </ul>
    </nav>
    <!-- /.navbar -->
  
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="./" class="brand-link">
        <span class="brand-text font-weight-light">SIVIG</span>
      </a>
  
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        
  
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
                 
                 <li class="nav-item has-treeview">
                <?php
        require './Controller/MenuController.php';
        
        
        $menu = new Menu();
        
        $activo = "";
        $activog = "";
        $open = "";
        $grupos = $menu->GetGrupos();
        if ($idpagina == 0) {
          $idgrupoactivo = 0;
        }else{
          $idgrupoactivo = $menu->GetGrupoPagina($idpagina);
        }
        
        

        foreach ($grupos as $g) {
          if($idgrupoactivo === $g['idgrupo']){
            $activog = "active";
            $open = "menu-open";
          }else{
            $activog = "";
            $open = "";
          }
          echo '
          <li class="nav-item has-treeview '.$open.'">
          <a href="#" class="nav-link '.$activog.'">
            <i class="nav-icon '. $g['imagengrupo'] .'"></i>
            <p>
              '. $g['nombregrupo'].'
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">';
          
          $datos = $menu->Getpaginas($_SESSION['id'], $g['idgrupo']);
          foreach ($datos as $n) {
         
            if($idpagina === $n->IdPagina){
              $activo = "active";
            }else{
              $activo = "";
            }
            echo '
            <li class="nav-item">
            <a href="'. $n->EnlacePagina.'" class="nav-link '. $activo.'">
              <i class="nav-icon '. $n->ImagenPagina.'"></i>
              <p>
              '. $n->NombrePagina.'
              </p>
            </a>
          </li>
          
          ';
          
          
      }
      echo ' 
          </ul>
         ';
      echo ' 
      </li>
     '; 
        }
        
	  if($idpagina != 0){
        if ($menu->GetPermisoPagina($_SESSION['id'],$idpagina)) {
          echo '<script type="text/javascript">
          window.location="index";
          </script>';
        }
	}
  

        ?>
                
            
        
                
                </ul>
                
                
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  
    
  
    