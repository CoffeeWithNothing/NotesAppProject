<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style2.css">

    <!-- Favicon  -->
    <link rel="shortcut icon" href="images/icon2.jpg" type="image/x-icon">

    <!-- Page Title  -->
    <title>Home - Bunnotes</title>
</head>
<body>

<nav class="d-flex flex-wrap align-items-center px-4 justify-content-center justify-content-sm-start" style="height: 100px;">
    <!-- Logo Section -->
    <a href="index.php" aria-label="Bunnotes" class="d-flex align-items-center flex-shrink-0">
        <img src="images/icon.png" alt="Bunnotes Logo" style="width: 150px; height: 150px; object-fit: contain; margin-top: -25px;">
    </a>

    <!-- Group Title and Language Selector -->
    <div class="d-flex align-items-center flex-grow-1 justify-content-center justify-content-sm-start">
        <h1 class="mb-4 fs-3 fw-semibold">Bunnotes</h1>

        <!-- Separator -->
        <div role="separator" class="border-end border-light mx-4 d-none d-sm-inline mb-4" style="height: 65px;"></div>

        <!-- lang-btn is my class inside the css  -->
        <button type="button"
            aria-haspopup="dialog"
            aria-expanded="false"
            aria-label="Idioma: Español"
            class="btn btn-outline-light btn-sm text-nowrap d-none d-sm-inline mb-4 text-btn fw-semibold fs-6">
            Español (España)
            <!-- chevronDown is my class for the JS  -->
            <svg aria-hidden="true" role="graphics-symbol" viewBox="0 0 30 30"
                class="chevronDown"
                style="width: 10px; height: 100%; display: inline; fill: currentColor; flex-shrink: 0; margin-left: 4px;">
                <polygon points="15,17.4 4.8,7 2,9.8 15,23 28,9.8 25.2,7 "></polygon>
            </svg>
        </button>

        <a href="view/register.php" class="mb-4 text-decoration-none mx-4 text-white btn btn-outline-light btn-sm text-nowrap d-none d-sm-inline text-btn mb-4 fw-semibold fs-6">Regístrate</a>

        <a href="view/logIn.php" class="mb-4 text-decoration-none text-white btn btn-outline-light btn-sm text-nowrap d-none d-sm-inline text-btn mb-4 fw-semibold fs-6">Inicia Sesión</a>
    </div>

    <!-- Right-aligned empty space (for future menu, user profile, etc.) -->
    <div style="flex: 1 1 0%;"></div>
</nav>

    </div>
</nav>

<div class="container-fluid">
  <div class="row">
    <div class="col-12 p-3 m-3  border div-primary">

    <!-- h1 header  -->
    <h1>Landing Page</h1>
    <p>¡Tu aplicación de notas centralizada para ti y para tu equipo!</p>



    <!-- Links -->

    <a href="view/register.php">Ir al registro</a>
    <br>
    <a href="view/logIn.php">Ir al Log In</a>

    </div>
  </div>
</div>


</body>
</html>



