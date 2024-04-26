<?php include "Views/templates/navbar.php"; ?>
<p></p>

<div class="col-lg-12">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Gráfica por Trabajos Realizados</h1>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-5">
            <h2>Concepto OT</h2>
        </div>
        <div class="col-lg-1">
        </div>
        <div class="col-lg-4">
                <select id="concepto2" class="js-example-basic-multiple" name="concepto2" required style="width: 100%;">
                <!--<option id="selectAutor" value="0">Seleccione</option> -->
                </select> 
        </div>
        <div class="col-lg-2">
            <button class="w-100 btn btn-warning btn-lg" type="submit" onclick="generarGrafica()">GENERAR</button>
        </div>
        <p></p>

    </div>
</div>
<div class="col-lg-12">
    <canvas id="badCanvas1" width="400" height="100"></canvas>
</div>

<?php include "Views/templates/footer.php"; ?>
