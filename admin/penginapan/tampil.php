<style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
        }

    .search-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
    }

#barangTable {
            width: 100%;
            border-collapse: collapse;
        }

        #barangTable th,
        #barangTable td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        #barangTable th {
            background-color: #ac86a8;
            text-align: center;
        }

        #barangTable td img {
            max-width: 100px;
            height: auto;
        }
        .cc {
            width: 40%;
        }
        .bb {
            width: 10%;
        }

    .search-input {
        padding: 10px;
        margin-right: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        width: 250px;
    }

    .search-input::placeholder {
        color: #999;
    }

    .search-button {
        padding: 10px 20px;
        background-color: #ac86a8;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .search-button:hover {
        background-color: #45a049;
    }

    .edit-button {
        margin-left: 20px;
        padding: 5px 10px;
        background-color: #ac86a8;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    .edit-button:hover {
        background-color: #45a049;
    }

    .delete-button {
        margin-left: 12px;
        padding: 5px 10px;
        background-color: #f44336;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    .delete-button:hover {
        background-color: #d32f2f;
    }


    </style>
    </body>

</html>
<?php
// Koneksi ke database
require '../conn.php';

// Mengecek halaman yang sedang aktif
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Mengatur jumlah data yang ditampilkan per halaman
$limit = 10;

// Menghitung offset data
$offset = ($page - 1) * $limit;

// Menghapus data jika ada request penghapusan
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Query untuk menghapus data barang berdasarkan ID
    $sql_delete = "DELETE FROM penginapan WHERE id = $id";

    if (mysqli_query($conn, $sql_delete)) {
        echo "<script>alert('Data barang dengan ID $id berhasil dihapus.');</script>";
        echo "<script>window.location.href = 'tampil.php';</script>";
    } else {
        echo "Error: " . $sql_delete . "<br>" . mysqli_error($conn);
    }
}

// Mengecek apakah ada pencarian yang dilakukan
if (isset($_GET['search'])) {
    $search = $_GET['search'];

    // Query untuk mengambil data barang berdasarkan pencarian
    $sql = "SELECT * FROM penginapan WHERE nama_penginapan LIKE '%$search%'";
    $searchValue = $search; // Menyimpan nilai pencarian untuk ditampilkan kembali di input
} else {
    // Query untuk mengambil semua data barang dengan pagination
    $sql = "SELECT * FROM penginapan LIMIT $limit OFFSET $offset";
    $searchValue = ""; // Set nilai pencarian ke kosong
}

$result = mysqli_query($conn, $sql);

// Menghitung jumlah total data
$totalData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penginapan WHERE nama_penginapan LIKE '%$searchValue%'"));
// Menghitung jumlah halaman
$totalPages = ceil($totalData / $limit);

// Mengecek apakah ada data yang dihasilkan
if (mysqli_num_rows($result) > 0) {
    if (!isset($_GET['search'])) { // Tampilkan pencarian hanya jika tidak ada pencarian yang dilakukan
        echo "<form action='tampil.php' method='GET'>";
        echo "<div class='search-container'>";
        echo "<input type='text' name='search' value='$searchValue' placeholder='Cari Nama penginapan...' class='search-input'>";
        echo "<input type='submit' value='Cari' class='search-button'>";
        echo "</div>";
        echo "</form>";
    }

    echo "<table id='barangTable' class='table'>";
    echo "<tr>
    <th>No</th>
    <th>Nama Barang</th>
    <th>Deskripsi</th>
    <th>Gambar</th>
    <th>Gambar2</th>
    <th>Aksi</th>
    </tr>";

    // Menampilkan data ke dalam tabel
    $no = ($page - 1) * $limit + 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $no . "</td>";
        echo "<td>" . $row["nama_penginapan"] . "</td>";
        echo "<td>" . $row["deskripsi"] . "</td>";
        echo "<td><img src='uploads/" . $row["gambar"] . "' alt='Gambar 1' width='100'></td>";
        echo "<td><img src='uploads/" . $row["gambar2"] . "' alt='Gambar 2' width='100'></td>";
        echo "<td><button class='edit-button' onclick=\"location.href='edit.php?id=" . $row["id"] . "'\">Edit</button><br><br><button class='delete-button' onclick=\"confirmDelete(" . $row["id"] . ")\">Delete</button></td>";
        echo "</tr>";
        $no++;
    }

    echo "</table>";

    // Membuat navigasi pagination
    if (!isset($_GET['search']) && $totalData > $limit) { // Tampilkan pagination hanya jika tidak ada pencarian yang dilakukan dan jumlah data lebih dari batas per halaman
        echo "<ul class='pagination'>";
        if ($page > 1) {
            echo "<li><a href='tampil.php?page=" . ($page - 1) . "'>&laquo;</a></li>";
        }

        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<li";
            if ($i == $page) {
                echo " class='active'";
            }
            echo "><a href='tampil.php?page=$i'>$i</a></li>";
        }

        if ($page < $totalPages) {
            echo "<li><a href='tampil.php?page=" . ($page + 1) . "'>&raquo;</a></li>";
        }
        echo "</ul>";
    }
} else {
    if (!isset($_GET['search'])) { // Tampilkan pencarian hanya jika tidak ada pencarian yang dilakukan
        echo "<form action='tampil.php' method='GET'>";
        echo "<input type='text' name='search' value='$searchValue' placeholder='Cari Nama Barang...'>";
        echo "<input type='submit' value='Cari'>";
        echo "</form>";
    }
    echo "<p>Data belum ada.</p>";
}

mysqli_close($conn);
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var timer;

        $('input[name="search"]').keyup(function() {
            clearTimeout(timer);

            var searchValue = $(this).val();

            // Delay untuk menunggu pengguna selesai mengetik
            timer = setTimeout(function() {
                // Mengirim permintaan AJAX ke server
                $.ajax({
                    type: 'GET',
                    url: 'tampil.php',
                    data: {
                        search: searchValue
                    },
                    success: function(response) {
                        $('#barangTable').html(response);
                    }
                });
            }, 300);
        });
    });
</script>
