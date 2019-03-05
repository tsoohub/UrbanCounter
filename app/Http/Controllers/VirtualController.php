<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 1/28/2019
 * Time: 3:59 PM
 */

namespace App\Http\Controllers;


class VirtualController extends Controller
{
    const WEB_IDENTIFIER = "icdc-urba-91344-celery";
    protected $menuServices;
    protected $websiteServices;

    public function __construct(MenusController $menuServices,
                                WebsitesController $websiteServices)
    {
        $this->menuServices = $menuServices;
        $this->websiteServices = $websiteServices;
    }

    public function index()
    {
        // website data
        $website = $this->isSuccess($this->websiteServices->getWebsite(self::WEB_IDENTIFIER));
        $website = $website->website;

        // get Menus List By Website Id
        $menusList = $this->isSuccess($this->menuServices->getMenuByWebsiteId($website['id']));

        // create menu list by menu name
        $newMenusList = [];
        if(!empty($menusList)) {
            foreach ($menusList as $menu) {

                // get menu data by id
                $newMenusList[$menu['name']] = $this->isSuccess($this->menuServices->getMenuById($menu['id']));
            }
        }

        return view('virtual.body', ['menus' => $newMenusList]);
    }
}