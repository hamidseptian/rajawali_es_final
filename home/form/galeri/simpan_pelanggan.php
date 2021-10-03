<?php 
include "../../../assets/koneksi.php";
$nama =$_POST['nama'];
$alm =$_POST['alm'];
$hp =$_POST['hp'];
$email =$_POST['email'];
$pass =$_POST['password'];

$cek = mysqli_query($conn, "SELECT * from pelanggan where email_pelanggan='$email'");
$jcek = mysqli_num_rows($cek);
if ($jcek>0) { ?>
	<script type="text/javascript">
     alert('Data pelanggan gagal ditambahkan\nEmail sudah digunakan\nSilahkan gunakan email lain');
     window.location.href="../../?a=register"
 </script>
	
<?php }
else{

$q1 = mysqli_query($conn, "INSERT into pelanggan set
                nama_pelanggan = '$nama',
                alamat_pelanggan='$alm',
                nohp_pelanggan='$hp',
              
                emaiL_pelanggan='$email',
                password='$pass',
                reg_via='Offline'
    ")or die(mysqli_error());
 ?>

 <script type="text/javascript">
     alert('Data pelanggan anda berhasil ditambahkan');
     window.location.href="../../?m=login_pelanggan"
 </script>
 <?php } ?>