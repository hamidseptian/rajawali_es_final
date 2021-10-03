<?php 
include "../../../assets/koneksi.php";
$id = $_GET['id'];


$q = mysqli_query($conn, "DELETE from pesanan where id_pesanan='$id'");
?>
<script type="text/javascript">
	alert('pesanan anda  dihapus dari keranjang');
	window.location.href='../../?m=keranjang'
</script>