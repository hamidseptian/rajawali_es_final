
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];

	$q1=mysqli_query($conn, "DELETE from cabang where id_cabang='$id'") or die(mysqli_error()); 
	
?>

	<script type="text/javascript">
		alert('Data cabang toko dihapus');
		window.location.href="../../?a=cabang"

	</script>