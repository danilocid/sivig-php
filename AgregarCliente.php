<?php
include 'Model/dbConection.php';
include 'Controller/ClientesController.php';
  $enlace = $_POST['enlace'];
  $clientes = new Clientes();
                  
               
  $clientefrm = array();
  $clientes->rut = $_POST['rut'];
  $clientes->nombre = $_POST['nombre'];
  $clientes->apellidos = $_POST['apellidos'];
  $clientes->giro = $_POST['giro'];
  $clientes->direccion = $_POST['direccion'];
  $clientes->comuna = $_POST['comuna'];
  $clientes->region = $_POST['region'];
  $clientes->telefono = $_POST['telefono'];
  $clientes->mail = $_POST['mail'];

  array_push($clientefrm, $clientes);
   
  $cliente = new Cliente();
  $cliente->AgregarCliente($clientefrm, $enlace);
?>