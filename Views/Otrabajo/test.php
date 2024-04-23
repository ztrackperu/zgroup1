
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP 5 CDN--><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- REMIX ICON--><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
    <title>Plantilla</title>
</head>

<body>
    <div class="container" id="contenido">
<!--<form  id="form1" name="form1" >-->
        <div class="row">
            <div class="col-6">
                <h3>Ingrese su N° OT</h3>
                <input type="text" id="busqueda" name="busqueda" class="form-control" value="">
                <button type="text" class="btn btn-primary" id="busquedaInput">Búsqueda</button>
                <button type="text" class="btn btn-success" id="enviarInput">Enviar Correo</button>
             
                <button type="text" class="btn btn-secondary" id="btnReporte">Generar Reporte</button>
            </div>
        </div>
        <div class="row"><div class="col-12"><h3>Detalle de trabajo</h3></div></div>
        <div class="row">
            
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                            <label for="nrOrdenInput">Nro Orden de Trabajo</label>
                            <input type="text" id="nrOrdenInput" name="nrOrdenInput" class="form-control">
                            <label for="rucInput">RUC</label>
                            <input type="text" class="form-control" id="rucInput">
                            <label for="proveedorInput">Proveedor</label>
                            <input type="text" class="form-control" id="proveedorInput">
                            <label for="trabajoInput">Trabajo Realizado</label>
                            <input type="text" class="form-control" id="trabajoInput">
                            <label for="tecnicoInput">Tecnico Encargado</label>
                            <input type="text" class="form-control" id="tecnicoInput">
                    </div>
                    <div class="col-6">
                            <label for="tipoDscInput">Tipo Dcto</label>
                            <input type="text" class="form-control" id="tipoDscInput">
                            <label for="montoUnitarioInput">Monto Unitario</label>
                            <input type="text" class="form-control" id="montoUnitarioInput">
                            <label for="cantDctoInput">Cant Dcto</label>
                            <input type="text" class="form-control" id="cantDctoInput">
                            <label for="igvDscInput">IGV</label>
                            <input type="text" class="form-control" id="igvDscInput">
                            <label for="totalDctoInput">Total Dcto</label>
                            <input type="text" class="form-control" id="totalDctoInput">
                            <label for="montoUntPactadoInput">Monto Unit. Pactado</label>
                            <input type="text" class="form-control" id="montoUntPactadoInput">
                    </div>
                </div>
                <button type="button" class="btn btn-danger mt-3 add_input_button" id="añadir">Añadir detalle</button>
            </div>
        </div>
        <!------------------------------------------AGREGAR DETALLE DE TRABAJO --------------------------------------->
        <table class="table table-dark" id="agregarDetalle">
        <thead>
            <tr>
                <th>N° OT</th>
                <th>RUC</th>
                <th>Proveedor</th>
                <th>Trabajo Realizado</th>
                <th>Tenico Encargado</th>
                <th>Tipo Dcto</th>
                <th>MU</th>
                <th>Cant Dcto</th>
                <th>IGV</th>
                <th>Total Dcto</th>
                <th>MU Pactado</th>
                <th></th>
                
            </tr>
        </thead>
        <tbody>

        </tbody>
        </table>

        <!------------------------------------------FIN CONTENIDO AGREGAR DETALLE DE TRABAJO-------------------------->
        <!----------------------------------------- CARGAR DETALLE DE TRABAJO----------------------------------------->
        <table class="table table-dark" id="cargarDetalle">
        <thead>
            <tr>
                <th>N° OT</th>
                <th>RUC</th>
                <th>Proveedor</th>
                <th>Trabajo Realizado</th>
                <th>Tenico Encargado</th>
                <th>Tipo Dcto</th>
                <th>MU</th>
                <th>Cant Dcto</th>
                <th>IGV</th>
                <th>Total Dcto</th>
                <th>MU Pactado</th>
                <th></th>
                <!--<th>Accion</th>-->
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
        <!----------------------------------------- FIN CONTENIDO DETALLE DE TRABAJO----------------------------------------->
        <div class="row mt-5">
            <div class="col-12">
                <h3>Insumos y respuestos Utilizados para este Trabajo</h3>
            </div>
        </div>
        <table class="table table-dark" id="añadirDetalleInsumo">
        <thead>
            <tr>
                <th>Nota Salida</th>
                <th>Cod producto</th>
                <th>Descripcion</th>
                <th>Moneda</th>
                <th>Cantidad</th>
                <th>Unidad Medida</th>
                <th>Precio UND.</th>
                <th>Precio Total</th>
                <th>Precio Total + IGV</th>
                <th>Responsable</th>
                <th>Fecha de NS</th>
                <th>Motivo</th>
            
                <!--<th>Accion</th>-->
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
<!--</form>-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        const base_url = '<?php echo base_url; ?>';
       console.log(base_url);
    </script>

    <script src="..\assets\js\Otrabajo.js"></script>

</body>
</html>