<?php

namespace App\Controllers\Rest;

use App\Entities\Customer;
use App\Framework\Entity;
//use App\Framework\RestController;
use App\Framework\RestControllerBase;
use App\Framework\RestControllerInterface;

class CustomerRestController extends RestControllerBase implements RestControllerInterface
{



    public static function actionGet( $request ){
        return Customer::get($request['id'])->toArray();
    }
    public static function actionPost( $request ){

        // return $request;



        $ee = Customer::makeFromArray($request);

       // return $ee->toArray();

        $ee->save();
        return $ee->toArray();
    }

    public static function actionPut( $request ){
        $ee= Customer::get($request['id']);

        trace($ee);
        $ee= Customer::updateFromArray($ee, $request);


        trace($ee);
        //dd();

        $ee->save();
       // dd($ee);
        return $ee->toArray();
    }
    public static function actionPatch( $request ){
       return self::actionPut( $request );
    }
    public static function actionDelete( $request ){
        $ee = Customer::get($request['id']);
        Customer::delete($ee);
        return http_response_code(200);
    }
}