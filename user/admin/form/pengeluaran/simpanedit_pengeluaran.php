<?php 
include "../../../../assets/koneksi.php";
session_start();
$id_cabang=$_SESSION['id_user'];
$tgl_transaksi=$_POST['tgl_transaksi'];
$keterangan=nl2br($_POST['keterangan']);
$biaya=$_POST['biaya'];
$kategori=$_POST['kategori'];
$id=$_POST['id'];
	$q1=mysqli_query($conn, "UPDATE pengeluaran set 
		  kategori='$kategori',
		  tanggal_transaksi='$tgl_transaksi',
		  keterangan='$keterangan',
		  biaya='$biaya'
		  where id_pengeluaran='$id'
		
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data pengeluaran berhasil disimpan');
		window.location.href="../../?a=pengeluaran"

	</script>
