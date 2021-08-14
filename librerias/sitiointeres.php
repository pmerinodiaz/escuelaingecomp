<?PHP
/**
 * sitiointeres.php.
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
 * Clase que administra los sitios Web de inter�s (o enlaces) que son publicados en este Web.
 * Los sitios de inter�s son direcciones de p�ginas en Internet que tienen relaci�n con las
 * ciencias de la Computaci�n o Inform�tica.
 */

class sitiointeres
{
  // Enlace a la base de datos
	var $enlace;
	
	/**
	 * M�todo constructor que inicializa el enlace a la base de datos.
	 *
	 * @param	link Enlace a la base de datos.
	 */
	function sitiointeres($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que muestra los tres sitios de inter�s m�s visitados. Se muestran solo las
	 * im�genes de los webs, con sus respectivos v�nculo a sus p�ginas.
	 */
	function mostrarDestacados()
	{
		// Consulta que obtiene todos los sitios de inter�s, ordenados por cantidad de visitas.
		$consulta = "SELECT nombre_sitio_interes, url_sitio_interes, src_sitio_interes FROM sitio_interes ORDER BY visitas_sitio_interes DESC, nombre_sitio_interes";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Contador del n�mero de sitios de inter�s.
		$contador = 0;
		
		// Abrimos la tabla para los sitios de inter�s.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='true'>";
		
		// Imprimimos solo los tres primeros sitios de inter�s.
		while (($fila = mysql_fetch_array($resultado)) && ($contador < 3))
		{
			// Mostramos la imagen y el v�nculo al sitio de inter�s.
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
	 * M�todo que muestra el t�tulo de la secci�n 'Sitios de Intenr�s'.
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
	 * M�todo que muestra (en forma paginada) el listado de los sitios de inter�s.
	 *
	 * @param $pagina El n�mero de la p�gin actual dentro de la paginaci�n total.
	 */
	function mostrar($pagina)
	{
		// Librer�as necesarias.
		include("paginacion.php");
		
		// Inicializaci�n de variables.
		$vinculo = "index.php?";
		$porpagina = 10;
		
		// Consulta para listar los sitios de inter�s.
		$consulta = "SELECT id_sitio_interes, nombre_sitio_interes, desc_sitio_interes, src_sitio_interes FROM sitio_interes ORDER BY id_sitio_interes DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando es la primera p�gina mostramos la descripci�n de esta secci�n.
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
		
		// Cuando no hay sitios de inter�s.
		if ($total == 0)
		{
			echo "<TR>";
			echo "<TD COLSPAN='2' CLASS='contenido'>No hay sitios de inter&eacute;s.</TD>";
			echo "</TR>";
		}
		
		// Cuando si hay sitios de inter�s.
		else
		{
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Creamos un objeto paginaci�n.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Tabla para contener el total, la paginaci�n y los sitios de inter�s.
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
			
			// Tabla para los sitios de inter�s.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condici�n de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos los sitios de inter�s.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Imprimimos el nombre (con enlace).
				$nombre = strtr($tupla["nombre_sitio_interes"], $caracteres);
				printf("<TR>");
				printf("<TD COLSPAN='2' CLASS='contenido'><A HREF='enlazar.php?id=%d' TITLE='Visitar Web de %s'><B>%s</B></A></TD>", $tupla["id_sitio_interes"], $nombre, $nombre);
				printf("</TR>");
				
				// Imprimimos la imagen (con enlace) y la descripci�n.
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
			
			// Imprimimos la paginaci�n.
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			
			// Cerramos la tabla de la paginaci�n.
			echo "</TABLE>";
		}
		
		// Cerramos la tabla de la descripci�n.
		if ($pagina == 1)
			echo "</TABLE>";
		
		// Liberamos la memoria del servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de b�squeda.
		$this->formularioBusqueda();
	}
	
	/**
	 * M�todo que muestra el formulario de b�squeda de sitios de inter�s.
	 */
	function formularioBusqueda()
	{
		$titulo = "B&uacute;squeda de Sitios de Inter&eacute;s";
		$ocultos = "";
		$comentario = "sitios de inter&eacute;s";
		require("busquedasimple.inc");
	}
	
	/**
	 * M�todo que imprime el t�tulo de la secci�n 'B�squeda de Sitios de Inter�s'.
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
	 * M�todo que busca sitios de inter�s que coincidan con la palabra ingresada
	 * por el usuario.
	 *
	 * @param $palabra La palabra o frase a buscar.
	 * @param $pagina El n�mero de la p�gina dentro de la paginaci�n total.
	 */
	function buscar($palabra, $pagina)
	{
		// Librerias necesarias.
		include("paginacion.php");
		
		// Inicializaci�n de variables.
		$vinculo = "index.php?palabra=" . $palabra . "&";
		$porpagina = 10;
		
		// Consulta para listar los sitios de inter�s que coincidan con la palabra.
		$consulta = "SELECT id_sitio_interes, nombre_sitio_interes, desc_sitio_interes, src_sitio_interes FROM sitio_interes WHERE nombre_sitio_interes LIKE '%$palabra%' OR desc_sitio_interes LIKE '%$palabra%' ORDER BY id_sitio_interes DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay sitios de inter�s.
		if ($total == 0)
			echo "<P CLASS='contenido'>No se encontraron sitios de inter&eacute;s.</P>";
		
		// Cuando si hay sitios de inter�s.
		else
		{
			// Creamos un objeto paginaci�n.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Tabla para contener la descripci�n, la paginaci�n, el listado y la b�squeda.
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
			
			// Tabla para los sitios de inter�s.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condici�n de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos los sitios de inter�s.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Imprimimos el nombre (con enlace).
				$nombre = strtr($tupla["nombre_sitio_interes"], $caracteres);
				printf("<TR>");
				printf("<TD COLSPAN='2' CLASS='contenido'><A HREF='enlazar.php?id=%d' TITLE='Visitar Web de %s'><B>%s</B></A></TD>", $tupla["id_sitio_interes"], $nombre, $nombre);
				printf("</TR>");
				
				// Imprimimos la imagen (con enlace) y la descripci�n.
				$desc = strtr($tupla["desc_sitio_interes"], $caracteres);
				printf("<TR>");
				printf("<TD WIDTH='%s'><A HREF='enlazar.php?id=%d' TITLE='Visitar Web de %s'><IMG SRC='activos/%s' BORDER='0' WIDTH='154' HEIGHT='40' ALIGN='left'></A></TD>", "35%", $tupla["id_sitio_interes"], $nombre, $tupla["src_sitio_interes"]);
				printf("<TD WIDTH='%s' CLASS='detalle'>%s...</TD>", "65%", $desc);
				printf("</TR>");
				
				// Imprimimos un espacio en blanco.
				printf("<TR><TD COLSPAN='2'>&nbsp;</TD></TD>");
			}
			
			// Cerramos la tabla de los sitios de inter�s.
			echo "</TABLE>";
			echo "</TD>";
			echo "</TR>";
			
			// Imprimimos la paginaci�n.
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
		
		// Mostramos el formulario de b�squeda.
		$this->formularioBusqueda();
	}
	
	/**
	 * M�todo que imprime el t�tulo de la secci�n 'Enlazar al Sitio'.
	 *
	 * @param $id_sitio_interes El identificador del sitio de inter�s.
	 */
	function tituloAcceso($id_sitio_interes)
	{
		// Capturamos el nombre del sitio de inter�s.
		$titulo = $this->nombre($id_sitio_interes);
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php?pagina=1' TITLE='Ver Sitios de Inter&eacute;s'>Sitios de Inter&eacute;s</A> / " . $titulo;
		$imagen = "activos/bgsitios.jpg";
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * M�todo que retorna el nombre de un sitio de inter�s.
	 *
	 * @param $id_sitio_interes El identificador del sitio de inter�s.
	 * @return $nombre_sitio_interes El nombre del sitio de inter�s.
	 */
	function nombre($id_sitio_interes)
	{
		// Consulta para obtener el nombre del sitio de inter�s.
		$consulta = "SELECT nombre_sitio_interes FROM sitio_interes WHERE id_sitio_interes = $id_sitio_interes";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Devolvemos el nombre del sitio de inter�s encontrado.
		return $tupla["nombre_sitio_interes"];
	}
	
	/**
	 * M�todo donde se muestran los detalles del sitio de inter�s, adem�s se se incrementa
	 * el n�mero de visitas para el sitio de inter�s mostrado.
	 *
	 * @param $id_sitio_interes El identificador del sitio de inter�s.
	 */
	function detallar($id_sitio_interes)
	{
		// Consulta para obtener informaci�n del sitio indicado.
		$consulta = "SELECT nombre_sitio_interes, desc_sitio_interes, url_sitio_interes, src_sitio_interes, visitas_sitio_interes FROM sitio_interes WHERE id_sitio_interes = $id_sitio_interes";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Cuando hay sitio de inter�s.
		if ($tupla)
		{
			// Tabla para mostrar la informaci�n del sitio.
			printf("<TABLE WIDTH='%s' BORDER='0'>", "100%");
			
			// Imprimimos la imagen y la descripci�n.
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
			
			// Mostramos el bot�n para regresar.
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
	 * M�todo donde se actualiza el n�mero de visitas de un sitio de inter�s.
	 *
	 * @param $id_sitio_interes El identificador del sitio de inter�s.
	 * @param $visitas El nuevo n�mero de visitas del sitio de inter�s.
	 */
	function actualizarVisitas($id_sitio_interes, $visitas)
	{
		// Consulta para actualizar las visitas del sitio de inter�s.
		$consulta = "UPDATE sitio_interes SET visitas_sitio_interes = $visitas WHERE id_sitio_interes = $id_sitio_interes";
		$resultado = mysql_query($consulta, $this->enlace);
	}
	
	/**
	 * M�todo que retorna el URL de un sitio de inter�s.
	 *
	 * @param $id_sitio_interes El identificador del sitio de inter�s.
	 *
	 * @return $url_sitio_interes El URL del sitio de inter�s.
	 */
	function url($id_sitio_interes)
	{
		// Consulta para obtener la URL del sitio de inter�s.
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