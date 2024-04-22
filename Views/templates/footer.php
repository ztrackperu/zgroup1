
</div>
<script src="https://unpkg.com/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/jquery-3.6.0.min.js"></script>
<script src="https:////cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/select2.min.js"></script>

<script>
        const base_url = '<?php echo base_url; ?>';
       console.log(base_url);
</script>
<?php
if (!empty($_GET['url'])) {
    //echo "jaja".$_GET['url'] ;
    $cadena = explode("/",$_GET['url']);
    $script = $cadena[0] . '.js';
    echo $script;
    if (file_exists('Assets/js/' . $script)) {
        echo '<script src="'. base_url . 'Assets/js/' . $script .'"></script>';
    }else{
        echo '<script src="'. base_url . 'Assets/js/funciones.js"></script>';
    }
}else{
    echo '<script src="'. base_url . 'Assets/js/funciones.js"></script>';
} ?>
</body>
</html>