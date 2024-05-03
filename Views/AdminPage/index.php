<?php include "Views/templates/navbar.php"; ?>
<?php include "Views/templates/sidebar.php"; ?>
<div>
    <div>
        <div>
            <div >
                <div>
                    <h1><i class="fa fa-dashboard"></i> Datos de la Empresa</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tile">
                        <div class="tile-body">
                            <p>Aqui va la base principal</p>
                            <a href="<?php echo base_url; ?>Usuarios/salir">cerrar session</a>
                        </div>
                    </div>
                </div>
            </div>

            
           <div id="successAlert" class="" style="display: none;"> 
                
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            
            <div  id="errorAlert" class="" style="display: none;">
           
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            
            <div id="warningAlert" class="" style="display: none;">
               
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
-           

        </div>
    </div>
</div>
<!-- MODAL -->
    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Ingresar Correo y Contraseña</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="frmRegistrar">
                            <div class="form-group">
                                <label for="correo">Correo</label>
                                <input type="hidden" id="id" name="id">
                                <input type="hidden" id="correo_admin" value="zgroupsistemas@gmail.com">
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="pass_email" name="pass_email" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" type="submit" onclick="registrarRespuesta(event)" id="btnAccion" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </div>
            </div>
    </div>

<?php include "Views/templates/footer.php"; ?>