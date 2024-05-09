<?php
// Obtenemos la dirección IP del cliente
$ip = $_SERVER['REMOTE_ADDR'];

// Verificamos si se ha pasado el parámetro 'c' por GET
if(isset($_GET['c'])) {
    // Obtenemos el valor del parámetro 'c'
    $valor_c = $_GET['c'];

    // Formateamos el mensaje para el archivo de registro
    $mensaje = "IP: $ip - Valor de 'c': $valor_c - Fecha: " . date('Y-m-d H:i:s') . "\n";

    // Ruta del archivo de registro
    $archivo_log = 'registro.log';

    // Abrimos el archivo en modo de escritura al final del archivo
    if($archivo = fopen($archivo_log, 'a')) {
        // Escribimos el mensaje en el archivo
        fwrite($archivo, $mensaje);
        // Cerramos el archivo
        fclose($archivo);
        echo "Datos registrados correctamente.";
    } else {
        echo "Error al abrir el archivo de registro.";
    }
} else {
    echo "No se ha pasado el parámetro 'c' por GET.";
}


?>
