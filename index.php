<?php
$titulo = 'Inicio';
$idpagina = 0;
include 'Includes/partials/header.php';
include 'Includes/partials/menu.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inicio</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Accesos directos</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>

                </div>
            </div>
            <div class="card-body">
                <!-- Inicio contenido -->
                <a href="AgregarVenta" class="btn  btn-lg btn-info"> Agregar venta</a>
                <a href="Clientes" class="btn  btn-lg btn-info"> Clientes</a>
                <a href="Proveedores" class="btn  btn-lg btn-info"> Proveedores</a>
                <a href="AgregarRecepcion" class="btn  btn-lg btn-info"> Agregar recepcion</a>
                <a href="./DB/respaldodb.php" class="btn  btn-lg btn-info">Respaldar DB</a>
                <!-- Fin contenido -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Accesos directos
            </div>
            <!-- /.card-footer-->
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Faltantes</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>

                </div>
            </div>
            <div class="card-body">
                <p>Funcionalidad en desarrollo: funcion de realizacion de inventario selectivo</p>
                <ul>
                    <li>General</li>
                    <ul>
                        <li>
                            Mejorar estructura general de los archivos (crear mini framework)
                        </li>
                    </ul>
                    <li>Ventas</li>
                    <li>Articulos</li>
                    <ol>
                        <li>
                            Falta boton para ver el detalle del movimiento en historial del articulo
                        </li>

                    </ol>
                    <li>Clientes</li>
                    <ol>
                        <li>*Falta crear PDF con datos del cliente</li>
                        <li>*Falta crear resumen de todos los clientes</li>
                        <li>*Falta mejorar estetica informes en PDF</li>
                        <li>falta boton para ver venta en historial cliente</li>
                        <li>
                            historial de articulos comprados por cliente no suma articulos
                            iguales
                        </li>
                    </ol>
                    <li>Recepcion</li>
                    <ol>
                        <li>
                            *validacion de documento solo valida el numero y no el tipo
                        </li>
                        <li>
                            *No hay validacion de que existan articulos en la recepcion
                        </li>
                        <li>*Falta mejorar estetica de detalle de recepcion</li>
                        <li>*Mejorar estetica PDF recepcion(dice detalle venta)</li>
                        <li>no se puede crear articulo desde recepcion</li>
                        <li>no se puede crear proveedor desde recepcion</li>
                    </ol>
                    <li>Proveedores</li>
                    <ol>
                        <li>Falta ver historial de proveedor</li>
                        <li>*Agregar nombre de fantasia</li>
                        <li>*Falta agregar cliente como proveedor</li>
                        <li>Falta poder generar PDF con datos del proveedor</li>
                        <li>*Falta exportar todos los Proveedores a PDF</li>
                        <li>
                            falta mejorar estetica PDF historial articulos proveedor
                        </li>
                        <li>error en direccion de mensajes de aviso</li>
                    </ol>
                    <li>gastos</li>
                    <ol>
                        <li>Falta logica completa</li>
                    </ol>
                    <li>Reportes</li>
                    <ol>
                        <li>falta informe de impuestos</li>
                        <li>Falta formulario completo</li>
                        <li>Falta reporte de ventas por fecha</li>
                        <li>falta reporte de saldo en cuentas</li>
                    </ol>
                    <li>Administracion</li>
                    <ol>
                        <li>Agregar administracion de medios de pago</li>
                        <li>agregar administracion de cuentas bancarias</li>
                    </ol>
                    <li>Funciones futuras</li>
                    <ol>
                        <li>falta administracion de gastos</li>
                        <li>falta calcular margen de ganancia</li>
                        <li>
                            Falta alerta de cantidad insuficiente en stock del articulo
                        </li>
                        <li>Falta generar excel o csv con datos de los articulos</li>
                        <li>Falta agregar stock critico</li>
                        <li>
                            Falta crear informe de articulos con stock critico (falta
                            crear stock critico en tabla articulos)
                        </li>
                        <li>
                            al recibir pago con tarjetas estos deben quedar pendientes por
                            ingresar debido a las comisiones involucradas
                        </li>
                        <li>
                            Habilitar botones de edicion solo si se modifican los datos
                        </li>
                        <li>
                            generar codigos de barra para los productos
                            https://barcode.tec-it.com/es/
                        </li>
                        <li>
                            en pantalla de inicio faltan widget con datos resumen (ventas,
                            saldo en cuentas bancarias, etc)
                        </li>
                        <li>
                            generar resumen final mensual con ventas y gastos realizados
                            en un determinado mes
                        </li>
                        <li>Falta integracion con API MercadoLibre</li>
                        <li>Falta integracion con API PrestaShop</li>
                    </ol>
                </ul>
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php



include 'Includes/partials/footer.php';
?>