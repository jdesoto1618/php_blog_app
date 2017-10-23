<?php
  class Posts extends CI_Controller{
    // pass offset variable in, with default value specified. this is solely for pagination
    public function index($offset = 0){
      // CI pagination. store values in config array
      $config['base_url'] = base_url('posts/index');
      // total rows from the posts database. set this to be dynamic. count_all takes in a table as a parameter
      $config['total_rows'] = $this->db->count_all('posts');
      // ser posts per page to show. this blog is local, so use a small number, 5 or less
      $config['per_page'] = 5;
      // uri_segment settings. which segment is to be dynamically set for the blog uri? depends on hwo the routes and pages are set up, but for this app, http://localhost:8080/php_blog/posts/next_page would be segment 2, because the segments start at 1 after php_blog/
      // setting this to 2 didn't fully work though. the route for showing all posts became specified in the routes as $route['posts/index']. because of that, had to update the segment to 3
      $config['uri_segment'] = 3;
      // add class to pagination markup
      $config['attributes'] = array('class' => 'pagination_links');
      // init pagiantion once the required (>3) config options are set
      $this->pagination->initialize($config);
      // set page title array
      $data['title'] = 'Blog Posts';
      // set posts in data array. use the get_posts method from the Post model. User lowercase when referencing a model. pass in false as the first parameter. this is because in the model, there is a slug value for the corresponding function get_posts. this is what false handles first. for pagination, we need to dynamically set the page numbers, so offset will be passed in here as well. also, the per page must be passed in so the program knows how many posts to show per page. corresponding methods must have matching parameters passed in to each other between controllers and models
      $data['posts'] = $this->post_model->get_posts(false, $config['per_page'] = 5, $offset);
      // these lines will load the header and footer on each page in views/posts... make sure to set these pages up in the views. This is done so the same header and footer are shown on any page created inside views/posts
			$this->load->view('templates/header');
			$this->load->view('posts/index', $data);
			$this->load->view('templates/footer');
    }

    // set the view for each post
    public function view($slug = null){
      // get the post from the database according to the slug
      $data['post'] = $this->post_model->get_posts($slug);
      // get the post id and save it
      $post_id = $data['post']['id'];
      // store the comment in the data array from the comments model
      $data['comments'] = $this->comment_model->get_comments($post_id);
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
      // check user's login status. requires login before being able to create a post
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }
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
        // image upload path. uploaded images will be placed in this directory in the project, once the user presses submit post!
        $config['upload_path'] = './images/posts';
        // file types allowed for image upload
        $config['allowed_types'] = 'gif|jpg|png';
        // max image size upload
        $config['max_size'] = '2048';
        // max image width. this is set to 2000; the css will then resize the image
        $config['max_width'] = '2000';
        // max image height. this is set to 2000; the css will then resize the image
        $config['max_height'] = '2000';
        // load image library with config parameters
        $this->load->library('upload', $config);
        // check if the image is not loaded
        if(!$this->upload->do_upload()){
          $errors = array('error' => $this->upload->display_errors());
          // set default image when no image is uploaded by the user. make sure the image has this file name!
          $post_image = 'noimage.jpg';
        // if an image is uploaded by the user without errors
        } else {
          $data = array('upload_data' => $this->upload->data());
          // note image is the name of the field in the view
          $post_image = $_FILES['userfile']['name'];
        }
        // call the create_post method from the model. Since this takes $post_image as a parameter, the method in the model must also as well
        $this->post_model->create_post($post_image);
        // set message on successful post creation
        $this->session->set_flashdata('post_created', 'Post Created!');
        // this redirect route matches the one in the route file for sending the user to posts/index. successful post creation message is handled with set_flashdata();
        redirect('posts');
      }
    }

    public function edit($slug){
      // check user's login status. requires login before being able to edit a post
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }
      // get the post from the database according to the slug
      $data['post'] = $this->post_model->get_posts($slug);
      // check for incorrect user. since this is the posts, the field name in posts is fk_user_id. if a user other than the one who posted tries to edit a post, this will redirect them to the posts index
      if($this->session->userdata('user_id') != $this->post_model->get_posts($slug)['fk_user_id']){
        redirect('posts');
      }
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
      // check user's login status. requires login before being able to update a post
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }
      // get the update method from the database for this post
      $this->post_model->update_post();
      // set message on successful post update
      $this->session->set_flashdata('post_updated', 'Post Updated!');
      // redirect to all posts after updating. will alert the user to succesful post edit
      redirect('posts');
    }

    public function delete($id){
      // check user's login status. requires login before being able to delete a post
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }
      // get the delete method from the model for this post
      $this->post_model->delete_post($id);
      // set message on successful post delete
      $this->session->set_flashdata('post_deleted', 'Post Deleted Successfully.');
      // redirect to all posts after deletion. will alert the user on successful deletion
      redirect('posts');
    }
  }
