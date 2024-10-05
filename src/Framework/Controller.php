<?php

namespace App\Framework;

class Controller
{

    protected function view(string $viewName, $data=''  )
    {
      $class_name = '\App\Views\\' . $viewName ;
      return $class_name::render($data);
    }
}