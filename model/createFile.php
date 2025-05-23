<?php

// There are no session_start because this is included in the file that this code will be included_once

if (!isset($_SESSION['email'])) {
    http_response_code(401);
    echo "El email no está registrado.";
    exit();
}

require_once 'db_connection.php'; 

$email = $_SESSION['email'];
$filename = "Archivo Inicial";
$content = "";
$file_size = 0;

try {
    // Get user ID by email
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        http_response_code(404);
        echo "Usuario no encontrado.";
        exit();
    }

    $user_id = $user['id'];

    $_SESSION["user_id"] = $user_id;

    // Insert the empty file
    $stmt = $pdo->prepare(
        "INSERT INTO files (user_id, filename, content, file_size) VALUES (:user_id, :filename, :content, :file_size)"
    );
    $stmt->execute([
        'user_id'   => $user_id,
        'filename'  => $filename,
        'content'   => $content,
        'file_size' => $file_size
    ]);

} catch (PDOException $e) {
    http_response_code(500);
}
?>
