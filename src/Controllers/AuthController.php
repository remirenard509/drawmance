<?php
require_once __DIR__ . '/../Models/User.php';

class AuthController
{
    public function register()
    {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!$username || !$email || !$password) {
            http_response_code(400);
            echo "Tous les champs sont requis.";
            return;
        }

        if (User::findByEmail($email)) {
            http_response_code(409);
            echo "Email déjà utilisé.";
            return;
        }

        if (User::create($username, $email, $password)) {
            header("Location: /login.html");
            exit;
        } else {
            http_response_code(500);
            echo "Erreur lors de l'inscription.";
        }
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        
        if (!$email || !$password) {
            http_response_code(400);
            echo "Tous les champs sont requis.";
            return;
        }

        $user = User::authenticate($email, $password);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            // ✅ Redirection vers dashboard
            header("Location: /dashboard.php");
            exit;
        } else {
            http_response_code(401);
            echo "Email ou mot de passe incorrect.";
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login.html");
        exit;
    }
}
