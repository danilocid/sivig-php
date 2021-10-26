<?php
include 'Model/dbConection.php';
include 'Controller/ProveedoresController.php';

  $proveedor = new Proveedor();
                  
               
  $proveedorfrm = array();
  $proveedor->rut = $_POST['rut'];
  $proveedor->nombre = $_POST['nombre'];
  $proveedor->giro = $_POST['giro'];
  $proveedor->direccion = $_POST['direccion'];
  $proveedor->comuna = $_POST['comuna'];
  $proveedor->provincia = $_POST['provincia'];
  $proveedor->region = $_POST['region'];
  $proveedor->telefono = $_POST['telefono'];
  $proveedor->mail = $_POST['mail'];

  array_push($proveedorfrm, $proveedor);
   
  $proveedores = new Proveedores();
  $proveedores->EditarProveedor($proveedorfrm);
?>