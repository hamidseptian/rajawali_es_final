<?php 
$id = $_SESSION['iduser'];
$q = mysqli_query($conn, "SELECT * from pesanan as a
left join produk as b on a.id_produk=b.id_produk
	where a.status='Masuk Ke Keranjang' and a.id_pelanggan='$id'");
$j = mysqli_num_rows($q);
?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Keranjang Belanja</h3>
</div>


<!-- <div class="col-md-2">
</div> -->
<?php if ($j==0) {
	echo '
<div class="col-md-12">
	<div class="alert alert-info">Keranjang Kosong</div>
	</div>';	
}else{ ?>

<div class="col-md-12">
	<!-- <h4>Biaya Cetak</h4> -->
	<table class="table table-bordered table-striped">
		<tr style="background: aqua">
			<td>No</td>
			<td>Produk</td>
			<td>Qty</td>
			<td>Harga</td>
			<td>Total</td>
			<td>Action</td>
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
			<td><a href="form/keranjang/hapus.php?id=<?php echo $d['id_pesanan'] ?>" onclick="return confirm('Hapus Item..??')">Hapus</a></td>
		</tr>
	

	<?php } ?>
	
	</table>

	<br>
	<h4>Total : <?php echo number_format($totalbiaya) ?></h4>
	<br>
	<a href="form/keranjang/konfirmasi.php?b=<?php echo $totalbiaya ?>" class="btn btn-info">Konfirmasi Pesanan</a>
	<!-- <p>U</p> -->
</div>





 <div class="clearfix"></div>
<?php } ?>