<?php 
$tgl=$_GET['tgl'];
$idj=$_GET['idj'];
$kegiatan=$_GET['k'];
$lama=$_GET['lama'];
$jambook=$_GET['jambook'];

$q = mysqli_query($conn, "SELECT * from paket where id_paket='$idj'");
$q2 = mysqli_query($conn, "SELECT * from harga_cetak");
$d = mysqli_fetch_array($q);
?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Booking Paket <?php echo $d['nama_paket'] ?></h3>
</div>
<?php

  ?>
	

<div class="col-lg-6 col-sm-6">
	<div class="product-item">
		<div class="pi-pic">
			<?php if ($d['bisa_booking']=='Ya') { ?>
				<!-- <div class="tag-sale">System Booking</div> -->
			<?php } ?>
			<img src="gambar/logofoto.jpg" alt="">
		</div>
	
	</div>
</div>
	






	<div class="col-lg-6 product-details">
		<table class="table">
			<tr>
				<td>Nama Paket </td>
				<td><?php echo $d['nama_paket'] ?></td>
			</tr>
			<tr>
				<td>Harga Paket </td>
				<td><?php echo $d['biaya'] ?></td>
			</tr>
			<tr>
				<td>Fasilitas </td>
				<td><?php echo $d['fasilitas'] ?></td>
			</tr>
			<tr>
				<td>Tanggal Mulai Acara </td>
				<td><?php echo $tgl ?><br>Jam <?php echo $jambook ?></td>
			</tr>
			<tr>
				<td>Lama Acara </td>
				<td><?php echo $lama ?></td>
			</tr>
			<tr>
				<td>Untuk Kegiatan</td>
				<td><?php echo $kegiatan ?></td>
			</tr>
		</table>
		<a href="form/jasa/simpan_order_jasa.php?tgl=<?php echo $tgl ?>&idj=<?php echo $idj ?>&k=<?php echo $kegiatan ?>&lama=<?php echo $lama ?>&jambook=<?php echo $jambook ?>" class="btn btn-info btn-xs">Masuk Ke Keranjang</a>
	</div>


 <div class="clearfix"></div>
 <div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
	<div id="hasilbook"></div>
</div>


<script>
	$('#cekbooking').click(function(){
		var tglbook = $('#tglbook').val();
		if (tglbook=='') {
			alert("anda belum memilih tanggal");
			return false
		}else{
			$.ajax({
				url : "form/jasa/cek_booking.php",
				data: {
					'tglbook' : tglbook,
					'idpaket' : '<?php echo $id ?>'
				},
				type : 'POST',
				success : function(data){
					$('#hasilbook').html(data);
				},
				error : function(){
					alert('ajax cek booking error');
				}
			})
		}
	})
</script>