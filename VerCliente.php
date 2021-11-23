<?php
$titulo = 'Ver cliente';
$idpagina = 3;
include 'Includes/partials/header.php';
include 'Includes/partials/menu.php';
include 'Controller/ClientesController.php';
include 'Controller/ComunasController.php';
include 'Controller/RegionesController.php';
?>
<script language="javascript" src="js/jquery-3.1.1.min.js"></script>

<script language="javascript">
  $(document).ready(function() {
    $("#region").change(function() {

      $('#comuna').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

      $("#region option:selected").each(function() {
        idregion = $(this).val();
        $.post("Controller/GetComunas.php", {
          idregion: idregion
        }, function(data) {
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
          <h1>Administracion de clientes</h1>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Editar cliente</h3>

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
        $cliente = new Cliente();
        $rut = $_POST['rut'];

        $clientes = $cliente->GetClientesPorRut($rut);
        $comuna = new Comunas;
        foreach ($clientes as $c) {
          echo '<div class="col-md-6">';
          echo ' <form role="form" action="EditarCliente" method="POST">';
          echo '<div class ="form-group">
                <label>Nombre o Razon Social</label>
                <input id="nombre" name="nombre" required type="text" class="form-control" value = "' . $c['nombre'] . '">
                </div>';

          echo '<div class ="form-group">
                <label>RUT</label>
                <input id="rut" name="rut" required type="text" disabled class="form-control" value = ' . $c['rut'] . '>
                <input id="rut" name="rut" required type="hidden" class="form-control" value = ' . $c['rut'] . '>
                </div>';
          echo '<div class ="form-group">
                <label>Giro</label>
                <input id="giro" name="giro" required type="text" class="form-control" value = "' . $c['giro'] . '">
                </div>';
          echo '<div class ="form-group">
                <label>Direccion</label>
                <input id="direccion" name="direccion" required type="text" class="form-control" value = "' . $c['direccion'] . '">
                </div>';
          echo '<div class="form-group">
                <label>Region</label>
                <select id="region" name="region" class="form-control">';

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
                <label>Comuna</label>
                <select id="comuna" name="comuna" class="form-control">';

          $comuna = new Comunas();
          $comunas = $comuna->GetComunaPorRegion($c['region']);
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
                <input id="telefono" name="telefono" required type="number"  class="form-control" value ="' . $c['telefono'] . '">
                </div>';
          echo '<div class ="form-group">
                <label>Mail</label>
                <input id="mail" name="mail" required type="email" class="form-control" value = "' . $c['mail'] . '">
                </div>';
        }
        ?>









        <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal">Editar cliente</button>
        <div class="modal fade" id="modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">

                <h4 class="modal-title">Modificar cliente</h4>
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
    </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Editar cliente
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