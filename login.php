<?php
require 'connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email)) {
        echo "<script>alert('Coloque seu e-mail!');</script>";
    } elseif (empty($password)) {
        echo "<script>alert('Coloque sua senha.');</script>";
    } else {
        $sql = "SELECT * FROM users WHERE email =? AND password =?";
        $stmt = $conn->prepare($sql);

        $stmt->execute([$email, $password]);

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
            ];

            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('E-mail ou senha inválidos');</script>";
        }
    }
}



?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">


    <style>
        body {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card border-0 p-4" style="min-width: 350px;">
            <h4 class="text-center mb-4">Login</h4>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <button type="submit" class="btn btn-dark w-100">Entrar</button>
            </form>
        </div>
    </div>
</body>

</html>