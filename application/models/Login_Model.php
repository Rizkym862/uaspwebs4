<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {

	function cek_login($table,$where){
		return $this->db->get_where($table, $where);
	}

	function cek_login_siswa($table, $where){
		return $this->db->get_where($table, $where);
	}

}
?> 