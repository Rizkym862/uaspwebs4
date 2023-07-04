<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alternatif_Model extends CI_Model {

	var $table = 'guru';
	var $table2 = 'hasil_alternatif';

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

	function get_group(){

		$this->db->select('guru.*');
		$this->db->from('guru');
		$this->db->join('hasil_alternatif', '(hasil_alternatif.alternatif1 = guru.nip or hasil_alternatif.alternatif2 = guru.nip)');
		$this->db->group_by('guru.nip');
		return $this->db->get()->result();

	}

	function get_alter_nilai($id, $tahun){

		$query = $this->db->get_where('nilai_awal',array('nip' => $id, 'periode' => $tahun ))->row();
		return $query;
	}

	function get_nilai_alternatif(){

		$this->db->select('guru.nama, nilai_awal.nilai');
		$this->db->from('guru');
		$this->db->join('hasil_alternatif', '(hasil_alternatif.alternatif1 = guru.nip or hasil_alternatif.alternatif2 = guru.nip)');
		$this->db->join('nilai_awal', 'nilai_awal.nip = guru.nip');
		$this->db->group_by('guru.nip');
		$query = $this->db->get()->result();
		return $query;
	}


	function get_id($id) // cek validation for insert / update date if therea a same name in a row
	{
		$query = $this->db->get_where($this->table, 'id ="'.$id.'"')->row();
		return $query;
	}

	function get_nilai($id){
		$this->db->select('nilai_awal.id_nilai_awal, guru.nama, nilai_detail.nilai, kriteria.nama as naker');
		$this->db->from('guru');
		$this->db->join('nilai_awal', 'guru.nip = nilai_awal.nip');
		$this->db->join('nilai_detail', 'nilai_awal.id_nilai_awal = nilai_detail.id_nilai_awal');
		$this->db->join('kriteria', 'kriteria.id_kriteria = nilai_detail.id_kriteria');
		$this->db->where('nilai_awal.id_nilai_awal="'.$id.'"');
		$query = $this->db->get()->result();
		#$query = $this->db->get_where('nilai_awal, nilai_detail', 'nilai_detail.id_nilai_awal = nilai_awal.id')->row();
		return $query;
		#var_dump($id);

	}

	function get_nama($id){
		$this->db->select('nip, nama');
		$this->db->from($this->table);
		$query = $this->db->get()->row();
		return $query;
	}

	function update_nilai_detail($nilai, $id, $id_krit){

		$this->db->set('nilai', $nilai);
		$this->db->where('id_nilai_awal', $id);
		$this->db->where('id_kriteria', $id_krit);
		$query = $this->db->update('nilai_detail');
		return $query;

	}

	function update_nilai($total, $id, $ket){
		$this->db->set('nilai', $total);
		$this->db->set('keterangan', $ket);
		$this->db->where('id_nilai_awal', $id);
		$query = $this->db->update('nilai_awal');
		return $query;
	}

	function search_nik($nip){
		$this->db->like('nip', $nip, 'both');
		$this->db->orde_by('nip', 'asc');
		$this->db->limit(10);
		return $this->db->get($this->table)->result();
	}

	

}

/* End of file Alternatif.php */
/* Location: ./application/models/Alternatif.php */