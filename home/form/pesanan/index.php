<?php 
$id = $_SESSION['iduser'];
$q = mysqli_query($conn, "SELECT sum(qty * harga_satuan) as total, sum(qty) as jml_produk, waktu_pesan, status, id_cabang from pesanan as a
left join produk as b on a.id_produk=b.id_produk
	where a.status='Order' and a.id_pelanggan='$id' group by waktu_pesan");
$j = mysqli_num_rows($q);
?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Riwayat Pemesanan</h3>
</div>


<!-- <div class="col-md-2">
</div> -->
<?php if ($j==0) {
	echo '
<div class="col-md-12">
	<div class="alert alert-info">Tidak ada riwayat pemesanan</div>
	</div>';	
}else{ ?>

<div class="col-md-12">
	<!-- <h4>Biaya Cetak</h4> -->
	<table class="table table-bordered table-striped">
		<tr style="background: aqua">
			<td>No</td>
			<td>Waktu Pesan</td>
			<td>Jumlah Produk</td>
			<td>Total Biaya</td>
			<td>Status Pesanan</td>
			<td>Action</td>
		</tr>
<?php 
$no = 1;
$nol=0;
while ($d = mysqli_fetch_array($q)) { 
	
	?>
		<tr>
			<td><?php echo $no++ ?></td>
			
			<td><?php echo $d['waktu_pesan'] ?></td>
			<td><?php echo $d['jml_produk'] ?></td>
			<td><?php echo number_format($d['total']) ?></td>
			<td><?php echo $d['status'] ?></td>
			
			<td><a href="?m=detail_pesanan&waktu=<?php echo $d['waktu_pesan'] ?>&id_cabang=<?php echo $d['id_cabang'] ?>">Lihat Detail</a></td>
		</tr>
	

	<?php } ?>
	
	</table>

	<br>
	
</div>





 <div class="clearfix"></div>
<?php } ?>