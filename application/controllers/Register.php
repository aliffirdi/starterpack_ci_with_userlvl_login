<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	function __construct() {
		parent::__construct();
		$idiom = $this->session->get_userdata('language')['language'];
		$this->lang->load('global_var', $idiom);
	}

	public function index() {
		if (!empty($this->input->post('username'))) {
			$check_email 	= $this->db->get_where('users_biodata', array('bio_email' => $this->input->post('email')))->result_array()[0]['bio_email'];
			$check_username = $this->db->get_where('users', array('users_name' => $this->input->post('username')))->result_array()[0]['users_name'];
			if (!empty($check_email)) {
				$this->session->set_flashdata('warning', "Email Telah Terdaftar!.");
				redirect(base_url('register'));
			} elseif (!empty($check_username)) {
				$this->session->set_flashdata('warning', "Username Telah Terdaftar!.");
				redirect(base_url('register'));
			}

			$pass = $this->website->rand_str();
			$dp_user = array(
				'users_id' 			=> $this->uuid->v6(),
				'users_fullname' 	=> $this->input->post('first_name')." ".$this->input->post('last_name'),
				'users_name' 		=> $this->input->post('username'),
				'users_pass' 		=> password_hash($pass, PASSWORD_BCRYPT),
				'users_access' 		=> "4"
			);
			$dp_user_bio = array(
				'bio_id' 			=> $this->uuid->v6(),
				'bio_username' 		=> $this->input->post('username'),
				'bio_firstname' 	=> $this->input->post('first_name'),
				'bio_lastname' 		=> $this->input->post('last_name'),
				'bio_email' 		=> $this->input->post('email'),
				'bio_gender' 		=> '',
				'bio_country' 		=> $this->input->post('country'),
				'bio_province' 		=> $this->input->post('province'),
				'bio_city' 			=> ''
			);
			$this->db->insert('users',$dp_user);
			$this->db->insert('users_biodata',$dp_user_bio);
			$this->mail_model->send($this->input->post('email'),$this->input->post('first_name'),'Selamat Bergabung Di Sayabisa.id','your password is : '.$pass);
			$this->session->set_flashdata('success', "Check Email to view your password");
			redirect(base_url('auth'));
		}
		$data = array(
			'title' 				=> "Register",
			'short_app_name'		=> $this->lang->line('short_app_name'),
			'app_name'				=> $this->website->option('app_name'),
			'copyright' 			=> $this->lang->line('copyright'),
			'register' 				=> $this->lang->line('register'),
			'register_first_name' 	=> $this->lang->line('register_first_name'),
			'register_last_name' 	=> $this->lang->line('register_last_name'),
			'register_username'		=> $this->lang->line('register_username'),
			'register_email' 		=> $this->lang->line('register_email'),
			'register_y_country'	=> $this->lang->line('register_y_country'),
			'register_country' 		=> $this->lang->line('register_country'),
			'register_prov' 		=> $this->lang->line('register_prov'),
			'register_agree' 		=> $this->lang->line('register_agree'),
			'get_csrf_token_name' 	=> $this->security->get_csrf_token_name(),
			'get_csrf_hash' 		=> $this->security->get_csrf_hash(),
			'login_alert' 			=> $this->lang->line('login_alert'),
			'error' 				=> $this->session->flashdata('error'),
			'warning' 				=> $this->session->flashdata('warning'),
			'info' 					=> $this->session->flashdata('info'),
			'success' 				=> $this->session->flashdata('success'),
			'base_url' 				=> base_url(),
			'tahun' 				=> date('Y')
		);
		$this->parser->parse('dist/auth-register', $data);
	}

	public function reset_session()
	{
		//This is cron to delete user_reset after 10 minute.
		$this->db->query("DELETE FROM `users_reset` WHERE `timestamp` < (NOW() - INTERVAL 10 MINUTE)");
	}
}
