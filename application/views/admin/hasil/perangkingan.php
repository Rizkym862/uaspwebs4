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
	<div class="col-lg-12 col-md-12 col-xs-12">
		<div class="row">
			<div class="col-md-8 text-left">
				<strong style="font-size:18pt;"><span class="fa fa-table"></span> Penilaian Kinerja Guru</strong>
			</div>
		</div>
		<br>
		<table class="table table-striped table-bordered">
			<tr>
				<th class="bg-info text-light">Nama</th>
				<?php
				foreach ($kriteria as $key => $value) {
					echo "<th class='bg-info text-light'>$value->nama</th>";
				}
				?>
			</tr>
			<?php
				foreach ($nama_alternatif as $key => $value) {
					echo "<tr>
							<td class='bg-light'><b>$value->nama</b></td>";
							foreach ($nilai as $keys => $values) {
								if($value->nip == $values->alternatif){
									echo "<td class='bg-light'><b>$values->prioritas</b></td>";	
								}
							}
					echo "</tr>";
				}
				echo "<tr class='bg-warning'>";
					echo "<td><b>Prioritas</b></td>";
					foreach ($prioritas_kriteria as $key => $value) {
						echo "<td><b>$value->prioritas</b></td>";
					}
					echo "</tr>";
			?>
		</table>

		<strong style="font-size:18pt;"><span class="fa fa-sort-amount-down"></span> Hasil Ranking Metode</strong>
		<table class="table table-striped table-bordered">
			<tr class="bg-info text-light">
				<th>Nama</th>
				<th>Nilai</th>
				<th>Ranking</th>
			</tr>
			<?php
			
			foreach ($nama_alternatif as $key => $value) {
				
				echo "<tr>
					 <td class='bg-light'><b>$value->nama</b></td>";
				echo '<td class="bg-light"><b>'.@$ahp[$key].'</b></td>';
				echo '<td class="bg-warning"><b>'.@$rank[$key].'</b></td>';
				echo "</tr>";
			}
			?>
		</table>

		<!--<strong style="font-size:18pt;"><span class="fa fa-university"></span> Hasil Ranking Normal</strong>
		<table class="table table-striped table-bordered">
			<thead>
				<tr class="bg-info text-light">
					<th>Nama</th>
					<th>Nilai</th>
					<th>Ranking</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//foreach ($nilai_awal as $key => $value) {
				//	echo "<tr>
				//			<td class='bg-light'><b>$value->nama</b></td>
				//			<td class='bg-light'><b>$value->nilai</b></td>
				//			<td class='bg-warning'><b>$rank_awal[$key]</b></td>
				//		</tr>";
				//}
				?>
			</tbody>
		</table>-->
		
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
</div>
</body>
</html>