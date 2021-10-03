
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];

	$q1=mysqli_query($conn, "DELETE from user where id_user='$id'") or die(mysqli_error()); 
	
?>

	<script type="text/javascript">
		alert('Data user  dihapus');
		window.location.href="../../?a=user"

	</script>