
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];

	$q1=mysqli_query($conn, "UPDATE cabang set status='Cabang Utama' where id_cabang='$id'") or die(mysqli_error()); 
	$q1=mysqli_query($conn, "UPDATE cabang set status='' where id_cabang!='$id'") or die(mysqli_error()); 
	
?>

	<script type="text/javascript">
		alert('Data cabang utama diperbaharui');
		window.location.href="../../?a=cabang"

	</script>