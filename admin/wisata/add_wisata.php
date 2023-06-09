<?php
// Koneksi ke database (ganti dengan informasi koneksi sesuai dengan database Anda)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'indah';

$conn = mysqli_connect($host, $username, $password, $database);

// Fungsi untuk menambahkan data wisata ke database
function addWisata($nama_wisata, $deskripsi, $kategori, $gambar1, $gambar2)
{
    global $conn;

    // Mencegah serangan SQL Injection
    $nama_wisata = mysqli_real_escape_string($conn, $nama_wisata);
    $deskripsi = mysqli_real_escape_string($conn, $deskripsi);
    $kategori = mysqli_real_escape_string($conn, $kategori);

    // Mengambil informasi gambar pertama
    $gambar1Name = $_FILES['gambar']['name'];
    $gambar1Tmp = $_FILES['gambar']['tmp_name'];
    $gambar1Size = $_FILES['gambar']['size'];
    $gambar1Error = $_FILES['gambar']['error'];

    // Mengambil informasi gambar kedua
    $gambar2Name = $_FILES['gambar2']['name'];
    $gambar2Tmp = $_FILES['gambar2']['tmp_name'];
    $gambar2Size = $_FILES['gambar2']['size'];
    $gambar2Error = $_FILES['gambar2']['error'];

    // Memeriksa apakah gambar pertama berhasil diunggah
    if ($gambar1Error === 0) {
        // Mengganti nama gambar untuk menghindari nama yang sama
        $gambar1Name = uniqid('', true) . '_' . $gambar1Name;
        // Menentukan folder tujuan penyimpanan gambar pertama
        $gambar1Destination = 'uploads/' . $gambar1Name;

        // Memindahkan gambar pertama yang diunggah ke folder tujuan
        if (move_uploaded_file($gambar1Tmp, $gambar1Destination)) {
            // Memeriksa apakah gambar kedua berhasil diunggah
            if ($gambar2Error === 0) {
                // Mengganti nama gambar untuk menghindari nama yang sama
                $gambar2Name = uniqid('', true) . '_' . $gambar2Name;
                // Menentukan folder tujuan penyimpanan gambar kedua
                $gambar2Destination = 'uploads/' . $gambar2Name;

                // Memindahkan gambar kedua yang diunggah ke folder tujuan
                if (move_uploaded_file($gambar2Tmp, $gambar2Destination)) {
                    // Menyimpan data wisata ke dalam tabel wisata
                    $query = "INSERT INTO wisata (nama_wisata, deskripsi, kategori, gambar, gambar2) VALUES ('$nama_wisata', '$deskripsi', '$kategori', '$gambar1Name', '$gambar2Name')";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        echo 'Data wisata berhasil ditambahkan!';
                    } else {
                        echo 'Terjadi kesalahan saat menambahkan data wisata: ' . mysqli_error($conn);
                    }
                } else {
                    echo 'Terjadi kesalahan saat mengunggah gambar kedua.';
                }
            } else {
                echo 'Terjadi kesalahan saat mengunggah gambar kedua: ' . $gambar2Error;
            }
        } else {
            echo 'Terjadi kesalahan saat mengunggah gambar pertama.';
        }
    } else {
        echo 'Terjadi kesalahan saat mengunggah gambar pertama: ' . $gambar1Error;
    }
}

if (isset($_POST['submit'])) {
    // Memperoleh data dari form
    $namaWisata = $_POST['nama_wisata'];
    $deskripsiWisata = $_POST['deskripsi'];
    $kategoriWisata = $_POST['kategori'];
    $gambarWisata1 = $_FILES['gambar'];
    $gambarWisata2 = $_FILES['gambar2'];

    // Memanggil fungsi addWisata untuk menambahkan data ke database
    addWisata($namaWisata, $deskripsiWisata, $kategoriWisata, $gambarWisata1, $gambarWisata2);
}

// Menutup koneksi ke database
mysqli_close($conn);
?>
