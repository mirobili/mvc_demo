<?php

//const ROOT_DIR = 'C:\www\Credissimo\mvc';
//const TEMPLATES_DIR = ROOT_DIR . '\src\Views\Templates\\';

const ROOT_DIR = __DIR__.'/../';
const TEMPLATES_DIR = ROOT_DIR . '/src/Views/Templates/';

const views = [
    'user.index' => TEMPLATES_DIR . 'user.index.php',
    'user.details' => TEMPLATES_DIR . 'user.details.php',
    'user.create' => TEMPLATES_DIR . 'user.create.php',
    'user.edit' => TEMPLATES_DIR . 'user.edit.php',
    'user.delete' => TEMPLATES_DIR . 'user.delete.php',

    ];


