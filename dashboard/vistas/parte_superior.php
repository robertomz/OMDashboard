<?php
  session_start();
  
  if ($_SESSION["s_usuario"] === null){
      header("Location: ../index.php");
  }
  else {
    $id = $_SESSION['identidad'];
    $fname = $_SESSION['nombre'];
    $lname = $_SESSION['apellido'];
    $email = $_SESSION['correo'];
    $direccion = $_SESSION['direccion'];
    $telefono = $_SESSION['telefono'];
    $password = $_SESSION['password'];

    $idSucursal = $_SESSION['idsucursal'];
    $store = $_SESSION['sucursal'];
    $ubicacion = $_SESSION['ubicacion'];
  }
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link rel="icon" type="image/x-icon" href=""">
  
  <!-- GOOGLE FONT -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  <!-- JQUERY -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <!-- SWEET ALERT -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- DATATABLES -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script>
  
  <!-- GOOGLE CHARTS -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <!-- MATERIALIZE ICONS -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/e716b78aa6.js" crossorigin="anonymous"></script>


  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  
  <title> Heladería </title>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-ice-cream"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> Heleaderia</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span> Dashboard </span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Módulos
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <!-- PEDIDOS NAV ITEM -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePedidos" aria-expanded="true"
              aria-controls="collapsePedidos">
              <i class='fa fa-shopping-basket'></i>
              <span> Pedidos </span>
            </a>
            <div id="collapsePedidos" class="collapse" aria-labelledby="headingPedidos" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"> Opciones de Pedidos: </h6>
                <a class="collapse-item" href="buy.php"> Realizar Pedido </a>
                <a class="collapse-item" href="buyhistory.php"> Ver Pedidos </a>
              </div>
            </div>
          </li>
        <!-- ADMIN NAV ITEM -->
      <?php 
        if ($_SESSION['tipo'] == 1) {
      ?>          
        <!-- COMPRAS NAV ITEM -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompras" aria-expanded="true"
              aria-controls="collapseCompras">
              <i class='fa fa-shopping-bag'></i>
              <span> Compras </span>
            </a>
            <div id="collapseCompras" class="collapse" aria-labelledby="headingCompras" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"> Opciones de Pedidos: </h6>
                <a class="collapse-item" href="shopping.php"> Gestionar Pedidos </a>
              </div>
            </div>
          </li>
          <!-- PRODUCTOS NAV ITEM -->
          <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePaletas" aria-expanded="true"
                aria-controls="collapsePaletas">
                <i class='fa fa-ice-cream'></i>
                <span> Productos </span>
              </a>
              <div id="collapsePaletas" class="collapse" aria-labelledby="headingPaletas" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header"> Productos: </h6>
                  <a class="collapse-item" href="products.php"> Gestionar Productos </a>
                </div>
              </div>
            </li>
          <!-- USUARIOS NAV ITEM -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true"
              aria-controls="collapseUsers">
              <i class="fas fa-user"></i>
              <span> Usuarios </span>
            </a>
            <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"> Opciones de Usuarios: </h6>
                <a class="collapse-item" href="users.php"> Gestionar Usuarios </a>
              </div>
            </div>
          </li>
          <!-- STORES NAV ITEM -->
          <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStores" aria-expanded="true" aria-controls="collapseStores">
                    <i class="fas fa-store"></i>
                    <span> Sucursales </span>
                </a>
                <div id="collapseStores" class="collapse" aria-labelledby="headingStores" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Opciones de Sucursales: </h6>
                        <a class="collapse-item" href="stores.php"> Gestionar Sucursales </a>
                    </div>
                </div>
            </li>
            <!-- REPORTERÍA NAV ITEM -->
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReportes" aria-expanded="true"
                aria-controls="collapseReportes">
                <i class='fa fa-file-pdf'></i>
                <span> Reportería </span>
              </a>
              <div id="collapseReportes" class="collapse" aria-labelledby="headingReportes" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header"> Reportes: </h6>
                  <a class="collapse-item" href="reportVentas.php"> Reporte de Ventas </a>
                </div>
              </div>
            </li>
      <?php
        }
      ?>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>



          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="./Cart.php">
                <span class="mr-3 d-xl-inline fw-bold" style="color: #3D59B4;">
                  <i class="fa fa-shopping-cart"></i>Carrito
                </span>
              </a>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php echo $fname, ' ', $lname;?>
                </span>
                <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
                <img class="img-profile rounded-circle" src="img/avatar.svg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Editar Perfil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar Sesión
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->