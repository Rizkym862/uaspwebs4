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

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('admin/alternatif/nilai_awal') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">

						<form action="<?php echo site_url('admin/alternatif/nilai_awal/update_nilai_awal');?>" method="post">
							<table class="table table-striped">
		                      <tr>
		                        <td>Nama Guru</td>
		                        <td>
		                          <select name="nip" class="form-control">
		                          <?php
		                          foreach ($guru as $key => $value) {
		                            echo '<option value="'.$value->nip.'"> '.$value->nama.'</option>';
		                          }
		                          ?>
		                        </select>
		                        </td>
		                      </tr>
		                      <?php
		                      foreach ($kriteria as $key => $value) {
		                      echo '<tr>
		                                <td>'.$value->nama.'</td>
		                                <td><input type="hidden" name="id_kriteria[]" value="'.$value->id_kriteria.'">
		                                <input type="number" min="0" max="100" name="nilai[]" class="form-control" value="$nilai[$key]">
		                                </td>
		                              </tr>';
		                      }
		                      ?>
                    </table>
							<input class="btn btn-success" type="submit" name="btn" value="Ubah" />
						</form>

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

</body>

</html>