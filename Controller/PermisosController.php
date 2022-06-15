<?php
class Permisos
{
    public $IdPermiso;
    public $IdPagina;
    public $Permiso;
    public $NombrePagina;
}
class Paginas
{
    public $IdPagina;
    public $NombrePagina;
    public $GrupoPagina;
}

class GruposPaginas
{
    public $IdGrupo;
    public $NombreGrupo;
    public $PosicionGrupo;
}

class Permiso extends DB
{
    public function GetGruposPaginas()
    {
        $query = $this->connect()->prepare('SELECT * FROM grupospaginas ORDER BY posicion ASC');
        $query->execute();
        $grupos = array();
        foreach ($query as $g) {
            $grupo = new GruposPaginas();
            $grupo->IdGrupo = $g[0];
            $grupo->NombreGrupo = $g[1];
            $grupo->PosicionGrupo = $g[3];
            array_push($grupos, $grupo);
        }
        return $grupos;
    }
    public function GetPaginas()
    {
        try {
            $query = $this->connect()->prepare('SELECT * FROM paginas');
            $query->execute();
            $paginas = array();
            foreach ($query as $p) {
                $pagina = new Paginas();
                $pagina->IdPagina = $p[0];
                $pagina->NombrePagina = $p[1];
                $pagina->GrupoPagina = $p[4];
                array_push($paginas, $pagina);
            }
            return $paginas;
        } catch (\Throwable $th) {
            echo "Error en la consulta";
        }
    }

    public function GetPermisosUsuario($IdUsuario)
    {

        try {
            $query = $this->connect()->prepare('SELECT * FROM permisos INNER JOIN paginas ON permisos.Idpagina = paginas.IdPagina WHERE IdUsuario = :IdUsuario ');
            $query->execute(['IdUsuario' => $IdUsuario]);
            $arraypermisos = array();
            foreach ($query as $p) {
                $permisos = new Permisos();
                $permisos->IdPermiso = $p['IdPermiso'];
                $permisos->IdPagina = $p['IdPagina'];
                $permisos->Permiso = $p['Permiso'];
                $permisos->NombrePagina = $p['NombrePagina'];

                array_push($arraypermisos, $p);
            }

            return $arraypermisos;
        } catch (\Throwable $th) {
            echo "Error en la consulta";
        }
    }

    public function ModificaPermisos($IdUsuario, $datos)
    {
        //echo $IdUsuario;
        //print_r($datos);
        foreach ($datos as $d) {
            try {
                $query = $this->connect()->prepare('UPDATE permisos SET Permiso = :Permiso WHERE IdPermiso = :IdPermiso AND IdUsuario = :IdUsuario; ');
                $query->execute(['Permiso' => $d->Permiso, 'IdPermiso' => $d->IdPermiso, 'IdUsuario' => $IdUsuario]);
            } catch (PDOException $e) {
                print_r('Error conenection: ' . $e->getMessage());
            }
        }
        /*echo '<script type="text/javascript">
        window.location="Usuarios?m=3";
      </script>';/**/
    }

    public function CreaPermisos($IdUsuario)
    {
        $query = $this->connect()->prepare('SELECT IdPagina FROM paginas');
        $query->execute();
        $arraypaginas = array();

        foreach ($query as $p) {
            $paginas = new Permisos();
            $paginas->IdPagina = $p[0];


            array_push($arraypaginas, $p);
        }

        foreach ($arraypaginas as $p) {
            $query = $this->connect()->prepare('INSERT INTO permisos VALUES (null, :IdUsuario, :IdPagina, 0);');
            $query->execute(['IdUsuario' => $IdUsuario, 'IdPagina' => $p[0]]);
        }
        echo '<script type="text/javascript">
                    window.location="Usuarios";
                  </script>';
    }
}