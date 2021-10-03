<?php
$id = $_SESSION['iduser'];
$q = mysqli_query($conn, "SELECT * from booking as a
left join paket as b on a.id_paket=b.id_paket
	where a.status='Masuk Ke Keranjang' and a.id_pelanggan='$id'");

  ?>
	

<div class="col-lg-6 col-sm-12">
	<h3>Booking Saya</h3>
	<table class="table table-bordered table-striped">
		<tr style="background: aqua">
			<td>No</td>
			<td>Paket</td>
			<td>Kegiatan</td>
			<td>Tanggal Mulai Kegiatan</td>
			
			<td>Lama Acara</td>

		</tr>
<?php 
$no = 1;
$nol=0;
while ($d = mysqli_fetch_array($q)) { ?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $d['nama_paket'] ?></td>
			<td><?php echo $d['kegiatan'] ?></td>
			<td><?php echo $d['tanggal_mulai'] ?></td>
			
			<td><?php echo $d['lama_acara'] ?></td>
			

			
		</tr>
	

	<?php } ?>
	
	</table>
</div>
<div class="col-lg-6 col-sm-12">
	<h3>All Book</h3>
	<?php include 'kalender.php'; ?>
</div>
	






