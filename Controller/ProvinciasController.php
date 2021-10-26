<?php


Class Provincia{
    public $Id;
    public $provincia;
    public $region_id;

}
Class Provincias extends DB{
    public function GetProvinciasPorRegion($idregion)
    {
        $query = $this->connect()->prepare('SELECT * FROM provincias WHERE region_id = :idregion');
        $query->execute(['idregion' => $idregion]);
        $provincias = array();
        foreach ($query as $p) {
            $pro = new Provincia();
            $pro->id = $p['id'];
            $pro->provincia = $p['provincia'];
            $pro->region_id = $p['region_id'];

            array_push($provincias, $pro);
        }
        return $provincias;
    }
    public function GetProvinciaPorId($id){
        $query = $this->connect()->prepare('SELECT * FROM provincias WHERE id = :id');
        $query->execute(['id' => $id]);
            
            foreach ($query as $respuesta){
                $this->provincia = $respuesta['provincia'];
            }
            return $this->provincia;

    }
}


?>