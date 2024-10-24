<?php

namespace App\Controllers\Rest;

use App\Entities\Customer;
use App\Framework\Entity;

//use App\Framework\RestController;
use App\Framework\RestControllerBase;
use App\Framework\RestControllerInterface;
use App\Models\CustomerModel;
use PHPUnit\Logging\Exception;

class CustomerRestController extends RestControllerBase implements RestControllerInterface
{

    public static function actionGet($request)
    {

        if (!isset($request['id'])) {
            return self::find($request);
        }

        $id = $request['id'] ?? 0;

        $customer = Customer::get($id);
        if (!$customer->getId()) {
            return self::restResponse(409, ["error" => "Object not found", "id" => $id]);
        }
        return self::restResponse(200, $customer->toArray());
    }


    public static function find($request)
    {

        try {

            if (!is_array($request)) {
                return self::restResponse(409, ['error' => 'not a valid request array', 'request' => $request]);
            }

            $customers_array = Customer::find($request);
            $aa = [];
            foreach ($customers_array as $customer) {
                $aa[] = $customer->toArray();
            }

            return self::restResponse(200, $aa);

        } catch (Exception $e) {

            return self::restResponse(409, ["error" => $e->getMessage()]);
        }
    }

    public static function actionPost($request)
    {
        try {

            if (!is_array($request) || count($request) == 0) {
                return self::restResponse(409, ['error' => 'not a valid request array', 'request' => $request]);
                $request = json_decode($request, false);
            }

            $id = $request['id'] ?? 0;

            if ($id) {
                return self::restResponse(409, ['error' => 'Invalid input. "id" is not allowed in POST request', 'id' => $request['id']]);
            }

            $ee = Customer::get($id);

            if (intval($ee->getId()) > 0) {
                return self::restResponse(409, ['error' => 'Object already exists.', 'id' => $ee->getId()]);
            }

            $ee = Customer::makeFromArray($request);

            $ee->save();

            return self::restResponse(200, $ee->toArray());

        } catch (Exception $e) {

            return self::restResponse(409, ["error" => $e->getMessage()]);
        }
    }

    public static function actionPatch($request)
    {
        return self::actionPut($request);
    }

    public static function actionPut($request)
    {

        try {
            $id = $request['id'] ?? 0;

            if (!$id) {
                return self::restResponse(409, ["error" => "ID not provided"]);
            }
            $ee = Customer::get($id);

            if (!$ee->getId()) {


                return self::restResponse(409, ["error" => "Object not found", "id" => $id]);
            }
            $ee = Customer::updateFromArray($ee, $request);

            $ee->save();

            return self::restResponse(200, $ee->toArray());

        } catch (Exception $e) {

            return self::restResponse(409, ["error" => $e->getMessage()]);
        }

    }
//    public static function actionDelete( $request ){
//         return self::restResponse(501, ["error"=>"action delete is not implemented"]);
//    }

}