<?php
$titulo = 'Recepcion';
$idpagina = 5;
include 'includes/partials/header.php';
include 'includes/partials/menu.php';
include 'Controller/RecepcionesController.php';
include 'Controller/ProveedoresController.php';
include 'Controller/TipoDocumentoController.php';
$proveedores = new Proveedores();
$tipos = new TiposDocumentos();

if(isset($_SESSION['recepcion'])){
  unset($_SESSION['recepcion']);
}
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
              <h1>Recepcion de mercadiera</h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Recepciones</h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
          
            <!-- Inicio contenido -->
            
            
            <table id="tabla2" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 20px">Id</th>
                  <th>Proveedor</th>
                  <th>Tipo Documento</th>
                  <th>Documento</th>
                  <th>Neto</th>
                  <th>I.V.A.</th>
                  <th>Total</th>
                  <th>Fecha</th>
                  <th style="width: 80px">Ver detalle</th>
                 
                </tr>
              </thead>
              <tbody>
              <?php
              $recepcion = new Recepciones();
              $recepciones = $recepcion->GetRecepciones();
            
              foreach ($recepciones as $c) {
              echo '<tr>
                    <td>'.$c['id'].'</td>
                    <td>'.$proveedores->GetNombreProveedorPorRut($c['proveedor']).'</td>
                    <td>'.$tipos->GetTiposDocumentosPorId($c['tipo_documento']).'</td>
                    <td>'.$c['documento'].'</td>
                    <td>$'.number_format($c['total_neto'], 0, ',', '.').'</td>
                    <td>$'.number_format($c['total_imp'], 0, ',', '.').'</td>
                    <td>$'.number_format($c['total_neto'] + $c['total_imp'], 0, ',', '.').'</td>
                    <td>'.$c['fecha'].'</td>';
                    
                    echo '<td>
                    <form action="VerRecepcion" method="POST">
                    <input type="hidden" name="id" value="'.$c['id'].'">
                    <button type="submit" class="btn btn-primary btn-sm" name="Ver" value="Ver">Ver detalle</button>
                    </form>
                    </td>';
                    
                                  
                    echo '</tr>
                    ';
                
              }
              ?>
            </tbody>
            
              
            </table>
            
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
Recepciones          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
  
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

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
                        echo '<iframe src="VerRecepcionPDF?id='.$_GET['id'].'" frameborder="0" style="width: 100%; height: 450px;"></iframe>';
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
  
         
                  <br>
                  <br>
                  <br>
                  
              
      
      
      
  
  <?php
  
  if(isset($_GET['id'])){
 
    $script = "<script type='text/javascript'>
    $('#modal-default').modal('show');
    $('#modal-default').on('hidden.bs.modal', function () {
      window.location='./Recepciones';  
    });
  
  </script>";
     }
  
  include 'includes/partials/footer.php';
  
  ?>

