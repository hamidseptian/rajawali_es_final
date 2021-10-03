<?php 
$idcabang = $_SESSION['id_user'];
$qcabang = mysqli_query($conn, "SELECT * from cabang where id_cabang = '$idcabang'");

$dcabang = mysqli_fetch_array($qcabang); ?>
<div class="box-header with-border">
  <h3 class="box-title">Data penjualan <br>Cabang  : <?php echo $dcabang['nama_cabang'] ?></h3>

  <div class="box-tools pull-right">
    <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#filter">Filter</a>
    <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#add">Tambah penjualan</a>
  </div>
</div>

<form action="form/penjualan/simpan_penjualan.php" method="post" enctype="multipart/form-data" id="form_penjualan">
<div class="modal fade" id="add">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah penjualan</h4>
              </div>
              <div class="modal-body">
                  
              <div class="form-group">
                  <label>Tanggal Transaksi</label>
                  <input type="date" name="tgl" class="form-control" required value="<?php echo date('Y-m-d') ?>">
              </div> 
              <div class="form-group">
                  <label>Pesanan</label>
                  <table class="table table-striped table-bordered">
                    <tr>
                      <td>Produk</td>
                      <td>Harga</td>
                      <td>Jumlah Pesanan</td>
                    </tr>
                    <?php 
                    $qgaji = mysqli_query($conn, "SELECT * from produk where id_cabang in ('0','$idcabang')");
                    while ($dproduk = mysqli_fetch_array($qgaji)) { ?>
                       <tr>
                         <td><?php echo $dproduk['nama_produk'] ?></td>
                         <td><?php echo number_format($dproduk['harga']) ?></td>
                         <td>
                          <input type="number" name="qty[]" value="" class="form-control">
                          <input type="hidden" name="id_produk[]" value="<?php echo $dproduk['id_produk'] ?>">
                        </td>
                       </tr>
                     <?php } ?>
                  </table>
                <button type="button" class="btn btn-info btn-xs" onclick="cek_total()">Cek Penjualan</button>
              </div> 
             <hr>

              <div class="form-group" id="belanja_ok">
                  
                  
              </div> 
              <div class="form-group">
                
                
                <div class="clearfix"></div>
                  
              </div> 
            </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>


<form action="?a=filter_laporan_cabang" method="get" enctype="multipart/form-data" id="form_penjualan">
<div class="modal fade" id="filter">
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
                <input type="hidden" name="a" value="penjualan">
                  <select class="form-control" name="bulan">
                    <?php foreach ($namabulan as $key => $value) { ?>
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
if (isset($_GET['bulan']) && isset($_GET['tahun'])) {
$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];
  $q1 = mysqli_query($conn, "SELECT * from penjualan where id_cabang = '$idcabang' and month(tanggal_transaksi)='$bulan' and year(tanggal_transaksi)='$tahun' group by tanggal_transaksi, jam_transaksi");
}else{
  $q1 = mysqli_query($conn, "SELECT * from penjualan where id_cabang = '$idcabang' group by tanggal_transaksi, jam_transaksi");
}
  
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        <td>Tanggal Transaksi</td>
        <td>Pesanan</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    $tgl = $d1['tanggal_transaksi'];
    $jam = $d1['jam_transaksi'];
      $q2=mysqli_query($conn, "SELECT * from penjualan where id_cabang='$idcabang' and tanggal_transaksi='$tgl' and jam_transaksi='$jam'
    ");

    ?>
  <tr>
    <td><?php echo $no++ ?></td>
   
  
    
    <td><?php echo $d1['tanggal_transaksi'].'<br>'.$d1['jam_transaksi'] ?></td>
    <td>
      <table class="table table-bordered">
        <tr>
          <td>No</td>
          <td>Pesanan</td>
          <td>Harga Satuan</td>
          <td>QTY</td>
          <td>Total</td>
        </tr>
        <?php 
        $nom = 1;
        $total_harga = 0;
        while ($d2=mysqli_fetch_array($q2)) { 
          $total = $d2['qty'] * $d2['harga_satuan'];
          $total_harga += $total;
          ?>
          
        <tr>
          <td><?php echo $nom++ ?></td>
          <td><?php echo $d2['produk'] ?></td>
          <td><?php echo number_format($d2['harga_satuan'] )?></td>
          <td><?php echo number_format($d2['qty'] )?></td>
          <td><?php echo number_format($total)?></td>
        </tr>
        <?php } ?>
        <tr>
          <td colspan="4">Total</td>
          <td><?php echo number_format($total_harga) ?></td>
        </tr>
      </table>
        <a href="form/penjualan/hapus_penjualan.php?tgl=<?php echo $d1['tanggal_transaksi'] ?>&waktu=<?php echo $d1['jam_transaksi'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin.?')">Hapus</a>
        <a href="?a=edit_penjualan&tanggal=<?php echo $d1['tanggal_transaksi'] ?>" class="btn btn-warning btn-xs">Edit</a>    
        <!-- <a href="form/penjualan/print_faktur.php?tgl=<?php echo $d1['tanggal_transaksi'] ?>&waktu=<?php echo $d1['jam_transaksi'] ?>" target="_blank" class="btn btn-default btn-xs">Print</a>     -->
    </td>
   
    
   
    
  </tr>
  <?php } ?>
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