<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Penginapan | Wisata Danau Ranau</title>

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
    $query = "SELECT * FROM penginapan";
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
        echo "<img src='../../admin/penginapan/uploads/" . $item['gambar'] . "' alt='' >";
        echo '</div>';
        echo '<div class="content">';
        echo '<h3>' . $item['nama_penginapan'] . '</h3>';
        echo '<p>' . $item['deskripsi'] . '</p>';
        echo '<div class="stars">';
        echo '<i class="fas fa-star"></i>';
        echo '</div>';
        echo '<a href="detail_penginapan.php?id=' . $item['id'] . '" class="btn">read more</a>';
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
