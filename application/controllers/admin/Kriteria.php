<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller
{    
    var $bobot = array(
        '9' => '9 Mutlak Sangat Penting->',
        '8' => '8 Mendekati Mutlak->',
        '7' => '7 Sangat Penting->',
        '6' => '6 Mendekati Sangat Penting->',
        '5' => '5 Lebih Penting->',
        '4' => '4 Mendekati Lebih Penting->',
        '3' => '3 Sedikit Lebih Penting->',
        '2' => '2 Mendekati Sedikit Lebih Penting->',
        '1' => '1 <-Sama Penting Dengan->',
        '0.5' => '2 <-Mendekati Sedikit Lebih Penting',
        '0.3333' => '3 <-Sedikit Lebih Penting',
        '0.25' => '4 <-Mendekati Lebih Penting',
        '0.2' => '5 <-Lebih Penting',
        '0.1667' => '6 <-Mendekati Sangat Penting',
        '0.1429' => '7 <-Sangat Penting',
        '0.125' => '8 <-Mendekati Mutlak',
        '0.1111' => '9 <-Mutlak Sangat Penting'
    );


    public function __construct()
    {
        parent::__construct();
        if(empty($this->session->userdata('stat'))){
            redirect('utama','refresh');
        }
        else
        {
            $this->load->model("Kriteria_Model");
            $this->load->library('form_validation');
            $this->load->model('crud');
            $this->load->model('AHP');
            $this->load->model('AHP2');
            $this->load->model('Guru_Model');
            $this->load->model('Alternatif_Model');
        }
    }

    public function index()
    {
        $data["kriteria"] = $this->Kriteria_Model->getAll();
        $this->load->view("admin/kriteria/tampil", $data);
    }

   public function tambah()
    {
        $kriteria = $this->Kriteria_Model;
        $validation = $this->form_validation->set_message('required','Wajib diisi');
        $validation->set_rules($kriteria->rules());

        if ($validation->run()) {
            $kriteria->insert();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('admin/kriteria');
        }

        $this->load->view("admin/kriteria/tambah");
    }

    public function ubah($id_kriteria = null)
    {
        if (!isset($id_kriteria)) redirect('admin/kriteria');
       
        $kriteria = $this->Kriteria_Model;
        $validation = $this->form_validation->set_message('required','Wajib diisi');
        $validation->set_rules($kriteria->rules());

        if ($validation->run()) {
            $kriteria->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('admin/kriteria');
        }
        $data["kriteria"] = $kriteria->getById($id_kriteria);
        if (!$data["kriteria"]) show_404();
        
        $this->load->view("admin/kriteria/ubah", $data);
    }

    public function hapus($id_kriteria=null)
    {
        if (!isset($id_kriteria)) show_404();
        
        if ($this->Kriteria_Model->delete($id_kriteria)) {
            $this->session->set_flashdata('danger', 'Berhasil dihapus');
            redirect(site_url('admin/kriteria'));
        }
    }

    public function analisa(){
        $data = array(
            //bawaan
            'role' => $this->session->userdata('ha'),
            'nama' => $this->session->userdata('nama'),
            'nilai_preferensi' => $this->bobot,
            //tambahan
            'data' => $this->crud->alternatif(),
            'bobot' => $this->bobot,
            'kriteria' => $this->crud->kriteria(),
            'hasil_kriteria' => $this->db->get('hasil_kriteria')->result(),
            //'url'=> 'background-image: url("../../assets/images/back5.png");',
        );

        //echo str_replace(['],[','[[',']]'],'<br>',json_encode($data)); echo '<hr>';
        $this->load->view('admin/kriteria/analisa', $data);
    }


    public function perbandingan_kriteria(){
        //$input = $this->input->post();
        //$alternatif = $this->crud->alternatif();
        
        
            //echo str_replace(['],[','[[',']]'],'<br>',json_encode($inputan['alternatif1'][1][2])); echo '<hr>';

        $data = array(
            //bawaan
            'role' => $this->session->userdata('ha'),
            'nama' => $this->session->userdata('nama'),
            'nilai_preferensi' => $this->bobot,
            //tambahan
            'data' => $this->db->get('hasil_kriteria')->result(),
            //'data_id' => $this->db->group_by('kriteria')->get('hasil_kriteria')->result(),
            'alke' => $this->crud->alternatif(),
            'kriteria' => $this->db->get('kriteria')->result(),
            //'url'=> 'background-image: url("../../assets/images/back5.png");',
        );

        $ahp = $this->AHP2->perbandingan_kriteria($data['data'], $data['kriteria']);
        $data['ahp1'] = $ahp;
        /*$this->pre($ahp);
        die;*/
        //$ahp = $this->AHP2->normalisasi_prioritas($data['alke'], $data['data'], $ahp);
        $ahp = $this->AHP2->normalisasi_kriteria($ahp, $data['data'], $data['kriteria']);
        $data['ahp2'] = $ahp;
        /*$this->pre($ahp);
        die;*/
        $ahp = $this->AHP2->konsisten($data['data'], $ahp);
        $data['ahp3'] = $ahp;
        /*$this->pre($ahp);
        die;*/
        //echo str_replace(['],[','[[',']]'],'<br>',json_encode($ahp)); echo '<hr>';

        /*$ahp = $this->AHP->perbandingan_alternatif($data['alke'], $data['input']);
        echo str_replace(['],[','[[',']]'],'<br>',json_encode($ahp)); echo '<hr>';
        $data['ahp'] = $ahp;
        $ahp = $this->AHP->normalisasi_prioritas($data['alke'], $ahp);
        echo str_replace(['],[','[[',']]'],'<br>',json_encode($ahp)); echo '<hr>';
        $data['ahp2'] = $ahp;

        echo str_replace(['],[','[[',']]'],'<br>',json_encode($ahp)); echo '<hr>';
        $this->load->view('test/hasil',$data);*/
        /*echo str_replace(['],[','[[',']]'],'<br>',json_encode($data)); echo '<hr>';*/
        $this->load->view('admin/kriteria/nilai_prio', $data);
    }

    public function hasil_perhitungan(){
        

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

        

        if(!empty($data['prioritas_kriteria']) and !empty($data['nilai']) and !empty($nilai_awal))  {

            $this->load->view('admin/hasil/perangkingan',$data, FALSE);

        }else{
            
            $this->session->set_flashdata('msg', '<script>alert("Data Perhitungan Belum Tersedia")</script>');
            //redirect('admin/guru/','refresh');      
        }

    }

    function ins_nilai_kriteria(){
        $input = $this->input->post();
        $inputan = array(
            
            'kriteria1' => $this->input->post('kriteria1'),
            'bobot' => $this->input->post('bobot'),
            'kriteria2' => $this->input->post('kriteria2'),
        );
        $cc = count($inputan['kriteria1']);

        /*$this->pre($inputan);
        die;*/

        for ($i=0; $i <= $cc ; $i++) { 
            
            for ($j=$i+1; $j <= $cc ; $j++) { 

                $cek = $this->db->query('select * from hasil_kriteria where kriteria1 = ? and kriteria2 = ?',array($inputan['kriteria1'][$i][$j], $inputan['kriteria2'][$i][$j]))->row();
                if($cek == true){
                    $query = $this->db->query('update hasil_kriteria set bobot = ?  where kriteria1 =? and kriteria2 = ?',array($inputan['bobot'][$i][$j], $inputan['kriteria1'][$i][$j], $inputan['kriteria2'][$i][$j]));
                }else{
                    $query = $this->db->query('insert into hasil_kriteria values("'.$inputan['kriteria1'][$i][$j].'","'.$inputan['bobot'][$i][$j].'","'.$inputan['kriteria2'][$i][$j].'")');    
                }
                
                

            }

        }
        #$query = $this->db->query

        if($query == true){
            echo '<script>alert("Berhasil");</script>';
            redirect('admin/kriteria/perbandingan_kriteria','refresh');
        }else{
            echo '<script>alert("Gagal");</script>';
        }

        $this->pre($input);

        

    }

    function ins_prioritas(){
        $input = $this->input->post();

        $inputan = array(
            'kriteria' => $this->input->post('kriteria'),
            'alternatif' => $this->input->post('alternatif'),
            'prioritas' => $this->input->post('prioritas'),
        );

        $jumlah = count($input['kriteria']);

        for ($i=0; $i < $jumlah ; $i++) { 
            
            $cek = $this->db->query('select * from prioritas_kriteria where kriteria = ? and alternatif = ?',array($inputan['kriteria'][$i], $input['alternatif'][$i]))->row();

            if($cek == true){
                $query = $this->db->query('update prioritas_kriteria set prioritas = ? where kriteria = ? and alternatif = ?',array($input['prioritas'][$i], $input['kriteria'][$i], $input['alternatif'][$i]));
            }else{
                $query = $this->db->query('insert into prioritas_kriteria values ("", "'.$input['kriteria'][$i].'", "'.$input['alternatif'][$i].'", "'.$input['prioritas'][$i].'")');
            }

        }
        

        if($query == true){
            echo '<script>alert("Prioritas Tersimpan");</script>';
            redirect('kriteria/perbandingan_kriteria','refresh');
        }else{
            echo '<script>alert("Gagal");</script>';
        }

        #$this->pre($input);
    }

    function save_prioritas(){
        $input = $this->input->post();

        /*$this->pre($input);
        die;*/

        foreach ($input['kriteria'] as $key => $value) {
            
            $cek = $this->db->query('select * from prioritas_kriteria where kriteria = ? and periode = ?',array($input['kriteria'][$key], $input['periode']))->row();

            if($cek != null){

                $query = $this->db->query('update prioritas_kriteria set prioritas = ? where kriteria = ? and periode = ?',array($input['prioritas'][$key] ,$input['kriteria'][$key], $input['periode']));

            }else{
                $query = $this->db->query('insert into prioritas_kriteria(kriteria, prioritas, periode) values("'.$input['kriteria'][$key].'","'.$input['prioritas'][$key].'", "'.$input['periode'].'")');
            }
        }

        if($query == true){
            echo '<script>alert("Prioritas Tersimpan");</script>';
            redirect('admin/kriteria/analisa','refresh');
        }else{
            echo '<script>alert("Gagal");</script>';
        }

        //$this->pre($input);

    }

    function print_doc(){
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


    function pre($var){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}