<?php
  class Comment_model extends CI_Model{
    public function __construct(){
      // load the database when this model is invoked
      $this->load->database();
    }

    // create the comment to a specific post, store in the database under comments table
    // post_id is in the comments table
    public function create_comment($post_id){
      // create the data array for submitting to the database. comments must have a name, email, and body, so these must also be in this data array
      $data =
      [
        'post_id' => $post_id,
        // these come from the form and it needs to be saved on submit. use $this->input->post('field_name')
        'name'    => $this->input->post('name'),
        'email'   => $this->input->post('email'),
        'body'    => $this->input->post('body'), // trailing comma for any future need
      ];
      // now that values from the form are stored in the array, use these values to update the table. use insert
      return $this->db->insert('comments', $data);
    }

    // get the comments by post
    public function get_comments($post_id){
      // get the comments from the database by post id
      $query = $this->db->get_where('comments', array('post_id' => $post_id));
      // return the query as an array of comments
      return $query->result_array();
    }
  }
