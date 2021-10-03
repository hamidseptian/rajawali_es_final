<?php 
include "../../../../assets/koneksi.php";
session_start();
$nama=$_POST['nama'];
$id_cabang=$_SESSION['id_user'];
$alamat=$_POST['alamat'];
$nohp=$_POST['nohp'];
$gaji=$_POST['gaji'];
	$q1=mysqli_query($conn, "INSERT into karyawan set 
		
		
		  
		  id_cabang='$id_cabang',
		  nama='$nama',
		 alamat='$alamat',
		 nohp='$nohp',
		 id_penggajian='$gaji'
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data karyawan berhasil disimpan');
		window.location.href="../../?a=karyawan"

	</script>
