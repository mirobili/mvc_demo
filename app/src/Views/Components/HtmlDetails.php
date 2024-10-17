<?php

namespace App\Views\Components;

class HtmlDetails
{
    public static function render($tableData,  $names =[] /* ['count', 'id', 'name', 'address', 'phone', 'email']*/, $title = 'Form 1', $style = '')
    {

      //  trace($tableData);

        if(is_object($tableData)){
            $tableData = get_object_vars($tableData);
        }

        if(is_string($tableData)){
            $tableData = json_decode($tableData, true);
        }


     if(!$names){
         $names = array_keys($tableData);
     }

     $html = '';
     $html.='<style>
            .table_component {
                overflow: auto;
                width: 100%;
            }
        
            .table_component table {
                border: 1px solid #dededf;
                ----height: 100%;
                width: 100%;
                aaatable-layout: auto;
                border-collapse: collapse;
                border-spacing: 1px;
                text-align: left;
            }
        
            .table_component caption {
                caption-side: top;
                text-align: left;
            }
        
            .table_component th {
                border: 1px solid #dededf;
                background-color: #bf6000;
                color: #ffffff;
                padding: 5px;
            }
        
            .table_component td {
                border: 1px solid #dededf;
                background-color: #ffffff;
                color: #000000;
                padding: 5px;
            }
        </style>'."\n";

        if ($style) {
            $html .= '<style>' . $style . '</style>';
        }

        $html .= '<div class="table_component" role="region" tabindex="0">';
        $html .= '<table>';
        //$html .= '<caption>' . $title . '</caption>';

        /******** Head ********/

        $html .= '<thead>';
            $html .= '<tr>';
         //   $html .= '<th>&nbsp;</th>';

//            foreach ($names as $name) {
//                $html .= '<th>' . ucwords($name) . '</th>';
//            }

//
//        $html .= '<th>Attribute</th>';
//
//        $html .= '<th>Value</th>';
        $html .= '<th colspan="2">' . $title . '</th>';


        $html .= '</tr>';

        $html .= '</thead>';

        /******** Body ********/

        $html .= "\n<tbody>";

        $rowNum = 0;
        foreach ($tableData as $key => $value) {


            $key = $names[$rowNum] ?? $key;


            $html .= '<tr>';

            $html .= '<td>' . $key . '</td>';
            $html .= '<td>' . $value . '</td>';

            $html .= '</tr>';
            $rowNum++;
        }
        $html .= '</tbody>';
        $html .= '</table>';

       /// return 000;

        $html= self::indentHTML($html);

        return $html;

    }

    private static function indentHTML(string $html)
    {
//        $html= str_replace('<table>',"\n<table>\n", $html);
//        $html= str_replace('<thead>',"\n<thead>\n", $html);
//        $html= str_replace('<tr>',"\n\t<tr>\n", $html);
//        $html= str_replace('</tr>',"\n\t</tr>\n", $html);
//        $html= str_replace('<td>',"\n\t\t\t<td>", $html);
//        $html= str_replace('<th>',"\n\t\t\t<th>", $html);

        return $html;
    }
}