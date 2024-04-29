<?php
session_start();
if (!isset($_SESSION["esuroy_admin"])) {
  header('location: index.php?message=loginError');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../libs/bootstrap.min.css">
  <link rel="stylesheet" href="../libs/icons-1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../libs/Datatables/DataTables-1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="../libs/Datatables/FixedHeader-3.4.0/css/fixedHeader.bootstrap5.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="../libs/summernote/summernote-lite.css">
  <title>
    <?php
    if (basename($_SERVER['PHP_SELF']) == 'dashboard.php') {
      echo 'Dashboard';
    } else if (basename($_SERVER['PHP_SELF']) == 'mayors.php') {
      echo 'Mayors';
    } else if (basename($_SERVER['PHP_SELF']) == 'captains.php') {
      echo 'Captains';
    }
    ?>
  </title>
  <style>
    <?php require_once "assets/css/style.css"; ?>
  </style>
</head>

<body>
  <header>
    <!-- Start Navbar -->
    <nav class="navbar navbar-dark navbar-expand-lg bg-primary fixed-top">
      <div class="container-fluid">
        <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand mx-auto" href="#">E-SUROY</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-white" href="./assets/php/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <!-- Start Offcanvas -->
    <div class="offcanvas offcanvas-start sidebar-nav bg-dark text-white" tabindex="-1" id="offcanvas" data-bs-backdrop="false">
      <div class="offcanvas-header" style="margin-top:-3px;">
        <a href="dashboard.php" class="text-white" style="text-decoration: none;">
          <h5 class="offcanvas-title fw-bold" id="offcanvasExampleLabel">
            <i class="bi bi-speedometer2"></i> &nbsp;Dashboard
          </h5>
        </a>
        <a href="#" class="burger text-light" data-bs-dismiss="offcanvas">
          <i class="bi bi-list"></i>
        </a>
      </div>
      <hr style="margin-top:-3px">
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li>
              <a href="mayors.php" class="nav-link text-white px-3 py-3 sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'campaignview.php' ? 'bg-primary' : '' ?>">
                <i class="bi bi-people-fill"></i> &nbsp;Mayors
              </a>
            </li>
            <li>
              <a href="captains.php" class="nav-link text-white px-3 py-3 sidebar-link <?= basename($_SERVER['PHP_SELF']) == 'campaignview.php' ? 'bg-primary' : '' ?>">
                <i class="bi bi-people"></i> &nbsp;Captains
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- End Offcanvas -->

  </header>