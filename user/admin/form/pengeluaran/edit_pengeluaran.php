<div class="box-header with-border">
  <h3 class="box-title">Edit Data Pengeluaran</h3>

  <div class="box-tools pull-right">
    <a href="?a=pengeluaran" class="btn btn-info" >Kembali</a>
  </div>
</div>


<?php 
$id=$_GET['id'];
$idcabang = $_SESSION['id_user'];
  $q1=mysqli_query($conn, "SELECT * from pengeluaran where id_pengeluaran='$id'") or die(mysqli_error());
  $d_pengeluaran=mysqli_fetch_array($q1);
  // var_dump($d1['biaya']);
  $j1=mysqli_num_rows($q1);
 ?>

<br>

<form action="form/pengeluaran/simpanedit_pengeluaran.php" method="post" enctype="multipart/form-data">

              <input type="hidden" name="id" value="<?php echo $id ?>">
                  
              <div class="form-group">
                  <label>Jenis Pengeluaran</label>
                  <select class="form-control" id="kategori" name="kategori">
                    <option value="">--Pilih Pengeluaran--</option>
                    <option value="Penggajian" <?php  if($d_pengeluaran['kategori']=='Penggajian'){echo "selected";} ?>>Penggajian</option>
                    <option value="Operasional" <?php  if($d_pengeluaran['kategori']=='Operasional'){echo "selected";} ?>>Operasional</option>
                  </select>
              </div> 
              <div class="form-group" id="penggajian" <?php if($d_pengeluaran['kategori']!='Penggajian'){echo 'hidden="true"';} ?>>
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
                    <input type="date" name="tgl_transaksi" class="form-control" required value="<?php echo $d_pengeluaran['tanggal_transaksi'] ?>">
                </div> 
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea type="text" name="keterangan" class="form-control" id="keterangan"><?php echo str_replace('<br />', '', $d_pengeluaran['keterangan']) ?></textarea>
                </div> 
                <div class="form-group">
                    <label>Biaya</label>
                    <input type="text" name="biaya" class="form-control" required id="biaya" value="<?php echo $d_pengeluaran['biaya'] ?>">
                </div> 
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan Data <?php echo $d1['biaya'] ?></button>
               
              </div>
          
</form>

