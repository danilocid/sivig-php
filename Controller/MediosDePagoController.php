<?php
Class MedioDePago{
    public $id;
    public $medio_pago;
}
Class MediosDePago extends DB{
    public function GetMediosDePago(){
        $query = $this->connect()->prepare('SELECT * FROM medios_de_pago');
        $query->execute();
        $arraymedios = array();
        
        foreach ($query as $a) {
            
            array_push($arraymedios, $a);
        }
        return $arraymedios;
    }
    public function GetMediosDePagoPorId($id){
        $query = $this->connect()->prepare('SELECT * FROM medios_de_pago WHERE id = :id');
        $query->execute(['id' => $id]);
        $arraymedios = array();
        
        foreach ($query as $a) {
            
            $medio = new MedioDePago;
            $medio->medio_pago = $a[1];
        }
        return $medio->medio_pago;
    }
}

?>