<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('stat'))) {
            redirect('utama', 'refresh');
        } else {
            $this->load->model("Kriteria_Model");
            $this->load->library('form_validation');
            $this->load->model('crud');
            $this->load->model('AHP');
            $this->load->model('AHP2');
            $this->load->model('Guru_Model');
            $this->load->model('Alternatif_Model');
        }

        //Do your magic here
    }

    public function index()
    {

        $data = array(
            //bawaan
            'role' => $this->session->userdata('ha'),
            'nama' => $this->session->userdata('nama'),
            //tambahan
            'alternatif' => $this->db->get('guru')->result(),
            'hasil_alternatif' => $this->Alternatif_Model->get_group(),
            'kriteria' => $this->db->get('kriteria')->result(),
            'nilai' => $this->db->get('prioritas_alternatif')->result(),
            'prioritas_kriteria' => $this->db->get('prioritas_kriteria')->result(),

            //get table
            'nama_alternatif' => $this->Alternatif_Model->get_group(),
            'nilai_awal' => $this->Alternatif_Model->get_nilai_alternatif(),
            //'url'=> 'background-image: url("../../assets/images/back5.png");',
        );

        $ahp = $this->AHP2->ranking($data['alternatif'], $data['nilai'], $data['prioritas_kriteria']);
        $data['ahp'] = $ahp;

        /*  $this->pre($data);
        die;*/

        foreach ($data['nilai_awal'] as $key => $value) {
            $nilai_awal[$key] = $value->nilai;
        }

        #$this->pre($data['nilai_awal']);
        #die;

        arsort($nilai_awal);
        $nett = array();
        $rank = 1;

        foreach ($nilai_awal as $key => $value) {
            $nett[$key] = $rank;
            $rank++;
        }

        $data['rank_awal'] = $nett;



        arsort($ahp);
        $nett = array();
        $rank = 1;

        foreach ($ahp as $key => $value) {
            $nett[$key] = $rank;
            $rank++;
        }

        $data['rank'] = $nett;



        if (!empty($data['prioritas_kriteria']) and !empty($data['nilai']) and !empty($nilai_awal)) {

            $this->load->view('kepala/Laporan', $data, FALSE);
        } else {

            $this->session->set_flashdata('msg', '<script>alert("Data Perhitungan Belum Tersedia")</script>');
            //redirect('admin/guru/','refresh');      
        }
    }

    function print_doc()
    {
        $data = array(
            //bawaan
            'role' => $this->session->userdata('ha'),
            'nama' => $this->session->userdata('nama'),
            //tambahan
            'alternatif' => $this->db->get('guru')->result(),
            'hasil_alternatif' => $this->Alternatif_Model->get_group(),
            'kriteria' => $this->db->get('kriteria')->result(),
            'nilai' => $this->db->get('prioritas_alternatif')->result(),
            'prioritas_kriteria' => $this->db->get('prioritas_kriteria')->result(),

            //get table
            'nama_alternatif' => $this->Alternatif_Model->get_group(),
            'nilai_awal' => $this->Alternatif_Model->get_nilai_alternatif(),
            //'url'=> 'background-image: url("../../assets/images/back5.png");',
        );

        $ahp = $this->AHP2->ranking($data['alternatif'], $data['nilai'], $data['prioritas_kriteria']);
        $data['ahp'] = $ahp;

        #$this->pre($ahp);
        #die;

        foreach ($data['nilai_awal'] as $key => $value) {
            $nilai_awal[$key] = $value->nilai;
        }

        #$this->pre($data['nilai_awal']);
        #die;

        arsort($nilai_awal);
        $nett = array();
        $rank = 1;

        foreach ($nilai_awal as $key => $value) {
            $nett[$key] = $rank;
            $rank++;
        }

        $data['rank_awal'] = $nett;



        arsort($ahp);
        $nett = array();
        $rank = 1;

        foreach ($ahp as $key => $value) {
            $nett[$key] = $rank;
            $rank++;
        }

        $data['rank'] = $nett;
        #$this->pre($data);
        $this->load->view('kepala/print', $data);
    }


    function pre($var)
    {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}
