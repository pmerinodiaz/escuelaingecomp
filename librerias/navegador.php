<?PHP
/**
 * navegador.php.
 * v. 1.0.
 * Diciembre, 2004.
 *
 * Copyright (C) 2004 por Héctor Díaz Díaz - Patricio Merino Díaz.
 * Escuela Ingeniería en Computación, Universidad de La Serena, Chile.
 * Todos los derechos reservados.
 *
 * No se asume ninguna  responsabilidad por el  uso o  alteración  de este software.
 * Este software se proporciona como es y sin garantía de ningún tipo de su funcionamiento
 * y en ningún caso será el autor responsable de daños o perjuicios que se deriven del mal
 * uso del software, aún cuando este haya sido notificado de la posibilidad de dicho daño.
 *
 * Clase que administra los registros de los navegadores o browser existente en la base de
 * datos.
 */

class navegador
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link Enlace a la base de datos.
	 */
	function navegador($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que incrementa el número de visitas del navegador con nombre conocido.
	 *
	 * @param $navegador El nombre del navegador.
	 */
	function incrementar($navegador)
	{
		// Consulta para obtener el número de visitas del navegador.
		$consulta = "SELECT visitas_navegador FROM navegador WHERE nombre_navegador = '$navegador'";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$total = mysql_num_rows($resultado);
		
		// Liberamos memoria utilizada en la consulta anterior.
		mysql_free_result($resultado);
		
		// Cuando hay registros del navegador en la tabla 'navegador'.
		if ($total > 0)
		{
			// Incrementamos el número de visitas del navegador.
			$visitas = $tupla["visitas_navegador"] + 1;
			
			// Consulta para actualizar el número de visitas del navegador.
			$consulta = "UPDATE navegador SET visitas_navegador = $visitas WHERE nombre_navegador = '$navegador'";
			mysql_query($consulta, $this->enlace);
		}
	}
	
	/**
	 * Método que muestra la lista de navegadores desde la base de datos y configura las
	 * estadísticas resultantes por navegador.
	 */
	function estadisticas()
	{
		// Consulta para obtener el total de visitas por navegador.
		$consulta = "SELECT SUM(visitas_navegador) AS total_visitas FROM navegador";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Capturamos el total de visitas por navegador.
		$total_visitas = $tupla["total_visitas"];
		
		// Imprimimos la tabla en donde mostramos las estadísticas.
		echo "<TABLE WIDTH='100%' BORDER='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='5' CLASS='contenido'>Hay un total de $total_visitas visitas por navegador.</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' ALIGN='center' CLASS='titulotabla'><B>Navegador</B></TD>";
		echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'><B>Visitas</B></TD>";
		echo "<TD WIDTH='60%' ALIGN='center' CLASS='titulotabla' COLSPAN='2'><B>Porcentaje</B></TD>";
		echo "</TR>";
		
		// Consulta para obtener el total de visitas para cada navegador de la tabla.
		$consulta = "SELECT src_navegador, nombre_navegador, SUM(visitas_navegador) AS visitas_navegador FROM navegador GROUP BY id_navegador ORDER BY visitas_navegador DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Ciclo en donde imprimimos el navegador con su respectivo porcentaje y total.
		while ($tupla = mysql_fetch_array($resultado))
		{
			printf("<TR>");
			
			// Mostramos el icono y el nombre del navegador.
			printf("<TD CLASS='tabla' VALIGN='top'><IMG SRC='../../../../librerias/%s'> %s</TD>", $tupla["src_navegador"], $tupla["nombre_navegador"]);
			
			// Mostramos el número de visitas del navegador.
			printf("<TD CLASS='tabla' VALIGN='top' ALIGN='center'>%d</TD>", $tupla["visitas_navegador"]);
			
			// Calculamos el porcentaje.
			if ($total_visitas > 0)
				$porcentaje = 100 * $tupla["visitas_navegador"] / $total_visitas;
			else $porcentaje = 0.0;
			
			// Mostramos el gráfico del porcentaje.
			printf("<TD CLASS='tabla' VALIGN='top'><IMG SRC='../../../../librerias/pxrojo.gif' WIDTH='%d' HEIGHT='10'></TD>", $porcentaje*2);
			
			// Mostramos el porcentaje.
			printf("<TD CLASS='tabla' VALIGN='top' ALIGN='right'>%0.1f %s</TD>", $porcentaje, "%");
			printf("</TR>");
		}
		
		// Cerramos la tabla.
		echo "</TABLE>";
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
}
?>