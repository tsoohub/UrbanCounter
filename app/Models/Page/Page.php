<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 1/2/2019
 * Time: 1:30 PM
 */

namespace App\Models\Page;

class Page
{
    public $title; //String
    public $url; //String
    public $metaKeys; //String
    public $customCSS; //String
    public $customJS; //String
    public $status; //integer
    public $identifier; //String
    public $createdBy; //String
    public $parentPageID; //integer
    public $websiteID; //integer
    public $website; //Website Object
    public $sections; //Sections Array
    public $metaData; //Metadata Array
    public $id; //String
    public $createdDate; //String
}