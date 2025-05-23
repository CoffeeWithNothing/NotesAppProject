<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old_input'] ?? [];
unset($_SESSION['errors'], $_SESSION['old_input']);
?>

<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- Favicon  -->
    <link rel="shortcut icon" href="../images/icon2.jpg" type="image/x-icon">

    <!-- Page Title  -->
    <title>Registro - Bunnotes</title>
</head>
<body>

<nav class="d-flex flex-wrap align-items-center px-4 justify-content-center justify-content-sm-start" style="height: 100px;">
    <!-- Logo Section -->
    <a href="../index.php" aria-label="Bunnotes" class="d-flex align-items-center flex-shrink-0 me-3">
        <img src="../images/icon.png" alt="Bunnotes Logo" style="width: 150px; height: 150px; object-fit: contain; margin-top: -25px;">
    </a>

    <!-- Register H1 -->
    <div class="d-flex align-items-center flex-grow-1 justify-content-center justify-content-sm-start">
        <h1 class="mb-4 fs-3 fw-semibold">Registro</h1>

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

        <a href="logIn.php" class="mb-4 text-decoration-none mx-4 text-white btn btn-outline-light btn-sm text-nowrap d-none d-sm-inline text-btn mb-4 fw-semibold fs-6">Iniciar Sesión</a>
    </div>

    <!-- Right-aligned empty space (for future menu, user profile, etc.) -->
    <div style="flex: 1 1 0%;"></div>
</nav>



<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6"> <!-- Responsive width -->
            <div class="card-body p-3 p-md-5 bg-dark"> <!-- Responsive padding -->
                <h2 class="card-title text-center mb-4">
                    Crea tu usuario para empezar a crear y guardar notas:
                </h2>
                
                <!-- Error Messages -->
                <!-- Not for now! -->
                    
                <?php 
                    if(isset($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form action="../model/registerUser.php" method="post" novalidate>
                    <!-- Username Field -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre de Usuario</label>
                        <input type="text"
                            class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
                            id="username"
                            name="username"
                            value="<?= htmlspecialchars($old['username'] ?? '') ?>"
                            required
                            pattern="[a-zA-Z0-9_]{3,20}"
                            title="3-20 caracteres (Se admiten letras, números y guiones bajos)"/>
                        <div class="invalid-feedback">
                            <?= $errors['username'] ?? 'Por favor ingresa un nombre de usuario válido' ?>
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email"
                            class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                            id="email"
                            name="email"
                            value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                            required
                            title="Ingresa un correo electrónico válido"/>
                        <div class="invalid-feedback">
                            <?= $errors['email'] ?? 'Por favor ingresa un correo electrónico válido' ?>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password"
                            class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                            id="password"
                            name="password"
                            required
                            minlength="8"
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="Mínimo 8 caracteres con mayúscula, minúscula y número"/>
                        <div class="invalid-feedback">
                            <?= $errors['password'] ?? 'La contraseña debe tener al menos 8 caracteres, una mayúscula y un número' ?>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password2" class="form-label">Confirmar Contraseña</label>
                        <input type="password"
                            class="form-control <?= isset($errors['password2']) ? 'is-invalid' : '' ?>"
                            id="password2"
                            name="password2"
                            required
                            title="Las contraseñas deben coincidir"/>
                        <div class="invalid-feedback">
                            <?= $errors['password2'] ?? 'Las contraseñas deben coincidir' ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit"
                                class="btn btn-primary btn-sm w-100 p-2 m-2"
                                style="max-width: 200px;"
                                name="submit">
                            <b>Registrarse</b>
                        </button>
                    </div>

                
                    <!-- Log in link  -->
                    <div class="d-flex justify-content-center">
                        <a href="logIn.php" class="text-white">
                            ¿Ya tienes cuenta?
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</html>