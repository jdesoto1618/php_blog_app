<?php
  class Post_model extends CI_Model{
    public function __construct(){
      // load the database
      $this->load->database();
    }

    // get the user posts from the databse. set slug to false by default. parameters passed in must be present in all corresponsing methods between models and controllers. they dont have to share the same name, but the number of parameters passed in must match, or else the app could throw errors
    public function get_posts($slug = FALSE, $limit = false, $offset = false){
      // check if limit value is defined for pagination
      if($limit){
        // put limit and offset values together, if they exist for pagination. this adds the limit and offset values to the query
        $this->db->limit($limit, $offset);
      }
      // check if the slug exists. if not (slug value will become false), return all posts. nothing is passed in if the default slug is posts, so that could mean the user may want to see all posts, or a misclick could simply show all posts
      if($slug ===  false){
        // order the posts by newest first. this will result in the newest post being on top of all others
        // since we ended up doing a join, the id listed here is now ambiguous. there are id's in both tables and the sql won't know which one to refer to. specify which id, in thsi case from the posts table, since this is from where we fetch all posts
        $this->db->order_by('posts.id', 'DESC');
        // join the posts and categories table, so information can be called from both
        // the join syntax is the other table being joined to posts, in this case categories table. then the fields being joined. thye have to exist in both. join the PK from categories table as (=) the FK of category_id from the posts table
        $this->db->join('categories', 'categories.id = posts.category_id');
        // show all posts from the database
        $query = $this->db->get('posts');
        return $query->result_array();
      }

      // if there is a slug passed in, or if the user clicks the button to see an individual post
      $query = $this->db->get_where('posts', array('slug' => $slug));
      return $query->row_array();
    }

    public function get_posts_by_category($category_id){
      // get posts by category id. requires table join of categories
      $this->db->order_by('posts.id','DESC');
      $this->db->join('categories', 'categories.id = posts.category_id');
      // show posts from a specific category
      $query = $this->db->get_where('posts', array('category_id' => $category_id));
      return $query->result_array();
    }

    public function get_categories(){
      // get the category from the database
      $this->db->order_by('name');
      // fetch from the categories table
      $query = $this->db->get('categories');
      return $query->result_array();
    }

    public function create_post($post_image){
      // get the post title, use this as the slug for the web address on a new blog post
      $slug = url_title($this->input->post('title'));
      // create the array to hold the post information for creating a post
      // when adding more information to the create post form, the matching field values must be part of this data array, so whatever the user enters gets placed into the posts table. when the category_id was added as a FK to the posts table, it had to be added to this array so that when users pick a category for a post, it updates the posts table
      // left trailing comma in the data array
      $data =
      [
        'title'       => $this->input->post('title'),
        'slug'        => $slug,
        'fk_user_id'  => $this->session->userdata('user_id'), // field in database is fk_user_id
        'body'        => $this->input->post('body'),
        'category_id' => $this->input->post('category_id'),
        'post_image'  => $post_image,
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
        'title'       => $this->input->post('title'),
        'slug'        => $slug,
        'body'        => $this->input->post('body'),
        'category_id' => $this->input->post('category_id'),
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
