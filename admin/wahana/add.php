<?php
// Koneksi ke database
require '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_wahana = $_POST["nama_wahana"];
    $deskripsi = $_POST["deskripsi"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    // Mengunggah file gambar
    $targetDir = "uploads/";
    $fileName = uniqid() . '_' . $_FILES["gambar"]["name"];
    $targetFile = $targetDir . basename($fileName);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Periksa apakah file gambar benar atau bukan
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check !== false) {
            echo "File adalah gambar - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }
    }

    // Periksa apakah file sudah ada
    if (file_exists($targetFile)) {
        echo "Maaf, file gambar sudah ada.";
        $uploadOk = 0;
    }

    // Batasi jenis file gambar yang diizinkan
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Periksa ukuran file gambar
    $maxFileSize = 2 * 1024 * 1024; // 2MB
    if ($_FILES["gambar"]["size"] > $maxFileSize) {
        echo "Maaf, ukuran file gambar terlalu besar. Maksimal 2MB.";
        $uploadOk = 0;
    }

    // Jika tidak ada kesalahan, pindahkan file ke folder tujuan
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
            echo "File gambar berhasil diunggah.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file gambar.";
            $uploadOk = 0;
        }
    }

    // Jika gambar berhasil diunggah, masukkan data wahana ke dalam tabel
    if ($uploadOk == 1) {
        // Menghilangkan "uploads/" dari nama file untuk disimpan dalam database
        $gambar = basename($targetFile);

        // Query untuk memasukkan data wahana ke dalam tabel
        $sql = "INSERT INTO wahana (nama_wahana, deskripsi, latitude, longitude, gambar) VALUES ('$nama_wahana', '$deskripsi', '$latitude', '$longitude', '$gambar')";

        if (mysqli_query($conn, $sql)) {
            echo "Data wahana berhasil dimasukkan ke database.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Input Wahana</title>
    <script src="../wisata/ckeditor/ckeditor.js"></script>
</head>
<body>
    <h2>Form Input Wahana</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <label for="nama_wahana">Nama Wahana:</label>
        <input type="text" name="nama_wahana" required><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi" required></textarea><br><br>

        <label for="latitude">Latitude:</label>
        <input type="text" name="latitude" required><br>

        <label for="longitude">Longitude:</label>
        <input type="text" name="longitude" required><br>

        <label for="gambar">Gambar Wahana:</label>
        <input type="file" name="gambar" required><br>

        <input type="submit" name="submit" value="Submit">
    </form>
    <script>
        CKEDITOR.replace('deskripsi');
    </script>
</body>
</html>
