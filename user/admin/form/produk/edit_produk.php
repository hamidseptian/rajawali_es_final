<div class="box-header with-border">
  <h3 class="box-title">Edit Data produk</h3>

  <div class="box-tools pull-right">
    <a href="?a=produk" class="btn btn-info" >Kembali</a>
  </div>
</div>


<?php 
$id=$_GET['id'];
  $q1=mysqli_query($conn, "SELECT * from produk where id_produk='$id'") or die(mysqli_error());
  $d1=mysqli_fetch_array($q1);
  $j1=mysqli_num_rows($q1);
 ?>

<br>

<form action="form/produk/simpanedit_produk.php" method="post" enctype="multipart/form-data">
  <div class="col-md-5">
     <img src="form/produk/gambar/<?php echo $d1['gambar'] ?>" style="width:100%">

  </div>
  <div class="col-md-7">
    
                <div class="form-group">
                  <label>Nama produk</label>
                  <input type="hidden" name="id" class="form-control" value="<?php echo $d1['id_produk'] ?>">
                  <input type="text" name="nama" class="form-control" value="<?php echo $d1['nama_produk'] ?>">
                  <input type="hidden" name="fotolama" class="form-control" value="<?php echo $d1['gambar'] ?>">
              </div> 
              
              <div class="form-group">
                  <label>Harga</label>
                  <input type="number" name="harga" required class="form-control" value="<?php echo $d1['harga'] ?>">
              </div> 
              <div class="form-group">
                  <label>gambar produk</label>
                  <input type="file" name="file">
              </div> 

             
              <div class="form-group">
                 <input type="submit" class="btn btn-info" onclick="return confirm('apakah data yang anda masukan sudah benar.?')" value="Simpan Perubahan Data">
              </div> 

  </div>
             


              
          
</form>