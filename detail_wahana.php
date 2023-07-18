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
    $query = "SELECT * FROM wahana WHERE id = $id";
    $result = mysqli_query($conn, $query);

    // Memeriksa apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nama_wahana = $row['nama_wahana'];
        $gambar = $row['gambar'];
        $gambr2 = $row['gambar2'];
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
    <title>Wisata Danau Ranau</title>

    <!-- swiper css link -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bot.css">
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>

<body>

    <!-- header section starts -->
    <section class="header">
        <a href="index.php" class="logo" id="#">Wisata Danau Ranau.</a>

        <nav class="navbar">
            <a href="index.php">Beranda</a>
            <a href="wisata.php">Wisata</a>
            <a href="penginapan.php">Penginapan</a>
            <a href="wahana.php">Wahana</a>
            <a href="index.php#event">Event</a>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>
    </section>
    <!-- header section ends -->

    <?php if (isset($row)): ?>
        <section class="home">
            <div class="swiper home-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide slide" style="background:url(admin/wahana/uploads/<?php echo $gambr2; ?>) no-repeat">
                        <!-- <div class="content">
                            <span>Selamat datang di</span>
                            <h3>Wisata Danau Ranau</h3>
                            <a href="wisata.php" class="btn">Explore</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>

        <section class="home-packages">
            <h1 class="heading-title" id="destinasi"><?php echo $nama_wahana; ?></h1>
        </section>

        <section class="home-about">
            <div class="image">
                <img src="admin/wahana/uploads/<?php echo $gambar; ?>" alt="Destination Image">
            </div>
            <div class="content">
                <h3>Deskripsi</h3>
                <p><?php echo $deskripsi; ?></p>
                <a href="https://wa.me/6281373610139?text=Halo admin, saya mau pesan" class="btn">Pesan</a>
            </div>
        </section>

        <div id="map" style="height: 300px;"></div>

        <!-- bot -->
        <section>
            <img src="images/bot.png" alt="" class="chat-icon" width="50px" height="50px">
            <div class="chat-popup">
                <form class="chat-form" onsubmit="return submitForm(event)">
                    <input type="text" id="chat-input" placeholder="Tulis pesan Anda di sini...">
                    <button type="submit">Kirim</button>
                </form>
                <div id="chat-response"></div>
            </div>
        </section>
        <!-- bot -->

    <?php endif; ?>

    <!-- footer section starts -->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>Quick Links</h3>
                <a href="#"><i class="fas fa-angle-right"></i> Beranda</a>
                <a href="#"><i class="fas fa-angle-right"></i> Destinasi</a>
                <a href="#"><i class="fas fa-angle-right"></i> Penginapan</a>
                <a href="#"><i class="fas fa-angle-right"></i> Wahana</a>
                <a href="#"><i class="fas fa-angle-right"></i> Event</a>
            </div>

            <div class="box">
                <h3>Contact Info</h3>
                <a href="#"><i class="fas fa-phone"></i> +62 823-9282-3072</a>
                <a href="#"><i class="fas fa-phone"></i> +62 823-9282-3072</a>
                <a href="#"><i class="fas fa-envelope"></i> Indahhusnul9@gmail.com</a>
                <a href="#"><i class="fas fa-map"></i> Danau Ranau, Sumatera Selatan</a>
            </div>

            <div class="box">
                <h3>Follow Us</h3>
                <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="#"><i class="fab fa-linkedin"></i> LinkedIn</a>
            </div>
        </div>

        <div class="credit">Created by <span>Indah Husnul Khotimah</span> | All rights reserved!</div>
    </section>
    <!-- footer section ends -->

    <!-- swiper js link -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <!-- custom js file link -->
    <script src="js/script.js"></script>
    <script src="js/bot.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <!-- ... -->
<script>
    var map = L.map('map').setView([0, 0], 2);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">Google Maps API</a> contributors',
        maxZoom: 18,
    }).addTo(map);

    <?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'indah';
    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    if (isset($row)) {
        $latitude = $row['latitude'];
        $longitude = $row['longitude'];
        $locationName = $row['nama_wahana'];

        echo "var marker = L.marker([$latitude, $longitude]).addTo(map);";
        echo "marker.bindPopup('<a href=\"https://www.google.com/maps/search/?api=1&query=$latitude,$longitude\" target=\"_blank\">$locationName</a>');";

        echo "marker.on('click', function() {";
        echo "    window.open('https://www.google.com/maps/search/?api=1&query=$latitude,$longitude', '_blank');";
        echo "});";

        echo "map.setView([$latitude, $longitude], 15);";
    }

    mysqli_close($conn);
    ?>

    function submitForm(event) {
        event.preventDefault();
        var input = document.getElementById("chat-input");
        var responseContainer = document.getElementById("chat-response");

        var message = input.value;
        input.value = "";

        var messageElement = document.createElement("div");
        messageElement.className = "message sent";
        messageElement.textContent = message;

        responseContainer.appendChild(messageElement);

        setTimeout(function () {
            var replyElement = document.createElement("div");
            replyElement.className = "message reply";
            replyElement.textContent = "I'm sorry, I am an AI language model and can't perform any booking actions. For further assistance, please contact our customer support.";
            responseContainer.appendChild(replyElement);
        }, 1000);
    }
</script>
<!-- ... -->


</body>

</html>
