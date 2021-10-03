
<?php 
include "../../../assets/koneksi.php";
$tglbook =$_POST['tglbook'];
$id =$_POST['idpaket'];
$lama =$_POST['lama'];
$jambook =$_POST['jambook'];
$kegiatan =$_POST['kegiatan'];
$qcek = mysqli_query($conn, "SELECT min(tanggal_mulai) as tglawal, max(tanggal_mulai) as tglakhirmulai, max(tanggal_selesai) as tglakhir from booking where status='Booking' or status='Berlangsung'");
$dcek = mysqli_fetch_array($qcek);
$awal =  $dcek['tglawal'];
$akhir =  $dcek['tglakhir'];

// $awal =  $dcek['tglakhirmulai'];


$q = mysqli_query($conn, "SELECT * from booking where tanggal_mulai between '$tglbook' and '$tglawal'");
$j = mysqli_num_rows($q);
?>
<h3>Bookingan Tanggal <?php echo $tglbook ?></h3>
<table class="table table-striped table-bordered">
    <tr>
        <td>No</td>
        <td>Kegiatan</td>
        <td>Lama Kegiatan</td>
        <td>Waktu Mulai Acara</td>
        <td>Waktu Selesai Acara</td>
        <td>Waktu Booking</td>
    </tr>
    <?php   while ($d=mysqli_fetch_array($q)) { ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

            
    <?php } ?>
</table>


<a href="?m=addbooking&tgl=<?php echo $tglbook ?>&idj=<?php echo $id ?>&k=<?php echo $kegiatan ?>&lama=<?php echo $lama ?>&jambook=<?php echo $jambook ?>" class="btn btn-info btn-xs">Booking</a>
    
