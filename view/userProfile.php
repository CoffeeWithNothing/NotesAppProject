<?php
session_start();
$user = $_SESSION['username'];
$email = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style2.css">

    <!-- Favicon  -->
    <link rel="shortcut icon" href="../images/icon2.jpg" type="image/x-icon">

    <!-- Page Title  -->
    <title>Perfil - Bunnotes</title>
</head>
<body>

<nav class="d-flex flex-wrap align-items-center px-4 justify-content-center justify-content-sm-start" style="height: 100px;">
    <!-- Logo Section -->
    <a href="home.php" aria-label="Bunnotes" class="d-flex align-items-center flex-shrink-0">
        <img src="../images/icon.png" alt="Bunnotes Logo" style="width: 150px; height: 150px; object-fit: contain; margin-top: -25px;">
    </a>

    <!-- Settings Button -->
    <div class="d-flex align-items-center flex-grow-1 justify-content-center justify-content-sm-start">
        <h1 class="mb-4 me-3 fs-3 fw-semibold d-none d-sm-inline">Ajustes de Cuenta</h1>

        <!-- Separator -->
        <div role="separator" class="border-end border-light mb-4" style="height: 60px;"></div>
    </div>

    <!-- Right-aligned Buttons -->
    <div class="ms-auto d-flex align-items-center">
        <!-- lang-btn is my class inside the css  -->
        <button type="button"
            aria-haspopup="dialog"
            aria-expanded="false"
            aria-label="Idioma: Español"
            class="btn btn-outline-light btn-sm text-nowrap d-none d-md-inline mb-4 text-btn fw-semibold">
            Button for something
            <!-- chevronDown is my class for the JS  -->
            <svg aria-hidden="true" role="graphics-symbol" viewBox="0 0 30 30"
                class="chevronDown"
                style="width: 10px; height: 100%; display: inline; fill: currentColor; flex-shrink: 0; margin-left: 4px;">
                <polygon points="15,17.4 4.8,7 2,9.8 15,23 28,9.8 25.2,7 "></polygon>
            </svg>  
        </button>

        <a href="userProfile.php" class="mb-4 text-decoration-none mx-3 text-white btn btn-outline-light btn-sm text-nowrap d-none d-md-inline text-btn mb-4 fw-semibold">Ajustes</a>

        <a href="../controller/logOut.php" class="mb-4 text-decoration-none me-3 text-white btn btn-outline-light btn-sm text-nowrap d-none d-md-inline text-btn mb-4 fw-semibold">Cerrar Sesión</a>

        <a href="userProfile.php"
        class="btn mb-4 ms-3 btn-outline-light btn-sm rounded-circle p-2 d-inline-flex align-items-center justify-content-center text-nowrap"
        style="width: 40px; height: 40px;"
        aria-label="User Profile">

        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" aria-hidden="true">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
        </svg>
</a>

    </div>
</nav>

<div class="container-fluid">
  <div class="row">
    <div class="col-12 p-3 m-3  border div-primary">

    <h1>Ajustes del Perfil</h1>
    <hr>
    <p>Nombre de Usuario: <?php echo $user ?></p>
    <p>Correo: <?php echo $email ?></p>

    <a href="register.php">Ir al registro</a>
    <br>
    <a href="logIn.php">Ir al Log In</a>
    <br>
    <a href="home.php">Ir al Home</a>
    <br>

    </div>
  </div>
</div>


</body>
</html>



