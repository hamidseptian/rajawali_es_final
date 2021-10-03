
<?php 
session_start();
include "../../../../assets/koneksi.php";
$id_pembayaran=$_GET['id_pembayaran'];
$id=$_GET['id'];
$waktu=$_GET['waktu'];
$idtoko = $_SESSION['id_user'];


$q = mysqli_query($conn, "SELECT * from pesanan as a
left join produk as b on a.id_produk=b.id_produk
left join pelanggan c on a.id_pelanggan = c.id_pelanggan
	where a.status!='Masuk Ke Keranjang' and a.id_pelanggan='$id' and waktu_pesan='$waktu'");

while ($d = mysqli_fetch_array($q)) {
	$qty = $d['qty'];
	$id_pesanan = $d['id_pesanan'];
	$pelanggan = $d['nama_pelanggan'];
	$alamat = $d['alamat_pelanggan'];
	$produk = $d['nama_produk'];
	$harga = $d['harga'];
	$waktu_pesan = $d['waktu_pesan'];
	$pw = explode(' ', $waktu_pesan);
	$tgls = $pw[0];
	$jams = $pw[1];
	$keterangan = 'Pemesanan online oleh '.$pelanggan.' <br>Alamat :  '.$alamat.'';

	$q_insert = mysqli_query($conn, "INSERT into penjualan set 
		produk='$produk',
		harga_satuan='$harga',
		qty='$qty',
		tanggal_transaksi='$tgls',
		jam_transaksi='$jams',
		id_cabang='$idtoko',
		pesan_via='Online',
		keterangan = '$keterangan'
		"
	);



	$q_u = mysqli_query($conn, "UPDATE pesanan set status = 'Selesai' where id_pesanan='$id_pesanan'");
}


	$q1=mysqli_query($conn, "UPDATE pembayaran set status='Acc' where id_pembayaran='$id_pembayaran'") or die(mysqli_error()); 
	
?>

	<script type="text/javascript">
		alert('Pbayaran di terima \nPesanan di tambahkan ke data penjualan');
		window.location.href="../../?a=pesanan"

	</script>