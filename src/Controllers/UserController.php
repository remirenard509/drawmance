<?php
require_once __DIR__ . '/../Middlewares/AuthMiddleware.php';
require_once __DIR__ . '/../Models/User.php';

class UserController
{
    public function index()
    {
        AuthMiddleware::check();

        // Code affichage 
    }
    public function updateProfil()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login.html');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $bio = $_POST['bio'] ?? '';
        $avatarName = null;

        // Traitement de l’avatar s’il y en a un
        if (!empty($_FILES['avatar']['name'])) {
            $uploadDir = __DIR__ . '/../../public/uploads/';
            $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $avatarName = uniqid('avatar_') . '.' . $ext;
            $targetPath = $uploadDir . $avatarName;

            move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath);
        }

        // Mise à jour dans la base
        User::update($userId, $username, $email, $bio, $avatarName);
        header('Location: /dashboard');
        exit;
    }
}

