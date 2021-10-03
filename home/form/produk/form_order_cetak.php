
<?php 
include "../../../assets/koneksi.php"; 
$id = $_GET['id'];

$qedit = mysqli_query($conn, "SELECT * from harga_edit");
$edit = array();
$data['id'] = '';
$data['nama'] = 'Tanpa Edit';
$data['harga'] = '0';
array_push($edit, $data);

while ($dedit = mysqli_fetch_array($qedit)) {
    $data['id'] = $dedit['id_he'];
    $data['nama'] = $dedit['nama_edit'];
    $data['harga'] = $dedit['harga_edit'];
    array_push($edit, $data);
}
?>


                   




                      