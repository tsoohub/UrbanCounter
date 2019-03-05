<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{


    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        return response(["success"=> false , "message" => $errors],401);
    }

    /* Return content if success, otherwise redirect missing.php */
    protected function isSuccess($result) {

        if(!$result['success']) {
            return view('missing', ['result' => $result]);
        }
        return $result['content'];
    }
}
