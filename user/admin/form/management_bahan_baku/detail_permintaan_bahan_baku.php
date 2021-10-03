<?php
$id_cabang = $_GET['id_cabang']; 
$tgl = $_GET['tgl']; 

$showstatus = ['Request'=>'Request','Acc'=>'Diproses', 'Reject'=>"Ditolak", 'Selesai'=>"Selesai"];
  $q2=mysqli_query($conn, "SELECT * from cabang where id_cabang = '$id_cabang'");
  $d2=mysqli_fetch_array($q2);


  $q1= mysqli_query($conn , "SELECT a.id_managemen, a.id_cabang, a.tgl_transaksi,a.id_bahan_baku, a.qty, a.satuan, c.nama_bahan_baku, a.status, b.nama_cabang, 

    (SELECT sum(qty) from management_bahan_baku where id_bahan_baku=a.id_bahan_baku and jenis='Masuk') as penambahan_stok,

    (SELECT sum(qty) from management_bahan_baku where id_bahan_baku=a.id_bahan_baku and jenis='Keluar' and status in('Acc','Selesai')) as stok_keluar
   from management_bahan_baku a 
                    left join cabang b on a.id_cabang = b.id_cabang 
                    left join bahan_baku c on a.id_bahan_baku = c.id_bahan_baku
                    where jenis='Keluar' and   a.id_cabang = '$id_cabang' and a.tgl_transaksi='$tgl'");

  $no=1;
 ?>
<div class="box-header with-border">
  <h3 class="box-title">Permintaan Bahan Baku Ke Gudang <br>
    Cabang : <?php echo $d2['nama_cabang'] ?><br>
    Tanggal : <?php echo $tgl ?></h3>

  <div class="box-tools pull-right">
    <!-- <a href="" class="btn btn-default btn-sm"  target="_blank">Print Data Paket</a> -->
    <a href="?a=permintaan_bahan_baku_cabang" class="btn btn-info btn-sm"  >Kembali</a>
    
  </div>
</div>



 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        
      
        <td>Nama Bahan Baku</td>
        <td>Stok Tersedia</td>
        <td>Permintaan</td>
        <td>Status</td>
        <td>Option</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    $stok_tersedia =  $d1['penambahan_stok'] - $d1['stok_keluar'];
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
   
  
    
    <td><?php echo $d1['nama_bahan_baku'] ?></td>
    
    <td><?php echo $stok_tersedia ?> <?php echo $d1['satuan'] ?></td>
    <td><?php echo $d1['qty'] ?> <?php echo $d1['satuan'] ?></td>
    <td><?php echo $showstatus[$d1['status']] ?></td>
    <td>
      <?php if ($d1['status']=='Request') { ?>
     
                        <?php if ($d1['qty'] < $stok_tersedia) { ?>
                        <a href="form/management_bahan_baku/acc_permintaan_bahan_baku.php?id=<?php echo $d1['id_managemen'] ?>&acc=Acc&stok_request=<?php echo $d1['qty'] ?>&id_bb=<?php echo $d1['id_bahan_baku'] ?>&id_cabang=<?php echo $d1['id_cabang'] ?>&tgl=<?php echo $d1['tgl_transaksi'] ?>" class="btn btn-success btn-xs" data-toggle="tooltip" title='Acc'><i class="fa fa-check"></i></a>
                        <a href="form/management_bahan_baku/acc_permintaan_bahan_baku.php?id=<?php echo $d1['id_managemen'] ?>&acc=Reject&id_cabang=<?php echo $d1['id_cabang'] ?>&tgl=<?php echo $d1['tgl_transaksi'] ?>" class="btn btn-danger btn-xs"><i class="fa fa-close" data-toggle="tooltip" title='Reject'></i></a>
                          
                        <?php }else{ ?>
                        <a href="form/management_bahan_baku/acc_permintaan_bahan_baku.php?id=<?php echo $d1['id_managemen'] ?>&acc=Reject&id_cabang=<?php echo $d1['id_cabang'] ?>&tgl=<?php echo $d1['tgl_transaksi'] ?>" class="btn btn-danger btn-xs"><i class="fa fa-close" data-toggle="tooltip" title='Reject'></i></a>

                        <?php } ?>


        <?php }
        else if ($d1['status']=='Acc') { ?>

           <a href="form/management_bahan_baku/acc_permintaan_bahan_baku.php?id=<?php echo $d1['id_managemen'] ?>&acc=Selesai&id_cabang=<?php echo $d1['id_cabang'] ?>&tgl=<?php echo $d1['tgl_transaksi'] ?>" class="btn btn-info btn-xs"><i class="fa fa-check" data-toggle="tooltip" title='Sudah Diterima'></i></a>
       <?php } ?>
                      </td>
  </tr>
  <?php } ?>
</table>