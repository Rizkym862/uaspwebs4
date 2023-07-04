<!DOCTYPE html> 
<html lang="en">
<head>
  <?php $this->load->view("siswa/_front/header.php") ?>
</head>

<body id="page-top">

  <?php $this->load->view("siswa/_front/navbar.php") ?>
  <div id="wrapper">

    <?php $this->load->view("siswa/_front/sidebar.php") ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <?php $this->load->view("siswa/_front/breadcrumb.php") ?>
        
        <!-- DataTables -->
          <div class="card-body">
              <form action="<?php echo site_url('siswa/pertanyaan/input_nilai');?>" method="post" enctype="multipart/form-data">
                <div class="table-responsive">
                    <input type="hidden" name="nisn" value="<?php echo $nisn ?>">
                    <input type="hidden" name="nip" value="<?php echo $guru->nip ?>">
                    <table class="table table-hover" width="100%">
                        <tr>
                        <?php
                          $sekarang = date('Y');
                              echo '  <td>Periode</td>
                                      <td><select name="periode" class="form-control">';
                                    for ($i=$sekarang; $i >= 2018 ; $i--) { 
                                      echo '<option value="'.$i.'">'.$i.'</option>';       
                                    }      
                              echo '</select></td>';
                        ?>                            
                        </tr>
                        <tr>
                            <th>NIP:</th>
                            <td colspan="4"><?php echo $guru->nip ?></td>
                            
                        </tr>
                        <tr>
                            <th>Nama Guru</th>
                            <td colspan="4"><?php echo $guru->nama ?></td>
                        </tr>
                        <tr>
                            <td colspan="5"><b>Isilah jawaban dibawah ini :</b></td>
                        </tr>
                        <tr>
                            <td colspan="5">1. Guru membantu siswa ketika mendapat masalah</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="soal1" value=1 required> Sangat Tidak Setuju</td>
                            <td><input type="radio" name="soal1" value=2> Tidak Setuju</td>
                            <td><input type="radio" name="soal1" value=3> Tidak tahu</td>
                            <td><input type="radio" name="soal1" value=4> Setuju</td>
                            <td><input type="radio" name="soal1" value=5> Sangat Setuju</td>
                        </tr>
                        <tr>
                            <td colspan="5">2. Guru selalu memberikan motivasi kepada peserta didik</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal2" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal2" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal2" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal2" value=4> Setuju</td>
                           <td><input type="radio" name="soal2" value=5> Sangat Setuju</td>
                        </tr>
                        <tr>
                            <td colspan="5">3. Guru selalu memberikan kepercayaan kepada siswa tentang tugas yang diberikan</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal3" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal3" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal3" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal3" value=4> Setuju</td>
                           <td><input type="radio" name="soal3" value=5> Sangat Setuju</td>
                        </tr>
                        <tr>
                            <td colspan="5">4. Guru mengutamakan perkembangan prestasi belajar siswa</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal4" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal4" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal4" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal4" value=4> Setuju</td>
                           <td><input type="radio" name="soal4" value=5> Sangat Setuju</td>
                        </tr>
                        <tr>
                            <td colspan="5">5. Guru selalu memberikan contoh perilaku yang baik pada siswa</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal5" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal5" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal5" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal5" value=4> Setuju</td>
                           <td><input type="radio" name="soal5" value=5> Sangat Setuju</td>
                        </tr>
                        <tr>
                            <td colspan="5">6. Guru peduli dengan kenyamanan siswa ketika pembelajaran berlangsung</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal6" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal6" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal6" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal6" value=4> Setuju</td>
                           <td><input type="radio" name="soal6" value=5> Sangat Setuju</td>
                        </tr>
                        <tr>
                            <td colspan="5">7. Guru selalu membantu siswa ketika siswa kesulitan dalam mengerjakan soal</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal7" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal7" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal7" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal7" value=4> Setuju</td>
                           <td><input type="radio" name="soal7" value=5> Sangat Setuju</td>
                        </tr>
                        <tr>
                            <td colspan="5">8. Guru mendorong siswa untuk bersikap mandiri</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal8" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal8" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal8" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal8" value=4> Setuju</td>
                           <td><input type="radio" name="soal8" value=5> Sangat Setuju</td>
                        </tr>
                        <tr>
                            <td colspan="5">9. Guru akan merasa bangga ketika siswanya berhasil mendapatkan nilai yang diinginkan dalam proses pembelajaran</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal9" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal9" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal9" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal9" value=4> Setuju</td>
                           <td><input type="radio" name="soal9" value=5> Sangat Setuju</td>
                        </tr>
                        <tr>
                            <td colspan="5">10. Guru selalu berkata jujur dalam setiap perbuatannya</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal10" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal10" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal10" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal10" value=4> Setuju</td>
                           <td><input type="radio" name="soal10" value=5> Sangat Setuju</td>
                        </tr>
                        <tr>
                            <td colspan="5">11. Guru selalu bersikap terbuka kepada siswa maupun guru lainnya</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal11" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal11" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal11" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal11" value=4> Setuju</td>
                           <td><input type="radio" name="soal11" value=5> Sangat Setuju</td>
                        </tr>
                        <tr>
                            <td colspan="5">12. Guru selalu berinteraksi langsung dengan peserta didik</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal12" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal12" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal12" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal12" value=4> Setuju</td>
                           <td><input type="radio" name="soal12" value=5> Sangat Setuju</td>
                        </tr>
                        <tr>
                            <td colspan="5">13. Guru memberikan kebebasan penuh kepada siswa untuk menyelesaikan tugas yang guru berikan</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal13" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal13" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal13" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal13" value=4> Setuju</td>
                           <td><input type="radio" name="soal13" value=5> Sangat Setuju</td>
                        </tr>
                         <tr>
                            <td colspan="5">14. Guru menceritakan pengalamannya kepada siswa yang bertujuan sebagai motivasi dalam belajar</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal14" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal14" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal14" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal14" value=4> Setuju</td>
                           <td><input type="radio" name="soal14" value=5> Sangat Setuju</td>
                        </tr>
                         <tr>
                            <td colspan="5">15. Guru memberikan pengarahan bahwa tidak boleh melanggar aturan serta prinsip etika yang baik agak bisa berhasil</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal15" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal15" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal15" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal15" value=4> Setuju</td>
                           <td><input type="radio" name="soal15" value=5> Sangat Setuju</td>
                        </tr>
                         <tr>
                            <td colspan="5">16. Guru bisa memahami siswa yang siap menerima pelajaran dan yang tidak siap menerima pelajaran tanpa harus bertanya pada siswa</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal16" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal16" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal16" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal16" value=4> Setuju</td>
                           <td><input type="radio" name="soal16" value=5> Sangat Setuju</td>
                        </tr>
                         <tr>
                            <td colspan="5">17. Guru tidak merasa tersaingi ketika ada guru baru yang hendak mengajar di kelas</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal17" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal17" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal17" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal17" value=4> Setuju</td>
                           <td><input type="radio" name="soal17" value=5> Sangat Setuju</td>
                        </tr>
                         <tr>
                            <td colspan="5">18. Guru mengajarkan siswa mengambil keputusan sendiri dalam kegiatan belajar mengajar</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal18" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal18" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal18" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal18" value=4> Setuju</td>
                           <td><input type="radio" name="soal18" value=5> Sangat Setuju</td>
                        </tr>
                         <tr>
                            <td colspan="5"> 19. Siswa dapat bercerita atau mengeluh tentang masalahnya dengan guru</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal19" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal19" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal19" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal19" value=4> Setuju</td>
                           <td><input type="radio" name="soal19" value=5> Sangat Setuju</td>
                        </tr>
                         <tr>
                            <td colspan="5">20. Guru memberikan solusi untuk memecahkan masalah dengan cara yang mudah dipahami siswa</td>
                        </tr>
                        <tr>
                           <td><input type="radio" name="soal20" value=1 required> Sangat Tidak Setuju</td>
                           <td><input type="radio" name="soal20" value=2> Tidak Setuju</td>
                           <td><input type="radio" name="soal20" value=3> Tidak tahu</td>
                           <td><input type="radio" name="soal20" value=4> Setuju</td>
                           <td><input type="radio" name="soal20" value=5> Sangat Setuju</td>
                        </tr>
                    </table>
                    <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
                </div>                    
              </form>
           </div>
      </div>
    </div>
  </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <?php $this->load->view("siswa/_front/footer.php") ?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  
  <!-- /#wrapper -->
  <?php $this->load->view("siswa/_front/scrolltop.php") ?>
  <?php $this->load->view("siswa/_front/modal.php") ?>

  <?php $this->load->view("siswa/_front/js.php") ?>

  <script>
    function deleteConfirm(url){
      $('#btn-delete').attr('href', url);
      $('#deleteModal').modal();
  }
  </script>
</body>

</html>