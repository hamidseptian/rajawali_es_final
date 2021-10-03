<?php 
include "../../../../assets/koneksi.php";

$id=$_POST['id'];
		$nama=$_POST['nama'];
$satuan=$_POST['satuan'];
$harga=$_POST['harga'];


	$q1=mysqli_query($conn, "UPDATE bahan_baku set 
		
		

 nama_bahan_baku='$nama',
		 satuan='$satuan',
		 harga_satuan='$harga'
		 where id_bahan_baku = '$id'
		
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data bahan baku  berhasil diperbaharui');
		window.location.href="../../?a=bahan_baku"

	</script>
