<?php
require_once __DIR__ . '/../Middlewares/AuthMiddleware.php';

class MatchController
{
    public function index()
    {
        AuthMiddleware::check();

        // Code affichage des matchs...
    }
}
