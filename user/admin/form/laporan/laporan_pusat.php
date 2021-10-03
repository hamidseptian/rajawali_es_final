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
?>
<div class="box-header with-border">
  <h3 class="box-title">Laporan Pemasukan Dan Pengeluaran <br>Semua Cabang <br>Bulan <?php echo $waktu ?></h3>
  <div class="pull-right">
     <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#filtercabang">Laporan Per Cabang</a>
     <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#filter_bulanan">FIlter</a>
     <a href="form/laporan/print_laporan_pusat.php?bulan=<?php echo $bulan ?>&tahun=<?php echo $tahun ?>" class="btn btn-info btn-sm" target="_blank">Print</a>
  </div>
 
</div>

<form action="?a=laporan_cabang" method="post" enctype="multipart/form-data" id="form_penjualan">
<div class="modal fade" id="filtercabang">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cari laporan per cabang</h4>
              </div>
              <div class="modal-body">
                  
              <div class="form-group">
                  <label>Cabang di : </label>
                  <select class="form-control" name="id_cabang">
                    <?php 
                    $q_cabang = mysqli_query($conn, "SELECT * from cabang");
                    while ($dcabang = mysqli_fetch_array($q_cabang)) {?>
                      <option value="<?php echo $dcabang['id_cabang'] ?>"><?php echo $dcabang['nama_cabang'] ?></option>
                    <?php } ?>
                  </select>
              </div> 
           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tampilkan laporan cabang</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>


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
                  <input type="hidden" name="a" value="laporan_pusat">
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
 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        <td>Cabang</td>
        <td>Pemasukan</td>
        <td>Pengeluaran</td>
      </tr>
    </thead>
<?php 
  $q1=mysqli_query($conn, "SELECT c.id_cabang, c.nama_cabang, 
    (SELECT sum(biaya) from pengeluaran where id_cabang=c.id_cabang and year(tanggal_transaksi)='$tahun' and month(tanggal_transaksi)='$bulan') as pengeluaran, 
    (SELECT sum(harga_satuan * qty) from penjualan where id_cabang=c.id_cabang and year(tanggal_transaksi)='$tahun' and month(tanggal_transaksi)='$bulan') as pemasukan 
    from cabang as c
    order by pemasukan desc
    ");
  $no=1;
   $kumpulkan_data = [];
   $totalpemasukan = 0;
   $totalpengeluaran = 0;
  while ($d1=mysqli_fetch_array($q1)) { 
        $totalpemasukan += $d1['pemasukan'];
        $totalpengeluaran+=$d1['pengeluaran'] ;

      // $q1=mysqli_query($conn, "SELECT * from penjualan p  left join cabang c on p.id_cabang = c.id_cabang");
     // $q2=mysqli_query($conn, "SELECT * from pengeluaran p  left join cabang c on p.id_cabang = c.id_cabang");
    ?>
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $d1['nama_cabang'] ?></td>
        <td><?php echo number_format($d1['pemasukan']) ?></td>
        <td><?php echo number_format($d1['pengeluaran'] )?></td>
      </tr>
   <?php  } 



    $qcabang_utama = mysqli_query($conn, "SELECT * from cabang where status = 'Cabang Utama'");
    $dcabang_utama = mysqli_fetch_array($qcabang_utama);
    $id_cabang_utama = $dcabang_utama['id_cabang'];
   $q_pemasukan_gudang = mysqli_query($conn, "SELECT sum(biaya) as pemasukan_gudang from pengeluaran where id_cabang='$id_cabang_utama' and year(tanggal_transaksi)='$tahun' and month(tanggal_transaksi)='$bulan'
    ");
   $d_pemasukan_gudang = mysqli_fetch_array($q_pemasukan_gudang);
   $jumlah_pemasukan_gudang = $d_pemasukan_gudang['pemasukan_gudang'];
    $totalpemasukan += $jumlah_pemasukan_gudang;
// untuk gudang
    $qmbb=mysqli_query($conn, "SELECT sum(qty * harga_satuan) as pengeluaran_bahan_baku from management_bahan_baku where jenis='Masuk' and year(tgl_transaksi)='$tahun' and month(tgl_transaksi)='$bulan'
    ");
    $dmbb = mysqli_fetch_array($qmbb);
    // $totalpengeluaran += $dmbb['pengeluaran_bahan_baku'];
   ?>

   <!--  <tr>
        <td><?php //echo $no++ ?></td>
        <td>Gudang</td>
        <td><?php //echo number_format($jumlah_pemasukan_gudang) ?></td>
        <td><?php //echo number_format($dmbb['pengeluaran_bahan_baku'])?></td>
      </tr> -->
  <tfoot>
      <tr>
        <td colspan="2">Total</td>
        <td><?php echo number_format($totalpemasukan) ?></td>
        <td><?php echo number_format($totalpengeluaran) ?></td>
      </tr>
      <tr>
        <td colspan="2">Total Pendapatan</td>
        <td colspan="2">
          <?php 
          $pendapatan = $totalpemasukan - $totalpengeluaran;
        echo number_format($pendapatan) ?>
        </td>
      
       
      </tr>
    </tfoot>
</table>


<script type="text/javascript">
  function cek_total(){
    $('#belanja_ok').html('');
    isi_data = $('#form_penjualan').serialize();
    $.ajax({
      url : 'form/penjualan/cek_harga.php',
      type: 'POST',
      data : isi_data,
      success : function(data){
      $('#belanja_ok').html(data);
        
      },
      error : function(){

      }
    });
  }
</script>