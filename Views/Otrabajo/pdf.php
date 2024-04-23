<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">    <!-- REMIX ICON--><link rel="stylesheet" href="./Plantillapdf_files/remixicon.css">
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
        <tr><td>1000001210</td><td>20521180774</td><td>ZGROUP S.A.C.</td><td></td><td>TITTO raul</td><td>REC. HONORARIO</td><td>150</td><td>1</td><td>0</td><td>150</td><td>150</td><td><button class="btn btn-danger">Eliminar</button></td></tr></tbody>
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
        <tr><td>S0001473</td><td>INDND0374</td><td>DILUIDO SECADO RAPIDO BLANCO 1X5</td><td>soles</td><td>4.5</td><td>GL</td><td>27.9661</td><td>125.85</td><td>148.50</td><td>TITTO RAUL</td><td>9/13/2016</td><td></td></tr><tr><td>S0001473</td><td>INDND0007</td><td>THINNER ACRILICO</td><td>soles</td><td>5</td><td>GL</td><td>14.406</td><td>72.03</td><td>85.00</td><td>TITTO RAUL</td><td>9/13/2016</td><td></td></tr><tr><td>S0001473</td><td>INDND0407</td><td>CINTA MASKING # 2</td><td>soles</td><td>1</td><td>UND</td><td>6.96</td><td>6.96</td><td>8.21</td><td>TITTO RAUL</td><td>9/13/2016</td><td></td></tr><tr><td>S0014169</td><td>RNDND0173</td><td>CORTINA DE VINIL REFORZADA 20CM X 2MM X 91.4MT</td><td>dolares</td><td>16</td><td>M</td><td>2.4656</td><td>39.45</td><td>46.55</td><td>TITTO RAUL</td><td>6/23/2022</td><td>ENTREGA</td></tr><tr><td>S0014169</td><td>INDND2760</td><td>PLACA DE SUJECION (ACERO INOXIDABLE)</td><td>dolares</td><td>16</td><td>UND</td><td>0.9754</td><td>15.61</td><td>18.42</td><td>TITTO RAUL</td><td>6/23/2022</td><td>ENTREGA</td></tr><tr><td>S0014169</td><td>INDND2759</td><td>POLEA DE ALEACION A PRUEBA DE OXIDACION</td><td>dolares</td><td>16</td><td>UND</td><td>0.10024</td><td>1.60</td><td>1.89</td><td>TITTO RAUL</td><td>6/23/2022</td><td>ENTREGA</td></tr><tr><td>S0014169</td><td>INDND2758</td><td>CARRIL DE GUIA DE ALUMINIO.</td><td>dolares</td><td>1</td><td>UND</td><td>3</td><td>3.00</td><td>3.54</td><td>TITTO RAUL</td><td>6/23/2022</td><td>ENTREGA</td></tr></tbody>
        </table>
<!--</form>-->



</div></body></html>