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
                <input id="codigo_concepto" class="form-control" type="text" name="codigo_concepto" <?php if($data !="ok"){echo "value=".$proceso->data->codigo;}?> placeholder="codigo..." required readonly>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="form-group">
                <label for="autor">Descripcion Concepto</label><br>
                <input id="descripcion_concepto" class="form-control" type="text" name="descripcion_concepto" <?php if($data !="ok"){echo "value=".$proceso->data->descripcion;}?> placeholder="concepto..." required readonly>
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
    <?php if($data =="ok"){ ?>
    <table id="myTableInsumo" class="table table-striped table-bordered"></table>
    <?php }else { ?>
    <table id="myTableInsumo" class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Unidad</th>
                <th>Cantidad</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php  //echo var_dump(($proceso->data->insumos)); 
            $proceso1 = $proceso->data->insumos;
            foreach($proceso1 as $data){
                //echo var_dump($data);
                //echo $data->IN_CODI;
                ?>
            <tr>
                <th><?= $data->IN_CODI ?></th>
                <th><?= $data->IN_ARTI ?></th>
                <th><?= $data->IN_UVTA  ?></th>
                <?php $cadena ='"'.$data->IN_CODI.'"'; ?>
                <th><div ><input id=<?= "'insumo_".$data->IN_CODI."'" ?> class='form-control' type='text' name=<?= "'insumo_".$data->IN_CODI."'" ?> value=<?= $data->cantidad ?> style='width: 80px;'required></div></th>
                <th><div ><button class='btn btn-danger' type='button' onclick=<?= "'btnEliminarInsumo(".$cadena.")'" ?>><i class='fa fa-pencil-square-o'></i>X</button></th>
            </tr>
                
            <?php } ?>
            <?php
            /*
"insumo_".$item->IN_CODI."'
'btnEliminarInsumo(" . $cadena .")'
<?= "btnEliminarInsumo('".$data->IN_CODI.")'" ?>
$cadena ='"'.$item->IN_CODI.'"';
$item->acciones= "<button class='btn btn-danger' type='button' onclick='btnEliminarInsumo(" . $cadena .")'><i class='fa fa-pencil-square-o'></i>X</button>";
$item->cantidad="<div ><input id='insumo_".$item->IN_CODI."' class='form-control' type='text' name='insumo_".$item->IN_CODI."' value=1 style='width: 80px;'required></div>";
*/

?>



        </tbody>
    </table>
    <?php } ?>
</div>


<?php include "Views/templates/footer.php"; ?>
