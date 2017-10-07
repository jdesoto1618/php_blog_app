<?php
  class Post_model extends CI_Model{
    public function __construct(){
      // load the database
      $this->load->database();
    }

    // get the user posts from the databse. set slug to false by default
    public function get_posts($slug = FALSE){
      // check if the slug exists. if not (slug value will become false), return all posts. nothing is passed in if the default slug is posts, so that could mean the user may want to see all posts, or a misclick could simply show all posts
      if($slug ===  false){
        // order the posts by newest first. this will result in the newest post being on top of all others
        $this->db->order_by('id', 'DESC');
        // show all posts from the database
        $query = $this->db->get('posts');
        return $query->result_array();
      }

      // if there is a slug passed in, or if the user clicks the button to see an individual post
      $query = $this->db->get_where('posts', array('slug' => $slug));
      return $query->row_array();
    }

    public function create_post(){
      // get the post title, use this as the slug for the web address on a new blog post
      $slug = url_title($this->input->post('title'));
      // create the array to hold the post information for creating a post
      $data =
      [
        'title'   => $this->input->post('title'),
        'slug'    => $slug,
        'body'    => $this->input->post('body')
      ];
      // insert data into database from data array. insert syntax: table_name, any_data
      return $this->db->insert('posts', $data);
    }

    public function update_post(){
      // get the post title, use this as the slug for the web address on an edited blog post
      $slug = url_title($this->input->post('title'));
      // create the array to hold the post information for updating(editing) a post
      $data =
      [
        'title'   => $this->input->post('title'),
        'slug'    => $slug,
        'body'    => $this->input->post('body')
      ];
      // find the matching post id from the database
      $this->db->where('id', $this->input->post('id'));
      // update/insert data into database from data array. update syntax: table_name, any_data
      return $this->db->update('posts', $data);
    }

    public function delete_post($id){
      // find the matching post id from the database
      $this->db->where('id', $id);
      // delete takes in table name. delete the matching post from this database
      $this->db->delete('posts');
      return true;
    }
  }
