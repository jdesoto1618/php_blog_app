<?php
  class Users extends CI_Controller{
    // user sign up, form validations
    public function register(){
      // save the page title in $data. To use this in a view, use $title. What is specified in the array key becomes the instance variable the view can access
      $data['title'] = 'Registration Page';
      // validation rules for user sign up form. set_rules() syntax is field name in the view, display name for error messages, and rule to set, such as required. to chain multiple rules, do not use whitespace between pipes
      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
      $this->form_validation->set_rules('password', 'Password', 'required');
      // set password confirmation rule so that password confirmation matches password field
      $this->form_validation->set_rules('pwconf', 'Password Confirmation', 'matches[password]');
      // if form validation fails
      if($this->form_validation->run() === false){
        // load view templates and also the same registration page with the errors if form validation fails
        $this->load->view('templates/header');
        $this->load->view('users/register', $data);
        $this->load->view('templates/footer');

      } else {
        // if form validation passes, redirect to a posts page? perhaps to show all posts? also, could use a welcome message when the user is signed in successfully
        // encrypt the password before submitting it to the database. the value to be encrypted is from the password and password confirmation fields in the form
        // grab the value the user submitted in the password field
        $enc_password = md5($this->input->post('password'));
        // also encrypt the password confirmation. set this to empty for development; set this up to encrypt for production
        // $enc_pwconf;
        // send data after encryption to the model. for production, also pass enc_pwconf to this function, and also to the corresponding function in the user model
        $this->user_model->register($enc_password);
        // set flash message on successful registration. this requires the session library to be autoloaded
        // since session is a library, it uses the syntax $this->library_name->library_function_name();
        // first parameter in set_flashdata is user_registered... unsure why. second parameter is the message to be displayed
        $this->session->set_flashdata('user_registered', 'Registration Successful!');
        // send user back to posts page after succesful registration. no new route needed for this because this route is already set up
        redirect('posts');
      }
    } // ends register function

    // check if the username is taken already when registering. $username will store the field input data from the form
    public function check_username_exists($username){
      // similar to flashdata, the first parameter in set_message will be the id for this message to be called. second parameter is the message that will show
      $this->form_validation->set_message('check_username_exists', 'Username is already taken.');
      // use the database to see if a username exists. if it does, this function will return true, and the user must use another username. if not, this function returns false, and the username is assigned to that user
      if($this->user_model->check_username_exists($username)){
        return true;
      } else {
        return false;
      } // end if
    } // end check_username_exists

    // user login
    public function login(){
      // set page title
      $data['title'] = 'Account Login';
      // validation rules for user sign up form. set_rules() syntax is field name in the view, display name for error messages, and rule to set, such as required. to chain multiple rules, do not use whitespace between pipes
      $this->form_validation->set_rules('username', 'Username', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');
      // if form validation fails (returns false)
      if($this->form_validation->run() === false){
        // load view templates and also the same registration page with the errors if form validation fails
        $this->load->view('templates/header');
        $this->load->view('users/login', $data);
        $this->load->view('templates/footer');

      } else {
        // if form validation passes, redirect to all posts, with a flash message displayed
        // get username, store it in $username. to get an input from a form, use $this->input->post('form_field_name');
        $username = $this->input->post('username');
        // get and encrypt user's password
        $password = md5($this->input->post('password'));
        // user's unique id after login. run this on the model. if login information is incorrect, this will return false
        $user_id = $this->user_model->login($username, $password);
        // check user id
        if($user_id){
          // create user session after successful login. save the user data
          $user_data =
          [
            'user_id'   => $user_id,
            'username'  => $username,
            'logged_in' => true,
          ];
          // store session data using sessions library
          $this->session->set_userdata($user_data);
          // if user id and password match those in the database
          // set flash message on successful registration. this requires the session library to be autoloaded
          // since session is a library, it uses the syntax $this->library_name->library_function_name();
          // first parameter in set_flashdata is user_registered. this can be anything, and identifies this particular flash message. use this to call the message in views. second parameter is the message to be displayed
          $this->session->set_flashdata('user_loggedin', 'Login Successful! Welcome '.$user_data['username']);
          // send user back to posts page after succesful login. no new route needed because this route is already set up
          redirect('posts');
        } else {
          // set error message for wrong user id and or password combination
          $this->session->set_flashdata('login_fail', 'Incorrect Username or Password');
          // redirect to login page if there was an error
          redirect('users/login');
        } // end nested if
      } // end if
    } // end login function

    public function logout(){
      // unset $user_data from login function
      $this->session->unset_userdata('user_id');
      $this->session->unset_userdata('username');
      $this->session->unset_userdata('logged_in');
      // show logout message
      $this->session->set_flashdata('user_logout', 'Logged Out. Well.... Bye.');
      // send user back to login page after a logout
      redirect('users/login');
    } // ends logout function
  } // ends class
