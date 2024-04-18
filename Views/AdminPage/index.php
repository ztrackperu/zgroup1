<?php include "Views/templates/navbar.php"; ?>
<?php include "Views/templates/sidebar.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Datos de la Empresa</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <p>Aqui va la base principal</p>
            </div>
        </div>
    </div>
</div>

<a href="<?php echo base_url; ?>Usuarios/salir">cerrar session</a>

           <!-- Success Alert -->
           
           <div class="alert alert-success alert-dismissible fade show">
                <strong>Success!</strong> Your message has been sent successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <!-- Error Alert -->
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> A problem has been occurred while submitting your data.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <!-- Warning Alert -->
            <div class="alert alert-warning alert-dismissible fade show">
                <strong>Warning!</strong> There was a problem with your network connection.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    </div>
</div>
<?php include "Views/templates/footer.php"; ?>