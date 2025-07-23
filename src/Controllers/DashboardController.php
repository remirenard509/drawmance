<?php
require_once __DIR__ . '/../Middlewares/AuthMiddleware.php';

class DashboardController
{
    public function index()
    {
        AuthMiddleware::check();

        // Code affichage dashboard...
    }
}
