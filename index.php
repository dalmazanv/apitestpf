<?php
// Ruta al archivo en Azure Files
$archivo = '\\filestestapi.file.core.windows.net/filesharetestapi\hola.txt';

// Verifica si el archivo existe
if (file_exists($archivo)) {
    // Abre el archivo en modo de lectura
    $fp = fopen($archivo, "r");

    // Lee y muestra el contenido del archivo
    if ($fp) {
        while (($linea = fgets($fp)) !== false) {
            echo htmlspecialchars($linea) . "<br>";
        }

        // Cierra el archivo
        fclose($fp);
    } else {
        echo "Error al abrir el archivo.";
    }
} else {
    echo "El archivo no existe.";
}
?>
