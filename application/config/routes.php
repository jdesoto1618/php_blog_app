<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// set route to view posts. first value in route array is the controller. the first value is also what can be typed in the address bar to route you to the right side of the equals. so, /php_blog/posts routes to /php_blog/posts/index. Either one is correct, but the smaller url looks better and cleaner
$route['posts'] = 'posts/index';
// set this any route so you can navigate to /php_blog/about instead of /php_blog/pages/view/about
$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'pages/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
