<?php
session_start();
include "../../../assets/koneksi.php";
$tgl=$_GET['tgl'];
$jambook=$_GET['jambook'];
$idj=$_GET['idj'];
$idpel=$_SESSION['iduser'];
$kegiatan=$_GET['k'];
$lama=$_GET['lama'];
$timestamp = date('Y-m-d h:i:s');
$mulai = $tgl.' '.$jambook;

$selesai = date('Y-m-d', strtotime($lama.' days', strtotime($tgl))); 
$selesai = $selesai.' '.$jambook;
$q = mysqli_query($conn, "INSERT into booking
	set id_pelanggan='$idpel', 
	id_paket='$idj',
	kegiatan='$kegiatan',
	tanggal_mulai='$mulai',
	lama_acara='$lama',
	tanggal_selesai='$selesai',
	
	status='Masuk Ke Keranjang'
	")

?>
<script type="text/javascript">
	alert('Booking anda dimasukkan ke keranjang');
	window.location.href="../../?m=jasa";
</script>
