<?php 
include "../../../assets/koneksi.php";
$id = $_GET['id'];
$foto = $_GET['file'];

$q = mysqli_query($conn, "DELETE from cetak_foto where id_cetak='$id'");
@unlink('../galeri/file_foto/'.$foto);
?>
<script type="text/javascript">
	alert('Foto dihapus');
	window.location.href='../../?m=keranjang'
</script>