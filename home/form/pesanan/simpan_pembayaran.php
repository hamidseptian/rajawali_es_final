<?php 
include "../../../assets/koneksi.php";

session_start();

$id_pelanggan = $_SESSION['iduser'];
$id_cabang = $_POST['id_cabang'];
$waktu = $_POST['waktu_pesan'];


			$ekstensi_diperbolehkan	= array('png','jpg','PNG','JPG','JPEG');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];
			$namabaru = date('ymdhis').$nama;
 
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
					move_uploaded_file($file_tmp, '../../../user/admin/form/pesanan/gambar/'.$namabaru);


			
	$q1=mysqli_query($conn, "INSERT into pembayaran set 
		
		id_pelanggan='$id_pelanggan',
		id_cabang='$id_cabang',
		waktu_pesan='$waktu',
		file='$namabaru',
		status='Pengecekan'
		
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data pesanan berhasil disimpan');
		window.location.href="../../?m=pesanan"

	</script>
<?php }else{ ?>
	<script type="text/javascript">
		alert('Data pesanan gagal disimpan\nharap pilih file gambar dengan benar');
		window.location.href="../../?m=detail_pesanan&id_cabang=<?php echo $id_cabang?>&waktu=<?php echo $waktu ?>"

	</script>
<?php } ?>