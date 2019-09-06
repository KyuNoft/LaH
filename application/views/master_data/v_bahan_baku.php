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
                        <li class="breadcrumb-item active">Bahan Baku</li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>

    <a class="btn btn-info text-white" role="button" data-toggle="modal" data-target="#Tambah" style="margin-left: 10%"><i class="fa fa-fw fa-plus-circle"></i> Add Bahan Baku</a><br><br>

    <!--Tabel-->
    <div align="center">
    <div class="card mb-3" style="width: 82%;">
        <div class="card-header" align="left"><i class="mdi mdi-table"></i> Data Bahan Baku</div>
            <div class="card-body">
                <h3 class="text-center">Bahan Baku</h3>
                <div class="table-responsive">
                    <table class="table full-color-table full-muted-table hover-table" id="myTable" width="100%">
                        <thead class="thead-dark" style="text-align: center; background-color: lightblue;">
                            <tr>
                                <th>Kode Bahan Baku</th>
                                <th>Nama Bahan Baku</th>
                                <th>Jenis Bahan Baku</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bahan_baku as $data) { ?>
                                <tr>
                                    <td><?php echo $data->kd_bahan_baku; ?></td>
                                    <td><?php echo $data->nama_bahan_baku; ?></td>
                                    <td><?php echo $data->jenis_bahan_baku; ?></td>
                                    <td><?php echo $data->satuan; ?></td>
                                    <td><?php echo format_rp($data->harga); ?></td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Ubah<?php echo $data->kd_bahan_baku;?>"><i class="fa fa-fw fa-edit"></i>Ubah</button>
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
                            <h4 class="modal-title" id="merienda">Bahan Baku</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form class="form-material" method="POST" action="<?php echo site_url('BahanBaku/Tambah'); ?>">
                                <div class="form-group">
                                    <label>Kode Bahan Baku</label>
                                    <input type="text" name="kd_bahan_baku" class="form-control" value="<?php echo $pk;?>" readonly><br>
                                </div>
                                <div class="form-group">
                                    <label>Nama Bahan Baku</label>
                                    <input type="text" name="nama_bahan_baku" class="form-control" placeholder="Masukkan Nama Bahan" minlength="1" maxlength="20" id="NamaBahanBaku" required onkeyup="NamaBahanBakuValid();ValidationBahanBaku()"><br>
                                    <span id="NamaBahanBakuError"></span>
                                    <?php echo form_error('nama_bahan_baku'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Bahan Baku</label>
                                    <select name="jenis_bahan_baku" class="form-control">
                                        <option value="Utama">Utama</option>
                                        <option value="Penolong">Penolong</option>
                                    </select><br>
                                </div>
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" name="satuan" class="form-control" placeholder="Masukkan Satuan" minlength="1" maxlength="10" id="Satuan" required onkeyup="SatuanValid();ValidationBahanBaku()"><br>
                                    <span id="SatuanError"></span>
                                    <?php echo form_error('satuan'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" name="harga" class="form-control" placeholder="Masukkan Harga" id="Harga" required onkeyup="HargaValid();ValidationBahanBaku()"><br>
                                    <span id="HargaError"></span>
                                    <?php echo form_error('harga'); ?>
                                </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="TambahBahanBaku"><i class="fa fa-save"></i> Simpan Bahan Baku</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal Ubah -->
            <?php foreach ($bahan_baku as $data) { ?>
            <div class="modal fade" id="Ubah<?php echo $data->kd_bahan_baku;?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="merienda">Ubah Bahan Baku</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form class="form-material" method="POST" action="<?php echo site_url('BahanBaku/Ubah'); ?>">
                                <div class="form-group">
                                    <label>Kode Bahan Baku</label>
                                    <input type="text" name="kd_bahan_baku_u" class="form-control" value="<?php echo $data->kd_bahan_baku; ?>" readonly><br>
                                </div>
                                <div class="form-group">
                                    <label>Nama Bahan Baku</label>
                                    <input type="text" name="nama_bahan_baku_u" class="form-control" value="<?php echo $data->nama_bahan_baku; ?>" minlength="1" maxlength="20" required><br>
                                    <?php echo form_error('nama_bahan_baku_u'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Bahan Baku</label>
                                    <select name="jenis_bahan_baku_u" class="form-control">
                                        <option value="Utama">Utama</option>
                                        <option value="Penolong">Penolong</option>
                                    </select><br>
                                </div>
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" name="satuan_u" class="form-control" value="<?php echo $data->satuan; ?>" minlength="1" maxlength="10" required><br>
                                    <?php echo form_error('satuan_u'); ?>
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
</body>
</html>