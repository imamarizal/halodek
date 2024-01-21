<?php include '../koneksi/koneksi.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Postingan Halaman Depan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="bg-wheat-500">
        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 drk:text-white">Edit Postingan</h2>
            <form action="./proses/save_posts.php" method="post">
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="sm:col-span-2">
                        <?php
                        $hasil = mysqli_query($conn, "SELECT * FROM posts");
                        $posts = mysqli_fetch_assoc($hasil);
                        $deskripsi = $posts['deskripsi'];
                        ?>
                        <input type="hidden" name="id" value="<?= $posts['id'] ?>">
                        <textarea name="deskripsi" id="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500" placeholder="Write a product description here..."><?= $deskripsi ?></textarea>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">
                        Update
                    </button>
                    <button type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center drk:border-red-500 drk:text-red-500 drk:hover:text-white drk:hover:bg-red-600 drk:focus:ring-red-900">
                        Kembali
                    </button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>