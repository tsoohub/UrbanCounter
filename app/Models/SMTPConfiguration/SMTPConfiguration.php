<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 1/2/2019
 * Time: 2:09 PM
 */

namespace App\Models;


class SMTPConfiguration
{
    public $hostName; //String
    public $port; //integer
    public $username; //String
    public $password; //String
    public $sslEnabled; //boolean
    public $id; //integer
    public $createdDate; //String
}