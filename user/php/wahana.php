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

   <a href="index.html" class="logo">Wisata danau ranau.</a>

   <nav class="navbar">
      <a href="index.html">  Beranda</a>
      <a href="#">  tentang</a>
      <a href="wisata.html">  destinasi</a>
      <a href="penginapan.html">  penginapan</a>
      <a href="wahana.html">  wahana</a>
      <a href="index.html#event">  event</a>
   </nav>
   <div id="menu-btn" class="fas fa-bars"></div>

</section>

<!-- header section ends -->

<div class="heading" style="background:url(images/header-bg-2.png) no-repeat">
   <h1>penginapan</h1>
</div>

<!-- packages section starts  -->

<section class="packages">

   <h1 class="heading-title">penginapan</h1>

   <div class="box-container">

<?php
// Koneksi ke database
$host = "localhost"; // Ganti dengan host database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$database = "indah"; // Ganti dengan nama database Anda

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi untuk mendapatkan data penginapan dari database
function getPenginapan() {
    global $conn;
    $query = "SELECT * FROM wahana";
    $result = mysqli_query($conn, $query);
    $penginapan = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $penginapan;
}

// Fungsi untuk menampilkan data penginapan dalam HTML
function showPenginapan($penginapan) {
    echo '<div class="box-container">';
    foreach ($penginapan as $item) {
        echo '<div class="box">';
        echo '<div class="image">';
        echo "<img src='../../admin/wahana/uploads/" . $item['gambar'] . "' alt='' >";
        echo '</div>';
        echo '<div class="content">';
        echo '<h3>' . $item['nama_wahana'] . '</h3>';
        echo '<p>' . $item['deskripsi'] . '</p>';
        echo '<div class="stars">';
        echo '<i class="fas fa-star"></i>';
        echo '</div>';
        echo '<a href="detail_wahana.php?id=' . $item['id'] . '" class="btn">read more</a>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
}

$penginapan = getPenginapan();
showPenginapan($penginapan);

mysqli_close($conn);
?>


</div>

</section>

<!-- packages section ends -->

<!-- footer section starts  -->

<section class="footer">

   <div class="box-container">

      <div class="box">
         <h3>Tentang kami</h3>
         <p>Wisata Danau Ranau adalah destinasi wisata yang indah dengan berbagai wahana menarik dan penginapan yang nyaman.</p>
      </div>

      <div class="box">
         <h3>Kontak</h3>
         <p><i class="fas fa-map-marker-alt"></i> Jl. Danau Ranau, Sumatera Selatan, Indonesia</p>
         <p><i class="fas fa-envelope"></i> info@wisatadanauranau.com</p>
         <p><i class="fas fa-phone"></i> +123-456-7890</p>
      </div>

   </div>

   <div class="credit">Created by <a href="https://yourwebsite.com/">Your Name</a> | All rights reserved.</div>

</section>

<!-- footer section ends -->


<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
