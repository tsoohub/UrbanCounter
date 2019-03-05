<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 1/2/2019
 * Time: 3:59 PM
 */

namespace App\Http\Controllers;


use App\Http\Middleware\Client_API;
use App\Models\Form\Forms;
use App\Models\Form\Form;
use App\Models\Form\FormSetting;
use GuzzleHttp\Exception\GuzzleException;
use Karriere\JsonDecoder\JsonDecoder;

class FormController
{
    /* Gets all the forms */
    public function getForms() {
        $client = Client_API::getClient();
        try {
            $forms = new Forms();
            $form = $client->get('/api/Forms');
            $formsList = json_decode($form->getBody(), true);
            foreach ($formsList as $form) {
                $forms->formsList[] = $form;
            }
            return ResponseHandler::success("success", $forms->formsList);

        } catch (GuzzleException $e) {
            return ResponseHandler::error($e);
        }
    }

    /* Get a form by Id */
    public function getFormById($id) {
        $identifier = $id;
        $client = Client_API::getClient();

        try {
            $form = $client->get('/api/Forms/'.$identifier);
            $jsonDecoder = new JsonDecoder();
            $formModel = $jsonDecoder->decode($form->getBody(), Form::class);

            return ResponseHandler::success("success", $formModel);

        } catch (GuzzleException $e) {
            return ResponseHandler::error($e);
        }
    }

    /* Get a forms by page id */
    public function getFormByPageId($pageId) {
        $identifier = $pageId;
        $client = Client_API::getClient();

        try {
            $forms = new Forms();
            $wForm = $client->get('/api/Forms/page/' . $identifier);
            $formsList = json_decode($wForm->getBody(), true);
            foreach ($formsList as $form) {
                $forms->formsList[] = $form;
            }
            return ResponseHandler::success("success",  $forms->formsList);

        } catch (GuzzleException $e) {
            return ResponseHandler::error($e);
        }
    }

    /* Get a form setting by form id */
    public function getFormSettingByFormId($formId) {
        $identifier = $formId;
        $client = Client_API::getClient();

        try {
            $formSetting = $client->get('/api/Forms/setting/'.$identifier);
            $jsonDecoder = new JsonDecoder();
            $formModel = $jsonDecoder->decode($formSetting->getBody(), FormSetting::class);

            return ResponseHandler::success("success",  $formModel);

        } catch (GuzzleException $e) {
            return ResponseHandler::error($e);
        }
    }
}