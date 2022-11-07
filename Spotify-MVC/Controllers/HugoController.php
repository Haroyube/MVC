<?php

namespace App\Controllers;

class HugoController extends Controller
{
    public function index()
    {
        $this->render('hugo/index');
    }
}