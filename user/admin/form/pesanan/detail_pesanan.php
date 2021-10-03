<?php 
$id_cabang = $_SESSION['id_user'];
$id = $_GET['id_pelanggan'];
$waktu = $_GET['waktu'];


$q_pelanggan = mysqli_query($conn, "SELECT * from pelanggan where id_pelanggan = '$id'");
$d_pelanggan  = mysqli_fetch_array($q_pelanggan);	
$q = mysqli_query($conn, "SELECT * from pesanan as a
left join produk as b on a.id_produk=b.id_produk
	where a.status!='Masuk Ke Keranjang' and a.id_pelanggan='$id' and waktu_pesan='$waktu'");
$j = mysqli_num_rows($q);

?>
<div class="box-header with-border">
  <h3 class="box-title">Detail Pemesanan </h3>

 
</div>



<div class="col-md-8">
	<div style="overflow-x: scroll	">
	<!-- <h4>Biaya Cetak</h4> -->
	<table class="table table-bordered table-striped">
		<tr style="background: aqua">
			<td>No</td>
			<td>Produk</td>
			<td>Qty</td>
			<td>Harga</td>
			<td>Total</td>
			
		</tr>
<?php 
$no = 1;
$nol=0;
$totalbiaya = 0;
while ($d = mysqli_fetch_array($q)) { 
	$total = $d['qty']*$d['harga'];
	$totalbiaya += $total;
?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $d['nama_produk'] ?></td>
			<td><?php echo number_format($d['qty']) ?></td>
			<td><?php echo number_format($d['harga']) ?></td>
			
			<td><?php echo number_format($total) ?></td>
			
		</tr>
	

	<?php } ?>
	<tr>	
		<td colspan="4">Total</td>
		<td><?php echo number_format($total) ?></td>
	</tr>
	</table>
</div>

	<br>
	
	
</div>

<div class="col-md-4">
	<h4>Identitas Pemesan :</h4>
	<table class="table">
		<tr>
			<td>Nama</td>
			<td><?php echo 	$d_pelanggan['nama_pelanggan'] ?>	</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><?php echo 	$d_pelanggan['alamat_pelanggan'] ?>	</td>
		</tr>
		<tr>
			<td>No HP</td>
			<td><?php echo 	$d_pelanggan['nohp_pelanggan'] ?>	</td>
		</tr>
		<tr>
			<td>Tagihan</td>
			<td><?php echo 	number_format($total) ?>	</td>
		</tr>
	</table>
	<br>

	<h4>Pembayaran Tagihan</h4>
	<?php 
	$q_pembayaran = mysqli_query($conn, "SELECT * from pembayaran where id_pelanggan='$id' and id_cabang='$id_cabang' and waktu_pesan='$waktu'");
	$d_pembayaran = mysqli_fetch_array($q_pembayaran);
	$j_pembayaran = mysqli_num_rows($q_pembayaran);
	if ($j_pembayaran==0) {
		echo "Pelanggan belum melakukan pembayaran";
	}else{ 
		?>
		<img src="form/pesanan/gambar/<?php echo $d_pembayaran['file'] ?>" width="100%">
		<?php 
		echo 'Status : '.$d_pembayaran['status'];
		if ($d_pembayaran['status']=='Pengecekan') { ?>
			<br>
			<a href="form/pesanan/acc_pembayaran.php?id=<?php echo $id ?>&waktu=<?php echo $waktu ?>&id_pembayaran=<?php echo $d_pembayaran['id_pembayaran'] ?>" class="btn btn-info btn-xs">Konfirmasi Pembayaran</a>
			<a href="form/pesanan/tolak_pembayaran.php?id=<?php echo $d_pembayaran['id_pembayaran'] ?>" class="btn btn-info btn-xs">Tolak Pembayaran</a>

		<?php }

		 ?>
	<?php }	 ?>
	
	 <br>
	 



	 
</div>

	


 <div class="clearfix"></div>



