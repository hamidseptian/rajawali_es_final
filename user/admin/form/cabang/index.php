<div class="box-header with-border">
  <h3 class="box-title">Data Cabang</h3>

  <div class="box-tools pull-right">
    <!-- <a href="" class="btn btn-default btn-sm"  target="_blank">Print Data Paket</a> -->
    <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#cabutama">Cabang Utama</a>
    <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#addballroom">Tambah Cabang</a>
  </div>
</div>

<form action="form/cabang/simpan_cabang.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="addballroom">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah cabang</h4>
              </div>
              <div class="modal-body">
                  
              <div class="form-group">
                  <label>Nama cabang</label>
                  <input type="text" name="nama" class="form-control" required>
              </div> 
              <div class="form-group">
                  <label>Penanggung Jawab</label>
                  <input type="text" name="pj" class="form-control" required>
              </div> 
           
              <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" name="alamat" class="form-control" required>
              </div> 
              <div class="form-group">
                  <label>No HP</label>
                  <input type="text" name="hp" class="form-control" required>
              </div> 
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Data cabang</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>



<div class="modal fade" id="cabutama">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cabang Utama</h4>
              </div>
              <div class="modal-body">
                  
              <div class="form-group">
                <?php $qcab_utama = mysqli_query($conn, "SELECT * from cabang where status ='Cabang Utama'");
                $dcab_utama=mysqli_fetch_array($qcab_utama);
                 ?>
                 <label>Cabang utama saat ini</label>
                 <table class="table">
                   <tr>
                     <td>Nama Cabang</td>
                     <td>:</td>
                     <td><?php echo $dcab_utama['nama_cabang'] ?></td>
                   </tr>
                   <tr>
                     <td>Alamat Cabang</td>
                     <td>:</td>
                     <td><?php echo $dcab_utama['alamat'] ?></td>
                   </tr>
                  
                 </table>
              </div> 
              <div class="form-group">
                 <label>Ganti Cabang Utama</label>
                  <table class="table">
                    <tr>
                      <td>Cabang</td> 
                      <td>Alamat</td>                     
                      <td>Option</td>
                    </tr>
                    <?php $qcab_utama = mysqli_query($conn, "SELECT * from cabang where status !='Cabang Utama'");
                    while ($dcab_utama=mysqli_fetch_array($qcab_utama)) { ?>
                       <tr>
<td><?php echo $dcab_utama['nama_cabang'] ?></td>
                         <td><?php echo $dcab_utama['alamat'] ?></td>
                         <td>
                           <a href="form/cabang/simpan_cabang_utama.php?id=<?php echo $dcab_utama['id_cabang'] ?>" class="btn btn-info btn-xs" onclick="return confirm('Tetapkan <?php echo $dcab_utama['nama_cabang'] ?> sebagai cabang utama.?')"><i class="fa fa-check"></i></a>
                         </td>
                       </tr>
                     <?php } ?>
                  </table>
              </div> 
           
            
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>



<hr>
<?php 
  $q1=mysqli_query($conn, "SELECT * from cabang
    ");
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        
      
        <td>Nama Cabang</td>
        <td>Penanggung Jawab</td>
        <td>Alamat</td>
        <td>No HP</td>
        <td>Username</td>
        <td>Password</td>
       
        <td>Option</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
   
  
    
    <td><?php echo $d1['nama_cabang'] ?></td>
    <td><?php echo $d1['pj'] ?></td>
    <td><?php echo $d1['alamat'] ?></td>
    <td><?php echo $d1['nohp'] ?></td>
    <td><?php echo $d1['username'] ?></td>
    <td><?php echo $d1['password'] ?></td>
    <td>
      <?php if ($d1['status']=='Cabang Utama') {
        echo "Cabang Utama";
      }else{ ?>
      <a href="form/cabang/hapus_cabang.php?id=<?php echo $d1['id_cabang'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin.?')">Hapus</a>
      <a href="?a=edit_cabang&id=<?php echo $d1['id_cabang'] ?>" class="btn btn-warning btn-xs">Edit</a>   
      <?php } ?> 
    </td>
  </tr>
  <?php } ?>
</table>