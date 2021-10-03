<?php 
$id=$_GET['idc'];
$q = mysqli_query($conn, "SELECT * from harga_cetak where id_hc='$id'");
$q2 = mysqli_query($conn, "SELECT * from harga_cetak");



$qedit = mysqli_query($conn, "SELECT * from harga_edit");
$edit = array();
$data['id'] = '';
$data['nama'] = 'Tanpa Edit';
$data['harga'] = '0';
array_push($edit, $data);

while ($dedit = mysqli_fetch_array($qedit)) {
    $data['id'] = $dedit['id_he'];
    $data['nama'] = $dedit['nama_edit'];
    $data['harga'] = $dedit['harga_edit'];
    array_push($edit, $data);
}


?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Detail Cetak</h3>
</div>
<?php

$d = mysqli_fetch_array($q)  ?>
	

<div class="col-lg-4 col-sm-6">
	<div class="product-item">
		<div class="pi-pic">
			<?php if ($d['bisa_booking']=='Ya') { ?>
				<!-- <div class="tag-sale">System Booking</div> -->
			<?php } ?>
			<img src="gambar/logofoto.jpg" alt="">
		</div>
	
	</div>
</div>
	






	<div class="col-lg-8 product-details">
	
			
					<h2 class="p-title"><?php echo $d['ukuran'] ?></h2>
					<p><?php echo $d['keterangan'] ?></p>
					
					
					<div class="p-review">
						<a href="#">Tanpa Frame : <?php echo number_format($d['tanpa_frame']) ?></a>|<a href="#"> Dengan Frame : <?php echo number_format($d['dengan_frame']) ?></a>
					</div>
					<?php if ($_SESSION['level']=='Pelanggan') { ?>
					<h4 class="p-stock">Silahkan masukkan orderan anda  <span>disini</span></h4>
					<form action="form/jasa/simpan_order_cetak.php" method="post" enctype="multipart/form-data">
					
					<div class="form-group">
						<label>File Foto</label><br>
						<input type="file" name="file" required> <br>
						<input type="checkbox" name="wf" id="wf"> Order dengan frame
					</div>
					<div class="form-group">
						<label>jumlah Cetak</label><br>
                        <input type="hidden" name="idc" value="<?php echo $id ?>">
                        <input type="text" name="jml" size="5" required  placeholder="Jumlah Cetak" class="form-control">
					</div>
					<div class="form-group">
						<label>Edit Foto</label><br>
                               <select name="edit" class="form-control">
                            <?php foreach ($edit as $d) { ?>
                                <option value="<?php echo $d['id'] ?>"><?php echo $d['nama'].' - '.$d['harga'] ?></option>
                            <?php } ?>
                        </select>
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