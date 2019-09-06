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
                        <li class="breadcrumb-item active">Akun</li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>

    <a class="btn btn-info text-white" role="button" data-toggle="modal" data-target="#Tambah" style="margin-left: 19%"><i class="fa fa-fw fa-plus-circle"></i> Add Akun</a><br><br>

    <!--Tabel-->
    <div align="center">
    <div class="card mb-3" style="width: 64%;">
        <div class="card-header" align="left"><i class="mdi mdi-table"></i> Data Akun</div>
            <div class="card-body">
                <h3 class="text-center">Akun</h3>
                <div class="table-responsive">
                    <table class="table full-color-table full-muted-table hover-table" id="myTable" width="100%">
                        <thead class="thead-dark" style="text-align: center; background-color: lightblue;">
                            <tr>
                                <th>No Akun</th>
                                <th>Nama Akun</th>
                                <th>Header Akun</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($akun as $data) { ?>
                                <tr>
                                    <td><?php echo $data->no_akun; ?></td>
                                    <td><?php echo $data->nama_akun; ?></td>
                                    <td><?php echo $data->header_akun; ?></td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Ubah<?php echo $data->no_akun;?>"><i class="fa fa-fw fa-edit"></i>Ubah</button>
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
                            <h4 class="modal-title" id="merienda">Akun</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form class="form-material" class="form-material" method="POST" action="<?php echo site_url('Akun/Tambah'); ?>">
                                <div class="form-group">
                                    <label>No Akun</label>
                                    <input type="text" name="no_akun" class="form-control" minlength="3" maxlength="3" placeholder="Masukkan No Akun" id="NoAkun" required onkeyup="NoAkunValid();ValidationAkun()"><br>
                                    <span id="NoAkunError"></span>
                                    <?php echo form_error('no_akun'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Nama Akun</label>
                                    <input type="text" name="nama_akun" class="form-control form-control-line" minlength="1" maxlength="40" placeholder="Masukkan Nama Akun" id="NamaAkun" required onkeyup="NamaAkunValid();ValidationAkun()"><br>
                                    <span id="NamaAkunError"></span>
                                    <?php echo form_error('nama_akun'); ?>
                                </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="TambahAkun"><i class="fa fa-save"></i> Simpan Akun</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal Ubah -->
            <?php foreach ($akun as $data) { ?>
            <div class="modal fade" id="Ubah<?php echo $data->no_akun;?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="merienda">Ubah Akun</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form class="form-material" method="POST" action="<?php echo site_url('Akun/Ubah'); ?>">
                                <div class="form-group">
                                    <label>No Akun</label>
                                    <input type="text" name="no_akun_u" class="form-control form-control-line" value="<?php echo $data->no_akun; ?>" readonly><br>
                                </div>
                                <div class="form-group">
                                    <label>Nama Akun</label>
                                    <input type="text" name="nama_akun_u" class="form-control form-control-line" minlength="1" maxlength="40" id="NamaAkun_U" required value="<?php echo $data->nama_akun; ?>"><br>
                                    <?php echo form_error('nama_akun_u'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Header</label>
                                    <input type="text" name="header_akun_u" class="form-control form-control-line" value="<?php echo $data->header_akun; ?>" readonly><br>
                                </div>
                                <span id="Test"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" id="UbahAkun"><i class="fa fa-edit"></i> Ubah</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <?php } ?>

            <!-- Modal Hapus -->
            <?php foreach ($akun as $data) { ?>
                <div id="Hapus<?php echo $data->no_akun;?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title" id="merienda">Akun</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <p>Hapus Data?</p>
                            </div>

                            <div class="modal-footer">
                                <a href="<?php echo site_url('Akun/Hapus/'.$data->no_akun.''); ?>" role="button" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i>Hapus</a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </body>
        </html>