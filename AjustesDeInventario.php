<?php
$titulo = 'Ajustes de inventario';
$idpagina = 9;
include 'Includes/partials/header.php';
include 'Includes/partials/menu.php';
include 'Controller/AjustesDeInventarioController.php';
include 'Controller/TipoMovimientoController.php';
include 'Controller/UsuariosController.php';
$ajustes = new AjustesDeInventario();
$tipomovimiento = new TiposMovimientos();
$usuario = new Usuario();

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Gestion de articulos</h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Ajustes de inventario</h3>
  
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
                  <th style="width: 20px">Id</th>
                  <th>Tipo</th>
                  <th>Observaciones</th>
                  <th>Monto Neto</th>
                  <th>Fecha</th>
                  <th>Usuario</th>
                  <th style="width: 60px">Ver</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $ajustesdeinventario = $ajustes->GetAjustes();
                  foreach($ajustesdeinventario as $a){
                    $nombreusuario = $usuario->GetUsuarioPorId($a['usuario']);
                    echo('<tr>
                    <td>'.$a['id'].'</td>
                    <td>'.$tipomovimiento->GetTiposMovimientosId($a['tipo_movimiento']).'</td>
                    <td>'.$a['observaciones'].'</td>
                    <td>'.number_format(($a['monto_neto'] + $a['monto_imp']), 0, ',', '.').'</td>
                    <td>'.$a['fecha'].'</td>
                    <td>'.$nombreusuario[0]['Nombre'].' '.$nombreusuario[0]['Apellidos'].'</td>
                    <td>
                    <form action="VerAjusteDeInventario" method="POST">
                    <input type="hidden" name="id" value="'.$a['id'].'">
                    <button type="submit" class="btn btn-block btn-primary btn-sm" name="Ver" value="Ver">Ver</button>
                    </form>
                    </td>');
                    echo('</tr>');
                  }
                ?>
              </tbody>
            
              
            </table>
            <br>       
           
              <div class="float-right">
              <a href="AgregarAjuste" class="btn  btn-lg btn-info"> Agregar ajuste</a>
                  </div>
                  <div class="float-right">
              <a href="AgregarAjuste" class="btn  btn-lg btn-info"> Realizar inventario</a>
                  </div>
            
            
            
                  <div class="modal fade" id="modal-default">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                  <h4 class="modal-title">Ver PDF</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    
                  </div>
                  <div class="modal-body">
                    <?php
                     if(isset($_GET['id'])){
                        echo '<iframe src="VerAjusteDeInventarioPDF?id='.$_GET['id'].'" frameborder="0" style="width: 100%; height: 450px;"></iframe>';
                    }
                    ?>
                   
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              </div>
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          Ajustes de inventario
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

 
            
              
                 
  <?php
   if(isset($_GET['id'])){
 
  $script = "<script type='text/javascript'>
  $('#modal-default').modal('show');
  $('#modal-default').on('hidden.bs.modal', function () {
    window.location='./AjustesDeInventario';  
  });

</script>";
   }
  

  include 'Includes/partials/footer.php';
  
  ?>

