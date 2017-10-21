<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Joe's Blog</title>
    <!-- CKEditor text editor CDN -->
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <!-- Bootstrap CDN, CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- CSS stylesheet link. ended up using main.css?v=<?//=time();?> because the css file wouldnt always reload the local changes. SO reports many complicated solutions for this, but I ended up using this one. Comments also say this will NOT work in prod.... this solution may end up removing caching abilties in css. may need to just use ctrl shift r to hard refresh changes in cache. another simple solution is to disable cache in network tab under chrome dev tools -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/main.css">
    <!-- set font to open sans -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <!-- change container-fluid class to container so the navbar items have padding -->
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <!-- set home page when brand is clicked. will leave this as the standard href, to show it's fine to use this one as well as the PHP helper -->
          <!-- removed the href="/php_blog" from the brand, redundant with the home link next to it, pointing to the same page. leaving this as an anchor means it will still light up on hover -->
          <!-- ended up placing the about page as the link for live journal, to make room for a users section in navbar -->
          <a class="navbar-brand" href="<?php echo base_url(); ?>about">LIVE JOURNAL</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <!-- ok to use the href="/php_blog" to have the link send a user to home. Since this is in PHP, can also use the PHP helper, as long as autoload is configured first. Same with the about page -->
            <!-- this didnt work for me though, as the base_url points to a route using port 80. Normally not a problem, but I had changed my default port to 8080, thinking port 80 was already in use -->
            <!-- solution to this was to set the config for the base url to point to port 8080. this is located in /application/config/config.php -->
            <!-- $config['base_url'] = 'http://localhost:8080/php_blog/'; -->
            <li><a href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a></li>
            <li><a href="<?php echo base_url(); ?>posts">All Posts</a></li>
            <!-- add dropdown menu for post categories and creating a category. note: do NOT close off the li for the dropdown! counter-intuitively, this will cause it to not work -->
            <!-- if the user is logged in, show the post categories and create category options -->
            <?php if($this->session->userdata('logged_in')): ?>
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">Post Categories
              <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>categories">Show Categories</a></li>
                <li><a href="<?php echo base_url(); ?>categories/create">Create a Category</a></li>
              </ul>
            <?php endif; ?>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <!-- add dropdown menu for logging in and signing up. note: do NOT close off the li for the dropdown! counter-intuitively, this will cause it to not work -->
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">My Account
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <!-- if the user is not logged in, show the log in and register buttons -->
              <?php if(!$this->session->userdata('logged_in')): ?>
                <li><a href="<?php echo base_url(); ?>users/login">Log In</a></li>
                <li><a href="<?php echo base_url(); ?>users/register">Register</a></li>
              <!-- if the user is logged in, show just the log out button. they dont need to log in again -->
              <?php else: ?>
                <li><a href="<?php echo base_url(); ?>users/logout">Log Out</a></li>
              <?php endif; ?>
            </ul>
            <!-- added posts/create to the base_url because this is how it's set up in the routes for creating a post -->
            <!-- if a user is logged in, they can see the option to create a post -->
            <?php if($this->session->userdata('logged_in')): ?>
              <li><a href="<?php echo base_url(); ?>posts/create"><span class="glyphicon glyphicon-plus-sign"></span> New Post</a></li>
            <?php endif; ?>
          </ul>
        </div><!-- .navbar-collapse -->
      </div><!-- .container-fluid -->
    </nav>

    <div class="container">
      <!-- show flash messages. user_registered is a parameter that has to match up to one specified in the controller. checks whether a user is registered -->
      <!-- this is terrible code -->
      <?php if($this->session->flashdata('user_registered')) : ?>
        <?= '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('post_created')) : ?>
        <?= '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'; ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('post_updated')) : ?>
        <?= '<p class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>'; ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('post_deleted')) : ?>
        <?= '<p class="alert alert-success">'.$this->session->flashdata('post_deleted').'</p>'; ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('category_created')) : ?>
        <?= '<p class="alert alert-success">'.$this->session->flashdata('category_created').'</p>'; ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('user_loggedin')) : ?>
        <?= '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>'; ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('user_logout')) : ?>
        <?= '<p class="alert alert-success logout">'.$this->session->flashdata('user_logout').'</p>'; ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('login_fail')) : ?>
        <?= '<p class="alert alert-danger login_fail">'.$this->session->flashdata('login_fail').'</p>'; ?>
      <?php endif; ?>
