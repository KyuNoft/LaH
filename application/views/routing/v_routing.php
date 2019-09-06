<html>
<?php if($this->session->userdata('detail') == "Detail"){
            echo "<body onload='modaldetail()'>";
        }else{
            echo "<body>";
        };?>
    <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Kebutuhan</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Beranda'); ?>">Home</a></li>
                        <li class="breadcrumb-item">Kebutuhan</li>
                        <li class="breadcrumb-item active">Routing</li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>

    <a href="<?php echo site_url('Routing/Tambah'); ?>" role="button" class="btn btn-rounded btn-info" style="margin-left: 30%"><i class="fa fa-fw fa-plus-circle"></i>Tambah</a><br><br>

    <!--Tabel-->
    <div align="center">
    <div class="card mb-3" style="width: 40%;">
        <div class="card-header" align="left"><i class="mdi mdi-table"></i> Data Routing</div>
            <div class="card-body">
                <h3 class="text-center">Routing</h3><br>
                <div class="table-responsive">
                    <table class="table table-success hover-table" id="dataTable" width="100%">
                        <thead style="text-align: center; background-color: #1976D3;">
                            <tr style="color: white">
                                <th>Produk</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($nama as $data) { ?>
                                <tr>
                                    <td><?php echo $data->nama_produk; ?></td>
                                    <td style="text-align: center;">
                                    <form method="POST" action="<?php echo site_url('Routing'); ?>">
                                    <input type="text" name="nama_produk" value="<?php echo $data->nama_produk; ?>" class="form-control" hidden>
                                    <button type="submit" name="detail" value="detail" class="btn btn-rounded btn-warning"><i class="fas fa-info"></i> Detail</button>
                                </form>
                                    </td>
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

            <!-- Modal Detail -->
            <?php if($this->session->userdata('detail') == "Detail"):?>
            <?php foreach ($routing as $data):?>
            <div id="ModalDetail" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">Routing <?php echo $data->nama_produk;?></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Bahan</th>
                                        <th>Waktu</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($routing as $data):?>
                                        <tr>
                                            <td><?php echo $data->nama_aktivitas; ?></td>
                                            <td><?php echo $data->waktu; ?></td>
                                            <td><?php echo $data->satuan; ?></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>

                        <div class="modal-footer">
                        </div>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif;?>
            <?php unset($_SESSION['detail']); ?>
        </body>
        </html>