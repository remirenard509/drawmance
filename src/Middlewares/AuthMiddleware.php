<?php
class AuthMiddleware
{
    public static function check()
    {

        if (empty($_SESSION['user_id'])) {
            // Pas connecté : redirection vers la page login
            header('Location: /login.html');
            exit;
        }
        // Sinon, l'utilisateur est connecté, on laisse passer
    }
}
