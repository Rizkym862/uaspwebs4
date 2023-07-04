<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("siswa/_front/header.php"); ?>
</head>

<body id="page-top">

  <?php $this->load->view("siswa/_front/navbar.php"); ?>

  <div id="wrapper">

    <!-- Sidebar -->
   
    <?php $this->load->view("siswa/_front/sidebar.php"); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <?php $this->load->view("siswa/_front/breadcrumb.php"); ?>

        <!-- Icon Cards-->
        <h1>Selamat Datang</h1>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <?php $this->load->view("siswa/_front/footer.php") ?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <?php $this->load->view("siswa/_front/scrolltop.php"); ?>

  <!-- Logout Modal-->
  <?php $this->load->view("siswa/_front/modal.php"); ?>

  <!-- Bootstrap JavaScript-->
  <?php $this->load->view("siswa/_front/js.php"); ?>

</body>

</html>
