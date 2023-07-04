<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body>
  <!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-secondary">
    <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
    <div class="container">
      <div class="card card-login mx-auto mt-5">

        <div class="card-header bg-danger">Login</div>
        <div class="card-body">
          <form action="<?php echo site_url('login/proses'); ?>" method="POST">
            <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>
    <?php if (isset($msg)) : ?>
      <script type="text/javascript">
        swal({
          title: "Maaf Password Salah!",
          type: "error",
          timer: 2000,
          confirmButtonColor: "#556bf"
        })
      </script>
    <?php endif; ?>
  </body>

  </html>