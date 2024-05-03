<?php include "Views/templates/navbar.php"; ?>
<?php 
//echo var_dump($data) ;
//echo $data->numSolicitud;
//echo $data['numSolicitud'];
//$plus =json_decode($data);
//$plus['numSolicitud']

;?>
<div class="container">
    <div class="app-title m-1">
        <div>
            <h1><i class="fa fa-dashboard"></i> Atender Solicitud N° <?php echo $data->numSolicitud; ; ?></h1>
        </div>

    </div>
    <div id="nuevoConcepto">
        <h2>
            <?php
                var_dump($data->solicitud);
            ?>
        </h2>
    </div>
</div>
<?php include "Views/templates/footer.php"; ?>