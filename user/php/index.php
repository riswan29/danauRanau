<?php
// Koneksi ke database (ganti dengan informasi koneksi sesuai dengan database Anda)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'indah';

$conn = mysqli_connect($host, $username, $password, $database);


// Fungsi untuk mendapatkan total data wisata dari database
function getTotalData()
{
    global $conn;

    $query = "SELECT COUNT(*) as total FROM wisata";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    return $row['total'];
}

// Mendapatkan 3 data wisata terbaru dari database
$query = "SELECT * FROM wisata ORDER BY id DESC LIMIT 3";
$result = mysqli_query($conn, $query);

$query_wahana = "SELECT * FROM wahana ORDER BY id DESC LIMIT 3";
$result_wahana = mysqli_query($conn, $query_wahana);
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

        <a href="index.php" class="logo" id="#">Wisata Danau Ranau.</a>

        <nav class="navbar">
            <a href="index.php"> Beranda</a>
            <a href="#"> tentang</a>
            <a href="wisata.html"> wisata</a>
            <a href="penginapan.html"> penginapan</a>
            <a href="wahana.html"> wahana</a>
            <a href="index.php#event"> event</a>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </section>

    <!-- header section ends -->

    <!-- home section starts  -->

    <section class="home">

        <div class="swiper home-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide slide" style="background:url(images/backgroun-web.jpg) no-repeat">
                    <div class="content">
                        <span>selamat datang di</span>
                        <h3>wisata danau ranau</h3>
                        <a href="wisata.html" class="btn">explore</a>
                    </div>
                </div>

                <div class="swiper-slide slide"
                    style="background:url(images/objekwisata/1.Danau_Ranau/WhatsApp\ Image\ 2023-02-14\ at\ 09.30.39.jpeg) no-repeat">
                    <div class="content">
                        <span>explore</span>
                        <h3>temukan tempat-tempat baru</h3>
                        <a href="wisata.html" class="btn">explore</a>
                    </div>
                </div>

                <div class="swiper-slide slide"
                    style="background:url(images/objekwisata/2.Gunung_Seminung/PicsArt_02-14-04.33.18.jpg) no-repeat">
                    <div class="content">
                        <span>explore</span>
                        <h3>jadikan tur Anda menjadi luar biasa</h3>
                        <a href="wisata.html" class="btn">explore</a>
                    </div>
                </div>

            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

        </div>

    </section>

    <section class="home-about">

        <div class="image">
            <img src="images/about.jpeg" alt="">
        </div>

        <div class="content">
            <h3>Tentang kami</h3>
            <p>Website kami menyediakan segala informasi yang dibutuhkan untuk perjalanan Anda ke Danau Ranau, termasuk
                rekomendasi hotel, wisata, dan kuliner terbaik di daerah tersebut.</p>
            <a href="#" class="btn">read more</a>
        </div>

    </section>

    <!-- home about section ends -->

    <!-- home packages section starts  -->

    <section class="home-packages">

        <h1 class="heading-title" id="destinasi"> destinasi </h1>

        <div class="box-container">

            <?php
            // Menampilkan data wisata terbaru dari database
            while ($row = mysqli_fetch_assoc($result)) {
                $description = substr($row['deskripsi'], 0, 50) . '...'; // Mengambil 50 karakter pertama dari deskripsi

                echo '<div class="box">';
                echo '<div class="image">';
                echo "<img src='../../admin/wisata/uploads/" . $row['gambar'] . "' alt=''>";
                echo '</div>';
                echo '<div class="content">';
                echo '<h3>' . $row['nama_wisata'] . '</h3>';
                echo '<p>' . $description . '</p>';
                echo '<div class="stars">';
                echo '<i class="fas fa-star"></i>';
                echo '<i class="fas fa-star"></i>';
                echo '<i class="fas fa-star"></i>';
                echo '<i class="fas fa-star"></i>';
                echo '<i class="fas fa-star"></i>';
                echo '</div>';
                echo '<a href="detail2.php?id=' . $row['id'] . '" class="btn">read more</a>';
                echo '</div>';
                echo '</div>';
            }
            ?>

        </div>

        <div class="load-more"> <a href="wisata.php" class="btn">load more</a> </div>

    </section>


    <section class="home-packages">
    <h1 class="heading-title" id="event">Event</h1>
    <div class="box-container">
        <?php
        // Mendapatkan 3 data event terbaru dari database
        $query_event = "SELECT * FROM eventt ORDER BY id DESC LIMIT 3";
        $result_event = mysqli_query($conn, $query_event);

        while ($row_event = mysqli_fetch_assoc($result_event)) {
            $description_event = substr($row_event['deskripsi'], 0, 50) . '...';

            echo '<div class="box">';
            echo '<div class="image">';
            echo "<img src='../../admin/event/uploads/" . $row_event['gambar'] . "' alt=''>";
            echo '</div>';
            echo '<div class="content">';
            echo '<h3>' . $row_event['nama_event'] . '</h3>';
            echo '<p>' . $description_event . '</p>';
            echo '<div class="stars">';
            echo '<i class="fas fa-star"></i>';
            echo '<i class="fas fa-star"></i>';
            echo '<i class="fas fa-star"></i>';
            echo '<i class="fas fa-star"></i>';
            echo '<i class="fas fa-star"></i>';
            echo '</div>';
            echo '<a href="detail_event.php?id=' . $row_event['id'] . '" class="btn">read more</a>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    <div class="load-more">
        <a href="event.html" class="btn">load more</a>
    </div>
</section>
<!-- home packages section starts  -->
<section class="home-packages">
    <h1 class="heading-title" id="destinasi">Penginapan</h1>
    <div class="box-container">
        <?php
        // Mendapatkan 3 data penginapan terbaru dari database
        $query_penginapan = "SELECT * FROM penginapan ORDER BY id DESC LIMIT 3";
        $result_penginapan = mysqli_query($conn, $query_penginapan);

        while ($row_penginapan = mysqli_fetch_assoc($result_penginapan)) {
            $description_penginapan = substr($row_penginapan['deskripsi'], 0, 50) . '...';

            echo '<div class="box">';
            echo '<div class="image">';
            echo "<img src='../../admin/penginapan/uploads/" . $row_penginapan['gambar'] . "' alt=''>";
            echo '</div>';
            echo '<div class="content">';
            echo '<h3>' . $row_penginapan['nama_penginapan'] . '</h3>';
            echo '<p>' . $description_penginapan . '</p>';
            echo '<div class="stars">';
            echo '<i class="fas fa-star"></i>';
            echo '<i class="fas fa-star"></i>';
            echo '<i class="fas fa-star"></i>';
            echo '<i class="fas fa-star"></i>';
            echo '<i class="fas fa-star"></i>';
            echo '</div>';
            echo '<a href="detail_penginapan.php?id=' . $row_penginapan['id'] . '" class="btn">read more</a>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    <div class="load-more">
        <a href="penginapan.html" class="btn">load more</a>
    </div>
</section>

<section class="home-packages">
    <h1 class="heading-title" id="wahana">Wahana</h1>
    <div class="box-container">
        <?php
        // Mendapatkan 3 data wahana terbaru dari database
        while ($row_wahana = mysqli_fetch_assoc($result_wahana)) {
            $description_wahana = substr($row_wahana['deskripsi'], 0, 50) . '...';

            echo '<div class="box">';
            echo '<div class="image">';
            echo "<img src='../../admin/wahana/uploads/" . $row_wahana['gambar'] . "' alt=''>";
            echo '</div>';
            echo '<div class="content">';
            echo '<h3>' . $row_wahana['nama_wahana'] . '</h3>';
            echo '<p>' . $description_wahana . '</p>';
            echo '<div class="stars">';
            echo '<i class="fas fa-star"></i>';
            echo '<i class="fas fa-star"></i>';
            echo '<i class="fas fa-star"></i>';
            echo '<i class="fas fa-star"></i>';
            echo '<i class="fas fa-star"></i>';
            echo '</div>';
            echo '<a href="detail_wahana.php?id=' . $row_wahana['id'] . '" class="btn">read more</a>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    <div class="load-more">
        <a href="wahana.html" class="btn">load more</a>
    </div>
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
