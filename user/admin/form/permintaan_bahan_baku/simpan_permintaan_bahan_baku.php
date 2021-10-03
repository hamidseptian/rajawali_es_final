<?php 
session_start();
include "../../../../assets/koneksi.php";
$idcabang = $_SESSION['id_user'];

$id_bb=$_POST['id_bb'];
$stok=$_POST['stok'];
$tgls = date('Y-m-d');
foreach ($id_bb as $key => $value) {
	if ($stok[$key] !='') {
			
		$id = $id_bb[$key];
		$stokp = $stok[$key] == '' ? 0 : $stok[$key];

		$cek_bb = mysqli_query($conn, "SELECT * from bahan_baku where id_bahan_baku='$id'");
		$dcek_bb = mysqli_fetch_array($cek_bb);
		$namabahan = $dcek_bb['nama_bahan_baku'];
		$satuan = $dcek_bb['satuan'];
		$harga_satuan = $dcek_bb['harga_satuan'];
		

		$cek_sudah_request = mysqli_query($conn, "SELECT * from management_bahan_baku where id_bahan_baku='$id' and status='Request' and tgl_transaksi='$tgls' and id_cabang='$idcabang'");
		$jcek_sudah_request = mysqli_num_rows($cek_sudah_request);
		if ($jcek_sudah_request==0) {

		$i_mbb = mysqli_query($conn, "INSERT into management_bahan_baku set
			id_bahan_baku = '$id',
			nama_bahan_baku = '$namabahan',
			satuan='$satuan', 
			harga_satuan = '$harga_satuan',
			qty='$stokp',
			jenis='Keluar',
			id_cabang='$idcabang',
			tgl_transaksi = '$tgls',
			status = 'Request'
			")or die(mysqli_error());
		}else{
		$dcek_sudah_request = mysqli_fetch_array($cek_sudah_request);
		$stokupdate = $dcek_sudah_request['qty'] + $stokp;
			$i_mbb = mysqli_query($conn, "UPDATE management_bahan_baku set
			qty='$stokupdate'

			where 
			id_cabang='$idcabang' and id_bahan_baku = '$id' and tgl_transaksi = '$tgls' and status = 'Request'
			")or die(mysqli_error());
		}


	}

}

	
?>

	<script type="text/javascript">
		alert('permintaan bahan baku anda sedang di proses');
		window.location.href="../../?a=permintaan_bahan_baku"

	</script>
