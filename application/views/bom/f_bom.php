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
                        <li class="breadcrumb-item">Bill of Material</li>
                        <li class="breadcrumb-item active">Tambah Bill of Material</li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>

            <div class="card mb-3" style="width: 42%; left: 30%;">
              <div class="card-header" align="left"><i class="mdi mdi-table"></i> Tambah Bill of Material</div>
            <div class="card-body">
        <form class="form-material" method="POST" action="<?php echo site_url('BOM/Simpan'); ?>">
          <?php if ($this->session->userdata('trigger') == "Tambah"): ?>
            <div class="form-group">
              <label>Produk</label>
              <input type="text" name="nama_produk" value="<?php echo $produk2->nama_produk; ?>" class="form-control" readonly>
              <input type="text" name="kd_produk" value="<?php echo $produk2->kd_produk; ?>" class="form-control" hidden>
            </div>
            <?php echo form_error('kd_produk'); ?>
            <label style="padding-left: 10%;">Bahan</label><label style="padding-left: 22%;">Kuantitas</label><label style="padding-left: 8%;">Satuan</label>
            <?php foreach ($dbom as $data):?>
              <div class='form-inline'>
                <div class='form-group'>
                  <input type='text' value='<?php echo $data->nama_bahan_baku?>' class='form-control' style="width: 200px" readonly>
                </div>&nbsp
                <div class='form-group'>
                  <input type='text' value='<?php echo $data->kuantitas?>' class='form-control' style="width: 100px;" readonly>
                </div>&nbsp
                <div class='form-group'>
                  <input type='text' value='<?php echo $data->satuan?>' class='form-control' style="width: 80px;" readonly>
                </div>
                &nbsp&nbsp<a href = "<?php echo site_url()."BOM/Hapus/".$data->kd_produk."/".$data->kd_bahan_baku.""?>"><span style="font-size: 30px; color: red"><i class="fas fa-minus-circle"></i></span></a>
              </div>
            <?php endforeach;?>
            <div class='form-inline'>
                <div class="form-group">
                  <select name="kd_bahan_baku" class="form-control" style="width: 200px" required>
                    <option disabled selected>--Pilih Bahan--</option>
                    <?php
                      foreach($bahan_baku as $data){
                        echo "<option value=".$data['kd_bahan_baku'].">".$data['nama_bahan_baku']."</option>";
                      }
                    ?>
                  </select>
                </div>&nbsp
                <div class='form-group'>
                  <input type='text' name="kuantitas" class='form-control' style="width: 100px;" required>
                </div>
                <span style="font-size: 30px; color: blue; padding-left: 19%;"><i class="fas fa-plus-circle"></i></span>
              </div>
              <?php echo form_error('kd_bahan_baku'); ?>
              <?php echo form_error('kuantitas'); ?>
          <?php else:?>
            <div class="form-group">
              <label>Produk:</label>
                  <select name="kd_produk" class="form-control" required>
                    <?php
                      foreach($produk as $data){
                        echo "<option value=".$data['kd_produk'].">".$data['nama_produk']."</option>";
                      }
                    ?>
                  </select>
                  <?php echo form_error('kd_produk'); ?>
              </div>
              <label style="padding-left: 10%;">Bahan</label><label style="padding-left: 22%;">Kuantitas</label><label style="padding-left: 8%;">Satuan</label>
            <div class='form-inline'>
                <div class="form-group">
                  <select name="kd_bahan_baku" class="form-control" style="width: 200px" required>
                    <option disabled selected>--Pilih Bahan--</option>
                    <?php
                      foreach($bahan_baku as $data){
                        echo "<option value=".$data['kd_bahan_baku'].">".$data['nama_bahan_baku']."</option>";
                      }
                    ?>
                  </select>
                </div>&nbsp
                <div class='form-group'>
                  <input type='text' name="kuantitas" class='form-control' style="width: 100px;" required>
                </div>
                <span style="font-size: 30px; color: blue; padding-left: 19%;"><i class="fas fa-plus-circle"></i></span>
              </div>
              <?php echo form_error('kuantitas'); ?>
            <?php endif;?><br><br>
            <button type="submit" name="trigger" value="tambah" class="btn btn-info">Tambah</button>
            <?php if ($this->session->userdata('trigger') == "Tambah"): ?>
              <?php if ($count == 0): ?>
            <a href = "#" role="button" class='btn btn-success'>Selesai</a>
            <?php else: ?>
              <a href = "<?php echo site_url()."BOM/Selesai/".$produk2->kd_produk.""?>" role="button" class='btn btn-success'>Selesai</a>
              <?php endif; ?>
              <div style="float: right;">
          <a href = "<?php echo site_url()."BOM/Tambah"?>" role="button" class='btn btn-warning'>Pilih Produk</a>
        </div>
          <?php endif;?>
        </form>
      </div>
    </div>
  </body>
</html>