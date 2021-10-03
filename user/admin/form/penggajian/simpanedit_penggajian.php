<?php 
include "../../../../assets/koneksi.php";

$id=$_POST['id'];
		$jab=$_POST['jab'];
$gaji=$_POST['gaji'];


	$q1=mysqli_query($conn, "UPDATE penggajian set 
		
		

 jabatan='$jab',
		 gaji='$gaji'
		 where id_penggajian = '$id'
		
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data penggajian  berhasil diperbaharui');
		window.location.href="../../?a=penggajian"

	</script>
