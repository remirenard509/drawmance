<?php
require_once __DIR__ . '/../../config/database.php';

class User
{
    public static function create($username, $email, $password)
    {
        global $pdo;
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$username, $email, $hash]);
    }

    public static function findByEmail($email)
    {
        global $pdo;
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function authenticate($email, $password)
    {
        $user = self::findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public static function findById($id)
    {
        global $pdo;
        $sql = "SELECT id, username, email, created_at FROM users WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
