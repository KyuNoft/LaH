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
                        <li class="breadcrumb-item active">Mesin</li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>

    <a class="btn btn-info text-white" role="button" data-toggle="modal" data-target="#Tambah" style="margin-left: 24%"><i class="fa fa-fw fa-plus-circle"></i> Add Mesin</a><br><br>

    <!--Tabel-->
    <div align="center">
    <div class="card mb-3" style="width: 55%;">
        <div class="card-header" align="left"><i class="mdi mdi-table"></i> Data Mesin</div>
            <div class="card-body">
                <h3 class="text-center">Mesin</h3>
                <div class="table-responsive">
                    <table class="table full-color-table full-muted-table hover-table" id="myTable" width="100%">
                        <thead class="thead-dark" style="text-align: center; background-color: lightblue;">
                            <tr>
                                <th>Kode Mesin</th>
                                <th>Nama Mesin</th>
                                <th>Satuan</th>
                                <th>Tarif</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mesin as $data) { ?>
                                <tr>
                                    <td><?php echo $data->kd_mesin; ?></td>
                                    <td><?php echo $data->nama_mesin; ?></td>
                                    <td><?php echo $data->satuan; ?></td>
                                    <td><?php echo format_rp($data->tarif); ?></td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Ubah<?php echo $data->kd_mesin;?>"><i class="fa fa-fw fa-edit"></i>Ubah</button>
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
                            <h4 class="modal-title" id="merienda">Mesin</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form class="form-material" method="POST" action="<?php echo site_url('Mesin/Tambah'); ?>">
                                <div class="form-group">
                                    <label>Kode Mesin</label>
                                    <input type="text" name="kd_mesin" class="form-control" value="<?php echo $pk;?>" readonly><br>
                                </div>
                                <div class="form-group">
                                    <label>Nama Mesin</label>
                                    <input type="text" name="nama_mesin" class="form-control" placeholder="Masukkan Nama Mesin" minlength="1" maxlength="20" id="NamaMesin" required onkeyup="NamaMesinValid();ValidationMesin()"><br>
                                    <span id="NamaMesinError"></span>
                                    <?php echo form_error('nama_mesin'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" name="satuan" class="form-control" value="Menit" readonly><br>
                                </div>
                                <div class="form-group">
                                    <label>Tarif</label>
                                    <input type="text" name="tarif" class="form-control" placeholder="Masukkan Tarif" id="Tarif" required onkeyup="TarifValid();ValidationMesin()"><br>
                                    <span id="TarifError"></span>
                                    <?php echo form_error('tarif'); ?>
                                </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="TambahMesin"><i class="fa fa-save"></i> Simpan Mesin</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal Ubah -->
            <?php foreach ($mesin as $data) { ?>
            <div class="modal fade" id="Ubah<?php echo $data->kd_mesin;?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="merienda">Ubah Mesin</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form class="form-material" method="POST" action="<?php echo site_url('Mesin/Ubah'); ?>">
                                <div class="form-group">
                                    <label>Kode Mesin</label>
                                    <input type="text" name="kd_mesin_u" class="form-control" value="<?php echo $data->kd_mesin; ?>" readonly><br>
                                </div>
                                <div class="form-group">
                                    <label>Nama Mesin</label>
                                    <input type="text" name="nama_mesin_u" class="form-control" value="<?php echo $data->nama_mesin; ?>" minlength="1" maxlength="20" required><br>
                                    <?php echo form_error('nama_mesin_u'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" name="satuan_u" class="form-control" value="<?php echo $data->satuan; ?>" readonly><br>
                                </div>
                                <div class="form-group">
                                    <label>Tarif</label>
                                    <input type="text" name="tarif_u" class="form-control" value="<?php echo $data->tarif; ?>" required><br>
                                    <?php echo form_error('tarif_u'); ?>
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
            <?php foreach ($mesin as $data) { ?>
                <div id="Hapus<?php echo $data->kd_mesin;?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title" id="merienda">Mesin</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <p>Hapus Data?</p>
                            </div>

                            <div class="modal-footer">
                                <a href="<?php echo site_url('Mesin/Hapus/'.$data->kd_mesin.''); ?>" role="button" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i>Hapus</a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </body>
        </html>