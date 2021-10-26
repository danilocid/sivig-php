<?php
$titulo = 'Ver historial articulo';
$idpagina = 4;
include 'includes/partials/header.php';
include 'includes/partials/menu.php';
include 'Controller/ArticulosController.php';
include 'Controller/MovimientosArticulosController.php';
include 'Controller/TipoMovimientoController.php';
include 'Controller/UsuariosController.php';
$articulos = new Articulos();
$articulo = $articulos->GetArticulosPorId($_POST['id']);
$movimientos = new MovimientosArticulos();
$detallemovimiento = $movimientos->GetMovimientosPorArticulo($_POST['id']);
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
              <h1>Administracion de articulos</h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Informacion del articulo</h3>
  
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
          
         
          echo '<p>Id: '.$articulo[0]['id'].'</p>';
          echo '<p>Codigo interno: '.$articulo[0]['cod_interno'].'</p>';
          echo '<p>Codigo de barras: ' .$articulo[0]['cod_barras'].'</p>';
          echo '<p>Descripcion: ' .$articulo[0]['descripcion'].'</p>';
          echo '<p>Precio de compra neto: $' .number_format($articulo[0]['costo_neto'], 0, ',', '.').'</p>';
          echo '<p>Precio de compra impuestos: $' .number_format($articulo[0]['costo_imp'], 0, ',', '.').'</p>';
          echo '<p>Precio de venta neto: $' .number_format($articulo[0]['venta_neto'], 0, ',', '.').'</p>';
          echo '<p>Precio de venta impuetos: $' .number_format($articulo[0]['venta_imp'], 0, ',', '.').'</p>';
          echo '<p>Precio de venta total: $' .number_format(($articulo[0]['venta_neto'] + $articulo[0]['venta_imp']), 0, ',', '.').'</p>';
          echo '<p>Stock: ' .number_format($articulo[0]['stock'], 0, ',', '.').'</p>';
          if ($articulo[0]['activo']) {
              echo '<p>Estado: Activo</p>';
          } else {
              echo '<p>Estado: Inactivo</p>';
          }
         
        ?>
                
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
         Informacion del articulo
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Historial del articulo</h3>
  
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
                  <th>Movimiento</th>
                  <th>Unidades</th>
                  <th>Fecha</th>
                  <th>Usuario</th>
                  
                </tr>
              </thead>
              <tbody>
              <?php
              $contador = 1;
              
              
                foreach ($detallemovimiento as $a) {
                  $nombreusuario = $usuario->GetUsuarioPorId($a['usuario']);
                    echo '<tr>
                          <td>'.$contador.'</td>
                          <td>'.$articulos->GetDescripcionArticuloPorId($a['articulo']).'</td>
                          <td>'.$tipomovimiento->GetTiposMovimientosId($a['movimiento']).'</td>
                          <td>'.number_format($a['unidades'], 0, ',', '.').'</td>
                          <td>'.$a['fecha'].'</td>
                          <td>'.$nombreusuario[0]['Nombre'].' '.$nombreusuario[0]['Apellidos'].'</td>';
                          
                          
                         
                                        
                          echo '</tr>
                          ';
                      $contador++;
                    }
                    
              
              ?>
              
            </tbody>
            
              
            </table>
            <br>
              
                  <br>
                  <br>
                  <br>
                  <form action="VerHistorialArticuloPDF" method="post" target="_blank">
                    <input type="hidden" name="id" id="id" value="<?php echo $_POST['id']; ?>">
                    <button type="submit"  class="btn  btn-primary btn-lg" name="Ver PDF" value="Ver PDF">Ver PDF</button>
                    </form>
                
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          Historial del articulo
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

