<?php
Class ArticuloVenta{
  public $id;
  public $venta_neto;
  public $venta_imp;
  public $cantidad;
  public $total;
 
}

$titulo = 'Agregar venta';
$idpagina = 7;
include 'includes/partials/header.php';
include 'includes/partials/menu.php';
include 'Controller/TipoDocumentoController.php';
include 'Controller/ArticulosController.php';
include 'Controller/ClientesController.php';
include 'Controller/ComunasController.php';
include 'Controller/RegionesController.php';
include 'Controller/MediosDePagoController.php';



$tipos = new TiposDocumentos();

$clientes = new Cliente();
$medios_de_pago = new MediosDePago();
$monto_total = 0;
$total_articulos = 0;
$articulo = new Articulos();
$articulos = $articulo->GetArticulos();


?>
<script language="javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		
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
        $("#tipo_documento").change(function () {
        
        $("#tipo_documento option:selected").each(function () {
          tipo_documento = $(this).val();
          var inputnumero = document.getElementById("numero_documento");
          $.post("Controller/GetSiguienteDocumento.php", { tipo_documento: tipo_documento }, function(data){
            inputnumero.value = data;
            
          });            
        });
        })
        $("#articulo").change(function () {
 
               $("#articulo option:selected").each(function () {
              id = $(this).val();
              var inputNombre = document.getElementById("precioventa");

              $.post("Controller/GetPrecioDeVenta.php", { id: id }, function(data){
                inputNombre.value = data;
                
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
              <h1>Agregar venta</h1>
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
        <strong>Error</strong> Ya existe el cliente
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
        
      }
      if($_GET['m'] == 2){
        echo '<div  class="alert alert-info alert-dismissible fade show"  id="alert" role="alert">
        <strong>Exito</strong> Creado con exito el cliente
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
      if($_GET['m'] == 3){
        echo '<div  class="alert alert-danger alert-dismissible fade show"  id="alert" role="alert">
        <strong>ERROR</strong> Numero de documento ya existe
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
              
              <form action="AgregarArticuloVenta" method="POST">
                <div class="card-body">
                <div class ="form-group">
                          <label>Articulo</label>
                          <select id="articulo" name="articulo" class="form-control select2">
                          <option>Buscar articulo</option>
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
                    <label for="precioventa">Precio</label>
                    <input type="number" class="form-control" id="precioventa" name="precioventa" required >
                    </div>
                    </div>
                 
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Agregar</button>
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
                  
                  <th style="width: 90px">Precio de venta</th>
                  <th style="width: 60px">Cantidad</th>
                  <th style="width: 60px">Actulizar</th>
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
                    <form action="ActualizarArticuloVenta" method="POST">
                    <input class="form-control input-sm" type="number" name="precio_venta" required value="'.($a->venta_neto + $a->venta_imp).'">
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
                    <form action="EliminarArticuloVenta" method="POST">
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
              $monto_total = $monto_total + $a->total;
              $total_articulos = $total_articulos + $a->cantidad;
              
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
            <div class="col-md-3">
          <br>
            <div class="float-right">
            <button type="button" class="btn  btn-lg btn-info" data-toggle="modal" data-target="#modal-default">
                    Finalizar venta
                  </button>
            </div>
            </div>';
          }
          
          ?>
          <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                  <h4 class="modal-title">Finalizar venta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    
                  </div>
                  <div class="modal-body">
                    <form role="form" action="AgregarVentas" method="POST">        
                       
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
                          <label>Medio de pago</label>
                          <select id="mediopago" name="mediopago" class="form-control select2">
                          <?php
                              $medio = $medios_de_pago->GetMediosDePago();
                              foreach ($medio as $m) {
                                echo '<option value="'.$m['id'].'">'.$m['medio_de_pago'].'</option>
                                ';
                              }?>                
                          </select>
                        </div>
                        <div class ="form-group">
                          <label>Cliente</label>
                          <select id="cliente" name="cliente" class="form-control select2">
                          <?php
                            $cliente = $clientes->GetClientes();
                            foreach ($cliente as $t) {
                              echo '<option value="'.$t[0].'">'.$t[1].' '.$t[2].' ('.$t[0].')</option>
                              ';
                            }
                          ?>                
                          </select>
                        </div>
                        <div class ="form-group">
                          <label>Monto total</label>
                          <input id="monto_total" name="monto_total" disabled type="text" class="form-control input-sm" value="$<?php echo number_format($monto_total, 0, ',', '.'); ?>">
                          <input id="monto_total" name="monto_total" type="hidden" class="form-control input-sm" value="<?php echo $monto_total; ?>">
                        </div>
                             
                        <div class="form-group">
                          <label>Total articulos</label>
                          <input id="total_articulos" name="total_articulos" disabled type="text" class="form-control input-sm" value="<?php echo number_format($total_articulos, 0, ',', '.'); ?>">
                        </div>           
                        
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar venta</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#modal-default2">
                    Agregar cliente
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
        

                   
                  
                  <div class="modal fade" id="modal-default2" style="overflow-y: scroll;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    
                    <h4 class="modal-title">Agregar cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <form role="form" action="AgregarCliente" method="POST">        
                        <div class ="form-group">
                          <label>Nombre o Razon Social</label>
                          <input id="nombre" name="nombre" required type="text" class="form-control input-sm">
                          <input id="enlace" name="enlace" type="hidden"  value="AgregarVenta" class="form-control input-sm">
                        </div>
                       
                        <div class ="form-group">
                          <label>RUT</label>
                          <input id="rut" name="rut" required oninput="checkRut(this)" type="text" class="form-control input-sm">
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
                          <option value="">Selecciona</option>
                            <?php
                            $region = new Regiones();
                            $regiones = $region->GetRegiones();
                            foreach ($regiones as $r) {
                              echo '<option value=' . $r->id . '>' . $r->region . '</option>
                              '."\n";
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
                          <label>Telefno</label>
                          <input id="telefono" name="telefono" required type="number" min="111111111" max="999999999" class="form-control input-sm">
                        </div>     
                        <div class ="form-group">
                          <label>Mail</label>
                          <input id="mail" name="mail" required type="email" class="form-control input-sm">
                        </div>          
                        
                          </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar cliente</button>
                  </div>
                </div>
                </div>
                </div>
                </div>
                <!-- /.modal-content -->
            
              <!-- /.modal-dialog -->
                 
                
            <!-- Fin contenido -->
          
          </div>
          </div>
         <!-- Default box -->
         </div>
         </div>
      </section>
</div>
  
  <?php
  
  $script = "<script type='text/javascript'>
  $('#alert').on('closed.bs.alert', function () {
    window.location='./AgregarVenta';  
  });
  
  </script>";
  include 'includes/partials/footer.php';
  
  ?>

