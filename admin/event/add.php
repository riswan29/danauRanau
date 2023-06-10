<?php
// Koneksi ke database
require '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_event = $_POST["nama_event"];
    $deskripsi = $_POST["deskripsi"];

    // Mengunggah file gambar pertama
    $targetDir = "uploads/";
    $fileName1 = uniqid() . '_' . $_FILES["gambar"]["name"];
    $targetFile1 = $targetDir . basename($fileName1);
    $uploadOk = 1;
    $imageFileType1 = strtolower(pathinfo($targetFile1, PATHINFO_EXTENSION));

    // Mengunggah file gambar kedua
    $fileName2 = uniqid() . '_' . $_FILES["gambar2"]["name"];
    $targetFile2 = $targetDir . basename($fileName2);
    $uploadOk = 1;
    $imageFileType2 = strtolower(pathinfo($targetFile2, PATHINFO_EXTENSION));

    // Periksa apakah file gambar pertama benar atau bukan
    if (isset($_POST["submit"])) {
        $check1 = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check1 !== false) {
            echo "File pertama adalah gambar - " . $check1["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File pertama bukan gambar.";
            $uploadOk = 0;
        }
    }

    // Periksa apakah file gambar kedua benar atau bukan
    if (isset($_POST["submit"])) {
        $check2 = getimagesize($_FILES["gambar2"]["tmp_name"]);
        if ($check2 !== false) {
            echo "File kedua adalah gambar - " . $check2["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File kedua bukan gambar.";
            $uploadOk = 0;
        }
    }

    // Periksa apakah file pertama sudah ada
    if (file_exists($targetFile1)) {
        echo "Maaf, file gambar pertama sudah ada.";
        $uploadOk = 0;
    }

    // Periksa apakah file kedua sudah ada
    if (file_exists($targetFile2)) {
        echo "Maaf, file gambar kedua sudah ada.";
        $uploadOk = 0;
    }

    // Batasi jenis file gambar yang diizinkan
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType1, $allowedExtensions) || !in_array($imageFileType2, $allowedExtensions)) {
        echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Periksa ukuran file gambar pertama
    $maxFileSize = 2 * 1024 * 1024; // 2MB
    if ($_FILES["gambar"]["size"] > $maxFileSize) {
        echo "Maaf, ukuran file gambar pertama terlalu besar. Maksimal 2MB.";
        $uploadOk = 0;
    }

    // Periksa ukuran file gambar kedua
    if ($_FILES["gambar2"]["size"] > $maxFileSize) {
        echo "Maaf, ukuran file gambar kedua terlalu besar. Maksimal 2MB.";
        $uploadOk = 0;
    }

    // Jika tidak ada kesalahan, pindahkan file ke folder tujuan
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile1) && move_uploaded_file($_FILES["gambar2"]["tmp_name"], $targetFile2)) {
            echo "File gambar berhasil diunggah.";

            // Query untuk memasukkan data event ke dalam tabel
            $sql = "INSERT INTO eventt (nama_event, deskripsi, gambar, gambar2) VALUES ('$nama_event', '$deskripsi', '$fileName1', '$fileName2')";

            if (mysqli_query($conn, $sql)) {
                echo "Data event berhasil dimasukkan ke database.";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file gambar.";
            $uploadOk = 0;
        }
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Input Event</title>
    <script src="../wisata/ckeditor/ckeditor.js"></script>
</head>
<body>
    <h2>Form Input Event</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <label for="nama_event">Nama Event:</label>
        <input type="text" name="nama_event" required><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi" required></textarea><br><br>

        <label for="gambar">Gambar Event 1:</label>
        <input type="file" name="gambar" required><br>

        <label for="gambar2">Gambar Event 2:</label>
        <input type="file" name="gambar2" required><br>

        <input type="submit" name="submit" value="Submit">
    </form>
    <script>
        CKEDITOR.replace('deskripsi');
    </script>
</body>
</html>
