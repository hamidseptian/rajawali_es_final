<?php 
session_start();
include "../../../assets/koneksi.php";
$user=$_POST['username'];
$pass=$_POST['password'];
//$password= password_hash($pass, PASSWORD_DEFAULT);
//echo $user."<br>".$password;

// $sql= "insert into admin(nama_user, username, password, level) values ('Hamid', '$user', '$password', 'admin')";
// $execute=mysqli_query($conn, $sql);

$sql= "SELECT * from admin where username='$user'";
$execute=mysqli_query($conn, $sql);
//$x = mysqli_fetch_array($execute);
$jml=mysqli_num_rows($execute);
//echo $jml;
if ($jml==1) {
	$data=mysqli_fetch_array($execute);
	$passdb=$data['password'];
//	$verivikasi=password_verify($pass, $passdb);
	if ($passdb == $pass) {
		$_SESSION['login']=true;
	
		
		$_SESSION['id_admin']=$data['id'];
		$_SESSION['nama_admin']=$data['nama_admin'];
		$_SESSION['jabatan']=$data['jabatan'];
		$_SESSION['level']=$data['level'];
		
		header("Location:../../../user/admin/");
	}
	else{
		echo "<script>
				alert('Password Salah');
			</script>
		";

    	echo "<meta http-equiv='refresh' content='0; url=http:../../?m=login_admin'>";
		
	}
	
}

else{

	echo "<script>
				alert('Username dan Password salah!');
			</script>
		";
    	echo "<meta http-equiv='refresh' content='0; url=http:../../?m=login_admin'>";
	
}



 ?>