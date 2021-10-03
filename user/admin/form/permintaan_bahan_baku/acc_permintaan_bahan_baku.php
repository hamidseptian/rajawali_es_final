
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];
$acc=$_GET['acc'];
$id_cabang=$_GET['id_cabang'];
$tgl=$_GET['tgl'];

if ($acc=='Acc') {
	$keputusan = "Diproses";
	$stok_update = $_GET['stok_avs'] - $_GET['stok_request'];
	$id_bb=$_GET['id_bb'];
	$q_update_stok = mysqli_query($conn, "UPDATE bahan_baku set stok = '$stok_update' where id_bahan_baku='$id_bb'")	;
	// $q1=mysqli_query($conn, "UPDATE management_bahan_baku set status='$acc' where id_managemen='$id'") or die(mysqli_error()); 
}else{
	$keputusan = "Ditolak";
}
	$q1=mysqli_query($conn, "UPDATE management_bahan_baku set status='$acc' where id_managemen='$id'") or die(mysqli_error()); 
	
?>

	<script type="text/javascript">
		alert('permintaan bahan baku di <?php echo $acc ?>');
		window.location.href="../../?a=detail_permintaan_bahan_baku&tgl=<?php echo $tgl ?>"

	</script>