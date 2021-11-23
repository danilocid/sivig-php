<?php
$titulo = 'Proveedores';
$idpagina = 2;
include 'includes/partials/header.php';
include 'includes/partials/menu.php';
include 'Controller/ProveedoresController.php';
include 'Controller/ComunasController.php';
include 'Controller/RegionesController.php';

?>
<script language="javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

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
        <h3 class="card-title">Listado de proveedores</h3>

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
          if ($_GET['m'] == 1) {
            echo '<div  class="alert alert-danger alert-dismissible fade show"  id="alert" role="alert">
        <strong>Error</strong> Ya existe el proveedor
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
          }
          if ($_GET['m'] == 2) {
            echo '<div  class="alert alert-info alert-dismissible fade show"  id="alert" role="alert">
        <strong>Exito</strong> Creado con exito el proveedor
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
          }
          if ($_GET['m'] == 3) {
            echo '<div  class="alert alert-info alert-dismissible fade show"  id="alert" role="alert">
        <strong>Exito</strong> Los cambios fueron guardados con exito
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
          }
        }

        ?>

        <!-- Inicio contenido -->


        <table id="tabla1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th style="width: 60px">RUT</th>
              <th>Nombre</th>
              <th>Giro</th>
              <th>Direccion</th>
              <th>Comuna</th>
              <th style="width: 60px">Editar proveedor</th>
              <th style="width: 60px">Historial</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $proveedor = new Proveedores();
            $proveedores = $proveedor->GetProveedores();
            $comuna = new Comunas;
            foreach ($proveedores as $c) {
              echo '<tr>
                    <td>' . $c['rut'] . '</td>
                    <td>' . $c['nombre'] . '</td>
                    
                    <td>' . $c['giro'] . '</td>
                    <td>' . $c['direccion'] . '</td>
                    <td>' . $comuna->GetComunaPorId($c['comuna']) . '</td>
                    ';

              echo '<td>
                    <form action="VerProveedor" method="POST">
                    <input type="hidden" name="rut" value="' . $c['rut'] . '">
                    <button type="submit" class="btn btn-block btn-primary btn-sm" name="Editar" value="Editar">Editar</button>
                    </form>
                    </td>';
              echo '<td>
                    <form action="VerHistorialProveedor" method="POST">
                    <input type="hidden" name="rut" value="' . $c['rut'] . '">
                    
                    <button type="submit" class="btn btn-block btn-primary btn-sm" name="Historial" value="Historial">Historial</button>
                    </form>
                    </td>';

              echo '</tr>
                    ';
            }
            ?>
          </tbody>


        </table>

        <div class="pull-right">
          <button type="button" class="btn  btn-lg btn-info" data-toggle="modal" data-target="#modal-default">
            Agregar Proveedor
          </button>
        </div>
        <br>
        <br>
        <br>
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">

                <h4 class="modal-title">Agregar proveedor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <form role="form" action="AgregarProveedor" method="POST">
                  <div class="form-group">
                    <label>Nombre o Razon Social</label>
                    <input id="nombre" name="nombre" required type="text" class="form-control input-sm">
                  </div>
                  <div class="form-group">
                    <label>RUT</label>
                    <input id="rut" name="rut" required type="text" oninput="checkRut(this)" class="form-control input-sm">
                  </div>
                  <div class="form-group">
                    <label>Giro</label>
                    <input id="giro" name="giro" required type="text" class="form-control input-sm">
                  </div>
                  <div class="form-group">
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
                    <label>Comuna</label>
                    <select id="comuna" name="comuna" required class="form-control input-sm">

                    </select>
                  </div>
                  <div class="form-group">
                    <label>Telefono</label>
                    <input id="telefono" name="telefono" required type="number" min="111111111" max="999999999" class="form-control input-sm">
                  </div>
                  <div class="form-group">
                    <label>Mail</label>
                    <input id="mail" name="mail" required type="email" class="form-control input-sm">
                  </div>


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Agregar proveedor</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->

        </div>

        <!-- Fin contenido -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Listado de proveedores
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->




<?php
$script = "<script type='text/javascript'>
  $('#alert').on('closed.bs.alert', function () {
    window.location='./Proveedores';  
  });
  
  </script>";

include 'includes/partials/footer.php';

?>