
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];

	$q1=mysqli_query($conn, "DELETE from pengeluaran where id_pengeluaran='$id'") or die(mysqli_error()); 
	
?>

	<script type="text/javascript">
		alert('Data pengeluaran  dihapus');
		window.location.href="../../?a=pengeluaran"

	</script>