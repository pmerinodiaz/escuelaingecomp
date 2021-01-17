<?PHP
/**
 * Script en donde se destruye la sesión.
 */

// Iniciamos la sesión.
session_start();

// Destruimos la sesión.
session_destroy();

// Direccionamos al usuario al Home de la Intranet.
header("Location:../intranet/index.php");
?>