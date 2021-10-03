<?php 
include "../../../../assets/koneksi.php";

session_start();
$id = $_SESSION['id_user'];

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];


$q_cek = mysqli_query($conn, "SELECT * from user where username='$username' and id_user!='$id'");	
$j_cek = mysqli_num_rows($q_cek);		
if ($j_cek>0) {
	$alert = 'Akun anda gagal di perbaharui \nUsername sudah digunakan';
	$redirect = "../../?a=edit-akun";
}else{
	$q1=mysqli_query($conn, "UPDATE user set 
		nama_user='$nama',
		username='$username',
		password='$password'
		where id_user='$id'
		
		
		")or die(mysqli_error()); 
	$alert = "Akun anda berhasil di perbaharui";
	$redirect = "../../";
}

?>

	<script type="text/javascript">
		alert("<?php echo $alert ?>");
		window.location.href="<?php echo $redirect ?>"

	</script>