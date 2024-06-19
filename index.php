<?php
// Utilizar el SDK de Azure para PHP con autenticación de identidad gestionada
use MicrosoftAzure\Storage\File\FileRestProxy;
use MicrosoftAzure\Storage\Common\Internal\Authentication\TokenAuthScheme;

// Obtener el token de acceso desde el entorno de Azure App Service
$token = getenv('IDENTITY_ENDPOINT');
$tokenAuthScheme = new TokenAuthScheme($token);

// Crear el cliente de FileRestProxy con la autenticación de token
$fileClient = FileRestProxy::createFileService(null, $tokenAuthScheme);

// Nombre del share y del directorio donde se encuentra el fichero
$shareName = 'filesharetestapi';
$directoryName = 'dirapifiles'; // Puede ser una cadena vacía si el fichero está en la raíz del share
$fileName = 'hola.txt';

// Obtener el contenido del fichero
$content = $fileClient->getFileContent($shareName, $directoryName, $fileName);
echo $content;
?>
