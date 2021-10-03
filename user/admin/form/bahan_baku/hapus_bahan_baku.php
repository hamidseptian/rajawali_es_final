
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];

	$q1=mysqli_query($conn, "DELETE from bahan_baku where id_bahan_baku='$id'") or die(mysqli_error()); 
	
?>

	<script type="text/javascript">
		alert('Data bahan baku toko dihapus');
		window.location.href="../../?a=bahan_baku"

	</script>