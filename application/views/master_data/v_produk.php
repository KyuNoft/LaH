<html>
<?php if($this->session->userdata('alert') == "Sukses"){
            echo "<body onload='sukses()'>";
        }elseif ($this->session->userdata('alert') == "Gagal") {
            echo "<body onload='gagal()'>";
        }elseif ($this->session->userdata('alert') == "GagalU") {
            $id = $this->session->userdata('id');
            echo "<span id='id' hidden>$id</span>";
            echo "<body onload='gagal_u()'>";
        }else{
            echo "<body>";
        };
        unset($_SESSION['alert']);
        unset($_SESSION['id']);
?>
    <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Master Data</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Beranda'); ?>">Home</a></li>
                        <li class="breadcrumb-item">Master Data</li>
                        <li class="breadcrumb-item active">Produk</li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>

    <a class="btn btn-info text-white" role="button" data-toggle="modal" data-target="#Tambah" style="margin-left: 19%"><i class="fa fa-fw fa-plus-circle"></i> Add Produk</a><br><br>

    <!--Tabel-->
    <div align="center">
    <div class="card mb-3" style="width: 65%;">
        <div class="card-header" align="left"><i class="mdi mdi-table"></i> Data Produk</div>
            <div class="card-body">
                <h3 class="text-center">Produk</h3>
                <div class="table-responsive">
                    <table class="table full-color-table full-muted-table hover-table" id="myTable" width="100%">
                        <thead class="thead-dark" style="text-align: center; background-color: lightblue;">
                            <tr>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produk as $data) { ?>
                                <tr>
                                    <td><?php echo $data->kd_produk; ?></td>
                                    <td><?php echo $data->nama_produk; ?></td>
                                    <td><?php echo $data->satuan; ?></td>
                                    <td><?php echo format_rp($data->harga); ?></td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Ubah<?php echo $data->kd_produk;?>"><i class="fa fa-fw fa-edit"></i>Ubah</button>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted"><?php date_default_timezone_set("Asia/Jakarta");
                echo "Updated ".date("Y-m-d")." ".date("h:i:sa"); ?></div>
            </div>
        </div>

            <!-- Modal Tambah -->
            <div class="modal fade" id="Tambah">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="merienda">Produk</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form class="form-material" method="POST" action="<?php echo site_url('Produk/Tambah'); ?>">
                                <div class="form-group">
                                    <label>Kode Produk</label>
                                    <input type="text" name="kd_produk" class="form-control" value="<?php echo $pk;?>" readonly><br>
                                </div>
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <input type="text" name="nama_produk" class="form-control" placeholder="Masukkan Nama Produk" minlength="1" maxlength="20" id="NamaProduk" required onkeyup="NamaProdukValid();ValidationProduk()"><br>
                                    <span id="NamaProdukError"></span>
                                    <?php echo form_error('nama_produk'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" name="satuan" class="form-control" value="pcs" readonly><br>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" name="harga" class="form-control" placeholder="Masukkan Harga" id="Harga" required onkeyup="HargaValid();ValidationProduk()"><br>
                                    <span id="HargaError"></span>
                                    <?php echo form_error('harga'); ?>
                                </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="TambahProduk"><i class="fa fa-save"></i> Simpan Produk</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal Ubah -->
            <?php foreach ($produk as $data) { ?>
            <div class="modal fade" id="Ubah<?php echo $data->kd_produk;?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="merienda">Ubah Produk</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form class="form-material" method="POST" action="<?php echo site_url('Produk/Ubah'); ?>">
                                <div class="form-group">
                                    <label>Kode Produk</label>
                                    <input type="text" name="kd_produk_u" class="form-control" value="<?php echo $data->kd_produk; ?>" readonly><br>
                                </div>
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <input type="text" name="nama_produk_u" class="form-control" value="<?php echo $data->nama_produk; ?>" minlength="1" maxlength="20" required><br>
                                    <?php echo form_error('nama_produk_u'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" name="satuan_u" class="form-control" value="<?php echo $data->satuan; ?>" readonly><br>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" name="harga_u" class="form-control" value="<?php echo $data->harga; ?>" required><br>
                                    <?php echo form_error('harga_u'); ?>
                                </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" id="boo"><i class="fa fa-edit"></i> Ubah</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <?php } ?>

            <!-- Modal Hapus -->
            <?php foreach ($produk as $data) { ?>
                <div id="Hapus<?php echo $data->kd_produk;?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title" id="merienda">Produk</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <p>Hapus Data?</p>
                            </div>

                            <div class="modal-footer">
                                <a href="<?php echo site_url('Produk/Hapus/'.$data->kd_produk.''); ?>" role="button" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i>Hapus</a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </body>
        </html>