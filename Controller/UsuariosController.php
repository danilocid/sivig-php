<?php

class Usuarios{
    public $IdUsuario;
    public $User;
    public $Password;
    public $Nombre;
    public $Apellidos;
    public $Activo;
}
class Usuario extends DB{
        public function GetUsuarios(){
        $query = $this->connect()->prepare('SELECT * FROM usuarios');
        $query->execute();
        $arrayusuarios = array();
        
        foreach ($query as $u) {
            $users = new Usuarios();
            $users->IdUsuario = $u[0];
            $users->User = $u[1];
            $users->Password = $u[2];
            $users->Nombre = $u[3];
            $users->Apellidos = $u[4];
            $users->Activo = $u[5];
            

            array_push($arrayusuarios, $u);
        }
        return $arrayusuarios;
    
       
        }

        public function GetUsuarioPorId($idusuario){
            $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE IdUsuario = :IdUsuario');
            $query->execute(['IdUsuario' => $idusuario]);
            $arrayusuarios = array();
            
            foreach ($query as $u) {
                $users = new Usuarios();
                $users->IdUsuario = $u[0];
                $users->User = $u[1];
                $users->Password = $u[2];
                $users->Nombre = $u[3];
                $users->Apellidos = $u[4];
                $users->Activo = $u[5];
                
    
                array_push($arrayusuarios, $u);
            }
            return $arrayusuarios;
        
           
            }
            public function ActualizaUsuario($IdUsuario, $User, $Password, $Nombre, $Apellidos, $Activo){
       
       
                try {
                    $query = $this->connect()->prepare('UPDATE usuarios SET User = :User , password = :Password ,
                     Nombre = :Nombre, Apellidos = :Apellidos, Activo = :Activo WHERE IdUsuario = :IdUsuario; ');
                    $query->execute(['User' => $User, 'Password' => $Password,'Nombre' => $Nombre,'Apellidos' => $Apellidos,
                    'Activo' => $Activo,'IdUsuario' => $IdUsuario]);
                    echo '<script type="text/javascript">
                    window.location="Usuarios?m=3";
                  </script>';
                }  catch (PDOException $e) {
                    print_r('Error conenection: ' . $e->getMessage());
                }
            
               
                }
            public function AgregarUsuario($User, $Password, $Nombre, $Apellidos, $Activo){
                try {
                    $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE User = :User');
                    $query->execute(['User' => $User]);
                    if ($query->rowCount()) {
                        echo '<script type="text/javascript">
                    window.location="Usuarios?m=1";
                  </script>';
                    } else {
                        try {
                            $query = $this->connect()->prepare('INSERT INTO usuarios VALUES (null, :User , :Password ,
                             :Nombre, :Apellidos, :Activo)');
                            $query->execute(['User' => $User, 'Password' => $Password,'Nombre' => $Nombre,'Apellidos' => $Apellidos,
                            'Activo' => $Activo]);
                           
                            echo '<script type="text/javascript">
                    window.location="Usuarios?m=2";
                  </script>';
                        }  catch (PDOException $e) {
                         echo 'Error al crear el usuario';
                        }
                    }
                    
                } catch (\Throwable $th) {
                    echo 'Error al crear el usuario' . $th;
                }
               
                
                   
                    }

        
}

?>