<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(empty($this->session->userdata('stat'))){
            redirect('utama','refresh');
        }
        else
        {
            $this->load->model("Guru_Model");
            $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $data["guru"] = $this->Guru_Model->getAll();
        $this->load->view("admin/guru/tampil", $data);
    }

    public function tambah()
    {
            $guru = $this->Guru_Model;
            $validation = $this->form_validation->set_message('required','Wajib diisi');
            $validation->set_rules($guru->rules());

            if ($validation->run()) {
                $guru->insert();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
                redirect('admin/guru');
            }
            $this->load->view("admin/guru/tambah");
            
    }

    public function ubah($nip = null)
    {
        if (!isset($nip)) redirect('admin/guru');
       
        $guru = $this->Guru_Model;
        $validation = $this->form_validation->set_message('required','Wajib diisi');
        $validation->set_rules($guru->rules());

        if ($validation->run()) {
            $guru->update();
            $this->session->set_flashdata('success', 'Berhasil diubah');
            redirect('admin/guru');
        }
        $data["guru"] = $guru->getByNip($nip);
        if (!$data["guru"]) show_404();
        
        $this->load->view("admin/guru/ubah", $data);
    }

    public function hapus($nip=null)
    {
        if (!isset($nip)) show_404();
        
        if ($this->Guru_Model->delete($nip)) {
            $this->session->set_flashdata('danger', 'Berhasil dihapus');
            redirect(site_url('admin/guru'));
        }
    }
}