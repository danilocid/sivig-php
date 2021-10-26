<?php
Class ArticuloRecepcion{
  public $id;
  public $costo_neto;
  public $costo_imp;
  public $cantidad;
 
}

$titulo = 'Agregar recepcion';
$idpagina = 8;
include 'includes/partials/header.php';
include 'includes/partials/menu.php';
include 'Controller/TipoDocumentoController.php';
include 'Controller/ArticulosController.php';
include 'Controller/ComunasController.php';
include 'Controller/RegionesController.php';
include 'Controller/MediosDePagoController.php';
include 'Controller/ProveedoresController.php';

$tipos = new TiposDocumentos();
$proveedores = new Proveedores();
$medios_de_pago = new MediosDePago();
$articulo = new Articulos();
$monto_total = 0;
$monto_imp = 0;
$monto_neto = 0;
$total_articulos = 0;
$articulos = $articulo->GetArticulos();


?>
<script language="javascript">
			$(document).ready(function(){
				$("#region").change(function () {
 
					$('#provincia').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
					
					$("#region option:selected").each(function () {
						idregion = $(this).val();
						$.post("Controller/GetProvincias.php", { idregion: idregion }, function(data){
              $("#provincia").html(data);
             
						});            
					});
				})
        $("#provincia").change(function () {
 
          $('#comuna').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
 
          $("#provincia option:selected").each(function () {
          idprovincia = $(this).val();
           $.post("Controller/GetComunas.php", { idprovincia: idprovincia }, function(data){
            $("#comuna").html(data);
           
   });            
 });
})
			});
		</script>
    
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Recepcion de mercaderia</h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Carrito</h3>
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
        <strong>Error</strong> Ya existe el proveedor
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
      if($_GET['m'] == 4){
        echo '<div  class="alert alert-info alert-dismissible fade show"  id="alert" role="alert">
        <strong>Exito</strong> Creado con exito el proveedor
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
      if($_GET['m'] == 3){
        echo '<div  class="alert alert-danger alert-dismissible fade show"  id="alert" role="alert">
        <strong>ERROR</strong> Documento ya ingresado en base de datos
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
    }
    
    ?>
            <!-- Inicio contenido -->
            
            
          
            <div class="row">
        
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Busqueda de productos</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <form action="AgregarArticuloRecepcion" method="POST">
                <div class="card-body">
                <div class ="form-group">
                          <label>Articulo</label>
                          <select id="articulo" name="articulo" required class="form-control select2">
                          <option value="" >Buscar articulo</option>
                          <?php
                             
                              
                              foreach ($articulos as $t) {
                                echo '<option value="'.$t['id'].'">'.$t['cod_barras'].' - '.$t['descripcion'].'</option>
                                ';
                              }
                          ?>                
                    </select>
                    
            </div>
                  <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" required  value = 1>
                  </div>
                  <div class="form-group">
                    <label for="costo_neto">Neto (unitario)</label>
                    <input type="number" oninput="ActualizaValorCostoUnitario()" class="form-control" id="costo_neto" name="costo_neto" required >
                  </div>
                  <div class="form-group">
                    <label for="costo_imp">I.V.A. (unitario)</label>
                    <input type="number" class="form-control" id="costo_imp" name="costo_imp" required >
                  </div>
                  <div class="form-group">
                    <label for="costo_total">Total (unitario)</label>
                    <input type="number" oninput="ActualizaValorCostoNetoUnitario()" class="form-control" id="costo_total" name="costo_total" required >
                  </div>
                    </div>
                 
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Agregar</button>
                   
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#crear-articulo">
                    Crear articulo </button>
           
                </div>
              </form>
            </div>
            <!-- /.card -->


          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-8">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Carrito</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="tabla2" class="table table-bordered table-striped">
              <thead>
                <tr>
                 
                  <th>Codigo</th>
                  
                  <th>Descripcion</th>
                  
                  <th style="width: 90px">Neto</th>
                  <th style="width: 90px">I.V.A.</th>
                  <th style="width: 90px">Total</th>
                  <th style="width: 60px">Cantidad</th>
                  <th style="width: 60px">Actualizar</th>
                  <th style="width: 60px">Eliminar</th>
                </tr>
              </thead>
              <tbody>
              <?php

               if (isset($_SESSION['articulo'])) {
                 
                foreach ($_SESSION['articulo'] as $a) {
                $articuloventa = $articulo->GetArticulosPorId($a->id);
                
                echo '<tr>
                   
                    <td>'.$articuloventa[0]['cod_interno'].'</td>
                    ';
                    echo'<td>'.$articuloventa[0]['descripcion'].'</td>';
                    echo '<td>
                    <form action="ActualizarArticuloRecepcion" method="POST">
                    <input class="form-control input-sm" type="text" readonly name="costo_neto_t" required value="'.$a->costo_neto.'">
                    </td>';
                    echo '<td>
                    <input class="form-control input-sm" type="text" readonly name="costo_imp_t" required value="'.$a->costo_imp.'">
                    </td>';
                    echo '<td>
                    <input class="form-control input-sm"  type="text" readonly name="total" required value="'.($a->costo_imp + $a->costo_neto) * $a->cantidad .'">
                    </td>';
                     echo '<td>
                    <input class="form-control input-sm" type="number" name="cantidad" required value="'.$a->cantidad.'">
                    </td>';
                    echo '<td>
                    
                    <input type="hidden" name="id" value="'.$a->id.'">
                    
                    <button type="submit" class="btn btn-block btn-primary btn-sm" name="Actualizar" value="Actualizar">Actualizar</button>
                    </form>
                    </td>';
                    echo '<td>
                    <form action="EliminarArticuloRecepcion" method="POST">
                    <input type="hidden" name="id" value="'.$a->id.'">
                    
                    <button type="submit" class="btn btn-block btn-primary btn-sm" name="Eliminar" value="Eliminar">Eliminar</button>
                    </form>
                    </td>';
                                  
                    echo '</tr>
                    ';
                
              }
            }
              ?>
            </tbody>
            
              
            </table>
            </br>
            <?php
            if (isset($_SESSION['articulo'])) {
            foreach ($_SESSION['articulo'] as $a) {
              $monto_total = $monto_total + (($a->costo_imp + $a->costo_neto) * $a->cantidad );
              $total_articulos = $total_articulos + $a->cantidad;
              $monto_neto = $monto_neto + ($a->costo_neto * $a->cantidad);
              $monto_imp = $monto_imp + ($a->costo_imp * $a->cantidad);
              
            }
            echo '
            <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                  <label>Monto total</label>
                  <input id="monto_total" name="monto_total" disabled type="text" class="form-control input-sm" value="$'.number_format($monto_total, 0, ',', '.').'">
                  <input id="monto_total" name="monto_total" type="hidden" class="form-control input-sm" value="'.$monto_total.'">
              </div>
            </div>';
            echo '<div class="col-md-3">
              <div class="form-group">
                  <label>Total articulos</label>
                  <input id="total_articulos" name="total_articulos" disabled type="text" class="form-control input-sm" value="'.number_format($total_articulos, 0, ',', '.').'">
              </div>
            </div>';
            echo '</div>
           <div class="row">
            <div class="col-md-4">
          <br>
            <div>
            <button type="button" class="btn  btn-lg btn-info" data-toggle="modal" data-target="#modal-default">
                    Finalizar recepcion
                  </button>
            </div>
            </br>
            </div>';
          }
          
          ?>
          <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                  <h4 class="modal-title">Finalizar recepcion</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    
                  </div>
                  <div class="modal-body">
                    <form role="form" action="AgregarRecepciones" method="POST">        
                       
                        <div class ="form-group">
                          <label>Tipo documento</label>
                          <select id="tipo_documento" name="tipo_documento" class="form-control select2">
                          <?php
                             
                              $tipo = $tipos->GetTiposDocumentos();
                              foreach ($tipo as $t) {
                                echo '<option value="'.$t['id'].'">'.$t['tipo'].'</option>
                                ';
                              }
                          ?>                
                          </select>
                   
                        </div>
                        <div class ="form-group">
                          <label>Numero documento</label>
                          <input id="numero_documento" name="numero_documento" required type="number" class="form-control input-sm">
                        </div>
                        <div class ="form-group">
                          <label>Proveedor</label>
                          <select id="proveedor" name="proveedor" required class="form-control select2">
                          <option value="">Seleccionar</option>
                          <?php
                            $proveedor = $proveedores->GetProveedores();
                            foreach ($proveedor as $t) {
                              echo '<option value="'.$t[0].'">'.$t[1].' ('.$t[0].')</option>
                              ';
                            }
                          ?>                
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Observaciones</label>
                          <input id="observaciones" required name="observaciones" type="text" class="form-control input-sm" value="">
                        </div> 
                        <div class ="form-group">
                          <label>Monto total</label>
                          <input id="monto_total" name="monto_total" disabled type="text" class="form-control input-sm" value="$<?php echo number_format($monto_total, 0, ',', '.'); ?>">
                          <input id="monto_neto" name="monto_neto" type="hidden" class="form-control input-sm" value="<?php echo $monto_neto; ?>">
                          <input id="monto_imp" name="monto_imp" type="hidden" class="form-control input-sm" value="<?php echo $monto_imp; ?>">
                        </div>
                             
                        <div class="form-group">
                          <label>Total articulos</label>
                          <input id="total_articulos" name="total_articulos" readonly type="text" class="form-control input-sm" value="<?php echo number_format($total_articulos, 0, ',', '.'); ?>">
                        </div>           
                        
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar recepcion</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#modal-default2">
                    Crear proveedor
                  </button>
                          </form>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              </div>
              <!-- /.card-body -->
          
          
              </div>
                
           
          <!-- /.card-body -->
          <div class="card-footer">
         Carrito
          </div>
          <!-- /.card-footer-->
        
          <div class="modal fade" id="crear-articulo">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Crar articulo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <form role="form" action="AgregarArticulo" method="POST">        
                        <div class ="form-group">
                          <label>Codigo interno</label>
                          <input id="cod_interno" name="cod_interno" required type="text" class="form-control form-control-sm">
                        </div>
                        <div class ="form-group">
                          <label>Codigo de barras</label>
                          <input required type="text" id="cod_barras" name="cod_barras" class="form-control form-control-sm">
                        </div>
                        <div class ="form-group">
                          <label>Descripcion</label>
                          <input id="descripcion" name="descripcion" required type="text" class="form-control form-control-sm">
                        </div>
                        <div class ="form-group">
                          <label>Costo neto</label>
                          <input id="c_costo_neto" name="c_costo_neto" oninput="ActualizaValorCostoTotal()" required type="number" class="form-control form-control-sm">
                        </div>
                        <div class ="form-group">
                          <label>Costo impuestos</label>
                          <input id="c_costo_imp" name="c_costo_imp" readonly  type="number" class="form-control form-control-sm">
                        </div>
                        <div class ="form-group">
                          <label>Costo total</label>
                          <input id="c_costo_total" name="c_costo_total" oninput="ActualizaValorCostoNeto()" required type="number" class="form-control form-control-sm">
                        </div>

                        <div class ="form-group">
                          <label>Precio de venta neto</label>
                          <input id="c_venta_neto" name="c_venta_neto" oninput="ActualizaValorVentaTotal()" required type="number" class="form-control input-sm">
                          <input id="stock" name="stock" hidden required type="number" value="0" class="form-control hidden input-sm">
                          <input id="pagina" name="pagina" hidden required type="text" value="AgregarRecepcion" class="form-control hidden input-sm">
                        </div>
                        <div class ="form-group">
                          <label>Precio de venta impuestos</label>
                          <input id="c_venta_imp" name="c_venta_imp"  readonly type="number" class="form-control form-control-sm">
                        </div>
                        <div class ="form-group">
                          <label>Precio de venta total</label>
                          <input id="c_venta_total" name="c_venta_total" oninput="ActualizaValorVentaNeto()" required type="number" class="form-control form-control-sm">
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
                    </form>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              </div>
                   
                  
              <div class="modal fade" id="modal-default2" style="overflow-y: scroll;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    
                    <h4 class="modal-title">Crear proveedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <form role="form" action="AgregarProveedor" method="POST">        
                        <div class ="form-group">
                          <label>Nombre o Razon Social</label>
                          <input id="nombre" name="nombre" required type="text" class="form-control input-sm">
                        </div>                        
                        <div class ="form-group">
                          <label>RUT</label>
                          <input id="rut" name="rut" required type="text" oninput="checkRut(this)" class="form-control input-sm">
                        </div>
                        <div class ="form-group">
                          <label>Giro</label>
                          <input id="giro" name="giro" required type="text" class="form-control input-sm">
                        </div>
                        <div class ="form-group">
                          <label>Direccion</label>
                          <input id="direccion" name="direccion" required type="text" class="form-control input-sm">
                        </div>
                        
                        <div class="form-group">
                          <label>Region</label>
                          <select id="region" name="region" required class="form-control input-sm">
                          <option value=''>Seleccionar Region</option>
                            <?php
                            $region = new Regiones();
                            $regiones = $region->GetRegiones();
                            foreach ($regiones as $r) {
                              echo '<option value=' . $r->id . '>' . $r->region . '</option>';
                            }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Provincia</label>
                          <select id="provincia" name="provincia" required class="form-control input-sm">
                            
                          </select>
                        </div>  
                        <div class="form-group">
                          <label>Comuna</label>
                          <select id="comuna" name="comuna" required class="form-control input-sm">
                            
                          </select>
                        </div> 
                        <div class ="form-group">
                          <label>Telefono</label>
                          <input id="telefono" name="telefono" required type="number"  min="111111111" max="999999999"  class="form-control input-sm">
                        </div>     
                        <div class ="form-group">
                          <label>Mail</label>
                          <input id="mail" name="mail" required type="email" class="form-control input-sm">
                        </div>          
                        
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar proveedor</button>
                          </form>
                  </div>
                </div>
                <!-- /.modal-content -->
                </div>
              </div>
            </div>
          </div>
            </div>
          </div>
      </div>
      </section>
</div>
              <!-- /.modal-dialog -->
              
                
            <!-- Fin contenido -->
          
       

         <!-- Default box -->
     
  
  <?php
  
 

  $script = '<script>
  $("#alert").on("closed.bs.alert", function () {
    window.location="./AgregarRecepcion";  
  });
  
function ActualizaValorCostoTotal() {
  let valor = document.getElementById("c_costo_neto").value;
  //Se actualiza en municipio inm
  document.getElementById("c_costo_total").value = Math.round(valor * 1.19);
  document.getElementById("c_costo_imp").value = Math.round((valor * 1.19) - valor);
  }
function ActualizaValorCostoNeto() {
  let valor = document.getElementById("c_costo_total").value;
  //Se actualiza en municipio inm
  document.getElementById("c_costo_neto").value = Math.round(valor / 1.19);
  document.getElementById("c_costo_imp").value = Math.round(valor - (valor / 1.19));
  }
function ActualizaValorCostoUnitario() {
  let valor = document.getElementById("costo_neto").value;
  //Se actualiza en municipio inm
  document.getElementById("costo_total").value = Math.round(valor * 1.19);
  document.getElementById("costo_imp").value = Math.round((valor * 1.19) - valor);
  }
function ActualizaValorCostoNetoUnitario() {
  let valor = document.getElementById("costo_total").value;
  //Se actualiza en municipio inm
  document.getElementById("costo_neto").value = Math.round(valor / 1.19);
  document.getElementById("costo_imp").value = Math.round(valor - (valor / 1.19));
  }
</script>';

  include 'includes/partials/footer.php';
  
  ?>

