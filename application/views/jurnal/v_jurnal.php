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
                        <li class="breadcrumb-item active">Jurnal</li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>

		<div align="center" class="form-inline"> 
			<form class="form-material" method="POST" action="<?php echo site_url('Laporan/Jurnal');?>">
				Bulan : <select class="form-control" name="bulan" required>
						<option value="" selected disabled>-Pilih Bulan-</option>
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
					</select>&nbsp&nbsp&nbsp&nbsp
					Tahun : <select class="form-control" name="tahun" required>
						<option value="" selected disabled>-Pilih Tahun-</option>
						<option value="2019">2019</option>
					</select>&nbsp&nbsp&nbsp&nbsp
				<button type="submit" name="cari" value="pilih" class="btn btn-info">Pilih</button>
					<!--Tanggal Awal : <input type='date' name='tgl_awal' class='form-control col-sm-4' required>&nbsp&nbsp&nbsp&nbsp
					Tanggal Akhir : <input type='date' name='tgl_akhir' class='form-control col-sm-4' required>&nbsp&nbsp&nbsp&nbsp
					<button type="submit" name="cari" value="filter" class="btn btn-info">Filter</button>
					<button type="submit" name="print" value="printc" class="btn btn-success">Print<i class="fa fa-fw fa-print"></i></button>
					<button type="submit" name="print" value="printall" class="btn btn-success">Print All<span class="glyphicon glyphicon-print"></span>></button>
					<a href = "<?php echo site_url()."Laporan/Jurnal"?>" role="button" class='btn btn-danger'>Lihat Semua</a>-->
				</form>
			</div><br>
				<!--<a href="<?php echo site_url()."Laporan/JurnalExcel"?>" type="button" class="btn btn-success">Export Excel<i class="fa fa-fw fa-file-excel-o"></i></a><br>-->

		<?php if(isset($cari)) : ?>
		<div class="card">
			<div class="card-header" align="left"><i class="mdi mdi-table"></i> Jurnal</div>
			<div class="card-body">
				<h2 align='center'>Jurnal Umum</h2>
				<h4 align="center">Look at Hijab</h4>
				<h4 align="center">Periode <?php echo bulan($bulan)." ".$tahun ?></h4>
				<div class="table-responsive m-t-40">
					<table id="myTable" class="table table-bordered">
						<thead align="center">
							<tr>
								<th>Tanggal Jurnal</th>
								<th>Keterangan</th>
								<th>Ref</th>
								<th>Debit</th>
								<th>Kredit</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$spasi='&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
								foreach($jurnal as $data){
									echo "
										<tr>
											<td align='center'>".$data['tanggal']."</td>
										";
										if($data['posisi'] =='debit'){
											echo "
												<td>".$data['nama_akun']."</td>
												<td align='center'>".$data['no_akun']."</td>
												<td align='right'>".format_rp($data['nominal'])."</td>
												<td align='right'></td>
											</tr>
											";
										}else{
											echo "
												<td>".$spasi.$data['nama_akun']."</td>
												<td align='center'>".$data['no_akun']."</td>
												<td align='right'></td>
												<td align='right'>".format_rp($data['nominal'])."</td>
											</tr>
											";
										}
									}
							?>
						</tbody>
						<tr style="font-weight: bold;">
								<td colspan="3" align="center">Total</td>
								<td align="right"><?php echo format_rp($ttldebit); ?></td>
								<td align="right"><?php echo format_rp($ttlkredit); ?></td>
							</tr>
					</table>
				</div>
			</div>
		</div>
	<?php endif; ?>
	</body>
</html>