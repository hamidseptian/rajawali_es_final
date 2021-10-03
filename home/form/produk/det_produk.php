<?php 
$id=$_GET['idp'];
$q = mysqli_query($conn, "SELECT * from produk where id_produk='$id'");





?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Detail Produk</h3>
</div>
<?php

$d = mysqli_fetch_array($q)  ?>
	

<div class="col-lg-4 col-sm-6">
	<div class="product-item">
		<div class="pi-pic">
			
			<img src="../user/admin/form/produk/gambar/<?php echo $d['gambar'] ?>" alt="<?php echo $d['gambar'] ?>"  width="100%">
		</div>
	
	</div>
</div>
	






	<div class="col-lg-8 product-details">
	
			
					<h2 class="p-title"><?php echo $d['nama_produk'] ?></h2>
					<p>Rp. <?php echo number_format($d['harga']) ?> / Item</p>
					
					
					
					<?php if ($_SESSION['level']=='Pelanggan') { ?>
					<h4 class="p-stock">Silahkan masukkan orderan anda  <span>disini</span></h4>
					<form action="form/produk/simpan_keranjang.php" method="post" enctype="multipart/form-data">
					
					<div class="form-group">
						<label>jumlah pesanan</label><br>
                        <input type="hidden" name="idp" value="<?php echo $id ?>">
                        <input type="hidden" name="harga" value="<?php echo $d['harga'] ?>">
                        <input type="text" name="jml" size="5" required  placeholder="Jumlah pesanan" class="form-control">
					</div>
					
					<div class="form-group">
						
                        <input type="submit" class="btn btn-info" value="Masukan ke keranjang">
					</div>
					   
					</form>
					<?php }else{ ?>
						<div class="alert alert-info">Anda bisa memesan setelah login</div>

					<?php } ?>
					
				
				</div>


 <div class="clearfix"></div>
 <div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
</div>


<script>
$('#wf').change(function(){

	var wf = $('#wf').is(':checked');
	if (wf==true) {
		$('#wf').val('Ya');
	}else{
		$('#wf').val('Tidak');

	}

})

</script>