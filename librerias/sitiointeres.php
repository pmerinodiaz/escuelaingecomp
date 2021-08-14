<?PHP
/**
 * sitiointeres.php.
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
 * Clase que administra los sitios Web de interés (o enlaces) que son publicados en este Web.
 * Los sitios de interés son direcciones de páginas en Internet que tienen relación con las
 * ciencias de la Computación o Informática.
 */

class sitiointeres
{
  // Enlace a la base de datos
	var $enlace;
	
	/**
	 * Método constructor que inicializa el enlace a la base de datos.
	 *
	 * @param	link Enlace a la base de datos.
	 */
	function sitiointeres($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que muestra los tres sitios de interés más visitados. Se muestran solo las
	 * imágenes de los webs, con sus respectivos vínculo a sus páginas.
	 */
	function mostrarDestacados()
	{
		// Consulta que obtiene todos los sitios de interés, ordenados por cantidad de visitas.
		$consulta = "SELECT nombre_sitio_interes, url_sitio_interes, src_sitio_interes FROM sitio_interes ORDER BY visitas_sitio_interes DESC, nombre_sitio_interes";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Contador del número de sitios de interés.
		$contador = 0;
		
		// Abrimos la tabla para los sitios de interés.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='true'>";
		
		// Imprimimos solo los tres primeros sitios de interés.
		while (($fila = mysql_fetch_array($resultado)) && ($contador < 3))
		{
			// Mostramos la imagen y el vínculo al sitio de interés.
			printf("<TR>");
			printf("<TD><A HREF='http://%s' TARGET='_blank' TITLE='Visitar Web de %s'><IMG SRC='../sitios/activos/%s' WIDTH='154' HEIGHT='40' BORDER='0'></A></TD>", $fila["url_sitio_interes"], $fila["nombre_sitio_interes"], $fila["src_sitio_interes"]);
			printf("</TR>");
			$contador++;
		}
		
		// Cerramos la tabla.
		echo "</TABLE>";
		
		// Liberamos la memoria utilizada.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que muestra el título de la sección 'Sitios de Intenrés'.
	 */
	function mostrarTitulo()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / Sitios de Inter&eacute;s";
		$imagen = "activos/bgsitios.jpg";
		$titulo="Sitios de Inter&eacute;s";
		$pixel="../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra (en forma paginada) el listado de los sitios de interés.
	 *
	 * @param $pagina El número de la págin actual dentro de la paginación total.
	 */
	function mostrar($pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "index.php?";
		$porpagina = 10;
		
		// Consulta para listar los sitios de interés.
		$consulta = "SELECT id_sitio_interes, nombre_sitio_interes, desc_sitio_interes, src_sitio_interes FROM sitio_interes ORDER BY id_sitio_interes DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando es la primera página mostramos la descripción de esta sección.
		if ($pagina == 1)
		{
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='true'>";
			echo "<TR>";
			echo "<TD WIDTH='30%' VALIGN='top'><IMG SRC='activos/logositios.jpg' WIDTH='131' HEIGHT='100'></TD>";
			echo "<TD WIDTH='70%' VALIGN='top' CLASS='contenido'>";
			echo "<P>En esta secci&oacute;n se encuentran recopiladas varias direcciones de p&aacute;ginas Web, que creemos interesantes para la comunidad estudiantil de la Escuela. Entre estas p&aacute;ginas se encuentran Revistas de Computaci&oacute;n, Sitios Oficiales, Hardware, Software y otros.</P>";
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD>&nbsp;</TD></TR>";
		}
		
		// Cuando no hay sitios de interés.
		if ($total == 0)
		{
			echo "<TR>";
			echo "<TD COLSPAN='2' CLASS='contenido'>No hay sitios de inter&eacute;s.</TD>";
			echo "</TR>";
		}
		
		// Cuando si hay sitios de interés.
		else
		{
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Creamos un objeto paginación.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Tabla para contener el total, la paginación y los sitios de interés.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total sitios de inter&eacute;s.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>&nbsp;</TD>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para los sitios de interés.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos los sitios de interés.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Imprimimos el nombre (con enlace).
				$nombre = strtr($tupla["nombre_sitio_interes"], $caracteres);
				printf("<TR>");
				printf("<TD COLSPAN='2' CLASS='contenido'><A HREF='enlazar.php?id=%d' TITLE='Visitar Web de %s'><B>%s</B></A></TD>", $tupla["id_sitio_interes"], $nombre, $nombre);
				printf("</TR>");
				
				// Imprimimos la imagen (con enlace) y la descripción.
				$desc = strtr($tupla["desc_sitio_interes"], $caracteres);
				printf("<TR>");
				printf("<TD WIDTH='%s'><A HREF='enlazar.php?id=%d'><IMG SRC='activos/%s' BORDER='0' TITLE='Visitar Web de %s' WIDTH='154' HEIGHT='40' ALIGN='left'></A></TD>", "35%", $tupla["id_sitio_interes"], $tupla["src_sitio_interes"], $nombre);
				printf("<TD WIDTH='%s' CLASS='detalle'>%s...</TD>", "65%", $desc);
				printf("</TR>");
				
				// Imprimimos un espacio en blanco.
				printf("<TR><TD>&nbsp;</TD></TD>");
			}
			
			// Cerramos la tabla de los sitios de interes.
			echo "</TABLE>";
			echo "</TD>";
			echo "</TR>";
			
			// Imprimimos la paginación.
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			
			// Cerramos la tabla de la paginación.
			echo "</TABLE>";
		}
		
		// Cerramos la tabla de la descripción.
		if ($pagina == 1)
			echo "</TABLE>";
		
		// Liberamos la memoria del servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda.
		$this->formularioBusqueda();
	}
	
	/**
	 * Método que muestra el formulario de búsqueda de sitios de interés.
	 */
	function formularioBusqueda()
	{
		$titulo = "B&uacute;squeda de Sitios de Inter&eacute;s";
		$ocultos = "";
		$comentario = "sitios de inter&eacute;s";
		require("busquedasimple.inc");
	}
	
	/**
	 * Método que imprime el título de la sección 'Búsqueda de Sitios de Interés'.
	 */
	function tituloBusqueda()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php?pagina=1' TITLE='Ver Sitios de Inter&eacute;s'>Sitios de Inter&eacute;s</A> / B&uacute;squeda";
		$imagen = "activos/bgsitios.jpg";
		$titulo = "B&uacute;squeda de Sitios de Inter&eacute;s";
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que busca sitios de interés que coincidan con la palabra ingresada
	 * por el usuario.
	 *
	 * @param $palabra La palabra o frase a buscar.
	 * @param $pagina El número de la página dentro de la paginación total.
	 */
	function buscar($palabra, $pagina)
	{
		// Librerias necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "index.php?palabra=" . $palabra . "&";
		$porpagina = 10;
		
		// Consulta para listar los sitios de interés que coincidan con la palabra.
		$consulta = "SELECT id_sitio_interes, nombre_sitio_interes, desc_sitio_interes, src_sitio_interes FROM sitio_interes WHERE nombre_sitio_interes LIKE '%$palabra%' OR desc_sitio_interes LIKE '%$palabra%' ORDER BY id_sitio_interes DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay sitios de interés.
		if ($total == 0)
			echo "<P CLASS='contenido'>No se encontraron sitios de inter&eacute;s.</P>";
		
		// Cuando si hay sitios de interés.
		else
		{
			// Creamos un objeto paginación.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Tabla para contener la descripción, la paginación, el listado y la búsqueda.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total sitios de inter&eacute;s.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>&nbsp;</TD>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para los sitios de interés.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos los sitios de interés.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Imprimimos el nombre (con enlace).
				$nombre = strtr($tupla["nombre_sitio_interes"], $caracteres);
				printf("<TR>");
				printf("<TD COLSPAN='2' CLASS='contenido'><A HREF='enlazar.php?id=%d' TITLE='Visitar Web de %s'><B>%s</B></A></TD>", $tupla["id_sitio_interes"], $nombre, $nombre);
				printf("</TR>");
				
				// Imprimimos la imagen (con enlace) y la descripción.
				$desc = strtr($tupla["desc_sitio_interes"], $caracteres);
				printf("<TR>");
				printf("<TD WIDTH='%s'><A HREF='enlazar.php?id=%d' TITLE='Visitar Web de %s'><IMG SRC='activos/%s' BORDER='0' WIDTH='154' HEIGHT='40' ALIGN='left'></A></TD>", "35%", $tupla["id_sitio_interes"], $nombre, $tupla["src_sitio_interes"]);
				printf("<TD WIDTH='%s' CLASS='detalle'>%s...</TD>", "65%", $desc);
				printf("</TR>");
				
				// Imprimimos un espacio en blanco.
				printf("<TR><TD COLSPAN='2'>&nbsp;</TD></TD>");
			}
			
			// Cerramos la tabla de los sitios de interés.
			echo "</TABLE>";
			echo "</TD>";
			echo "</TR>";
			
			// Imprimimos la paginación.
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "</TABLE>";
		}
		
		// Liberamos la memoria del servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda.
		$this->formularioBusqueda();
	}
	
