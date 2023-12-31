<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alternatif extends CI_Controller {
 
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

			$this->load->model('Crud');
			$this->load->model('AHP');
			$this->load->model('AHP2');
			$this->load->model('Alternatif_Model');
			$this->load->model('Kriteria_Model');

	}
		//Do your magic here

	public function index()
	{
		$data = array(
			//bawaan
			'role' => $this->session->userdata('ha'),
			'nama' => $this->session->userdata('nama'),
			'nilai_preferensi' => $this->bobot,
			//tambahan
			'data' => $this->Crud->alternatif(),
			'bobot' => $this->bobot,
			'kriteria' => $this->Crud->kriteria(),
			//'jabatan' => $this->jabatan
		);

		//echo str_replace(['],[','[[',']]'],'<br>',json_encode($data)); echo '<hr>';
	}

	public function nilai_awal()
	{
		$data = array(
			//bawaan
			'role' => $this->session->userdata('ha'),
			'nama' => $this->session->userdata('nama'),
			//tambahan
			'guru' => $this->db->get('guru')->result(),
			'kriteria' => $this->db->get('kriteria')->result(),
			'data' => $this->db->query('select *, nilai_awal.id_nilai_awal as idnilai from nilai_awal, guru WHERE guru.nip = nilai_awal.nip')->result(),
			'jumlah_kurang' => $this->db->query("SELECT * FROM nilai_awal WHERE keterangan = 'Kurang'")->num_rows(),
			'jumlah_buruk' => $this->db->query("SELECT * FROM nilai_awal WHERE keterangan = 'Buruk'")->num_rows(),
			'jumlah_cukup_buruk' => $this->db->query("SELECT * FROM nilai_awal WHERE keterangan = 'Cukup Buruk'")->num_rows(),
			'jumlah_cukup_baik' => $this->db->query("SELECT * FROM nilai_awal WHERE keterangan = 'Cukup Baik'")->num_rows(),
			'jumlah_baik' => $this->db->query("SELECT * FROM nilai_awal WHERE keterangan = 'Baik'")->num_rows(),
			'jumlah_sangat_baik' => $this->db->query("SELECT * FROM nilai_awal WHERE keterangan = 'Sangat Baik'")->num_rows(),
			#'url'=> 'background-image: url("../../assets/images/back5.png");',
		);

		$this->load->view('admin/alternatif/nilai', $data);
		//$this->pre($data);
	}

	public function tambah_nilai()
	{
		$data = array(
			//bawaan
			'role' => $this->session->userdata('ha'),
			'nama' => $this->session->userdata('nama'),
			//tambahan
			'guru' => $this->db->get('guru')->result(),
			'kriteria' => $this->db->get('kriteria')->result(),
			'data' => $this->db->query('select *, nilai_awal.id_nilai_awal as idnilai from nilai_awal, guru WHERE guru.nip = nilai_awal.nip')->result(),
			#'url'=> 'background-image: url("../../assets/images/back5.png");',
		);

		$this->load->view('admin/alternatif/tambah_nilai', $data);
		//$this->pre($data);
	}



	public function ins_nilai()
	{
		$input = $this->input->post();

		$total = 0;

		$id = $this->db->query('SELECT id_nilai_awal FROM `nilai_awal` ORDER by id_nilai_awal desc')->row();
		$id = $id->id_nilai_awal + 1;

		if($id != null){
			foreach ($input['nilai'] as $key => $value) {
			
				$query =  $this->db->query('insert into nilai_detail(id_nilai_awal, id_kriteria, nilai) values("'.$id.'", "'.$input['id_kriteria'][$key].'", "'.$input['nilai'][$key].'")');
				$total += $value;
			}
		}

		$total = $total / count($input['nilai']);
		if($total > 0 && $total <= 40){
			$keterangan = 'Kurang';
		}elseif($total > 50 && $total < 60){
			$keterangan = 'Buruk';
		}elseif ($total >= 60 && $total < 70) {
			$keterangan = 'Cukup Buruk';
		}elseif ($total >= 70 && $total < 80) {
			$keterangan = 'Cukup Baik';
		}elseif($total >= 80  && $total < 90){
			$keterangan = 'Baik';
		}else{
			$keterangan = 'Sangat Baik';
		}

		$query2 = $this->db->query('insert into nilai_awal(nip, nilai, keterangan, periode) values("'.$input['nip'].'","'.$total.'","'.$keterangan.'","'.$input['periode'].'")');

		//$this->pre($id);
		if($query2 == true){
			$this->session->set_flashdata('success', 'Berhasil disimpan');
			redirect('admin/alternatif/nilai_awal','refresh');
		}
	}


	function nilai_detail(){
		$id = $this->input->post('rowid');
		
		$data['data'] = $this->Alternatif_Model->get_nilai($id);
		#$this->pre($data);
		$this->load->view('admin/modal/nilai_detail', $data); 

	}

	function get_nik_complete(){
		if(isset($_GET['term'])){
			$result = $this->Mod_alternatif->search_nik($_GET['term']);
			if(count($result) > 0){
				foreach ($result as $key => $value) {
					$arr_result[] = $value->NIK;
					echo json_encode($arr_result);
				}
			}
		}
	}

	
	function get_edit_nilai(){ 
		$id = $this->input->post('rowid');
		$nilai = $this->Alternatif_Model->get_nilai($id);

		foreach ($nilai as $key => $value) {
			$data['nilai'][] = $value->nilai;
			$nama = $value->nama;
			$idv = $value->id_nilai_awal;
		}

		$data['nama'] = $nama;
		$data['id'] = $idv;
		$data['kriteria'] = $this->Kriteria_Model->get_kriteria();

		$this->load->view('admin/modal/edit_nilai', $data);

	}

	public function perbandingan_alternatif(){
		//$input = $this->input->post();
		//$alternatif = $this->crud->alternatif();
		
		
			//echo str_replace(['],[','[[',']]'],'<br>',json_encode($inputan['alternatif1'][1][2])); echo '<hr>';

		$data = array(
			//bawaan
			'role' => $this->session->userdata('ha'),
			'nama' => $this->session->userdata('nama'),
			//tambahan
			'data' => $this->db->get('hasil_alternatif')->result(),
			'data_id' => $this->db->group_by('kriteria')->get('hasil_alternatif')->result(),
			'alke' => $this->Crud->alternatif(),
			'kriteria' => $this->db->get('kriteria')->result(),
		);

		$ahp = $this->AHP2->perbandingan_alternatif($data['alke'], $data['data']);
		$data['ahp1'] = $ahp;
		/*$this->pre($ahp);
		die;*/
		$ahp = $this->AHP2->normalisasi_prioritas($data['alke'], $data['data'], $ahp);
		$data['ahp2'] = $ahp;
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
		$this->load->view('admin/alternatif/nilai_prio', $data);
	}

	public function hasil_perhitungan(){
		
		$data = array(
			//bawaan
			'role' => $this->session->userdata('ha'),
			'nama' => $this->session->userdata('nama'),
			//tambahan
			'alternatif' => $this->db->group_by('alternatif')->get('prioritas_alternatif')->result(),
			'kriteria' => $this->db->group_by('kriteria')->get('prioritas_kriteria')->result(),
		);
		/*$this->load->view('Header', $data);
		$this->load->view('hasil/perangkingan');
		$this->load->view('Footer');*/
		$this->pre($data);
	}

	public function perbandingan_alternatif_single(){
		$input = $this->input->post();
		$id = $this->input->post('kriteria');

		/*$this->pre($id);
		die;*/

		$data = array(
			//bawaan
			'role' => $this->session->userdata('ha'),
			'nama' => $this->session->userdata('nama'),
			//tambahan
			'data' => $this->db->get('hasil_alternatif')->result(),
			'data_id' => $this->db->group_by('kriteria')->get('hasil_alternatif')->result(),
			'alke' => $this->Crud->alternatif(),
			'kriteria' => $this->db->get_where('kriteria', 'id_kriteria="'.$id.'"')->row(),
			'input' => $this->input->post('kriteria')
		);

		$ahp = $this->AHP->perbandingan_alternatif($data['alke'], $input);
		$data['ahp1'] = $ahp;
		/*$this->pre($ahp);
		die;*/
		$ahp = $this->AHP->normalisasi_prioritas($data['alke'], $ahp);
		$data['ahp2'] = $ahp;

		/*$this->pre($ahp);
		die;*/

		//$this->load->view('Header', $data, FALSE);
		$this->load->view('admin/alternatif/single', $data, FALSE);
		//$this->load->view('Footer');

		#$this->pre($data);

	}

	public function analisa()
	{
		$data = array(
			//bawaan
			'role' => $this->session->userdata('ha'),
			'nama' => $this->session->userdata('nama'),
			'bobot' => $this->bobot,
			//tambahan
			'nilai' => $this->db->query('SELECT nilai_awal.id_nilai_awal as id, guru.nip as nip, guru.nama as nama, avg(nilai_awal.nilai) as nilai, nilai_awal.keterangan as keterangan from guru, nilai_awal WHERE nilai_awal.nip = guru.nip GROUP BY nip')->result(),
			'kriteria' => $this->db->get('kriteria')->result(),
			'alternatif' => $this->db->get('guru')->result(),
		);

		#SELECT alternatif.id as nik,  alternatif.nama AS nater, nilai_awal.nilai as nilai_awal, nilai_detail.nilai as nilai_detail, nilai_awal.periode, nilai_awal.keterangan FROM nilai_awal, nilai_detail, alternatif where nilai_detail.id_nilai_awal = nilai_detail.id and alternatif.id = nilai_awal.id_alternatif
		$this->load->view('admin/alternatif/analisa', $data);
		#$this->pre($data);
		
	}

	function get_kriteria(){
		$id =$this->input->post('kriteria');
		$alternatif = $this->db->get('guru')->result();
		$bobot = $this->bobot;

		foreach ($alternatif as $key => $value) {
			foreach ($alternatif as $keys => $values) {
				
				if($key < $keys){

					echo '<div class="row">';

					echo '<div class="col-xs-12 col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" readonly value="'.$value->nama.'"">
								<input type="hidden" class="form-control" readonly value="'.$value->nip.'" name="alternatif1['.$key.']['.$keys.']">
							</div>
						  </div>';
					echo '<div class="col-xs-12 col-md-6">
							<div class="form-group">';
							echo "<select name='bobot[$key][$keys]' class='form-control'>";
							$cek = $this->db->query('select * from hasil_alternatif where kriteria = ? and alternatif1 = ? and alternatif2 = ?',array($id, $value->nip, $values->nip))->row();
							if($cek != null)
							{
								if($cek->bobot == 1){
				
										echo "<option value='$cek->bobot'>$cek->bobot-Sama Penting</option>";

									}elseif ($cek->bobot == 2) {
										echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Sedikit Lebih Penting</option>";
									}elseif($cek->bobot == 3){
										echo "<option value='$cek->bobot'>$cek->bobot-Sedikit Lebih Penting</option>";
									}elseif($cek->bobot == 4){
										echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Lebih Penting</option>";
									}elseif($cek->bobot == 5){
										echo "<option value='$cek->bobot'>$cek->bobot-Lebih Penting</option>";
									}elseif ($cek->bobot == 6) {
										echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Lebih Penting</option>";
									}elseif($cek->bobot == 7){
										echo "<option value='$cek->bobot'>$cek->bobot-Sangat Penting</option>";
									}elseif($cek->bobot == 8){
										echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Mutlak</option>";
									}elseif ($cek->bobot == 0.5) {
										echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Sedikit Lebih Penting</option>";
									}elseif($cek->bobot == 0.3333){
										echo "<option value='$cek->bobot'>$cek->bobot-Sedikit Lebih Penting</option>";
									}elseif($cek->bobot == 0.25){
										echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Lebih Penting</option>";
									}elseif($cek->bobot == 0.2){
										echo "<option value='$cek->bobot'>$cek->bobot-Lebih Penting</option>";
									}elseif ($cek->bobot == 0.1667) {
										echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Lebih Penting</option>";
									}elseif($cek->bobot == 0.1429){
										echo "<option value='$cek->bobot'>$cek->bobot-Sangat Penting</option>";
									}elseif($cek->bobot == 0.125){
										echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Mutlak</option>";
									}elseif($cek->bobot == 0.1111){
										echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Mutlak</option>";
									}else{
										echo "<option value='$cek->bobot'>$cek->bobot-Mutlak Sangat Penting</option>";
									}
								
								foreach ($bobot as $keyb => $valueb) {
									if($cek->bobot == $keyb){
											
									}else{
											echo "<option value='$keyb'>$valueb</option>";
									}
								}
							}else{

								foreach ($bobot as $keyb => $valueb) {
										if($cek->bobot == $keyb){
											
										}else{
											echo "<option value='$keyb'>$keyb-$valueb</option>";
										}
									}
							
							}
							echo '</select></div>
							</div>';

					echo '<div class="col-xs-12 col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" readonly value="'.$values->nama.'"">
								<input type="hidden" class="form-control" readonly value="'.$values->nip.'" name="alternatif2['.$key.']['.$keys.']">
							</div>
						 </div>';

						echo '</div>'; //end row
								} // end if
			
			} // end keys
		} // end key
		//$query = $this->db->query('select * from hasil alternatif whre')
		//$this->pre($cek->bobot);
	}

	/* function get_edit(){
		$id =  $this->input->post('rowid');

		$query = $this->db->get_where('alternatif', array('id' => $id))->row();
		$now = $this->db->query('select CURRENT_DATE as now')->row();
		#$max = $this->db->query('select DATE_SUB(curdate(), INTERVAL 15 Year) as now')->row();
		$tahun = date('Y');
		$tahun = $tahun - 15;
		$max = $tahun.'-12-31';
		$kelamin = array('Pria','Wanita');
		$pendidikan = array('SMA','D3','S1/D4');

		echo "<form action='".site_url('alternatif/update')."' method='post' enctype='multipart/form-data'>
				<div class='col-lg-6'>
					<input type='hidden' name='id' value='$id'>
					<label>NIK</label>
					<input type='text' required name='nik' class='form-control' value='$id'>
					<label>Nama Alternatif</label>
					<input type='text' required name='nama' class='form-control' value='$query->nama'>
					<label>Tempat Lahir</label>
					<input type='text' required name='tempat_lahir' minlength='1' maxlength='10' value='$query->tempat_lahir' class='form-control'>
					<label>Tanggal Lahir</label>
					<input type='date' name='tanggal_lahir' required max='$max' value='$query->tanggal_lahir' class='form-control'>
					<label>Kelamin</label>
					<select name='kelamin' class='form-control' required>";
						echo "<option value='$query->kelamin'>$query->kelamin</option>";
						foreach ($kelamin as $key => $value) {
							if($value == $query->kelamin){
							}else{
								echo "<option value='$value'>$value</option>";
							}
						}

			echo "</select>
					<label>Alamat</label>
					<textarea name='alamat' name='alamat' class='form-control' required>$query->alamat</textarea>
					<label>Jabatan</label>
					<select name='jabatan' class='form-control' required>";
					foreach ($this->jabatan as $key => $value) {
						if($value == $query->jabatan){
							echo "<option value='$value'>$value</option>";
						}else{
							echo "<option value='$value'>$value</option>";
						}
					}
					
			echo "</select>
					<label>Tanggal Masuk</label>
					<input type='date' name='tanggal_masuk' required max='$now->now' value='$query->tanggal_masuk' class='form-control'
					<label>Pendidikan</label>
					<select name='pendidikan' class='form-control' required>";
						echo "<option value='$query->pendidikan'>$query->pendidikan</option>";
						foreach ($pendidikan as $key => $value) {
							if($value == $query->pendidikan){
							}else{
								echo "<option value='$value'>$value</option>";
							}
						}

				echo "</select> <input type='submit' class='btn btn-dark'>

				</div>
			 </form>";

			 #echo json_encode($data);
	}*/

	function update(){
		$table = 'alternatif';
		$data = $this->input->post();

		$input = array(
			'id' => $data['nik'],
			'nama' => $data['nama'],
			'tempat_lahir' => $data['tempat_lahir'],
			'tanggal_lahir' => $data['tanggal_lahir'],
			'kelamin' => $data['kelamin'],
			'alamat' => $data['alamat'],
			'jabatan' => $data['jabatan'],
			'tanggal_masuk' => $data['tanggal_masuk'],
			'pendidikan' => $data['pendidikan'],
		);

		if($data['tanggal_lahir'] == '' || $data['tanggal_masuk'] == ''){
			echo "<script>alert('Error')</script>";
			redirect('alternatif','refresh');
		}else{
			$query = $this->db->update($table, $input, array('id' => $data['id']));
			if($query == true){
				echo "<script>alert('Berhasil Update')</script>";
				redirect('alternatif','refresh');
			}else{
				echo "<script>alert('Gagal Update')</script>";
				redirect('alternatif','refresh');
			}
		}	

		echo json_encode($data);

	}


