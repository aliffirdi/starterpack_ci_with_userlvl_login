<?php
/**
|--------------------------------------------------------------------------|
| Copyright Notice                                                         |
|--------------------------------------------------------------------------|
| TOLONG UNTUK TIDAK MENGUBAH-UBAH SCRIPT DALAM HALAMAN INI TANPA          |
| SEIZIN DARI PEMILIK SOURCE CODE. HARAGAILAH SETIAP PEKERJAAN YANG        |
| TELAH DILAKUKAN OLEH PEMBUAT APLIKASI INI. JIKA ANDA INGIN MENGUBAH      |
| SEBAGIAN ATAU SELURUH KODE YANG ADA DALAM SCRIPT DIBAWAH INI TOLONG      |
| HUBUNGI E-MAIL AUTHOR!!!.                                                |
|--------------------------------------------------------------------------|
 */
/**
 * @package sms
 * @author alif firdi <aliffirdi07@gmail.com>
 * @copyright 2020
 * @link https://aliffirdi.me
 * @since 1.0.0 beta
 */
class website extends CI_Model
{

    public function option($data=null)
    {
		$basisdata = $this->db->get_where('site_options',array('option_name' => $data));
		foreach ($basisdata->result() as $row) {
			$result_rtn = $row->option_value;
		}
		if (!isset($result_rtn)) {
			$result_rtn = "<font color=\"red\"><b><{{Option tidak ditemukan}}></b></font>";
		}
		return $result_rtn;
    }

    public function title($data=null)
    {
		$basisdata = $this->db->get_where('site_feature',array('feature_name' => $data));
		foreach ($basisdata->result() as $row) {
			$result_rtn = $row->feature_display_name;
		}
		if (!isset($result_rtn)) {
			$result_rtn = null;
		}
		return $result_rtn;
    }

    public function privilege($data=null)
    {
		$basisdata = $this->db->get_where('users_lvl_access',array('users_access' => $data));
		foreach ($basisdata->result() as $row) {
			$result_rtn = $row->lvl_desc;
		}
		if (!isset($result_rtn)) {
			$result_rtn = null;
		}
		return $result_rtn;
    }

	public function access($url=null,$url2=null)
	{
		$json_data 	= $this->privilege($this->db->get_where('users',array('users_name' =>$this->session->userdata('login')['username']))->result_array()[0]['users_access']);
		$json_data 	= json_decode($json_data);
		$access 	= false;
		foreach ($json_data as $key => $value) {
		  if ($url2 == null) {
		    if ($url == $value) {
		     $access = true;
		    }
		  } elseif ($url2 == $value) {
		    $access = true;
		  }
		}
		return $access;
    }

	public function access_link($url=null)
	{
		$json_data 	= $this->privilege($this->db->get_where('users',array('users_name' =>$this->session->userdata('login')['username']))->result_array()[0]['users_access']);
		$json_data 	= json_decode($json_data);
		$access 	= false;
		foreach ($json_data as $key => $value) {
		    if ($url == $value) {
		     $access = true;
		    }
		}
		return $access;
    }

	public function rand_str($length=8)
	{
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
    }
}
