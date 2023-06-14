<?php
// Koneksi ke database
require '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_penginapan = $_POST["nama_penginapan"];
    $deskripsi = $_POST["deskripsi"];

    // Mengunggah file gambar pertama
    $targetDir = "uploads/";
    $uploadOk = 1;
    $fileName1 = '';
    $fileName2 = '';

    // Mengunggah gambar pertama
    if (!empty($_FILES['gambar']['name'])) {
        $fileName1 = uniqid() . '_' . $_FILES["gambar"]["name"];
        $targetFile1 = $targetDir . basename($fileName1);
        $imageFileType1 = strtolower(pathinfo($targetFile1, PATHINFO_EXTENSION));

        $check1 = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check1 !== false) {
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }

        if (file_exists($targetFile1)) {
            echo "Maaf, file gambar sudah ada.";
            $uploadOk = 0;
        }

        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType1, $allowedExtensions)) {
            echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
            $uploadOk = 0;
        }

        $maxFileSize = 2 * 1024 * 1024; // 2MB
        if ($_FILES["gambar"]["size"] > $maxFileSize) {
            echo "Maaf, ukuran file gambar terlalu besar. Maksimal 2MB.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile1)) {
                echo "File gambar 1 berhasil diunggah.";
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file gambar 1.";
                $uploadOk = 0;
            }
        }
    }

    // Mengunggah gambar kedua
    if (!empty($_FILES['gambar2']['name'])) {
        $fileName2 = uniqid() . '_' . $_FILES["gambar2"]["name"];
        $targetFile2 = $targetDir . basename($fileName2);
        $imageFileType2 = strtolower(pathinfo($targetFile2, PATHINFO_EXTENSION));

        $check2 = getimagesize($_FILES["gambar2"]["tmp_name"]);
        if ($check2 !== false) {
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }

        if (file_exists($targetFile2)) {
            echo "Maaf, file gambar sudah ada.";
            $uploadOk = 0;
        }

        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType2, $allowedExtensions)) {
            echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
            $uploadOk = 0;
        }

        $maxFileSize = 2 * 1024 * 1024; // 2MB
        if ($_FILES["gambar2"]["size"] > $maxFileSize) {
            echo "Maaf, ukuran file gambar terlalu besar. Maksimal 2MB.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["gambar2"]["tmp_name"], $targetFile2)) {
                echo "File gambar 2 berhasil diunggah.";
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file gambar 2.";
                $uploadOk = 0;
            }
        }
    }

    // Jika tidak ada kesalahan, masukkan data penginapan ke dalam tabel
    if ($uploadOk == 1) {
        // Query untuk memasukkan data penginapan ke dalam tabel
        $sql = "INSERT INTO penginapan (nama_penginapan, deskripsi, gambar, gambar2) VALUES ('$nama_penginapan', '$deskripsi', '$fileName1', '$fileName2')";

        if (mysqli_query($conn, $sql)) {
            echo "Data penginapan berhasil dimasukkan ke database.";
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
    <title>Form Input Penginapan</title>
    
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
    <h2>Form Input Penginapan</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <label for="nama_penginapan">Nama Penginapan:</label>
        <input type="text" name="nama_penginapan" required><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi" required></textarea><br><br>

        <label for="gambar">Gambar Penginapan 1:</label>
        <input type="file" name="gambar"><br>

        <label for="gambar2">Gambar Penginapan 2:</label>
        <input type="file" name="gambar2"><br>

        <input type="submit" name="submit" value="Submit">
    </form>
    <script>
        CKEDITOR.replace('deskripsi');
    </script>
</body>
</html>
