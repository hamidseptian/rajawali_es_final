<?php 
$id=$_GET['idj'];
$q = mysqli_query($conn, "SELECT * from paket where id_paket='$id'");
$q2 = mysqli_query($conn, "SELECT * from harga_cetak");
?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Detail Paket</h3>
</div>
<?php

$d = mysqli_fetch_array($q)  ?>
	

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
		<form>
			
					<h2 class="p-title"><?php echo $d['nama_paket'] ?></h2>
					<h3 class="p-price">Rp. <?php echo number_format($d['biaya']) ?></h3>
					
					
					
					<?php if ($_SESSION['level']=='Pelanggan') { ?>
					<h4 class="p-stock">Silahkan isi form booking dan cek ketersediaan</h4>
						<div class="form-group">							
							<label>Tanggal Acara</label>
							<input type="date" name="tglbook" class="form-control" required id="tglbook">
						</div>
						<div class="form-group">							
							<label>Jam Acara</label>
							<input type="time" name="tglbook" class="form-control" required id="jambook">
						</div>
						<div class="form-group">							
							<label>Kegiatan</label>
							<input type="text" name="tglbook" class="form-control" required id="kegiatan">
						</div>
						<div class="form-group">							
							<label>Lama Acara</label>
							<input type="text" name="tglbook" class="form-control" required id="lama"  onKeyPress="return goodchars(event,'1234567890',this)">
						</div>
						<div class="form-group">							
							<a href="#" class="btn btn-info" id="cekbooking">Cek Ketersediaan</a>
						</div>
                    
					<?php }else{ ?>
						<div class="alert alert-info">Anda bisa memesan setelah login</div>

					<?php } ?>
					
				
		</form>
				</div>


 <div class="clearfix"></div>
 <div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
	<div id="hasilbook"></div>
</div>


<script>
	$('#cekbooking').click(function(){
		var tglbook = $('#tglbook').val();
		var kegiatan = $('#kegiatan').val();
		var lama = $('#lama').val();
		var jambook = $('#jambook').val();

		if (tglbook=='') {
			alert("anda belum memilih tanggal kegiatan");
			return false
		}
		if (jambook=='') {
			alert("anda belum memilih waktu kegiatan");
			return false
		}
		if (kegiatan=='') {
			alert("anda belum mengisi kegiatan");
			return false
		}
		if (lama=='') {
			alert("anda belum mengisi lama acara");
			return false
		}

			$.ajax({
				url : "form/jasa/cek_booking.php",
				data: {
					'tglbook' : tglbook,
					'jambook' : jambook,
					'lama' : lama,
					'kegiatan' : kegiatan,
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
		
	})
</script>