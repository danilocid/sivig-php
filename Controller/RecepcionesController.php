<?php
include './Controller/ArticulosController.php';
Class Recepcion{
        public $id;
        public $proveedor;
        public $documento;
        public $tipo_documento;
        public $monto_total;
        public $unidades_total;
        public $observaciones;
        public $fecha;
        public $usuario;
}

Class Recepciones extends DB{
    public function GetRecepciones(){
        $query = $this->connect()->prepare('SELECT * FROM recepciones ORDER BY id DESC');
            $query->execute();
            $arrayrecepciones = array();
            
            foreach ($query as $r) {
               array_push($arrayrecepciones, $r);
            }
            return $arrayrecepciones;
    }
    public function GetDetalleRecepcionesPorRUT($recepciones){
        $detallerecepciones = array();
        foreach ($recepciones as $r) {
           
            try {
                $query = $this->connect()->prepare('SELECT * FROM detalle_recepciones WHERE recepcion = :id');
                $query->execute(['id' => $r['id']]);
                
                foreach ($query as $respuesta){
                    
                    array_push($detallerecepciones, $respuesta);
                }
            } catch (PDOException $e) {
                
                print_r('Error conenection: ' . $e->getCode());
                print_r('Error conenection: ' . $e->getMessage());
            }
        }
        return $detallerecepciones;

    }
    public function GetRecepcionesPorId($id){
        $query = $this->connect()->prepare('SELECT * FROM recepciones WHERE id = :id');
            $query->execute(['id' => $id]);
            $arrayrecepciones = array();
            
            foreach ($query as $r) {
               array_push($arrayrecepciones, $r);
            }
            return $arrayrecepciones;
    }
    public function GetRecepcionesPorRUT($RUT){
        $query = $this->connect()->prepare('SELECT * FROM recepciones WHERE proveedor = :rut');
            $query->execute(['rut' => $RUT]);
            $arrayrecepciones = array();
            
            foreach ($query as $r) {
               array_push($arrayrecepciones, $r);
            }
            return $arrayrecepciones;
    }
    public function VerificaRecepcionExiste($proveedor, $documento){
        $query = $this->connect()->prepare('SELECT * FROM recepciones WHERE proveedor = :proveedor AND documento = :documento');
            $query->execute(['proveedor' => $proveedor, 'documento' => $documento]);
            if($query->rowCount()){
                return true;
            }else{
                return false;
            }
    }
    
    public function AgregarRecepcion($datos){
        
        
        try {
            $query = $this->connect()->prepare('INSERT INTO recepciones VALUES(NULL, :proveedor, :documento, :tipo_documento,
            :monto_neto, :monto_imp, :unidades_total, :observaciones, NOW(), :usuario)');
            $query->execute(['proveedor' => $datos->proveedor,
            'documento' => $datos->documento,
            'tipo_documento' => $datos->tipo_documento,
            'monto_neto' => $datos->monto_neto,
            'monto_imp' => $datos->monto_imp,
            'unidades_total' => $datos->unidades_total,
            'observaciones' => $datos->observaciones,
            'usuario' => $_SESSION['id']
            ]);
            
            //obtenemos el id de la ultima recepcion
            try {
                $query = $this->connect()->prepare('SELECT MAX(id) FROM recepciones');
                $query->execute();
                foreach ($query as $respuesta){
                    $id_recepcion = $respuesta[0];
                }
                echo 'recepcion ingresada con el id: '. $id_recepcion;
                //insertamos el detalle de los movimientos
                try {
                    foreach ($_SESSION['articulo'] as $a) {
                        $query = $this->connect()->prepare('INSERT INTO detalle_recepciones VALUES(NULL, :recepcion, :articulo,
                        :compra_neto, :compra_imp, :cantidad)');
                        $query->execute(['recepcion' => $id_recepcion,
                        'articulo' => $a->id,
                        'compra_neto' => $a->costo_neto,
                        'compra_imp' => $a->costo_imp,
                        'cantidad' => $a->cantidad,
                        
                        ]);
                        echo 'detalle recepcion ingresado';
                        print_r($a);
                    }
                    echo 'detalle recepcion ingresado correctamente';
                    //ingresamos detalle movimientos articulo
                    try {
                        foreach ($_SESSION['articulo'] as $a) {
                            $query = $this->connect()->prepare('INSERT INTO movimientos_articulos VALUES(NULL, :articulo, 1,
                            :unidades, NOW(), :usuario)');
                            $query->execute(['articulo' => $a->id,
                            'unidades' => $a->cantidad,
                            'usuario' => $_SESSION['id']
                            ]);
                            echo 'detalle movimientos articulo ingresado';
                            print_r($a);
                            $articulo = new Articulos();
                            $articulo->UpdateStockArticuloPorId($a->id,$a->cantidad, $a->costo_neto, $a->costo_imp );
                        }
                        echo 'detalle movimientos de articulos ingresados correctamente';
                        echo '<script type="text/javascript">
                    window.location="Recepciones?id='.$id_recepcion.'";
                                </script>';
                        
                    } catch (PDOException $e) {
                        echo 'error al ingresar movimiento de articulos';
                        print_r('Error conenection: ' . $e->getCode());
                        print_r('Error conenection: ' . $e->getMessage());
                    }
                } catch (PDOException $e) {
                    echo 'error al ingresar detalle recepcion';
                    print_r('Error conenection: ' . $e->getCode());
                    print_r('Error conenection: ' . $e->getMessage());
            }
            } catch (PDOException $e) {
                echo 'error al obtener ultimo id';
                print_r('Error conenection: ' . $e->getCode());
                print_r('Error conenection: ' . $e->getMessage());
        }
        } catch (PDOException $e) {
            echo 'error al insertar recepcion';
            print_r('Error conenection: ' . $e->getCode());
            print_r('Error conenection: ' . $e->getMessage());
    }
}
}

?>