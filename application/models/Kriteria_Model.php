<?php defined('BASEPATH') OR exit('No direct script access');

class Kriteria_Model extends CI_Model
{
	private $_table = "kriteria";
	public $id_kriteria;
	public $nama;
	public $ket;

	public function rules()
	{
		return [
			['field' => 'nama',
			'label' => 'Nama',
			'rules' => 'required'],

			['field' => 'ket',
			'label' => 'Keterangan',
			'rules' => 'required']

		];				
	}

	public function getAll()
	{
		return $this->db->get($this->_table)->result();
	}

	public function getById($id_kriteria)
	{
		return $this->db->get_where($this->_table,["id_kriteria" => $id_kriteria])->row();
	}

	public function insert()
	{
		$post = $this->input->post(); 
		$this->nama = $post["nama"];
		$this->ket = $post["ket"];
		$this->db->set('nama',$this->nama);
		$this->db->set('ket',$this->ket);
		$this->db->insert($this->_table);
	}

	public function update()
	{
		$post = $this->input->post();
		$this->nama = $post["nama"];
		$this->ket = $post["ket"];
		$this->db->set('nama',$this->nama);
		$this->db->set('ket',$this->ket);
		$this->db->where('id_kriteria', $post["id_kriteria"]);
		$this->db->update($this->_table);
	}

	public function delete($id_kriteria)
	{
		return $this->db->delete($this->_table, array("id_kriteria" => $id_kriteria));
	}

	function get_nama($nama){ //cek validation

		$query = $this->db->get_where($this->table, 'nama = "'.$nama.'"')->row();
		#$query = $this->db->get();
		return $query;

	}

	function get_kriteria(){
		return $this->db->get($this->table)->result();
	}
}