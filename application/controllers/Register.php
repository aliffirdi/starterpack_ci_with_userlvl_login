<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index() {
		$data = array(
			'title' 			=> "Register",
			'short_app_name'	=> $this->lang->line('short_app_name'),
			'app_name'			=> $this->website->option('app_name'),
			'copyright' 		=> $this->lang->line('copyright'),
			'base_url' 			=> base_url(),
			'tahun' 			=> date('Y')
		);
		$this->parser->parse('dist/auth-register', $data);
	}
}
