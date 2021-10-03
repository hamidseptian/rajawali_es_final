<?php 
include "../../../../assets/koneksi.php";
session_start();

if ($_SESSION['level']=='Admin Master') {
  # code...
  $qcabang_utama = mysqli_query($conn, "SELECT * from cabang where status = 'Cabang Utama'");
  $dcabang_utama = mysqli_fetch_array($qcabang_utama);
  $id_cabang = $dcabang_utama['id_cabang'];
}else{
	$id_cabang=$_SESSION['id_user'];
}


$tgl_transaksi=$_POST['tgl_transaksi'];
$keterangan=nl2br($_POST['keterangan']);
$biaya=$_POST['biaya'];
$kategori=$_POST['kategori'];
	$q1=mysqli_query($conn, "INSERT into pengeluaran set 
		
		
		  
		  id_cabang='$id_cabang',
		  kategori='$kategori',
		  tanggal_transaksi='$tgl_transaksi',
		  keterangan='$keterangan',
		  biaya='$biaya'
		
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data pengeluaran berhasil disimpan');
		window.location.href="../../?a=pengeluaran"

	</script>
