<div class="box-header with-border">
  <h3 class="box-title">Data Bahan Baku</h3>

  <div class="box-tools pull-right">
    <!-- <a href="" class="btn btn-default btn-sm"  target="_blank">Print Data Paket</a> -->
    <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#addballroom">Tambah Bahan Baku</a>
  </div>
</div>

<form action="form/bahan_baku/simpan_bahan_baku.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="addballroom">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Bahan Baku</h4>
              </div>
              <div class="modal-body">
                  
              <div class="form-group">
                  <label>Nama Bahan Baku</label>
                  <input type="text" name="nama" class="form-control" required>
              </div> 
           
              <div class="form-group">
                  <label>Satuan</label>
                  <input type="text" name="satuan" class="form-control" required>
              </div> 
              <div class="form-group">
                  <label>Harga Satuan</label>
                  <input type="number" name="harga" class="form-control" required>
              </div> 
              <div class="form-group">
                  <label>Stok Awal</label>
                  <input type="number" name="stok" class="form-control" required>
              </div> 
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Data Bahan Baku</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>


<hr>
<?php 
  $q1=mysqli_query($conn, "SELECT * from bahan_baku
    ");
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        
      
        <td>Nama Bahan Baku</td>
        <td>Satuan</td>
        <td>Harga</td>
       
        <td>Option</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
   
  
    
    <td><?php echo $d1['nama_bahan_baku'] ?></td>
    <td><?php echo $d1['satuan'] ?></td>
    <td><?php echo number_format($d1['harga_satuan']) ?></td>
    <td>
      <a href="form/bahan_baku/hapus_bahan_baku.php?id=<?php echo $d1['id_bahan_baku'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin.?')">Hapus</a>
      <a href="?a=edit_bahan_baku&id=<?php echo $d1['id_bahan_baku'] ?>" class="btn btn-warning btn-xs">Edit</a>    
    </td>
  </tr>
  <?php } ?>
</table>