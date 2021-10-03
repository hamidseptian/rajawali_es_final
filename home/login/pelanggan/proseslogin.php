<?php 
session_start();
include "../../../assets/koneksi.php";
$user=$_POST['email'];
$pass=$_POST['password'];
//$password= password_hash($pass, PASSWORD_DEFAULT);
//echo $user."<br>".$password;

// $sql= "insert into admin(nama_user, username, password, level) values ('Hamid', '$user', '$password', 'admin')";
// $execute=mysqli_query($conn, $sql);

$sql= "SELECT * from pelanggan where email_pelanggan='$user'";
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
		$_SESSION['level']='Pelanggan';
	
		
		$_SESSION['iduser']=$data['id_pelanggan'];
		header("Location:../../");
	}
	else{
		echo "<script>
				alert('Password Salah');
			</script>
		";

    	echo "<meta http-equiv='refresh' content='0; url=http:../../?m=login_pelanggan'>";
		
	}
	
}

else{

	echo "<script>
				alert('Username dan Password salah!');
			</script>
		";
    	echo "<meta http-equiv='refresh' content='0; url=http:../../?m=login_pelanggan'>";
	
}



 ?>