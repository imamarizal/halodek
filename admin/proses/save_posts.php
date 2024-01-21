<?php
$conn = new mysqli('localhost', 'root', '', 'handcraft_2');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $deskripsi = $_POST['deskripsi'];
    $query = "UPDATE posts
              SET deskripsi = ?
              WHERE id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $deskripsi, $id);
    $result = $stmt->execute();

    if ($result) {
        echo '<script>alert("Postingan berhasil di update"); 
        window.location.href="/halodek/admin/halaman_utama.php";</script>';
        exit();
    } else {
        echo "Ups, terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Selain method POST tidak diperbolehkan";
}
