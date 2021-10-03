<?php
$tgl = $_GET['tgl']; 
  $q1=mysqli_query($conn, "SELECT * from management_bahan_baku where id_cabang = '$iduser' and tgl_transaksi='$tgl'
    ");
  $no=1;

  $showstatus = ['Request'=>'Request','Acc'=>'Diproses', 'Reject'=>"Ditolak", 'Selesai'=>"Selesai"];

 ?>
<div class="box-header with-border">
  <h3 class="box-title">Permintaan Bahan Baku Ke Gudang <br>Tanggal : <?php echo $tgl ?></h3>

  <div class="box-tools pull-right">
    <!-- <a href="" class="btn btn-default btn-sm"  target="_blank">Print Data Paket</a> -->
    <a href="?a=permintaan_bahan_baku" class="btn btn-info btn-sm"  >Kembali</a>
    
  </div>
</div>



 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        
      
        <td>Nama Bahan Baku</td>
        <td>Qty</td>
        <td>Status</td>
        <td>Option</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
   
  
    
    <td><?php echo $d1['nama_bahan_baku'] ?></td>
    
    <td><?php echo $d1['qty'] ?> <?php echo $d1['satuan'] ?></td>
    <td><?php echo $showstatus[$d1['status']] ?></td>
    <td>
      <?php if ($d1['status']=='Request' || $d1['status']=='Reject') { ?>
        <a href="form/permintaan_bahan_baku/hapus_permintaan_bahan_baku.php?id=<?php echo $d1['id_managemen'] ?>&tgl=<?php echo $tgl ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin.?')">Hapus</a>
      <?php } 
      else if ($d1['status']=='Acc') { ?>

           <a href="form/permintaan_bahan_baku/acc_permintaan_bahan_baku.php?id=<?php echo $d1['id_managemen'] ?>&acc=Selesai&id_cabang=<?php echo $d1['id_cabang'] ?>&tgl=<?php echo $d1['tgl_transaksi'] ?>" class="btn btn-info btn-xs" onclick="return confirm('Apakah barang sudah diterima.?')">Diterima</a>
       <?php } ?>
    
    </td>
  </tr>
  <?php } ?>
</table>