<?php

namespace App\Framework;

use App\Views\UserIndexView;

class View
{
    protected static string  $template_name = 'user.index';
    public static function render(array $data)
    {
        $template  = self::loadTemplate(self::$template_name);
        $res = self::populate($template, $data);
        return $res;
    }

    protected static function loadTemplate(string $template_name)
    {
        $file = TEMPLATES_DIR . $template_name . '.php';
        return file_get_contents($file);
    }

    protected static function populate($template, array $data)
    {
        foreach ($data as $key => $value) {
            $template = str_replace('{{' . $key . '}}', $value, $template);
        }

        return $template;
    }
}