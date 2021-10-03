<?php 
include "../../../../assets/koneksi.php";

$nama=$_POST['nama'];
$username=$_POST['username'];
$password=$_POST['password'];
$level=$_POST['level'];


$q = mysqli_query($conn, "SELECT * from user where username='$username' and password='$password'");
$j =  mysqli_num_rows($q) ;
if ($j>0 ) { ?>
		<script type="text/javascript">
		alert('Data user gagal disimpan\nUsername dan password sudah digunakan');
		window.location.href="../../?a=user"

	</script>
	<?php 
	
}else{

	$q1=mysqli_query($conn, "INSERT into user set 
		
		
		  
		 nama_user='$nama',
		 
		 username = '$username',
		 password = '$password',
		 level = '$level'
		
		")or die(mysqli_error()); 

?>

	<script type="text/javascript">
		alert('Data user berhasil disimpan');
		window.location.href="../../?a=user"

	</script>
<?php } ?>