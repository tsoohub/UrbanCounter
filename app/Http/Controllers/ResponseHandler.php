<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 1/7/2019
 * Time: 11:37 AM
 */

namespace App\Http\Controllers;


class ResponseHandler extends Controller
{

    public static function success($message, $content) {
        $res['code'] = 200;
        $res['success'] = true;
        $res['message'] = $message;
        $res['content'] = $content;
        return $res;
    }

    public static function error(\Exception $error) {
        $res['code'] = $error->getCode();
        $res['success'] = false;
        $res['message'] = $error->getMessage();
        $res['content'] = 'Error';

        return response($res, $res['code']);
    }
}