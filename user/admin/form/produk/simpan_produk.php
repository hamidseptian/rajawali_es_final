<?php 
include "../../../../assets/koneksi.php";
session_start();
if ($_SESSION['level']=='Admin Master'){
	$id_cabang='0';
}else{
	$id_cabang=$_SESSION['id_user'];

}
$namaproduk = $_POST['nama'];
$harga = $_POST['harga'];
			$ekstensi_diperbolehkan	= array('png','jpg','PNG','JPG','JPEG');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];
			$namabaru = date('ymdhis').$nama;
 
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
					move_uploaded_file($file_tmp, '../../form/produk/gambar/'.$namabaru);


			
	$q1=mysqli_query($conn, "INSERT into produk set 
		
		id_cabang='$id_cabang',
		nama_produk='$namaproduk',
		harga='$harga',
		gambar='$namabaru'
		
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data produk berhasil disimpan');
		window.location.href="../../?a=produk"

	</script>
<?php }else{ ?>
	<script type="text/javascript">
		alert('Data produk gagal disimpan\nharap pilih file gambar dengan benar');
		window.location.href="../../?a=produk"

	</script>
<?php } ?>