<?php
// Koneksi ke database
require '../conn.php';
// Mendapatkan data barang berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data barang berdasarkan ID
    $sql = "SELECT * FROM wahana WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

// Memperbarui data barang jika ada request update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_wahana = $_POST['nama_wahana'];
    $deskripsi = $_POST['deskripsi'];

    // Proses upload gambar jika ada file yang diunggah
    $gambar = $row['gambar'];
    if ($_FILES['gambar']['tmp_name']) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        $gambar = $target_file;

        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
    }

    // Query untuk memperbarui data barang berdasarkan ID
    $sql_update = "UPDATE wahana SET nama_wahana = '$nama_wahana', deskripsi = '$deskripsi', gambar = '$gambar' WHERE id = $id";

    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Data barang dengan ID $id berhasil diperbarui.');</script>";
        echo "<script>window.location.href = 'tampil.php';</script>";
    } else {
        echo "Error: " . $sql_update . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Input Wahana</title>
    <script src="../wisata/ckeditor/ckeditor.js"></script>
</head>
<body>
<h2>Edit Data Barang</h2>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label for="nama_wahana">Nama Wahana:</label>
    <input type="text" name="nama_wahana" value="<?php echo $row['nama_wahana']; ?>"><br>

    <label for="deskripsi">Deskripsi:</label>
    <textarea name="deskripsi" id="deskripsi" required><?php echo $row['deskripsi']; ?></textarea><br><br>

    <label for="gambar">Gambar Wahana:</label>
    <input type="file" name="gambar"><br>

    <input type="submit" name="update" value="Update">
</form>
<script>
        CKEDITOR.replace('deskripsi');
    </script>
</body>
</html>
