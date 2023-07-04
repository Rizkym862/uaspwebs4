<div class="row">
	<div class="col-lg-2">
	</div>
	<div class="col-lg-8">
		<?php
		$nama=null;
		$att_form = array(
			'class' => 'form-control',
			'disabled' => 'disabled',
		);
		foreach ($data as $key => $value) {
			$nama[$key] = $value->nama;
		}
		?>
		<div class="table-responsive">
           <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
			<?php
			echo "<tr>
					<td>Nama</td>
					<td>$nama[0]</td>
					</tr>";
			foreach ($data as $key => $value) {
				echo "<tr>
						<td>$value->naker</td>
						<td>$value->nilai</td>
					</tr>";
			}
			?>
		</table>
	</div>
	</div>
	<div class="col-lg-2">
	</div>
</div>