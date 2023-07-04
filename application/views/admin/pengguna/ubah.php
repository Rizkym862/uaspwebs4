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

				<?php if ($this->session->flashdata('warning')): ?>
        		<div class="alert alert-danger" role="alert">
          		<?php echo $this->session->flashdata('warning'); ?>
        		</div>
        		<?php endif; ?>

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('admin/user') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('admin/user/ubah') ?>" method="post" enctype="multipart/form-data">

							<input type="hidden" name="id" value="<?php echo $user->id_user ?>" />

							<div class="form-group">
								<label for="name">Username</label>
								<input class="form-control <?php echo form_error('username') ? 'is-invalid':'' ?>"
								 type="text" name="username" placeholder="username" value="<?php echo $user->username ?>" readonly/>
								<div class="invalid-feedback">
									<?php echo form_error('username') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="pass">Username</label>
								<input class="form-control <?php echo form_error('password') ? 'is-invalid':'' ?>"
								 type="password" name="password" placeholder="password" value="<?php echo $user->password ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('password') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="level">Level</label>
								<select name="level" class="form-control">
									<?php if($user->level == "kepala"){
									echo "<option value='admin'>Admin</option>
										  <option value='kepala'selected>Kepala</option>";
									}else{
									echo "<option value='admin'selected>Admin</option>
										  <option value='kepala'>Kepala</option>";
									}
									?>
								</select>
								<div class="invalid-feedback">
									<?php echo form_error('') ?>
								</div>
							</div>		
							<input class="btn btn-success" type="submit" name="btn" value="Save" />
						</form>

					</div>

					<div class="card-footer small text-muted">
						* required fields
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