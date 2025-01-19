<?php

namespace App\Controllers;

use App\Views\View;

class MainScreenController extends BaseController
{
    // Retorna la vista principal del juego.
    public function index()
    {
        View::render('main-screen');
    }
}
