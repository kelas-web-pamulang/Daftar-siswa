<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Data</title>
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

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = $conn->query("SELECT * FROM pendaftaran WHERE id_daftar=$id");
            $data = $result->fetch_assoc();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_siswa = $_POST['nama_siswa'];
            $nis = $_POST['nis'];
            $tanggal_daftar = $_POST['tanggal'];
            $status = $_POST['status'];
            $id_wali = $_POST['id_wali'];

            $data = [
                'nama_siswa' => $nama_siswa,
                'nis' => $nis,
                'tanggal_daftar' => $tanggal_daftar,
                'status' => $status,
                'id_wali' => $id_wali
            ];

            if ($db->update('pendaftaran', $data, $id)) {
                echo "<div class='alert alert-success mt-3' role='alert'>Data updated successfully</div>";
            } else {
                echo "<div class='alert alert-danger mt-3' role='alert'>Error: " . $conn->error . "</div>";
            }
        }
    ?>
    <div class="container">
        <h1 class="text-center mt-5">Update Data Siswa</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="nama">Nama siswa</label>
                <input type="text" class="form-control" id="nama" name="nama_siswa" placeholder="Masukkan Nama" required value="<?php echo $data['nama_siswa']; ?>">
            </div>
            <div class="form-group">
                <label for="jenjang">Jenjang</label>
                <?php
                    $siswa = $conn->query("SELECT nis, jenjang FROM siswa");
                    echo "<select class='form-control' id='jenjang' name='nis' required>";
                    echo "<option value=''>Pilih Jenjang</option>";
                    while ($row = $siswa->fetch_assoc()) {
                        $selected = ($row['nis'] == $data['nis']) ? 'selected' : '';
                        echo "<option value='{$row['nis']}' $selected>{$row['jenjang']}</option>";
                    }
                    echo "</select>";
                ?>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan Tanggal" required value="<?php echo $data['tanggal_daftar']; ?>">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="status" class="form-control" id="status" name="status" placeholder="Masukkan Status" required value="<?php echo $data['status']; ?>">
            </div>
            <div class="form-group">
                <label for="waliwurid">Wali</label>
                <?php
                    $walimurid = $conn->query("SELECT id_wali, nama_wali FROM walimurid");
                    echo "<select class='form-control' id='waliwurid' name='id_wali' required>";
                    echo "<option value=''>Pilih Wali Murid</option>";
                    while ($row = $walimurid->fetch_assoc()) {
                        $selected = ($row['id_wali'] == $data['id_wali']) ? 'selected' : '';
                        echo "<option value='{$row['id_wali']}' $selected>{$row['nama_wali']}</option>";
                    }
                    echo "</select>";
                ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="index.php" class="btn btn-success">Kembali</a>
        </form>
        <?php $conn->close(); ?>
    </div>
</body>
</html>