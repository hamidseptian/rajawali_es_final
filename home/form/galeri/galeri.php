<?php 
$q = mysqli_query($conn, "SELECT * from galeri");
?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Galeri</h3>
</div>
<?php

while ($d = mysqli_fetch_array($q)) { ?>
	

<div class="col-lg-4 col-sm-6" style="margin-bottom:10px">
	<div class="product-item">
		<div class="pi-pic">
			<?php if ($d['bisa_booking']=='Ya') { ?>
				<div class="tag-sale">System Booking</div>
			<?php } ?>
			<img src="../user/admin/form/galeri/gambar/<?php echo $d['foto'] ?>" alt="">
			<div class="pi-links">
				
				
			</div>
		</div>
		
	</div>
</div>
	<?php } ?>
 <div class="clearfix"></div>
