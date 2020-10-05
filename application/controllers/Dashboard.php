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
				'users_pass' 		=> $this->input->post('password'),
				'users_access' 		=> $this->input->post('add_users_lvl_access')
			);
			$this->db->insert('users', $data);
			$this->session->set_flashdata('success', "Sukses Menambahkan Data");
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

			$this->db->insert('users_lvl_access', $data);
			$this->session->set_flashdata('success', "Sukses Menambahkan Data");
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

	public function settings() {
		if (!empty($this->input->post('app_name'))) {
			$basisdata = $this->data_model->get('site_options');
			$i = 1;
			foreach ($basisdata->result() as $row) {
				if (!empty($this->input->post($row->option_name))) {
					$this->data_model->update('site_options',array('option_value' => $this->input->post($row->option_name)),array('option_id' => $i ));
				}
				$i++;
			}
		}

		$basisdata = $this->data_model->get('site_options');
		foreach ($basisdata->result() as $row) {$data[$row->option_name] = $row->option_value;}
		$data['title'] = $this->website->title("settings");
		$data['get_csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['get_csrf_hash'] = $this->security->get_csrf_hash();
		$data['copyright'] = $this->lang->line('copyright');
		$data['base_url'] = base_url();
		$data['tahun'] = date('Y');
		//Kint::dump($data);
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
}
