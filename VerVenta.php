<?php
$titulo = 'Ver detalle venta';
$idpagina = 6;
include 'Includes/partials/header.php';
include 'Includes/partials/menu.php';
include 'Controller/TipoDocumentoController.php';
include 'Controller/UsuariosController.php';
include 'Controller/VentasController.php';
include 'Controller/ArticulosController.php';
include 'Controller/ClientesController.php';
include 'Controller/DetalleVentasController.php';


$tipos = new TiposDocumentos();
$articulos = new Articulos();
$ventas  = new Ventas();
$usuarios = new Usuario;
$venta = $ventas->GetVentasPorId($_POST['id']);
$clientes = new Cliente();
$detallesventas =  new DetallesVentas();
$detalleventa = $detallesventas->GetDetalleVentaPorId($_POST['id']);


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Detalle venta</h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Resumen venta</h3>
  
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
          
         
          echo '<p>Cliente: '.$clientes->GetNombreClientePorRut($venta[0]['cliente']).'</p>';
          echo '<p>Documento: '.$tipos->GetTiposDocumentosPorId($venta[0]['tipo_documento']).' N°: '.$venta[0]['documento'].'</p>';
          echo '<p>Monto neto: $' .number_format($venta[0]['monto_neto'], 0, ',', '.').'</p>';
          echo '<p>Monto impuestos: $' .number_format($venta[0]['monto_imp'], 0, ',', '.').'</p>';
        echo '<p>Monto total: $' .number_format($venta[0]['monto_neto'] + $venta[0]['monto_imp'], 0, ',', '.').'</p>';
        echo '<p>Fecha de venta: ' .$venta[0]['fecha'].'</p>';
        $usuario = $usuarios->GetUsuarioPorId($venta[0]['usuario']);
        echo '<p>Usuario: ' .$usuario[0]['Nombre'].' '.$usuario[0]['Apellidos'].'</p>';
     
      
      ?>
                
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
         Resumen venta
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Articulos vendidos</h3>
  
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
                  <th>Impuesto</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                  
                </tr>
              </thead>
              <tbody>
              <?php
              $contador = 1;
              //print_r($_SESSION['articulo']);
              
                foreach ($detalleventa as $a) {
                    echo '<tr>
                          <td>'.$contador.'</td>
                          <td>'.$articulos->GetDescripcionArticuloPorId($a['articulo']).'</td>
                          <td> $'.number_format($a['precio_neto'], 0, ',', '.').'</td>
                          <td> $'.number_format($a['precio_imp'], 0, ',', '.').'</td>
                          
                          <td>'.$a['cantidad'].'</td>
                          <td> $'.number_format(($a['precio_neto'] + $a['precio_imp']) * $a['cantidad'], 0, ',', '.').'</td>';
                          
                          
                         
                                        
                          echo '</tr>
                          ';
                      $contador++;
                    }
                    
              
              ?>
              
            </tbody>
            
              
            </table>
            <br>
                  <form action="VerVentaPDF" method="post" target="_blank">
                    <input type="hidden" name="id" id="id" value="<?php echo $_POST['id']; ?>">
                    <button type="submit"  class="btn  btn-primary btn-lg" name="Ver PDF" value="Ver PDF">Ver PDF</button>
                    </form> 
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
  
    
  include 'Includes/partials/footer.php';
  
  ?>

