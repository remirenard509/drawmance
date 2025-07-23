<?php
require_once __DIR__ . '/../Middlewares/AuthMiddleware.php';

class UserController
{
    public function index()
    {
        AuthMiddleware::check();

        // Code affichage 
    }
}

