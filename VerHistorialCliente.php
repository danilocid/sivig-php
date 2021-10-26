<?php
$titulo = 'Ver historial cliente';
$idpagina = 3;
include 'includes/partials/header.php';
include 'includes/partials/menu.php';
include 'Controller/VentasController.php';
include 'Controller/ClientesController.php';
include 'Controller/MediosDePagoController.php';
include 'Controller/TipoDocumentoController.php';
include 'Controller/UsuariosController.php';
include 'Controller/ComunasController.php';
include 'Controller/ProvinciasController.php';
include 'Controller/RegionesController.php';
include 'Controller/DetalleVentasController.php';
include 'Controller/ArticulosController.php';

$articulos = new Articulos();

$cliente = new Cliente();
$datoscliente  = $cliente->GetClientesPorRUT($_POST['rut']);
$ventas = new Ventas();
$ventascliente = $ventas->GetVentasPorRut($_POST['rut']);
$mediodepago = new MediosDePago();
$tipodocumento = new TiposDocumentos();
$usuarios = new Usuario();
$comunas = new Comunas();
$comuna = $comunas->GetComunaPorId($datoscliente[0]['comuna']);
$provincias = new Provincias();
$provincia = $provincias->GetProvinciaPorId($datoscliente[0]['provincia']);
$regiones = new Regiones();
$region  = $regiones->GetRegionPorId($datoscliente[0]['region']);
$detalles = new DetallesVentas();
$detalleventas = $detalles->GetDetalleVentasPorRUT($ventascliente);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Historial del cliente</h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Datos del cliente</h3>
  
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
          
         
          echo '<p>RUT: '.$datoscliente[0]['rut'].'</p>';
          echo '<p>Nombre o Razon Social: '.$datoscliente[0]['nombre'].'</p>';
                   echo '<p>Giro: '.$datoscliente[0]['giro'].'</p>';
          echo '<p>Direccion: '.$datoscliente[0]['direccion'].'</p>';
          echo '<p>Comuna: '.$comuna.'</p>';
          echo '<p>Provincia: '.$provincia.'</p>';
          echo '<p>Region: '.$region.'</p>';
          echo '<p>Telefono: '.$datoscliente[0]['telefono'].'</p>';
          echo '<p>Mail: '.$datoscliente[0]['mail'].'</p>';

          
         
        ?>
                
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          Datos del cliente
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Compras del cliente</h3>
  
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
                  <th>Medio de pago</th>
                  <th>Tipo documento</th>
                  <th>N° documento</th>
                  <th>Fecha</th>
                  <th>Usuario</th>
                  
                </tr>
              </thead>
              <tbody>
              <?php
              $contador = 1;
              
              
                foreach ($ventascliente as $a) {
                    $usuario = $usuarios->GetUsuarioPorId($a['usuario']);
                    
                    echo '<tr>
                    
                          <td>'.$contador.'</td>
                          <td>$'.number_format($a['monto_neto'], 0, ',', '.').'</td>
                          <td>$'.number_format($a['monto_imp'], 0, ',', '.').'</td>
                          <td>$'.number_format($a['monto_neto'] + $a['monto_imp'], 0, ',', '.').'</td>
                          <td>'.$mediodepago->GetMediosDePagoPorId($a['medio_pago']).'</td>
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
                  <form action="VerHistorialClientePDF" method="post" target="_blank">
                    <input type="hidden" name="rut" id="rut" value="<?php echo $_POST['rut']; ?>">
                    <button type="submit"  class="btn  btn-primary btn-lg" name="Ver PDF" value="Ver PDF">Ver PDF</button>
                    </form>
                
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          Compras del cliente
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Articulos comprados por el cliente</h3>
  
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
              
              
                foreach ($detalleventas as $a) {
                    
                    
                    echo '<tr>
                    
                          <td>'.$contador.'</td>
                          <td>'.$articulos->GetDescripcionArticuloPorId($a['articulo']).'</td>
                          <td>'.$a['cantidad'].'</td>
                          <td>$'.number_format($a['precio_neto'], 0, ',', '.').'</td>
                          <td>$'.number_format($a['precio_imp'], 0, ',', '.').'</td>
                          <td>$'.number_format($a['precio_neto'] + $a['precio_imp'], 0, ',', '.').'</td>';
                          
                          
                          
                         
                                        
                          echo '</tr>
                          ';
                      $contador++;
                    }
                    
              
              ?>
              
            </tbody>
            
              
            </table>
            <br>
            <br>
                  <form action="VerHistorialArticulosClientePDF" method="post" target="_blank">
                    <input type="hidden" name="rut" id="rut" value="<?php echo $_POST['rut']; ?>">
                    <button type="submit"  class="btn  btn-primary btn-lg" name="Ver PDF" value="Ver PDF">Ver PDF</button>
                    </form>
                
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          Articulos comprados por el cliente
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

