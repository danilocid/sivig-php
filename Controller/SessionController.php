<?php
class UserSession{
    public function __construct(){
        session_start();
    }
    public function setCurrentUser($user, $NombreUsuario, $id){
        $_SESSION['user'] = $user;
        $_SESSION['nombre'] = $NombreUsuario;
        $_SESSION['id'] = $id;
        //echo $_SESSION['user'];
    }
    public function getCurrentUser(){
        return $_SESSION['user'];
    }
    public function closeSession(){
        session_unset();
        session_destroy();
    }
}
?>