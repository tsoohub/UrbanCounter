<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 2/6/2019
 * Time: 1:22 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class DetailsController extends Controller
{
    const WEB_IDENTIFIER = "icdc-urba-91344-celery";
    protected $menuServices;
    protected $formServices;
    protected $postsServices;
    protected $websiteServices;

    public function __construct(MenusController $menuServices,
                                FormController $formServices,
                                PostsController $postsServices,
                                WebsitesController $websiteServices)
    {
        $this->menuServices = $menuServices;
        $this->formServices = $formServices;
        $this->postsServices = $postsServices;
        $this->websiteServices = $websiteServices;
    }

    public function indexId(Request $request)
    {
        $id = $request->id ?? 0;

        // website data
        $website = $this->isSuccess($this->websiteServices->getWebsite(self::WEB_IDENTIFIER));
        $website = $website->website;

        // get Menus List By Website Id
        $menusList = $this->isSuccess($this->menuServices->getMenuByWebsiteId($website['id']));

        // create menu list by menu name
        $newMenusList = [];
        if(!empty($menusList)) {
            foreach ($menusList as $menu) {
                // get menu detail
                $menuItemsList = $this->isSuccess($this->menuServices->getMenuById($menu['id']));
                $newMenusList[$menu['name']] = $menuItemsList;
            }
        }

        // get post & metas and add to post
        $post = $this->isSuccess($this->postsServices->getPostById($id));
        $post->postMetas = $this->isSuccess($this->postsServices->getPostMetaByPostId($post->id));

        return view('post_detail', ['post' => $post, 'menus' => $newMenusList]);
    }
    public function indexIdentifier(Request $request)
    {
        $identifier = $request->identifier ?? "";

        return view('post_detail');
    }
}