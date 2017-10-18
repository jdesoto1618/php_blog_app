<?php
  class Categories extends CI_Controller{

    public function index(){
      // set page title in data array. this can then be called as an instance variable in the categories index view
      $data['title'] = 'All Post Categories';
      // set categories in data array. use the get_categories method from the Category model (method must be present in the Category model in order for this to work). User lowercase when referencing a model
      $data['categories'] = $this->category_model->get_categories();
      // these lines will load the header and footer on each page in views/posts... make sure to set these pages up in the views. This is done so the same header and footer are shown on any page where these templates are called
			$this->load->view('templates/header');
			$this->load->view('categories/index', $data);
			$this->load->view('templates/footer');
    }

    public function create(){
      // check user's login status. requires login before being able to create a category
        redirect('users/login');
      }
      // page title for creating a post category
      $data['title'] = 'Create Post Category';
      // validate category name on form submit. set up form validations. in set_rules, first parameter is the field name in the form. second parameter is what will output in the event of an error. third is the rule, such as required
      $this->form_validation->set_rules('name', 'Category Name', 'required');
      // check whether the form validation passes(else statement) or not (false)
      if($this->form_validation->run() === false) {
        // reload page with header and footer templates if the validation fails
        $this->load->view('templates/header');
        // load the create view in categories folder, and pass in data array to the page. this will make the data array available to use in the create category page, as an instance variable
        $this->load->view('categories/create', $data);
        $this->load->view('templates/footer');
      } else {
        // if validation passes, go to model and load the method
        $this->category_model->create_category();
        // set message on successful post creation
        $this->session->set_flashdata('category_created', 'New Post Category Created!');
        // send user to create view on successful category create_function
        redirect('categories');
      } // end form validator if
    } // end create function

    // get the posts related to the category, using the category id
    public function posts($id){
      // set the title of this to the title of the category. we want only the name of the category
      $data['title'] = $this->category_model->get_category($id)->name;
      // now, set the posts into the data array from the post model
      $data['posts'] = $this->post_model->get_posts_by_category($id);
      // reload page with header and footer templates if the validation fails
      $this->load->view('templates/header');
      // load the index view in posts folder, and pass in data array to the page. this will render the post index with just the psots related to a selected category. this means a new view doesnt have to be created when selecting posts of a certain category
      $this->load->view('posts/index', $data);
      $this->load->view('templates/footer');
    }
  } // end categories class
