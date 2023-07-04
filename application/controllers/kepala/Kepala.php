<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kepala extends CI_Controller
{
  public function __construct()
    {
        parent::__construct();
        if(empty($this->session->userdata('stat'))){
            redirect('utama','refresh');
        }

        //Do your magic here
    }

    public function index()
    {
        $data = array(
            'level' => $this->session->userdata('ha'),
            'nama' => $this->session->userdata('nama'),
        );
        //echo json_encode($data);
        $this->load->view('kepala/home', $data);
    }

}