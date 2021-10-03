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
$bln = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$thn = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
?>
<div class="box-header with-border">
  <h3 class="box-title">Target Dan Pendapatan Cabang <br>Bulan <?php echo $bulan[$bln].' Tahun '.$thn ?></h3>
  <div class="pull-right">
     <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#filter_bulanan">FIlter</a>
     
  </div>
 
</div>

<form action="?a=target_pendapatan" method="get" enctype="multipart/form-data" id="form_penjualan">
  <input type="hidden" name="a" value="target_pendapatan">
<div class="modal fade" id="filter_bulanan">
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

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        <td>Cabang</td>
        <td>Target</td>
        <td>Pendapatan</td>
        <td>Selisih</td>
        <td>Keterangan</td>
        <td>Option</td>
      </tr>
    </thead>
  <?php 


$q1 = mysqli_query($conn, "SELECT * from cabang");
$no=1;
$tottarget = 0;
$totpendapatan = 0;
  while ($d1=mysqli_fetch_array($q1)) { 
    $id_cabang = $d1['id_cabang'];
    $q_target = mysqli_query($conn, "SELECT target_penjualan from target where id_cabang='$id_cabang' and bulan='$bln' and tahun='$thn'");
    $d_target = mysqli_fetch_array($q_target);
    $q_penjualan = mysqli_query($conn, "SELECT sum(harga_satuan * qty) as pendapatan from penjualan where id_cabang='$id_cabang' and month(tanggal_transaksi)='$bln' and year(tanggal_transaksi)='$thn'");
    $d_penjualan = mysqli_fetch_array($q_penjualan);


    $target = $d_target['target_penjualan'];
    $pendapatan = $d_penjualan['pendapatan'];
    $selisih = $pendapatan - $target;
    $keterangan = $selisih > 0 ? 'Melebihi Target ' : 'Tidak Mencapai Target';
    $warna = $selisih > 0 ? 'green' : 'red';
    ?>
 
<div class="modal fade" id="set_target_<?php echo $id_cabang ?>">
<form action="form/target_pendapatan/simpan_target.php" method="post" enctype="multipart/form-data" id="form_penjualan">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Atur target penjualan</h4>
              </div>
              <div class="modal-body">
              <div class="form-group">
                  <label>Cabang</label>
                  <input type="hidden" name="id_cabang" value="<?php echo $d1['id_cabang'] ?>" class="form-control" readonly>
                  <input type="hidden" name="bulan_input" value="<?php echo $bln ?>" class="form-control" readonly>
                  <input type="" name="" value="<?php echo $d1['nama_cabang'] ?>" class="form-control" readonly>
              </div> 
                  
              <div class="form-group">
                  <label>Bulan</label>
                  <input type="" name="" value="<?php echo $bulan[$bln] ?>" class="form-control" readonly>
              </div> 
           
              <div class="form-group">
                  <label>Tahun</label>
                  <input type="" name="tahun_input" value="<?php echo $thn ?>" class="form-control" readonly>
              </div> 
           
              <div class="form-group">
                  <label>Target Penjualan</label>
                  <input type="number" name="target"  class="form-control" value="<?php echo $target == '' ? 0 : $target ?>">
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
</form>
        </div>
    <tr>
      <td><?php echo $no++ ?></td>
      <td><?php echo $d1['nama_cabang'] ?></td>
      <td><?php echo number_format($target) ?></td>
      <td><?php echo number_format($pendapatan) ?></td>
      <td><?php echo number_format($selisih) ?></td>
      <td><?php echo $keterangan ?></td>
      <td>
        <a href="#" class="btn btn-info btn-xs"  data-toggle="modal" data-target="#set_target_<?php echo $id_cabang ?>">Atur Target</a>
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