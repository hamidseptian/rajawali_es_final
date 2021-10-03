<?php
session_start();
include "../../../assets/koneksi.php";
$idpel = $_SESSION['iduser'];
$timestamp = date('Y-m-d h:i:s');
$q = mysqli_query($conn, "UPDATE pesanan
	set status='Order',
	waktu_pesan='$timestamp'
 where id_pelanggan='$idpel' and status='Masuk Ke Keranjang'");

?>
<script type="text/javascript">
	alert('Pesanan Di Konfirmasi');
	window.location.href='../../?m=detail_pesanan&waktu=<?php echo $timestamp ?>'
</script>