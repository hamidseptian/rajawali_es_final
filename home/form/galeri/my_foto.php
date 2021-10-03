<?php 
$id = $_SESSION['iduser'];
$q = mysqli_query($conn, "SELECT foto from cetak_foto
	where id_pelanggan='$id'");
$j = mysqli_num_rows($q);
?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Fota Saya</h3>
</div>


<!-- <div class="col-md-2">
</div> -->
<?php 
while ($d = mysqli_fetch_array($q)) { ?>
	

<div class="col-lg-4 col-sm-6" style="margin-bottom:10px">
	<div class="product-item">
		<div class="pi-pic">
		
			<img src="form/galeri/file_foto/<?php echo $d['foto'] ?>" alt="">
			
		</div>
		
	</div>
</div>
	<?php } ?>
 <div class="clearfix"></div>