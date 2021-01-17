<?PHP
/**
 * seguridad.php.
 * v. 1.0.
 * Diciembre, 2004.
 *
 * Copyright (C) 2004 por H�ctor D�az D�az - Patricio Merino D�az.
 * Escuela Ingenier�a en Computacion, Universidad de La Serena, Chile.
 * Todos los derechos reservados.
 *
 * No se asume ninguna  responsabilidad por el  uso o  alteraci�n  de este software.
 * Este software se proporciona como es y sin garant�a de ning�n tipo de su funcionamiento
 * y en ning�n caso ser� el autor responsable de da�os o perjuicios que se deriven del mal
 * uso del software, a�n cuando este haya sido notificado de la posibilidad de dicho da�o.
 *
 * Script que controla la accesibilidad de los usuarios a ciertas p�ginas que requieran
 * de un proceso de autentificaci�n previo. Se verifica que el usuario haya efectuado el
 * inicio de sesi�n.
 */

// Abrimos la sesi�n y capturamos las variables de sesi�n.
session_start();

// Cuando existen las variables de la sesi�n.
if (isset($_SESSION['autentificado']) && isset($_SESSION['permiso']) && isset($_SESSION['id_persona']))
{
	// Cuando el usuario no se encuentra autentificado o el permiso no es del tipo especificado.
	if ($_SESSION['autentificado'] != "si" || $_SESSION['permiso'] != $_SESSION["tipo_permiso"])
	{
		// Se env�a al usuario a la p�gina de autentificacion.
		header("Location:" . $_SESSION["nivel_directorio"] . "index.php?seguridad_parametros_correctos");
		exit();
	}
}
// Cuando no existen las variables de la sesi�n.
else
{
	// Si no existen las variables de sesion, entonces se env�a al usuario a la p�gina de autentificaci�n.
	header("Location:" . $_SESSION["nivel_directorio"] . "index.php?seguridad_parametros_incorrectos");
	exit();
}
?>