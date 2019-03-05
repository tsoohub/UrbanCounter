<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 1/2/2019
 * Time: 2:14 PM
 */

namespace App\Models;


class ApplicationUser
{
    public $firstName; //String
    public $lastName; //String
    public $id; //String
    public $userName; //String
    public $normalizedUserName; //String
    public $email; //String
    public $normalizedEmail; //String
    public $emailConfirmed; //boolean
    public $passwordHash; //String
    public $securityStamp; //String
    public $concurrencyStamp; //String
    public $phoneNumber; //String
    public $phoneNumberConfirmed; //boolean
    public $twoFactorEnabled; //boolean
    public $lockoutEnd; //String
    public $lockoutEnabled; //boolean
    public $accessFailedCount; //integer
}