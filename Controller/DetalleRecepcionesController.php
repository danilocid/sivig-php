<?php
Class DetalleRecepcion{
    public $id;
    public $recepcion;
    public $articulo;
    public $precio_compra;
    public $cantidad;
    public $total;
}
Class DetallesRecepciones extends DB{
    public function GetDetalleRecepcionPorId($id){
        try {
        $query = $this->connect()->prepare('SELECT * FROM detalle_recepciones WHERE recepcion = :id');
        $query->execute(['id' => $id]);
        $receciones = array();
        foreach ($query as $respuesta){
            $detallerecepcion = new DetalleRecepcion();
            
            array_push($receciones, $respuesta);
        }
    } catch (PDOException $e) {
        echo 'error al ingresar detalle recepcion';
        print_r('Error conenection: ' . $e->getCode());
        print_r('Error conenection: ' . $e->getMessage());
    }
        return $receciones;
        
    }
}