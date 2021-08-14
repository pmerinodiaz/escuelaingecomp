<?PHP
/**
 * horario.php.
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
 * Clase administra los horarios de los distintos niveles, correspondiente al a�o y semestre
 * actual, los cuales se hayan registrados en la base de datos.
 */

class horario
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * M�todo constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function horario($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que muestra un listado con todos los a�os en los cuales hay horarios.
	 */
	function mostrarAnio()
	{
		// Consulta que obtiene todos los a�os en que existe horarios.
		$consulta = "SELECT anio_horario FROM horario GROUP BY anio_horario ORDER BY anio_horario DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay horarios.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay horarios.</P>";
		
		// Cuando si hay horarios.
		else
		{
			// Ciclo en donde recorremos los resultados y mostramos los a�os.
			printf("<UL>");
			while ($tupla = mysql_fetch_array($resultado))
			  printf("<LI><A HREF='horarios.php?anio=%d' TITLE='Ver Horarios del A&ntilde;o %d'>Horarios de Clases A&ntilde;o %d</A></LI>", $tupla["anio_horario"], $tupla["anio_horario"], $tupla["anio_horario"]);
			printf("</UL>");
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * M�todo que muestra el t�tulo de la secci�n 'Horarios de clases'.
	 */
	function titulo($anio)
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php' TITLE='Ver Horarios'>Horarios</A> / A&ntilde;o " . $anio;
		$imagen = "activos/bghorarios.jpg";
		$titulo = "Horarios de Clases A&ntilde;o " . $anio;
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * M�todo que muestra los horarios del a�o especificado como par�metros.
	 *
	 * @param $anio El a�o del horario.
	 */
	function mostrar($anio)
	{
		// Consulta que lista los horarios de un a�o determinado, ordenados por semestre y por nivel.
		$consulta = "SELECT semestre.id_semestre, nivel.numero_nivel, horario.url_horario, horario.tamanio_horario, formato.src_formato FROM horario, semestre, nivel, formato WHERE horario.anio_horario = $anio AND horario.id_semestre = semestre.id_semestre AND horario.id_nivel = nivel.id_nivel AND horario.id_formato = formato.id_formato ORDER BY semestre.id_semestre, nivel.id_nivel";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay horarios.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay horarios.</P>";
		
		// Cuando si hay horarios.
		else
		{
			// Valores por defecto.
			$semestre = 0;
			
			// Abrimos la tabla para los horarios.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
			
			// Ciclo para imprimir los horarios.
			while ($fila = mysql_fetch_array($resultado))
			{
				// Se muestra el semestre una sola vez.
				if ($semestre != $fila["id_semestre"])
				{
					$semestre = $fila["id_semestre"];
					echo "<TR><TD>&nbsp;</TR></TD>";
					echo "<TR>";
					echo "<TD CLASS='contenido'><B>Horarios del ";
					switch ($semestre)
					{
						case 1: echo "Primer Semestre"; break;
						case 2: echo "Segundo Semestre"; break;
					}
					echo "</B></TD>";
					echo "<TR><TD>&nbsp;</TR></TD>";
					echo "</TR>";
					echo "<TR>";
				}
				
				// Mostramos el archivo de descarga.
				printf("<TR>");
		    printf("<TD CLASS='tema'><A HREF='%s' TITLE='Descargar horario del %s nivel (%d KB)'><IMG SRC='../librerias/%s' BORDER='0'> Horario del %s Nivel</A></TD>", $fila["url_horario"], $fila["numero_nivel"], $fila["tamanio_horario"], $fila["src_formato"], $fila["numero_nivel"]);
				printf("</TR>");
			}
			
			// Cerramos la tabla de los horarios.
			echo "<TR><TD>&nbsp;</TD></TR>";
			echo "<TR><TD ALIGN='center'><A HREF='javascript:history.back(1);' TITLE='Volver'><IMG SRC='../librerias/btvolver.gif' BORDER='0'></A></TD></TR>";
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}	
}
?>