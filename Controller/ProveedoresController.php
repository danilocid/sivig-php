<?php
class Proveedor {
    public $rut;
    public $nombre;
    public $giro;
    public $direccion;
    public $comuna;
    public $region;
    public $telefono;
    public $mail;
}
Class Proveedores extends DB{
    public function GetProveedores(){
            $query = $this->connect()->prepare('SELECT * FROM proveedores');
            $query->execute();
            $arrayproveedores = array();
            
            foreach ($query as $c) {
                 
                array_push($arrayproveedores, $c);
            }
            return $arrayproveedores;
    }
    

    public function AgregarProveedor($proveedor){
        $query = $this->connect()->prepare('SELECT * FROM proveedores WHERE rut = :rut');
        $query->execute(['rut' => $proveedor[0]->rut]);
        if ($query->rowCount()) {
            echo '<script type="text/javascript">
            window.location="Proveedores.php?m=1";
            </script>';
        } else {
            try {
                $query = $this->connect()->prepare('INSERT INTO proveedores VALUES(:rut, :nombre, :giro,
                :direccion, :comuna, :region, :telefono, :mail)');
                $query->execute([
                    'rut' => $proveedor[0]->rut,
                    'nombre' => $proveedor[0]->nombre,
                    'giro' => $proveedor[0]->giro,
                    'direccion' => $proveedor[0]->direccion,
                    'comuna' => $proveedor[0]->comuna,
                    'region' => $proveedor[0]->region,
                    'telefono' => $proveedor[0]->telefono,
                    'mail' => $proveedor[0]->mail
                ]);
                echo '<script type="text/javascript">
                    window.location="Proveedores?m=2";
                  </script>';
            } catch (PDOException $e) {
                print_r('Error conenection: ' . $e->getCode());
               
            }
        }
    }
        public function GetProveedorPorRut($rut){
            $query = $this->connect()->prepare('SELECT * FROM proveedores WHERE rut = :rut');
            $query->execute(['rut' =>$rut]);
           
            $arrayproveedores = array();
            
            foreach ($query as $c) {
                array_push($arrayproveedores, $c);
            }
            return $arrayproveedores;
    }
    public function GetNombreProveedorPorRut($rut){
        $query = $this->connect()->prepare('SELECT nombre FROM proveedores WHERE rut = :rut');
        $query->execute(['rut' =>$rut]);
       
        
        foreach ($query as $c) {
            $proveedor = new Proveedor();
           
            $proveedor->nombre = $c[0];
            
        }
        return $proveedor->nombre;
}
       
    public function EditarProveedor($proveedor){
        try {
            
            $query = $this->connect()->prepare('UPDATE proveedores SET nombre = :nombre,
            giro = :giro, direccion = :direccion, comuna = :comuna, region = :region,
            telefono = :telefono, mail = :mail WHERE rut = :rut');
            $query->execute([
                    'rut' => $proveedor[0]->rut,
                    'nombre' => $proveedor[0]->nombre,
                    'giro' => $proveedor[0]->giro,
                    'direccion' => $proveedor[0]->direccion,
                    'comuna' => $proveedor[0]->comuna,
                    'region' => $proveedor[0]->region,
                    'telefono' => $proveedor[0]->telefono,
                    'mail' => $proveedor[0]->mail
            ]);
            echo '<script type="text/javascript">
                window.location="Proveedores?m=3";
              </script>';
        } catch (PDOException $e) {
            print_r('Error conenection: ' . $e->getMessage());
          
        }
    }
}

?>