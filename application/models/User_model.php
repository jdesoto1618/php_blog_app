<?php
  class User_model extends CI_Model{
    public function __construct(){
      // load the database when this model is used
      $this->load->database();
    }

    // set function for submitting user registration data to the database
    public function register($enc_password){
      // create data array to store the data for submission to the database
      $data =
      [
        // grab the field input data for name. the left side of the arrow is the table field name. the parameter in post must match the name attribute on the input
        'name' => $this->input->post('name'),
        // grab the field input data for email. the left side of the arrow is the table field name. parameter in post must match the email attribute on the input
        'email' => $this->input->post('email'),
        // grab the field input data for email. the left side of the arrow is the table field name. parameter in post must match the email attribute on the input
        'username' => $this->input->post('username'),
        // grab the field input data for email. the left side of the arrow is the table field name. parameter in post must match the email attribute on the input
        'zipcode' => $this->input->post('zipcode'),
        // grab the field input data for email. the left side of the arrow is the table field name. parameter in post must match the email attribute on the input. use the $enc_password version of the user's password here
        'password' => $enc_password,
      ];
      // submit the stored data to the database. use insert('table_name', values)
      return $this->db->insert('users', $data);
    } // end register

    // check the database if a username exists
    public function check_username_exists($username){
      // run the database query to check uniqueness of a username. get_where('table_name', array_to_match value)
      $query = $this->db->get_where('users', array('username' => $username));
      // if the query returns no results, i.e. the username is unique, return true. it is unique
      if(empty($query->row_array())){
        return true;
      } else {
        // username is not unique, and the user trying to register must choose another
        return false;
      }
    } // end check_username_exists

    // user login
    public function login($username, $password){
      // validate userame and password. separate by comma when not in an array
      $this->db->where('username', $username);
      $this->db->where('password', $password);
      // return results from database. get needs table name
      $result = $this->db->get('users');
      // check the results to see if login information is correct. look for just one matching result
      if($result->num_rows() == 1){
        // return the actual id when login info is good
        return $result->row(0)->id;
      } else {
        // login information doesnt match the database
        return false;
      }
    } // end login
  } // end class
