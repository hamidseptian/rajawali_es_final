<div class="box-header with-border">
  <h3 class="box-title">Data user</h3>

  <div class="box-tools pull-right">
    <!-- <a href="" class="btn btn-default btn-sm"  target="_blank">Print Data Paket</a> -->
    <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#addballroom">Tambah user</a>
  </div>
</div>

<form action="form/user/simpan_user.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="addballroom">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah user</h4>
              </div>
              <div class="modal-body">
                  
              <div class="form-group">
                  <label>Nama user</label>
                  <input type="text" name="nama" class="form-control" required>
              </div> 
           
              <div class="form-group">
                  <label>username</label>
                  <input type="text" name="username" class="form-control" required>
              </div> 
              <div class="form-group">
                  <label>Password</label>
                  <input type="text" name="password" class="form-control" required>
              </div> 
              <div class="form-group">
                  <label>Level</label>
                  <select name="level" class="form-control" required>
                    <option value="Admin Master">Admin Master</option>
                    <!-- <option value="Admin Gudang">Admin Gudang</option> -->
                    <!-- <option value="Admin Cabang"></option> -->
                  </select>
              </div> 
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Data user</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>


<hr>
<?php 
  $q1=mysqli_query($conn, "SELECT * from user
    ");
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        
      
        <td>Nama user</td>
        <td>username</td>
        <td>Password</td>
        <td>Level</td>
       
        <td>Option</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
   
  
    
    <td><?php echo $d1['nama_user'] ?></td>
    <td><?php echo $d1['username'] ?></td>
    <td><?php echo $d1['password'] ?></td>
    <td><?php echo $d1['level'] ?></td>
    <td>
      <a href="form/user/hapus_user.php?id=<?php echo $d1['id_user'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin.?')">Hapus</a>
      <a href="?a=edit_user&id=<?php echo $d1['id_user'] ?>" class="btn btn-warning btn-xs">Edit</a>    
    </td>
  </tr>
  <?php } ?>
</table>