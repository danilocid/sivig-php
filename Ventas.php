<?php
$titulo = 'Ventas';
$idpagina = 6;
include 'includes/partials/header.php';
include 'includes/partials/menu.php';
include 'Controller/VentasController.php';
include 'Controller/ClientesController.php';
include 'Controller/TipoDocumentoController.php';

$clientes = new Cliente();
$tipo_documento = new TiposDocumentos();
if (isset($_SESSION['articulo'])) {
  unset($_SESSION['articulo']);
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Ventas</h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Listado de ventas</h3>
  
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
                  <th style="width: 60px">ID</th>
                  <th>Cliente</th>
                  <th>Tipo documento</th>
                  <th>Documento</th>
                  <th>Monto</th>
                  <th>Fecha</th>
                  <th style="width: 80px">Ver detalle</th>
                </tr>
              </thead>
              <tbody>
              <?php
                  $venta = new Ventas();
                  $ventas = $venta->GetVentas();
                  
                  foreach ($ventas as $v) {
                   echo' <tr>
                      <td>'. $v['id'].'</td>  
                      <td>'. $clientes->GetNombreClientePorRut($v['cliente']).'</td>
                      <td>'. $tipo_documento->GetTiposDocumentosPorId($v['tipo_documento']).'</td>
                      <td>'. $v['documento'].'</td>
                      <td>$'.number_format(($v['monto_neto'] + $v['monto_imp']), 0, ',', '.').'</td>
                      <td>'. $v['fecha'].'</td>
                      <td>
                    <form action="VerVenta" method="POST">
                    <input type="hidden" name="id" value="'.$v['id'].'">
                    <button type="submit" class="btn btn-block btn-primary" name="Ver detalle" value="Ver detalle">Ver detalle</button>
                    </form>
                    </td>
                    </tr>';
                    
                  }
              ?>
            </tbody>
            
              
            </table>
            <br>
              <div class="float-right">
              <a href="AgregarVenta" class="btn  btn-lg btn-info"> Agregar venta</a>
                  </div>
                
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
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
                        echo '<iframe src="VerVentaPDF?id='.$_GET['id'].'" frameborder="0" style="width: 100%; height: 450px;"></iframe>';
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
              <!-- /.card-body -->
          
          
              
                
           
          
          <div class="card-footer">
          Listado de ventas
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
    window.location='./Ventas';  
  });

</script>";
   }

  include 'includes/partials/footer.php';
  
  ?>

