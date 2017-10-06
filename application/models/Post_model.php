<?php
  class Post_model extends CI_Model{
    public function __construct(){
      // load the database
      $this->load->database();
    }

    // get the user posts from the databse. set slug to false by default
    public function get_posts($slug = FALSE){
      // check if the slug exists. if not, return all posts. nothing is passed in if the default slug is posts, so that could mean the user may want to see all posts, or a misclick could simply show all posts
      if($slug ===  FALSE){
        $query = $this->db->get('posts');
        return $query->result_array();
      }

      // if there is a slug passed in...
      $query = $this->db->get_where('posts', array('slug' => $slug));
      return $query->row_array();
    }
  }
