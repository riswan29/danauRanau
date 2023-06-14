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

// Mendapatkan semua data wisata dari database
$query = "SELECT * FROM wisata";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Wisata</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
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

#wahanaTable {
            width: 100%;
            border-collapse: collapse;
        }

        #wahanaTable th,
        #wahanaTable td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        #wahanaTable th {
            background-color: #ac86a8;
            text-align: center;
        }

        #wahanaTable td img {
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
</head>
<body>
    <h2>Data Wisata</h2>
    <p>Total data: <?php echo getTotalData(); ?></p>
    <table class='table' id='wahanaTable'>
        <tr>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Kategori</th>
            <th>Gambar</th>
            <th>Gambar2</th>
        </tr>
        <?php
        // Menampilkan data wisata
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['nama_wisata'] . "</td>";
                echo "<td>" . $row['deskripsi'] . "</td>";
                echo "<td>" . $row['kategori'] . "</td>";
                echo "<td><img src='uploads/" . $row['gambar'] . "' width='100' height='100'></td>";
                echo "<td><img src='uploads/" . $row['gambar2'] . "' width='100' height='100'></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data wisata.</td></tr>";
        }
        ?>
    </table>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php
// Menutup koneksi ke database
mysqli_close($conn);
?>
