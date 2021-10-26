<?php
include 'Model/dbConection.php';
class Menus{
    public $NombrePagina;
    public $EnlacePagina;
    public $IdPagina;
    public $ImagenPagina;
    public $GrupoPagina;
}
class Grupos{
    public $IdGrupo;
    public $NombreGrupo;
    public $ImagenGrupo;
    public $PosicionGrupo;
}
class Menu extends DB{
        public function Getpaginas($idusuario, $idgrupo){
        $query = $this->connect()->prepare('SELECT * FROM paginas INNER JOIN permisos on permisos.Idpagina = paginas.IdPagina WHERE permisos.IdUsuario = :idusuario AND permisos.Permiso = 1 AND paginas.grupopagina = :idgrupo');
        $query->execute(['idusuario' => $idusuario, 'idgrupo' => $idgrupo]);
        $menusa = array();
        
        foreach ($query as $Menua) {
            $m = new Menus();
            $m->NombrePagina = $Menua[1];
            $m->EnlacePagina = $Menua[2];
            $m->IdPagina = $Menua[0];
            $m->ImagenPagina = $Menua['Imagen'];
            $m->GrupoPagina = $Menua[4];

            array_push($menusa, $m);
        }
        return $menusa;
       }
       public function GetPermisoPagina($idusuario, $idpagina){
        $query = $this->connect()->prepare('SELECT * FROM permisos WHERE IdUsuario = :idusuario AND Idpagina = :idpagina AND Permiso = 1');
        $query->execute(['idusuario' => $idusuario, 'idpagina' => $idpagina]);
        if($query->rowCount()){
            return false;
        }else{
            return true;
            }
        }
        public function GetGrupoPagina($idpagina){
            $query = $this->connect()->prepare('SELECT grupopagina FROM paginas WHERE Idpagina = :idpagina');
            $query->execute(['idpagina' => $idpagina]);
            foreach ($query as $a) {
                
                $idgrupo = $a[0];
            
            }
        return $idgrupo;
    }
        public function GetGrupos(){
            $query = $this->connect()->prepare('SELECT * FROM grupospaginas ORDER BY posicion ASC');
            $query->execute();
            $grupos = array();
            
            foreach ($query as $g) {
                
    
                array_push($grupos, $g);
            }
            return $grupos;
           }
}

?>