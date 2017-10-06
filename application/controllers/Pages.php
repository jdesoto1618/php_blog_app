<?php
	class Pages extends CI_Controller{
    // $page is passed a default value when none is given, such as in the address bar. the program will try to then send the user to a page called home if they dont type anything in except /php_blog/
		public function view($page = 'home'){
			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}
			$data['title'] = ucfirst($page);
			// these lines will load the header and footer on each page in views/pages... make sure to set these pages up in the views. This is done so the same header and footer are shown on any page created inside views/pages
			$this->load->view('templates/header');
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer');
		}
	}
