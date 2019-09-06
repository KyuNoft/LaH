<html>
<body>
	<div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Manufacturing Resource Planning</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('Beranda'); ?>">Home</a></li>
                <li class="breadcrumb-item">MRP II</li>
                <li class="breadcrumb-item active">Tabel</li>
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

			<!--<a href="<?php echo site_url('Pesanan/Tambah'); ?>" role="button" class="btn btn-info"><i class="fa fa-fw fa-plus-circle"></i>Tambah</a><br>-->

		<div align="center" class="form-inline">
			<form class="form-material" method="POST" action="<?php echo site_url('MRPII');?>">
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
					<button type="submit" name="pilih" value="submit" class="btn btn-info">Pilih</button>
				</form>
			</div><br>

		<?php if(isset($_POST['pilih'])) : ?>

        <h1 class="text-center">Manufacturing Resource Planning</h1>
		<div class="card">
			<div class="card-header" align="left"><i class="mdi mdi-table"></i> MRP II</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead align="center">
							<tr>
								<td colspan="2">Bulan</td>
								<td colspan="<?php echo $jmltgl ?>"><?php echo bulan($bulan) ?></td>
							</tr>
							<tr>
								<td colspan='2'>Tanggal</td>
								<?php foreach($tanggal as $tgl){ ?>
									<td><?php echo date_format(date_create($tgl['tanggal']), "d") ?></td>
								<?php } ?>
							</tr>
						</thead>
						<tbody align="center">
							<tr>
								<td>Jumlah</td>
								<td>pcs</td>
								<?php foreach($jumlah as $jml){ ?>
									<td><?php echo $jml['jumlah'] ?></td>
								<?php } ?>
							</tr>
							<tr>
								<td nowrap>Total Biaya</td>
								<td>Rupiah</td>
								<?php foreach($totalb as $ttlb){ ?>
									<td nowrap><?php echo format_rp($ttlb['total']) ?></td>
								<?php } ?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	<?php endif; ?>
</body>
</html>