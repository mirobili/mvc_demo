<?php

namespace App\Controllers;

use App\Framework\Controller;

class IndexController extends Controller
{

    public function index()
    {
        $this->view('index', ['message'=>'helllloooooo']);
    }

}