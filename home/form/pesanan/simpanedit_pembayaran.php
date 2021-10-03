<?php 
include "../../../assets/koneksi.php";

session_start();

$filelama = $_POST['filelema'];
$id_pembayaran = $_POST['id_pembayaran'];


			$ekstensi_diperbolehkan	= array('png','jpg','PNG','JPG','JPEG');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];
			$namabaru = date('ymdhis').$nama;
 
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
					move_uploaded_file($file_tmp, '../../../user/admin/form/pesanan/gambar/'.$namabaru);


unlink("../../../user/admin/form/pesanan/gambar/".$filelama);			
	$q1=mysqli_query($conn, "UPDATE pembayaran set 
		

		file='$namabaru',
		status='Pengecekan'
		where id_pembayaran = '$id_pembayaran'
		
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