<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wahana | Wisata Danau Ranau</title>

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
        <!-- Your header content goes here -->
    </section>

    <!-- header section ends -->

    <div class="heading" style="background:url(images/header-bg-2.png) no-repeat">
        <h1>Wahana</h1>
    </div>

    <!-- packages section starts  -->

    <section class="packages">

<h1 class="heading-title">wahana</h1>

<div class="box-container">
    <?php
    // Koneksi ke database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "indah";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk mendapatkan data wahana
    $sql = "SELECT * FROM wisata";
    $result = mysqli_query($conn, $sql);

    // Memeriksa apakah ada data yang ditemukan
    if (mysqli_num_rows($result) > 0) {
        // Menampilkan data wahana
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        for ($i = 0; $i < count($data); $i++) {
            $row = $data[$i];
            $nama_wahana = $row["nama_wisata"];
            // echo $nama_wahana;
            // echo "<br>";
            $deskripsi = $row["deskripsi"];
            $gambar = $row["gambar"];

            echo '<div class="box">';
            echo '<div class="image">';
            echo "<img src='../../admin/wisata/uploads/" . $gambar . "' alt=''>";
            echo '</div>';
            echo '<div class="content">';
            echo '<h3>' . $nama_wahana . '</h3>';
            echo '<p>' . $deskripsi . '</p>';
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
    } else {
        echo mysqli_error($conn);
        echo "Tidak ada data wahana.";
    }

    // Menutup koneksi ke database
    $conn->close();
    ?>
</div>

</section>


    <!-- packages section ends -->

<!-- bot -->
<section>
<img src="images/bot.png" alt="" class="chat-icon" width="50px" height="50px"">
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
<script src="https://un pkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="js/bot.js"></script>

</body>
</html>
