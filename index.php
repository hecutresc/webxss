<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="webimages/favicon.jpg" type="image/x-icon">
  <title>Nano Esquizo</title>
  <!-- Agrega los enlaces a Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Personaliza el estilo según sea necesario */
    body {
      padding-top: 50px; /* Ajusta el espacio para el botón */
      min-height: 100vh;
      position: relative; /* Establece la posición relativa para poder posicionar el footer correctamente */
      background-image: url("webimages/ddeppdbz06w41.png");
      background-position-x: center;
    }

    h1{
      color: #0d6efd;
      text-shadow: 1px 1px white;
    }

    body > div:nth-of-type(1) > p {
      color: #0d6efd;
      text-decoration-color: black;
    }

    .container {
      text-align: center;
      margin-bottom: 60px; /* Agrega un margen inferior para dejar espacio para el footer */
    }
    .btn-login {
      position: absolute;
      top: 10px;
      right: 10px;
    }

    .footer {
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
  <div class="container">
    <h1>Bienvenido</h1>
    <p>¡Gracias por visitar nuestra página!</p>
    <a href="login.php" class="btn btn-primary btn-login">Login</a>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <span class="text-muted">© Realizado por Miquel y Héctor</span>
    </div>
  </footer>

  <!-- Scripts de Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
