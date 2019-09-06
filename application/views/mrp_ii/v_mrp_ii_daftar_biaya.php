<html>
<body>
	<?php if($this->session->userdata('alert') == "SuksesGenerate"){
            echo "<body onload='sukses_generate()'>";
        }else{
            echo "<body>";
        };
        unset($_SESSION['alert']);
        ?>
	<div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Manufacturing Resource Planning II</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('Beranda'); ?>">Home</a></li>
                <li class="breadcrumb-item">MRP II</li>
                <li class="breadcrumb-item active">Daftar Biaya</li>
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

	 <div class="card">
	 	<div class="card-header" align="left"><i class="mdi mdi-table"></i> Biaya Produksi</div>
	 	<div class="card-body">
	 		<h1 class="text-center">Daftar Biaya</h1>
	 		<div class="table-responsive m-t-40">
	 	<table id="myTable" class="table table-bordered">
		<thead align="center">
			<tr>
				<th class="column1">Kode</th>
				<th class="column2">Tanggal</th>
				<th class="column3">Biaya Bahan Baku</th>
				<th class="column4">Biaya Tenaga Kerja Langsung</th>
				<th class="column5">Biaya Overhead Pabrik</th>
				<th class="column6">Biaya Produksi</th>
			</tr>
		</thead>
		<tbody align="center">
			<?php foreach($mrp_ii as $data){ ?>
				<tr>
					<td><?php echo $data['kd_mrp_ii'] ?></td>
					<td><?php echo $data['tanggal'] ?></td>
				    <td><?php echo format_rp($data['total_bbb']) ?></td>
				    <td><?php echo format_rp($data['total_btkl']) ?></td>
				    <td><?php echo format_rp($data['total_bop']) ?></td>
				    <td style='font-weight: bold'><?php echo format_rp($data['total']) ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
</div>
</div>
</body>
</html>