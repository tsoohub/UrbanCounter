<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 1/4/2019
 * Time: 4:54 PM
 */

namespace App\Models\Menu;


class MenuItem
{
    public $menuID; //integer
    public $parentID; //integer
    public $title; //String
    public $url; //String
    public $menu; //Menu
    public $parent; //Object
    public $childItems; //Array
    public $id; //integer
    public $createdDate; //String
}