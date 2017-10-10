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

    // set the view for each post
    public function view($slug = null){
      // get the post from the database according to the slug
      $data['post'] = $this->post_model->get_posts($slug);

      // page not found error for viewing nonexistent post
      if(empty($data['post'])){
        show_404();
      }

      // title for each post, show this on posts/view once the button is clicked
      $data['title'] = $data['post']['title'];
      // load header, footer, and view page on posts/view
      $this->load->view('templates/header');
			$this->load->view('posts/view', $data);
			$this->load->view('templates/footer');
    }

    public function create(){
      // title for a creating posts page. show this on posts/create. $data is accessing the title field from the database. can access any field's values in this way
      $data['title'] = 'Create Post';
      //  get the category values from the database. this must also be called in the model
      $data['categories'] = $this->post_model->get_categories();
      // set up form validations. in set_rules, first parameter is the field name in the form? Second is what will output in the event of an error
      $this->form_validation->set_rules('title', 'Post Title', 'required');
      $this->form_validation->set_rules('body', 'Post Body', 'required');
      // check if the form fields are valid
      if($this->form_validation->run() === false) {
        // load header, footer, and view page on posts/view
        $this->load->view('templates/header');
        $this->load->view('posts/create', $data);
        $this->load->view('templates/footer');
      } else {
        // if the form validation passes, go to the post model, render the posts views to see your post in with all others. should be on top of all others. also, need a success message, sweet alert, something to let the user know the post status
        $this->post_model->create_post();
        // this redirect route matches the one in the route file for sending the user to posts/index. successful post creation message?
        redirect('posts');
      }
    }

    public function edit($slug){
      // get the post from the database according to the slug
      $data['post'] = $this->post_model->get_posts($slug);
      //  get the category values from the database. this must also be called in the model
      $data['categories'] = $this->post_model->get_categories();
      // page not found error for viewing nonexistent post
      if(empty($data['post'])){
        show_404();
      }

      // title for each post, show this on posts/view once the button is clicked
      $data['title'] = 'Edit Post';
      // load header, footer, and view page on posts/edit
      $this->load->view('templates/header');
			$this->load->view('posts/edit', $data);
			$this->load->view('templates/footer');
    }

    public function update(){
      // get the update method from the database for this post
      $this->post_model->update_post();
      // redirect to all posts after updating. some sort of alert here?
      redirect('posts');
    }

    public function delete($id){
      // get the delete method from the model for this post
      $this->post_model->delete_post($id);
      // redirect to all posts after deletion. some sort of alert here?
      redirect('posts');
    }
  }
