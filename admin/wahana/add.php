<?php
// Koneksi ke database
require '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_wahana = $_POST["nama_wahana"];
    $deskripsi = $_POST["deskripsi"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    // Mengunggah file gambar pertama
    $targetDir1 = "uploads/";
    $fileName1 = uniqid() . '_' . $_FILES["gambar"]["name"];
    $targetFile1 = $targetDir1 . basename($fileName1);
    $uploadOk1 = 1;
    $imageFileType1 = strtolower(pathinfo($targetFile1, PATHINFO_EXTENSION));

    // Periksa apakah file gambar pertama benar atau bukan
    if (isset($_POST["submit"])) {
        $check1 = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check1 !== false) {
            echo "File 1 adalah gambar - " . $check1["mime"] . ".";
            $uploadOk1 = 1;
        } else {
            echo "File 1 bukan gambar.";
            $uploadOk1 = 0;
        }
    }

    // Periksa apakah file pertama sudah ada
    if (file_exists($targetFile1)) {
        echo "Maaf, file 1 gambar sudah ada.";
        $uploadOk1 = 0;
    }

    // Batasi jenis file gambar pertama yang diizinkan
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType1, $allowedExtensions)) {
        echo "Maaf, hanya file 1 JPG, JPEG, PNG, dan GIF yang diizinkan.";
        $uploadOk1 = 0;
    }

    // Periksa ukuran file gambar pertama
    $maxFileSize = 2 * 1024 * 1024; // 2MB
    if ($_FILES["gambar"]["size"] > $maxFileSize) {
        echo "Maaf, ukuran file 1 gambar terlalu besar. Maksimal 2MB.";
        $uploadOk1 = 0;
    }

    // Jika tidak ada kesalahan, pindahkan file pertama ke folder tujuan
    if ($uploadOk1 == 1) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile1)) {
            echo "File 1 gambar berhasil diunggah.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file 1 gambar.";
            $uploadOk1 = 0;
        }
    }

    // Mengunggah file gambar kedua
    $targetDir2 = "uploads/";
    $fileName2 = uniqid() . '_' . $_FILES["gambar2"]["name"];
    $targetFile2 = $targetDir2 . basename($fileName2);
    $uploadOk2 = 1;
    $imageFileType2 = strtolower(pathinfo($targetFile2, PATHINFO_EXTENSION));

    // Periksa apakah file gambar kedua benar atau bukan
    if (isset($_POST["submit"])) {
        $check2 = getimagesize($_FILES["gambar2"]["tmp_name"]);
        if ($check2 !== false) {
            echo "File 2 adalah gambar - " . $check2["mime"] . ".";
            $uploadOk2 = 1;
        } else {
            echo "File 2 bukan gambar.";
            $uploadOk2 = 0;
        }
    }

    // Periksa apakah file kedua sudah ada
    if (file_exists($targetFile2)) {
        echo "Maaf, file 2 gambar sudah ada.";
        $uploadOk2 = 0;
    }

    // Batasi jenis file gambar kedua yang diizinkan
    if (!in_array($imageFileType2, $allowedExtensions)) {
        echo "Maaf, hanya file 2 JPG, JPEG, PNG, dan GIF yang diizinkan.";
        $uploadOk2 = 0;
    }

    // Periksa ukuran file gambar kedua
    if ($_FILES["gambar2"]["size"] > $maxFileSize) {
        echo "Maaf, ukuran file 2 gambar terlalu besar. Maksimal 2MB.";
        $uploadOk2 = 0;
    }

    // Jika tidak ada kesalahan, pindahkan file kedua ke folder tujuan
    if ($uploadOk2 == 1) {
        if (move_uploaded_file($_FILES["gambar2"]["tmp_name"], $targetFile2)) {
            echo "File 2 gambar berhasil diunggah.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file 2 gambar.";
            $uploadOk2 = 0;
        }
    }

    // Jika kedua gambar berhasil diunggah, masukkan data wahana ke dalam tabel
    if ($uploadOk1 == 1 && $uploadOk2 == 1) {
        // Menghilangkan "uploads/" dari nama file untuk disimpan dalam database
        $gambar = basename($targetFile1);
        $gambar2 = basename($targetFile2);

        // Query untuk memasukkan data wahana ke dalam tabel
        $sql = "INSERT INTO wahana (nama_wahana, deskripsi, latitude, longitude, gambar, gambar2) VALUES ('$nama_wahana', '$deskripsi', '$latitude', '$longitude', '$gambar', '$gambar2')";

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
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
            color :#BF00FF;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color:  #b284be;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            margin-right: 50%;
            font-weight: bold;

        }

        input[type="text"],
        textarea {
            width: 96%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
            float: left;
            /* text-align: left; */
            padding-right: 10px;
        }

        input[type="file"] {
            margin-bottom: 10px;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #BF00FF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #BF00FF;
        }

        .error {
            color: red;
        }

        .success {
            color: purple;
        }
    </style>
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

        <label for="gambar">Gambar Wahana 1:</label>
        <input type="file" name="gambar" required><br>

        <label for="gambar2">Gambar Wahana 2:</label>
        <input type="file" name="gambar2" required><br>

        <input type="submit" name="submit" value="Submit">
    </form>
    <script>
        CKEDITOR.replace('deskripsi');
    </script>
</body>
</html>
