<?php 
$id = $_SESSION['iduser'];
$waktu = $_GET['waktu'];
$id_cabang = $_GET['id_cabang'];
$q = mysqli_query($conn, "SELECT * from pesanan as a
left join produk as b on a.id_produk=b.id_produk
	where a.status!='Masuk Ke Keranjang' and a.id_pelanggan='$id' and waktu_pesan='$waktu'");
$j = mysqli_num_rows($q);

?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Detail pesanan</h3>
<p>tanggal <?php echo $waktu ?></p>
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
	
	</table>
</div>

	<br>
	
	
</div>

<div class="col-md-4">
	<h4>Total Biaya : <?php echo number_format($totalbiaya) ?></h4>
	<?php 
	$q_pembayaran = mysqli_query($conn, "SELECT * from pembayaran where id_pelanggan='$id' and id_cabang ='$id_cabang' and waktu_pesan='$waktu'");
	$j_pembayaran = mysqli_num_rows($q_pembayaran);
	$d_pembayaran = mysqli_fetch_array($q_pembayaran);
	if ($j_pembayaran == 0) { ?>
	<form action="form/pesanan/simpan_pembayaran.php" method="post" enctype="multipart/form-data">
	Silahkan upload bukti pembayaran 
		<div class="form-group"><br>
			<input type="hidden" name="id_cabang" value="<?php echo $id_cabang ?>" style="display:none">
			<input type="hidden" name="waktu_pesan"  value="<?php echo $waktu ?>" style="display:none">
			<input type="file" name="file"><br><br>
			<button class="btn btn-info btn-sm">Upload Bukti Pembayaran</button>
		</div>
		
	</form>
	<hr>
	Atau pembayaran langsung ke alamat kami di<br>

	<?php
	$qcabang = mysqli_query($conn , "SELECT * from cabang where id_cabang='$id_cabang'");
	$dcabang = mysqli_fetch_array($qcabang);
	echo $dcabang['alamat'];
	 ?>
	<?php 
	}else{ ?>
		Bukti pembayaran anda : 
		<img src="../user/admin/form/pesanan/gambar/<?php echo $d_pembayaran['file'] ?>">
		<?php if ($d_pembayaran['status']=='Pengecekan') {
			echo "Pembayaran anda sedang di cek admin kami";
		}else{ ?>
			Pembayaran anda ditolak admin <br>Silahkan di ulangi kembali <br>
			<form action="form/pesanan/simpanedit_pembayaran.php" method="post" enctype="multipart/form-data">
	
		<div class="form-group"><br>
			<input type="hidden" name="id_pembayaran" value="<?php echo $d_pembayaran['id_pembayaran'] ?>">
			<input type="hidden" name="filelema" value="<?php echo $d_pembayaran['file'] ?>">
			
			<input type="file" name="file"><br><br>
			<button class="btn btn-info btn-sm">Upload Bukti Pembayaran</button>
		</div>
		
	</form>
		<?php } ?>
	<?php }
	 // echo "<br>Atau pembayaran langsung di kantor  kami<br>Jl. Ir. H. Juanda No.15, Rimbo Kaluang, Kec. Padang Bar., Kota Padang, Sumatera Barat 25515";
	


	 ?>
	
	 <br>
	 <!-- Silahkan laporkan pembayarna anda <a href="https://api.whatsapp.com/send?phone=081993962256" target="_blank">disini</a> untuk di proses admin -->



	 
</div>

	


 <div class="clearfix"></div>



