<?php 
include "../../../../assets/koneksi.php";
session_start();
$id_produk=$_POST['id_produk'];
$qty=$_POST['qty'];
$tgl=$_POST['tgl'];
$jam=$_POST['jam'];
$id_cabang = $_SESSION['id_user'];

$cek_penjualan = mysqli_query($conn, "SELECT * from penjualan where tanggal_transaksi='$tgl' and id_cabang='$id_cabang'")or die(mysqli_error());
$j_cek_penjualan = mysqli_num_rows($cek_penjualan);
if ($j_cek_penjualan>0) {
	$alert = "Data penjualan gagal disimpan\nPenjualan pada tanggal ".$tgl."sudah di inputkan";
}else{
	foreach ($id_produk as $key => $value) {
		if ($qty[$key] !='') {
			$id = $id_produk[$key];
			$q_produk = mysqli_query($conn, "SELECT * from produk where id_produk ='$id'");
			$d_produk = mysqli_fetch_array($q_produk);
			$qty_ok = $qty[$key];
			$produk = $d_produk['nama_produk'];
			$harga_satuan = $d_produk['harga'];
			$q_i = mysqli_query($conn, "INSERT into penjualan set 
				produk='$produk',
				harga_satuan='$harga_satuan',
				qty='$qty_ok',
				tanggal_transaksi='$tgl',
				jam_transaksi='$jam',
				id_cabang='$id_cabang'

				")or die(mysqli_error());
		}

	}
	$alert = "Data penjualan berhasil disimpan";
}

	
?>

	<script type="text/javascript">
		alert('<?php echo $j_cek_penjualan ?>');
		window.location.href="../../?a=penjualan"

	</script>
