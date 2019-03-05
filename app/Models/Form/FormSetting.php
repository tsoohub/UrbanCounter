<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 1/2/2019
 * Time: 1:44 PM
 */

namespace App\Models\Form;

class FormSetting
{
    public $companyEmailAddress; //String
    public $emailTemplate; //String
    public $updatedDate; //String
    public $smtpConfigurationID; //integer
    public $formID; //integer
    public $createdBy; //String
    public $smtpConfiguration; //SmtpConfiguration
    public $id; //integer
    public $createdDate; //String
}