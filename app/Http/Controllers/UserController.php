<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 12/18/2018
 * Time: 5:03 PM
 */

namespace App\Http\Controllers;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\User;
use GuzzleHttp\Client;
use App\Http\Middleware\Client_API;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ];

        $customMessages = [
            'required' => 'Please fill attribute :attribute'
        ];
        $this->validate($request, $rules, $customMessages);

        try {
            $hasher = app()->make('hash');
            $username = $request->input('username');
            $email = $request->input('email');
            $password = $hasher->make($request->input('password'));

            $client = new Client();
            $test = $client->request('GET', 'https://icodicecms.azurewebsites.net/api/websites/identifier/icdc-icdc-18543-potato', [
                'form_params' => [
                    'Username' => env('ICMS_USERNAME'),
                    'Password' => env('ICMS_PASSWORD')
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . env('ICMS_API_TOKEN')
                ]
            ]);

            return $test->getBody();

//            $res['status'] = true;
//            $res['message'] = 'Registration success!';
//            return response($res, 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            $res['status'] = false;
            $res['message'] = $ex->getMessage();
            return response($res, 500);
        }
    }

    public function test() {
        $client = Client_API::getClient();

        try {
            $test = $client->request('GET', '/api/websites/identifier/icdc-icdc-18543-potato',
                ['form_params' => [
                    'Username' => env('ICMS_USERNAME'),
                    'Password' => env('ICMS_PASSWORD')
                ]]
            );
            $test->getStatusCode();
        } catch (GuzzleException $e) {
            return $e;
        }
    }

    public function get_user()
    {
        $user = User::all();
        if ($user) {
            $res['status'] = true;
            $res['message'] = $user;

            return response($res);
        }else{
            $res['status'] = false;
            $res['message'] = 'Cannot find user!';

            return response($res);
        }
    }
}