<?PHP
/**
 * Script en donde se destruye la sesi�n.
 */

// Iniciamos la sesi�n.
session_start();

// Destruimos la sesi�n.
session_destroy();

// Direccionamos al usuario al Home de la Intranet.
header("Location:../intranet/index.php");
?>