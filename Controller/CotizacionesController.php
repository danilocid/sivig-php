<?php
Class Cotizacion {
    public $id;
    public $cliente;
    public $monto;
    public $estado;
    public $fecha;
    public $usuario;
    public $observaciones;
    
}
Class Cotizaciones extends DB{
    public function GetCotizaciones(){
        $query = $this->connect()->prepare('SELECT * FROM cotizaciones');
        $query->execute();
        $arraycotizaciones = array();
        
        foreach ($query as $a) {
            $cotizaciones = new Cotizacioes();
            array_push($arraycotizaciones, $a);
        }
        return $arraycotizaciones;
    }

}
?>