<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_front/header.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/_front/navbar.php") ?>

	<div id="wrapper">

		<?php $this->load->view("admin/_front/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("admin/_front/breadcrumb.php") ?>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<p style="margin-bottom:10px;">
							<strong style="font-size:18pt;"><span class="fa fa-bomb"></span> Analisa Kriteria</strong>
						</p>
						<form action="<?php echo site_url('admin/kriteria/ins_nilai_kriteria'); ?>" method="post" enctype="multipart/form-data">
							<div class="panel panel-default">
								<?php
								/*$now = date('Y');
			echo '<p style="margin-bottom:10px;">
				<strong style="font-size:18pt;"> Periode</strong>
			</p>';
			echo '<select name="periode" class="form-control">
			<option> -->>Silahkan pilih Periode<<-- </option>';
			for ($i=$now; $i >= 2016 ; $i--) { 
				echo '<option value="'.$i.'"> '.$i.'</option>';
			}
			echo '</select>';*/
								?>
								<div class="panel-body">

									<div class="row">
										<div class="col-xs-12 col-md-3">
											<div class="form-group">
												<label>Kriteria Pertama</label>
											</div>
										</div>
										<div class="col-xs-12 col-md-6">
											<div class="form-group">
												<label>Pernilaian</label>
											</div>
										</div>
										<div class="col-xs-12 col-md-3">
											<div class="form-group">
												<label>Kriteria Kedua</label>
											</div>
										</div>
									</div>


									<?php
									foreach ($kriteria as $key => $value) {
										echo $key[0];
										foreach ($kriteria as $keys => $values) {
											if ($key < $keys) {

												echo '<div class="row">';

												echo '<div class="col-xs-12 col-md-3">
											<div class="form-group">
												<input type="text" class="form-control" readonly value="' . $value->nama . '">
												<input type="hidden" class="form-control" readonly value="' . $value->id_kriteria . '" name="kriteria1[' . $key . '][' . $keys . ']">
											</div>
										  </div>';

												echo '<div class="col-xs-12 col-md-6">
											<div class="form-group">';
												echo "<select name='bobot[$key][$keys]' class='form-control'>";

												$cek = $this->db->query('select * from hasil_kriteria where kriteria1 = ? and kriteria2 = ?', array($value->id_kriteria, $values->id_kriteria))->row();
												if ($cek->bobot == 1) {

													echo "<option value='$cek->bobot'>$cek->bobot-Sama Penting</option>";
												} elseif ($cek->bobot == 2) {
													echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Sedikit Lebih Penting</option>";
												} elseif ($cek->bobot == 3) {
													echo "<option value='$cek->bobot'>$cek->bobot-Sedikit Lebih Penting</option>";
												} elseif ($cek->bobot == 4) {
													echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Lebih Penting</option>";
												} elseif ($cek->bobot == 5) {
													echo "<option value='$cek->bobot'>$cek->bobot-Lebih Penting</option>";
												} elseif ($cek->bobot == 6) {
													echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Lebih Penting</option>";
												} elseif ($cek->bobot == 7) {
													echo "<option value='$cek->bobot'>$cek->bobot-Sangat Penting</option>";
												} elseif ($cek->bobot == 8) {
													echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Mutlak</option>";
												} elseif ($cek->bobot == 0.5) {
													echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Sedikit Lebih Penting</option>";
												} elseif ($cek->bobot == 0.3333) {
													echo "<option value='$cek->bobot'>$cek->bobot-Sedikit Lebih Penting</option>";
												} elseif ($cek->bobot == 0.25) {
													echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Lebih Penting</option>";
												} elseif ($cek->bobot == 0.2) {
													echo "<option value='$cek->bobot'>$cek->bobot-Lebih Penting</option>";
												} elseif ($cek->bobot == 0.1667) {
													echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Lebih Penting</option>";
												} elseif ($cek->bobot == 0.1429) {
													echo "<option value='$cek->bobot'>$cek->bobot-Sangat Penting</option>";
												} elseif ($cek->bobot == 0.125) {
													echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Mutlak</option>";
												} elseif ($cek->bobot == 0.1111) {
													echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Mutlak</option>";
												} else {
													echo "<option value='$cek->bobot'>$cek->bobot-Mutlak Sangat Penting</option>";
												}

												foreach ($bobot as $keyb => $valueb) {
													if ($cek->bobot == $keyb) {
													} else {
														echo "<option value='$keyb'>$valueb</option>";
													}
												}

												#echo "<option value='$keyb'>$keyb-$valueb</option>";

												echo '</select></div>
										</div>';

												echo '<div class="col-xs-12 col-md-3">
											<div class="form-group">
											<input type="text" class="form-control" readonly value="' . $values->nama . '">
												<input type="hidden" class="form-control" readonly value="' . $values->id_kriteria . '" name="kriteria2[' . $key . '][' . $keys . ']">
											</div>
										 </div>';

												echo '</div>'; //end row
											} // end if

										} // end keys
									} // end key
									?>
									<input type="submit" class="btn btn-danger" value="Selanjutnya">&nbsp;<span class="fa fa-arrow-right"></span> <br><br>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	</div>
	</div>
	<!-- /.container-fluid -->

	<!-- Sticky Footer -->
	<?php $this->load->view("admin/_front/footer.php") ?>

	</div>
	<!-- /.content-wrapper -->
	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("admin/_front/scrolltop.php") ?>

	<?php $this->load->view("admin/_front/js.php") ?>