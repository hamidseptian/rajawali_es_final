
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];

	$q1=mysqli_query($conn, "DELETE from management_bahan_baku where id_managemen='$id'") or die(mysqli_error()); 
	
?>

	<script type="text/javascript">
		alert('Data bahan baku masuk dihapus');
		window.location.href="../../?a=management_bahan_baku"

	</script>