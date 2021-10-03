<div class="box-header with-border">
  <h3 class="box-title">Edit Data user</h3>

  <div class="box-tools pull-right">
    <?php if ($_SESSION['level']=='Admin Master') { ?>
    <a href="?a=user" class="btn btn-info" >Kembali</a>
<?php } ?>
  </div>
</div>


<?php 
$id=$_GET['id'];
  $q1=mysqli_query($conn, "SELECT * from user where id_user='$id'") or die(mysqli_error());
  $d1=mysqli_fetch_array($q1);
  $j1=mysqli_num_rows($q1);
 ?>

<br>

<form action="form/user/simpanedit_user.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" class="form-control" value="<?php echo $d1['id_user'] ?>">
                
              <div class="form-group">
                  <label>Nama user</label>
                  <input type="text" name="nama" class="form-control" required value="<?php echo $d1['nama_user'] ?>">
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
                  <label>Level</label>
                  <select name="level" class="form-control" required>
                    <?php if ($_SESSION['level']=='Admin Master') { ?>
                    <option value="Admin Master" <?php if($d1['level']=='Admin Master'){echo "selected";} ?>>Admin Master</option>
                  <?php } ?>
                    <!-- <option value="Admin Gudang" <?php //if($d1['level']=='Admin Gudang'){echo "selected";} ?>>Admin Gudang</option> -->
                    <!-- <option value="Admin Cabang"></option> -->
                  </select>
              </div> 
              



              <div class="form-group">
                 <input type="submit" class="btn btn-info"  value="Simpan Perubahan Data">
              </div> 

              
          
</form>