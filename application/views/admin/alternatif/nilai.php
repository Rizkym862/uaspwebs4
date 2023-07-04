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
<!-- modal -->
     <div class="modal fade bs-example-modal-lg" id="modaledit" role="dialog" aria-labelledby="myLargeModalLabel">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Nilai</h4>
                </div>
                <div class="row">
                  <div class="col-lg-1">
                  </div>
                  <div class="col-lg-10">
                    <div class="fetched-data"></div>
                  </div>
                  <div class="col-lg-1">
                  </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
      </div>

      <!-- <div class="modal fade bs-example-modal-lg" id="myModalb" role="dialog" aria-labelledby="myLargeModalLabel">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Nilai Guru</h4>
                </div>
                <div class="col-lg-1">
                </div>
                <div class="col-lg-10">
                  <form action="<?php /* echo site_url('admin/alternatif/ins_nilai');?>" method="post" enctype="multipart/form-data">
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
                                <input type="number" min="0" max="100" name="nilai[]" class="form-control">
                                </td>
                              </tr>';
                      }
                      $sekarang = date('Y');
                      echo '<tr>
                              <td>Periode</td>
                              <td><select name="periode" class="form-control">';
                            for ($i=$sekarang; $i >= 2016 ; $i--) { 
                              echo '<option value="'.$i.'">'.$i.'</option>';
                                    
                            }      
                      echo '</select></td>
                           </tr>'; */
                      ?>
                    </table>
                    <input type="submit" class="btn btn-info" value="Tambah">
                  </form><br><br>
                </div>
                <div class="col-lg-1">
                </div>
                              
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>

<!-- end modal-->

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
      <div class="row">
      <canvas id="myChart" height="50px"></canvas>
      </div>

      
        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success" role="alert">
          <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php endif; ?>

         <?php if ($this->session->flashdata('danger')): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $this->session->flashdata('danger'); ?>
        </div>
        <?php endif; ?>
        
      <br><br><br
      <form method="post">
        <div class="row">
          <div class="col-md-6 text-left">
            <strong style="font-size:18pt;"><span class="fa fa-modx"></span> Data Nilai Preferensi</strong>
          </div>
          <div class="col-md-6 text-right">
            <div class="btn-group">
             <a href="<?php echo site_url('admin/alternatif/tambah_nilai') ?>" class="btn btn-primary"><span class="fa fa-clone"></span> Tambah Data</a>
            </div>
          </div>
        </div>
        <br/>
        <div class="table-responsive">
          <table width="100%" class="table table-striped table-bordered" id="dataTable">
            <thead>
              <tr>
                <th>Nip</th>
                <th>Nama</th>
                <th>Nilai</th>
                <th>Periode</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Nip</th>
                <th>Nama</th>
                <th>Nilai</th>
                <th>Periode</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
            <tbody>
              <?php
               foreach ($data as $key => $value) {
              ?>
                    <tr>
                        <td><?php echo $value->nip ?></td>
                        <td><?php echo $value->nama ?></td>
                        <td><?php echo $value->nilai ?></<td>
                        <td><?php echo $value->periode ?></td>
                        <td style="text-align:center;vertical-align:middle;">
                        <a href="#" data-target="#modaledit" data-toggle="modal" data-id="<?php echo $value->idnilai ?>" class="btn btn-small"> <span class="fas fa-edit"> Ubah</span></a>
                        <!--<a href="<?php //echo site_url('admin/alternatif/get_edit_nilai/'.$value->idnilai) ?>"
                          class="btn btn-small"><i class="fas fa-edit"></i>Ubah</a>-->
                        <a onclick="deleteConfirm('<?php echo site_url('admin/alternatif/del_nilai/'.$value->idnilai) ?>')" class="btn btn-small text-danger"><span class="fas fa-trash"> Hapus</span></a>
                        </td>
                      </tr>
            <?php
              }
            ?>
            </tbody>
          </table><br>
        </div>
      </form>
    </div>
  </div>

  <!-- Default bootstrap modal example -->
  <div class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Nilai Detail</h4>
        </div>
        <div class="modal-body">
          <p>One fine body&hellip;</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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
  <?php $this->load->view("admin/_front/modal.php") ?>

  <?php $this->load->view("admin/_front/js.php") ?>

   <script>
    function deleteConfirm(url){
      $('#btn-delete').attr('href', url);
      $('#deleteModal').modal();
  }
  </script>

<script type="text/javascript">
   $(document).ready(function(){
        $('#modaledit').on('show.bs.modal', function(e){
            var rowid = $(e.relatedTarget).data('id');
            //ambil data
            $.ajax({
               type :'POST',
                url : '<?php echo site_url('admin/alternatif/get_edit_nilai');?>',
                data : 'rowid='+rowid,
                success : function(data){
                    $('.fetched-data').html(data);//tampil data di modal.
                }

            });
        });
    });

var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Kurang", "Buruk", "Cukup Buruk", "Cukup Baik", "Baik", "Sangat Baik"],
        datasets: [{
            label: 'Keterangan Nilai',
            data: [
            <?php
              echo $jumlah_kurang;
            ?>, 
            <?php
              echo $jumlah_buruk;
            ?>,
            <?php
              echo $jumlah_cukup_buruk;
            ?>, 
            <?php
              echo $jumlah_cukup_baik;
            ?>,
            <?php
              echo $jumlah_baik;
            ?>,
            <?php
              echo $jumlah_sangat_baik;
            ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
</body>
</html>


