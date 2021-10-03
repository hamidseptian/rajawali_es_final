<div class="box-header with-border">
  <h3 class="box-title">Data Penggajian</h3>

  <div class="box-tools pull-right">
    <!-- <a href="" class="btn btn-default btn-sm"  target="_blank">Print Data Paket</a> -->
    <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#add">Tambah Penggajian</a>
  </div>
</div>

<form action="form/penggajian/simpan_penggajian.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="add">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Penggajian</h4>
              </div>
              <div class="modal-body">
                  
              <div class="form-group">
                  <label>Jabatan</label>
                  <input type="text" name="jab" class="form-control" required>
              </div> 
           
              <div class="form-group">
                  <label>Gaji Pokok</label>
                  <input type="text" name="gaji" class="form-control" required>
              </div> 
             
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Data Penggajian</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>


<hr>
<?php 
$id_cabang = $_SESSION['id_user'];
  $q1=mysqli_query($conn, "SELECT * from penggajian where id_cabang = '$id_cabang'
    ");
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        
      
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
   
  
    
    <td><?php echo $d1['jabatan'] ?></td>
    <td>Rp. <?php echo number_format($d1['gaji']) ?></td>
    <td>
      <a href="form/penggajian/hapus_penggajian.php?id=<?php echo $d1['id_penggajian'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin.?')">Hapus</a>
      <a href="?a=edit_penggajian&id=<?php echo $d1['id_penggajian'] ?>" class="btn btn-warning btn-xs">Edit</a>    
    </td>
  </tr>
  <?php } ?>
</table>