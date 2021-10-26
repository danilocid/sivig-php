<?php
$titulo = 'Ver articulo';
$idpagina = 4;
include 'includes/partials/header.php';
include 'includes/partials/menu.php';
include 'Controller/ArticulosController.php';


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
            <h3 class="card-title">Ver articulo</h3>
  
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
              $articulo = new Articulos();
              $id = $_POST['id'];
              
              $articulos = $articulo->GetArticulosPorId($id);
              
              foreach ($articulos as $c) {
                echo '<div class="col-md-6">';
                echo ' <form role="form" action="EditarArticulo" method="POST">';
                echo '<input id="id" name="id" required type="hidden" class="form-control" value = "'.$c['id'].'">';
               
                echo '<div class ="form-group">
                <label>Codigo interno</label>
                <input required type="text" id="cod_interno" name="cod_interno" class="form-control" value = "'.$c['cod_interno'].'">
                </div>';
                echo '<div class ="form-group">
                <label>Codigo de barras</label>
                <input id="cod_barras" name="cod_barras" required type="text" class="form-control" value = '.$c['cod_barras'].'>
                </div>';
                echo '<div class ="form-group">
                <label>Descripcion</label>
                <input id="descripcion" name="descripcion" required type="text" class="form-control" value = "'.$c['descripcion'].'">
                </div>';
                echo '<div class ="form-group">
                <label>Costo neto</label>
                <input id="precio_compra" name="precio_compra" required type="number" class="form-control" value = "'.$c['costo_neto'].'" disabled="">
                </div>';
                echo '<div class ="form-group">
                <label>Costo impuestos</label>
                <input id="precio_compra" name="precio_compra" required type="number" class="form-control" value = "'.$c['costo_imp'].'" disabled="">
                </div>';
                echo '<div class ="form-group">
                <label>Costo total</label>
                <input id="precio_compra" name="precio_compra" required type="number" class="form-control" value = "'.($c['costo_neto'] + $c['costo_imp']).'" disabled="">
                </div>';
                echo '<div class ="form-group">
                <label>Precio de venta neto</label>
                <input id="venta_neto" oninput="ActualizaValorTotal()" name="venta_neto" required type="number" class="form-control" value = "'.$c['venta_neto'].'">
                </div>';
                
                echo '<div class ="form-group">
                <label>Precio de venta impuestos</label>
                <input id="venta_imp" name="venta_imp" required type="number" class="form-control" value = "'.$c['venta_imp'].'">
                </div>';
                echo '<div class ="form-group">
                <label>Precio de venta total</label>
                <input id="venta_total" oninput="ActualizaValorNeto()" name="venta_total" required type="number" class="form-control" value = "'.($c['venta_neto'] + $c['venta_imp']).'">
                </div>';
                echo '<div class ="form-group">
                <label>Stock</label>
                <input id="stock" name="stock" required type="number" class="form-control" value = "'.$c['stock'].'" disabled="">
                </div>'; 
                echo ' <div class="form-group">
                <label>Activo</label>
                <select id="activo" name="activo" class="form-control">';
                    if ($c['activo'] == 1) {
                      
                      echo '<option selected value=1>Activo</option>
                      <option value=0>Inactivo</option>
                                              
                    </select>
                    </div>';
                    } else {
                     echo '<option value=1>Activo</option>
                      <option selected value=0>Inactivo</option>
                     
                    </select>
                    </div>';
                    }
              }
              ?>
          </div>
    <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal">Editar articulo</button>
    <div class="modal fade" id="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Editar articulo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <p>Seguro que quiere guardar los cambios?&hellip;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
          </form>  
          </div>
                
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          Ver articulo
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
  
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

  
      
  
  <?php
  $script = '<script>
  function ActualizaValorTotal() {
let valor = document.getElementById("venta_neto").value;
//Se actualiza en municipio inm
document.getElementById("venta_total").value = Math.round(valor * 1.19);
document.getElementById("venta_imp").value = Math.round((valor * 1.19) - valor);
}
function ActualizaValorNeto() {
  let valor = document.getElementById("venta_total").value;
  //Se actualiza en municipio inm
  document.getElementById("venta_neto").value = Math.round(valor / 1.19);
  document.getElementById("venta_imp").value = Math.round(valor - (valor / 1.19));
  }
</script>';
  include 'includes/partials/footer.php';
  
  ?>

