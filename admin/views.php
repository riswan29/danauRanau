<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg bg-body-tertiary bg-gray" data-bs-theme="dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Logo</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="index.php">Tambah Data</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="views.php">Lihat data</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3 box1">
                                <?php
            // Koneksi ke database
            require 'conn.php';

            // Query untuk menghitung jumlah data
            $sql = "SELECT COUNT(*) AS total FROM wisata";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $totalData = $row['total'];

                echo "Total data wisata: " . $totalData;
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            mysqli_close($conn);
            ?>

                    </div>
                    <div class="col-md-3 box1">
                    <?php
            // Koneksi ke database
            require 'conn.php';

            // Query untuk menghitung jumlah data
            $sql = "SELECT COUNT(*) AS total FROM penginapan";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $totalData = $row['total'];

                echo "Total data Penginapan: " . $totalData;
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            mysqli_close($conn);
            ?>
                    </div>
                    <div class="col-md-3 box1">
                    <?php
            // Koneksi ke database
            require 'conn.php';

            // Query untuk menghitung jumlah data
            $sql = "SELECT COUNT(*) AS total FROM wahana";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $totalData = $row['total'];

                echo "Total data wahana: " . $totalData;
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            mysqli_close($conn);
            ?>
                    </div>
                    <div class="col-md-3 box1">
                    <?php
            // Koneksi ke database
            require 'conn.php';

            // Query untuk menghitung jumlah data
            $sql = "SELECT COUNT(*) AS total FROM eventt";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $totalData = $row['total'];

                echo "Total data event: " . $totalData;
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            mysqli_close($conn);
            ?>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-12">
                        <br>
                        <br>
                        <h1>Views Data</h1>
                        <br>
                        <a href="wisata/tampil_wisata.php" class="myButton">Wisata</a>
                        <a href="penginapan/tampil.php" class="myButton">Penginapan</a>
                        <a href="wahana/tampil.php" class="myButton">Wahana</a>
                        <a href="event/tampil.php" class="myButton">Event</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
