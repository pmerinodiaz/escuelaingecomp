<?PHP
/**
 * cuotabasica.php.
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
 * Clase que maneja los registros de las cuotas de b�sica existente en la base de datos. La
 * cuota b�sica es el precio que se le cobra a los estudiantes que ingresan a la Universidad
 * de La Serena.
 */

class cuotabasica
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * M�todo constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param link enlace a la base de datos.
	 */
	function cuotabasica($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que muestra la cuota b�sica m�s reciente existente en la base de datos.
	 */
	function mostrar()
	{
		// Consulta que captura el a�o mas reciente que valor de precio en la base de datos.
		$consulta = "SELECT MAX(anio_cuota_basica) AS anio FROM cuota_basica WHERE precio_cuota_basica <> 0";
		$resultado = mysql_query($consulta, $this->enlace);
		$anio = mysql_result($resultado, 0, "anio");
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
		
		// Consulta que obtiene el precio de la cuota b�sica del a�o capturando anteriormente.
		$consulta = "SELECT precio_cuota_basica FROM cuota_basica WHERE anio_cuota_basica = $anio";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos la tabla para mostrar la cuota b�sica.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
		
		// Mostramos la cuota b�sica con el a�os correspondiente.
		printf("<TR>");
		printf("<TD CLASS='contenido'><B>Cuota B&aacute;sica (A&ntilde;o %d)</B></TD>", $anio);
		printf("</TR>");
		printf("<TR>");
		printf("<TD CLASS='contenido'>\$%0.0f pesos chilenos.</TD>", mysql_result($resultado, 0, "precio_cuota_basica"));
		printf("</TR>");
		
		// Cerramos la tabla.
		echo "</TABLE>";
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
}
?>