<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
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
        .login-container {
            max-width: 500px;
            margin: auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        .login-container h1 {
            margin-bottom: 30px;
        }
        .login-container .btn-primary {
            width: 100%;
        }
        .login-container .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <h1 class="text-center">Login</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="emailInput">Email</label>
                <input type="email" class="form-control" id="emailInput" name="email" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="passwordInput">Password</label>
                <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Enter Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <?php
            ini_set('display_errors', '1');
            ini_set('display_startup_errors', '1');
            error_reporting(E_ALL);
            require 'vendor/autoload.php';

            \Sentry\init([
                'dsn' => 'https://1e4fcb86d5f59b0483988c408869dece@o4507427977297920.ingest.us.sentry.io/4507427981295616',
                'traces_sample_rate' => 1.0,
                'profiles_sample_rate' => 1.0,
            ]);
            session_start();
            if (isset($_SESSION['login'])) {
                header('Location: index.php');
            }

            require_once 'config_db.php';

            $db = new ConfigDB();
            $conn = $db->connect();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $_POST['email'];
                $password = $_POST['password'];

                $query = "SELECT id, email, full_name, password FROM users WHERE email = '$email'";
                $queryExecute = $conn->query($query);

                if ($queryExecute->num_rows > 0) {
                    $user = $queryExecute->fetch_assoc();
                    $isPasswordMatch = password_verify($password, $user['password']);
                    if ($isPasswordMatch) {
                        setcookie('clientId', $user['id'], time() + 86400, '/');
                        setcookie('clientSecret', hash('sha256', $user['email']), time() + 86400, '/');
                        header('Location: index.php');
                    } else {
                        echo "<div class='alert alert-danger mt-3' role='alert'>User/Password is incorrect</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger mt-3' role='alert'>User/Password is incorrect</div>";
                }
            }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-7+Q1a8S3E8E0BvGpPRK4rZpG3RyLHgRSFwbEUBVcAl5JBl+oIYsUynZFiDa3yK3v" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-somethingsomething" crossorigin="anonymous"></script>
</body>
</html>