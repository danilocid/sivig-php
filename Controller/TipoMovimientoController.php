<?php
Class TipoMovimiento{
    public $id;
    public $tipo;
}
Class TiposMovimientos extends DB{

    public function GetTiposMovimientos(){
        $query = $this->connect()->prepare('SELECT * FROM tipo_movimiento ORDER BY tipo');
            $query->execute();
            $arraytipos = array();
            
            foreach ($query as $c) {
                array_push($arraytipos, $c);
            }
            return $arraytipos;
    }

    public function GetTiposMovimientosId($id){
        $query = $this->connect()->prepare('SELECT * FROM tipo_movimiento WHERE id = :id');
            $query->execute(['id' => $id]);
                        
            foreach ($query as $c) {
                $tipo = $c['tipo'];
            }
            return $tipo;
    }
}

?>