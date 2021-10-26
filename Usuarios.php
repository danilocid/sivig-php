<?php
$titulo = 'Administracion';
$idpagina = 1;
include 'includes/partials/header.php';
include 'includes/partials/menu.php';
include 'Controller/UsuariosController.php';
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
            <h3 class="card-title">Administracion de usuarios</h3>
  
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
        <strong>Error</strong> Ya existe el usuario
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
        
      }
      if($_GET['m'] == 2){
        echo '<div  class="alert alert-info alert-dismissible fade show"  id="alert" role="alert">
        <strong>Exito</strong> Creado con exito el usuario
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
    
    ?>
          
            <!-- Inicio contenido -->
            
            
            <table id="tabla1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Usuario</th>
                  <th>Activo</th>
                  <th style="width: 60px">Editar usuario</th>
                  <th style="width: 60px">Permisos</th>
                </tr>
              </thead>
              <tbody>
                    <?php
                    $usuario = new Usuario();
                    $usuarios = $usuario->GetUsuarios();
                    foreach ($usuarios as $u) {
                    echo '<tr>
                          <td>'.$u['Nombre'].'</td>
                          <td>'.$u['Apellidos'].'</td>
                          <td>'.$u['User'].'</td>
                          ';
                          if ($u['Activo'] == 1 ) {
                            echo '<td>Activo</td>';
                          } else {
                            echo '<td>Inactivo</td>';
                          }
                          echo '<td>
                          <form action="EditarUsuario" method="POST">
                          <input type="hidden" name="id" value="'.$u['IdUsuario'].'">
                          <button type="submit" class="btn btn-block btn-primary btn-sm" name="Modificar" value="Modificar">Modificar</button>
                          </form>
                          </td>';
                          echo '<td>
                          <form action="EditarPermisos" method="POST">
                          <input type="hidden" name="id" value="'.$u['IdUsuario'].'">
                          <input type="hidden" name="User" value="'.$u['User'].'">
                          <button type="submit" class="btn btn-block btn-primary btn-sm" name="Modificar" value="Modificar">Modificar</button>
                          </form>
                          </td>';
                                        
                          echo '</tr>
                          ';
                      
                    }
                    ?>
               </tbody>
            </table>
          <br>
          <br>
            <div class="pull-right">
            <button type="button" class="btn  btn-lg btn-info" data-toggle="modal" data-target="#modal-default">
                    Agregar usuario
                  </button>
                  </div>
                  
                  <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                  <h4 class="modal-title">Agregar usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    
                  </div>
                  <div class="modal-body">
                    <form role="form" action="AgregarUsuario.php" method="POST">        
                        <div class ="form-group">
                          <label>Nombre</label>
                          <input id="Nombre" name="Nombre" required type="text" class="form-control">
                        </div>
                        <div class ="form-group">
                          <label>Apellidos</label>
                          <input required type="text" id="apellidos" name="apellidos" class="form-control">
                        </div>
                        <div class ="form-group">
                          <label>Usuario</label>
                          <input id="user" name="user" required type="text" class="form-control">
                        </div>
                        <div class ="form-group">
                          <label>Contraseña</label>
                          <input id="password" name="password" required type="text" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Activo</label>
                          <select id="activo" name="activo" class="form-control">
                            <option>Activo</option>
                            <option>Inactivo</option>
                          </select>
                        </div>        
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar usuario</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
      
                
            <!-- Fin contenido -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          Administracion de usuarios
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
  window.location='./Usuarios';  
});

</script>";
  include 'includes/partials/footer.php';
  ?>

