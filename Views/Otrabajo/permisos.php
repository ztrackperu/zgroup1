<?php include "Views/templates/navbar.php"; ?>
<div class="row">
    <div class="col-md-5 mx-auto m-5">
        <div class="card">
            <div class="card-header text-center bg-primary">
                <h4 class="text-white">No tienes permisos</h4>
            </div>
            <div class="card-body">
                <a href="<?php echo base_url; ?>Configuracion/admin" class="btn btn-danger btn-block">Regresar</a>
            </div>
        </div>
    </div>
</div>
<?php include "Views/templates/footer.php"; ?>