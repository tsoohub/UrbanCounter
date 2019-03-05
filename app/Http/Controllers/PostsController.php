<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 1/3/2019
 * Time: 10:40 AM
 */

namespace App\Http\Controllers;


use App\Http\Middleware\Client_API;
use App\Models\Post\Post;
use App\Models\Post\PostMeta;
use Karriere\JsonDecoder\JsonDecoder;

class PostsController
{
    protected $clientAPI;

    public function __construct()
    {
        $this->clientAPI = Client_API::getClient();
    }

    /* Gets all the posts */
    public function getPosts() {
        try {
            $allPosts = $this->clientAPI->get('/api/Posts');
            $postsList = json_decode($allPosts->getBody(), true);

            return ResponseHandler::success("success", $postsList);

        } catch (\Exception $e) {
            return ResponseHandler::error($e);
        }
    }

    /* Get a post by Id */
    public function getPostById($id) {

        try {
            $jsonDecoder = new JsonDecoder();
            $post = $this->clientAPI->get('/api/Posts/'.$id);
            $postModel = $jsonDecoder->decode($post->getBody(), Post::class);

            return ResponseHandler::success("success", $postModel);

        } catch (\Exception $e) {
            return ResponseHandler::error($e);
        }
    }

    /* Get a post by Post type */
    public function getPostByType($typeId) {

        try {
            $jsonDecoder = new JsonDecoder();
            $post = $this->clientAPI->get('/api/Posts/Type/'.$typeId);
            $postModel = $jsonDecoder->decode($post->getBody(), Post::class);

            return ResponseHandler::success("success", $postModel);

        } catch (\Exception $e) {
            return ResponseHandler::error($e);
        }
    }

    /* Get a post by Section Id */
    public function getPostBySectionId($sectionId) {

        try {
            $post = $this->clientAPI->get('/api/Posts/Section/'.$sectionId);
            $postsList = json_decode($post->getBody(), true);

            return ResponseHandler::success("success", $postsList);

        } catch (\Exception $e) {
            return ResponseHandler::error($e);
        }
    }

    /* Get a post by Section by PageID */
    public function getPostByPageID($pageId) {

        try {
            $post = $this->clientAPI->post('/api/Websites/Post/'.$pageId);
            $postsList = json_decode($post->getBody(), true);

            return ResponseHandler::success("success", $postsList);

        } catch (\Exception $e) {
            return ResponseHandler::error($e);
        }
    }

    /* Gets all the posts Meta */
    public function getPostsMeta() {

        try {
            $allPosts = $this->clientAPI->get('/api/Posts/PostMeta');
            $postsMetaList = json_decode($allPosts->getBody(), true);

            return ResponseHandler::success("success", $postsMetaList);

        } catch (\Exception $e) {
            return ResponseHandler::error($e);
        }
    }

    /* Get a Post Meta by Id */
    public function getPostsMetasById($id) {

        try {
            $jsonDecoder = new JsonDecoder();
            $postMeta = $this->clientAPI->get('/api/posts/postmeta/'.$id);
            $postMetaModel = $jsonDecoder->decode($postMeta->getBody(), PostMeta::class);

            return ResponseHandler::success("success", $postMetaModel);

        } catch (\Exception $e) {
            return ResponseHandler::error($e);
        }
    }

    /* Get a Post Metas by Post Id */
    public function getPostMetaByPostId($postId) {

        try {
            $postMeta = $this->clientAPI->get('/api/Posts/PostMeta/PostId/'.$postId);
            $postsMetaList = json_decode($postMeta->getBody(), true);

            return ResponseHandler::success("success", $postsMetaList);

        } catch (\Exception $e) {
            return ResponseHandler::error($e);
        }
    }

    public function getPostMetaByPageId($pageId) {

        try {
            $postMeta = $this->clientAPI->post('/api/Websites/PostMeta/'.$pageId);
            $postsMetaList = json_decode($postMeta->getBody(), true);

            return ResponseHandler::success("success", $postsMetaList);

        } catch (\Exception $e) {
            echo $e;
//            return ResponseHandler::error($e);
        }
    }
}
