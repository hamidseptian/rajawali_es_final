<?php
session_start();
include "../../../../assets/koneksi.php";
require_once("../../../../assets/dompdf/src/Autoloader.php");
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];
$id_cabang = $_GET['id_cabang'];
$idcabang = $id_cabang;
$nama_bulan = $namabulan;

$waktu = $nama_bulan[$bulan].' '.$tahun;
$q_cab_utama = mysqli_query($conn, "SELECT * from cabang where id_cabang='$id_cabang'");
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
Cabang : '.$d_cab_utama['nama_cabang'].'<br>Alamat : '.$d_cab_utama['alamat'].'<br>No HP : '.$d_cab_utama['nohp'].'</p>


</div>

<div style="clear:both;"></div>
<hr>

<center>
<p style="margin-top:-5px; font-size:15px">
Laporan Pemasukan Dan Pengeluaran <br>Bulan '.$waktu.'
</center
</p>



<table style=" font-size:11px;border-collapse: collapse; width: 100%;" border=1>
   <thead>
      <tr>
        <td>No</td>
        <td>Tanggal Transaksi</td>
        <td>Keterangan</td>
        <td>Pemasukan</td>
        <td>Pengeluaran</td>
      </tr>
    </thead>
               
';
$no1 = 1;
 
  $q1=mysqli_query($conn, "SELECT * from penjualan where id_cabang='$idcabang' and 
    year(tanggal_transaksi)='$tahun' and month(tanggal_transaksi)='$bulan' group by tanggal_transaksi
    ");
  $no=1;
   $kumpulkan_data = [];
  while ($d1=mysqli_fetch_array($q1)) { 
    $tgl = $d1['tanggal_transaksi'];
     $q2 =mysqli_query($conn, "SELECT sum(qty*harga_satuan) as penjualan from penjualan where id_cabang='$idcabang' and tanggal_transaksi='$tgl' 
    ");
    $d2 = mysqli_fetch_array ($q2);


 


      $data = [
        'tgl_transaksi' =>$tgl,
           'keterangan' =>'Penjualan produk',
        'debit' =>'0',
        'kredit' =>$d2['penjualan'],
      ];
      array_push($kumpulkan_data, $data);
    }

  $q2=mysqli_query($conn, "SELECT * from pengeluaran where id_cabang='$idcabang' and 
    year(tanggal_transaksi)='$tahun' and month(tanggal_transaksi)='$bulan'
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
     $no = 1;
    $totkredit = 0;
    $totdebit = 0;
    foreach ($kumpulkan_data as $v) { 
      $totkredit +=$v['kredit'];
      $totdebit +=$v['debit'];
      
      $html .= '<tr>
        <td>'.$no++.'</td>
        <td>'.$v['tgl_transaksi'].'</td>
        <td>'.$v['keterangan'].'</td>
        <td>'.number_format($v['kredit']).'</td>
        <td>'.number_format($v['debit']).'</td>
      </tr>';
     } 
      $pendapatan  =  $totkredit- $totdebit;
      $pendapatan  =  $totkredit- $totdebit;
      $html .='<tfoot>
            <tr>
              <td colspan="3">Total</td>
              <td>'. number_format($totkredit).'</td>
              <td>'.number_format( $totdebit).'</td>
            </tr>
            <tr>
              <td colspan="3">Pendapatan </td>
              <td colspan="2">'.number_format($pendapatan).'</td>
            </tr>
          </tfoot>';
        //  $pendapatan = $totalpemasukan - $totalpengeluaran;
        // $html .='
        //  <tfoot>
        //   <tr>
        //     <td colspan="2">Total</td>
        //     <td>'.number_format($totalpemasukan).'</td>
        //     <td>'.number_format($totalpengeluaran).'</td>
        //   </tr>
        //   <tr>
        //     <td colspan="2">Total Pendapatan</td>
        //     <td colspan="2">'.number_format($pendapatan).'
        //     </td>
          
           
        //   </tr>
        // </tfoot>
        // ';

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
    '.$d_cab_utama['pj'].'<br>
    Pengelola Cabang '.$d_cab_utama['nama_cabang'].'
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

