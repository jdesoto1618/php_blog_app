<?php
  class Comments extends CI_Controller{
    public function create($post_id){
      // save the slug for the post
      $slug = $this->input->post('slug');
      // get the post for this comment
      $data['post'] = $this->post_model->get_posts($slug);
      // save comments from the comments model. this line is needed in order to pass $comments to the post view
      $data['comments'] = $this->comment_model->get_comments($post_id);
      // form validation on creating comments. set_rules syntax: field_name, error title output, rule
      $this->form_validation->set_rules('name','Name','required');
      // sanity check for a valid email address.  can specify multiple parameters for set rules by piping them in
      $this->form_validation->set_rules('email','Email','required|valid_email');
      // can't submit an empty comment
      $this->form_validation->set_rules('body','Comment','required');
      // check if the validation passed
      if( $this->form_validation->run() === false){
        // load the same post and templates if the comment doesnt pass validation
        $this->load->view('templates/header');
        // load the same post if the comment fails
  			$this->load->view('posts/view', $data);
  			$this->load->view('templates/footer');
      } else {
        $this->comment_model->create_comment($post_id);
        // redirect the user to the same post, which will show their posted comment
        // concatenate the slug, since this stores the specific post
        redirect('/posts/'.$slug);
      } // end if
    } // end create
  } // end class
