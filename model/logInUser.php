<?php
session_start();
require_once 'db_connection.php'; 

$errors = [];
$email = $password = '';

// Validate form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate email
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    if (empty($email)) {
        $errors['email'] = "El correo electrónico es obligatorio";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Por favor ingresa un correo electrónico válido";
    }

    // Validate password
    $password = $_POST['password'] ?? '';
    if (empty($password)) {
        $errors['password'] = "La contraseña es obligatoria";
    } 
    
    // If no errors, do login
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("SELECT id, username, email, password_hash FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                // Password is correct, log in the user
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['registration_success'] = true;
                require_once "getFiles.php";

                // Update 
                $update = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
                $update->execute([$user['id']]);

                header("Location: ../view/home.php"); // Redirect to  home
                exit();
            } else {
                $errors['password'] = "Correo electrónico o contraseña incorrectos";
            }
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            $errors['password'] = "Error en el sistema. Por favor intenta más tarde.";
        }
    }

    // If there are errors, redirect back with errors and previuos input
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_input'] = [
            'email' => $email
        ];
        header("Location: ../view/logIn.php");
        exit();
    }
} else {
    // Random error
    header("Location: ../view/logIn.php");
    exit();
}
