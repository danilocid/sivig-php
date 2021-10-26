<?php
Class MovimientoArticulo{
    public $id;
    public $articulo;
    public $movimiento;
    public $unidades;
    public $fecha;
    public $usuario;
}
Class MovimientosArticulos extends DB{
    public function GetMovimientosPorArticulo($articulo){
        try {
            $query = $this->connect()->prepare('SELECT * FROM movimientos_articulos WHERE articulo = :articulo');
            $query->execute(['articulo' => $articulo]);
            $arrayarmovimientos = array();
            
            foreach ($query as $a) {
                array_push($arrayarmovimientos, $a);
            }
            return $arrayarmovimientos;
        } catch (PDOException $e) {
            print_r('Error conenection: ' . $e->getMessage());
        }
    }
}

?>