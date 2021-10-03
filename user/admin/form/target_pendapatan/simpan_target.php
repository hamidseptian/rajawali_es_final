<?php 
include "../../../../assets/koneksi.php";
$id_cabang=$_POST['id_cabang'];
$bulan=$_POST['bulan_input'];
$tahun=$_POST['tahun_input'];
$target=$_POST['target'];

$q_cek = mysqli_query($conn, "SELECT * from target where id_cabang='$id_cabang' and bulan='$bulan' and tahun='$tahun'");
$d_cek = mysqli_fetch_array($q_cek);
$j_cek = mysqli_num_rows($q_cek);
 
 if ($j_cek==0) {
 	$q = "INSERT into target set
 	id_cabang='$id_cabang', 
 	bulan='$bulan', 
 	tahun='$tahun',
 	target_penjualan='$target'
 	";
 }else{
 	$q = "UPDATE target set target_penjualan='$target'
 	where id_cabang='$id_cabang' and bulan='$bulan' and tahun='$tahun'";
 }
 mysqli_query($conn, $q)or die(mysqli_error());



?>

	<script type="text/javascript">
		alert('Data target penjualan berhasil disimpan');
		window.location.href="../../?a=target_pendapatan&bulan=<?php echo $bulan ?>&tahun=<?php echo $tahun ?>"

	</script>
