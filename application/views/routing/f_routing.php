<html>
<?php if($this->session->userdata('alert') == "Sukses"){
            echo "<body onload='sukses()'>";
        }elseif ($this->session->userdata('alert') == "Gagal") {
            echo "<body onload='gagal()'>";
        }else{
            echo "<body>";
        };
unset($_SESSION['alert']);?>

        <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Kebutuhan</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Beranda'); ?>">Home</a></li>
                        <li class="breadcrumb-item">Kebutuhan</li>
                        <li class="breadcrumb-item">Routing</li>
                        <li class="breadcrumb-item active">Tambah Routing</li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>

            <div class="card mb-3" style="width: 39%; left: 30%;">
              <div class="card-header" align="left"><i class="mdi mdi-table"></i> Tambah Routing</div>
            <div class="card-body">
        <form class="form-material" method="POST" action="<?php echo site_url('Routing/Simpan'); ?>">
          <?php if ($this->session->userdata('trigger') == "Tambah"): ?>
            <div class="form-group">
              <label>Produk</label>
              <input type="text" name="nama_produk" value="<?php echo $produk2->nama_produk; ?>" class="form-control" readonly>
              <input type="text" name="kd_produk" value="<?php echo $produk2->kd_produk; ?>" class="form-control" hidden>
            </div>
            <?php echo form_error('kd_produk'); ?>
            <label style="padding-left: 10%;">Aktivitas</label><label style="padding-left: 22%;">Waktu</label><label style="padding-left: 9%;">Satuan</label>
            <?php foreach ($drouting as $data):?>
              <div class='form-inline'>
                <div class='form-group'>
                  <input type='text' value='<?php echo $data->nama_aktivitas?>' class='form-control' style="width: 200px" readonly>
                </div>&nbsp
                <div class='form-group'>
                  <input type='text' value='<?php echo $data->waktu?>' class='form-control' style="width: 80px;" readonly>
                </div>&nbsp
                <div class='form-group'>
                  <input type='text' value='<?php echo $data->satuan?>' class='form-control' style="width: 80px;" readonly>
                </div>
                &nbsp&nbsp<a href = "<?php echo site_url()."Routing/Hapus/".$data->kd_produk."/".$data->kd_aktivitas.""?>"><span style="font-size: 30px; color: red"><i class="fas fa-minus-circle"></i></span></a>
              </div>
            <?php endforeach;?>
            <div class='form-inline'>
                <div class="form-group">
                  <select name="kd_aktivitas" class="form-control" style="width: 200px" required>
                    <option disabled selected>--Pilih Aktivitas--</option>
                    <?php
                      foreach($aktivitas as $data){
                        echo "<option value=".$data['kd_aktivitas'].">".$data['nama_aktivitas']."</option>";
                      }
                    ?>
                  </select>
                </div>&nbsp
                <div class='form-group'>
                  <input type='text' name="waktu" class='form-control' style="width: 80px;" required>
                </div>
                <span style="font-size: 30px; color: blue; padding-left: 21%;"><i class="fas fa-plus-circle"></i></span>
              </div>
              <?php echo form_error('kd_aktivitas'); ?>
              <?php echo form_error('waktu'); ?>
          <?php else:?>
            <div class="form-group">
              <label>Produk:</label>
                  <select name="kd_produk" class="form-control" required>
                    <?php
                      foreach($produk3 as $data){
                        echo "<option value=".$data['kd_produk'].">".$data['nama_produk']."</option>";
                      }
                    ?>
                  </select>
                  <?php echo form_error('kd_produk'); ?>
              </div>
              <label style="padding-left: 10%;">Aktivitas</label><label style="padding-left: 22%;">Waktu</label><label style="padding-left: 8%;">Satuan</label>
            <div class='form-inline'>
                <div class="form-group">
                  <select name="kd_aktivitas" class="form-control" style="width: 200px" required>
                    <option disabled selected>--Pilih Aktivitas--</option>
                    <?php
                      foreach($aktivitas as $data){
                        echo "<option value=".$data['kd_aktivitas'].">".$data['nama_aktivitas']."</option>";
                      }
                    ?>
                  </select>
                </div>&nbsp
                <div class='form-group'>
                  <input type='text' name="waktu" class='form-control' style="width: 80px;" required>
                </div>
                <span style="font-size: 30px; color: blue; padding-left: 21%;"><i class="fas fa-plus-circle"></i></span>
              </div>
              <?php echo form_error('waktu'); ?>
            <?php endif;?><br><br>
            <button type="submit" name="trigger" value="tambah" class="btn btn-info">Tambah</button>
            <?php if ($this->session->userdata('trigger') == "Tambah"): ?>
              <?php if ($count == 0): ?>
            <a href = "#" role="button" class='btn btn-success'>Selesai</a>
            <?php else: ?>
              <a href = "<?php echo site_url()."Routing/Selesai/".$produk2->kd_produk.""?>" role="button" class='btn btn-success'>Selesai</a>
              <?php endif; ?>
              <div style="float: right;">
          <a href = "<?php echo site_url()."Routing/Tambah"?>" role="button" class='btn btn-warning'>Pilih Produk</a>
        </div>
          <?php endif;?>
        </form>
      </div>
    </div>
  </body>
</html>