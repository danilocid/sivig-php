<?php
Class DetalleVenta{
    public $id;
    public $id_venta;
    public $articulo;
    public $cantidad;
    public $precio_venta;
    
}
Class DetallesVentas extends DB{
    public function GetDetalleVentaPorId($id){
        try {
        $query = $this->connect()->prepare('SELECT * FROM detalle_ventas WHERE id_venta = :id');
        $query->execute(['id' => $id]);
        $detalleventas = array();
        foreach ($query as $respuesta){
            $detalleventa = new DetalleVenta();
            
            array_push($detalleventas, $respuesta);
        }
    } catch (PDOException $e) {
        
        print_r('Error conenection: ' . $e->getCode());
        print_r('Error conenection: ' . $e->getMessage());
    }
        return $detalleventas;
        
    }
    public function GetDetalleVentasPorRUT($ventas){
        $detalleventas = array();
        foreach ($ventas as $v) {
           
            try {
                $query = $this->connect()->prepare('SELECT * FROM detalle_ventas WHERE id_venta = :id');
                $query->execute(['id' => $v['id']]);
                
                foreach ($query as $respuesta){
                    $detalleventa = new DetalleVenta();
            
                    array_push($detalleventas, $respuesta);
                }
            } catch (PDOException $e) {
                
                print_r('Error conenection: ' . $e->getCode());
                print_r('Error conenection: ' . $e->getMessage());
            }
        }
        return $detalleventas;

    }
}

?>