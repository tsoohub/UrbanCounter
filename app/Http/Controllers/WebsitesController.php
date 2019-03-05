<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 1/7/2019
 * Time: 12:07 PM
 */

namespace App\Http\Controllers;


use App\Http\Middleware\Client_API;
use App\Models\Websites\WebsiteModel;
use Karriere\JsonDecoder\JsonDecoder;

class WebsitesController
{
    protected $clientAPI;

    public function __construct()
    {
        $this->clientAPI = Client_API::getClient();
    }

    public function getWebsite($id) {

        try {
            $website = $this->clientAPI->get('/api/websites/identifier/' . $id);
            $jsonDecoder = new JsonDecoder();
            $websiteModel = $jsonDecoder->decode($website->getBody(), WebsiteModel::class);
            return ResponseHandler::success("success", $websiteModel);

        } catch (\Exception $e) {
            return ResponseHandler::error($e);
        }
    }

    public function getWebsiteById($id) {

        try {
            $website = $this->clientAPI->get('/api/Websites/' . $id);
            $jsonDecoder = new JsonDecoder();
            $websiteModel = $jsonDecoder->decode($website->getBody(), WebsiteModel::class);
            return ResponseHandler::success("success", $websiteModel);

        } catch (\Exception $e) {
            return ResponseHandler::error($e);
        }
    }

    public function getWebsites() {
        try {
            $website = $this->clientAPI->get('/api/Websites');
            $websites = json_decode($website->getBody(), true);
            return ResponseHandler::success("success", $websites);

        } catch (\Exception $e) {
            return ResponseHandler::error($e);
        }
    }

    /* Get Pages by page identifier */
    public function getPagesById($id) {

        try {
            $pages = $this->clientAPI->get('/api/Websites/Page/' . $id);
            $pagesLists = json_decode($pages->getBody(), true);
            return ResponseHandler::success("success", $pagesLists);

        } catch (\Exception $e) {
            return ResponseHandler::error($e);
        }
    }

    /* Get Section by page id */
    public function getSectionById($pageId) {

        try {
            $pageSection = $this->clientAPI->post('/api/Websites/Section/' . $pageId);
            $sectionsLists = json_decode($pageSection->getBody(), true);
            return ResponseHandler::success("success", $sectionsLists);

        } catch (\Exception $e) {
            return ResponseHandler::error($e);
        }
    }
}