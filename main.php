<?php
session_start();
include('conn.php');
if (!isset($_SESSION['username'])) {
    // Redirigir al usuario al login.php si no tiene una sesión abierta
    header("Location: login.php");
    exit;
}

//Función para recoger todos los posts
function todoslosposts($conn)
{
    $sql = "SELECT * FROM posts order by id desc";
    $rs = $conn->query($sql);
    if ($rs) {
        if ($rs->num_rows > 0) {
            $posts = array();
            // Recorre los resultados y los almacena en un array
            while ($row = $rs->fetch_assoc()) {
                $posts[] = $row;
            }
            return $posts;
        } else {
            $error = "Error en la consulta principal.";
        }
    } else {
        // Manejar errores en la consulta SQL
        $error1 = "Error en la consulta en main: " . $conn->error;
        // Registrar el error en el archivo de registro de errores de PHP
        error_log($error1);
        // También puedes imprimir el error en la consola del navegador
        $error = "Ha ocurrido un error al hacer la petición";
    };
};

// Verificar si se ha enviado una búsqueda
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['buscar'])) {
    // Obtener el término de búsqueda
    $termino_busqueda = $_GET['buscar'];

    // Guardar el término de búsqueda en la sesión
    $_SESSION['termino_busqueda'] = $termino_busqueda;
} else {
    // Obtener el término de búsqueda de la sesión (si existe)
    $termino_busqueda = isset($_SESSION['termino_busqueda']) ? $_SESSION['termino_busqueda'] : '';
}

// Obtener los posts según el término de búsqueda
if (!empty($termino_busqueda)) {

    // Realizar la búsqueda en la base de datos (simulada)
    $resultados = array_filter(todoslosposts($conn), function ($post) use ($termino_busqueda) {
        return strpos(strtolower($post['titulo']), strtolower($termino_busqueda)) !== false ||
            strpos(strtolower($post['contenido']), strtolower($termino_busqueda)) !== false;
    });
} else {
    // Obtener todos los posts si no hay término de búsqueda
    $resultados = todoslosposts($conn);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="webimages/favicon.jpg" type="image/x-icon">
    <title>Nano Esquizo</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        #navbar {
            background-color: #333;
            color: #fff;
            overflow: hidden;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #navbar img {
            height: 30px;
            margin-right: 20px;
        }

        #search-bar {
            flex-grow: 1;
            margin: 0 20px;
        }

        #search-bar input[type="text"] {
            width: 100%;
            padding: 8px;
            border: none;
            border-radius: 4px;
        }

        #logout-link {
            display: flex;
            align-items: center;
        }

        #logout-link img {
            height: 30px;
            margin-left: 20px;
        }

        #posts {
            margin: 20px;
            text-align: center;
        }

        .post {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div id="navbar">
        <div>
            <a href="ver_usuario.php">
                <img src="icons/person_FILL0_wght400_GRAD0_opsz24.png" alt="Usuario">
            </a>
        </div>
        <div id="search-bar">
            <form action="" method="get">
                <input type="text" name="buscar" placeholder="Buscar posts..." value="<?php echo $termino_busqueda; ?>">
            </form>
        </div>
        <div id="logout-link">
            <a href="logout.php">
                <img src="icons/logout_FILL0_wght400_GRAD0_opsz24.png" alt="Cerrar sesión">
            </a>
        </div>
    </div>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <div id="posts">
        <?php if (!empty($resultados)) : ?>
            <?php foreach ($resultados as $post) : ?>
                <div class="post" id="<?php $post['id'] ?>">
                    <h3><?php echo $post['titulo']; ?></h3>
                    <p><?php echo $post['contenido']; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No se encontraron resultados para <?php echo $termino_busqueda ?></p>
        <?php endif; ?>
    </div>

</body>

</html>