
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];
$acc=$_GET['acc'];

if ($acc=='Acc') {
	$stok_update = $_GET['stok_avs'] - $_GET['stok_request'];
	$id_bb=$_GET['id_bb'];
	$q_update_stok = mysqli_query($conn, "UPDATE bahan_baku set stok = '$stok_update' where id_bahan_baku='$id_bb'")	;
	// $q1=mysqli_query($conn, "UPDATE management_bahan_baku set status='$acc' where id_managemen='$id'") or die(mysqli_error()); 
}else{
}
	$q1=mysqli_query($conn, "UPDATE management_bahan_baku set status='$acc' where id_managemen='$id'") or die(mysqli_error()); 
	
?>

	<script type="text/javascript">
		alert('Data bahan baku masuk dihapus');
		window.location.href="../../?a=management_bahan_baku"

	</script>