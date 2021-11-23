<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../vendor/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="../vendor/lightbox/css/lightbox.min.css">
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">ADMIN OTP</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i>&ensp;Logout</a>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="../dashboard/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Data Master</div>
                        <a class="nav-link" href="../app/index.php">
                            <div class="sb-nav-link-icon"><i class="fab fa-android"></i></div>
                            Aplikasi
                        </a>
                        <a class="nav-link" href="../mesin/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-server"></i></div>
                            Mesin
                        </a>
                        <div class="sb-sidenav-menu-heading">Manajemen User</div>
                        <a class="nav-link" href="../order/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Order
                        </a>
                        <a class="nav-link" href="../deposit/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign"></i></div>
                            Deposit
                        </a>
                        <a class="nav-link" href="../member/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Member
                        </a>
                        <a class="nav-link" href="../rekening/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i></div>
                            Rekening
                        </a>
                    </div>
                </div>
            </nav>
        </div>