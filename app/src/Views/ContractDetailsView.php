<?php

namespace App\Views;

use App\Framework\View;
use App\Views\Components\HtmlDetails;

class ContractDetailsView extends View
{
  //  static string  $template_name = 'Customer.Form';


    public static function render(array $data, $meta=null)
    {

    // trace($data);

        return   HtmlDetails::render($data, $names=[], "Contract Details", "table table-striped");

//
//        $html = '';
////      $html .= "<button hx-get=\"/htmx/load/customer\" hx-target=\"#body-div\" hx-swap=\"innerHTML \> ".$id. "</button>";
////        $html .= "<button hx-get=\"/htmx/load/customer/{$data['id']}/edit\" hx-target=\"#body-div\" hx-swap=\"innerHTML \> ".$id. "</button>";
//        $id= $data['id']??'';
//        $url = '/customer_demo/'.$id . '/edit';
//        $html .= '<a href="'.$url.'" >Edit</a>';
////        $html .= '<div hx-get="/clicked" hx-trigger="click">Click Me</div>
//        $names = ['idd', 'namm', 'addr', 'phone', 'email', 'syzdaden', 'Редактиран на'];
//        $html .=  HtmlDetails::render($data, $names, "Customer Details", "table table-striped");
//        return $html;
    }
}