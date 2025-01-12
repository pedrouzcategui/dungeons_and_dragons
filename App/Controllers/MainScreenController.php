<?php

namespace App\Controllers;

use App\Views\View;
use App\Models\Character;

class MainScreenController extends BaseController
{
    public function index()
    {
        View::render('main-screen');
    }
}
