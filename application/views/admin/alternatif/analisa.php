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
          <div class="card-body">

            <div class="table-responsive">
              <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  	<tr>
                  		<th>Detail</th>
	                  	<th>No</th>
	                    <th>Nip</th>
	                    <th>Nama</th>
	                    <th>Nilai</th>
	                    <th>Keterangan</th>
                	</tr>
                </thead>
                <tbody>
						<?php
							if(count($nilai) > 0){
								foreach ($nilai as $key => $value) {
								$key = $key + 1;
						?>
				 	<tr>
						<td class="text-center">
							<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalNilaiDetail" data-id="<?php echo $value->id ?>"><span class="fa fa-eye" aria-hidden="true"></span></button>
						</td>
						<td>
							<?php echo $key ?>
						</td>
						<td>
							<?php echo $value->nip ?>
						</td>
						<td>
							<?php echo $value->nama ?>
						</td>
						<td>
							<?php echo $value->nilai ?>
								
						</td>
						<td>
							<?php echo $value->keterangan ?>		
						</td>
					</tr>	
						<?php				
								}	
							}
						?>
				</tbody>
                <tfoot>
                  <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>

		<div class="panel panel-default">
			<div class="panel-body">
				<form method="post" action="<?php echo site_url('admin/alternatif/perbandingan_alternatif_single');?>">
					<div class="row">
					<div class="col-xs-12 col-md-3">
						<div class="form-group">
							<p style="padding:10px 0;"><label>Pilih Kriteria</label></p>
						</div>
					</div>
						<div class="col-xs-12 col-md-9">
							<div class="form-group">
							<select name="kriteria" class="form-control" onclick="get_kriteria()" id="kriteria">
							<?php
								foreach ($kriteria as $key => $value) {
									echo '<option value="'.$value->id_kriteria.'">'.$value->nama.'</option>';
								}
							?>
							</select>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-xs-12 col-md-3">
							<div class="form-group">
								<label>Kriteria Pertama</label>
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<label>Penilaian</label>
							</div>
						</div>
						<div class="col-xs-12 col-md-3">
							<div class="form-group">
								<label>Kriteria Kedua</label>
							</div>
						</div>
					</div>
						<div id="bobot"></div>
							<button type="submit" class="btn btn-small bg-danger text-white">Selanjutnya &nbsp;<span class="fa fa-arrow-rfbobight"></span></button><br><br>
						
				</form>			
					</div>
				</div>
			</div>

<div class="modal fade" id="myModalalt" tabindex="-1" role="dialog" aria-labelledby="myModalLabelalt">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabelalt">Pilih Kriteria</h4>
			</div>
			<div class="modal-body">
				<div class="list-group">
				
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalNilaiDetail" tabindex="-1" role="dialog" aria-labelledby="modalNilaiDetailLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalNilaiDetailLabel">Nilai Detail</h4>
			</div>

			<div class="fetched-data"></div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
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

<?php $this->load->view("admin/_front/js.php") ?>

<script type="text/javascript">
	function get_kriteria(){
		var id = $("#kriteria").val();
		$.ajax({
			type 	: "POST",
			url 	: "<?php echo base_url('admin/alternatif/get_kriteria');?>",
			data 	: "kriteria="+id,
				success:function(msg){
					$("#bobot").html(msg);
				}
			});
	}

	$(document).ready(function(){
	    $('#modalNilaiDetail').on('show.bs.modal', function(e){
	        var rowid = $(e.relatedTarget).data('id');
	            //ambil data
	        $.ajax({
	            type :'POST',
	            url : '<?php echo site_url('admin/alternatif/nilai_detail');?>',
	            data : 'rowid='+rowid,
	            success : function(data){
	               $('.fetched-data').html(data);//tampil data di modal.
	             }

	            });
	        });
	    });
	</script>

</body>

</html>