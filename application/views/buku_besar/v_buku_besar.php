<html>
<body>
	<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Laporan</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Beranda'); ?>">Home</a></li>
                        <li class="breadcrumb-item">Laporan</li>
                        <li class="breadcrumb-item active">Buku Besar</li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>

		<div>
		<form class="form-material" method="POST" action="<?php echo site_url('/Laporan/BukuBesar');?>">
                <label>Akun</label>&nbsp : 
                <select name="no_akun" class="form-control" style="text-align: center; width: 20%" required>
                    <option value="" disabled selected>- Pilih Akun -</option>
                    <?php
                        foreach($akun as $data){
                            echo "<option value=".$data['no_akun'].">".$data['nama_akun']."</option>";
                        }
                    ?>
                </select>&nbsp&nbsp&nbsp&nbsp
                <label>Bulan</label>&nbsp : 
                <select name="bulan" class="form-control" style="text-align: center; width: 10%" required>
                    <option value="" disabled selected>- Pilih Bulan -</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>&nbsp&nbsp&nbsp&nbsp&nbsp
                <label>Tahun</label>&nbsp : 
                <select class="form-control" name="tahun" style="text-align: center; width: 10%" required>
                	<option value="" selected disabled>-Pilih Tahun-</option>
                	<option value="2019">2019</option>
                	<option value="2020">2020</option>
                </select>&nbsp&nbsp&nbsp&nbsp
                <button class="btn btn-info" name="cari" value="cari" type="submit">Pilih</button>
		  <!--<button type="submit" name="print" value="printc" class="btn btn-success">Print<i class="fa fa-fw fa-print"></i></button>
		  <button type="submit" name="excel" value="excel" class="btn btn-success">Export Excel<i class="fa fa-fw fa-file-excel-o"></i></button>-->
		</form>
	</div><br>

	<?php if(isset($cari)) : ?>
		<div class="card">
			<div class="card-header" align="left"><i class="mdi mdi-table"></i> Buku Besar</div>
			<div class="card-body">
				<h2 align='center'>Buku Besar <?php echo $nama_akun;?></h2>
				<h4 align="center">Look at Hijab</h4>
				<h4 align="center">Periode <?php echo bulan($bulan)." ".$tahun ?></h4>
	 	<div class="table-responsive m-t-40">
	 	<table class="table table-bordered">
			<thead align="center">
				<tr>
					<td>Tanggal</td>
					<td>Keterangan</td>
					<td>Debit</td>
					<td>Kredit</td>
					<td>Saldo</td>
			</tr>
		</thead>
		<tbody>
			<?php
				echo "
					<tr>
						<td></td>
						<td align='center'>Saldo Awal</td>
						<td colspan='2'></td>
						<td align='right'>".format_rp($saldo)."</td>
					</tr>
				";
				foreach($jurnal as $data){
					echo "
						<tr>
							<td align='center'>".$data['tanggal']."</td>
							<td align='center'>".$data['nama_akun']."</td>
						";
					if($data['posisi'] == 'debit'){
							$saldo = $saldo + $data['nominal'];
						echo "
							<td align='right'>".format_rp($data['nominal'])."</td>
							<td></td>
							<td align='right'>".format_rp($saldo)."</td>
						</tr>
						";
					}else{
							$saldo = $saldo - $data['nominal'];
						echo "
							<td></td>
							<td align='right'>".format_rp($data['nominal'])."</td>
							<td align='right'>".format_rp($saldo)."</td>
						</tr>
						";
					}
				}
				echo "
					<tr>
						<td></td>
						<td align='center'>Saldo Akhir</td>
						<td colspan='2'></td>
						<td align='right'>".format_rp($saldo)."</td>
					</tr>
				";
			?>
		</tbody>
		</table>
	</div>
</div>
</div>
<?php endif; ?>
</body>
</html>