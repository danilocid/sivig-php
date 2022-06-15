<?php
$titulo = 'Editar permisos - SIVIG';
$idpagina = 1;
include 'Includes/partials/header.php';
include 'Includes/partials/menu.php';
include 'Controller/PermisosController.php';

$id = $_POST["id"];
$User = $_POST["User"];

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administracion</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo "Editar permisos del usuario: " . $User; ?></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">

                <!-- Inicio contenido -->


                <?php
        $permiso = new Permiso();
        $permisos = $permiso->GetPermisosUsuario($id);
        $paginas = $permiso->GetPaginas();
        $grupos = $permiso->GetGruposPaginas();
        print_r($paginas);
        $contador = 0;
        //print_r($permisos);
        echo '<form role="form" action="ModificarPermisos.php" method="POST">';
        foreach ($grupos as $g) {
          $contador++;
          echo '<div class="form-group">';
          echo '<p><strong>' . $g->NombreGrupo . '</strong></p>';
          foreach ($paginas as $p) {
            if ($p->GrupoPagina == $g->IdGrupo) {
              echo '<div class="form-check">';
              echo '<input class="form-check-input" type="checkbox" name="' . $p->IdPagina . '" id="' . $p->IdPagina . '" value="' . $p->IdPagina . '"';
              foreach ($permisos as $permiso) {
                if ($permiso['IdPagina'] == $p->IdPagina) {
                  echo 'checked';
                }
              }
              echo '>';
              echo '<label class="form-check-label" for="' . $p->IdPagina . '">' . $p->NombrePagina . '</label>';
              echo '</div>';
            }
          }
          echo '</div>';
        }

        /*  foreach ($permisos as $p) {


          echo '<div class="form-group">';
          $contador++;
          echo '<div class ="form-group col-md-4">';
          echo '<label>' . $p['NombrePagina'] . '</label>';

          echo '<select id="' . $p['IdPagina'] . '" name="' . $p['IdPagina'] . '" class="form-control ">';
          if ($p['Permiso'] == 1) {

            echo '<option value=1>Permitido</option>
                   <option value=0>No permitido</option>
                                           
                 </select>
                 </div>';
          } else {
            echo '<option value=1>Permitido</option>
                   <option value=0 selected>No permitido</option>
                  
                 </select>
                 </div>';
          }
          echo '<input type="hidden" name="permiso' . $contador . '" value="' . $p['IdPermiso'] . '">';
        } */
        if ($contador == 0) {
          $permiso->CreaPermisos($id);
        } else {
          # code...
        }
        echo '<input type="hidden" name="contador" value="' . $contador . '">';
        echo '<input type="hidden" name="IdUsuario" value="' . $id . '">';
        ?>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                    Guardar cambios
                </button>

                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title">Modificar usuario</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <p>Seguro que quiere guardar los cambios?&hellip;</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left"
                                    data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                </form>

                <!-- Fin contenido -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <?php echo "Editar permisos del usuario: " . $User; ?>
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