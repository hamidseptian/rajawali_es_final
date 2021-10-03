<?php 
session_start();
include "../../assets/koneksi.php";
$user=$_POST['username'];
$pass=$_POST['password'];
//$password= password_hash($pass, PASSWORD_DEFAULT);
//echo $user."<br>".$password;

// $sql= "insert into admin(nama_user, username, password, level) values ('Hamid', '$user', '$password', 'admin')";
// $execute=mysqli_query($conn, $sql);

$sql= "SELECT * from user
where username='$user' and password='$pass'";
$execute=mysqli_query($conn, $sql) or die(mysqli_error());
//$x = mysqli_fetch_array($execute);
$jml=mysqli_num_rows($execute);
//echo $jml;
if ($jml==1) {
	$data=mysqli_fetch_array($execute);

		$_SESSION['login']=true;
	
		
		
		$_SESSION['id_user']=$data['id_user'];
		$_SESSION['level']=$data['level'];
		
		header("Location:../../user/admin/");
	
	
}

else{

	echo "<script>
				alert('Username dan Password salah!');
			</script>
		";
    	echo "<meta http-equiv='refresh' content='0; url=http:../../login/admin'>";
	
}



 ?>