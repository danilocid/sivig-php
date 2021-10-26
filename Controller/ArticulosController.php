<?php

Class Articulos extends DB{
    public function GetArticulos(){
        $query = $this->connect()->prepare('SELECT * FROM articulos');
        $query->execute();
        $arrayarticulos = array();
        
        foreach ($query as $a) {
            

            array_push($arrayarticulos, $a);
        }
        return $arrayarticulos;
    }

    public function AgregarArticulos($articulos, $enlace){
        $query = $this->connect()->prepare('SELECT * FROM articulos WHERE cod_interno = :cod_interno OR cod_barras = :cod_barras');
        $query->execute(['cod_interno' => $articulos[0]->cod_interno, 'cod_barras' => $articulos[0]->cod_barras]);
        if ($query->rowCount()) {
            echo '<script type="text/javascript">
            window.location="articulos.php?m=1";
            </script>';
        } else {
            try {
                $query = $this->connect()->prepare('INSERT INTO articulos VALUES(null, :cod_interno, :cod_barras, :descripcion,
                :costo_neto, :costo_imp, :venta_neto, :venta_imp, :stock, :activo)');
                $query->execute([
                    'cod_interno' => $articulos[0]->cod_interno,
                    'cod_barras' => $articulos[0]->cod_barras,
                    'descripcion' => $articulos[0]->descripcion,
                    'costo_neto' => $articulos[0]->costo_neto,
                    'costo_imp' => $articulos[0]->costo_imp,
                    'venta_neto' => $articulos[0]->venta_neto,
                    'venta_imp' => $articulos[0]->venta_imp,
                    'stock' => $articulos[0]->stock,
                    'activo' => $articulos[0]->activo
                ]);
                echo '<script type="text/javascript">
                    window.location="'.$enlace.'?m=2";
                  </script>';
            } catch (PDOException $e) {
                print_r('Error conenection: ' . $e->getCode());
               
            }
        }
    }
    public function GetArticulosPorId($id){
        $query = $this->connect()->prepare('SELECT * FROM articulos WHERE id = :id');
        $query->execute(['id' => $id]);
        $arrayarticulos = array();
        
        foreach ($query as $a) {
            
            array_push($arrayarticulos, $a);
        }
        return $arrayarticulos;
    }
    public function GetDescripcionArticuloPorId($id){
        $query = $this->connect()->prepare('SELECT * FROM articulos WHERE id = :id');
        $query->execute(['id' => $id]);
       
        
        foreach ($query as $a) {
            $descripcion = $a[3];
            
        }
        return $descripcion;
    }
    public function GetPrecioDeVentaArticuloPorId($id){
        $query = $this->connect()->prepare('SELECT * FROM articulos WHERE id = :id');
        $query->execute(['id' => $id]);
       
        
        foreach ($query as $a) {
            $precio = $a[6] + $a[7];
            
        }
        return $precio;
    }

    public function EditarArticulo($articulo){
        try {
            $query = $this->connect()->prepare('UPDATE articulos SET cod_interno = :cod_interno, cod_barras = :cod_barras,
            descripcion = :descripcion, venta_neto = :venta_neto, venta_imp = :venta_imp,
            activo = :activo WHERE id = :id');
            $query->execute([
                'id' => $articulo[0]->id,
                'cod_interno' => $articulo[0]->cod_interno,
                'cod_barras' => $articulo[0]->cod_barras,
                'descripcion' => $articulo[0]->descripcion,
                'venta_neto' => $articulo[0]->venta_neto,
                'venta_imp' => $articulo[0]->venta_imp,
                'activo' => $articulo[0]->activo
            ]);
            echo '<script type="text/javascript">
                window.location="Articulos?m=3";
              </script>';
        } catch (PDOException $e) {
            print_r('Error conenection: ' . $e->getMessage());
           
        }
    }
    public function UpdateStockArticuloPorId($id, $cantidad, $costo_neto, $costo_imp){
        try{
        $query = $this->connect()->prepare('SELECT * FROM articulos WHERE id = :id');
        $query->execute(['id' => $id]);
       
        
        foreach ($query as $a) {
            $stock = $a['stock'];
            
        }
        $stock = $stock + $cantidad;
        $query = $this->connect()->prepare('UPDATE articulos SET stock = :stock, costo_neto = :costo_neto, costo_imp = :costo_imp WHERE id = :id');
        $query->execute(['id' => $id,
        'stock' => $stock,
        'costo_neto' => $costo_neto,
        'costo_imp' => $costo_imp]);
    }catch (PDOException $e) {
        echo 'error al actualizar el stock del articulo';
        print_r('Error conenection: ' . $e->getMessage());
       
    }
    }
    public function UpdateStockArticuloVentaPorId($id, $cantidad){
        try{
        $query = $this->connect()->prepare('SELECT * FROM articulos WHERE id = :id');
        $query->execute(['id' => $id]);
       
        
        foreach ($query as $a) {
            $stock = $a['stock'];
            
        }
        $stock = $stock - $cantidad;
        $query = $this->connect()->prepare('UPDATE articulos SET stock = :stock WHERE id = :id');
        $query->execute(['id' => $id,
        'stock' => $stock
        ]);
    }catch (PDOException $e) {
        echo 'error al actualizar el stock del articulo';
        print_r('Error conenection: ' . $e->getMessage());
       
    }
    }
}


?>