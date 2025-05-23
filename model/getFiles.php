<?php

if (!isset($_SESSION['user_id'])) {
    header('Location: ../view/logIn.php');
    exit();
}

$user_id = $_SESSION['user_id'];

require_once 'db_connection.php';

try {
    $stmt = $pdo->prepare("SELECT * FROM files WHERE user_id = :user_id ORDER BY created_at DESC");
    $stmt->execute(['user_id' => $user_id]);
    $userFiles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Store files in session
    $_SESSION['user_files'] = $userFiles;


    if(empty($_SESSION['user_files'])){
        $_SESSION['user_files'] = false;
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
