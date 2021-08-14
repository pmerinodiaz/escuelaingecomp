<?PHP
/**
 * cuotabasica.php.
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
 * Clase que maneja los registros de las cuotas de básica existente en la base de datos. La
 * cuota básica es el precio que se le cobra a los estudiantes que ingresan a la Universidad
 * de La Serena.
 */

class cuotabasica
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Método constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param link enlace a la base de datos.
	 */
	function cuotabasica($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que muestra la cuota básica más reciente existente en la base de datos.
	 */
	function mostrar()
	{
		// Consulta que captura el año mas reciente que valor de precio en la base de datos.
		$consulta = "SELECT MAX(anio_cuota_basica) AS anio FROM cuota_basica WHERE precio_cuota_basica <> 0";
		$resultado = mysql_query($consulta, $this->enlace);
		$anio = mysql_result($resultado, 0, "anio");
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
		
		// Consulta que obtiene el precio de la cuota básica del año capturando anteriormente.
		$consulta = "SELECT precio_cuota_basica FROM cuota_basica WHERE anio_cuota_basica = $anio";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos la tabla para mostrar la cuota básica.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
		
		// Mostramos la cuota básica con el años correspondiente.
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