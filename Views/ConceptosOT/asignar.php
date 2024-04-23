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
            <button class="w-100 btn btn-warning btn-lg" type="submit">SELECCIONAR</button>
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
        <div class="col-lg-8">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="hidden" id="id" name="id">
                <input id="titulo" class="form-control" type="text" name="titulo" placeholder="Título del libro" required>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="autor">Autor</label><br>
                <select id="autor" class="form-control autor" name="autor" required style="width: 100%;">
                <!--<option id="selectAutor" value="0">Seleccione</option> -->
                </select> 
            </div>
        </div>
    </div>
    <button class="btn btn-primary mb-2" type="button" onclick="frmConceptosOT();">+<i class="fa fa-plus"></i></button>
</div>
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="tile">
                <div class="tile-body">
                <div class="table-responsive-sm">
                        <table class="table table-bordered table-hover" id="tblConceptosOT2">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "Views/templates/footer.php"; ?>
