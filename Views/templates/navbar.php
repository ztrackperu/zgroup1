<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/navbars/navbar-1/assets/css/navbar-1.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/stylenav.css" />
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/main.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
    <title>OT</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bsb-navbar bsb-navbar-hover bsb-navbar-caret">
  <div class="container">
    <a class="navbar-brand" href="index.html"> <img src="<?php echo base_url; ?>Assets/img/image.png" alt="logo__zgroup" width="135" height="44"></a>
    <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#!">Inicio</a>
          </li>  
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href=" <?php echo base_url; ?>Usuarios">Usuarios</a>
          </li>  
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href= id="conceptoDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Concepto</a>
            <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="conceptoDropdown">
              <li><a class="dropdown-item" href="#!">Conceptos</a></li>
              <li><a class="dropdown-item" href="#!">Listar</a></li>
              <li><a class="dropdown-item" href="#!">Insumo</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#!" id="otDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">O.T.</a>
            <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="otDropdown">
              <li><a class="dropdown-item" href="#!">Listar</a></li>
              <li><a class="dropdown-item" href="#!">Crear</a></li>
              <li><a class="dropdown-item" href="#!">Modificar</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#!" id="pendientesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pendientes</a>
            <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="pendientesDropdown">
              <li><a class="dropdown-item" href="#!">O.T.</a></li>
              <li><a class="dropdown-item" href="#!">Insumos</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#!" id="analisisDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Análisis</a>
            <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="analisisDropdown">
              <li><a class="dropdown-item" href="#!">O.T.</a></li>
              <li><a class="dropdown-item" href="#!">Conceptos</a></li>
              <li><a class="dropdown-item" href="#!">Insumo</a></li>

            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link nav-icon-hover dropdown-toggle" href="javascript:void(0)" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false"><img src="<?php echo base_url; ?>Assets/img/user1.jpg" alt="" width="30" height="30" class="rounded-circle">Usuario</a>
            <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="accountDropdown">
                <li><a class="dropdown-item" href="#!">Perfil</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php echo base_url; ?>Usuarios/salir">Cerrar sesión</a></li>
            </ul>
            </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

