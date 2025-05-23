<?php
session_start();
$user = $_SESSION['username'];
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];
$files = $_SESSION['user_files'];

if(!$_SESSION['registration_success']){
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/home.css">

    <!-- Favicon  -->
    <link rel="shortcut icon" href="../images/icon2.jpg" type="image/x-icon">

    <!-- Page Title  -->
    <title>Home - Bunnotes</title>
</head>
<body>

<nav class="d-flex flex-wrap align-items-center px-4 justify-content-center justify-content-sm-start" style="height: 100px;">
    <!-- Logo Section -->
    <a href="home.php" aria-label="Bunnotes" class="d-flex align-items-center flex-shrink-0">
        <img src="../images/icon.png" alt="Bunnotes Logo" style="width: 150px; height: 150px; object-fit: contain; margin-top: -25px;">
    </a>

    <!-- Group Title and Language Selector -->
    <div class="d-flex align-items-center flex-grow-1 justify-content-center justify-content-sm-start">
        <h1 class="mb-4 me-3 fs-3 fw-semibold d-none d-sm-inline">Tus archivos</h1>
        <div role="separator" class="border-end border-light mb-4" style="height: 60px;"></div>
    </div>

    <!-- Right-aligned Buttons -->
    <div class="ms-auto d-flex align-items-center flex-nowrap">
        <button type="button"
            aria-haspopup="dialog"
            aria-expanded="false"
            aria-label="Idioma: Español"
            class="btn btn-outline-light btn-sm text-nowrap d-none d-md-inline mb-4 text-btn fw-semibold fs-6 me-3">
            Buscar
            <svg aria-hidden="true" role="graphics-symbol" viewBox="0 0 30 30"
                class="chevronDown"
                style="width: 10px; height: 100%; display: inline; fill: currentColor; flex-shrink: 0; margin-left: 4px;">
                <polygon points="15,17.4 4.8,7 2,9.8 15,23 28,9.8 25.2,7 "></polygon>
            </svg>  
        </button>

        <a href="../controller/logOut.php" class="mb-4 text-decoration-none me-3 text-white btn btn-outline-light btn-sm text-nowrap d-none d-md-inline text-btn mb-4 fw-semibold fs-6">Cerrar Sesión</a>

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
        <div class="col-12 p-3 m-3 border div-primary">

            <h1>Bunnotes - Home</h1>
            <p>Bienvenidoooo <?php echo $user ?>!</p>
            <p>Recuerda tu email: <?php echo $email ?>!</p>
            <a href="register.php">Ir al registro</a>
            <a href="logIn.php">Ir al Log In</a>


            <input type="text" >

            <!-- Trigger Button -->
            <a class="btn btn-primary d-none d-lg-inline" data-bs-toggle="offcanvas" href="#canvas" role="button" aria-controls="Tablón">
                Abrir Archivos
            </a>

            <!-- Offcanvas Sidebar -->
            <div class="offcanvas offcanvas-start text-white m-5 ms-0" tabindex="-1" id="canvas" aria-labelledby="offcanvash4" style="width: 350px; height:90%;">
                <div class="offcanvas-header bg-dark d-flex justify-content-center align-items-center position-relative" style="min-height: 56px; border-top-right-radius:15px;">
                    <h4 class="offcanvas-title m-0 w-100 text-center" id="offcanvash4">
                        Tus Archivos
                        <hr>
                    </h4>
                    <button type="button"
                            class="btn-close btn-close-white fs-5 position-absolute end-0 top-40 translate-middle-y me-3"
                            data-bs-dismiss="offcanvas"
                            aria-label="Close">
                    </button>
                </div>
                <div class="offcanvas-body bg-dark" style="border-bottom-right-radius:15px;">
                    <h5>
                        <?php 
                        if(!$files){
                            echo "No has añadido archivos";
                        } else {
                            echo '<div style="display: flex; flex-direction: column; align-items: center;">';
                            foreach ($_SESSION['user_files'] as $file) {
                                echo '<button 
                                        type="button"
                                        value="' . htmlspecialchars($file['id']) . '"
                                        class="btn btn-outline-light mb-2"
                                        style="
                                            width: 80%;
                                            max-width: 400px;
                                            border-radius: 8px;
                                            text-align: left;
                                            padding: 10px 16px;
                                            overflow: hidden;
                                            white-space: nowrap;
                                            text-overflow: ellipsis;
                                        "
                                        onclick="fileClick(this.value)">
                                        ' . htmlspecialchars($file['filename']) . '
                                      </button>';
                            }
                            echo '</div>';
                        }
                        ?>
                    </h5>
                    <div class="dropdown mt-3">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Dropdown button
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <script>
            function fileClick(fileId) {
                alert('ID: ' + fileId);
            }
            </script>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>