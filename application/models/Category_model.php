<?php
  class Category_model extends CI_Model{
    public function __construct(){
      // load the database when this model is invoked
      $this->load->database();
    }

    public function create_category(){
      // get the data and store it as an array to send the category name to the database
      $data =
      [
        'name' => $this->input->post('name'), // trailing comma here for future values to be inserted
      ];
      // return the values of the data array to the database using insert. insert syntax is insert('table_name', values)
      // since there's already a categories table, just insert the value from the create category form into the database
      return $this->db->insert('categories', $data);
    }

    // get the categories from the database
    public function get_categories(){
      // get the category from the database
      $this->db->order_by('name');
      // fetch from categories table
      $query = $this->db->get('categories');
      return $query->result_array();
    }

    // get the category title by post id
    public function get_category($id){
      // get the categories from the database
      $query = $this->db->get_where('categories', array('id' => $id));
      return $query->row();
    }
  }
