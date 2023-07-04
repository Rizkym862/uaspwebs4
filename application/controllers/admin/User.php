<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(empty($this->session->userdata('stat'))){
            redirect('utama','refresh');
        }
        else
        {
            $this->load->model("User_Model");
            $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $data["user"] = $this->User_Model->getAll();
        $this->load->view("admin/pengguna/tampil", $data);
    }

    public function tambah()
    {
        $user = $this->User_Model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run()) {
            $user->insert();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('admin/user');
        }

        $this->load->view("admin/pengguna/tambah");
    }

    public function ubah($id = null)
    {
        if (!isset($id)) redirect('admin/user');
       
        $user = $this->User_Model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run()) {
            $user->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect("admin/user");
        }
        $data["user"] = $user->getById($id);
        if (!$data["user"]) show_404();
        
        $this->load->view("admin/pengguna/ubah", $data);
    }

    public function hapus($id = null)
    {
        if (!isset($id)) show_404();
        
        if ($this->User_Model->delete($id)) {
            $this->session->set_flashdata('danger', 'Berhasil disimpan');
            redirect(site_url('admin/user'));
        }
    }
}