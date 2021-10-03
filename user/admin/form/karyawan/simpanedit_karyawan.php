<?php 
include "../../../../assets/koneksi.php";

$id=$_POST['id'];
$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$nohp=$_POST['nohp'];
$gaji=$_POST['gaji'];
	$q1=mysqli_query($conn, "UPDATE karyawan set 
		
		
		  
		  nama='$nama',
		 alamat='$alamat',
		 nohp='$nohp',
		 id_penggajian='$gaji'
		 where id_karyawan = '$id'
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data karyawan berhasil diperbaharui');
		window.location.href="../../?a=karyawan"

	</script>
