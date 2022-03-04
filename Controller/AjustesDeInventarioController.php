<?php

Class AjustesDeInventario extends DB{
    public function GetTipoMovimientos(){
        try {
            $query = $this->connect()->prepare('SELECT * FROM tipo_movimiento');
            $query->execute();
            $tipos = array();
            foreach ($query as $a) {
                array_push($tipos, $a);
            }
            return $tipos;
        } catch (PDOException $e) {
            print_r('Error conenection: ' . $e->getMessage());
           
        }
    }
    public function GetAjustes(){
        try {
            $query = $this->connect()->prepare('SELECT * FROM ajustes_de_inventario');
            $query->execute();
            $ajustes = array();
            foreach($query as $a){
                array_push($ajustes, $a);
            }
            return $ajustes;
        } catch (PDOException $e) {
            print_r('Error conenection: ' . $e->getMessage());
        }
    }
    public function GetAjustePorId($id){
        try {
            $query = $this->connect()->prepare('SELECT * FROM ajustes_de_inventario WHERE id = :id');
            $query->execute(['id' => $id]);
            $ajuste = array();
            foreach($query as $a){
                array_push($ajuste, $a);
            }
            return $ajuste;
        } catch (PDOException $e) {
            print_r('Error conenection: ' . $e->getMessage());
        }
    }
    public function GetDetalleAjustePorId($id){
        try {
            $query = $this->connect()->prepare('SELECT * FROM detalle_ajuste WHERE id_ajuste = :id');
            $query->execute(['id' => $id]);
            $ajuste = array();
            foreach($query as $a){
                array_push($ajuste, $a);
            }
            return $ajuste;
        } catch (PDOException $e) {
            print_r('Error conenection: ' . $e->getMessage());
        }
    }
    public function AgregarAjuste($monto_neto, $monto_imp, $tipo_movimiento, $observaciones, $total_articulos){
        $articulo = new Articulos();
        try {
            $query = $this->connect()->prepare('INSERT INTO ajustes_de_inventario VALUES(NULL, :tipo_movimiento,
            :monto_neto, :monto_imp, :observaciones, NOW(), :usuario)');
            $query->execute(['tipo_movimiento' => $tipo_movimiento,
            'monto_neto' => $monto_neto,
            'monto_imp' => $monto_imp,
            'observaciones' => $observaciones,
            'usuario' => $_SESSION['id']]);
             try {
                $query = $this->connect()->prepare('SELECT MAX(id) FROM ajustes_de_inventario');
                $query->execute();
                foreach ($query as $respuesta){
                    $id_ajuste = $respuesta[0];
                }
                try {
                    print_r($_SESSION['articulo']);
                   foreach ($_SESSION['articulo'] as $a) {
                    $articuloventa = $articulo->GetArticulosPorId($a->id);
                            $query = $this->connect()->prepare('INSERT INTO detalle_ajuste VALUES(NULL, :ajuste, :articulo,
                         :monto_neto, :monto_imp, :cantidad)');
                            $query->execute(['ajuste' => $id_ajuste,
                            'articulo' => $a->id,
                            'cantidad' => $a->cantidad,
                            'monto_neto' => ($articuloventa[0]['costo_neto'] * $a->cantidad),
                            'monto_imp' => ($articuloventa[0]['costo_imp'] * $a->cantidad)
                            ]);
                        }
                        
                        //ingresamos detalle movimientos articulo
                        try {
                            
                           
                                foreach ($_SESSION['articulo'] as $a) {
                                    
                                    $query = $this->connect()->prepare('INSERT INTO movimientos_articulos VALUES(NULL, :articulo, :tipo_movimiento,
                                    :unidades, NOW(), :usuario)');
                                    $query->execute(['articulo' => $a->id,
                                    'tipo_movimiento' => $tipo_movimiento,
                                    'unidades' => abs($a->cantidad),
                                    'usuario' => $_SESSION['id']
                                    ]);
                                    if ($a->tipo == 'IN') {
                                        $tipo = 'IN';
                                    } else {
                                        $tipo = 'OUT';
                                    }
                                    
                                    $articulo->UpdateStockArticuloVentaPorId($a->id,$a->cantidad, $tipo);
                                }
                                
                                echo '<script type="text/javascript">
                            window.location="AjustesDeInventario?id='.$id_ajuste.'";
                            
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
                    print_r($query);
                }
            } catch (PDOException $e) {
                echo 'error al obtener ultimo id';
                print_r('Error conenection: ' . $e->getCode());
                print_r('Error conenection: ' . $e->getMessage());
            }
        } catch (PDOException $e) {
            echo 'error al insertar ajuste de inventario';
            print_r('Error conenection: ' . $e->getCode());
            print_r('Error conenection: ' . $e->getMessage());
        }
    }
}