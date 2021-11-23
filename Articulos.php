<?php
$titulo = 'Articulos';
$idpagina = 4;
include 'Includes/partials/header.php';
include 'Includes/partials/menu.php';
include 'Controller/ArticulosController.php';


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
            <h3 class="card-title">Articulos</h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
          <?php
     //mensajes de informacion
     if (isset($_GET['m'])) {
      if($_GET['m'] == 1){
        echo '<div  class="alert alert-danger alert-dismissible fade show"  id="alert" role="alert">
        <strong>Error</strong> Ya existe el articulo
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
        
      }
      if($_GET['m'] == 2){
        echo '<div  class="alert alert-info alert-dismissible fade show"  id="alert" role="alert">
        <strong>Exito</strong> Creado con exito el articulo
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
      if($_GET['m'] == 3){
        echo '<div  class="alert alert-info alert-dismissible fade show"  id="alert" role="alert">
        <strong>Exito</strong> Los cambios fueron guardados con exito
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
    }
    if (isset($_GET['o'])) {
      $articulo = new Articulos();
      $articulos = $articulo->GetArticulos();
      echo '<div class="float-left">
      <a href="Articulos" class="btn  btn-md btn-info">ocultar articulos sin stock</a>
      </div>';
    }else{
      $articulo = new Articulos();
      $articulos = $articulo->GetArticulosSinStock();
      echo '<div class="float-left">
      <a href="Articulos?o=1" class="btn  btn-md btn-info">mostrar articulos sin stock</a>
      </div>';
    }

    
    ?>
            <!-- Inicio contenido -->
            
            
            <br>
            <table id="tabla1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 20px">Id</th>
                  <th>Codigo interno</th>
                  <th>Codigo de barras</th>
                  <th>Descripcion</th>
                  <th>Stock</th>
                  <th style="width: 60px">Editar Articulo</th>
                  <th style="width: 60px">Historial</th>
                </tr>
              </thead>
              <tbody>
              <?php
              //$articulo = new Articulos();
              //$articulos = $articulo->GetArticulos();
            
              foreach ($articulos as $c) {
                
              echo '<tr>
                    <td>'.$c['id'].'</td>
                    <td>'.$c['cod_interno'].'</td>
                    
                    <td>'.$c['cod_barras'].'</td>
                    <td>'.$c['descripcion'].'</td>
                    <td>'.$c['stock'].'</td>';
                    
                    echo '<td>
                    <form action="VerArticulo" method="POST">
                    <input type="hidden" name="id" value="'.$c['id'].'">
                    <button type="submit" class="btn btn-block btn-primary btn-sm" name="Editar" value="Editar">Editar</button>
                    </form>
                    </td>';
                    echo '<td>
                    <form action="VerHistorialArticulo" method="POST">
                    <input type="hidden" name="id" value="'.$c['id'].'">
                    
                    <button type="submit" class="btn btn-block btn-primary btn-sm" name="Historial" value="Historial">Historial</button>
                    </form>
                    </td>';
                                  
                    echo '</tr>
                    ';
                
              }
              ?>
            </tbody>
            
              
            </table>
            <br>
            <div class="float-right">
            <button type="button" class="btn  btn-lg btn-info" data-toggle="modal" data-target="#modal-default">
                    Agregar articulo
                  </button>
            </div>
            
            <div class="float-left">
            <a href="ArticulosPDF" target="_blank" class="btn  btn-lg btn-info pull-left">Ver PDF</a>
            </div>
            
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          Articulos
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Agregar articulo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <form role="form" action="AgregarArticulo" method="POST">        
                        <div class ="form-group">
                          <label>Codigo interno</label>
                          <input id="cod_interno" name="cod_interno" required type="text" class="form-control input-sm">
                        </div>
                        <div class ="form-group">
                          <label>Codigo de barras</label>
                          <input required type="text" id="cod_barras" name="cod_barras" class="form-control input-sm">
                        </div>
                        <div class ="form-group">
                          <label>Descripcion</label>
                          <input id="descripcion" name="descripcion" required type="text" class="form-control input-sm">
                        </div>
                        <div class ="form-group">
                          <label>Precio de venta neto</label>
                          <input id="c_venta_neto" oninput="ActualizaValorTotal()" name="c_venta_neto" required type="number" class="form-control input-sm">
                          <input id="stock" name="stock" hidden  type="number" value="0" class="form-control hidden input-sm">
                          <input id="c_costo_neto" name="c_costo_neto" hidden  type="number" value="0" class="form-control hidden input-sm">
                          <input id="c_costo_imp" name="c_costo_imp" hidden  type="number" value="0" class="form-control hidden input-sm">
                          <input id="enlace" name="enlace" hidden  type="text" value="Articulos" class="form-control hidden input-sm">
                        </div>
                        <div class ="form-group">
                          <label>I.V.A.</label>
                          <input id="c_venta_imp" name="c_venta_imp" required readonly type="text" class="form-control input-sm">
                        </div>
                        <div class ="form-group">
                          <label>Precio de venta total</label>
                          <input id="c_venta_total" oninput="ActualizaValorNeto()" name="c_venta_total" required  type="number" class="form-control input-sm">
                        </div>
                        <div class="form-group">
                          <label>Activo</label>
                          <select id="activo" name="activo" class="form-control input-sm">
                            <option value=1>Activo</option>
                            <option value=0>Inactivo</option>
                          </select>
                        </div>           
                        
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar articulo</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

 
            
              
                 
  <?php
  $script = '<script>
  function ActualizaValorTotal() {
let valor = document.getElementById("c_venta_neto").value;
document.getElementById("c_venta_total").value = Math.round(valor * 1.19);
document.getElementById("c_venta_imp").value = Math.round((valor * 1.19) - valor);
}
function ActualizaValorNeto() {
  let valor = document.getElementById("c_venta_total").value;
  document.getElementById("c_venta_neto").value = Math.round(valor / 1.19);
  document.getElementById("c_venta_imp").value = Math.round(valor - (valor / 1.19));
  }
</script>
<script type="text/javascript">
  $("#alert").on("closed.bs.alert", function () {
    window.location="./Articulos";  
  });
  
  </script>';
  
  include 'Includes/partials/footer.php';
  
  ?>

