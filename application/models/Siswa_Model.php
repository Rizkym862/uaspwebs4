<?php defined('BASEPATH') OR exit('No direct script access');

class Siswa_Model extends CI_Model
{
	private $_table = "siswa";
	public $nisn;
	public $nama;
	public $jk;

	public function rules()
	{
		return [
			['field' => 'nisn',
			'label' => 'NISN',
			'rules' => 'required'],

			['field' => 'nama',
			'label' => 'Nama',
			'rules' => 'required'],

			['field' => 'jk',
			'label' => 'Jenis Kelamin',
			'rules' => 'required']

		];				
	}

	public function getAll()
	{
		return $this->db->get($this->_table)->result();
	}

	public function getByNisn($nisn)
	{
		return $this->db->get_where($this->_table,["nisn" => $nisn])->row();
	}

	public function insert()
	{
		$post = $this->input->post();
		$this->nisn = $post["nisn"];;
		$this->nama = $post["nama"];
		$this->jk = $post["jk"];
		$cek_query = $this->db->query("SELECT * FROM siswa WHERE nisn = '$this->nisn'");
        $cek = $cek_query->num_rows();
        if($cek > 0)
        {
        	$this->session->set_flashdata('danger', 'Nomor NIS Sudah digunakan sebelumnya');
            redirect(site_url('admin/siswa/tambah'));
        }
        else{
			$this->db->insert($this->_table, $this);
		}
	}

	public function update()
	{
		$post = $this->input->post();
		$this->nisn = $post["nisn"];
		$this->nama = $post["nama"];
		$this->jk = $post["jk"];
		$this->db->where('nisn', $post['nisn']);
		$this->db->update($this->_table, $this);
	}

	public function delete($nisn)
	{
		return $this->db->delete($this->_table, array("nisn" => $nisn));
	}
}