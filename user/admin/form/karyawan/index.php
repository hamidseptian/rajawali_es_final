<?php 
$idcabang = $_SESSION['id_user'];
$qcabang = mysqli_query($conn, "SELECT * from cabang where id_cabang = '$idcabang'");
$dcabang = mysqli_fetch_array($qcabang); ?>
<div class="box-header with-border">
  <h3 class="box-title">Data Karyawan <br>Cabang  : <?php echo $dcabang['nama_cabang'] ?></h3>

  <div class="box-tools pull-right">
    <!-- <a href="" class="btn btn-default btn-sm"  target="_blank">Print Data Paket</a> -->
    <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#add">Tambah Karyawan</a>
  </div>
</div>

<form action="form/karyawan/simpan_karyawan.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="add">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Karyawan</h4>
              </div>
              <div class="modal-body">
                  
              <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" required>
              </div> 
           
              <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" name="alamat" class="form-control" required>
              </div> 
              <div class="form-group">
                  <label>No HP</label>
                  <input type="text" name="nohp" class="form-control" required>
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
                    $qgaji = mysqli_query($conn, "SELECT * from penggajian where id_cabang='$idcabang'");
                    while ($dgaji = mysqli_fetch_array($qgaji)) { ?>
                       <tr>
                         <td><input type="radio" name="gaji" value="<?php echo $dgaji['id_penggajian'] ?>"></td>
                         <td><?php echo $dgaji['jabatan'] ?></td>
                         <td><?php echo number_format($dgaji['gaji']) ?></td>
                       </tr>
                     <?php } ?>
                  </table>
              </div> 
             
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Data Karyawan</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>


<hr>
<?php 
  $q1=mysqli_query($conn, "SELECT * from karyawan k left join penggajian p on k.id_penggajian = p.id_penggajian where k.id_cabang='$idcabang'
    ");
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        <td>Nama</td>
        <td>Alamat</td>
        <td>No HP</td>
        
      
        <td>Jabatan</td>
        <td>Gaji</td>
       
        <td>Option</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
   
  
    
    <td><?php echo $d1['nama'] ?></td>
    <td><?php echo $d1['alamat'] ?></td>
    <td><?php echo $d1['nohp'] ?></td>
    <td><?php echo $d1['jabatan'] ?></td>
    <td>Rp. <?php echo number_format($d1['gaji']) ?></td>
    <td>
      <a href="form/karyawan/hapus_karyawan.php?id=<?php echo $d1['id_karyawan'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin.?')">Hapus</a>
      <a href="?a=edit_karyawan&id=<?php echo $d1['id_karyawan'] ?>" class="btn btn-warning btn-xs">Edit</a>    
    </td>
  </tr>
  <?php } ?>
</table>