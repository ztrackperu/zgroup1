<?php include "Views/templates/navbar.php"; ?>
<p></p>

<div class="col-lg-12">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Asignar Recursos a conceptos OT</h1>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <?php 
    if($data =="ok"){
        $proceso="";
        echo "sin datos";
    }else{
        $proceso = json_decode($data);
        echo var_dump(($proceso->data)); 
    }
    ?>
</div>
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-5">
            <h2>Concepto OT</h2>
        </div>
        <div class="col-lg-1">
        <button class="btn btn-primary mb-2" type="button" onclick="frmConceptosOT();">+<i class="fa fa-plus"></i></button>
        </div>
        <div class="col-lg-4">
                <select id="concepto2" class="js-example-basic-multiple" name="concepto2" required style="width: 100%;">
                <!--<option id="selectAutor" value="0">Seleccione</option> -->
                </select> 
        </div>
        <div class="col-lg-2">
            <button class="w-100 btn btn-warning btn-lg" type="submit" onclick="asignarConcepto()">SELECCIONAR</button>
        </div>
        <p></p>
        <div class="col-lg-4">
            <h3>Insumos a Incorporar</h3>    
        </div>
        <div class="col-lg-6">
            <select id="insumosL" class="js-example-basic-multiple"  name="insumosL[]" multiple="multiple"  style="width: 100%;" ></select>
        </div>
        <div class="col-lg-2">
            <button class="w-100 btn btn-success btn-lg" type="submit"  onclick="tomarInsumos()">AGREGAR<i class="fa fa-plus"></i></button>
        </div>

        <div class="col-lg-4">
            <div class="form-group">
                <label for="titulo">Codigo Concepto</label>
                <input type="hidden" id="id" name="id">
                <input id="codigo_concepto" class="form-control" type="text" name="codigo_concepto"  placeholder="codigo..." required readonly>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="form-group">
                <label for="autor">Descripcion Concepto</label><br>
                <input id="descripcion_concepto" class="form-control" type="text" name="descripcion_concepto"  placeholder="concepto..." required readonly>
            </div>
        </div>
    </div>
    <button class="btn btn-primary mb-2" type="button" onclick="frmConceptosOT();">+<i class="fa fa-plus"></i></button>
</div>
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-8">
            <h2>RECURSOS ASIGNADOS</h2>
        </div>
        <div class="col-lg-4">
        <button class="w-100 btn btn-danger btn-lg" type="submit" onclick="procesarConceptoInsumo()">PROCESAR</button>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <p id="comparador"><p>   
    <table id="myTableInsumo" class="table table-striped table-bordered"></table>

   
</div>


<?php include "Views/templates/footer.php"; ?>
