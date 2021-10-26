<?php
$titulo = 'Ver detalle recepcion';
$idpagina = 5;
include 'includes/partials/header.php';
include 'includes/partials/menu.php';
include 'Controller/RecepcionesController.php';
include 'Controller/ProveedoresController.php';
include 'Controller/TipoDocumentoController.php';
include 'Controller/UsuariosController.php';
include 'Controller/DetalleRecepcionesController.php';

$proveedores = new Proveedores();
$tipos = new TiposDocumentos();
$articulos = new Articulos();
$recepciones = new Recepciones();
$usuarios = new Usuario;
$recepcion = $recepciones->GetRecepcionesPorId($_POST['id']);

$detallerecepcion = new DetallesRecepciones();
$detallesrecepcion = $detallerecepcion->GetDetalleRecepcionPorId($recepcion[0]['id']);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Detalle recepcion de mercadiera</h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Resumen recepcion</h3>
  
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
          
         
          echo '<p>Proveedor: '.$proveedores->GetNombreProveedorPorRut($recepcion[0]['proveedor']).'</p>';
          echo '<p>Documento: '.$tipos->GetTiposDocumentosPorId($recepcion[0]['tipo_documento']).' N°: '.$recepcion[0]['documento'].'</p>';
          echo '<p>Monto neto: $' .number_format($recepcion[0]['total_neto'], 0, ',', '.').'</p>';
          echo '<p>Monto I.V.A.: $' .number_format($recepcion[0]['total_imp'], 0, ',', '.').'</p>';
          echo '<p>Monto total: $' .number_format($recepcion[0]['total_neto'] + $recepcion[0]['total_imp'], 0, ',', '.').'</p>';
          echo '<p>Total articulos: ' .number_format($recepcion[0]['unidades_total'], 0, ',', '.').'</p>';
          echo '<p>Observaciones: ' .$recepcion[0]['observaciones'].'</p>';
          echo '<p>Fecha de recepcion: ' .$recepcion[0]['fecha'].'</p>';
          $usuario = $usuarios->GetUsuarioPorId($recepcion[0]['usuario']);
          echo '<p>Usuario: ' .$usuario[0]['Nombre'].' '.$usuario[0]['Apellidos'].'</p>';
     
      
      ?>
                
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          Resumen recepcion
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->

         <!-- Default box -->
         <div class="card">
          <div class="card-header">
            <h3 class="card-title">Articulos recepcionados</h3>
  
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
                  <th>Neto</th>
                  <th>I.V.A.</th>
                  <th>Total</th>
                  <th>Cantidad</th>
                 
                  
                </tr>
              </thead>
              <tbody>
              <?php
              $contador = 1;
              //print_r($_SESSION['articulo']);
              
                foreach ($detallesrecepcion as $a) {
                    echo '<tr>
                          <td>'.$contador.'</td>
                          <td>'.$articulos->GetDescripcionArticuloPorId($a['articulo']).'</td>
                          <td> $'.number_format($a['compra_neto'], 0, ',', '.').'</td>
                          <td> $'.number_format($a['compra_imp'], 0, ',', '.').'</td>
                          <td> $'.number_format($a['compra_neto'] + $a['compra_imp'], 0, ',', '.').'</td>
                          
                          <td>'.$a['cantidad'].'</td>';
                          
                          
                          
                         
                                        
                          echo '</tr>
                          ';
                      $contador++;
                    }
                    
              
              ?>
              
            </tbody>
            
              
            </table>
            <br>
            <form action="VerRecepcionPDF" method="post" target="_blank">
                    <input type="hidden" name="id" id="id" value="<?php echo $_POST['id']; ?>">
                    <button type="submit"  class="btn  btn-primary btn-lg" name="Ver PDF" value="Ver PDF">Ver PDF</button>
                    </form>
                
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          Articulos recepcionados
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
  
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

  
  <?php
  
    
  include 'includes/partials/footer.php';
  
  ?>

