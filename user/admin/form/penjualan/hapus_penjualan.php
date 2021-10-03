
<?php 
session_start();
include "../../../../assets/koneksi.php";
$tgl=$_GET['tgl'];
$waktu=$_GET['waktu'];
$idtoko = $_SESSION['id_user'];

	$q1=mysqli_query($conn, "DELETE from penjualan where id_cabang='$idtoko' and tanggal_transaksi='$tgl' and jam_transaksi='$waktu'") or die(mysqli_error()); 
	
?>

	<script type="text/javascript">
		alert('Data penjualan dihapus');
		window.location.href="../../?a=penjualan"

	</script>