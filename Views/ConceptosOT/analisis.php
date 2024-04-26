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
        <div class="col-lg-4">
            <h2>Concepto OT</h2>
        </div>
        <div class="col-lg-2">
                <select id="periodoC" class="form-control" name="periodoC" required style="width: 100%;">
                    <option  value="TOTAL">TOTAL</option>
                    <option  value="2015">2015</option>
                    <option  value="2016">2016</option>
                    <option  value="2017">2017</option> 
                    <option  value="2018">2018</option>
                    <option  value="2019">2019</option> 
                    <option  value="2020">2020</option>
                    <option  value="2021">2021</option>
                    <option  value="2022">2022</option> 
                    <option  value="2023">2023</option>
                    <option  value="2024">2024</option>     
                </select> 
        </div>
        <div class="col-lg-4">
                <select id="concepto2" class="form-control" name="concepto2" required style="width: 100%;">
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
