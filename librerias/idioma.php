<?PHP
/**
 * idioma.php.
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
 * Clase que contiene los métodos y variables que permiten administrar los idiomas existentes
 * en la base de datos.
 */

class idioma
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link Enlace a la base de datos.
	 */
	function idioma($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que incrementa el número de visitas del idioma con lenguaje conocido.
	 *
	 * @param $lenguaje El código del lenguaje.
	 */
	function incrementar($idioma)
	{
		// Consulta para obtener el número de visitas del idioma.
		$consulta = "SELECT visitas_idioma FROM idioma WHERE codigo_idioma = '$idioma'";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$total = mysql_num_rows($resultado);
		
		// Liberamos memoria utilizada en la consulta anterior.
		mysql_free_result($resultado);
		
		// Cuando hay registros del lenguaje en la tabla 'idioma'.
		if ($total > 0)
		{
			// Incrementamos el número de visitas del idioma.
			$visitas = $tupla["visitas_idioma"] + 1;
			
			// Consulta para actualizar el número de visitas del idioma.
			$consulta = "UPDATE idioma SET visitas_idioma = $visitas WHERE codigo_idioma = '$idioma'";
			mysql_query($consulta, $this->enlace);
		}
	}
	
	/**
	 * Método que obtiene todos los idiomas existentes en la base de datos y escribe un
	 * select con los resultados.
	 *
	 * @param $id_idioma El identificador del idioma.
	 */
	function select($id_idioma)
	{
		// Consulta que obtiene todos los idiomas existentes.
		$consulta = "SELECT id_idioma, nombre_idioma FROM idioma ORDER BY nombre_idioma";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos el select.
		echo "<SELECT NAME='idioma' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos los idiomas como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_idioma"] == $id_idioma)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_idioma"], $fila["nombre_idioma"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_idioma"], $fila["nombre_idioma"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que muestra la lista de idiomas desde la base de datos y configura las
	 * estadísticas resultantes por idioma.
	 */
	function estadisticas()
	{
		// Consulta para obtener el total de visitas por idioma.
		$consulta = "SELECT SUM(visitas_idioma) AS total_visitas FROM idioma";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Capturamos el total de visitas por idioma.
		$total_visitas = $tupla["total_visitas"];
		
		// Imprimimos la tabla en donde mostramos las estadísticas.
		echo "<TABLE WIDTH='90%' BORDER='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='5' CLASS='contenido'>Hay un total de $total_visitas visitas por idioma.</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' ALIGN='center' CLASS='titulotabla'><B>Idioma</B></TD>";
		echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'><B>Visitas</B></TD>";
		echo "<TD WIDTH='60%' ALIGN='center' CLASS='titulotabla' COLSPAN='2'><B>Porcentaje</B></TD>";
		echo "</TR>";
		
		// Consulta para obtener el total de visitas para cada idioma de la tabla.
		$consulta = "SELECT src_idioma, nombre_idioma, SUM(visitas_idioma) AS visitas_idioma FROM idioma GROUP BY id_idioma ORDER BY visitas_idioma DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Ciclo en donde imprimimos el idioma con su respectivo porcentaje y total.
		while ($tupla = mysql_fetch_array($resultado))
		{
			printf("<TR>");
			
			// Mostramos el icono y el nombre del idioma.
			printf("<TD CLASS='tabla' VALIGN='top'><IMG SRC='../../../../librerias/%s'> %s</TD>", $tupla["src_idioma"], $tupla["nombre_idioma"]);
			
			// Mostramos el número de visitas del idioma.
			printf("<TD CLASS='tabla' VALIGN='top' ALIGN='center'>%d</TD>", $tupla["visitas_idioma"]);
			
			// Calculamos el porcentaje.
			if ($total_visitas > 0)
				$porcentaje = 100 * $tupla["visitas_idioma"] / $total_visitas;
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