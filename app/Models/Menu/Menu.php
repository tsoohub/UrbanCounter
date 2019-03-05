<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 1/4/2019
 * Time: 4:52 PM
 */


namespace App\Models\Menu;

class Menu
{
    public $name; //String
    public $description; //String
    public $websiteID; //integer
    public $website; //Website
    public $menuItems; //MenuItem
    public $id; //integer
    public $createdDate; //String
}