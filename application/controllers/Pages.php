<?php
	class Pages extends CI_Controller{
    // $page is passed a default value when none is given, such as in the address bar. the program will try to then send the user to a page called home if they dont type anything in except /php_blog/
		public function view($page = 'home'){
			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}
			$data['title'] = ucfirst($page);
			$this->load->view('templates/header');
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer');
		}
	}
