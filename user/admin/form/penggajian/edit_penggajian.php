<div class="box-header with-border">
  <h3 class="box-title">Edit Data Penggajian</h3>

  <div class="box-tools pull-right">
    <a href="?a=penggajian" class="btn btn-info" >Kembali</a>
  </div>
</div>


<?php 
$id=$_GET['id'];
  $q1=mysqli_query($conn, "SELECT * from penggajian where id_penggajian='$id'") or die(mysqli_error());
  $d1=mysqli_fetch_array($q1);
  $j1=mysqli_num_rows($q1);
 ?>

<br>

<form action="form/penggajian/simpanedit_penggajian.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" class="form-control" value="<?php echo $d1['id_penggajian'] ?>">
                
              <div class="form-group">
                  <label>Jabatan</label>
                  <input type="text" name="jab" class="form-control" required value="<?php echo $d1['jabatan'] ?>">
              </div> 
           
              <div class="form-group">
                  <label>Gajin Pokok</label>
                  <input type="text" name="gaji" class="form-control" required value="<?php echo $d1['gaji'] ?>">
              </div> 
              
              



              <div class="form-group">
                 <input type="submit" class="btn btn-info"  value="Simpan Perubahan Data">
              </div> 

              
          
</form>