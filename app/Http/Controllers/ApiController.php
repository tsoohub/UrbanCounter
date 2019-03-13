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

    public function pathFolder() {
        // find the subdirectories of public folder
        $directors = $this->listFolderFiles(public_path());

        // convert to the json
        $json = json_encode(['public' => $directors]);

        return $json;
    }

    // Find the all the directories only in the public folder
    function listFolderFiles($dir){
        // Copy the directories of given folder
        $ffs = scandir($dir);

        // Remove useless dots
        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);

        // prevent empty ordered elements
        if (count($ffs) < 1)
            return;

        // subdirectories of folder
        $dirs = [];

        // loop the each directory to find the all directories inside it
        foreach($ffs as $ff){
            // is it directory
            if(is_dir($dir.'/'.$ff)) {
                // find the sub-directories of directory
                $dirRes = $this->listFolderFiles($dir.'/'.$ff);
                // if not subdirectories, give name of directory otherwise give the subdirectories
                $dirs[$ff] = !empty($dirRes) ? $dirRes : null;
            };
        }

        // directories
        return $dirs;
    }

}
