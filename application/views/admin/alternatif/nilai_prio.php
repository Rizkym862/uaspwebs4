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
	<div class="col-xs-12 col-md-12 col-lg-12">
		<div class="row">
			<div class="col-md-6 text-left">
				<strong style="font-size:18pt;"><span class="fa fa-table"></span>Hasil Semua Perbandingan Kriteria </strong>
			</div>
		</div>
<?php
$arr_data = array();
foreach ($data_id as $key_data => $data_id) {
	$arr_data[$key_data] = $data_id->kriteria;
	//echo $arr_data[$key_data];
}

foreach ($kriteria as $key_kriteria => $kriteria) {
	foreach ($arr_data as $key => $value_data) {
		if($arr_data[$key] == $kriteria->id_kriteria){
			?>
<form action="<?php echo site_url('admin/alternatif/ins_prioritas');?>" method="post" enctype="muultipart/form-data">
	<div class="row">
			<div class="col-md-6 text-left">
				<strong style="font-size:18pt;"><span class="fa fa-bank"></span><?php echo $kriteria->nama;?> </strong>
			</div>
		</div>
	<div class="table-responsive">
	<table class="table table-striped table-bordered">
	<tr>
		<th></th>
		<?php
		foreach ($alke as $key => $value) {
			echo "<th>$value->nama</th>";
		}
		?>
	</tr>
	<tr>
		<?php
		
		foreach ($alke as $key_alk => $value) {

			echo '<tr>';
			echo "<td>$value->nama</td>";
			foreach ($ahp1['hasil'][$kriteria->id_kriteria][$key_alk] as $key_ahp1 => $v_ahp1) {
				echo "<td>$v_ahp1</td>";
			}
			echo '</tr>';
		}

		echo '<tr class="success"><td>Jumlah</td>';
		foreach ($ahp1['total_bawah'][$kriteria->id_kriteria] as $key => $value_tahp1) {
			echo '<td>'.$value_tahp1.'</td>';
		}
		echo '</tr>';
		?>
	</tr>
	</table>
	</div>
	<div class="table-responsive">
	<table class="table table-bordered table-striped">
	<tr>
		<th></th>
		<?php
		foreach ($alke as $key => $value) {
			echo "<th>$value->nama</th>";
		}
		?>
		<th class="info">Prioritas</th>
	</tr>
	<tr>
		<?php
		foreach ($alke as $key_alk => $value) {
			echo '<tr>';
			echo "<td>$value->nama</td>";
			//echo '<input type="hidden" name="kriteria[]" value=".'$kriteria->nama.'">';
			echo "<input type='hidden' name='kriteria[]' value='".$kriteria->id_kriteria."'>";
			echo "<input type='hidden' name='alternatif[]' value='$value->nip'>";
			foreach ($ahp2['hasil'][$kriteria->id_kriteria][$key_alk] as $key_ahp1 => $v_ahp1) {
				echo "<td>$v_ahp1</td>";
			}
			echo '<td class="info">'.$ahp2['prioritas'][$kriteria->id_kriteria][$key_alk].'</td>';
			echo "<input type='hidden' name='prioritas[]' value='".$ahp2['prioritas'][$kriteria->id_kriteria][$key_alk]."'>";
			echo '</tr>';
		}

		echo '<tr><td>Jumlah</td>';
			foreach ($ahp2['total'][$kriteria->id_kriteria] as $key => $value_tahp2) {
				echo "<td>$value_tahp2</td>";
			}
		echo '</tr>';

		?>
	</tr>
	</table>
	</div>
			<?php
		}
	}
}
?>	
	
	<div class="col-md-6 text-left">
		<label>Periode</label>
		<?php
		echo "<select name='periode' class='form-control'>";
		$now = date('Y');
		for ($i=$now; $i >= 2016 ; $i--) { 
			echo "<option value='$i'>$i</option>";
		}
		echo "</select>";
		?>
		<br>
		<input type="submit" class="btn btn-dark" value="Simpan Bobot">
		<br><br>
	</div>
	
</form>
	</div>
</div>


 <?php
 function pre($var){
 	echo '<pre>';
 	print_r($var);
 	echo '</pre>';
 }
 ?>

 </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <?php $this->load->view("admin/_front/footer.php") ?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  
  <!-- /#wrapper -->
  <?php $this->load->view("admin/_front/scrolltop.php") ?>
  <?php $this->load->view("admin/_front/modal.php") ?>

  <?php $this->load->view("admin/_front/js.php") ?>
</body>
</html>