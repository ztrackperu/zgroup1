<?php include "Views/templates/navbar.php"; ?>
<p></p>
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> ConceptosOT</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmConceptosOT();">+<i class="fa fa-plus"></i></button>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
               <div class="table-responsive-sm">
                    <table class="table table-bordered table-hover" id="tblConceptosOT">
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
<div id="nuevoConcepto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Concepto</h5>
                <button class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmConceptosOT">
                    <div class="form-group">
                        <label for="codigo_concepto">Código Concepto</label>
                        <input type="hidden" id="id" name="id">
                        <input id="codigo_concepto" class="form-control" type="text" name="codigo_concepto" placeholder="Código del concepto" readonly>
                    </div>
                    <div class="form_group">
                        <label for="descripcion_concepto">Descripción</label>
                        <input id="descripcion_concepto" class="form-control" type="text" name="descripcion_concepto" placeholder="Descripción">    
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registrarConcepto(event);"
                        id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/templates/footer.php"; ?>
