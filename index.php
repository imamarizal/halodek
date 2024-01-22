<?php
include 'header.php';
?>
<!-- IMAGE -->
<div class="container-fluid" style="margin: 0;padding: 0;">
	<div class="image" style="margin-top: -21px">
		<img src="image/home/front.jpg" style="width: 1519px; height: 530px;">
	</div>
</div>
<br>
<br>

<!-- PRODUK TERBARU -->
<div class="container">

	<?php
	$hasil = mysqli_query($conn, "SELECT * FROM posts");
	$posts = mysqli_fetch_assoc($hasil);
	$deskripsi = $posts['deskripsi'];
	?>
	<h4 class="text-center" style="font-family: arial; padding-top: 10px; padding-bottom: 10px; font-style: italic; line-height: 29px; border-top: 8px double #d9b712; border-bottom: 8px double #d9b712;"><?php echo $deskripsi ?></h4>

	<h2 style=" width: 100%; border-bottom: 4px solid #d9b712; color:#4d0000; margin-top: 80px;"><b>Produk Kami</b></h2>

	<div class="row">
		<?php
<<<<<<< HEAD
		$result = mysqli_query($conn, "SELECT * FROM produk GROUP BY kode_produk");
=======
		$result = mysqli_query($conn, "SELECT * FROM produk");
>>>>>>> c19feda1ff335378b5e12e54799e15c96e37be16
		while ($row = mysqli_fetch_assoc($result)) {
		?>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img src="image/produk/<?= $row['image']; ?>">
					<div class="caption">
						<h3><?= $row['nama'];  ?></h3>
						<h4>
							<?php
							if (strpos($row['harga'], ",") == false) {
								echo "Rp." . number_format($row['harga']) . "";
							} else {
								$a = explode(",", $row['harga']);
								echo "Rp." . number_format($a[0]) . " - " . number_format(end($a));
							}
							?>
						</h4>
						<div class="row">
							<div class="col-md-12">
								<a href="detail_produk.php?produk=<?= $row['kode_produk']; ?>" class="btn btn-warning btn-block">Detail</a>
							</div>


						</div>

					</div>
				</div>
			</div>
		<?php
		}
		?>
	</div>

</div>
<br>
<br>
<br>
<br>
<?php
include 'footer.php';
?>