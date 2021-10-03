
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];

	$q1=mysqli_query($conn, "DELETE from penggajian where id_penggajian='$id'") or die(mysqli_error()); 
	
?>

	<script type="text/javascript">
		alert('Data penggajian toko dihapus');
		window.location.href="../../?a=penggajian"

	</script>