	/**
	 * Método que imprime el título de la sección 'Enlazar al Sitio'.
	 *
	 * @param $id_sitio_interes El identificador del sitio de interés.
	 */
	function tituloAcceso($id_sitio_interes)
	{
		// Capturamos el nombre del sitio de interés.
		$titulo = $this->nombre($id_sitio_interes);
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php?pagina=1' TITLE='Ver Sitios de Inter&eacute;s'>Sitios de Inter&eacute;s</A> / " . $titulo;
		$imagen = "activos/bgsitios.jpg";
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que retorna el nombre de un sitio de interés.
	 *
	 * @param $id_sitio_interes El identificador del sitio de interés.
	 * @return $nombre_sitio_interes El nombre del sitio de interés.
	 */
	function nombre($id_sitio_interes)
	{
		// Consulta para obtener el nombre del sitio de interés.
		$consulta = "SELECT nombre_sitio_interes FROM sitio_interes WHERE id_sitio_interes = $id_sitio_interes";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Devolvemos el nombre del sitio de interés encontrado.
		return $tupla["nombre_sitio_interes"];
	}
	
	/**
	 * Método donde se muestran los detalles del sitio de interés, además se se incrementa
	 * el número de visitas para el sitio de interés mostrado.
	 *
	 * @param $id_sitio_interes El identificador del sitio de interés.
	 */
	function detallar($id_sitio_interes)
	{
		// Consulta para obtener información del sitio indicado.
		$consulta = "SELECT nombre_sitio_interes, desc_sitio_interes, url_sitio_interes, src_sitio_interes, visitas_sitio_interes FROM sitio_interes WHERE id_sitio_interes = $id_sitio_interes";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Cuando hay sitio de interés.
		if ($tupla)
		{
			// Tabla para mostrar la información del sitio.
			printf("<TABLE WIDTH='%s' BORDER='0'>", "100%");
			
			// Imprimimos la imagen y la descripción.
			printf("<TR>");
			printf("<TD CLASS='contenido'><IMG SRC='activos/%s' BORDER='0' WIDTH='154' HEIGHT='40' ALIGN='left'> %s.</TD>", $tupla["src_sitio_interes"], nl2br(strtr($tupla["desc_sitio_interes"], get_html_translation_table(HTML_SPECIALCHARS))));
			printf("</TR>");
			
			// Imprimimos la URL.
			printf("<TR><TD>&nbsp;</TD></TR>");
			printf("<TR>");
			printf("<TD CLASS='contenido'><B>Sitio Web</B>: <A HREF='http://%s' TARGET='_blank' TITLE='Visitar Web de %s'>http://%s</A></TD>", $tupla["url_sitio_interes"], $tupla["nombre_sitio_interes"], $tupla["url_sitio_interes"]);
			printf("</TR>");
			
			// Imprimimos las visitas.
			printf("<TR>");
			printf("<TD CLASS='contenido'>Visitas: %s</TD>", $tupla["visitas_sitio_interes"]);
			printf("</TR>");
			
			// Mostramos el botón para regresar.
			printf("<TR><TD>&nbsp;</TD></TR>");
			printf("<TR><TD ALIGN='center'><A HREF=\"javascript:history.back(1);\" TITLE='Volver'><IMG SRC='../librerias/btvolver.gif' BORDER='0'></A></TD></TR>");
			printf("<TR><TD>&nbsp;</TD></TR>");
			printf("</TABLE>");
			
			// Liberamos memoria en el servidor.
			mysql_free_result($resultado);
			
			// Incrementamos las visitas y la actualizamos.
			$visitas = $tupla["visitas_sitio_interes"] + 1;
			$this->actualizarVisitas($id_sitio_interes, $visitas);
		}
	}
	
	/**
	 * Método donde se actualiza el número de visitas de un sitio de interés.
	 *
	 * @param $id_sitio_interes El identificador del sitio de interés.
	 * @param $visitas El nuevo número de visitas del sitio de interés.
	 */
	function actualizarVisitas($id_sitio_interes, $visitas)
	{
		// Consulta para actualizar las visitas del sitio de interés.
		$consulta = "UPDATE sitio_interes SET visitas_sitio_interes = $visitas WHERE id_sitio_interes = $id_sitio_interes";
		$resultado = mysql_query($consulta, $this->enlace);
	}
	
	/**
	 * Método que retorna el URL de un sitio de interés.
	 *
	 * @param $id_sitio_interes El identificador del sitio de interés.
	 *
	 * @return $url_sitio_interes El URL del sitio de interés.
	 */
	function url($id_sitio_interes)
	{
		// Consulta para obtener la URL del sitio de interés.
		$consulta = "SELECT url_sitio_interes FROM sitio_interes WHERE id_sitio_interes = $id_sitio_interes";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Devolvemos el url encontrado.
		return $tupla["url_sitio_interes"];
	}
}
?>