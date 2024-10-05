<?php

namespace App\Framework;

use App\Framework\WebController;

class TestController extends WebController
{
    public function index()
    {
        return 'TestController::Index';
    }
}