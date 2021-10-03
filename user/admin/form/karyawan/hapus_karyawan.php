
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];

	$q1=mysqli_query($conn, "DELETE from karyawan where id_karyawan='$id'") or die(mysqli_error()); 
	
?>

	<script type="text/javascript">
		alert('Data karyawan  dihapus');
		window.location.href="../../?a=karyawan"

	</script>