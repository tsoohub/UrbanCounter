<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/*$router->get('/', function () use ($router) {
    return view('index');
});
$router->get('/home', function () use ($router) {
    return view('index');
});*/
/* Home */
$router->get('/', 'HomeController@index');
$router->get('/home', 'HomeController@index');

$router->get('/stone', 'StonesController@index');

$router->get('/sinks', 'SinksController@index');

/* Detail Routes*/
$router->get('/detail/{id}', 'DetailsController@indexId');
$router->get('/detail/identifier/{identifier}', 'DetailsController@indexIdentifier');

/* Create File Routes */
$router->post('/addFile', ['uses' => 'ImagesController@upload']);

/* Contact Routes */
$router->get('/contact', 'ContactController@index');

/* Quote Routes */
$router->get('/quote', 'QuoteController@index');

/* Testimonials Routes */
$router->get('/testimonial', 'TestimonialsController@index');

/* FAQ Routes */
$router->get('/faq', 'FAQController@index');

/* About Routes */
$router->get('/about', 'AboutController@index');

/* Virtual Routes */
$router->get('/urban-virtual', 'VirtualController@index');

/* Gallery Routes */
$router->get('/gallery', 'GalleryController@index');

/* ApiController Routers */
$router->post('/register', 'UserController@register');
$router->post('/test', 'UserController@test');
$router->get('/user', ['middleware' => 'auth', 'uses' =>  'UserController@get_user']);
$router->get('/api/customApi', 'ApiController@getAPIs');
$router->get('/person', 'ApiController@getPerson');



/* Websites Routes */
$router->get('/api/websites/{id}', [
    'uses' => 'WebsitesController@getWebsite'
]);
$router->get('/api/websites/id/{id}', [
    'uses' => 'WebsitesController@getWebsiteById'
]);
$router->get('/api/websites', [
    'uses' => 'WebsitesController@getWebsites'
]);
$router->get('/api/websites/page/{id}', [
    'uses' => 'WebsitesController@getPagesById'
]);
$router->get('/api/websites/section/{id}', [
    'uses' => 'WebsitesController@getSectionById'
]);


/* Forms Routers */
$router->get('/api/forms', [
    'uses' => 'FormController@getForms'
]);
$router->get('/api/forms/{id}', [
    'uses' => 'FormController@getFormById'
]);
$router->get('/api/forms/page/{pageId}', [
    'uses' => 'FormController@getFormByPageId'
]);
$router->get('/api/forms/settings/{formId}', [
    'uses' => 'FormController@getFormSettingByFormId'
]);


/* Posts Routers */
$router->get('/api/posts/', [
    'uses' => 'PostsController@getPosts'
]);
$router->get('/api/posts/{id}', [
    'uses' => 'PostsController@getPostById'
]);
$router->get('/api/posts/type/{typeId}', [
    'uses' => 'PostsController@getPostByType'
]);
$router->get('/api/posts/section/{sectionId}', [
    'uses' => 'PostsController@getPostBySectionId'
]);
$router->get('/api/postsMeta/', [
    'uses' => 'PostsController@getPostsMeta'
]);
$router->get('/api/postsMeta/{id}', [
    'uses' => 'PostsController@getPostsMetasById'
]);
$router->get('/api/postsMeta/postId/{id}', [
    'uses' => 'PostsController@getPostMetaByPostId'
]);

/* Authorization Routers */
$router->post('/api/login', [
    'uses' => 'AuthorizationController@login'
]);
