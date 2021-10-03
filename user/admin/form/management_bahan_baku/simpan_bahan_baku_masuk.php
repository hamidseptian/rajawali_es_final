<?php 
include "../../../../assets/koneksi.php";

$id_bb=$_POST['id_bb'];
$stok=$_POST['stok'];
$tgls = date('Y-m-d');
foreach ($id_bb as $key => $value) {
	if ($stok[$key] !='') {
			
		$id = $id_bb[$key];
		$stokp = $stok[$key] == '' ? 0 : $stok[$key];
		echo $stokp.'<br>';
		$cek_bb = mysqli_query($conn, "SELECT * from bahan_baku where id_bahan_baku='$id'");
		$dcek_bb = mysqli_fetch_array($cek_bb);
		$namabahan = $dcek_bb['nama_bahan_baku'];
		$satuan = $dcek_bb['satuan'];
		$harga_satuan = $dcek_bb['harga_satuan'];
		$stok_ada = $dcek_bb['stok'];

		$stok_update= $stok_ada + $stokp;

		$i_mbb = mysqli_query($conn, "INSERT into management_bahan_baku set
			id_bahan_baku = '$id',
			nama_bahan_baku = '$namabahan',
			satuan='$satuan', 
			harga_satuan = '$harga_satuan',
			qty='$stokp',
			jenis='Masuk',
			tgl_transaksi = '$tgls',
			status = 'Selesai'
			")or die(mysqli_error());

		// $u_stok = mysqli_query($conn, "UPDATE bahan_baku set stok = '$stok_update' where id_bahan_baku='$id'");


	}

}

	
?>

	<script type="text/javascript">
		alert('Data bahan baku berhasil disimpan');
		window.location.href="../../?a=management_bahan_baku"

	</script>
