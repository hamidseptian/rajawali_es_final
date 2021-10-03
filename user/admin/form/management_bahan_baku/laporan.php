<?php 
$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];
$nama_bulan = array(
                '01' => 'JANUARI',
                '02' => 'FEBRUARI',
                '03' => 'MARET',
                '04' => 'APRIL',
                '05' => 'MEI',
                '06' => 'JUNI',
                '07' => 'JULI',
                '08' => 'AGUSTUS',
                '09' => 'SEPTEMBER',
                '10' => 'OKTOBER',
                '11' => 'NOVEMBER',
                '12' => 'DESEMBER',
        );

$waktu = $nama_bulan[$bulan].' '.$tahun



 ?><div class="box-header with-border">
  <h3 class="box-title">Laporan Data Bahan Baku<br>Bulan <?php echo $waktu ?></h3>

  <div class="box-tools pull-right">
    
     <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#filter_bulanan">FIlter</a>
   
  </div>
</div>

<form action="" method="get" enctype="multipart/form-data" id="form_penjualan">
<div class="modal fade" id="filter_bulanan">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Filter laporan penjualan</h4>
              </div>
              <div class="modal-body">
                  <input type="hidden" name="a" value="laporan_bahan_baku">
              <div class="form-group">
                  <label>Bulan</label>
                  <select class="form-control" name="bulan">
                    <?php foreach ($nama_bulan as $key => $value) { ?>
                      <option value="<?php echo $key ?>" <?php if(date('m')==$key){echo "selected";} ?>><?php echo $value ?></option>
                    <?php } ?>
                  </select>
              </div> 
           
              <div class="form-group">
                  <label>Tahun</label>
                  <select class="form-control" name="tahun">
                    <?php 
                    for ($i=date('Y'); $i >2010 ; $i--) { ?>
                      <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                  </select>
              </div> 
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Filter</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>

<hr>
<?php 
  $q1=mysqli_query($conn, "SELECT bb.id_bahan_baku, bb.nama_bahan_baku, bb.harga_satuan,
    (SELECT sum(qty) from management_bahan_baku where id_bahan_baku=bb.id_bahan_baku and jenis='Masuk' and year(tgl_transaksi)='$tahun' and month(tgl_transaksi)='$bulan') as penambahan_stok,
    (SELECT sum(qty) from management_bahan_baku where id_bahan_baku=bb.id_bahan_baku and jenis='Keluar' and year(tgl_transaksi)='$tahun' and month(tgl_transaksi)='$bulan' and status in ('Acc','Selesai')) as stok_keluar
    from bahan_baku bb
    ");
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        
      
        <td>Nama Bahan Baku</td>
        <td>Harga Satuan</td>
        <td>Penambahan Stok</td>
        <td>Total Harga</td>
        <td>Stok Keluar</td>
      </tr>
    </thead>
  <?php 
  $total_harga = 0;
  while ($d1=mysqli_fetch_array($q1)) { 
    $stok_masuk = $d1['penambahan_stok'] == '' ? 0 : $d1['penambahan_stok'];
    $harga_total  =$d1['harga_satuan'] * $stok_masuk ;
    $total_harga  += $harga_total ;
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
   
  
    
    <td><?php echo $d1['nama_bahan_baku'] ?></td>
    <td><?php echo number_format($d1['harga_satuan']) ?></td>
    <td><?php echo $stok_masuk ?></td>
    <td><?php echo number_format($harga_total) ?></td>
    <td><?php echo $d1['stok_keluar']=='' ? 0 : $d1['stok_keluar'] ?></td>
   
  </tr>
  <?php } ?>
  <tr>  
    <td colspan="4">Total pengeluaran pembelian bahan baku</td>
    <td><?php echo number_format($total_harga) ?></td>
    <td></td>
  </tr>
</table>

<?php 

  $qcabang_utama = mysqli_query($conn, "SELECT * from cabang where status = 'Cabang Utama'");
    $dcabang_utama = mysqli_fetch_array($qcabang_utama);
    $id_cabang_utama = $dcabang_utama['id_cabang'];
 $q_pemasukan_gudang = mysqli_query($conn, "SELECT sum(biaya) as pemasukan_gudang from pengeluaran where id_cabang='$id_cabang_utama' and year(tanggal_transaksi)='$tahun' and month(tanggal_transaksi)='$bulan'
    ");
   $d_pemasukan_gudang = mysqli_fetch_array($q_pemasukan_gudang);
   $jumlah_pemasukan_gudang = $d_pemasukan_gudang['pemasukan_gudang'];
    ?>

<hr>

<table>
  <tr>
    <td width="200px">Modal yang diberikan Admin </td>
    <td  width="10px">:</td>
    <td><?php echo number_format($jumlah_pemasukan_gudang) ?></td>
  </tr>
  <tr>
    <td>Terpakai</td>
    <td>:</td>
    <td><?php echo number_format($total_harga) ?></td>
  </tr>
  <tr>
    <td>Sisa </td>
    <td>:</td>
    <td><?php echo number_format($jumlah_pemasukan_gudang - $total_harga) ?></td>
  </tr>
</table>