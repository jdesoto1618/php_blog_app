<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Joe's Blog</title>
    <!-- Bootstrap, CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Bootstrap, JS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
    <nav class="navbar navbar-inverse">
        <!-- change container-fluid class to container so the navbar items have padding -->
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- set home page when brand is clicked. will leave this as the standard href, to show it's fine to use this one as well as the PHP helper -->
            <a class="navbar-brand" href="/php_blog">Blogs for 2017</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <!-- ok to use the href="/php_blog" to have the link send a user to home. Since this is in PHP, can also use the PHP helper, as long as autoload is configured first. Same with the about page -->
              <!-- this didnt work for me though, as the base_url points to a route using port 80. Normally not a problem, but I had changed my default port to 8080, thinking port 80 was already in use -->
              <!-- solution to this was to set the config for the base url to point to port 8080. this is located in /application/config/config.php -->
              <!-- $config['base_url'] = 'http://localhost:8080/php_blog/'; -->
              <li><a href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a></li>
              <li><a href="<?php echo base_url(); ?>about">About</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
              <li><a href="<?php echo base_url(); ?>sign_in">Sign In</a></li>
            </ul>
          </div><!-- .navbar-collapse -->
        </div><!-- .container-fluid -->
      </nav>
  </head>
  <body>
    <div class="container">
