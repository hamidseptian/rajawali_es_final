<?php 
include "../../../../assets/koneksi.php";

$nama=$_POST['nama'];
$satuan=$_POST['satuan'];
$harga=$_POST['harga'];
$stok=$_POST['stok'];
$tgls = date('Y-m-d');
	$q1=mysqli_query($conn, "INSERT into bahan_baku set 
		
		
		  
		 nama_bahan_baku='$nama',
		 satuan='$satuan',
		 harga_satuan='$harga'
		
		")or die(mysqli_error()); 
	$id = mysqli_insert_id($conn);

	$i_mbb = mysqli_query($conn, "INSERT into management_bahan_baku set
			id_bahan_baku = '$id',
			nama_bahan_baku = '$nama',
			satuan='$satuan', 
			harga_satuan = '$harga_satuan',
			qty='$stok',
			jenis='Masuk',
			tgl_transaksi = '$tgls',
			status = 'Selesai'
			")or die(mysqli_error());


?>

	<script type="text/javascript">
		alert('Data bahan baku berhasil disimpan');
		window.location.href="../../?a=bahan_baku"

	</script>
