<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pertanyaan extends CI_Controller
{
  public function __construct()
    {
        parent::__construct();
        if(empty($this->session->userdata('stat'))){
            redirect('utama','refresh');
        }
        else{
            $this->load->model("Guru_Model");
        }

        //Do your magic here
    }

    public function index()
    {
     $data["guru"] = $this->Guru_Model->getAll();
     $data["detail"] = $this->db->query('SELECT * FROM nilai_detail')->result();
     $this->load->view("siswa/pertanyaan", $data);   
    }

    public function penilaian($nip = null){
       $data = array(
            //bawaan
            'role' => $this->session->userdata('ha'),
            'nama' => $this->session->userdata('nama'),
            'nisn' => $this->session->userdata('nisn'),
            //tambahan
            'guru' => $this->Guru_Model->getByNip($nip)
            #'url'=> 'background-image: url("../../assets/images/back5.png");',
        );
       if(!$data['guru']) show_404();

        $this->load->view('siswa/form_penilaian', $data);
        //$this->pre($data);
    }

    public function input_nilai(){
        $post = $this->input->post();
        $total = 0;
        $nilai = array('1' => $post['soal1']+$post['soal6']+$post['soal11']+$post['soal16'],
                       '2' => $post['soal2']+$post['soal7']+$post['soal12']+$post['soal17'],
                       '3' => $post['soal3']+$post['soal8']+$post['soal13']+$post['soal18'],
                       '4' => $post['soal4']+$post['soal9']+$post['soal14']+$post['soal19'],
                       '5' => $post['soal5']+$post['soal10']+$post['soal15']+$post['soal20']
        );

        $id = $this->db->query('SELECT id_nilai_awal FROM `nilai_awal` ORDER by id_nilai_awal desc')->row();
        $id = $id->id_nilai_awal + 1;

        if($id != null){
            foreach ($nilai as $key => $value) {
            
                $query =  $this->db->query('insert into nilai_detail(id_nilai_awal, id_kriteria, nilai, nisn) values("'.$id.'", "'.$key.'", "'.$value.'", "'.$post['nisn'].'")');
                $total += $value;
            }
        }

        if($total > 0 && $total <= 40){
            $keterangan = 'Kurang';
        }elseif($total > 50 && $total <= 60){
            $keterangan = 'Buruk';
        }elseif ($total > 60 && $total <= 70) {
            $keterangan = 'Cukup Buruk';
        }elseif ($total > 70 && $total <= 80) {
            $keterangan = 'Cukup Baik';
        }elseif($total > 80  && $total <= 90){
            $keterangan = 'Baik';
        }else{
            $keterangan = 'Sangat Baik';
        }

            $query2 = $this->db->query('insert into nilai_awal(nip, nilai, keterangan, periode) values("'.$post['nip'].'","'.$total.'","'.$keterangan.'","'.$post['periode'].'")');
            if($query2 == true){
                $this->session->set_flashdata('success', 'Berhasil disimpan');
                redirect('siswa/pertanyaan','refresh');
            }        
    }
}