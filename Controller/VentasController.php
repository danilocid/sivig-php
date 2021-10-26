<?php
Class Venta{
    public $id;
    public $monto;
    public $tipo_documento;
    public $documento;
    public $cliente;
    public $medio_pago;
    public $fecha;
    public $usuario;
}
Class Ventas extends DB{
    public function AgregarVenta($monto_neto, $monto_imp, $tipo_documento, $documento, $cliente, $medio_pago){
        try {
            $query = $this->connect()->prepare('INSERT INTO ventas VALUES(NULL, :monto_neto,
            :monto_imp, :tipo_documento, :documento, :cliente, :medio_pago, NOW(), :usuario)');
            $query->execute(['monto_neto' => $monto_neto,
            'monto_imp' => $monto_imp,
            'tipo_documento' => $tipo_documento,
            'documento' => $documento,
            'cliente' => $cliente,
            'medio_pago' => $medio_pago,
            'usuario' => $_SESSION['id']]);
             try {
                $query = $this->connect()->prepare('SELECT MAX(id) FROM ventas');
                $query->execute();
                foreach ($query as $respuesta){
                    $id_venta = $respuesta[0];
                }
                try {
                   foreach ($_SESSION['articulo'] as $a) {
                            $query = $this->connect()->prepare('INSERT INTO detalle_ventas VALUES(NULL, :venta, :articulo,
                         :cantidad, :venta_neto, :venta_imp)');
                            $query->execute(['venta' => $id_venta,
                            'articulo' => $a->id,
                            'cantidad' => $a->cantidad,
                            'venta_neto' => $a->venta_neto,
                            'venta_imp' => $a->venta_imp
                            ]);
                        }
                        
                        //ingresamos detalle movimientos articulo
                        try {
                            
                           
                                foreach ($_SESSION['articulo'] as $a) {
                                    $query = $this->connect()->prepare('INSERT INTO movimientos_articulos VALUES(NULL, :articulo, 2,
                                    :unidades, NOW(), :usuario)');
                                    $query->execute(['articulo' => $a->id,
                                    'unidades' => ($a->cantidad*(-1)),
                                    'usuario' => $_SESSION['id']
                                    ]);
                                    $articulo = new Articulos();
                                    $articulo->UpdateStockArticuloVentaPorId($a->id,$a->cantidad);
                                }
                                
                                echo '<script type="text/javascript">
                            window.location="Ventas?id='.$id_venta.'";
                            
                         </script>';
                                
                            } catch (PDOException $e) {
                                echo 'error al ingresar movimiento de articulos';
                                print_r('Error conenection: ' . $e->getCode());
                                print_r('Error conenection: ' . $e->getMessage());
                            }
                }  catch (PDOException $e) {
                    echo 'error al ingresar detalle venta';
                    print_r('Error conenection: ' . $e->getCode());
                    print_r('Error conenection: ' . $e->getMessage());
                }
            } catch (PDOException $e) {
                echo 'error al obtener ultimo id';
                print_r('Error conenection: ' . $e->getCode());
                print_r('Error conenection: ' . $e->getMessage());
            }
        } catch (PDOException $e) {
            echo 'error al insertar venta';
            print_r('Error conenection: ' . $e->getCode());
            print_r('Error conenection: ' . $e->getMessage());
        }
    }
    
    public function GetVentas(){
        $query = $this->connect()->prepare('SELECT * FROM ventas ORDER BY id DESC');
            $query->execute();
            $arrayventas = array();
            
            foreach ($query as $r) {
               array_push($arrayventas, $r);
            }
            return $arrayventas;
    }
    public function VerificaVentaExiste($tipo_documento, $documento){
        $query = $this->connect()->prepare('SELECT * FROM ventas WHERE documento = :documento AND tipo_documento = :tipo_documento');
            $query->execute(['tipo_documento' => $tipo_documento, 'documento' => $documento]);
            if($query->rowCount()){
                return true;
            }else{
                return false;
            }
    }
    public function GetVentasPorId($id){
        $query = $this->connect()->prepare('SELECT * FROM ventas WHERE id = :id');
            $query->execute(['id' => $id]);
            $arrayventas = array();
            
            foreach ($query as $r) {
               array_push($arrayventas, $r);
            }
            return $arrayventas;
    }
    public function GetVentasPorRut($rut){
        $query = $this->connect()->prepare('SELECT * FROM ventas WHERE cliente = :rut');
            $query->execute(['rut' => $rut]);
            $arrayventas = array();
            
            foreach ($query as $r) {
               array_push($arrayventas, $r);
            }
            return $arrayventas;
    }
    public function GetSiguienteDocumento($tipo_documento){
        try {
            $query = $this->connect()->prepare('SELECT MAX(documento) FROM ventas WHERE tipo_documento = :tipo_documento');
            $query->execute(['tipo_documento' => $tipo_documento]);
            $documento = 0;
            foreach ($query as $q) {
                $documento = $q[0] + 1;
            }
            return $documento;
        } catch (\Throwable $th) {
            echo 'Error en GetSiguienteDocumento';
        }

    }
   
    
    
}

?>