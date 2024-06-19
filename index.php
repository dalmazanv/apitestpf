<?php
// URL del archivo en Azure Files
$urlArchivoAzure = "https://filestestapi.file.core.windows.net/filesharetestapi/dirapifiles/hola.txt";

// Utiliza file_get_contents para obtener el contenido del archivo
$contenido = file_get_contents($urlArchivoAzure);

// Verifica si se obtuvo algún contenido
if ($contenido !== false) {
    // Muestra el contenido en la página web
    echo nl2br($contenido);
} else {
    echo "No se pudo leer el archivo de Azure Files.";
}
?>
