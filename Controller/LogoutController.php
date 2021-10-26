<?php
    include_once 'SessionController.php';
    $userSession = new UserSession();
    $userSession->closeSession();
    header("location: ../index");
?>