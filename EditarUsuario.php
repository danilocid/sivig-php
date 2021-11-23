<?php
$titulo = 'Editar Usuario';
$idpagina = 1;
include 'Includes/partials/header.php';
include 'Includes/partials/menu.php';
include 'Controller/UsuariosController.php'

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
            <h3 class="card-title">Modificar usuario</h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
          
            <!-- Inicio contenido -->
            
            
            <div class="col-md-6">
        
        <?php
    $id = $_POST["id"];
    

    $usuario = new Usuario();
      $usuarios = $usuario->GetUsuarioPorId($id);
      echo '<form role="form" action="ModificarUsuario.php" method="POST">';
      
      foreach ($usuarios as $u) {
             echo '<div class ="form-group">
                    <label>Nombre</label>
                    <input id="Nombre" name="Nombre" required type="text" class="form-control" value="' .$u['Nombre']. '">
                    </div>
                    <div class ="form-group">
                    <label>Apellidos</label>
                    <input required type="text" id="apellidos" name="apellidos" class="form-control" value="'.$u['Apellidos'].'">
                    </div>
                    <div class ="form-group">
                    <label>Usuario</label>
                    <input id="user" name="user" required type="text" class="form-control" value="'.$u['User'].'">
                    </div>
                    <div class ="form-group">
                    <label>Contraseña</label>
                    <input id="password" name="password" required type="text" class="form-control" value="'.$u['password'].'">
                    </div>
                    <input type="hidden" name="id" value="'.$u['IdUsuario'].'">
                    <div class="form-group">
                    <label>Activo</label>
                    
                  
                    ';
                    echo '<select id="activo" name="activo" class="form-control">';
                    if ($u['Activo'] == 1) {
                      
                      echo '<option>Activo</option>
                      <option>Inactivo</option>
                                              
                    </select>
                    </div>';
                    } else {
                     echo '<option>Activo</option>
                      <option selected>Inactivo</option>
                     
                    </select>
                    </div>';
                    }
                    
            }
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
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    </form>
    </div>
                
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
         Modificar usuario
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