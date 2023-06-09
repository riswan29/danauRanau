<?php
// Koneksi ke database
require '../conn.php';

// Mendapatkan data penginapan berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data penginapan berdasarkan ID
    $sql = "SELECT * FROM penginapan WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

// Memperbarui data penginapan jika ada request update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_penginapan = $_POST['nama_penginapan'];
    $deskripsi = $_POST['deskripsi'];

    // Proses upload gambar pertama jika ada file yang diunggah
    $gambar = $row['gambar'];
    if ($_FILES['gambar1']['tmp_name']) {
        $targetDir = "uploads/";
        $fileName = uniqid() . '_' . $_FILES["gambar1"]["name"];
        $targetFile = $targetDir . basename($fileName);
        move_uploaded_file($_FILES["gambar1"]["tmp_name"], $targetFile);
        $gambar = $fileName;
    }

    // Proses upload gambar kedua jika ada file yang diunggah
    $gambar2 = $row['gambar2'];
    if ($_FILES['gambar2']['tmp_name']) {
        $targetDir = "uploads/";
        $fileName = uniqid() . '_' . $_FILES["gambar2"]["name"];
        $targetFile = $targetDir . basename($fileName);
        move_uploaded_file($_FILES["gambar2"]["tmp_name"], $targetFile);
        $gambar2 = $fileName;
    }

    // Query untuk memperbarui data penginapan berdasarkan ID
    $sql_update = "UPDATE penginapan SET nama_penginapan = '$nama_penginapan', deskripsi = '$deskripsi', gambar = '$gambar', gambar2 = '$gambar2' WHERE id = $id";

    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Data penginapan dengan ID $id berhasil diperbarui.');</script>";
        echo "<script>window.location.href = 'tampil.php';</script>";
    } else {
        echo "Error: " . $sql_update . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<script src="../wisata/ckeditor/ckeditor.js"></script>

<h2>Edit Data Penginapan</h2>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <label for="nama_penginapan">Nama Penginapan:</label>
    <input type="text" name="nama_penginapan" value="<?php echo $row['nama_penginapan']; ?>"><br>

    <label for="deskripsi">Deskripsi:</label>
    <textarea name="deskripsi" id="deskripsi" required><?php echo $row['deskripsi']; ?></textarea><br><br>

    <label for="gambar1">Gambar Pertama:</label>
    <input type="file" name="gambar1"><br>

    <label for="gambar2">Gambar Kedua:</label>
    <input type="file" name="gambar2"><br>

    <input type="submit" name="update" value="Update">
</form>

<script>
    CKEDITOR.replace('deskripsi');
</script>
