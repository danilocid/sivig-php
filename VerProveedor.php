<?php
$titulo = 'Ver proveedor';
$idpagina = 2;
include 'includes/partials/header.php';
include 'includes/partials/menu.php';
include 'Controller/ProveedoresController.php';
include 'Controller/ComunasController.php';
include 'Controller/RegionesController.php';
include 'Controller/ProvinciasController.php';

?>
<script language="javascript" src="js/jquery-3.1.1.min.js"></script>
		
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
              <h1>Proveedores</h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Ver datos proveedor</h3>
  
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
              $proveedor = new Proveedores();
              $rut = $_POST['rut'];
              
              $proveedores = $proveedor->GetProveedorPorRut($rut);
              $comuna = new Comunas;
              foreach ($proveedores as $c) {
                echo '<div class="col-md-6">';
                echo ' <form role="form" action="EditarProveedor" method="POST">';
                echo '<div class ="form-group">
                <label>Nombre o Razon Social</label>
                <input id="nombre" name="nombre" required type="text" class="form-control" value = "'.$c['nombre'].'">
                </div>';
                echo '<div class ="form-group">
                <label>RUT</label>
                <input id="rut" name="rut" readonly type="text" class="form-control" value = '.$c['rut'].'>
                </div>';
                echo '<div class ="form-group">
                <label>Giro</label>
                <input id="giro" name="giro" required type="text" class="form-control" value = "'.$c['giro'].'">
                </div>';
                echo '<div class ="form-group">
                <label>Direccion</label>
                <input id="direccion" name="direccion" required type="text" class="form-control" value = "'.$c['direccion'].'">
                </div>';
                echo '<div class="form-group">
                <label>Region</label>
                <select id="region" name="region" required class="form-control">';
                  
                  $region = new Regiones();
                  $regiones = $region->GetRegiones();
                  foreach ($regiones as $r) {
                      if ($r->id == $c['region']) {
                        echo '<option value="' . $r->id . '" selected >' . $r->region . '</option>';
                      } else {
                        echo '<option value=' . $r->id . '>' . $r->region . '</option>';
                      }
                  }
                echo '</select>
                </div>';
                echo '<div class="form-group">
                <label>Provincia</label>
                <select id="provincia" name="provincia" required class="form-control">';
                  
                  $provincia = new Provincias();
                  $provincias = $provincia->GetProvinciasPorRegion($c['region']);
                  foreach ($provincias as $p) {
                      if ($p->id == $c['provincia']) {
                        echo '<option value="' . $p->id . '" selected >' . $p->provincia . '</option>';
                      } else {
                        echo '<option value=' . $p->id . '>' . $p->provincia . '</option>';
                      }
                    }
                echo '</select>
                </div>';
                echo '<div class="form-group">
                <label>Comuna</label>
                <select id="comuna" name="comuna" required class="form-control">';
                  
                  $comuna = new Comunas();
                  $comunas = $comuna->GetComunaPorProvincia($c['provincia']);
                  foreach ($comunas as $p) {
                      if ($p->Id == $c['comuna']) {
                        echo '<option value="' . $p->Id . '" selected >' . $p->Comuna . '</option>';
                      } else {
                        echo '<option value=' . $p->Id . '>' . $p->Comuna . '</option>';
                      }
                  }
                  
                echo '</select>
                </div>';
                echo '<div class ="form-group">
                <label>Telefono</label>
                <input id="telefono" name="telefono" required type="number" class="form-control" value ="'.$c['telefono'].'">
                </div>';
                echo '<div class ="form-group">
                <label>Mail</label>
                <input id="mail" name="mail" required type="email" class="form-control" value = "'.$c['mail'].'">
                </div>';
              }
              ?>
          </div>
                        
                        
                               
                        
                    
                  
          
    
    <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal">Editar proveedor</button>
    <div class="modal fade" id="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Modificar proveedor</h4>
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
          Ver datos proveedor
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

