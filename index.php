<?php
// Nombre de la cuenta de Azure Storage
$accountName = 'filestestapi';
// Clave de la cuenta de Azure Storage
$accountKey = 'YQncsNA6UrxbjruMaUvfVHXrvwbWkbT7Pv73/+csgUgqdkOrcLCT0RbPLRTAlWku5SUJej9Rib8P+ASt23rOdg';

// URL del archivo en Azure Files
$url = 'https://filestestapi.file.core.windows.net/filesharetestapi/hola.txt';

// Inicializa cURL
$ch = curl_init($url);

// Genera el valor de autorización
$date = gmdate('D, d M Y H:i:s T');
$version = '2022-05-01';
$headers = "x-ms-date:$date\nx-ms-version:$version";
$signatureString = "GET\n\n\n\n\n\n\n\n\n\n\n\n\n$headers\n/$accountName/filesharetestapi/hola.txt";
$signature = base64_encode(hash_hmac('sha256', $signatureString, base64_decode($accountKey), true));
$authHeader = "Authorization: SharedKey $accountName:$signature";

// Configura las opciones de cURL para obtener el contenido del archivo
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);

// Añade los encabezados necesarios
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "x-ms-version: $version",
    "x-ms-date: $date",
    $authHeader
));

// Ejecuta la solicitud cURL
$contenido = curl_exec($ch);

// Verifica si hubo un error
if (curl_errno($ch)) {
    echo 'Error de cURL: ' . curl_error($ch);
} else {
    // Muestra el contenido del archivo
    echo htmlspecialchars($contenido);
}

// Cierra la sesión cURL
curl_close($ch);
?>
