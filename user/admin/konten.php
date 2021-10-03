<?php 
@$menu = $_GET['a'];
if ($menu=='') {
  if ($_SESSION['level']=='Admin Toko') {
    include "form/dashboard/dashboard_toko.php";
    # code...
  }else{
    include "form/dashboard/dashboard.php";

  }
}
else if ($menu=='cabang') {
  include "form/cabang/index.php";
}
else if ($menu=='pengeluaran') {
  include "form/pengeluaran/index.php";
}
else if ($menu=='edit_pengeluaran') {
  include "form/pengeluaran/edit_pengeluaran.php";
}
else if ($menu=='edit_penjualan') {
  include "form/penjualan/edit_penjualan.php";
}
else if ($menu=='pesanan') {
  include "form/pesanan/index.php";
}
else if ($menu=='detail_pesanan') {
  include "form/pesanan/detail_pesanan.php";
}
else if ($menu=='laporan_cabang') {
  include "form/laporan/laporan_cabang.php";
}
else if ($menu=='laporan_pusat') {
  include "form/laporan/laporan_pusat.php";
}
else if ($menu=='filter_laporan_cabang') {
  include "form/laporan/filter_laporan_cabang.php";
}
else if ($menu=='filter_laporan_pusat') {
  include "form/laporan/filter_laporan_pusat.php";
}
else if ($menu=='penjualan') {
  include "form/penjualan/index.php";
}
else if ($menu=='edit_cabang') {
  include "form/cabang/edit_cabang.php";
}
else if ($menu=='bahan_baku') {
  include "form/bahan_baku/index.php";
}
else if ($menu=='edit_bahan_baku') {
  include "form/bahan_baku/edit_bahan_baku.php";
}
else if ($menu=='edit_penggajian') {
  include "form/penggajian/edit_penggajian.php";
}
else if ($menu=='edit_karyawan') {
  include "form/karyawan/edit_karyawan.php";
}
else if ($menu=='user') {
  include "form/user/index.php";
}
else if ($menu=='edit_user') {
  include "form/user/edit_user.php";
}
else if ($menu=='edit_produk') {
  include "form/produk/edit_produk.php";
}
else if ($menu=='penggajian') {
  include "form/penggajian/index.php";
}
else if ($menu=='produk') {
  include "form/produk/index.php";
}
else if ($menu=='management_bahan_baku') {
  include "form/management_bahan_baku/index.php";
}
//admin toko
else if ($menu=='permintaan_bahan_baku') {
  include "form/permintaan_bahan_baku/index.php";
}
else if ($menu=='permintaan_bahan_baku_cabang') {
  include "form/management_bahan_baku/permintaan_bahan_baku_cabang.php";
}
else if ($menu=='detail_permintaan_bahan_baku') {
  include "form/permintaan_bahan_baku/detail_permintaan_bahan_baku.php";
}
else if ($menu=='detail_permintaan_bahan_baku_cabang') {
  include "form/management_bahan_baku/detail_permintaan_bahan_baku.php";
}
else if ($menu=='laporan_bahan_baku') {
  include "form/management_bahan_baku/laporan.php";
}
else if ($menu=='karyawan') {
  include "form/karyawan/index.php";
}
else if ($menu=='target_pendapatan') {
  include "form/target_pendapatan/index.php";
}

//no fitur
else{
	echo "Fitur ini belum tersedia";
}
 ?>

