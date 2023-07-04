<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(empty($this->session->userdata('stat'))){
            redirect('utama','refresh');
        }
        else{
            $this->load->model("Siswa_Model");
            $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $data["siswa"] = $this->Siswa_Model->getAll();
        $this->load->view("admin/siswa/tampil", $data);
    }

    public function tambah()
    {
        $siswa = $this->Siswa_Model;
        $validation = $this->form_validation->set_message('required','Wajib diisi');
        $validation->set_rules($siswa->rules());

        if ($validation->run()) {
            $siswa->insert();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect("admin/siswa");
        }

        $this->load->view("admin/siswa/tambah");
    }

    public function ubah($nisn = null)
    {
        if (!isset($nisn)) redirect('admin/siswa');
       
        $siswa = $this->Siswa_Model;
        $validation =  $this->form_validation->set_message('required','Wajib diisi');
        $validation->set_rules($siswa->rules());

        if ($validation->run()) {
            $siswa->update();
            $this->session->set_flashdata('success', 'Berhasil diubah');
            redirect("admin/siswa");
        }
        $data["siswa"] = $siswa->getByNisn($nisn);
        if (!$data["siswa"]) show_404();
        
        $this->load->view("admin/siswa/ubah", $data);
    }

    public function hapus($nisn=null)
    {
        if (!isset($nisn)) show_404();
        
        if ($this->Siswa_Model->delete($nisn)) {
            $this->session->set_flashdata('danger', 'Berhasil dihapus');
            redirect(site_url('admin/siswa/'));
        }
    }
}