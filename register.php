
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: url('https://th.bing.com/th/id/OIP.cr3WX_d3qCl6Z01g0u2HjAHaEK?w=296&h=180&c=7&r=0&o=5&pid=1.7') no-repeat center center fixed; 
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            max-width: 500px;
            margin: auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        .register-container h1 {
            margin-bottom: 30px;
        }
        .register-container .btn-primary {
            width: 100%;
        }
        .register-container .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container register-container">
        <h1 class="text-center">Register</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="nameInput">Name</label>
                <input type="text" class="form-control" id="nameInput" name="name" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
                <label for="emailInput">Email</label>
                <input type="email" class="form-control" id="emailInput" name="email" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="passwordInput">Password</label>
                <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Enter Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <?php
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

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $createAt = date('Y-m-d H:i:s');

                $query = "INSERT INTO users (email, full_name, password, role, created_at) VALUES ('$email', '$name', '$password', 'admin', '$createAt')";
                $queryExecute = $conn->query($query);

                if ($queryExecute) {
                    echo "<div class='alert alert-success mt-3' role='alert'>Data inserted successfully</div>";
                } else {
                    echo "<div class='alert alert-danger mt-3' role='alert'>Error: " . $query . "<br>" . $conn->error . "</div>";
                }
            }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-7+Q1a8S3E8E0BvGpPRK4rZpG3RyLHgRSFwbEUBVcAl5JBl+oIYsUynZFiDa3yK3v" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-somethingsomething" crossorigin="anonymous"></script>
</body>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: url('https://th.bing.com/th/id/OIP.cr3WX_d3qCl6Z01g0u2HjAHaEK?w=296&h=180&c=7&r=0&o=5&pid=1.7') no-repeat center center fixed; 
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            max-width: 500px;
            margin: auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        .register-container h1 {
            margin-bottom: 30px;
        }
        .register-container .btn-primary {
            width: 100%;
        }
        .register-container .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container register-container">
        <h1 class="text-center">Register</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="nameInput">Name</label>
                <input type="text" class="form-control" id="nameInput" name="name" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
                <label for="emailInput">Email</label>
                <input type="email" class="form-control" id="emailInput" name="email" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="passwordInput">Password</label>
                <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Enter Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <?php
            ini_set('display_errors', '1');
            ini_set('display_startup_errors', '1');
            error_reporting(E_ALL);

            require_once 'config_db.php';

            $db = new ConfigDB();
            $conn = $db->connect();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $createAt = date('Y-m-d H:i:s');

                $query = "INSERT INTO users (email, full_name, password, role, created_at) VALUES ('$email', '$name', '$password', 'admin', '$createAt')";
                $queryExecute = $conn->query($query);

                if ($queryExecute) {
                    echo "<div class='alert alert-success mt-3' role='alert'>Data inserted successfully</div>";
                } else {
                    echo "<div class='alert alert-danger mt-3' role='alert'>Error: " . $query . "<br>" . $conn->error . "</div>";
                }
            }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-7+Q1a8S3E8E0BvGpPRK4rZpG3RyLHgRSFwbEUBVcAl5JBl+oIYsUynZFiDa3yK3v" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-somethingsomething" crossorigin="anonymous"></script>
</body>

</html>