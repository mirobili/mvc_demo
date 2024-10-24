<?php
//namespace App;

function trace($var='', $debug = true, $show_args= false): void
{

    if ($debug) {

        $dbg = debug_backtrace();
        $ttt =  $dbg[0]??$dbg[0];
        $file = $ttt['file']??'' ;
        $line = $ttt['line']??'';
        $function = $ttt['function']??'';
        $class= $ttt['class']??'';
        $type= $ttt['type'] ?? '';
        echo "---- $file [$line], $function() ----- $class::$function()  $type";
    }

    echo "\n";
    echo '<pre>';
    print_r($var);
    echo "\n";
    if ($show_args) print_r($ttt->args); //

    echo '</pre>';
}

function dd($var=''): void
{
    trace($var);
    exit(0);
}





