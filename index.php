<?php
curl_setopt($ch, CURLOPT_VERBOSE, true);
$verbose = fopen('php://temp', 'w+');
curl_setopt($ch, CURLOPT_STDERR, $verbose);

// Nombre de la cuenta de Azure Storage
$accountName = 'filestestapi';
// Clave de la cuenta de Azure Storage (en base64)
$accountKey = 'YQncsNA6UrxbjruMaUvfVHXrvwbWkbT7Pv73/+csgUgqdkOrcLCT0RbPLRTAlWku5SUJej9Rib8P+ASt23rOdg==';

// URL del archivo en Azure Files
$url = 'https://filestestapi.file.core.windows.net/filesharetestapi/hola.txt';

// Inicializa cURL
$ch = curl_init($url);

// Genera la fecha en formato GMT
$date = gmdate('D, d M Y H:i:s T');

// Versión de la API de Azure
$version = '2021-06-08'; // Puedes probar con otras versiones si esta no funciona

// StringToSign
$stringToSign = "GET\n\n\n\n\n\n\n\n\n\n\n\n\nx-ms-date:$date\nx-ms-version:$version\n/$accountName/filesharetestapi/hola.txt";

// Calcula la firma HMAC-SHA256
$signature = base64_encode(hash_hmac('sha256', $stringToSign, base64_decode($accountKey), true));

// Cabecera de autorización
$authHeader = "Authorization: SharedKey $accountName:$signature";

// Configura las opciones de cURL para obtener el contenido del archivo
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);

// Añade los encabezados necesarios
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "x-ms-date: $date",
    "x-ms-version: $version",
    $authHeader
));

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

rewind($verbose);
$verboseLog = stream_get_contents($verbose);
fclose($verbose);

echo "cURL log:\n" . htmlspecialchars($verboseLog) . "\n";

?>
