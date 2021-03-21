<?php
require('db.php');
if (!isset($_SESSION['ROLE'])) {
    header('location:login.php');
    die();
}
?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compartible" content="IE=edge">

    <title>Dashboard / Concessionária!</title>

    <link rel="icon" type="image/png" href="public/favicon.png" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="menu-title">Menu</li>
                    <li class="menu-item-has-children dropdown">
                        <a href="index.php">Central das Concessionária</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="vehicle.php">Catalógo de Veículos</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="user.php">Central dos Usuários</a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>

    <div id="right-panel" class="right-panel">
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php"><img src="public/logo.png" style="width:2.5rem" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="index.php"><img src="public/logo_2.png" style="width:2.5rem" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
            </div>

            <div class="top-right">
                <div class="header-menu">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bem vindo <?php echo $_SESSION['USER_NAME'] ?></a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>