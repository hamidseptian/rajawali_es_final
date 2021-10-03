
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];
$gm=$_GET['gambar'];

	$q1=mysqli_query($conn, "DELETE from produk where id_produk='$id'") or die(mysqli_error()); 

	unlink('gambar/'.$gm);
	
?>

	<script type="text/javascript">
		alert('Data produk dihapus');
		window.location.href="../../?a=produk"

	</script>