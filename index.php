<?php
require 'vendor/autoload.php';

use MicrosoftAzure\Storage\File\FileRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;

$accountName = 'filestestapi';
$accountKey = 'YQncsNA6UrxbjruMaUvfVHXrvwbWkbT7Pv73/+csgUgqdkOrcLCT0RbPLRTAlWku5SUJej9Rib8P+ASt23rOdg';
$shareName = 'filesharetestapi';
$filePath = 'dirapifiles/hola.txt'; // Ruta del archivo dentro del recurso compartido

// Crear el cliente de Azure File
$connectionString = "DefaultEndpointsProtocol=https;AccountName=$accountName;AccountKey=$accountKey";
$fileClient = FileRestProxy::createFileService($connectionString);

try {
    // Obtener el contenido del archivo
    $fileContent = $fileClient->getFile($shareName, '', $filePath);
    $stream = $fileContent->getContentStream();
    $contents = stream_get_contents($stream);

    // Mostrar el contenido del archivo en la página web
    echo nl2br(htmlspecialchars($contents, ENT_QUOTES, 'UTF-8'));
} catch (ServiceException $e) {
    // Manejar errores
    $code = $e->getCode();
    $error_message = $e->getMessage();
    echo "Error al obtener el archivo: $code - $error_message";
}
?>
