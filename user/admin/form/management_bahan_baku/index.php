<?php 
// permintaan bahan baku keluar
 $qpbk = mysqli_query($conn , "SELECT a.id_managemen, a.id_bahan_baku, a.qty, a.satuan, c.nama_bahan_baku, b.nama_cabang from management_bahan_baku a 
                    left join cabang b on a.id_cabang = b.id_cabang 
                    left join bahan_baku c on a.id_bahan_baku = c.id_bahan_baku
                    where jenis='Keluar' and a.status ='Request'");

 $jpbk = mysqli_num_rows($qpbk);


// permintaan bahan baku keluar yang sudah di acc
 $qpbacc = mysqli_query($conn , "SELECT a.id_managemen, a.id_bahan_baku, a.qty, a.satuan, c.nama_bahan_baku, b.nama_cabang from management_bahan_baku a 
                    left join cabang b on a.id_cabang = b.id_cabang 
                    left join bahan_baku c on a.id_bahan_baku = c.id_bahan_baku
                    where jenis='Keluar' and a.status ='Acc'");
 $jpbacc = mysqli_num_rows($qpbacc);



 ?><div class="box-header with-border">
  <h3 class="box-title">Management Bahan Baku</h3>

  <div class="box-tools pull-right">
    <!-- <a href="" class="btn btn-default btn-sm"  target="_blank">Print Data Paket</a> -->
    <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#x">Input Stok Bahan Baku</a>
    <a href="?a=permintaan_bahan_baku_cabang" class="btn btn-info btn-sm">Permintaan Bahan Baku Keluar</a>
   
  </div>
</div>

<form action="form/management_bahan_baku/simpan_bahan_baku_masuk.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="x">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Stok Bahan Baku</h4>
              </div>
              <div class="modal-body">
                <table class="table">
                  <tr>
                    <td>No</td>
                    <td>Bahan Baku</td>
                    <td>Harga</td>
                    <td>Jumlah</td>
                  </tr>
               <?php 
                $qbb = mysqli_query($conn, "SELECT * from bahan_baku"); 
                $no = 1;
                while ($dbb = mysqli_fetch_array($qbb)) { ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $dbb['nama_bahan_baku'] ?></td>
                    <td><?php echo number_format($dbb['harga_satuan']) ?></td>
                    <td>
                      <input type="hidden" name="id_bb[]" class="form-control" value="<?php echo $dbb['id_bahan_baku'] ?>">
                      <input type="number" name="stok[]" class="form-control">
                    </td>
                  </tr>
                <?php } ?>
                </table>
            
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Data Bahan Baku Masuk</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>

<form action="form/bahan_baku/simpan_bahan_baku.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="y">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Permintaan Baha Baku Keluar</h4>
              </div>
              <div class="modal-body">
                <table class="table">
                  <tr>
                    <td>No</td>
                    <td>Cabang</td>
                    <td>Bahan Baku</td>
                    <td>Jumlah</td>
                    <td>Tersedia</td>
                    <td>Option</td>
                  </tr>
                <?php 
                 
                  $no2 = 1;
                  while ($dpbk = mysqli_fetch_array($qpbk)) { ?>
                    <tr>
                      <td><?php echo $no2++ ?></td>
                      <td><?php echo $dpbk['nama_cabang'] ?></td>
                      <td><?php echo $dpbk['nama_bahan_baku'] ?></td>
                      <td><?php echo $dpbk['qty'] ?> <?php echo $dpbk['satuan'] ?></td>
                      <td><?php echo $dpbk['stok'] ?> <?php echo $dpbk['satuan'] ?></td>
                      <td>
                        <?php if ($dpbk['qty'] < $dpbk['stok']) { ?>
                        <a href="form/management_bahan_baku/acc_permintaan_bahan_baku.php?id=<?php echo $dpbk['id_managemen'] ?>&acc=Acc&stok_request=<?php echo $dpbk['qty'] ?>&stok_avs=<?php echo $dpbk['stok'] ?>&id_bb=<?php echo $dpbk['id_bahan_baku'] ?>" class="btn btn-success btn-xs" data-toggle="tooltip" title='Acc'><i class="fa fa-check"></i></a>
                        <a href="form/management_bahan_baku/acc_permintaan_bahan_baku.php?id=<?php echo $dpbk['id_managemen'] ?>&acc=Reject" class="btn btn-danger btn-xs"><i class="fa fa-close" data-toggle="tooltip" title='Reject'></i></a>
                          
                        <?php }else{ ?>
                        <a href="form/management_bahan_baku/acc_permintaan_bahan_baku.php?id=<?php echo $dpbk['id_managemen'] ?>&acc=Reject" class="btn btn-danger btn-xs"><i class="fa fa-close" data-toggle="tooltip" title='Reject'></i></a>

                        <?php } ?>
                      </td>
                    </tr>
                  <?php }
                 ?>
                </table>
            
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
             
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>



<form action="form/bahan_baku/simpan_bahan_baku.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="z">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Permintaan Bahan Baku Keluar Yans Diproses</h4>
              </div>
              <div class="modal-body">
                <table class="table">
                  <tr>
                    <td>No</td>
                    <td>Cabang</td>
                    <td>Bahan Baku</td>
                    <td>Jumlah</td>
                    <td>Tersedia</td>
                    <td>Option</td>
                  </tr>
                <?php 
                 
                  $no2 = 1;
                  while ($dpbk = mysqli_fetch_array($qpbacc)) { ?>
                    <tr>
                      <td><?php echo $no2++ ?></td>
                      <td><?php echo $dpbk['nama_cabang'] ?></td>
                      <td><?php echo $dpbk['nama_bahan_baku'] ?></td>
                      <td><?php echo $dpbk['qty'] ?> <?php echo $dpbk['satuan'] ?></td>
                      <td><?php echo $dpbk['stok'] ?> <?php echo $dpbk['satuan'] ?></td>
                      <td>
                      
                        <a href="form/management_bahan_baku/acc_permintaan_bahan_baku.php?id=<?php echo $dpbk['id_managemen'] ?>&acc=Selesai" class="btn btn-danger btn-xs"><i class="fa fa-check" data-toggle="tooltip" title='Sudah Diterima'></i></a>

                        
                      </td>
                    </tr>
                  <?php }
                 ?>
                </table>
            
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
             
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>


<hr>
<?php 
  $q1=mysqli_query($conn, "SELECT bb.id_bahan_baku, bb.nama_bahan_baku, 
    (SELECT sum(qty) from management_bahan_baku where id_bahan_baku=bb.id_bahan_baku and jenis='Masuk') as penambahan_stok,
    (SELECT sum(qty) from management_bahan_baku where id_bahan_baku=bb.id_bahan_baku and jenis='Keluar' and status in ('Acc','Selesai')) as stok_keluar
    from bahan_baku bb
    ");
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        
      
        <td>Nama Bahan Baku</td>
        <td>Penambahan Stok</td>
        <td>Stok Keluar</td>
        <td>Sisa Stok Tersedia</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
   
  
    
    <td><?php echo $d1['nama_bahan_baku'] ?></td>
    <td><?php echo $d1['penambahan_stok'] == '' ? 0 : $d1['penambahan_stok'] ?></td>
    <td><?php echo $d1['stok_keluar']=='' ? 0 : $d1['stok_keluar'] ?></td>
    <td><?php echo $sisastok = $d1['penambahan_stok'] - $d1['stok_keluar'] ?></td>
   
  </tr>
  <?php } ?>
</table>