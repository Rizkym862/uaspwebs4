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
	<div class="col-lg-12 col-xs-12 col-md-12">
		<h3>Perbandingan Antar Alternatif <?php echo $kriteria->nama ?></h3> 
		<h4>Bobot</h4>
<form action="<?php echo site_url('admin/alternatif/ins_nilai_alternatif');?>" method="post" enctype="multipart/form-data">
		<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Antar Alternatif</th>
					<input type="hidden" name="kriteria" value="<?php echo $input;?>">
					<?php
					foreach ($alke as $key => $value) {
						foreach ($alke as $keys => $values) {
							if($key < $keys){
								echo '<input type="hidden" name="alternatif1['.$key.']['.$keys.']" value="'.$value->nip.'">';
								echo "<input type='hidden' name='alternatif2[$key][$keys]' value='$values->nip'>";
								echo '<input type="hidden" name="bobot['.$key.']['.$keys.']" value="'.$ahp1['bobot'][$key][$keys].'">';
							}
						}
					}
					foreach ($alke as $key => $value) {
						echo "<th>$value->nama</th>";
						
					}
					?>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($alke as $key => $value) {
						echo "<tr><td>$value->nama</td>";
						
						foreach ($ahp1['hasil'] as $keys => $value_ahp1) {
							echo '<td>'.$ahp1['hasil'][$key][$keys].'</td>';
						}
						echo '<tr>';
					}
				?>
			</tbody>
		</table>
		</div>
		<h4>Normalisasi</h4>
		<div class="table-responsive">
		<table class="table table-striped table-bordered" >
			<thead>
				<tr>
					<th>Antar Alternatif</th>
					<?php
					foreach ($alke as $key => $value) {
						echo "<th>$value->nama</th>";
					}
					?>
					<th class="bg-success">Jumlah</th>
					<th class="bg-danger">Prioritas</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($alke as $key => $value) {
						echo "<tr><td>$value->nama</td>";
						foreach ($ahp2['hasil'] as $keys => $value_ahp1) {
							echo '<td>'.$ahp2['hasil'][$key][$keys].'</td>';
						}
						echo '<td class="info">'.$ahp2['jumlah'][$key].'</td>';
						echo '<td class="danger">'.$ahp2['prioritas'][$key].'</td>
						<tr>';
					}
					echo '
						<tr class="bg-success">
							<td>Total</td>';
							foreach ($ahp2['total'] as $key => $value) {
								echo "<td>$value</td>";
							}
					echo'</tr>';
				?>
			</tbody>
		</table>
		</div>
		<br>
		<input type="submit" value="Simpan Bobot" class="btn btn-danger"><br><br>
</form>
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
  <?php $this->load->view("admin/_front/modal.php") ?>

  <?php $this->load->view("admin/_front/js.php") ?>
</body>
</html>