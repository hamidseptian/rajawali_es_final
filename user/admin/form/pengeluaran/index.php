<?php 
if ($_SESSION['level']=='Admin Master') {
  # code...
  $qcabang_utama = mysqli_query($conn, "SELECT * from cabang where status = 'Cabang Utama'");
  $dcabang_utama = mysqli_fetch_array($qcabang_utama);
  $idcabang = $dcabang_utama['id_cabang'];
  $caption_nama_cabang = 'Utama';
}else{
  $caption_nama_cabang = '';
  $idcabang = $_SESSION['id_user'];
}
$qcabang = mysqli_query($conn, "SELECT * from cabang where id_cabang = '$idcabang'");
$dcabang = mysqli_fetch_array($qcabang); ?>
<div class="box-header with-border">
  <h3 class="box-title">Data pengeluaran <br>Cabang <?php echo $caption_nama_cabang ?>  : <?php echo $dcabang['nama_cabang'] ?></h3>

  <div class="box-tools pull-right">
    <!-- <a href="" class="btn btn-default btn-sm"  target="_blank">Print Data Paket</a> -->
    <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#add">Tambah pengeluaran</a>
  </div>
</div>

<form action="form/pengeluaran/simpan_pengeluaran.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="add">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah pengeluaran</h4>
              </div>
              <div class="modal-body">
                  
              <div class="form-group">
                  <label>Jenis Pengeluaran</label>
                  <select class="form-control" id="kategori" name="kategori">
                    <option value="">--Pilih Pengeluaran--</option>
                    <option value="Bahan Baku">Bahan Baku</option>
                    <option value="Penggajian">Penggajian</option>
                    <option value="Operasional">Operasional</option>
                    
                    
                  </select>
              </div> 
           
              <div class="form-group" id="penggajian" hidden="true">
                  <div style="display:none">
                    <label>Bulan</label>
                      <select class="form-control" id="bulangaji">
                        <?php 
                        $bulan = array(1=>"Januari","Februaru","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"); 
                        foreach ($bulan as $key => $value) { ?>
                          <option value="<?php echo $value ?>"><?php echo $value ?></option>
                         <?php } ?>
                      </select>
                      <br>
                  </div>
                  <label>Karyawan Yang Akan Digaji</label>
                    <?php 
                      $q1=mysqli_query($conn, "SELECT * from karyawan k left join penggajian p on k.id_penggajian = p.id_penggajian where k.id_cabang='$idcabang'
                        ");
                      $no=1;
                     ?>

                     <table class="table table-striped table-bordered"  width="100%">
                        <thead>
                          <tr>
                            <td>Nama</td>
                            <td>Jabatan</td>
                            <td>Gaji</td>
                          </tr>
                        </thead>
                      <?php 
                      $totalgaji = 0;
                      while ($d1=mysqli_fetch_array($q1)) { 
                        $totalgaji +=$d1['gaji'];

                        ?>
                      <tr>
                       
                      
                        
                        <td><?php echo $d1['nama'] ?></td>
                        <td><?php echo $d1['jabatan'] ?></td>
                        <td>Rp. <?php echo number_format($d1['gaji']) ?></td>
                        
                      </tr>
                      <?php } ?>
                      <tr>
                        <td colspan="2">Total</td>
                        <td>Rp. <?php echo number_format($totalgaji) ?></td>
                      </tr>
                    </table>


<script type="text/javascript">
  $('.pilih_karyawan').click(function(){
    var id_karyawan = $(this).attr('id');
    var bulan = $('#bulangaji').val();
    var tahun = '<?php echo date('Y') ?>';
    console.log(id_karyawan);
    $.ajax({
      url : 'form/pengeluaran/cek_gaji_karyawan.php?id=' + id_karyawan,
      dataType : 'json',
      success : function(data){
        $('#keterangan').val('Pembayaran gaji bulan '+bulan+' '+tahun+' \nkaryawan jabatan '+data.jabatan+' \natas nama ' + data.karyawan);
        $('#biaya').val(data.gaji);
        $('#penggajian').hide();
        
      },
      error : function(){
        console.log('error');
      }
    });

  });
  $('#kategori').change(function(){
    var keterangan = $('#keterangan').val('');
    var biaya = $('#biaya').val('');

    var kategori = $('#kategori').val();
    console.log(kategori)
    if (kategori=='Penggajian') {
      var bulan = $('#bulangaji').val();
    var tahun = '<?php echo date('Y') ?>';
      $('#penggajian').show();
      $('#biaya').val('<?php echo $totalgaji ?>');
      $('#keterangan').val('Pembayaran gaji karyawan');
    }else{
      $('#penggajian').hide();
      $('#biaya').val('');
      $('#keterangan').html('');

    }

  });
</script>


              </div> 
              <div id="bukan_penggajian">
                
                <div class="form-group">
                    <label>Tanggal Transaksi</label>
                    <input type="date" name="tgl_transaksi" class="form-control" required value="<?php echo date('Y-m-d') ?>">
                </div> 
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea type="text" name="keterangan" class="form-control" id="keterangan"></textarea>
                </div> 
                <div class="form-group">
                    <label>Biaya</label>
                    <input type="text" name="biaya" class="form-control" required id="biaya">
                </div> 
              </div>
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Data pengeluaran</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>


<hr>
<?php 
  $q1=mysqli_query($conn, "SELECT * from pengeluaran where id_cabang='$idcabang'
    ");
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        <td>Kategori</td>
        <td>Keterangan Transaksi</td>
        <td>Tanggal Transaksi</td>
        <td>Biaya</td>
        
      
       
        <td>Option</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
   
  
    
    <td><?php echo $d1['kategori'] ?></td>

    <td><?php echo $d1['keterangan'] ?></td>
    <td><?php echo $d1['tanggal_transaksi'] ?></td>
    <td>Rp. <?php echo number_format($d1['biaya']) ?></td>
    <td>
      <a href="form/pengeluaran/hapus_pengeluaran.php?id=<?php echo $d1['id_pengeluaran'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin.?')">Hapus</a>
      <a href="?a=edit_pengeluaran&id=<?php echo $d1['id_pengeluaran'] ?>" class="btn btn-warning btn-xs">Edit</a>    
    </td>
  </tr>
  <?php } ?>
</table>