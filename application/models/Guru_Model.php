<?php defined('BASEPATH') OR exit('No direct script access');

class Guru_Model extends CI_Model
{
	private $_table = "guru";
	public $nip;
	public $nama;
	public $alamat;
	public $jk;
 
	public function rules()
	{
		return [
			['field' => 'nip', 
			'label' => 'NIP',
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

	public function getByNip($nip)
	{
		return $this->db->get_where($this->_table,["nip" => $nip])->row();
	}

	public function insert()
	{
		$post = $this->input->post();
		$this->nip = $post["nip"];
		$this->nama = $post["nama"];
		$this->alamat = $post["alamat"];
		$this->jk = $post["jk"];
        $cek_query = $this->db->query("SELECT * FROM guru WHERE nip = '$this->nip'");
        $cek = $cek_query->num_rows();
        if($cek > 0)
        {
        	$this->session->set_flashdata('danger', 'Nomor NIP Sudah digunakan sebelumnya');
            redirect(site_url('admin/guru/tambah'));
        }
        else{
			$this->db->insert($this->_table, $this);
		}
	}

	public function update()
	{
		$post = $this->input->post();
		$this->nip = $post["nip"];
		$this->nama = $post["nama"];
		$this->alamat = $post["alamat"];
		$this->jk = $post["jk"];
		$this->db->where('nip', $post['nip']);
		$this->db->update($this->_table, $this);
	}

	public function delete($nip)
	{
		return $this->db->delete($this->_table, array("nip" => $nip));
	}
}