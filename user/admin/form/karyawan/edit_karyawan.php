<div class="box-header with-border">
  <h3 class="box-title">Edit Data karyawan</h3>

  <div class="box-tools pull-right">
    <a href="?a=karyawan" class="btn btn-info" >Kembali</a>
  </div>
</div>


<?php 
$id=$_GET['id'];
  $q1=mysqli_query($conn, "SELECT * from karyawan where id_karyawan='$id'") or die(mysqli_error());
  $d1=mysqli_fetch_array($q1);
  $j1=mysqli_num_rows($q1);
 ?>

<br>

<form action="form/karyawan/simpanedit_karyawan.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" class="form-control" value="<?php echo $d1['id_karyawan'] ?>">
                
               
              <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" required value="<?php echo $d1['nama'] ?>">
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
                  <label>Posisi</label>
                  <table class="table">
                    <tr>
                      <td width="100px">Pilih Posisi</td>
                      <td>Jabatan</td>
                      <td>Gaji</td>
                    </tr>
                    <?php
                    $id_cabang =$_SESSION['id_user'] ;
                    $qgaji = mysqli_query($conn, "SELECT * from penggajian where id_cabang='$id_cabang'");
                    while ($dgaji = mysqli_fetch_array($qgaji)) { ?>
                       <tr>
                         <td><input type="radio" name="gaji" value="<?php echo $dgaji['id_penggajian'] ?>" <?php if($dgaji['id_penggajian']==$d1['id_penggajian']){echo "checked";} ?>></td>
                         <td><?php echo $dgaji['jabatan'] ?></td>
                         <td><?php echo number_format($dgaji['gaji']) ?></td>
                       </tr>
                     <?php } ?>
                  </table>
              </div> 
              
              



              <div class="form-group">
                 <input type="submit" class="btn btn-info"  value="Simpan Perubahan Data">
              </div> 

              
          
</form>