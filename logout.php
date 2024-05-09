<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Finalizar la sesión
session_unset();
session_destroy();

// Redirigir al index.php
header("Location: index.php");
exit;
?>
