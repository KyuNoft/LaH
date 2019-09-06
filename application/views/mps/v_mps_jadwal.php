<html>
<body>
	<?php if($this->session->userdata('detail') == "Detail"){
            echo "<body onload='modaldetail()'>";
        }elseif($this->session->userdata('alert') == "SuksesJadwal"){
            echo "<body onload='sukses_jadwal()'>";
        }else{
            echo "<body>";
        };
        unset($_SESSION['alert']);
        ?>
	<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Master Production Scheduling</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Beranda'); ?>">Home</a></li>
                        <li class="breadcrumb-item">MPS</li>
                        <li class="breadcrumb-item active">Jadwal Produksi</li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>

		<!--<div align="center" class="form-inline">
			<form method="POST" action="<?php echo site_url('Pesanan/PesananPrint');?>">
					Kode Pesanan:
					<select name="kd_pesanan" class="form-control">
						<option value="#" disabled selected>Pilih Kode</option>
                <?php
                    foreach($Pesanan as $data){
                        echo "<option value=".$data['kd_pesanan'].">".$data['kd_pesanan']."</option>";
                    }
                ?>
              </select>
              <button type="submit" name="print" value="printc" class="btn btn-success"><i class="fa fa-fw fa-print"></i> Print</button>
          </form>
				&nbsp<form method="POST" action="<?php echo site_url('Pesanan/PesananPrintAll');?>">
					<button type="submit" name="print" value="printall" class="btn btn-success"><i class="fas fa-print"></i> Print Daftar</button></form></div><br>
				<!--&nbsp<a href="<?php //echo base_url('Pengiriman/PengirimanExcel')*/?>" type="button" class="btn btn-success">Export Excel<i class="fa fa-fw fa-file-excel-o"></i></a>
			</div><br>-->

		<div align="center" class="form-inline">
			<form class="form-material" method="POST" action="<?php echo site_url('MPS/Jadwal');?>">
					Bulan : <select class="form-control" name="bulan" required>
						<option value="" selected disabled>-Pilih Bulan-</option>
						<option value="01">Januari</option>
						<option value="02">Februari</option>
						<option value="03">Maret</option>
						<option value="04">April</option>
						<option value="05">Mei</option>
						<option value="06">Juni</option>
						<option value="07">Juli</option>
						<option value="08">Agustus</option>
						<option value="09">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>
					</select>&nbsp&nbsp&nbsp&nbsp
					Tahun : <select class="form-control" name="tahun" required>
						<option value="" selected disabled>-Pilih Tahun-</option>
						<option value="2019">2019</option>
					</select>&nbsp&nbsp&nbsp&nbsp
					<button type="submit" name="cari" value="submit" class="btn btn-info">Pilih</button>
				</form>
			</div><br>

	<?php if(isset($cari)) : ?>
	 <div class="card">
        <div class="card-header" align="left"><i class="mdi mdi-table"></i> MPS</div>
	 	<div class="card-body">
            <h1 align="center">Jadwal Induk Produksi</h1>
	 		<div class="table-responsive m-t-40">
	 	<table id="myTable" class="table table-bordered">
		<thead align="center">
			<tr>
				<th class="column1">Tanggal Produksi</th>
				<th class="column2">Jumlah</th>
				<th class="column3">Aksi</th>
			</tr>
		</thead>
		<tbody align="center">
			<?php
			     foreach($jadwal as $data){
				    echo "
				         <tr>
				             <td>".$data['tanggal']."</td>
				             <td>".$data['jumlah']."</td>";
				             $tgl = $data['tanggal'];?>
				             <td><form method="POST" action="<?php echo site_url('MPS/Jadwal'); ?>">
				             	<input type="text" name="tanggal" value="<?php echo $tgl ?>" class="form-control" hidden>
                                <input type="text" name="cari" value="<?php echo $cari ?>" class="form-control" hidden>
                                <input type="text" name="bulan" value="<?php echo $bulan ?>" class="form-control" hidden>
                                <input type="text" name="tahun" value="<?php echo $tahun ?>" class="form-control" hidden>
				             	<button type="submit" name="detail" value="detail" class="btn btn-rounded btn-warning"><i class="fas fa-info"></i> Detail</button>
				             </form>
				         	</td>
			 	        </tr>
			 	        <?php
			 	    }
			 	?>
		</tbody>
	</table>
</div>
</div>
</div>

			<!-- Modal Detail -->
            <?php if($this->session->userdata('detail') == "Detail"):?>
            <?php foreach ($detail as $data):?>
            <div id="ModalDetail" class="modal fade" role="dialog">
                <div class="modal-dialog" style="padding-right: 20%;">
                    <div class="modal-content" style="width: 250%;">

                        <div class="modal-header">
                            <h4 class="modal-title">Detail Jadwal Tanggal <?php echo $data['tanggal'];?></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                        	<table class='table table-bordered'>
                        		<tr style="text-align: center; background-color: lightblue">
                        			<th>Nama Produk</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            		$total = 0;
                                    	foreach($detail as $data){
                                    		echo "
                                    			<tr>
                                    				<td>".$data['nama_produk']."</td>
                                    				<td align='center'>".$data['jumlah']."</td>
                                    			</tr>
                                    		";
                                    		$total= $total + $data['jumlah'];
                                    	}
                                    ?>
                                    <tr>
                                    	<td style="text-align: center;">Total Jumlah</td>
                                    	<td style="text-align: center;"><?php echo $total ?></td>
                                    </tr>
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
<?php endif; ?>

</body>
</html>