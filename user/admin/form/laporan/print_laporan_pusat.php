<?php
session_start();
include "../../../../assets/koneksi.php";
require_once("../../../../assets/dompdf/src/Autoloader.php");
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];
$nama_bulan = $namabulan;
$id_user = $_SESSION['id_user'];
$q_user = mysqli_query($conn, "SELECT * from user where id_user='$id_user'");
$d_user = mysqli_fetch_array($q_user);

$waktu = $nama_bulan[$bulan].' '.$tahun;
$q_cab_utama = mysqli_query($conn, "SELECT * from cabang where status='Cabang Utama'");
$d_cab_utama = mysqli_fetch_array($q_cab_utama);
$html = '

<div style="width: 100px;float: left; margin-right:10px">
  <img src="../../../../assets/logo.jpeg" style="width: 100px;">
</div>

<div style="width: 700px; float:left;margin-top:-20px">
 
    <h3>
     Es Rajawali Padang
    </h3>
      <p style="font-size:12px; margin-top:-15px">
Cabang Utama : '.$d_cab_utama['nama_cabang'].'<br>Alamat : '.$d_cab_utama['alamat'].'<br>No HP : '.$d_cab_utama['nohp'].'</p>


</div>

<div style="clear:both;"></div>
<hr>

<center>
<p style="margin-top:-5px; font-size:15px">
Laporan Pemasukan Dan Pengeluaran <br>Semua Cabang <br>Bulan '.$waktu.'
</center
</p>



<table style=" font-size:11px;border-collapse: collapse; width: 100%;" border=1>
 <thead>
      <tr>
        <td>No</td>
        <td>Cabang</td>
        <td>Pemasukan</td>
        <td>Pengeluaran</td>
      </tr>
    </thead>
               
';
$no1 = 1;
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
        $html .='
         <tr>
        <td>'.$no++.'</td>
        <td>'.$d1['nama_cabang'].'</td>
        <td>'.number_format($d1['pemasukan']).'</td>
        <td>'.number_format($d1['pengeluaran']).'</td>
      </tr>';

    }


      $qmbb=mysqli_query($conn, "SELECT sum(qty * harga_satuan) as pengeluaran_bahan_baku from management_bahan_baku where jenis='Masuk' and year(tgl_transaksi)='$tahun' and month(tgl_transaksi)='$bulan'
    ");
    $dmbb = mysqli_fetch_array($qmbb);
    // $totalpengeluaran += $dmbb['pengeluaran_bahan_baku'];

      //   $html .='
      //    <tr>
      //   <td>'.$no++.'</td>
      //   <td>Gudang</td>
      //   <td>0</td>
      //   <td>'.number_format($dmbb['pengeluaran_bahan_baku']).'</td>
      // </tr>';
         $pendapatan = $totalpemasukan - $totalpengeluaran;
        $html .='
         <tfoot>
          <tr>
            <td colspan="2">Total</td>
            <td>'.number_format($totalpemasukan).'</td>
            <td>'.number_format($totalpengeluaran).'</td>
          </tr>
          <tr>
            <td colspan="2">Total Pendapatan</td>
            <td colspan="2">'.number_format($pendapatan).'
            </td>
          
           
          </tr>
        </tfoot>
        ';

$html .= '
</table>';
$html .= '
<br>

<div style="float:right; font-size:11px; text-align:center">
    Padang, '.date('d').' '.$nama_bulan[date('m')].' '.date('Y').'
    <br>
    <br>
    <br>
    <br>
    '.$d_user['nama_user'].'
  <center>
  </center>
</div>';

$dompdf = new Dompdf();
// $customPaper = array(0,0,200,360);
// $dompdf->set_paper($customPaper);
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('Laporan Pemasukan Dan Pengeluaran Semua Cabang.pdf', ['Attachment'=>0]);

?>
<p style="font-size: "></p>

