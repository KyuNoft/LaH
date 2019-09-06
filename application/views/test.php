<html>
<body>

	<h1>
		<?php $aku = $test->row()->waktumaks;
		echo $aku; ?>
	</h1><br>

	<h2>
		<?php $hari = 0;
		$hasil = date('Y-m-d', strtotime($test2.' + '.$hari.'day')); 
		echo  $hasil ?>
	</h2>

	<h3>
		<?php $kapasitas = 120;
			  $sisakapasitas = 0;
			  $sisakapasitas = $kapasitas - $sisakapasitas;
		echo $sisakapasitas ?>
	</h4>

	<h4>
		<?php
		$sisawaktu = 2;
		$waktumaks = 2;
		if(isset($sisawaktu)){
			if($sisawaktu < $waktumaks){
				$kapasitas = 480 / $waktumaks;
			}else{
				$kapasitas = $sisawaktu / $waktumaks;
			}
		}
		echo $kapasitas;
		?>
	</h4>

	<h5>
		<?php
            $last  = new DateTime($test3->tanggal);
            $new   = new DateTime(date('Y-m-d'));
            $days  = $new->diff($last)->format('%a');
            $total = $days;
            echo $total;
            ?>
	</h5>

	<h6>
		<?php
            $last  = new DateTime('2019-03-17');
            $new   = new DateTime(date('Y-m-d'));
            $days  = $new->diff($last)->format('%a');
            $total = $days;
            echo $total;
            ?>
	</h6>

	<h1>
		<?php
            echo $test3->kd_pesanan." ";
            echo $test3->kd_produk." ";
            echo $test3->tanggal." ";
            echo $test3->jumlah." ";
            echo $test3->sisawaktu." ";
            ?>
	</h1>

	<h2>
		<?php
            echo $test4->row_array(1)['kd_produk'];
            ?>
	</h2>

	<h3>
		<?php
		$tglterakhir = date('Y-m-d');
		$hari = 1;
		echo date('Y-m-d', strtotime($tglterakhir.' + '.$hari.'day'));
		?>
	</h3>

		<?php
		$id = $this->session->userdata('contoh');
		echo "<h4>$id</h4>";
		?>

	<h4>
		<?php
		$tgl = new DateTime($test3->tanggal);
		?>
	</h4>		

</body>
</html>