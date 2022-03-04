<?php
$titulo = 'Agregar ajuste de inventario';
$idpagina = 9;
include 'Includes/partials/header.php';
include 'Includes/partials/menu.php';
include 'Controller/ArticulosController.php';
include 'Controller/AjustesDeInventarioController.php';
$monto_total = 0;
$monto_imp = 0;
$total_articulos = 0;
$articulo = new Articulos();
$articulos = $articulo->GetArticulos();
$ajustes = new AjustesDeInventario();
class ArticuloAjuste
{
    public $id;
    public $cantidad;
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agregar ajuste de inventario</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ajuste de inventario</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>

            </div>
            <div class="card-body">

                <!-- Inicio contenido -->



                <div class="row">

                    <div class="col-md-4">
                        <!-- general form elements -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Busqueda de productos</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form action="AgregarArticuloAjuste" method="POST">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Articulo</label>
                                        <select id="articulo" name="articulo" required class="form-control select2">
                                            <option value="">Buscar articulo</option>
                                            <?php
                                            foreach ($articulos as $t) {
                                                echo '<option value="' . $t['id'] . '">' . $t['cod_barras'] . ' - ' . $t['descripcion'] . '</option>';
                                            }
                                            ?>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="cantidad">Tipo</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo" value="IN">
                                            <label class="form-check-label">Entrada</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo" value="OUT"
                                                checked="">
                                            <label class="form-check-label">Salida</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad" name="cantidad" required
                                            value=1>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-8">
                        <!-- general form elements disabled -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Ajuste de inventario</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="tabla2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Descripcion</th>
                                            <th style="width: 100px">Costo neto</th>
                                            <th style="width: 60px">Cantidad</th>
                                            <th style="width: 60px">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_SESSION['articulo'])) {
                                            foreach ($_SESSION['articulo'] as $a) {
                                                $articuloventa = $articulo->GetArticulosPorId($a->id);
                                                $monto_total = $monto_total + ($articuloventa[0]['costo_neto'] * $a->cantidad);
                                                $monto_imp = $monto_imp + ($articuloventa[0]['costo_imp'] * $a->cantidad);
                                                echo '<tr><td>' . $articuloventa[0]['cod_interno'] . '</td>';
                                                echo '<td>' . $articuloventa[0]['descripcion'] . '</td>';
                                                echo '<td>' . $articuloventa[0]['costo_neto'] * $a->cantidad . '</td>';
                                                echo '<td>
                    <input class="form-control input-sm" type="number" name="cantidad" required value="' . ($a->tipo == 'IN' ? $a->cantidad : $a->cantidad * -1) . '">
                    </td>';

                                                echo '<td>
                    <form action="EliminarArticuloAjuste" method="POST">
                    <input type="hidden" name="id" value="' . $a->id . '">
                    
                    <button type="submit" class="btn btn-block btn-primary btn-sm" name="Eliminar" value="Eliminar">Eliminar</button>
                    </form>
                    </td>';

                                                echo '</tr>
                    ';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                </br>
                                <?php
                                if (isset($_SESSION['articulo'])) {
                                    foreach ($_SESSION['articulo'] as $a) {

                                        $total_articulos = $total_articulos + abs($a->cantidad);
                                    }
                                    echo '
            <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                  <label>Monto total</label>
                  <input id="monto_total" name="monto_total" disabled type="text" class="form-control input-sm" value="$' . number_format($monto_total, 0, ',', '.') . '">
                  <input id="monto_total" name="monto_total" type="hidden" class="form-control input-sm" value="' . $monto_total . '">
              </div>
            </div>';
                                    echo '<div class="col-md-3">
              <div class="form-group">
                  <label>Total articulos</label>
                  <input id="total_articulos" name="total_articulos" disabled type="text" class="form-control input-sm" value="' . number_format($total_articulos, 0, ',', '.') . '">
              </div>
            </div>';
                                    echo '</div>
           <div class="row">
            <div class="col-md-3">
          <br>
            <div class="float-right">
            <button type="button" class="btn  btn-lg btn-info" data-toggle="modal" data-target="#modal-default">
                    Finalizar ajuste de inventario
                  </button>
            </div>
            </div>
            </div>';
                                }

                                ?>
                            </div>
                            <div class="modal fade" id="modal-default">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Finalizar ajuste de inventario</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>

                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="AgregarAjustes" method="POST">

                                                <div class="form-group">
                                                    <label>Observaciones</label>
                                                    <input id="observaciones" name="observaciones" required type="text"
                                                        class="form-control input-sm">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tipo de movimiento</label>
                                                    <select id="tipo_movimiento" name="tipo_movimiento"
                                                        class="form-control select2">
                                                        <?php
                                                        $tipos = $ajustes->GetTipoMovimientos();
                                                        foreach ($tipos as $t) {
                                                            echo '<option value="' . $t['id'] . '">' . $t['tipo'] . '</option>
                                ';
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Monto neto</label>
                                                    <input id="monto_neto" name="monto_neto" disabled type="text"
                                                        class="form-control input-sm"
                                                        value="$<?php echo number_format($monto_total, 0, ',', '.'); ?>">
                                                    <input id="monto_neto" name="monto_neto" type="hidden"
                                                        class="form-control input-sm"
                                                        value="<?php echo $monto_total; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Impuestos</label>
                                                    <input id="monto_imp" name="monto_imp" disabled type="text"
                                                        class="form-control input-sm"
                                                        value="$<?php echo number_format($monto_imp, 0, ',', '.'); ?>">
                                                    <input id="monto_imp" name="monto_imp" type="hidden"
                                                        class="form-control input-sm" value="<?php echo $monto_imp; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Monto total</label>
                                                    <input id="monto_total" name="monto_total" disabled type="text"
                                                        class="form-control input-sm"
                                                        value="$<?php echo number_format($monto_total + $monto_imp, 0, ',', '.'); ?>">
                                                    <input id="monto_total" name="monto_total" type="hidden"
                                                        class="form-control input-sm"
                                                        value="<?php echo ($monto_total * 1.19); ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Total articulos</label>
                                                    <input id="total_articulos" name="total_articulos" readonly
                                                        type="text" class="form-control input-sm"
                                                        value="<?php echo number_format($total_articulos, 0, ',', '.'); ?>">
                                                </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left"
                                                data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Agregar ajuste</button>

                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- /.card-body -->





                            <!-- /.card-body -->
                            <div class="card-footer">
                                Carrito

                            </div>
                        </div>
                    </div>
    </section>
</div>
<!-- /.card-footer-->






<!-- /.modal-content -->

<!-- /.modal-dialog -->


<!-- Fin contenido -->



<!-- Default box -->

<!-- Fin contenido -->



<!-- Default box -->


<?php
if (isset($_GET['m'])) {
    if ($_GET['m'] == 1) {
        echo '<script type="text/javascript">';
        echo "$('#cliente-existe').modal('toggle');
      
    </script>";
    }
    if ($_GET['m'] == 2) {
        echo '<script type="text/javascript">';
        echo "$('#cliente-editado').modal('toggle');
      
    </script>";
    }
}

include 'Includes/partials/footer.php';

?>