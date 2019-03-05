<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 1/24/2019
 * Time: 2:08 PM
 */

namespace App\Http\Controllers;


class FAQController extends Controller
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

    public function index()
    {
        $pageId = 46;

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

        // get sections by page Id
        $pageSections = $this->isSuccess($this->websiteServices->getSectionById($pageId));

        // create section list to pass view
        $sectionsList = [];
        if(isset($pageSections))
        foreach ($pageSections as $section) {

            // get posts by section id
            $posts = $this->isSuccess($this->postsServices->getPostBySectionId($section['id']));

            // create posts and assign to the corresponding section
            $postsList = [];
            if(!empty($posts)) {
                foreach ($posts as $post) {

                    // get post metas by post id
                    $postMetasList = $this->isSuccess($this->postsServices->getPostMetaByPostId($post['id']));

                    // create post metas list and assign to the corresponding post
                    $newPost = $post;
                    $newPost['postMetas'] = $postMetasList;
                    $postsList[] = $newPost;
                }
            }

            $newSection = $section;
            $newSection['posts'] = $postsList;
            $sectionsList[$section['sectionIdentifier']] = $newSection;
        }

        return view('faq', ['sections' => $sectionsList, 'menus' => $newMenusList]);
    }
    function filterPost($post, $sectionId){
        return $post["sectionID"] == 46;
    }

    /* Return content if success, otherwise redirect missing.php */
    function isSuccess($result) {

        if(!$result['success']) {
            return view('missing', ['result' => $result]);
        }
        return $result['content'];
    }
}
