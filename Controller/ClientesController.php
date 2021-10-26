<?php
class Clientes {
    public $rut;
    public $nombre;
    public $giro;
    public $direccion;
    public $comuna;
    public $provincia;
    public $region;
    public $telefono;
    public $mail;
}
Class Cliente extends DB{
    public function GetClientes(){
            $query = $this->connect()->prepare('SELECT * FROM clientes');
            $query->execute();
            $arrayclientes = array();
            
            foreach ($query as $c) {
                $clientes = new Clientes();
                $clientes->rut = $c[0];
                $clientes->nombre = $c[1];
                $clientes->giro = $c[2];
                $clientes->direccion = $c[3];
                $clientes->comuna = $c[4];
                $clientes->provincia = $c[5];
                $clientes->region = $c[6];
                $clientes->telefono = $c[7];
                $clientes->mail = $c[8];
  
                array_push($arrayclientes, $c);
            }
            return $arrayclientes;
    }

    public function AgregarCliente($cliente, $enlace){
        $query = $this->connect()->prepare('SELECT * FROM clientes WHERE rut = :rut');
        $query->execute(['rut' => $cliente[0]->rut]);
        if ($query->rowCount()) {
            echo '<script type="text/javascript">
            window.location="'.$enlace.'.php?m=1";
            </script>';
        } else {
            try {
                $query = $this->connect()->prepare('INSERT INTO clientes VALUES(:rut, :nombre, :giro,
                :direccion, :comuna, :provincia, :region, :telefono, :mail)');
                $query->execute([
                    'rut' => $cliente[0]->rut,
                    'nombre' => $cliente[0]->nombre,
                    'giro' => $cliente[0]->giro,
                    'direccion' => $cliente[0]->direccion,
                    'comuna' => $cliente[0]->comuna,
                    'provincia' => $cliente[0]->provincia,
                    'region' => $cliente[0]->region,
                    'telefono' => $cliente[0]->telefono,
                    'mail' => $cliente[0]->mail
                ]);
                echo '<script type="text/javascript">
                    window.location="'.$enlace.'.php?m=2";
                  </script>';
            } catch (PDOException $e) {
                print_r('Error conenection: ' . $e->getCode());
               
            }
        }
    }
        public function GetClientesPorRUT($rut){
            $query = $this->connect()->prepare('SELECT * FROM clientes WHERE rut = :rut');
            $query->execute(['rut' =>$rut]);
            $arrayclientes = array();
            
            foreach ($query as $c) {
                $clientes = new Clientes();
                $clientes->rut = $c[0];
                $clientes->nombre = $c[1];
                $clientes->giro = $c[2];
                $clientes->direccion = $c[3];
                $clientes->comuna = $c[4];
                $clientes->provincia = $c[5];
                $clientes->region = $c[6];
                $clientes->telefono = $c[7];
                $clientes->mail = $c[8];
  
                array_push($arrayclientes, $c);
            }
            return $arrayclientes;
    }
       
    public function EditarCliente($cliente){
        try {
            
            $query = $this->connect()->prepare('UPDATE clientes SET nombre = :nombre, 
            giro = :giro, direccion = :direccion, comuna = :comuna, provincia = :provincia, region = :region,
            telefono = :telefono, mail = :mail WHERE rut = :rut');
            $query->execute([
                'rut' => $cliente[0]->rut,
                'nombre' => $cliente[0]->nombre,
                'giro' => $cliente[0]->giro,
                'direccion' => $cliente[0]->direccion,
                'comuna' => $cliente[0]->comuna,
                'provincia' => $cliente[0]->provincia,
                'region' => $cliente[0]->region,
                'telefono' => $cliente[0]->telefono,
                'mail' => $cliente[0]->mail
            ]);
            echo '<script type="text/javascript">
               window.location="clientes?m=3";
              </script>';
        } catch (PDOException $e) {
            print_r('Error conenection: ' . $e->getMessage());
           print_r($query);
           print_r($cliente);
        }
    }

    public function GetNombreClientePorRut($rut){
        $query = $this->connect()->prepare('SELECT nombre FROM clientes WHERE rut = :rut');
        $query->execute(['rut' =>$rut]);
       
        
        foreach ($query as $c) {
            $cliente = new Clientes();
           
            $cliente->nombre = $c[0];
           
            
            $nombre = $cliente->nombre;
        }
        return $nombre;
}
}

?>