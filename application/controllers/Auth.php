<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('auth_model');
		if (empty($this->session->get_userdata('language')['language'])) {
			$this->session->set_userdata('language', 'japan');
			$this->session->set_flashdata('select_language', 'select_language');
		}
		$idiom = $this->session->get_userdata('language')['language'];
		//$this->session->unset_userdata('language');
		$this->lang->load('global_var', $idiom);
	}

	public function index() {
		if (!empty($this->input->post('username')) && !empty($this->input->post('password'))) {

			$username = $this->input->post('username');
			$pass = $this->input->post('password');

			$data = array(
				'users_name' => $username,
			);

			$data_post = $this->auth_model->login($data)->row_object();

			if ($data_post != null) {
				//$verification 	= $this->auth_model->login($data)->row_object()->verification;
				$data_post = array(
					'id' => $data_post->users_id,
					'fullname' => $data_post->users_fullname,
					'username' => $data_post->users_name,
					'user_lvl' => $data_post->users_access,
					'user_pass' => $data_post->users_pass,
					'time_login' => date('YmdHis'),
				);
			}

			if (password_verify($pass, $data_post['user_pass'])) {
				$this->session->set_userdata('login', $data_post);
				redirect(base_url('dashboard'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('login_pass_wrong_msg'));
				redirect(base_url('auth'));
			}
		} else {
			$this->login();
		}
	}

	public function login() {
		$data = array(
			'title' => "Login",
			'copyright' 			=> $this->lang->line('copyright') . " " . $this->website->option('app_name'),
			'app_name' 				=> $this->website->option('app_name'),
			'login' 				=> $this->lang->line('login'),
			'login_alert'			=> $this->lang->line('login_alert'),
			'login_username' 		=> $this->lang->line('login_username'),
			'login_fill_email' 		=> $this->lang->line('login_fill_email'),
			'login_pass' 			=> $this->lang->line('login_pass'),
			'login_forgot_pass' 	=> $this->lang->line('login_forgot_pass'),
			'login_fill_pass' 		=> $this->lang->line('login_fill_pass'),
			'login_remember_me' 	=> $this->lang->line('login_remember_me'),
			'login_login_by' 		=> $this->lang->line('login_login_by'),
			'login_punya_akun' 		=> $this->lang->line('login_punya_akun'),
			'login_buat_akun' 		=> $this->lang->line('login_buat_akun'),
			'login_fill_pass' 		=> $this->lang->line('login_fill_pass'),
			'warning' 				=> $this->session->flashdata('warning'),
			'info' 					=> $this->session->flashdata('info'),
			'error' 				=> $this->session->flashdata('error'),
			'success' 				=> $this->session->flashdata('success'),
			'get_csrf_token_name' 	=> $this->security->get_csrf_token_name(),
			'get_csrf_hash' 		=> $this->security->get_csrf_hash(),
			'base_url' 				=> base_url(),
			'tahun' 				=> date('Y'),
		);
		$this->parser->parse('dist/auth-login', $data);
	}

	public function forgot_password() {
		if (!empty($this->input->post('email'))) {
			$us_name = $this->db->get_where('users_biodata', array('bio_email' => $this->input->post('email')))->result_array()[0]['bio_username'];
			if (!empty($us_name)) {
				$reset_ref = $this->website->rand_str(25);
				$dp_user = array(
					'reset_id' 			=> $this->uuid->v6(),
					'reset_name' 		=> $us_name,
					'reset_ref' 		=> $reset_ref
				);
				$this->db->insert('users_reset',$dp_user);
				$this->mail_model->send($this->input->post('email'),$this->db->get_where('users_biodata', array('bio_email' => $this->input->post('email')))->result_array()[0]['bio_firstname'],'Sayabisa.id Reset Account','Silahkan Akses Link Disamping Untuk Mereset Sandi : '.base_url("auth/reset_password/").$reset_ref);
				$this->session->set_flashdata('success', "Check Email To Reset Your Password");
			} else {
				$this->session->set_flashdata('error', "Email Tidak Terkait Dengan User Manapun!.");
				redirect(base_url('auth/forgot_password'));
			}
		}
		$data = array(
			'title' 				=> "Forgot Password",
			'copyright' 			=> $this->lang->line('copyright') . " " . $this->website->option('app_name'),
			'app_name' 				=> $this->website->option('app_name'),
			'error' 				=> $this->session->flashdata('error'),
			'get_csrf_token_name' 	=> $this->security->get_csrf_token_name(),
			'get_csrf_hash' 		=> $this->security->get_csrf_hash(),
			'login_alert' 			=> $this->lang->line('login_alert'),
			'error' 				=> $this->session->flashdata('error'),
			'warning' 				=> $this->session->flashdata('warning'),
			'info' 					=> $this->session->flashdata('info'),
			'success' 				=> $this->session->flashdata('success'),
			'base_url' => base_url(),
			'tahun' => date('Y'),
		);
		$this->parser->parse('dist/auth-forgot-password', $data);
	}

	public function reset_password($id=null) {
		$us_name = $this->db->get_where('users_reset', array('reset_ref' => $id))->result_array()[0]['reset_name'];
		if (!empty($this->input->post('password'))) {
			if ($this->input->post('password') != $this->input->post('re_password')) {
				$this->session->set_flashdata('error', "Password Tidak Sama, Silahkan Periksa!.");
				redirect(base_url("auth/reset_password/$id"));
			} else {
				$dp_user = array(
					'users_pass' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
				);
				$this->db->delete('users_reset', array('reset_ref' => $id ));
				$this->data_model->update("users",$dp_user, array('users_name' => $us_name ));
				$this->session->set_flashdata('success', "Password Berhasil Diganti, Silahkan Login!.");
				redirect(base_url('auth'));
			}
		}
		if (empty($us_name)) {
			$this->session->set_flashdata('warning', "Reset Token Expired or Not Found!.");
			redirect(base_url('auth'));
		} else {
			$data = array(
				'title' 				=> "Reset Password",
				'copyright' 			=> $this->lang->line('copyright') . " " . $this->website->option('app_name'),
				'app_name' 				=> $this->website->option('app_name'),
				'login_alert' 			=> $this->lang->line('login_alert'),
				'warning' 				=> $this->session->flashdata('warning'),
				'info' 					=> $this->session->flashdata('info'),
				'error' 				=> $this->session->flashdata('error'),
				'success' 				=> $this->session->flashdata('success'),
				'get_csrf_token_name' 	=> $this->security->get_csrf_token_name(),
				'get_csrf_hash' 		=> $this->security->get_csrf_hash(),
				'base_url' 				=> base_url(),
				'tahun' 				=> date('Y')
			);
			$this->parser->parse('dist/auth-reset-password', $data);
		}
	}

	public function logout() {
		$this->session->unset_userdata('login');
		$this->session->set_flashdata('info', $this->lang->line('login_after_logout'));
		redirect(base_url('auth'));
	}
}
