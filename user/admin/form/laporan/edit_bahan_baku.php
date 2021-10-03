<div class="box-header with-border">
  <h3 class="box-title">Edit Data Bahan Baku</h3>

  <div class="box-tools pull-right">
    <a href="?a=bahan_baku" class="btn btn-info" >Kembali</a>
  </div>
</div>


<?php 
$id=$_GET['id'];
  $q1=mysqli_query($conn, "SELECT * from bahan_baku where id_bahan_baku='$id'") or die(mysqli_error());
  $d1=mysqli_fetch_array($q1);
  $j1=mysqli_num_rows($q1);
 ?>

<br>

<form action="form/bahan_baku/simpanedit_bahan_baku.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" class="form-control" value="<?php echo $d1['id_bahan_baku'] ?>">
                
              <div class="form-group">
                  <label>Nama Bahan Baku</label>
                  <input type="text" name="nama" class="form-control" required value="<?php echo $d1['nama_bahan_baku'] ?>">
              </div> 
           
              <div class="form-group">
                  <label>Satuan</label>
                  <input type="text" name="satuan" class="form-control" required value="<?php echo $d1['satuan'] ?>">
              </div> 
              <div class="form-group">
                  <label>Harga Satuan</label>
                  <input type="number" name="harga" class="form-control" required value="<?php echo $d1['harga_satuan'] ?>">
              </div> 
              



              <div class="form-group">
                 <input type="submit" class="btn btn-info"  value="Simpan Perubahan Data">
              </div> 

              
          
</form>