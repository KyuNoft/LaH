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
                    <h3 class="text-themecolor">Pemesanan</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Beranda'); ?>">Home</a></li>
                        <li class="breadcrumb-item">Pemesanan</li>
                        <li class="breadcrumb-item active">Tambah Pesanan</li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>

            <div class="alert alert-info alert-rounded" style="width: 35%">Produksi Untuk Pesanan <?php echo $pk ?><br>Tanggal Pesanan: <?php echo date('Y-m-d') ?><br>Perkiraan Mulai Produksi: <?php if($tglterakhir > date('Y-m-d')){
                echo $tglterakhir;
            }elseif($tglterakhir <= date('Y-m-d') OR $jmltgl != 0){
                $tgl = date('Y-m-d', strtotime(date('Y-m-d').' + 1day'));
                if(date_format(date_create($tgl), "D") == "Sun"){
                    echo date('Y-m-d', strtotime(date('Y-m-d').' + 2day'));
                }else{
                    echo date('Y-m-d', strtotime(date('Y-m-d').' + 1day'));
                }
            }?></div>

        <div class="card mb-3" style="width: 35%;">
              <div class="card-header" align="left"><i class="mdi mdi-table"></i> Tambah Pesanan</div>
            <div class="card-body">
        <form class="form-material" method="POST" action="<?php echo site_url('Pesanan/TambahDetail'); ?>">
            <div class="form-group">
              <label>Kode Pesanan</label>
              <input type="text" name="pk" value="<?php echo $pk; ?>" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>Produk</label>
              <select name="kd_produk" class="form-control" required>
                <option value="" selected disabled>- Pilih Produk -</option>
                <?php
                    foreach($produk as $data){
                        echo "<option value=".$data['kd_produk'].">".$data['nama_produk']."</option>";
                    }
                ?>
              </select>
              <?php echo form_error('kd_produk'); ?>
            </div>
            <div class="form-group">
              <label>Jumlah</label>
              <div style="width: 20%">
              <input type="number" name="jumlah" class="form-control" required><br>
          </div>
              <?php echo form_error('jumlah'); ?>
            </div>
            <div align="center">
            <button type="submit" class="btn btn-default btn-info">Tambah Produk</button>
            </div>
        </form>
    </div>
</div>
        
        <div class="card mb-3" style="position: absolute; width: 55%; left: 42%; top: 23%; overflow-y: auto;">
              <div class="card-header" align="left"><i class="mdi mdi-table"></i> Tambah Pesanan</div>
            <div class="card-body">
        <h3 class="text-center">Daftar Produk</h3>
        <table class='table table-bordered'>
            <tr style="text-align: center; background-color: lightgray">
                <td>Nama Produk</td>
                <td>Jumlah</td>
                <td>Harga</td>
                <td>Subtotal</td>
            </tr>
            <?php
            $total = 0;
                foreach($detail as $data){
                    echo "
                        <tr>
                            <td>".$data['nama_produk']."</td>
                            <td align='right'>".$data['jumlah']."</td>
                            <td align='right'>".format_rp($data['harga'])."</td>
                            <td align='right'>".format_rp($data['subtotal'])."</td>
                        </tr>
                    ";
                    $total=$total + $data['subtotal'];
                }
            ?>
        </table>

        <form class="form-material" method="POST" action="<?php echo site_url('Pesanan/Selesai'); ?>">
        <div class="form-group">
              <label>Pelanggan</label>
              <select name="id_pelanggan" class="form-control" required>
                <option value="" selected disabled>- Pilih Pelanggan -</option>
                <?php
                    foreach($pelanggan as $data){
                        echo "<option value=".$data['id_pelanggan'].">".$data['nama_pelanggan']."</option>";
                    }
                ?>
              </select>
            </div>
            <input type="text" name="pk" value="<?php echo $pk; ?>" class="form-control" hidden>
            <input type="text" name="total" value="<?php echo $total; ?>" class="form-control" hidden>
            <div align="center">
            <?php if($detail == NULL) : ?>
            <button type="submit" class="btn btn-default btn-success" disabled>Selesai</button>
            <?php else : ?>
            <button type="submit" class="btn btn-default btn-success">Selesai</button>
            <?php endif; ?>
            </div>
          </form>
      </div>
  </div>
    </body>
</html>