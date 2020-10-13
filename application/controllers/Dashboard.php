<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct(){
			parent::__construct();
			//load
		}

	public function index() {
		redirect(base_url('dashboard/home'),'refresh');
	}

	public function home() {
		$data = array(
			'title' 			=> $this->website->title("home"),
			'short_app_name'	=> $this->website->option('short_app_name'),
			'app_name'			=> $this->website->option('app_name'),
			'copyright' 		=> $this->lang->line('copyright'),
			'base_url' 			=> base_url(),
			'tahun' 			=> date('Y')
		);
		$this->parser->parse('dist/dashboard-index', $data);
	}

	public function blank() {
		$data = array(
			'title' 			=> $this->website->title("blank"),
			'short_app_name'	=> $this->website->option('short_app_name'),
			'app_name'			=> $this->website->option('app_name'),
			'copyright' 		=> $this->lang->line('copyright'),
			'base_url' 			=> base_url(),
			'tahun' 			=> date('Y')
		);
		$this->parser->parse('dist/dashboard-blank', $data);
	}

	public function userprivilege($action=null) {

		//check user id
		if (!empty($this->input->post('id_user'))) {$id_user = $this->input->post('id_user');} else {$id_user=null;}
		if ($action == 'edit_user' && $id_user == null) {redirect(base_url('dashboard/userprivilege'),'refresh');}
		if ($action == 'edit_access' && empty($this->input->post('access_id'))) {redirect(base_url('dashboard/userprivilege'),'refresh');}

		//add new user
		if (!empty($this->input->post('add_users_lvl_access'))) {
			$data = array(
				'users_id' 			=> $this->uuid->v6(),
				'users_fullname' 	=> $this->input->post('user_fullname'),
				'users_name' 		=> $this->input->post('username'),
				'users_pass' 		=> password_hash($this->input->post('password'), PASSWORD_BCRYPT),
				'users_access' 		=> $this->input->post('add_users_lvl_access')
			);
			if (!$this->data_model->insert('users', $data)) {
				$sess_notif = array ('error' => "Username Sudah Ada!");
			} else {
				$sess_notif = array ('success' => "Sukses Menambahkan Data");
			}
			$this->session->set_flashdata($sess_notif);
			redirect(base_url("dashboard/userprivilege"),'refresh');
		}

		//add new access
		if (!empty($this->input->post('add_new_access_lvl_name'))) {
			$i = 0;
			foreach ($this->db->get('site_feature')->result() as $key) {
				if (!empty($this->input->post($key->feature_name))) {
					$field_data_post[$i] = $this->input->post($key->feature_name);
					$i++;
				}
			}

			$data['lvl_id']			= $this->uuid->v6();
			$data['lvl_desc']		= json_encode($field_data_post);
			$data['lvl_name']		= $this->input->post('add_new_access_lvl_name');

			if (!$this->data_model->insert('users_lvl_access', $data)) {
				$sess_notif = array ('error' => "Hak Akses Sudah Ada!");
			} else {
				$sess_notif = array ('success' => "Sukses Menambahkan Data");
			}
			$this->session->set_flashdata($sess_notif);
			redirect(base_url("dashboard/userprivilege"),'refresh');
		}

		//update user level
		if (!empty($this->input->post('users_lvl_access'))) {
			$this->data_model->update('users',array('users_access' => $this->input->post("users_lvl_access")),array('users_id' => $this->input->post("user_id")));
			$this->session->set_flashdata('success', "Sukses Memperbarui Data");
			redirect(base_url("dashboard/userprivilege"),'refresh');
		}
		//update access level
		if (!empty($this->input->post('access_id_update'))) {
			$i = 0;
			foreach ($this->db->get('site_feature')->result() as $key) {
				if (!empty($this->input->post($key->feature_name))) {
					$field_data_post[$i] = $this->input->post($key->feature_name);
					$i++;
				}
			}
			$this->data_model->update('users_lvl_access',array('lvl_desc' => json_encode($field_data_post)),array('lvl_id' => $this->input->post("access_id_update")));
			$this->session->set_flashdata('success', "Sukses Memperbarui Data");
			redirect(base_url("dashboard/userprivilege"),'refresh');
		}

		//data page
		$data = array(
			'get_csrf_token_name'	=> $this->security->get_csrf_token_name(),
			'get_csrf_hash' 		=> $this->security->get_csrf_hash(),
			'title' 				=> $this->website->title("userprivilege"),
			'short_app_name'		=> $this->website->option('short_app_name'),
			'app_name'				=> $this->website->option('app_name'),
			'copyright' 			=> $this->lang->line('copyright'),
			'base_url' 				=> base_url(),
			'basisdata' 			=> $this->db->join('users_lvl_access',"users.users_access=users_lvl_access.users_access")->get_where('users',array('users_id' => $id_user))->result_array(),
			'basisdata_access'		=> $this->db->get_where('users_lvl_access',array('lvl_id' => $this->input->post('access_id')))->result_array(),
			'tahun' 				=> date('Y')
		);

		switch ($action) {
			case 'edit_user':
				$this->parser->parse('dist/dashboard-userprivilege-user-edit', $data);
				break;

			case 'edit_access':
				$this->parser->parse('dist/dashboard-userprivilege-access-edit', $data);
				break;
			
			default:
				$this->parser->parse('dist/dashboard-userprivilege', $data);
				break;
		}
	}

	public function pagesetup($action=null) {

		if ($action == null) {
			$data['title'] 					= $this->website->title("settings");
			$data['app_name']				= $this->website->option('app_name');
			$data['get_csrf_token_name'] 	= $this->security->get_csrf_token_name();
			$data['get_csrf_hash'] 			= $this->security->get_csrf_hash();
			$data['copyright'] 				= $this->lang->line('copyright');
			$data['base_url'] 				= base_url();
			$data['tahun'] 					= date('Y');

			$this->parser->parse('dist/dashboard-app-settings', $data);

		} elseif ($action == "general_settings") {
			if (!empty($this->input->post('app_name'))) {
				$basisdata = $this->data_model->get('site_options');
				foreach ($basisdata->result() as $row) {
					if (!empty($this->input->post($row->option_name))) {
						$this->data_model->update('site_options',array('option_value' => $this->input->post($row->option_name)),array('option_name' => $row->option_name ));
					}
				}
				$this->session->set_flashdata('success', "Sukses Memperbarui Data");
				redirect(base_url("dashboard/pagesetup/".$this->uri->segment(3)),'refresh');
			}
	
			$basisdata = $this->data_model->ketika('site_options', array("option_url" => $this->uri->segment(3)));
			foreach ($basisdata->result() as $row) {$data[$row->option_name] = $row->option_value;}
			$data['title'] 					= $this->website->title("pagesetup");
			$data['app_name']				= $this->website->option('app_name');
			$data['get_csrf_token_name'] 	= $this->security->get_csrf_token_name();
			$data['get_csrf_hash'] 			= $this->security->get_csrf_hash();
			$data['copyright'] 				= $this->lang->line('copyright');
			$data['base_url']		 		= base_url();
			$data['tahun'] 					= date('Y');
	
			$this->parser->parse('dist/dashboard-app-settings-general', $data);

		} elseif ($action == "email") {
			if (!empty($this->input->post('app_name'))) {
				$basisdata = $this->data_model->get('site_options');
				foreach ($basisdata->result() as $row) {
					if (!empty($this->input->post($row->option_name))) {
						$this->data_model->update('site_options',array('option_value' => $this->input->post($row->option_name)),array('option_name' => $row->option_name ));
					}
				}
				$this->session->set_flashdata('success', "Sukses Memperbarui Data");
				redirect(base_url("dashboard/pagesetup/".$this->uri->segment(3)),'refresh');
			}
	
			$basisdata = $this->data_model->ketika('site_options', array("option_url" => $this->uri->segment(3)));
			foreach ($basisdata->result() as $row) {$data[$row->option_name] = $row->option_value;}
			$data['title'] 					= $this->website->title("pagesetup");
			$data['app_name']				= $this->website->option('app_name');
			$data['get_csrf_token_name'] 	= $this->security->get_csrf_token_name();
			$data['get_csrf_hash'] 			= $this->security->get_csrf_hash();
			$data['copyright'] 				= $this->lang->line('copyright');
			$data['base_url'] 				= base_url();
			$data['tahun'] 					= date('Y');
	
			$this->parser->parse('dist/dashboard-settings', $data);
		}

	}

	public function settings() {
		if (!empty($this->input->post('username'))) {
			//cek username session untuk mencocokan data
			$check_username_sess = $this->session->userdata('login')['username'];
			//cek username data dari db
			if (isset($this->db->get_where('users', array('users_name' => $this->input->post('username')))->result_array()[0]['users_name'])) {
				$check_username = $this->db->get_where('users', array('users_name' => $this->input->post('username')))->result_array()[0]['users_name'];
			} else {
				$check_username = null;
			}
			//cek apakah username sudah terpakai oleh orang lain
			if (!empty($check_username)) {
				$user_name_update = $this->db->get_where('users', array('users_name' => $this->session->userdata('login')['username'] ))->result_array()[0]["users_name"];
			} else {
				$user_name_update = $this->input->post('username');
			}
			//data yang akan dientry ke db
			$dp_user_bio = array(
				'bio_username' 	=> $user_name_update,
				'bio_firstname' => $this->input->post('firstname'),
				'bio_lastname' 	=> $this->input->post('lastname'),
				'bio_country' 	=> $this->input->post('country'),
				'bio_province' 	=> $this->input->post('province'),
				'bio_city' 		=> $this->input->post('city')
				);
			$dp_user['users_name'] = $user_name_update;
			$dp_user['users_fullname'] = $this->input->post('firstname')." ".$this->input->post('lastname');
			if (!empty($this->input->post('password'))) {$dp_user['users_pass'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);}
			$data_session = array(
					'id' 			=> $this->db->get_where('users', array('users_name' => $this->session->userdata('login')['username'] ))->result_array()[0]["users_id"],
					'fullname' 		=> $this->input->post('firstname')." ".$this->input->post('lastname'),
					'username' 		=> $user_name_update,
					'user_lvl' 		=> $this->db->get_where('users', array('users_name' => $this->session->userdata('login')['username'] ))->result_array()[0]["users_access"],
					'user_pass' 	=> $this->db->get_where('users', array('users_name' => $this->session->userdata('login')['username'] ))->result_array()[0]["users_pass"],
					'time_login' 	=> date('YmdHis'),
					);
			//kirim data ke db
			$this->db->update('users_biodata', $dp_user_bio, array('bio_id' => $this->db->join('users_biodata',"users_biodata.bio_username=users.users_name")->get_where('users', array('users_name' => $this->session->userdata('login')['username'] ))->result_array()[0]["bio_id"] ));
			$this->db->update('users', $dp_user, array('users_id' => $this->session->userdata('login')['id'] ));
			//update session
			$this->session->set_userdata('login', $data_session);

			//notifikasi
			if (!empty($check_username)) {
				if ($check_username != $check_username_sess) {
					$this->session->set_flashdata('warning', "Username Sudah Terpakai oleh user lain!.");
					redirect(base_url("dashboard/settings"),'refresh');
				} else {
					$this->session->set_flashdata('success', "Sukses Memperbarui Data");
					redirect(base_url("dashboard/settings"),'refresh');
				}
			} else {
				$this->session->set_flashdata('success', "Sukses Memperbarui Data");
				redirect(base_url("dashboard/settings"),'refresh');
			}
		}
		$data['title'] 					= $this->website->title("settings");
		$data['app_name']				= $this->website->option('app_name');
		$data['get_csrf_token_name'] 	= $this->security->get_csrf_token_name();
		$data['get_csrf_hash'] 			= $this->security->get_csrf_hash();
		$data['copyright'] 				= $this->lang->line('copyright');
		$data['base_url']		 		= base_url();
		$data['tahun'] 					= date('Y');

		$this->parser->parse('dist/dashboard-settings', $data);
	}

	public function credits() {
		$data = array(
			'title' 			=> $this->website->title("credits"),
			'short_app_name'	=> $this->website->option('short_app_name'),
			'app_name'			=> $this->website->option('app_name'),
			'copyright' 		=> $this->lang->line('copyright'),
			'base_url' 			=> base_url(),
			'tahun' 			=> date('Y')
		);
		$this->parser->parse('dist/dashboard-credits', $data);
	}

	public function test() {
		Kint::dump($this->mail_model->send('halo@aliffirdi.me','Alif Firdi','Tes Notifikasi Subject','ini adalah email percobaan'));
	}
}
