<?php
  class Posts extends CI_Controller{
    public function index(){
      // set page title array
      $data['title'] = 'Latest Posts';
      // set posts in data array. use the get_posts method from the Post model. User lowercase when referencing a model
      $data['posts'] = $this->post_model->get_posts();
      // these lines will load the header and footer on each page in views/posts... make sure to set these pages up in the views. This is done so the same header and footer are shown on any page created inside views/posts
			$this->load->view('templates/header');
			$this->load->view('posts/index', $data);
			$this->load->view('templates/footer');
    }
  }
