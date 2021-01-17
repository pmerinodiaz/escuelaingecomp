<?PHP
/**
 * tema.php.
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
 * Clase que contiene los métodos y variables que manejan los temas de este sitio Web. Los
 * temas corresponden a todas las secciones (o temas) que se publican en este Web y que son
 * nodos terminales de los menus.
 */

class tema
{
  // Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Método constructor en donde se incializa el enlace a la base de datos.
	 *
	 * @param	link	Enlace a la base de datos.
	 */
	function tema($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que muestra los cinco temas más visitados. Los temas son mostrados en el Home
	 * del sitio Web.
	 */
	function mostrarDestacados()
	{
		// Consulta que obtiene todos los temas, ordenados por número de visitas.
		$consulta = "SELECT id_tema, nombre_tema, desc_tema, src_tema, url_tema FROM tema ORDER BY visitas_tema DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Contador del número de temas.
		$contador = 0;
		
		// Abrimos la tabla para los temas.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		
		// Imprimimos solo los primeros seis temas.
		while (($fila = mysql_fetch_array($resultado)) && ($contador < 5))
		{
			// Cuando el tema es la "Intranet".
			if ($fila["id_tema"] == 47)
				$target = "_blank";
			else $target = "_self";
			
			printf("<TR>");
			
			// Mostramos la imagen con el vínculo al tema.
			printf("<TD WIDTH='%s' ROWSPAN='2' VALIGN='top'><A HREF='../%s' TARGET='%s' TITLE='Ver %s'><IMG SRC='activos/%s' WIDTH='45' HEIGHT='45' BORDER='0'></A></TD>", "13%", $fila["url_tema"], $target, $fila["nombre_tema"], $fila["src_tema"]);
			
			// Mostramos el nombre con el vínculo al tema.
			printf("<TD WIDTH='%s' CLASS='destacado'><A HREF='../%s' TARGET='%s' TITLE='Ver %s'>%s</A></TD>", "87%", $fila["url_tema"], $target, $fila["nombre_tema"], $fila["nombre_tema"]);
			
			printf("</TR>");
			printf("<TR>");
			
			// Mostramos la descripción del tema
			printf("<TD WIDTH='%s' CLASS='contenido'>%s...</TD>", "87%", substr($fila["desc_tema"], 0, 120));
			
			printf("</TR>");
			printf("<TR>");
			printf("<TD COLSPAN='2'>&nbsp;</TD>");
			printf("</TR>");
			$contador++;
		}
		
		// Cerramos la tabla.
		echo "</TABLE>";
		
		// Liberamos la memoria utilizada en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que muestra la lista de temas desde la base de datos y configura las
	 * estadísticas resultantes por temas del sitio Web.
	 */
	function estadisticas()
	{
		// Consulta para obtener el total de visitas por tema.
		$consulta = "SELECT SUM(visitas_tema) AS total_visitas FROM tema";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Capturamos el total de visitas por tema.
		$total_visitas = $tupla["total_visitas"];
		
		// Imprimimos la tabla en donde mostramos las estadísticas.
		echo "<TABLE WIDTH='100%' BORDER='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='5' CLASS='contenido'>Hay un total de $total_visitas visitas por tema.</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='40%' ALIGN='center' CLASS='titulotabla'><B>Tema</B></TD>";
		echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'><B>Visitas</B></TD>";
		echo "<TD WIDTH='50%' ALIGN='center' CLASS='titulotabla' COLSPAN='2'><B>Porcentaje</B></TD>";
		echo "</TR>";
		
		// Consulta para obtener el total de visitas para cada tema de la tabla.
		$consulta = "SELECT nombre_tema, SUM(visitas_tema) AS visitas_tema FROM tema GROUP BY id_tema ORDER BY visitas_tema DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Ciclo en donde imprimimos el navegador con su respectivo porcentaje y total.
		while ($tupla = mysql_fetch_array($resultado))
		{
			printf("<TR>");
			
			// Mostramos el nombre del tema.
			printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $tupla["nombre_tema"]);
			
			// Mostramos el número de visitas del tema.
			printf("<TD CLASS='tabla' VALIGN='top' ALIGN='center'>%d</TD>", $tupla["visitas_tema"]);
			
			// Calculamos el porcentaje.
			if ($total_visitas > 0)
				$porcentaje = 100 * $tupla["visitas_tema"] / $total_visitas;
			else $porcentaje = 0.0;
			
			// Mostramos el gráfico del porcentaje.
			printf("<TD CLASS='tabla' VALIGN='top'><IMG SRC='../../../../librerias/pxrojo.gif' WIDTH='%d' HEIGHT='10'></TD>", $porcentaje);
			
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