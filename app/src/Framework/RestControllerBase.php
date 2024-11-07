<?php

namespace App\Framework;

use App\Framework\Controller;

class RestControllerBase implements RestControllerInterface
{

    public static function actionGet( $request ){

        return self::restResponse(501, ["error"=>static::class.": Action   GET is not implemented"]);
    }
    public static function actionPost( $request ){

        return self::restResponse(501, ["error"=>static::class.": Action  POST is not implemented"]);
    }
    public static function actionPut( $request ){

        return self::restResponse(501, ["error"=>static::class.": Action  PUT is not implemented"]);
    }
    public static function actionPatch( $request ){

        return self::restResponse(501, ["error"=>static::class.": Action  delete is not implemented"]);
    }

    public static function actionDelete( $request ){

        return self::restResponse(501, ["error"=>static::class.": Action delete is not implemented"]);
    }


    public static function restResponse(int $http_response_code =200, $response = ''): string|false
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($http_response_code);

        return json_encode($response);
    }
}