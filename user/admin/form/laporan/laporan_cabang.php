<?php 
$bulan = array(
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


if ($_SESSION['level']=='Admin Toko') {
  @$idcabang = $_SESSION['id_user'];
}else{
  @$idcabang = $_POST['id_cabang'];
}
$qcabang = mysqli_query($conn, "SELECT * from cabang where id_cabang = '$idcabang'");
$dcabang = mysqli_fetch_array($qcabang); ?>
<div class="box-header with-border">
  <h3 class="box-title">Laporan Pemasukan Dan Pengeluaran <br>Cabang  : <?php echo $dcabang['nama_cabang'] ?></h3>
  <div class="pull-right">
    <a href="form/laporan/print_laporan_cabang_bulanan.php?bulan=<?php echo date('m') ?>&tahun=<?php echo date('Y') ?>&id_cabang=<?php echo $idcabang ?>" class="btn btn-info btn-sm" target="_blank">Print</a>
     <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#add">FIlter</a>
  </div>
 
</div>

<form action="?a=filter_laporan_cabang" method="post" enctype="multipart/form-data" id="form_penjualan">
<div class="modal fade" id="add">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Filter laporan penjualan</h4>
              </div>
              <div class="modal-body">
                  
              <div class="form-group">
                  <label>Bulan</label>
                <input type="hidden" name="id_cabang" value="<?php echo $idcabang ?>">
                  <select class="form-control" name="bulan">
                    <?php foreach ($bulan as $key => $value) { ?>
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
  $q1=mysqli_query($conn, "SELECT * from penjualan where id_cabang='$idcabang' group by tanggal_transaksi 
    ");
  $no=1;
   $kumpulkan_data = [];
  while ($d1=mysqli_fetch_array($q1)) { 
    $tgl = $d1['tanggal_transaksi'];


    $q2 =mysqli_query($conn, "SELECT sum(qty*harga_satuan) as penjualan from penjualan where id_cabang='$idcabang' and tanggal_transaksi='$tgl' 
    ");
    $d2 = mysqli_fetch_array ($q2);
    $jam = $d1['jam_transaksi'];
    $transaksi = $d1['qty'] * $d1['harga_satuan'];


      $data = [
        'tgl_transaksi' =>$tgl,
        'keterangan' =>'Penjualan produk',
        'debit' =>'0',
        'kredit' =>$d2['penjualan'],
      ];
      array_push($kumpulkan_data, $data);
    }

  $q2=mysqli_query($conn, "SELECT * from pengeluaran where id_cabang='$idcabang'
    ");
  $no=1;

  while ($d2=mysqli_fetch_array($q2)) { 
    $tgl = $d2['tanggal_transaksi'];
    $transaksi = $d2['biaya'];


      $data = [
        'tgl_transaksi' =>$tgl,
        'keterangan' =>$d2['keterangan'],
        'debit' =>$transaksi,
        'kredit' =>'0',
      ];
      array_push($kumpulkan_data, $data);
    }

    asort($kumpulkan_data);
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        <td>Tanggal Transaksi</td>
        <td>Keterangan</td>
        <td>Pemasukan</td>
        <td>Pengeluaran</td>
      </tr>
    </thead>
  <?php 

 

    ?>
  
  <?php 
  $no = 1;
    $totkredit = 0;
    $totdebit = 0;
  foreach ($kumpulkan_data as $v) { 
    $totkredit +=$v['kredit'];
    $totdebit +=$v['debit'];
    ?>
    <tr>
      <td><?php echo $no++ ?></td>
      <td><?php echo $v['tgl_transaksi'] ?></td>
      <td><?php echo $v['keterangan'] ?></td>
      <td><?php echo number_format($v['kredit']) ?></td>
      <td><?php echo number_format($v['debit']) ?></td>
    </tr>
  <?php } 
    $pendapatan  =  $totkredit- $totdebit;
  ?>

  <tfoot>
      <tr>
        <td colspan="3">Total</td>
        <td><?php echo  number_format($totkredit) ?></td>
        <td><?php echo number_format( $totdebit) ?></td>
      </tr>
      <tr>
        <td colspan="5"><center>Pendapatan : <?php echo number_format($pendapatan) ?></center></td>
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