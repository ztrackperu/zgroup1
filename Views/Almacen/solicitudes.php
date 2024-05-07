<?php include "Views/templates/navbar.php";  ?>
<div class="app-title m-3">
    <div>
        <h1><i class="fa fa-dashboard"></i> Solicitudes</h1>
    </div>
</div>
<!--
<div class="m-3 p-2">
<button class="btn btn-primary mb-2" type="button" onclick="asignacionEstadoC();"><i class="ri-add-line"></i></button>
</div>
-->
<!--
<div class="m-3 p-2">
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
        <label class="form-check-label" for="inlineCheckbox1">ACTIVO</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
        <label class="form-check-label" for="inlineCheckbox2">EN PROGRESO</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
        <label class="form-check-label" for="inlineCheckbox3">FINALIZADO</label>
    </div>
</div>-->
<div class="p-3" id="tarjeta">
    
</div>

<!-- MODAL PARA ASIGNACION DE TAREAS-->
<div id="asignacionTarea" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">DELEGACION DE TAREA</h5>
                <button class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmSolicitudes">
                    
                    <div class="form-group">
                        <label for="solicitud">Solicitud</label>
                        <input type="text" class="form-control" id="solicitud" name="solicitud" value="">
                    </div> 
                  
                    <div class="form-group">
                        <label for="usuarioD">Delegar Trabajo a:</label>
                        <?php $usuarios = $data['obtenerUsuarios']; ?>
                        <select id="usuarioD" class="form-select" name="usuarioD">
                            <option value="">SELECCIONAR</option>
                            <?php foreach ($usuarios as $usuario): ?>
                                <option value="<?php echo $usuario['id']; ?>"><?php echo $usuario['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>   
                    <button class="btn btn-primary" type="button" onclick="asignarTarea(event);" id="btnAccion">Asignar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- FINAL MODAL PARA ASIGNACION DE TAREAS-->

<?php include "Views/templates/footer.php"; ?>
