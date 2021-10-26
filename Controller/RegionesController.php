<?php
Class Region{
public $id;
public $region;
}
Class Regiones extends DB{
    public function GetRegiones()
    {
        $query = $this->connect()->prepare('SELECT * FROM regiones');
        $query->execute();
        $regiones = array();
        foreach ($query as $r) {
            $reg = new Region();
            $reg->id = $r['id'];
            $reg->region = $r['region'];

            array_push($regiones, $reg);
        }
        return $regiones;
    }
    public function GetRegionPorId($id){
        $query = $this->connect()->prepare('SELECT * FROM regiones WHERE id = :id');
            $query->execute(['id' => $id]);
            
            foreach ($query as $respuesta){
                $this->region = $respuesta['region'];
            }
            return $this->region;
    }
}

?>