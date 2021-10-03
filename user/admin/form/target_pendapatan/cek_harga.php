<?php 
include "../../../../assets/koneksi.php";

$id_produk=$_POST['id_produk'];
$qty=$_POST['qty'];
$tgl=$_POST['tgl'];
$jam=$_POST['jam'];
$no = 1;

 ?>
 <label>List Pesanan</label>
 <div id="pesan"></div>
 <div id="list">
 	
 
	 <table class="table table-bordered table-striped">
		<tr>
			<td>No</td>
			<td>Item</td>
			<td>Harga Satuan</td>
			<td>Qty</td>
			<td>Total</td>
		</tr>
	<?php 
	$total_harga = 0;
	foreach ($id_produk as $key => $value) {
		if ($qty[$key] !='') {
			$id = $id_produk[$key];
			$q_produk = mysqli_query($conn, "SELECT * from produk where id_produk ='$id'");
			$d_produk = mysqli_fetch_array($q_produk);
			$qty_ok = $qty[$key];
			$produk = $d_produk['nama_produk'];
			$harga_satuan = $d_produk['harga']; 
			$total = $harga_satuan * $qty_ok;
			$total_harga += $total;
			?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $produk ?></td>
				<td><?php echo number_format($harga_satuan) ?></td>
				<td><?php echo $qty_ok ?></td>
				<td><?php echo number_format($total) ?></td>
			</tr>
		<?php }

	}

		
	?>
		<tr>
			<td colspan="4">Total Harga</td>
			<td><?php echo number_format($total_harga) ?></td>
		</tr>
	</table>
	</div>

<?php if ($total_harga>0){ ?>
	<button type="submit" class="btn btn-info pull-left" id="" target="_blank">Simpan Dan Print</button>
	<script type="text/javascript">
		$('#list').attr('style','');
		$('#pesan').html('');
	</script>

<?php }else{ ?>
	<script type="text/javascript">
		$('#list').attr('style','display:none');
		$('#pesan').html('<div class="alert alert-danger">Harap masukan	jumlah pesanan produk</div>');
	</script>

<?php } ?>