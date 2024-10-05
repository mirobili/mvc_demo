<?php
//namespace App;

function trace($var=''): void
{
    echo '<pre>';
    print_r($var);

}

function dd($var=''): void
{
    trace($var);
    exit(0);
}






