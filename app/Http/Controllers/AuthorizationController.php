<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 1/3/2019
 * Time: 11:10 AM
 */

namespace App\Http\Controllers;


use App\Http\Middleware\Client_API;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Mockery\Exception;

class AuthorizationController extends Controller
{

    public function login(Request $request)
    {
        $email    = $request->input('Email');
        $password = $request->input('Password');

        try {
            $client = Client_API::getClient();

            $loginRes = $client->post('/api/Authorization/Login',
            ['form_params' => [
                    'Email' => $email,
                    'Password' => $password]]);

            if ($loginRes) {
                return ResponseHandler::success(
                    'Username / email / password found',
                    '200 login successful');
            } else {
                throw new Exception("The login is failed.");
            }
        } catch (Exception $ex) {
            return ResponseHandler::error($ex);
        }
    }
}