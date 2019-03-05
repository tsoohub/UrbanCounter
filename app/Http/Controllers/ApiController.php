<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 12/20/2018
 * Time: 2:37 PM
 */

namespace App\Http\Controllers;
use App\Models\Section\Sections;
use App\Models\Websites\Website;
use App\Models\Websites\WebsiteModel;
use App\Models\Websites\Websites;
use GuzzleHttp\Client;
use App\Http\Middleware\Client_API;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\View;
use Karriere\JsonDecoder\JsonDecoder;
use App\Models\Person;
use App\Models\Page\Pages;
use Mockery\Exception;
use phpDocumentor\Reflection\Types\Array_;

class ApiController extends Controller
{

    public function getAPIs($reqType = 'GET', $url = 'posts/2', $params=[]) {
        $client = Client_API::getClient();
        $response = $client->request($reqType, $url, $params);
        return $response->getBody();
    }

    public function getPosts() {
        $id = 2;
        $client = new Client();
        $website = $client->request('GET', 'https://icodicecms.azurewebsites.net/api/posts/' . $id, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('ICMS_API_TOKEN')
            ]
        ]);
        return $website->getBody();
    }

    public function getPerson() {
        $jsonDecoder = new JsonDecoder();
        $jsonData = '{"id": 1, "name": "John Doe"}';

        $person = $jsonDecoder->decode($jsonData, Person::class);

        return \view('person')->with('person', $person);
    }

}
