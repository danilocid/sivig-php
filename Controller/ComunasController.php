<?php
class Comuna
{
    public $Id;
    public $comuna;
    public $region_id;
}
class Comunas extends DB
{
    public function GetComunaPorId($IdComuna)
    {

        $query = $this->connect()->prepare('SELECT * FROM comunas WHERE id = :IdComuna');
        $query->execute(['IdComuna' => $IdComuna]);

        foreach ($query as $respuesta) {
            $this->comuna = $respuesta['comuna'];
        }
        return $this->comuna;
    }
    public function GetComunaPorRegion($IdRegion)
    {

        $query = $this->connect()->prepare('SELECT * FROM comunas WHERE region_id = :IdRegion');
        $query->execute(['IdRegion' => $IdRegion]);
        $comunas = array();
        foreach ($query as $respuesta) {
            $comuna = new Comuna();
            $comuna->Id = $respuesta['id'];
            $comuna->Comuna = $respuesta['comuna'];
            array_push($comunas, $comuna);
        }
        return $comunas;
    }
}