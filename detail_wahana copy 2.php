<!DOCTYPE html>
<html>
<head>
    <title>Peta GIS dengan Leaflet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="map"></div>

    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([0, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);

        // Menambahkan ikon kustom untuk markah
        var customIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-violet.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41],
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png'
        });

        // Menambahkan markah untuk lokasi Anda sendiri
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            var marker = L.marker([latitude, longitude], { icon: customIcon }).addTo(map);
            marker.bindPopup('Lokasi Anda').openPopup();

            map.setView([latitude, longitude], 15);
        });

        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'indah';
        $conn = mysqli_connect($host, $username, $password, $database);
        if (!$conn) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM wahana";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $latitude = $row['latitude'];
            $longitude = $row['longitude'];
            $locationName = $row['nama_wahana'];

            echo "var marker = L.marker([$latitude, $longitude]).addTo(map);";
            echo "marker.bindPopup('$locationName');";
        }

        mysqli_close($conn);
        ?>
    </script>
</body>
</html>
