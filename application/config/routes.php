<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// set route for creating new post. if user types in posts/create(left side), route points to posts/create(right side)
// when the route is $route['posts/create'] = 'posts/create', the user would have to type controller_name(posts)/method_name(create)/posts_folder(posts)/file_name(create)... we want it to just be /create. to do this, set the left side of the route to $route['create'] = 'posts/create'. this makes sense because we are routing a typed address of /php_blog/create to 'posts/create'... but this didn't work when actually submitting the form! form validations wouldn't work, and i ended up moving this here and changing it to $route['posts/create'] = 'posts/create' D:
$route['posts/create']                                = 'posts/create';
// route for updating(editing) a post
$route['posts/update']                                = 'posts/update';
// set route for viewing individual posts
$route['posts/(:any)']                                = 'posts/view/$1';
// set route to view posts. first value in route array is the controller. the first value is also what can be typed in the address bar to route you to the right side of the equals. so, /php_blog/posts routes to /php_blog/posts/index. Either one is correct, but the smaller url looks better and cleaner
$route['posts']                                       = 'posts/index';
// set this any route so you can navigate to /php_blog/about instead of /php_blog/pages/view/about
$route['(:any)']                                      = 'pages/view/$1';
// default routes
$route['default_controller']                          = 'pages/view';
$route['404_override']                                = '';
$route['translate_uri_dashes']                        = FALSE;
