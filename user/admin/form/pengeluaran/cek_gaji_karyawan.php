<?php 
include "../../../../assets/koneksi.php";

$id=$_GET['id'];

$q_karyawan = mysqli_query($conn, "SELECT * from karyawan k left join penggajian p on k.id_penggajian = p.id_penggajian where k.id_karyawan ='$id'");
$d_karyawan = mysqli_fetch_array($q_karyawan);


$kumpulkan_data = [
	'karyawan'=> $d_karyawan['nama'],
	'gaji'=> $d_karyawan['gaji'],
	'jabatan'=> $d_karyawan['jabatan'],
];
			
echo json_encode($kumpulkan_data);
			?>

	