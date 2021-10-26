<?php
$titulo = 'Ver detalle ajuste de inventario';
$idpagina = 9;
include 'includes/partials/header.php';
include 'includes/partials/menu.php';
include 'Controller/UsuariosController.php';
include 'Controller/ArticulosController.php';
include 'Controller/AjustesDeInventarioController.php';
include 'Controller/TipoMovimientoController.php';

$articulos = new Articulos();
$ajustes = new AjustesDeInventario();
$usuarios = new Usuario;
$ajuste = $ajustes->GetAjustePorId($_POST['id']);
$tipos = new TiposMovimientos();
$detalleajsute = $ajustes->GetDetalleAjustePorId($_POST['id']);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Detalle ajuste de inventario</h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Resumen de ajuste</h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
          
            <!-- Inicio contenido -->
            
            
            <?php
          
        echo '<p>Tipo ajuste: '.$tipos->GetTiposMovimientosId($ajuste[0][1]).'</p>';
        echo '<p>Observaciones: '.$ajuste[0][4].'</p>';        
        echo '<p>Monto neto: $' .number_format($ajuste[0][2], 0, ',', '.').'</p>';
        echo '<p>Monto impuestos: $' .number_format($ajuste[0][3], 0, ',', '.').'</p>';
        echo '<p>Monto total: $' .number_format($ajuste[0][3] + $ajuste[0][2], 0, ',', '.').'</p>';
        echo '<p>Fecha de ajuste: ' .$ajuste[0][5].'</p>';
        $usuario = $usuarios->GetUsuarioPorId($ajuste[0][6]);
        echo '<p>Usuario: ' .$usuario[0]['Nombre'].' '.$usuario[0]['Apellidos'].'</p>';
     
      
      ?>
                
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
         Resumen de ajuste
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Articulos ajustados</h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
          
            <!-- Inicio contenido -->
            
            
            <table id="tabla1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 20px">N°</th>
                  <th>Articulo</th>
                  <th>Valor neto</th>
                  <th>Impuestos</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                  
                </tr>
              </thead>
              <tbody>
              <?php
              $contador = 1;
              
              
                foreach ($detalleajsute as $a) {
                    echo '<tr>
                          <td>'.$contador.'</td>
                          <td>'.$articulos->GetDescripcionArticuloPorId($a['articulo']).'</td>
                          <td> $'.number_format($a['monto_neto'], 0, ',', '.').'</td>
                          <td> $'.number_format($a['monto_imp'], 0, ',', '.').'</td>
                          
                          <td>'.$a['cantidad'].'</td>
                          <td> $'.number_format($a['monto_neto'] * $a['cantidad'], 0, ',', '.').'</td>';
                          
                          
                         
                                        
                          echo '</tr>
                          ';
                      $contador++;
                    }
                    
              
              ?>
              
            </tbody>
            
              
            </table>
           
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
         Articulos vendidos
          </div>
          <!-- /.card-footer-->
        </div>
  
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


 
      
            
  <?php
  
    
  include 'includes/partials/footer.php';
  
  ?>

