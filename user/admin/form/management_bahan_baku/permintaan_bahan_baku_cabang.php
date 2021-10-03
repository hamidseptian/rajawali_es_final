<div class="box-header with-border">
  <h3 class="box-title">Permintaan Bahan Baku</h3>

  <div class="box-tools pull-right">
    
    
  </div>
</div>


<hr>
<?php 
  $q1=mysqli_query($conn, "SELECT c.nama_cabang, mbb.id_cabang, mbb.tgl_transaksi, count(mbb.id_managemen) as jmlitem from management_bahan_baku mbb
    left join cabang c on mbb.id_cabang = c.id_cabang
    where mbb.jenis='Keluar'
   group by mbb.tgl_transaksi, mbb.id_cabang order by id_managemen
    ");
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        
        <td>Cabang</td>
        <td>Tanggal Permintaan</td>
        <td>Total Permintaan</td>
     
        <td>Option</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    $idcabang = $d1['id_cabang'];
    $tgl = $d1['tgl_transaksi'];
   
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
   
  
    
    <td><?php echo $d1['nama_cabang'] ?></td>
    <td><?php echo $d1['tgl_transaksi'] ?></td>
    <td><?php echo $d1['jmlitem'] ?></td>
    <td>
      <a href="?a=detail_permintaan_bahan_baku_cabang&tgl=<?php echo $d1['tgl_transaksi'] ?>&id_cabang=<?php echo $d1['id_cabang'] ?>" class="btn btn-info btn-xs">Detail</a>   
    </td>
  </tr>
  <?php } ?>
</table>