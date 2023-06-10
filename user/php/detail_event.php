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
    $query = "SELECT * FROM eventt WHERE id = $id";
    $result = mysqli_query($conn, $query);

    // Memeriksa apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nama_event = $row['nama_event'];
        $gambar = $row['gambar'];
        $gambar2 = $row['gambar2'];
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

    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bot.css">

</head>

<body>

    <!-- header section starts  -->

    <section class="header">

        <a href="index.html" class="logo" id="#">Wisata Danau Ranau.</a>

        <nav class="navbar">
            <a href="index.html"> Beranda</a>
            <a href="tentang.html"> tentang</a>
            <a href="wisata.html"> wisata</a>
            <a href="penginapan.html"> penginapan</a>
            <a href="wahana.html"> wahana</a>
            <a href="index.html#event"> event</a>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </section>

    <?php if (isset($row)): ?>
    <section class="home">

        <div class="swiper home-slider">

            <div class="swiper-wrapper">

            <div class="swiper-slide slide"
                    style="background:url('../../admin/event/uploads/<?php echo $gambar2; ?>') no-repeat">
                </div>
    </section>
    <!-- <div class="heading" style="background:url(images/penginapan/1.Penginapan_Pusri/Penginapan_pusri.jpg) no-repeat"> -->
    <!-- <h1>destinasi</h1> -->
    <!-- </div> -->

    <section class="home-packages">

        <h1 class="heading-title" id="destinasi"> <?php echo $nama_event; ?>
        </h1>
    </section>

    <section class="home-about">

        <div class="image">
            <!-- <img src="images/objekwisata/7.Air_Terjun_Niagara/IMG_0680.jpg" alt=""> -->
            <img src="../../admin/event/uploads/<?php echo $gambar; ?>" alt="Destination Image">
        </div>

        <div class="content">
            <h3>Deskripsi</h3>
            <p><?php echo $deskripsi; ?>
            <a href="https://wa.me/6281373610139?text=Hallo admin,saya mau pesan" class="btn">Pesan</a>

            </p>
        </div>

    </section>
    <?php endif; ?>
    <!-- header section ends -->

    <!-- bot -->
    <section>
        <img src="images/bot.png" alt="" class="chat-icon" width="50px" height="50px">
        <div class="chat-popup">
            <form class="chat-form" onsubmit="return submitForm(event)">
                <input type="text" id="chat-input" placeholder="Tulis pesan anda disini...">
                <button type="submit">Kirim</button>
            </form>
            <div id="chat-response"></div>
        </div>
        <!-- bot -->
    </section>
    <!-- footer section starts  -->
    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>quick links</h3>
                <a href="#"> <i class="fas fa-angle-right"></i> Beranda</a>
                <a href="#about"> <i class="fas fa-angle-right"></i> tentang</a>
                <a href="#destinasi"> <i class="fas fa-angle-right"></i> desitnasi</a>
                <a href="#penginapan"> <i class="fas fa-angle-right"></i> penginapan</a>
                <a href="#wahana"> <i class="fas fa-angle-right"></i> wahana</a>
                <a href="#event"> <i class="fas fa-angle-right"></i> event</a>
            </div>

            <div class="box">
                <h3>contact info</h3>
                <a href="#"> <i class="fas fa-phone"></i> +62 823-9282-3072 </a>
                <a href="#"> <i class="fas fa-phone"></i> +62 823-9282-3072 </a>
                <a href="#"> <i class="fas fa-envelope"></i> Indahhusnul9@gmail.com </a>
                <a href="#"> <i class="fas fa-map"></i> danau ranau, sumatera selatan </a>
            </div>

            <div class="box">
                <h3>follow us</h3>
                <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
                <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
                <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
                <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
            </div>

        </div>

        <div class="credit"> created by <span>indah husnul khotimah</span> | all rights reserved! </div>

    </section>

    <!-- footer section ends -->









    <!-- swiper js link  -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>
    <script src="js/bot.js"></script>

</body>

</html>
