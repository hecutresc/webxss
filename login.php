<?php
session_start();
include('conn.php');
// Verifica si el formulario de inicio de sesión ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si los campos de usuario y contraseña no están vacíos
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        // Aquí iría tu lógica de autenticación, por ejemplo, verificar en una base de datos
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);

        // Verificación contra la base de datos
        $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password';";
        $resultados = $conn->query($sql);
        if($resultados){
            if ($resultados->num_rows > 0) {
                // Iniciar sesión
                $_SESSION['username'] = mysqli_real_escape_string($conn,$username);
                // Redirigir a la página de inicio o a donde desees después del inicio de sesión
                header("Location: main.php");
                exit;
            } else {
                $error = "Usuario o contraseña incorrectos";
                $incorrect_username = mysqli_real_escape_string($conn,$username);
            }
        }else {
            // Manejar errores en la consulta SQL
            $error1 = "Error en la consulta: " . $conn->error;
            // Registrar el error en el archivo de registro de errores de PHP
            error_log($error1);
            // También puedes imprimir el error en la consola del navegador
            $error = "Ha ocurrido un error al hacer la petición";
        };

        
    } else {
        $error = "Por favor, introduzca un usuario y una contraseña";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="webimages/favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body,
        html {
            min-height: 100vh;
            position: relative;
            /* Establece la posición relativa para poder posicionar el footer correctamente */
        }

        body {
            background-image: url("webimages/fernando-alonso-renault-r25-7.webp");
            background-position-x: center;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            width: 360px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 40px;
            margin-bottom: 200px;
        }

        .login-form h2 {
            margin-bottom: 40px;
            text-align: center;
        }

        .form-control,
        .btn {
            min-height: 48px;
            border-radius: 4px;
        }

        .btn {
            font-size: 25px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: #f5f5f5;
        }

        footer > div {
      margin: 10px auto 10px auto !important;
    }

    </style>
</head>

<body>

    <main class="login-container">
        <div class="login-form">
            <h2>Login</h2>
            <form action="" method="post">
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Usuario" required="required" value="<?php echo isset($incorrect_username) ? $incorrect_username : ''; ?>">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required="required">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                </div>
            </form>
        </div>
                </main>
    <footer class="footer">
        <div class="container">
            <span class="text-muted">© Realizado por Miquel y Héctor</span>
        </div>
    </footer>
</body>

</html>