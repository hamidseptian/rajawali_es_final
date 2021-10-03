<div class="box-header with-border">
  <h3 class="box-title">Edit Data Cabang</h3>

  <div class="box-tools pull-right">
    <a href="?a=cabang" class="btn btn-info" >Kembali</a>
  </div>
</div>


<?php 
$id=$_GET['id'];
  $q1=mysqli_query($conn, "SELECT * from cabang where id_cabang='$id'") or die(mysqli_error());
  $d1=mysqli_fetch_array($q1);
  $j1=mysqli_num_rows($q1);
 ?>

<br>

<form action="form/cabang/simpanedit_cabang.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" class="form-control" value="<?php echo $d1['id_cabang'] ?>">
                
              <div class="form-group">
                  <label>Nama cabang</label>
                  <input type="text" name="nama" class="form-control" required value="<?php echo $d1['nama_cabang'] ?>">
              </div> 
              <div class="form-group">
                  <label>Penanggung Jawab</label>
                  <input type="text" name="pj" class="form-control" required value="<?php echo $d1['pj'] ?>">
              </div> 
           
              <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" name="alamat" class="form-control" required value="<?php echo $d1['alamat'] ?>">
              </div> 
              <div class="form-group">
                  <label>No HP</label>
                  <input type="text" name="nohp" class="form-control" required value="<?php echo $d1['nohp'] ?>">
              </div> 
              <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" required value="<?php echo $d1['username'] ?>">
              </div> 
              <div class="form-group">
                  <label>Password</label>
                  <input type="text" name="password" class="form-control" required value="<?php echo $d1['password'] ?>">
              </div> 
              



              <div class="form-group">
                 <input type="submit" class="btn btn-info"  value="Simpan Perubahan Data">
              </div> 

              
          
</form>