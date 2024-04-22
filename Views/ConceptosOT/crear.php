<?php include "Views/templates/navbar.php"; ?>
<div class="container">
    <div class="app-title m-1">
        <div>
            <h1><i class="fa fa-dashboard"></i> Crear Concepto OT </h1>
        </div>
    </div>
    
    <div id="nuevoConcepto">
        <form method="post" id="frmConceptosOT">
            <div class="form-group">
                <label for="codigo_concepto">Código Concepto</label>
                <input type="hidden" id="id" name="id" value="<?php echo $data['id']==""?>">
                <input id="codigo_concepto" class="form-control" type="text" name="codigo_concepto" readonly value="<?php echo $data['codigo']+1?>">
                        
            </div>
            <div class="form_group">
                <label for="descripcion_concepto">Descripción</label>
                <input id="descripcion_concepto" class="form-control" type="text" name="descripcion_concepto" placeholder="Descripción">       
            </div>
                    <button class="btn btn-primary" type="button" onclick="registrarConceptoVista(event);"
                        id="btnAccion">Registrar</button>
                   <a class="btn btn-danger"href="<?php echo base_url; ?>ConceptosOT">Cancelar</a>
                </form>
    </div>
</div>
<?php include "Views/templates/footer.php"; ?>