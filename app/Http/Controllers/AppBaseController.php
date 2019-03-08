<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message = '', $code = 200)
    {
        return Response::json($this->makeResponse($code, $message, $result), $code);
    }

    public function sendError($error, $code = 500)
    {
        return Response::json($this->makeError($code, $error), $code);
    }


    /**
     * @param $code
     * @param $message
     * @param $data
     * @return array
     */
    public static function makeResponse($code, $message, $data)
    {
        return [
            'code' => $code,
            'data'    => $data,
            'message' => $message,
        ];
    }

    /**
     * @param $code
     * @param $message
     * @param array $data
     * @return array
     */
    public static function makeError($code, $message, array $data = [])
    {
        $res = [
            'code' => $code,
            'message' => $message,
        ];

        if (!empty($data)) {
            $res['data'] = $data;
        }

        return $res;
    }
}
