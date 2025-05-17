<?php

try {
    $host = 'localhost';
    $user = 'your_db_user';
    $pass = 'your_db_password';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;charset=$charset";
    $pdoNoDb = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $db_name = 'bunnotes';
    $pdoNoDb->exec("CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "<h1>Database created successfully!!\n</h1>";

} catch (PDOException $e) {
    die("Error creating database: " . $e->getMessage());
}

// Now connect to the database (you can reuse $pdo from model/db_connection.php if it connects to the DB)
try {
    $tables = [
        "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `username` VARCHAR(50) UNIQUE NOT NULL,
            `email` VARCHAR(100) UNIQUE NOT NULL,
            `password_hash` VARCHAR(255) NOT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `last_login` DATETIME,
            INDEX `idx_email` (`email`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

        "CREATE TABLE IF NOT EXISTS `files` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `user_id` INT NOT NULL,
            `filename` VARCHAR(255) NOT NULL,
            `content` LONGTEXT,
            `file_size` INT NOT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            INDEX `idx_user_files` (`user_id`, `filename`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

        "CREATE TABLE IF NOT EXISTS `groups` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `name` VARCHAR(50) UNIQUE NOT NULL,
            `description` VARCHAR(255),
            `created_by` INT NOT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

        "CREATE TABLE IF NOT EXISTS `user_groups` (
            `user_id` INT NOT NULL,
            `group_id` INT NOT NULL,
            PRIMARY KEY (`user_id`, `group_id`),
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`group_id`) REFERENCES `groups`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

        "CREATE TABLE IF NOT EXISTS `file_permissions` (
            `file_id` INT NOT NULL,
            `group_id` INT NOT NULL,
            `permission_level` ENUM('read', 'write', 'admin') DEFAULT 'read',
            PRIMARY KEY (`file_id`, `group_id`),
            FOREIGN KEY (`file_id`) REFERENCES `files`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`group_id`) REFERENCES `groups`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
    ];

    foreach ($tables as $sql) {
        $pdo->exec($sql);
    }

    echo "<h1>Tables created successfully!!/h1>";

} catch (PDOException $e) {
    die("Error creating tables: " . $e->getMessage());
}
