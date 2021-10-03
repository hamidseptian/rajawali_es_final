<?php 
$idcabang = $_SESSION['id_user'];
$tgl = $_GET['tanggal'];
 ?>

<div class="box-header with-border">
  <h3 class="box-title">Edit Penjualan</h3>

  <div class="box-tools pull-right">
    <a href="?a=penjualan" class="btn btn-info" >Kembali</a>
  </div>
</div>


<br>





<form action="form/penjualan/simpanedit_penjualan.php" method="post" enctype="multipart/form-data" id="form_penjualan">
              
                  
              <div class="form-group">
                  <label>Tanggal Transaksi</label>
                  <input type="date" name="tgl" class="form-control" required value="<?php echo $tgl ?>" readonly>
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
                    while ($dproduk = mysqli_fetch_array($qgaji)) { 
                      $produk=$dproduk['nama_produk'];
                      $q_penjualan = mysqli_query($conn, "SELECT * from penjualan where id_cabang='$idcabang' and tanggal_transaksi='$tgl' and produk='$produk'");
                      $d_penjualan = mysqli_fetch_array($q_penjualan);
                      $qty = intval($d_penjualan['qty']);

                      ?>
                       <tr>
                         <td><?php echo $dproduk['nama_produk'] ?></td>
                         <td><?php echo number_format($dproduk['harga']) ?></td>
                         <td>
                          <input type="number" name="qty[]" class="form-control" value="<?php echo $qty ?>">
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
            <!-- /.modal-content -->
          <!-- /.modal-dialog -->
</form>




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