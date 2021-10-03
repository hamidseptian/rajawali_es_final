<?php
session_start();
include "../../../assets/koneksi.php";


$idpel = $_SESSION['iduser'];
	$idc = $_POST['idc'];

   $file= $_POST['file'];
   $wf= $_POST['wf'];
   $jml= $_POST['jml'];
   $edit= $_POST['edit'];

			$ekstensi_diperbolehkan	= array('png','jpg','PNG','JPG','JPEG');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];
			$namabaru = date('ymdhis').$nama;
 
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				move_uploaded_file($file_tmp, '../../form/galeri/file_foto/'.$namabaru);

$query = "INSERT INTO cetak_foto set 
	id_pelanggan='$idpel',
	id_he='$edit',
	id_hc = '$idc',
	with_frame='$wf',
	qty='$jml',
	order_via='Online',
	status='Masuk Ke Keranjang',
	foto='$namabaru'";

$q = mysqli_query($conn,$query)or die(mysqli_error());
			}
?>
<script type="text/javascript">
	alert('Foto anda sudah di masukkan ke keranjang');
	window.location.href='../../?m=jasa'
</script>