<?php 
include '../Model/dbConection.php';
include 'SessionController.php';

class User extends DB{
    private $nombre;
    private $username;
    private $idusuario;
    private $activo = 0;
    public function userExists($user, $pass){
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE User = :user AND password = :pass');
        $query->execute(['user' => $user, 'pass' => $pass]);
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }
    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE User = :user');
        $query->execute(['user' => $user]);
        
        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['Nombre'] . " " . $currentUser['Apellidos'];
            $this->usename = $currentUser['User'];
            $this->idusuario = $currentUser['IdUsuario'];
            $this->activo = $currentUser['Activo'];

        }
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getIdUsuario(){
        return $this->idusuario;
    }
    public function getActivo(){
       // echo $this->activo;
        if ($this->activo == 1) {
            return true;
        } else {
            return false;
        }
    }

    
}
$userForm = $_POST['username'];
$passForm = $_POST['password'];
$userSession = new UserSession();
$user = new User();

if($user->userExists($userForm, $passForm)){
    $user->setUser($userForm);
    if ($user->getActivo()){
        
    $userSession->setCurrentUser($userForm, $user->getNombre(), $user->getIdUsuario());
    echo '<script type="text/javascript">
   
    window.location="..";
        </script>';
    } else {
        echo '<script type="text/javascript">
                    alert("Usuario inactivo");
                    window.location="../login";
                  </script>';
    }
    
    
}else{
    echo '<script type="text/javascript">
                    alert("Usuario o contraseña incorrectos");
                    window.location="../login";
                  </script>';
}
?>