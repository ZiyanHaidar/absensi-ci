<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table id="absenTable">
        <thead>

            <tr>
                <th>ID</th>
                <th>ID Karyawan</th>
                <th>Kegiatan</th>
                <th>Date</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Status</th>
                <th>Aksi</th> <!-- Kolom untuk tombol Ubah, Pulang, Hapus -->
            </tr>
        </thead>
        <tbody>
            <!-- Data absensi akan ditambahkan di sini menggunakan JavaScript -->
        </tbody>
    </table>
    <script>
    // Tambahkan fungsi untuk menambahkan tombol aksi di baris tabel history absen
    function addActionButtons(row) {
        var actions = document.createElement("td");

        var editButton = document.createElement("button");
        editButton.textContent = "Ubah";
        editButton.addEventListener("click", function() {
            // Logika untuk mengubah absensi
        });

        var pulangButton = document.createElement("button");
        pulangButton.textContent = "Pulang";
        pulangButton.addEventListener("click", function() {
            // Logika untuk menambahkan jam pulang
        });

        var deleteButton = document.createElement("button");
        deleteButton.textContent = "Hapus";
        deleteButton.addEventListener("click", function() {
            // Logika untuk menghapus absensi
        });

        actions.appendChild(editButton);
        actions.appendChild(pulangButton);
        actions.appendChild(deleteButton);

        row.appendChild(actions);
    }

    // Di dalam fungsi updateAbsenTable(), setelah mengisi data absen, tambahkan tombol aksi
    function updateAbsenTable() {
        // ...
        absenData.forEach(function(record) {
            // ...
            addActionButtons(row);
        });
    }
    </script>
</body>

</html>