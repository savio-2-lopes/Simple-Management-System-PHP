<?php
require('db.php');
$msg = "";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email      = mysqli_real_escape_string($con, $_POST['email']);
    $password   = mysqli_real_escape_string($con, $_POST['password']);
    $res        = mysqli_query($con, "SELECT * FROM usuarios WHERE email='$email' AND password='$password'");
    $count      = mysqli_num_rows($res);

    if ($count > 0) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['ROLE'] = $row['role'];
        $_SESSION['USER_ID'] = $row['id'];
        $_SESSION['USER_NAME'] = $row['name'];
        header('location:index.php');
        die();
    } else {
        $msg = "Falha no Login";
    }
}
?>

<!doctype html>
<html class="no-js" lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compartible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

    <title>Login / Concessionária</title>

    <link rel="icon" type="image/png" href="public/favicon.png" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body class="bg-success">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-form mt-150" style="border-radius:1rem">
                    <form method="POST">

                        <section class="form-group">
                            <span class="sr-only">Email</span>
                            <label> Email </label>
                            <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Email" required>
                        </section>

                        <section class="form-group">
                            <span class="sr-only">Senha</span>
                            <label>Senha</label>
                            <input type="password" autocomplete="off" name="password" class="form-control" placeholder="Senha" required>
                        </section>

                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" style="border-radius:0.8rem">Entrar</button>
                        <div class="result_msg"><?php echo $msg; ?></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</body>

</html>