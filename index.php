<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script>
        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = 'index.php?delete=' + id;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5">List Siswa</h1>
        <div class="row">
            <div class="d-flex justify-content-between">
                <form action="" method="get" class="d-flex align-items-center">
                    <input class="form-control" placeholder="Cari Data" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"/>
                    <select name="search_by" class="form-select">
                        <option value="">Cari Berdasarkan</option>
                        <option value="nama_siswa" <?php echo (isset($_GET['search_by']) && $_GET['search_by'] == 'nama_siswa') ? 'selected' : ''; ?>>Nama Siswa</option>
                        <option value="jenjang" <?php echo (isset($_GET['search_by']) && $_GET['search_by'] == 'jenjang') ? 'selected' : ''; ?>>Tingkat</option>
                    </select>
                    <button type="submit" class="btn btn-success mx-2">Cari</button>
                </form>
                <a href="insert.php" class="ml-auto mb-2"><button class="btn btn-success">Tambah Data</button></a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Tingkat</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>Nama Wali</th>
                    <th>Tanggal Tambah</th>
                    <th colspan="2">Pilihan</th>
                </tr>
                </thead>
                <tbody>
                <?php
                ini_set('display_errors', '1');
                ini_set('display_startup_errors', '1');
                error_reporting(E_ALL);

                require_once 'config_db.php';

                $db = new ConfigDB();
                $conn = $db->connect();

                $whereClause = "WHERE p.tanggal_hapus IS NULL";
                if (isset($_GET['search']) && !empty($_GET['search']) && isset($_GET['search_by']) && !empty($_GET['search_by'])) {
                    $search = $conn->real_escape_string($_GET['search']);
                    $search_by = $conn->real_escape_string($_GET['search_by']);
                    $whereClause .= " AND $search_by LIKE '%$search%'";
                }

                if (isset($_GET['delete'])) {
                    $id_to_delete = $conn->real_escape_string($_GET['delete']);
                    $deleteQuery = "UPDATE pendaftaran SET tanggal_hapus = NOW() WHERE id_daftar = '$id_to_delete'";
                    $conn->query($deleteQuery);
                }

                $query = "
                    SELECT p.id_daftar, p.nama_siswa, s.jenjang, p.tanggal_daftar, p.status, w.nama_wali, p.tanggal_tambah
                    FROM pendaftaran p 
                    LEFT JOIN siswa s ON p.nis = s.nis
                    LEFT JOIN walimurid w ON p.id_wali = w.id_wali
                    $whereClause";

                $result = $conn->query($query);
                $totalRows = $result->num_rows;

                if ($totalRows > 0) {
                    foreach ($result as $key => $row) {
                        echo "<tr>";
                        echo "<td>".($key + 1)."</td>";
                        echo "<td>".$row['nama_siswa']."</td>";
                        echo "<td>".$row['jenjang']."</td>";
                        echo "<td>".$row['tanggal_daftar']."</td>";
                        echo "<td>".$row['status']."</td>";
                        echo "<td>".$row['nama_wali']."</td>";
                        echo "<td>".$row['tanggal_tambah']."</td>";
                        echo "<td><a class='btn btn-sm btn-info' href='update.php?id={$row['id_daftar']}'>Update</a></td>";
                        echo "<td><button class='btn btn-sm btn-danger' onclick='confirmDelete({$row['id_daftar']})'>Delete</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No Data</td></tr>";
                }

                $conn->close();
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>