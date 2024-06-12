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
            background: url('https://media.istockphoto.com/id/1328668867/vector/school-building-back-to-school-concept-cute-colorful-vector-illustration-in-flat-style.jpg?s=612x612&w=0&k=20&c=5YZpP41ymMqBn3bui_g8YSEZnPJpJ1f8LumJOO4e0iY=') no-repeat center center fixed; 
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            background-color: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: white;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .btn-primary {
            background: linear-gradient(45deg, #007bff, #00d4ff);
            border: none;
        }
        .btn-secondary {
            background: linear-gradient(45deg, #007bff, #00d4ff);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #0056b3, #009edb);
        }
        .text-center {
            margin-top: 2rem;
        }
        .mt-5 {
            margin-top: 3rem !important;
        }
        .card-header {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: white;
            border-radius: 15px 15px 0 0;
        }
        .alert {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5">Login Page</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="emailInput">Email</label>
                <input type="email" class="form-control" id="emailInput" name="email" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="passwordInput">Password</label>
                <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Enter Password" required>
            </div>
            <button type="submit" class="btn btn-primary mt-5">Login</button>
        </form>
        <?php
            ini_set('display_errors', '1');
            ini_set('display_startup_errors', '1');
            error_reporting(E_ALL);

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
</body>
</html>