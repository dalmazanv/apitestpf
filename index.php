<?php
// Nombre del archivo que deseas leer
$nombreArchivo = "hola.txt";

// Verifica si el archivo existe y es legible
if (file_exists($nombreArchivo) && is_readable($nombreArchivo)) {
    // Abre el archivo en modo de lectura
    $archivo = fopen($nombreArchivo, "r");

    // Lee el contenido del archivo hasta el final
    $contenido = fread($archivo, filesize($nombreArchivo));

    // Cierra el archivo
    fclose($archivo);

    // Muestra el contenido en la página web
    echo nl2br($contenido);
} else {
    echo "El archivo no existe o no se puede leer.";
}
?>
