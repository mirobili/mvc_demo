<?php

namespace App\Views;


use App\Framework\View;
use App\Views\Components\HtmlTable;

class ContractsListView
{

    public static function render($data)
    {
        return HtmlTable::render($data, $names = [], 'Customers Contracts');
    }
}