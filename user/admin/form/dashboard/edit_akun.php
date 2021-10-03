
	<div class="box-body">
		
<?php 
$id = $_SESSION['id_user'];

$q_user = mysqli_query($conn, "SELECT * from user u  left join bidang b on u.id_bidang=b.id_bidang where u.id_user='$id'");
$d_user = mysqli_fetch_array($q_user);
$namauser =  $d_user['nama_user']; 
$level =  $d_user['nama_bidang']; 

   

?>
	



	<div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua">
              <div class="widget-user-image">
                <img class="img" src="<?php echo $gambar ?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h5 class="widget-user-desc">Edit akun</h5>
              <h3 class="widget-user-username"><?php echo $namauser.' - '.$level ?></h3>
           
            </div>
            
          </div>



	</div>
  <div class="  box-body">
    <form method="post" action="form/dashboard/simpanedit_akun.php">
      
      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $d_user['nama_user'] ?>">
      </div>
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?php echo $d_user['username'] ?>">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" value="<?php echo $d_user['password'] ?>">
      </div>
      <div class="form-group">
        <button class="btn btn-info">Simpan</button>
    </div>
    </form>
</div>


