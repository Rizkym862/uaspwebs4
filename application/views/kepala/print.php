<!DOCTYPE html>
<html lang="en"> 

<head>
	<?php $this->load->view("kepala/_front/header.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("kepala/_front/navbar.php") ?>

	<div id="wrapper">

		<div id="content-wrapper">

			<div class="container-fluid">


<div class="row">
	<div class="col-md-12">
		<div class="text-center">
			<h3><b>Hasil Penilaian Evaluasi Guru</b></h3><br><h4><b>SEKOLAH DASAR NEGERI BAKALAN KRAJAN 1</b></h4>
		</div>
	</div>

	<br>
	<table class="table table-responsive">
		<thead>
			<tr>
				<th>Nama</th>
				<th>Nilai</th>
				<th>Ranking</th>
			</tr>
		</thead>
		<tbody>
			<?php

			foreach ($nama_alternatif as $key => $value) {
				
				echo "<tr>
					 <td>$value->nama</td>";
				echo '<td>'.$ahp[$key].'</td>';
				echo '<td>'.$rank[$key].'</td>';
				echo "</tr>";
			}
			?>
		</tbody>
	</table>

	<div class="col-md-12">
		<div class="text-right">
			Yang bertanggung Jawab
			<br><br><br><br>
			<?php echo $nama;?>
		</div>
	</div>

</div>
</div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->

    </div>
    <!-- /.content-wrapper -->

  </div>
  
  <!-- /#wrapper -->
  <?php $this->load->view("kepala/_front/scrolltop.php") ?>
  <?php $this->load->view("kepala/_front/modal.php") ?>

  <?php $this->load->view("kepala/_front/js.php") ?>

<script type="text/javascript">
	window.print();
</script>

</body>
</html>
