<?php

namespace App\Controllers;

use App\Framework\RestController;

class UserRestController extends RestController
{

    public function index()
    {
        return $this->view('user/index');
    }
}