<!-- Modal Edit Nilai -->
<!--<div class="row">
  <div class="col-xs-12 col-md-12">
    <?php

    /* $attributes = array(
      'class' => 'form-control',
      'type' => 'number',
      'max' => '100',
      'min' => '0',
    );

    echo '<form method="post" action="admin/nilai_awal/update_nilai_awal">'
    echo "<table class='table table-striped'>";
    echo "<tr>
        <td>Nama</td>
        <td><input type='hidden' name='nip' value='$id'>$nama</td>
      </tr>";
    foreach ($kriteria as $key => $value) {
      echo "<tr>
          <td>$value->nama</td>";
      echo '<td><input type="number" name="nilai[]" value="$nilai[$key]" class="form-control" max="100" min="0"></td>';
          #echo "<td><input type=</td>";
      echo "</tr>"; */

      /*$this->form_label($value->nama, $nama);
      $this->form_input('nilai', 'value', $attributes);*/
    }
    /*echo "</table>";
    echo "<input type='submit' class='btn btn-danger' value='Ubah'>";
    echo "</form>";*/
    ?>
  </div>
</div> -->

<div class="row">
  <div class="col-lg-2">
  </div>
  <div class="col-lg-8">
    <?php
    $nama=null;
    ?>
    <form method="post" action="admin/nilai_awal/update_nilai_awal">
    <div class="table-responsive">
           <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
      <?php
      echo "<tr>
          <td>Nama</td>
          <td><input type='hidden' name='nip' value='$id'>$nama</td>
          </tr>";
          foreach ($kriteria as $key => $value) {
            echo "<tr>
                <td>$value->nama</td>";
            echo '<td><input type="number" name="nilai[]" value="$nilai[$key]" class="form-control" max="100" min="0"></td>';
                #echo "<td><input type=</td>";
            echo "</tr>";
      }
      ?>
    </table>
      <?php
        echo "<input type='submit' class='btn btn-danger' value='Ubah'>";
      ?>
  </form>
  </div>
  </div>
  <div class="col-lg-2">
  </div>
</div>