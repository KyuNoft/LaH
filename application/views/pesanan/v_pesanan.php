<html>
<body>
	<?php if($this->session->userdata('detail') == "Detail"){
            echo "<body onload='modaldetail()'>";
        }elseif($this->session->userdata('alert') == "SuksesPesanan"){
            echo "<body onload='sukses_pesanan()'>";
        }else{
            echo "<body>";
        };
        unset($_SESSION['alert']);
        ?>
	 <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Pemesanan</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Beranda'); ?>">Home</a></li>
                        <li class="breadcrumb-item">Pemesanan</li>
                        <li class="breadcrumb-item active">Daftar Pesanan</li>
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

			<!--<a href="<?php echo site_url('Pesanan/Tambah'); ?>" role="button" class="btn btn-info"><i class="fa fa-fw fa-plus-circle"></i>Tambah</a><br>--><br>

	<div class="card">
        <div class="card-header" align="left"><i class="mdi mdi-table"></i> Pesanan</div>
        <div class="card-body">
            <h1 class="text-center">Daftar Pesanan</h1>
	 		<div class="table-responsive m-t-40">
	 	<table id="myTable" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Kode pesanan</th>
				<th>Nama Pelanggan</th>
				<th>Tanggal pesanan</th>
				<th>Total</th>
				<th>Detail</th>
			</tr>
		</thead>
		<tbody>
			<?php
			     foreach($pesanan as $data){
				    echo "
				         <tr>
				             <td>".$data['kd_pesanan']."</td>
				             <td>".$data['nama_pelanggan']."</td>
				             <td>".$data['tanggal']."</td>
				             <td>".format_rp($data['total'])."</td>";
				             $kd = $data['kd_pesanan'];
				             $s  = $data['status']; ?>
				             <td><form method="POST" action="<?php echo site_url('Pesanan'); ?>">
				             	<input type="text" name="kd_pesanan" value="<?php echo $kd ?>" class="form-control" hidden>
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
                    <div class="modal-content" style="width: 280%;">

                        <div class="modal-header">
                            <h4 class="modal-title">Detail Pesanan <?php echo $data['kd_pesanan'];?></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                        	<table class='table table-bordered'>
                        		<tr style="text-align: center; background-color: lightblue">
                        			<th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            		$total = 0;
                                    	foreach($detail as $data){
                                    		echo "
                                    			<tr>
                                    				<td nowrap>".$data['nama_produk']."</td>
                                    				<td align='right'>".$data['jumlah']."</td>
                                    				<td align='right' nowrap>".format_rp($data['harga'])."</td>
                                    				<td align='right' nowrap>".format_rp($data['subtotal'])."</td>
                                    			</tr>
                                    		";
                                    		$total= $total + $data['subtotal'];
                                    	}
                                    ?>
                                    <tr>
                                    	<td colspan="3" style="text-align: center;">Total</td>
                                    	<td style="text-align: right;"><?php echo format_rp($total) ?></td>
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

</body>
</html>