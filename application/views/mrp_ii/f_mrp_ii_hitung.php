<html>
<body>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Manufacturing Resource Planning II</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('Beranda'); ?>">Home</a></li>
                <li class="breadcrumb-item">MRP II</li>
                <li class="breadcrumb-item active">Hitung Biaya</li>
            </ol>
        </div>
        <div>
            <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
        </div>
    </div>

    <div class="card mb-3" style="width: 20%;">
        <div class="card-header" align="left"><i class="mdi mdi-table"></i> Tanggal Produksi</div>
        <form class="form-material" method="POST" action="<?php echo site_url('MRPII/Hitung'); ?>">
            <div style="padding: 3%;">
            <div class="form-group">
                <label>Pilih Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
                </div>
                </select>
            </div>
            <div align="center" style="padding-bottom: 2%;">
                <button type="submit" class="btn btn-default btn-info"><i class="fas fa-search"></i> Pilih</button>
            </div>
        </div>
        </form>
    </div>

    <?php if(isset($_POST['tanggal'])) :
        $t     = date_format(date_create($_POST['tanggal']), "d");
        $bulan = date_format(date_create($_POST['tanggal']), "m");
        ?>
    <div class="card">
        <div class="card-header" align="left"><i class="mdi mdi-table"></i> Detail Biaya</div>
        <div class="card-body">
            <h1 class="text-center">Hitung Biaya</h1><br>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sorter">
                    <thead>
                        <tr>
                            <td>Bulan</td>
                            <td colspan="5" style="text-align: center;"><?php echo bulan($bulan); ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td colspan="5" style="text-align: center;"><?php echo $t; ?></td>
                        </tr>
                        <tr align="center">
                            <td>Jenis</td>
                            <td>Satuan</td>
                            <td>Harga</td>
                            <td>Jumlah</td>
                            <td>Biaya</td>
                            <td>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6"><b>Biaya Bahan Baku :</b></td>
                        </tr>

                        <?php
                        $totalbbb = 0; 
                        foreach ($bbb as $data) { ?>
                                <tr align="center">
                                    <td><?php echo $data['nama_bahan_baku']; ?></td>
                                    <td><?php echo $data['satuan']; ?></td>
                                    <td align="right"><?php echo format_rp($data['harga']); ?></td>
                                    <td><?php echo $data['jumlah_terpakai']; ?></td>
                                    <td align="right"><?php echo format_rp($data['biaya']); ?></td>
                                    <td></td>
                                </tr>
                            <?php
                            $totalbbb = $totalbbb + $data['biaya']; 
                        } ?>

                            <tr>
                                <td colspan="5"></td>
                                <td align="right"><?php echo format_rp($totalbbb); ?></td>
                            </tr>

                        <tr>
                            <td colspan="6"><b>Biaya Tenaga Kerja :</b></td>
                        </tr>

                         <?php
                         $totalbtkl = 0;
                         foreach ($btkl as $data) { ?>
                                <tr align="center">
                                    <td><?php echo $data['nama_aktivitas']; ?></td>
                                    <td><?php echo $data['satuan']; ?></td>
                                    <td align="right"><?php echo format_rp($data['tarif']); ?></td>
                                    <td><?php echo $data['waktu_terpakai']; ?></td>
                                    <td align="right"><?php echo format_rp($data['biaya']); ?></td>
                                    <td></td>
                                </tr>
                            <?php 
                            $totalbtkl = $totalbtkl + $data['biaya']; 
                        } ?>

                            <tr>
                                <td colspan="5"></td>
                                <td align="right"><?php echo format_rp($totalbtkl); ?></td>
                            </tr>

                        <tr>
                            <td colspan="6"><b>Biaya Overhead :</b></td>
                        </tr>
                        
                        <?php
                         $totalbopm = 0;
                         foreach ($bopm as $data) { ?>
                                <tr align="center">
                                    <td><?php echo $data['nama_mesin']; ?></td>
                                    <td><?php echo $data['satuan']; ?></td>
                                    <td align="right"><?php echo format_rp($data['tarif']); ?></td>
                                    <td><?php echo $data['waktu_terpakai']; ?></td>
                                    <td align="right"><?php echo format_rp($data['biaya']); ?></td>
                                    <td></td>
                                </tr>
                            <?php 
                            $totalbopm = $totalbopm + $data['biaya']; 
                        } ?>

                        <?php
                        $totalbopbp = 0;
                        foreach ($bopbp as $data) { ?>
                                <tr align="center">
                                    <td><?php echo $data['nama_bahan_baku']; ?></td>
                                    <td><?php echo $data['satuan']; ?></td>
                                    <td align="right"><?php echo format_rp($data['harga']); ?></td>
                                    <td><?php echo $data['jumlah_terpakai']; ?></td>
                                    <td align="right"><?php echo format_rp($data['biaya']); ?></td>
                                    <td></td>
                                </tr>
                            <?php 
                            $totalbopbp = $totalbopbp + $data['biaya']; 
                        } ?>

                        <?php $totalbop = $totalbopm + $totalbopbp; ?>

                            <tr>
                                <td colspan="5"></td>
                                <td align="right"><?php echo format_rp($totalbop); ?></td>
                            </tr>

                            <?php $total = $totalbbb+$totalbtkl+$totalbop ?>

                        <tr>
                            <td colspan="5" align="center"><h4>Total</h4></td>
                            <td style="border-top: solid;" align="right"><h4><?php echo format_rp($total)?></h4></td>
                        </tr>
                    </tbody>
                </table><br>
                <form method="POST" action="<?php echo site_url('MRPII/Simpan'); ?>">
                    <input type="text" name="tanggal" value="<?php echo $tanggal ?>" hidden>
                    <input type="text" name="bbb" value="<?php echo $totalbbb ?>" hidden>
                    <input type="text" name="btkl" value="<?php echo $totalbtkl ?>" hidden>
                    <input type="text" name="bop" value="<?php echo $totalbop ?>" hidden>
                    <input type="text" name="total" value="<?php echo $total ?>" hidden>
                    <?php if($tanggal > date('Y-m-d') OR $existtgl != 0 OR $bbb == NULL) : ?>
                        <button type="submit" class="btn btn-rounded btn-success" style="width: 100%" disabled>Tidak Bisa Submit</button>
                    <?php else : ?>
                        <button type="submit" class="btn btn-rounded btn-success" style="width: 100%">Submit</button>
                    <?php endif; ?>                    
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

</body>
</html>