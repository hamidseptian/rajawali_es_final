<?php 
include "../../../../assets/koneksi.php";

session_start();
$id = $_POST['id'];
$namaproduk = $_POST['nama'];
$harga = $_POST['harga'];
$fotolama = $_POST['fotolama'];



			$ekstensi_diperbolehkan	= array('png','jpg','PNG','JPG','JPEG');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];
			$namabaru = date('ymdhis').$nama;
 if ($nama=='') {
 		$q1=mysqli_query($conn, "UPDATE produk set 
		
		nama_produk='$namaproduk',
		harga='$harga'
		where id_produk='$id'
		
		
		")or die(mysqli_error()); ?>
			<script type="text/javascript">
		alert('Data produk berhasil diperbaharui');
		window.location.href="../../?a=produk"

	</script>
	<?php 
 }else{
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
					move_uploaded_file($file_tmp, '../../form/produk/gambar/'.$namabaru);

 		$q1=mysqli_query($conn, "UPDATE produk set 
		
	nama_produk='$namaproduk',
		harga='$harga',
		gambar='$namabaru'
		where id_produk='$id'
		
		
		")or die(mysqli_error()); 
			
 		unlink('gambar/'.$fotolama);
?>

	<script type="text/javascript">
		alert('Data produk berhasil disimpan');
		window.location.href="../../?a=produk"

	</script>
<?php }else{ ?>
	<script type="text/javascript">
		alert('Data ukm gagal disimpan\nharap pilih file gambar dengan benar');
		window.location.href="../../?a=ukm"

	</script>
<?php } 
}?>