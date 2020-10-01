<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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

	public function userprivilege() {
		$data = array(
			'title' 			=> $this->website->title("userprivilege"),
			'short_app_name'	=> $this->website->option('short_app_name'),
			'app_name'			=> $this->website->option('app_name'),
			'copyright' 		=> $this->lang->line('copyright'),
			'base_url' 			=> base_url(),
			'tahun' 			=> date('Y')
		);
		$this->parser->parse('dist/dashboard-userprivilege', $data);
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
