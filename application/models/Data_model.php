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
class data_model extends CI_Model{
	function get($data)
	{
		return $this->db->get($data);
	}
	function ketika($db,$data)
	{
		return $this->db->get_where($db,$data);
	}
	function update($db,$data,$syarat)
	{
		return $this->db->update($db, $data, $syarat);
	}
	function delete($db,$data)
	{
		return $this->db->delete($db, $data);
	}
}