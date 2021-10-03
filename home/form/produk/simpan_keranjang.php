<?php
session_start();
include "../../../assets/koneksi.php";


$idpel = $_SESSION['iduser'];
	$idp = $_POST['idp'];
	$harga = $_POST['harga'];
	$jml = $_POST['jml'];

$cek_pesanan = mysqli_query($conn, "SELECT * from pesanan where id_produk='$idp' and id_pelanggan='$idpel' and status='Masuk Ke Keranjang'")or die(mysqli_error());
$dcekpesanan = mysqli_fetch_array($cek_pesanan);
$jpesanan = mysqli_num_rows($cek_pesanan);

if ($jpesanan == 0 ) {
	$qty = $jml;
$query = "INSERT INTO pesanan set 
	id_pelanggan='$idpel',
	id_produk='$idp',
	 
	harga_satuan='$harga',
	qty='$qty',
	status='Masuk Ke Keranjang'";
}else{
	$qty = $jml+ $dcekpesanan['qty'];

$query = "UPDATE pesanan set 

	harga_satuan='$harga',
	qty='$qty' where 
	id_pelanggan='$idpel' and 
	id_produk='$idp' and 
	status='Masuk Ke Keranjang'";
}

$q = mysqli_query($conn,$query)or die(mysqli_error());
			
?>
<script type="text/javascript">
	alert('produk pilihan anda sudah di masukkan ke keranjang');
	window.location.href='../../?m=produk'
</script>