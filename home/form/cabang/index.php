<?php 
$q = mysqli_query($conn, "SELECT * from cabang");
?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Cabang Kami</h3>
</div>
<?php

while ($d = mysqli_fetch_array($q)) { ?>
	

<div class="col-lg-4 col-sm-6" style="margin-bottom:35px">
	<div class="product-item">
		<div class="pi-pic">
			
			<img src="gambar/bg1.jpg" alt="">
			<div class="pi-links">
				
				<!-- <a href="?m=v_jasa&idj=<?php echo $d['id_paket'] ?>" class="add-card"><i class="flaticon-bag"></i><span>View Detail</span></a> -->
				
			</div>
		</div>
		<div>
			<br>
			
			<b>	<?php echo $d['nama_cabang'] ?></b><br>	 
			<?php echo $d['alamat'] ?>
			

		</div>
	</div>
</div>
	<?php } ?>



 <div class="clearfix"></div>

