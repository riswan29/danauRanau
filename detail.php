<?php
// Koneksi ke database (ganti dengan informasi koneksi sesuai dengan database Anda)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'indah';

$conn = mysqli_connect($host, $username, $password, $database);


// Memeriksa apakah parameter ID ada dalam URL
if (isset($_GET['id'])) {
    // Mendapatkan ID dari parameter URL
    $id = $_GET['id'];

    // Mengambil data wisata berdasarkan ID
    $query = "SELECT * FROM wisata WHERE id = $id";
    $result = mysqli_query($conn, $query);

    // Memeriksa apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nama_wisata = $row['nama_wisata'];
        $gambar = $row['gambar'];
        $deskripsi = $row['deskripsi'];
    } else {
        echo "Data wisata tidak ditemukan.";
    }
} else {
    echo "Parameter ID tidak ditemukan dalam URL.";
}

// Tutup koneksi database
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Wisata</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bot.css">

</head>

<body>

    <!-- header section starts  -->

    <section class="header">

        <a href="index.php" class="logo" id="#">Wisata Danau Ranau.</a>

        <nav class="navbar">
            <a href="index.php">Beranda</a>
            <a href="#">Tentang</a>
            <a href="wisata.php">Wisata</a>
            <a href="penginapan.php">Penginapan</a>
            <a href="wahana.php">Wahana</a>
            <a href="index.php#event">Event</a>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </section>

    <!-- header section ends -->

    <!-- destination detail section starts  -->

    <section class="destination-detail">
        <div class="container">
            <?php if (isset($row)): ?>
                <div class="destination">
                    <div class="image">
                        <img src="admin/wisata/uploads/<?php echo $gambar; ?>" alt="Destination Image">
                    </div>
                    <div class="home-packages">
                    <h1 class="heading-title" id="destinasi"><?php echo $nama_wisata; ?></h1>
                        <p><?php echo $deskripsi; ?></p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- destination detail section ends  -->

    <!-- footer section starts  -->

    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>quick links</h3>
                <a href="#"><i class="fas fa-angle-right"></i> Beranda</a>
                <a href="#"><i class="fas fa-angle-right"></i> Tentang</a>
                <a href="#"><i class="fas fa-angle-right"></i> Destinasi</a>
                <a href="#"><i class="fas fa-angle-right"></i> Penginapan</a>
                <a href="#"><i class="fas fa-angle-right"></i> Wahana</a>
                <a href="#"><i class="fas fa-angle-right"></i> Event</a>
            </div>
            <div class="box">
                <h3>contact info</h3>
                <a href="#"><i class="fas fa-phone"></i> +62 823-9282-3072</a>
                <a href="#"><i class="fas fa-phone"></i> +62 823-9282-3072</a>
                <a href="#"><i class="fas fa-envelope"></i> Indahhusnul9@gmail.com</a>
                <a href="#"><i class="fas fa-map"></i> Danau Ranau, Sumatera Selatan</a>
            </div>
            <div class="box">
                <h3>follow us</h3>
                <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="#"><i class="fab fa-linkedin"></i> Linkedin</a>
            </div>
        </div>
        <div class="credit">created by <span>indah husnul khotimah</span> | all rights reserved!</div>
    </section>

    <!-- footer section ends -->

    <!-- custom js file link  -->
    <script src="js/script.js"></script>
    <script src="js/bot.js"></script>

</body>

</html>
