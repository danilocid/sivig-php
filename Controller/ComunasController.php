<?php
Class Comuna{
    public $Id;
    public $comuna;
    public $provincia_id;

}
Class Comunas extends DB{
    public function GetComunaPorId($IdComuna){
        
            $query = $this->connect()->prepare('SELECT * FROM comunas WHERE id = :IdComuna');
            $query->execute(['IdComuna' => $IdComuna]);
            
            foreach ($query as $respuesta){
                $this->comuna = $respuesta['comuna'];
            }
            return $this->comuna;
    }
    public function GetComunaPorProvincia($IdProvincia){
        
        $query = $this->connect()->prepare('SELECT * FROM comunas WHERE provincia_id = :IdProvincia');
        $query->execute(['IdProvincia' => $IdProvincia]);
        $comunas = array();
        foreach ($query as $respuesta){
            $comuna = new Comuna();
            $comuna->Id = $respuesta['id'];
            $comuna->Comuna = $respuesta['comuna'];
            array_push($comunas, $comuna);
        }
        return $comunas;
}
}


?>