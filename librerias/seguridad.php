<?PHP
/**
 * seguridad.php.
 * v. 1.0.
 * Diciembre, 2004.
 *
 * Copyright (C) 2004 por Héctor Díaz Díaz - Patricio Merino Díaz.
 * Escuela Ingeniería en Computacion, Universidad de La Serena, Chile.
 * Todos los derechos reservados.
 *
 * No se asume ninguna  responsabilidad por el  uso o  alteración  de este software.
 * Este software se proporciona como es y sin garantía de ningún tipo de su funcionamiento
 * y en ningún caso será el autor responsable de daños o perjuicios que se deriven del mal
 * uso del software, aún cuando este haya sido notificado de la posibilidad de dicho daño.
 *
 * Script que controla la accesibilidad de los usuarios a ciertas páginas que requieran
 * de un proceso de autentificación previo. Se verifica que el usuario haya efectuado el
 * inicio de sesión.
 */

// Abrimos la sesión y capturamos las variables de sesión.
session_start();

// Cuando existen las variables de la sesión.
if (isset($_SESSION['autentificado']) && isset($_SESSION['permiso']) && isset($_SESSION['id_persona']))
{
	// Cuando el usuario no se encuentra autentificado o el permiso no es del tipo especificado.
	if ($_SESSION['autentificado'] != "si" || $_SESSION['permiso'] != $_SESSION["tipo_permiso"])
	{
		// Se envía al usuario a la página de autentificacion.
		header("Location:" . $_SESSION["nivel_directorio"] . "index.php?seguridad_parametros_correctos");
		exit();
	}
}
// Cuando no existen las variables de la sesión.
else
{
	// Si no existen las variables de sesion, entonces se envía al usuario a la página de autentificación.
	header("Location:" . $_SESSION["nivel_directorio"] . "index.php?seguridad_parametros_incorrectos");
	exit();
}
?>