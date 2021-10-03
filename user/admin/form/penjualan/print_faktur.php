<?php
session_start();
$id_cabang=$_SESSION['id_user'];
include "../../../../assets/koneksi.php";
require_once("../../../../assets/dompdf/src/Autoloader.php");
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$html = '
<div style="width:200px">
 ';

$tgl = $_GET['tgl'];
    $jam = $_GET['waktu'];
      $q2=mysqli_query($conn, "SELECT * from penjualan where id_cabang='$id_cabang' and tanggal_transaksi='$tgl' and jam_transaksi='$jam'
    ");


$waktu = $tgl.' '.$jam;
$q_cab = mysqli_query($conn, "SELECT * from cabang where id_cabang='$id_cabang'");
$d_cab = mysqli_fetch_array($q_cab);
$html .= '

<div style="width: 50px;float: left; margin-right:10px">
  <img src="../../../../assets/logo.jpeg" style="width: 50px;">
</div>

<div style="width: 700px; float:left;margin-top:-10px;">
 
      <p style="font-size:9px">
      Es Rajawali Padang <br>
Cabang : '.$d_cab['nama_cabang'].'<br>Alamat : '.$d_cab['alamat'].'<br>No HP : '.$d_cab['nohp'].'</p>


</div>

<div style="clear:both;"></div>
<hr>

<center>
<p style="margin-top:-5px; font-size:10px">
Order
</center
</p>



<table style=" font-size:9px;border-collapse: collapse; width: 100%;" >
   
';
$nom = 1;
$total_harga=0;
 while ($d2=mysqli_fetch_array($q2)) { 
          $total = $d2['qty'] * $d2['harga_satuan'];
          $total_harga += $total;
         
        $html .='<tr>
          <td colspan="4">'.$d2['produk'].'</td>
        
        </tr>';
        $html .='<tr>
          <td colspan="3">'.number_format($d2['qty']).' * '.number_format($d2['harga_satuan']) .'</td>
          <td align="right">'.number_format($total).'</td>
        </tr>';
       }

$html .='<tr>
  <td colspan="4"><hr></td>
</tr>';
$html .='<tr>
  <td colspan="3">Total</td>
  <td align="right">'.number_format($total_harga).'</td>
</tr>';
// $html .='<tr>
//   <td colspan="4"><br>Terima kasih sudah berbelanja di Es Rajawali Padang</td>
// </tr>';
$html .= '
</table>';

$html .= '
</div>';

$dompdf = new Dompdf();
$page_count = $dompdf->get_canvas( )->get_page_number();
$customPaper = array(15,-12,200,400);
$dompdf->set_paper($customPaper);
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('Faktur.pdf', ['Attachment'=>0]);

?>
