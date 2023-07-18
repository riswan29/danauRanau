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
    <style>
        .filter-buttons {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.filter-btn {
    padding: 8px 16px;
    margin: 0 4px;
    border: none;
    border-radius: 4px;
    background-color: #f1f1f1;
    font-size: 14px;
    font-weight: 500;
    color: #333;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.filter-btn.active {
    background-color: #333;
    color: #fff;
}
    </style>

</head>

<body>

    <!-- header section starts  -->

    <section class="header">

<a href="index.php" class="logo">Wisata danau ranau.</a>

<nav class="navbar">
   <a href="index.php">  Beranda</a>
   <a href="wisata.php">  Wisata</a>
   <a href="penginapan.php">  penginapan</a>
   <a href="wahana.php">  wahana</a>
   <a href="index.php#event">  event</a>
</nav>
<div id="menu-btn" class="fas fa-bars"></div>

</section>

    <!-- header section ends -->

    <div class="heading" style="background:url(images/header-bg-2.png) no-repeat">
        <h1>Wisata</h1>
    </div>

    <!-- packages section starts  -->

<div class="filter-buttons">
    <button class="filter-btn active" data-category="all">Semua</button>
    <?php
    $categories = ['Wisata Alam', 'Wisata Budaya dan Agama', 'Wisata Kuliner'];
    // Menampilkan filter buttons berdasarkan kategori yang diambil dari database
    foreach ($categories as $category) {
        echo '<button class="filter-btn" data-category="' . $category . '">' . $category . '</button>';
    }
    ?>
</div>

    <section class="packages">

<h1 class="heading-title">Wisata</h1>

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
    // Query untuk mendapatkan data wahana
$sql = "SELECT * FROM wisata";
$result = mysqli_query($conn, $sql);

// Memeriksa apakah ada data yang ditemukan
if (mysqli_num_rows($result) > 0) {
    // Menampilkan data wahana
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Membuat array untuk menyimpan kategori unik
    $categories = array();

    for ($i = 0; $i < count($data); $i++) {
        $row = $data[$i];
        $nama_wisata = $row["nama_wisata"];
        $deskripsi = $row["deskripsi"];
        $gambar = $row["gambar"];
        $kategori = $row["kategori"];

        // Menambahkan kategori ke array jika belum ada
        if (!in_array($kategori, $categories)) {
            $categories[] = $kategori;
        }

        echo '<div class="box" data-category="' . $kategori . '">';
        echo '<div class="image">';
        echo "<img src='admin/wisata/uploads/" . $gambar . "' alt=''>";
        echo '</div>';
        echo '<div class="content">';
        echo '<h3>' . $nama_wisata . '</h3>';
        $deskripsi = mb_substr($deskripsi, 0, 50, 'UTF-8');
        $deskripsi = rtrim($deskripsi, "!,.-");
        $deskripsi = substr($deskripsi, 0, strrpos($deskripsi, ' '));
        echo '<p>' . $deskripsi . '...</p>';
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
            <a href="#Wisata"> <i class="fas fa-angle-right"></i> Wisata</a>
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
<script>
    // Fungsi untuk menampilkan wisata berdasarkan kategori yang dipilih
function filterByCategory(category) {
    var boxes = document.getElementsByClassName('box');

    for (var i = 0; i < boxes.length; i++) {
        var box = boxes[i];
        var categoryClass = box.getAttribute('data-category');

        if (category === 'all' || category === categoryClass) {
            box.style.display = 'block';
        } else {
            box.style.display = 'none';
        }
    }
}

// Fungsi untuk mengatur filter yang aktif
function setActiveFilter(filterBtn) {
    var filterBtns = document.getElementsByClassName('filter-btn');

    for (var i = 0; i < filterBtns.length; i++) {
        filterBtns[i].classList.remove('active');
    }

    filterBtn.classList.add('active');
}

// Event listener untuk filter buttons
var filterButtons = document.getElementsByClassName('filter-btn');

for (var i = 0; i < filterButtons.length; i++) {
    filterButtons[i].addEventListener('click', function() {
        var category = this.getAttribute('data-category');
        filterByCategory(category);
        setActiveFilter(this);
    });
}

</script>
</body>
</html>
