
	<div class="box-body">
		
<?php 
$id = $_SESSION['id_user'];

$q_user = mysqli_query($conn, "SELECT * from user u  where u.id_user='$id'");
$d_user = mysqli_fetch_array($q_user);
$namauser =  $d_user['nama_user']; 
$level =  $d_user['level']; 

   

?>
	



	<div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua">
              <div class="widget-user-image">
                <img class="img" src="<?php echo $gambar ?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h5 class="widget-user-desc">Selamat Datang di Halaman Administrator</h5>
              <h3 class="widget-user-username"><?php echo $namauser.' - '.$level ?></h3>
           
            </div>
            
          </div>



	</div>


