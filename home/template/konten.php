<?php 
$menu = $_GET['m'];

if ($menu=='register'){ 
	include "form/register/register.php";
}
else if ($menu=='login_pelanggan'){ 
	include "login/pelanggan/index.php";
}
else if ($menu=='cabang'){ 
	include "form/cabang/index.php";
}
else if ($menu=='produk'){ 
	include "form/produk/index.php";
}
else if ($menu=='pesanan'){ 
	include "form/pesanan/index.php";
}
else if ($menu=='detail_pesanan'){ 
	include "form/pesanan/detail_pesanan.php";
}
else if ($menu=='v_produk'){ 
	include "form/produk/det_produk.php";
}
else if ($menu=='v_cetak'){ 
	include "form/jasa/det_cetak.php";
}
else if ($menu=='galeri'){ 
	include "form/galeri/galeri.php";
}
else if ($menu=='addbooking'){ 
	include "form/jasa/booking.php";
}
else if ($menu=='booking'){ 
	include "form/booking/booking.php";
}
else if ($menu=='keranjang_book'){ 
	include "form/keranjang/keranjang_booking.php";
}
else if ($menu=='myfoto'){ 
	include "form/galeri/my_foto.php";
}
else if ($menu=='keranjang'){ 
	include "form/keranjang/keranjang.php";
}
else if ($menu=='history'){ 
	include "form/pesanan/history_pesanan.php";
}
else if ($menu=='history_booking'){ 
	include "form/pesanan/history_booking.php";
}
else if ($menu=='detail_history'){ 
	include "form/pesanan/detail_history.php";
}
else if ($menu=='detail_history_booking'){ 
	include "form/pesanan/detail_history_booking.php";
}
else if ($menu=='login_admin'){ 
	include "login/admin/index.php";
}
else if ($menu=='login'){ 
	include "login/pilihlogin.php";
}

else 
{
	echo "Fitur belum tersedia";
}

 ?>