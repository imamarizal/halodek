<?php
include 'header.php';
$kode = mysqli_real_escape_string($conn, $_GET['produk']);

// Gunakan prepared statement
$stmt = mysqli_prepare($conn, "SELECT * FROM produk WHERE kode_produk = ?");
mysqli_stmt_bind_param($stmt, "s", $kode);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$jml = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
// var_dump($row);
// die();

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid #ff8680"><b>Detail produk</b></h2>

	<div class="row">
		<div class="col-md-4">
			<div class="thumbnail">
				<img src="image/produk/<?= $row['image']; ?>" width="400">
			</div>
		</div>

		<div class="col-md-8">
			<form action="proses/add.php" method="POST">
				<input type="hidden" name="kd_cs" value="<?= $kode_cs; ?>">
				<input type="hidden" name="berat" value="<?php echo $row['berat']; ?>">
				<input type="hidden" id="kode" name="produk" value="<?= $kode;  ?>">
				<input type="hidden" name="hal" value="2">
				<input type="hidden" name="harga" value="<?php echo $row['harga']; ?>" id="setharga">
				<table class="table table-striped">
					<tbody>
						<tr>
							<td><b>Nama</b></td>
							<td><?= $row['nama']; ?></td>
						</tr>
						<tr>
							<td><b>Harga</b></td>
							<td id="harga">
								<?php
								if (strpos($row['harga'], ",") == false) {
									echo "Rp." . number_format($row['harga']) . "";
								} else {
									$a = explode(",", $row['harga']);
									echo "Rp. " . number_format($a[0]) . " - " . number_format(end($a));
								}
								?>
							</td>
						</tr>
						<tr>
							<td><b>Deskripsi</b></td>
							<td><?= $row['deskripsi'];  ?></td>
						</tr>
						<tr>
							<td><b>Jumlah</b></td>
							<td><input class="form-control" type="number" min="1" name="jml" value="1" style="width: 155px;"></td>
						</tr>
					</tbody>
				</table>
				<?php
				if (isset($_SESSION['user'])) {
				?>
					<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Tambahkan ke Keranjang</button>
				<?php
				} else {

				?>
					<a href="keranjang.php" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Tambahkan ke Keranjang</a>
				<?php
				}
				?>
				<a href="index.php" class="btn btn-warning"> Kembali Belanja</a>
		</div>
		</form>
	</div>


</div>
<br>
<br>
<br>

<script type="text/javascript">
	$(document).ready(function() {

		$("#ukuran").change(function() {
			//Mengambil value dari option select provinsi asal, kabupaten, kurir, berat kemudian parameternya dikirim menggunakan ajax 
			var ukuran = $('#ukuran').val();
			var kode = $('#kode').val();

			$.ajax({
				type: 'POST',
				url: 'http://localhost/inovasi/cekharga.php',
				data: {
					'ukuran': ukuran,
					'kode': kode
				},
				success: function(data) {
					var arr = data.split("|");

					$("#harga").html(arr[0]);
					$("#setharga").val(arr[1]);
				}
			});
		});
	});
</script>

<?php
include 'footer.php';
?>