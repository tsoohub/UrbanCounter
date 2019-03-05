<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 1/4/2019
 * Time: 4:58 PM
 */

namespace App\Http\Controllers;


use App\Http\Middleware\Client_API;
use App\Models\Menu\Menu;
use Karriere\JsonDecoder\JsonDecoder;

class MenusController
{
    protected $clientAPI;

    public function __construct()
    {
        $this->clientAPI = Client_API::getClient();
    }

    /* Gets all the menus */
    public function getMenus() {
        try {
            $menu = $this->clientAPI->get('/api/Menus');
            $menusList = json_decode($menu->getBody(), true);

            return ResponseHandler::success("success", $menusList);

        } catch (\Exception $e) {
            return ResponseHandler::error($e);
        }
    }

    /* Get a menu by Id */
    public function getMenuById($id) {

        try {
            $menu = $this->clientAPI->get('/api/Menus/'.$id);
            $jsonDecoder = new JsonDecoder();
            $menuModel = $jsonDecoder->decode($menu->getBody(), Menu::class);

            return ResponseHandler::success("success", $menuModel);

        } catch (\Exception $e) {
            return ResponseHandler::error($e);
        }
    }
    /* Get a menu by Website Id */
    public function getMenuByWebsiteId($id) {

        try {
            $menu = $this->clientAPI->get('/api/Menus/Websiteid/'.$id);
            $menus = json_decode($menu->getBody(), true);

            return ResponseHandler::success("success", $menus);

        } catch (\Exception $e) {
            return ResponseHandler::error($e);
        }
    }

}