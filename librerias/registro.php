<?PHP
/**
 * registro.php.
 * v. 1.0.
 * Diciembre, 2004.
 *
 * Copyright (C) 2004 por H�ctor D�az D�az - Patricio Merino D�az.
 * Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile.
 * Todos los derechos reservados.
 *
 * No se asume ninguna  responsabilidad por el  uso o  alteraci�n  de este software.
 * Este software se proporciona como es y sin garant�a de ning�n tipo de su funcionamiento
 * y en ning�n caso ser� el autor responsable de da�os o perjuicios que se deriven del mal
 * uso del software, a�n cuando este haya sido notificado de la posibilidad de dicho da�o.
 *
 * Script que registra los datos sobre el idioma, sistema operativo y navegador del navegador
 * del cliente, en la base de datos MySQL 'ingecomp'. Adem�s registra la visita que est�
 * efectuando actualmente el usuario, al haber accedido a la p�gina ra�z (index.htm).
 */

// Cuando los par�metros recibidos en la URL existen.
if (isset($_GET["sistema"]) && $_GET["sistema"] != NULL && isset($_GET["navegador"]) && $_GET["navegador"] != NULL && isset($_GET["idioma"]) && $_GET["idioma"] != NULL)
{
	// Librer�as necesarias.
	include("conexion.php");
	include("contador.php");
	include("sistemaoperativo.php");
	include("navegador.php");
	include("idioma.php");
	
	// Creamos un objeto conexi�n y nos conectamos a la Base de Datos 'ingecomp'.
	$conexion = new conexion();
	$link = $conexion->conectar();
	
	// Creamos los objetos.
	$contador = new contador($link);
	$sistema_operativo = new sistemaoperativo($link);
	$navegador = new navegador($link);
	$idioma = new idioma($link);
	
	// Incrementamos el n�mero de vistas por d�a, por idioma, por sistema operativo y por navegador.
	$contador->incrementar();
	$sistema_operativo->incrementar($_GET["sistema"]);
	$navegador->incrementar($_GET["navegador"]);
	$idioma->incrementar($_GET["idioma"]);
	
	// Desconectamos la Base de Datos 'ingecomp'.
	$conexion->desconectar();
	
	// Redireccionamos al usuario a la p�gina Home.
	header("Location:../home/index.php");
}
// Cuando los par�metros recibidos en la URL no existen.
else
// Redireccionamos al usuario a la p�gina ra�z del sitio.
header("Location:../index.htm");
?>