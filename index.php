<?php
// URL del archivo en Azure Files
$url = 'https://filestestapi.file.core.windows.net/filesharetestapi/hola.txt';

// Inicializa cURL
$ch = curl_init($url);

// Configura las opciones de cURL para obtener el contenido del archivo
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);

// Añade el encabezado x-ms-version
curl_setopt($ch, CURLOPT_HTTPHEADER, array('x-ms-version: 2022-05-01'));

// Ejecuta la solicitud cURL
$contenido = curl_exec($ch);

// Verifica si hubo un error
if(curl_errno($ch)) {
    echo 'Error de cURL: ' . curl_error($ch);
} else {
    // Muestra el contenido del archivo
    echo htmlspecialchars($contenido);
}

// Cierra la sesión cURL
curl_close($ch);
?>
