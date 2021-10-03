<?php 
session_start();
include "../../../../assets/koneksi.php";

$id_cabang=$_SESSION['id_user'];
$gaji=$_POST['gaji'];
$jab=$_POST['jab'];
	$q1=mysqli_query($conn, "INSERT into penggajian set 
		
		
		  
		 id_cabang='$id_cabang',
		 jabatan='$jab',
		 gaji='$gaji'
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data penggajian berhasil disimpan');
		window.location.href="../../?a=penggajian"

	</script>
