<?php 
include "../../../../assets/koneksi.php";

$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$pj=$_POST['pj'];
$hp=$_POST['hp'];
$q = mysqli_query($conn, "SELECT * from cabang");
$j =  mysqli_num_rows($q) +1 ;
if ($j>0 and $j<=10) {
	$kode = '00'.$j;
}
elseif ($j>10 and $j<=100) {
	$kode = '0'.$j;
}
else{
	$kode = $j;
}

	$q1=mysqli_query($conn, "INSERT into cabang set 
		
		
		  
		 nama_cabang='$nama',
		 pj='$pj',
		 alamat='$alamat',
		 nohp='$hp',
		 username = '$kode',
		 password = '$kode'
		
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data cabang toko berhasil disimpan');
		window.location.href="../../?a=cabang"

	</script>
