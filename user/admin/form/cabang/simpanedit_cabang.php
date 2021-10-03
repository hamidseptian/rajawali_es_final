<?php 
include "../../../../assets/koneksi.php";
session_start();
$id=$_POST['id'];
$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$nohp=$_POST['nohp'];
$pj=$_POST['pj'];
$username=$_POST['username'];
$password=$_POST['password'];
if ($_SESSION['level']=='Admin Toko') { 
	$redirect = '../../';
}else{
	$redirect = '../../?a=cabang';

}
	$q1=mysqli_query($conn, "UPDATE cabang set 
		
		
		 nama_cabang='$nama',
		 pj='$pj',
		 alamat='$alamat',
		 nohp='$nohp',
		 username='$username',
		 password='$password'
		 where id_cabang = '$id'
		
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data cabang  berhasil diperbaharui');
		window.location.href="<?php echo $redirect ?>"

	</script>
