<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 1/2/2019
 * Time: 2:17 PM
 */

namespace App\Models\Section;

class Section
{
    public $name; //String
    public $description; //String
    public $sectionIdentifier; //String
    public $customStyle; //String
    public $customClasses; //String
    public $pageID; //integer
    public $page; //Page
    public $posts; //Post
    public $createdByID; //String
    public $createdBy; //ApplicationUser
    public $id; //integer
    public $createdDate; //String
}