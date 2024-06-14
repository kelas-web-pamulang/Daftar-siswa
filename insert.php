<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php
        date_default_timezone_set('Asia/Jakarta');
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
        require 'vendor/autoload.php';

        \Sentry\init([
            'dsn' => 'https://1e4fcb86d5f59b0483988c408869dece@o4507427977297920.ingest.us.sentry.io/4507427981295616',
            // Specify a fixed sample rate
            'traces_sample_rate' => 1.0,
            // Set a sampling rate for profiling - this is relative to traces_sample_rate
            'profiles_sample_rate' => 1.0,
          ]);
        require_once 'config_db.php';

        $db = new ConfigDB();
        $conn = $db->connect();
    ?>
    <div class="container">
        <h1 class="text-center mt-5">Daftar Siswa</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="nama">Nama siswa</label>
                <input type="text" class="form-control" id="nama" name="nama_siswa" placeholder="Masukkan Nama" required>
            </div>
            <div class="form-group">
                <label for="jenjang">Jenjang</label>
                <?php
                    $siswa = $conn->query("SELECT nis, jenjang FROM siswa");
                    echo "<select class='form-control' id='jenjang' name='nis' required>";
                    echo "<option value=''>Pilih Jenjang</option>";
                    while ($row = $siswa->fetch_assoc()) {
                        echo "<option value='{$row['nis']}'>{$row['jenjang']}</option>";
                    }
                    echo "</select>";
                ?>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan Tanggal" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" name="status" placeholder="Masukkan Status" required>
            </div>
            <div class="form-group">
                <label for="walimurid">Wali</label>
                <?php
                    $walimurid = $conn->query("SELECT id_wali, nama_wali FROM walimurid");
                    echo "<select class='form-control' id='walimurid' name='id_wali' required>";
                    echo "<option value=''>Pilih Wali Murid</option>";
                    while ($row = $walimurid->fetch_assoc()) {
                        echo "<option value='{$row['id_wali']}'>{$row['nama_wali']}</option>";
                    }
                    echo "</select>";
                ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="index.php" class="btn btn-success">Kembali</a>
        </form>

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nama = $_POST['nama_siswa'];
                $nis = $_POST['nis'];
                $tanggal = $_POST['tanggal'];
                $status = $_POST['status'];
                $wali = $_POST['id_wali'];
                $tanggal_tambah_data = date('Y-m-d H:i:s');

                $query = "INSERT INTO pendaftaran (nama_siswa, nis, tanggal_daftar, status, id_wali, tanggal_tambah)
                         VALUES ('$nama', '$nis', '$tanggal', '$status', '$wali', '$tanggal_tambah_data')";

                if ($conn->query($query) === TRUE) {
                    echo "<div class='alert alert-success mt-3' role='alert'>Pendaftaran berhasil</div>";
                } else {
                    echo "<div class='alert alert-danger mt-3' role='alert'>Error: " . $query . "<br>" . $conn->error . "</div>";
                }
            }
            $conn->close();
        ?>
    </div>
</body>
</html>