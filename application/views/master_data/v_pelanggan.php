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
                        <li class="breadcrumb-item active">Pelanggan</li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>

    <a class="btn btn-info text-white" role="button" data-toggle="modal" data-target="#Tambah" style="margin-left: 2%"><i class="fa fa-fw fa-plus-circle"></i> Add Pelanggan</a><br><br>

    <!--Tabel-->
    <div align="center">
    <div class="card mb-3" style="width: 100%;">
        <div class="card-header" align="left"><i class="mdi mdi-table"></i> Data Pelanggan</div>
            <div class="card-body">
                 <h3 class="text-center">Pelanggan</h3>
                <div class="table-responsive">
                    <table class="table full-color-table full-muted-table hover-table" id="myTable" width="100%">
                        <thead class="thead-dark" style="text-align: center; background-color: lightblue;">
                            <tr>
                                <th>ID Pelanggan</th>
                                <th>Nama Pelanggan</th>
                                <th>No Telepon</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pelanggan as $data) { ?>
                                <tr>
                                    <td><?php echo $data->id_pelanggan; ?></td>
                                    <td><?php echo $data->nama_pelanggan; ?></td>
                                    <td><?php echo $data->no_telp; ?></td>
                                    <td><?php echo $data->email; ?></td>
                                    <td><?php echo $data->alamat; ?></td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Ubah<?php echo $data->id_pelanggan;?>"><i class="fa fa-fw fa-edit"></i>Ubah</button>
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
                            <h4 class="modal-title" id="merienda">Pelanggan</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form class="form-material" method="POST" action="<?php echo site_url('Pelanggan/Tambah'); ?>">
                                <div class="form-group">
                                    <label>ID Pelanggan</label>
                                    <input type="text" name="id_pelanggan" class="form-control" value="<?php echo $pk;?>" readonly><br>
                                </div>
                                <div class="form-group">
                                    <label>Nama Pelanggan</label>
                                    <input type="text" name="nama_pelanggan" class="form-control" placeholder="Masukkan Nama" minlength="1" maxlength="30" id="NamaPelanggan" required onkeyup="NamaPelangganValid();ValidationPelanggan()"><br>
                                    <span id="NamaPelangganError"></span>
                                    <?php echo form_error('nama_pelanggan'); ?>
                                </div>
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="text" name="no_telp" class="form-control" placeholder="Masukkan Nomor" minlength="11" maxlength="12" id="NoTelp" required onkeyup="NoTelpValid();ValidationPelanggan()"><br>
                                    <span id="NoTelpError"></span>
                                    <?php echo form_error('no_telp'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Masukkan Email" id="Email" required onkeyup="EmailValid();ValidationPelanggan()"><br>
                                    <span id="EmailError"></span>
                                    <?php echo form_error('email'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" minlength="10" id="Alamat" required onkeyup="AlamatValid();ValidationPelanggan()"></textarea><br>
                                    <span id="AlamatError"></span>
                                    <?php echo form_error('alamat'); ?>
                                </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="TambahPelanggan"><i class="fa fa-save"></i> Simpan Pelanggan</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal Ubah -->
            <?php foreach ($pelanggan as $data) { ?>
            <div class="modal fade" id="Ubah<?php echo $data->id_pelanggan;?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="merienda">Ubah Pelanggan</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form class="form-material" method="POST" action="<?php echo site_url('Pelanggan/Ubah'); ?>">
                                <div class="form-group">
                                    <label>ID Pelanggan</label>
                                    <input type="text" name="id_pelanggan_u" class="form-control" value="<?php echo $data->id_pelanggan; ?>" readonly><br>
                                </div>
                                <div class="form-group">
                                    <label>Nama Pelanggan</label>
                                    <input type="text" name="nama_pelanggan_u" class="form-control" value="<?php echo $data->nama_pelanggan; ?>" minlength="1" maxlength="30" required><br>
                                    <?php echo form_error('nama_pelanggan_u'); ?>
                                </div>
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="text" name="no_telp_u" class="form-control" value="<?php echo $data->no_telp; ?>" minlength="11" maxlength="12" required><br>
                                    <?php echo form_error('no_telp_u'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email_u" class="form-control" value="<?php echo $data->email; ?>" required><br>
                                    <?php echo form_error('email_u'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat_u" class="form-control" minlength="10" required ><?php echo $data->alamat; ?></textarea><br>
                                    <?php echo form_error('alamat_u'); ?>
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
            <?php foreach ($pelanggan as $data) { ?>
                <div id="Hapus<?php echo $data->id_pelanggan;?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title" id="merienda">Pelanggan</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <p>Hapus Data?</p>
                            </div>

                            <div class="modal-footer">
                                <a href="<?php echo site_url('Pelanggan/Hapus/'.$data->id_pelanggan.''); ?>" role="button" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i>Hapus</a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </body>
        </html>