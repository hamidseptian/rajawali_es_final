<?php 
$q = mysqli_query($conn, "SELECT * from produk");
?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Produk</h3>
</div>
<?php

while ($d = mysqli_fetch_array($q)) { ?>
	

<div class="col-lg-4 col-sm-6" style="margin-bottom:35px">
	<div class="product-item">
		<div class="pi-pic">
			
			<img src="../user/admin/form/produk/gambar/<?php echo $d['gambar'] ?>" alt="<?php echo $d['gambar'] ?>" height="200px" width="100%">
			<div class="pi-links">
				
				<a href="?m=v_produk&idp=<?php echo $d['id_produk'] ?>" class="add-card"><i class="flaticon-bag"></i><span>View Detail</span></a>
				
			</div>
		</div>
		<div>
			<br>
			<a href="">
				
			<b>	<?php echo $d['nama_produk'] ?></b><br>	 
			</a>
			Rp. <?php echo number_format($d['harga']) ?> / Item
			

		</div>
	</div>
</div>
	<?php } ?>



 <div class="clearfix"></div>

