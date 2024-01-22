<?php
error_reporting(1);
include '../koneksi/koneksi.php';

$hal = $_POST['hal'];
$kode_cs = $_POST['kd_cs'];
$kode_produk = $_POST['produk'];
$harga = $_POST['harga'];
$berat = $_POST['berat'];
if (isset($_POST['jml'])) {
	$qty = $_POST['jml'];
}
// var_dump($hal);
// var_dump($kode_cs);
// var_dump($kode_produk);
// var_dump($ukuran);
// var_dump($harga);
// var_dump($berat);
// var_dump($qty);


$stmt = mysqli_prepare($conn, "SELECT * FROM produk WHERE kode_produk = ?");
mysqli_stmt_bind_param($stmt, "s", $kode_produk);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

$nama_produk = $row['nama'];

// Gunakan prepared statement
$result1_stmt = mysqli_prepare($conn, "SELECT k.id_keranjang as keranjang, k.kode_produk as kd, k.nama_produk as nama, k.qty as jml, p.image as gambar, k.harga as hrg FROM keranjang k JOIN produk p ON k.kode_produk = p.kode_produk WHERE kode_customer = ?");
mysqli_stmt_bind_param($result1_stmt, "s", $kode_cs);
mysqli_stmt_execute($result1_stmt);

$result1 = mysqli_stmt_get_result($result1_stmt);
$row1 = mysqli_fetch_assoc($result1);


$kd = $row['kode_produk'];
// var_dump($row1);

// die();
// Gunakan prepared statement
$cek_stmt = mysqli_prepare($conn, "SELECT * FROM keranjang WHERE kode_produk = ? AND kode_customer = ?");
mysqli_stmt_bind_param($cek_stmt, "ss", $kode_produk, $kode_cs);
mysqli_stmt_execute($cek_stmt);

$cek_result = mysqli_stmt_get_result($cek_stmt);

$jml = mysqli_num_rows($cek_result);
$row1 = mysqli_fetch_assoc($cek_result);


if ( $jml > 0) {
	try {
		$set = $row1['qty'] + $qty;
	$stmt = mysqli_prepare($conn, "UPDATE keranjang SET qty = ? WHERE kode_produk = ? AND kode_customer = ?");
	mysqli_stmt_bind_param($stmt, "sss", $set, $kode_produk, $kode_cs);
	mysqli_stmt_execute($stmt);
	} catch (\Throwable $th) {
		throw $th->getMessage();
	}
	if ($stmt) {
		// var_dump($stmt);
		echo "
			<script>
			alert('BERHASIL DITAMBAHKAN KE KERANJANG');
			window.location = '../detail_produk.php?produk=" . $kode_produk . "';
			</script>
			";
		die;
	}
} else {
	$stmt = mysqli_prepare($conn, "INSERT INTO keranjang VALUES('', ?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "ssssss", $kode_cs, $kd, $nama_produk, $qty, $harga, $berat);
	mysqli_stmt_execute($stmt);
	if ($stmt) {
		echo "
			<script>
			alert('BERHASIL DITAMBAHKAN KE KERANJANG');
			window.location = '../detail_produk.php?produk=" . $kode_produk . "';
			</script>
			";
		die;
	}
}
mysqli_close($conn);
