<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Login_Model');
	}

	public function index()
	{
		$this->load->view('login');
		$this->session->sess_destroy();
	}

	function proses(){
		
		$where = array(
			'username' => $this->input->post('username'), 
			'password' => md5($this->input->post('password'))
		);

		$where2 = array(
			'nisn' => $this->input->post('username'), 
			'nisn' => $this->input->post('password')
		);

		$cek = $this->Login_Model->cek_login('user', $where)->num_rows(); //cheking proses when there an exist id
		$cek2 = $this->Login_Model->cek_login_siswa('siswa', $where2)->num_rows();
		$query = $this->Login_Model->cek_login('user', $where)->row();
		$query2 = $this->Login_Model->cek_login_siswa('siswa', $where2)->row();
		//getting some data from table login

		#proses cheking while data is already exist
		if($cek > 0) // is data avaible ?
		{
			if($query->level == 'admin'){
				$data_session = array(
					'nama' => $query->username,
					'stat' => 'login',
					'ha' => $query->level,
				);
				$this->session->set_userdata($data_session);
				redirect('admin/admin','refresh');
			}
			if ($query->level == 'kepala') {
				$data_session = array(
					'nama' => $query->username,
					'stat' => 'login',
					'ha' => $query->level,
				);
				$this->session->set_userdata($data_session);
				redirect('kepala/kepala','refresh');
			}
	
		}
		elseif ($cek2 > 0) {
			$data_session = array(
				'nama' => $query2->nama,
				'stat' => 'login',
				'nisn' => $query2->nisn,
				'ha'=>'siswa');
			$this->session->set_userdata($data_session);
			redirect('siswa/siswa','refresh');
		}
		else{
		$this->session->set_flashdata('msg', 
            '<div class="alert alert-danger alert-dismissible">
			<h5>Username atau Password Salah!</h5>
			</div>');
		redirect('Utama');
		}
	}

	function logout(){
		$this->session->sess_destroy();
		$data = array( 
			'alert' => $this->session->flashdata('Berhasil Logout')
		);
		redirect('utama','refresh',$data);
	}

}