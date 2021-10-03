
<?php 
session_start();
include "../../../../assets/koneksi.php";
$id=$_GET['id'];

	$q1=mysqli_query($conn, "UPDATE pembayaran set status='Ditolak' where id_pembayaran='$id'") or die(mysqli_error()); 
	
?>

	<script type="text/javascript">
		alert('Pembayaran ditolak');
		window.location.href="../../?a=pesanan"

	</script>