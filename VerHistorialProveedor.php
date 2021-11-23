<?php
$titulo = 'Ver historial proveedor';
$idpagina = 2;
include 'Includes/partials/header.php';
include 'Includes/partials/menu.php';
include 'Controller/TipoDocumentoController.php';
include 'Controller/UsuariosController.php';
include 'Controller/ComunasController.php';
include 'Controller/RegionesController.php';
include 'Controller/ProveedoresController.php';
include 'Controller/RecepcionesController.php';
$articulo = new Articulos();
$proveedores = new Proveedores();
$tipodocumento = new TiposDocumentos();
$usuarios = new Usuario();
$comunas = new Comunas();
$regiones = new Regiones();
$recepciones = new Recepciones();

$datosproveedor = $proveedores->GetProveedorPorRut($_POST['rut']);
$comuna = $comunas->GetComunaPorId($datosproveedor[0]['comuna']);
$region  = $regiones->GetRegionPorId($datosproveedor[0]['region']);
$recepcionesproveedor = $recepciones->GetRecepcionesPorRUT($_POST['rut']);
$detallerecepciones = $recepciones->GetDetalleRecepcionesPorRUT($recepcionesproveedor);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Historial del proveedor</h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Datos del proveedor</h3>
  
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
          
         
          echo '<p><strong>RUT</strong>: '.$datosproveedor[0]['rut'].'</p>';
          echo '<p><strong>Nombre o Razon Social</strong>: '.$datosproveedor[0]['nombre'].'</p>';
                   echo '<p><strong>Giro</strong>: '.$datosproveedor[0]['giro'].'</p>';
          echo '<p><strong>Direccion</strong>: '.$datosproveedor[0]['direccion'].'</p>';
          echo '<p><strong>Comuna</strong>: '.$comuna.'</p>';
          echo '<p><strong>Region</strong>: '.$region.'</p>';
          echo '<p><strong>Telefono</strong>: '.$datosproveedor[0]['telefono'].'</p>';
          echo '<p><strong>Mail</strong>: '.$datosproveedor[0]['mail'].'</p>';

          
         
        ?>
                
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          Datos del proveedor
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Recepciones del proveedor</h3>
  
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
                  <th>Neto</th>
                  <th>I.V.A.</th>
                  <th>Total</th>
                  <th>Observaciones</th>
                  <th>Tipo documento</th>
                  <th>Numero</th>
                  <th>Fecha</th>
                  <th>Usuario</th>
                  
                </tr>
              </thead>
              <tbody>
              <?php
              $contador = 1;
              
              
                foreach ($recepcionesproveedor as $a) {
                    $usuario = $usuarios->GetUsuarioPorId($a['usuario']);
                    
                    echo '<tr>
                    
                          <td>'.$contador.'</td>
                          <td>$'.number_format($a['total_neto'], 0, ',', '.').'</td>
                          <td>$'.number_format($a['total_imp'], 0, ',', '.').'</td>
                          <td>$'.number_format($a['total_neto'] + $a['total_imp'], 0, ',', '.').'</td>
                          <td>'.$a['observaciones'].'</td>
                          <td>'.$tipodocumento->GetTiposDocumentosPorId($a['tipo_documento']) .'</td>
                          <td>'.$a['documento'].'</td>
                          <td>'.$a['fecha'].'</td>
                          <td>'.$usuario[0][3] . ' '.$usuario[0][4].'</td>';
                          
                          
                         
                                        
                          echo '</tr>
                          ';
                      $contador++;
                    }
                    
              
              ?>
              
            </tbody>
            
              
            </table>
            <br>
            <br>
                  <form action="VerHistorialProveedorPDF" method="post" target="_blank">
                    <input type="hidden" name="rut" id="rut" value="<?php echo $_POST['rut']; ?>">
                    <button type="submit"  class="btn  btn-primary btn-lg" name="Ver PDF" value="Ver PDF">Ver PDF</button>
                    </form>
                
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          Recepciones del proveedor
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Articulos comprados al proveedor</h3>
  
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
                  <th style="width: 20px">N°</th>
                  <th>Articulo</th>
                  <th>Cantidad</th>
                  <th>Neto</th>
                  <th>I.V.A.</th>
                  <th>Total</th>
                  
                  
                </tr>
              </thead>
              <tbody>
              <?php
              $contador = 1;
              
             
                foreach ($detallerecepciones as $a) {
                    
                    
                    echo '<tr>
                    
                          <td>'.$contador.'</td>
                          <td>'.$articulo->GetDescripcionArticuloPorId($a['articulo']).'</td>
                          <td>'.$a['cantidad'].'</td>
                          <td>$'.number_format($a['compra_neto'], 0, ',', '.').'</td>
                          <td>$'.number_format($a['compra_imp'], 0, ',', '.').'</td>
                          <td>$'.number_format($a['compra_neto'] + $a['compra_imp'], 0, ',', '.').'</td>';
                          
                          
                          
                         
                                        
                          echo '</tr>
                          ';
                      $contador++;
                    }
                    
              
              ?>
              
            </tbody>
            
              
            </table>
            <br>
            <br>
                  <form action="VerHistorialArticulosProveedorPDF" method="post" target="_blank">
                    <input type="hidden" name="rut" id="rut" value="<?php echo $_POST['rut']; ?>">
                    <button type="submit"  class="btn  btn-primary btn-lg" name="Ver PDF" value="Ver PDF">Ver PDF</button>
                    </form>
                
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          Articulos comprados al proveedor
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
  
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

  <?php
  
    
  include 'Includes/partials/footer.php';
  
  ?>

