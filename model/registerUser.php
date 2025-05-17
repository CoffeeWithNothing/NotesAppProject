<?php
session_start();

// Database configuration
require_once 'db_connection.php'; // Database connection

// Initialize variables
$errors = [];
$username = $email = $password = $password2 = '';

// Validate form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate username
    $username = trim($_POST['username'] ?? '');

    //$_POST['username'] ?? '' uses the null coalescing operator

    /*
    If $_POST['username'] exists and is not null (i.e., the form field was submitted), use its value
    If it does not exist, use an empty string ('') instead.*/

    if (empty($username)) {
        $errors['username'] = "El nombre de usuario es obligatorio";
    } elseif (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
        $errors['username'] = "El nombre de usuario debe tener entre 3-20 caracteres (solo letras, números y guiones bajos)";
    }
    
    // Sanitize and validate email
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    // FILTER_SANITIZE_EMAIL is a PHP filter used to remove all illegal characters from an email address
    if (empty($email)) {
        $errors['email'] = "El correo electrónico es obligatorio";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Por favor ingresa un correo electrónico válido";
    }
    
    // Validate password
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';
    
    if (empty($password)) {
        $errors['password'] = "La contraseña es obligatoria";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "La contraseña debe tener al menos 8 caracteres";
    } elseif (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
        $errors['password'] = "La contraseña debe contener al menos una mayúscula, una minúscula y un número";
    }
    
    if ($password !== $password2) {
        $errors['password2'] = "Las contraseñas no coinciden";
    }
    
    // Check for existing user
    if (empty($errors)) {
        try {
            // Check username
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->rowCount() > 0) {
                $errors['username'] = "Ese nombre de usuario ya está registrado";
            }

            // Check email
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                $errors['email'] = "Ese correo electrónico ya está registrado";
            }
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            $errors['general'] = "Error en el sistema. Por favor intenta más tarde.";
        }
    }

    
    // If no errors, proceed with registration
    if (empty($errors)) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash, created_at) 
            VALUES (?, ?, ?, NOW())");
            // NOW() is like the automatic date data


            $stmt->execute([$username, $email, $hashedPassword]);
            
            // Registration successful
            $_SESSION['registration_success'] = true;
            header("Location: ../view/home.php");
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            exit();
            
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            $errors['general'] = "Error al registrar el usuario. Por favor intenta más tarde.";
        }
    }
    
    // If there are errors, redirect back with errors and old input again
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_input'] = [
            'username' => $username,
            'email' => $email
        ];
        header("Location: ../view/register.php");
        exit();
    }
} else {
    // Radnom error?
    // header("Location: ../view/register.php");
    exit();
}
