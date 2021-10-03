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

  $idcabang = $_SESSION['id_user'];

$qcabang = mysqli_query($conn, "SELECT * from cabang where id_cabang = '$idcabang'")or die(mysqli_error());
$q = mysqli_query($conn, "SELECT sum(qty * harga_satuan) as total, sum(qty) as jml_produk, waktu_pesan, status, nama_pelanggan, alamat_pelanggan, nohp_pelanggan, a.id_pelanggan from pesanan as a
left join produk as b on a.id_produk=b.id_produk
left join pelanggan c on a.id_pelanggan = c.id_pelanggan
  where a.status='Order' and a.id_cabang='$idcabang' group by waktu_pesan order by waktu_pesan desc");
$j = mysqli_num_rows($q);
$dcabang = mysqli_fetch_array($qcabang); ?>
<div class="box-header with-border">
  <h3 class="box-title">Daftar pemesanan online <br>Cabang  : <?php echo $dcabang['nama_cabang'] ?></h3>

 
</div>


<hr>

<table class="table table-bordered table-striped" id="example1">
    <thead>
      <tr>
        <td>No</td>
        <td>Pelanggan</td>
        <td>Waktu Pesan</td>
        <td>Jumlah Produk</td>
        <td>Total Biaya</td>
        <td>Status Pesanan</td>
        <td>Action</td>
      </tr>
    </thead>
<?php 
$no = 1;
$nol=0;
while ($d = mysqli_fetch_array($q)) { 
  
  ?>
    <tr>
      <td><?php echo $no++ ?></td>
      
      <td><?php echo $d['nama_pelanggan'].'<br>'.$d['alamat_pelanggan'].'<br>'.$d['nohp_pelanggan'] ?></td>
      <td><?php echo $d['waktu_pesan'] ?></td>
      <td><?php echo $d['jml_produk'] ?></td>
      <td><?php echo number_format($d['total']) ?></td>
      <td><?php echo $d['status'] ?></td>
      
      <td><a href="?a=detail_pesanan&id_pelanggan=<?php echo $d['id_pelanggan'] ?>&waktu=<?php echo $d['waktu_pesan'] ?>">Lihat Detail</a></td>
    </tr>
  

  <?php } ?>
  
  </table>