//CRUD

	function ins_nilai_alternatif(){
		$input = $this->input->post();
		$inputan = array(
			'kriteria' => $this->input->post('kriteria'),
			'alternatif1' => $this->input->post('alternatif1'),
			'bobot' => $this->input->post('bobot'),
			'alternatif2' => $this->input->post('alternatif2'),
		);
		$cc = count($inputan['alternatif1']);

		//input bobot
		for ($i=0; $i <= $cc ; $i++) { 
			
			for ($j=$i+1; $j <= $cc ; $j++) { 

				$cek = $this->db->query('select * from hasil_alternatif where kriteria = ? and alternatif1 = ? and alternatif2 = ?',array($inputan['kriteria'], $inputan['alternatif1'][$i][$j], $inputan['alternatif2'][$i][$j]))->row();
				if($cek == true){
					$query = $this->db->query('update hasil_alternatif set bobot = ?  where kriteria = ? and alternatif1 =? and alternatif2 = ?',array($inputan['bobot'][$i][$j], $inputan['kriteria'], $inputan['alternatif1'][$i][$j], $inputan['alternatif2'][$i][$j]));
				}else{
					$query = $this->db->query('insert into hasil_alternatif values("'.$inputan['kriteria'].'","'.$inputan['alternatif1'][$i][$j].'","'.$inputan['bobot'][$i][$j].'","'.$inputan['alternatif2'][$i][$j].'")');	
				}
				
				

			}

		}
		#$query = $this->db->query
		//input prioritas



		if($query == true){
			echo '<script>alert("Berhasil");</script>';
			#redirect('Alternatif/perbandingan_alternatif','refresh');
			redirect('admin/alternatif/analisa','refresh');
		}else{
			echo '<script>alert("Gagal");</script>';
		}
		//$this->pre($input);
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
			
			$cek = $this->db->query('select * from prioritas_alternatif where kriteria = ? and alternatif = ? and periode = ?',array($inputan['kriteria'][$i], $input['alternatif'][$i], $input['periode']))->row();

			if($cek == true){
				$query = $this->db->query('update prioritas_alternatif set prioritas = ? where kriteria = ? and alternatif = ? and periode = ?',array($input['prioritas'][$i], $input['kriteria'][$i], $input['alternatif'][$i], $input['periode']));
			}else{
				$query = $this->db->query('insert into prioritas_alternatif values ("", "'.$input['kriteria'][$i].'", "'.$input['alternatif'][$i].'", "'.$input['prioritas'][$i].'", "'.$input['periode'].'")');
			}

		}
		

		if($query == true){
			echo '<script>alert("Prioritas Tersimpan");</script>';
			redirect('admin/Alternatif/perbandingan_alternatif','refresh');
			#redirect('Alternatif/analisa','refresh');
		}else{
			echo '<script>alert("Gagal");</script>';
		}

		#$this->pre($input);
	}

	function del_nilai($id){

		$query = $this->db->delete('nilai_awal', 'id_nilai_awal = '.$id.'');
		$query2 = $this->db->delete('nilai_detail', 'id_nilai_detail = '.$id.'');
		if($query == true and $query2 == true){
			$this->session->set_flashdata('danger', 'Berhasil dihapus');
			redirect('admin/alternatif/nilai_awal','refresh');
		}else{
			echo '<script>alert("Gagal!")</script>';
		}

	}

	function pre($var){
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}
}
/* End of file Kriteria.php */
/* Location: ./application/controllers/Kriteria.php */