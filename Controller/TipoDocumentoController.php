<?php
Class TipoDocumento{
    public $id;
    public $tipo;
}
Class TiposDocumentos extends DB{

    public function GetTiposDocumentos(){
        $query = $this->connect()->prepare('SELECT * FROM tipo_documento ORDER BY tipo');
            $query->execute();
            $arraytipos = array();
            
            foreach ($query as $c) {
                array_push($arraytipos, $c);
            }
            return $arraytipos;
    }

    public function GetTiposDocumentosPorId($id){
        $query = $this->connect()->prepare('SELECT * FROM tipo_documento WHERE id = :id');
            $query->execute(['id' => $id]);
                        
            foreach ($query as $c) {
                $tipo = $c['tipo'];
            }
            return $tipo;
    }
}

?>