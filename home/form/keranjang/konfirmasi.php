<?php
session_start();
include "../../../assets/koneksi.php";
$idpel = $_SESSION['iduser'];
$timestamp = date('Y-m-d h:i:s');
$id_cabang = $_POST['id_cabang'];
$q = mysqli_query($conn, "UPDATE pesanan
	set status='Order',
	waktu_pesan='$timestamp', 
	id_cabang='$id_cabang'
 where id_pelanggan='$idpel' and status='Masuk Ke Keranjang'");

?>
<script type="text/javascript">
	alert('Pesanan Di Konfirmasi');
	window.location.href='../../?m=detail_pesanan&waktu=<?php echo $timestamp ?>&id_cabang=<?php echo $id_cabang ?>'
</script>