<?PHP
/**
 * publicacion.php.
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
 * Clase que administra las publicaciones que tiene la Biblioteca de la Escuela Ingeniería
 * en Computación. Las publicaciones corresponden a los libros, tesis y revistas.
 */

class publicacion
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Método constructor que incializa el enlace a la base de datos.
	 *
	 * @param $link Conexión hacia una base de datos que ya ha sido establecida.
	 */
	function publicacion($link)
	{
		$this->enlace = $link;			
	}
	
	/**
	 * Método que muestra el título de la sección 'Biblioteca IC'.
	 */
	function mostrarTitulo()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Infraestructura'>Infraestructura</A> / Biblioteca IC";
		$imagen = "activos/bgbiblioteca.jpg";
		$titulo = "Biblioteca IC";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra en forma paginada, las publicaciones de la Escuela.
	 *
	 * @param $pagina El número de la página dentro de la paginación total.
	 */
	function mostrar($pagina)
	{
		// Librerias necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "index.php?";
		$porpagina = 20;
		
		// Imprimimos algo de información sobre la Biblioteca si estamos en la primera página.
		if ($pagina == 1)
		{
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
			echo "<TR>";
			echo "<TD WIDTH='55%' VALIGN='TOP' CLASS='contenido'><P>La Biblioteca de la Escuela Ingenier&iacute;a en Computaci&oacute;n de la <A HREF='http://www.userena.cl' TARGET='_blank' TITLE='Visitar Web de Universidad de La Serena'>Universidad de La Serena</A> cuenta con:</P>";
			echo "<UL>";
			echo "<LI>Libros de apoyo</LI>";
			echo "<LI>Tesis de memoria</LI>";
			echo "<LI>Documentos de apoyo</LI>";
			echo "<LI>Revistas de publicaci&oacute;n cient&iacute;fica</LI>";
			echo "</UL>";
			echo "</TD>";
			echo "<TD WIDTH='45%' ALIGN='center' VALIGN='top'><IMG SRC='activos/logobiblioteca.jpg' WIDTH='200' HEIGHT='117'></TD>";
			echo "</TR>";
		}
		
		// Consulta que lista todas las publicaciones internas, ordenadas por titulo y año de publicación.
		$consulta = "SELECT id_publicacion, titulo_publicacion, anio_publicacion FROM publicacion WHERE id_ubicacion_publicacion = 1 ORDER BY titulo_publicacion, anio_publicacion";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay publicaciones.
		if ($total == 0)
		{
			echo "<TR>";
			echo "<TD COLSPAN='2' CLASS='contenido'>No hay publicaciones en la Biblioteca IC.</TD>";
			echo "</TR>";
		}
		// Cuando si hay publicaciones.
		else
		{
			if ($pagina == 1)
				echo "<TR>";
			
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Abrimos la tabla para el total, la paginación y las publicaciones.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total publicaciones en la Biblioteca IC.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para las publicaciones.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD WIDTH='70%' CLASS='titulotabla' ALIGN='center'>T&iacute;tulo</TD>";
			echo "<TD WIDTH='20%' CLASS='titulotabla' ALIGN='center'>Autor</TD>";
			echo "<TD WIDTH='10%' CLASS='titulotabla' ALIGN='center'>A&ntilde;o</TD>";
			echo "</TR>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos las publicaciones.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				printf("<TR>");
				
				// Mostramos el título.
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", strtr($tupla["titulo_publicacion"], $caracteres));
				
				// Mostramos los autores.
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $this->autores($tupla["id_publicacion"]));
				
				// Mostramos el año de publicación, si es que existe.
				if (isset($tupla["anio_publicacion"]))
					printf("<TD CLASS='tabla' VALIGN='top' ALIGN='center'>%d</TD>", $tupla["anio_publicacion"]);
				else printf("<TD CLASS='tabla'>&nbsp;</TD>");
				
				// Cerramos la fila.
				printf("</TR>");
			}
			// Cerramos la tabla de las publicaicones, la celda y la fila.
			echo "</TABLE>";
			echo "</TD>";
			echo "</TR>";
			
			if ($pagina == 1)
				echo "</TR>";
			
			// Imprimimos la paginación.			
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->Paginar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
		}
		echo "</TABLE>";
		
		// Liberación de memoria del servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda.
		require("busquedapublicacion.inc");
	}
	
	/**
	 * Método que retorna un string con los autores de una publicación.
	 *
	 * @param $id_publicacion El identificador de la publicación.
	 *
	 * @return $texto El string con los nombres de los autores de la publicación.
	 */
	function autores($id_publicacion)
	{
		// Texto en donde guardamos a los autores.
		$texto = "";
		
		// Query que muestra los autores de una publicacion.
		$consulta = "SELECT persona.nombres_persona, persona.paterno_persona FROM desarrollo_publicacion, persona WHERE desarrollo_publicacion.id_publicacion = $id_publicacion AND desarrollo_publicacion.id_persona = persona.id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$num_autores = mysql_num_rows($resultado);
		
		// Recorremos los autores para concadenarlos.
		while ($fila = mysql_fetch_array($resultado))
		{
			// Si hay un solo autor.
			if ($num_autores == 1)
				if (isset($fila["nombres_persona"]))
					$texto = $texto . $fila["nombres_persona"] . " " . $fila["paterno_persona"];
				else $texto = $texto . $fila["paterno_persona"];
			// Si hay más de un autor.
			else
			{
				if (isset($fila["nombres_persona"]))
					$texto = $texto . $fila["nombres_persona"] . " " . $fila["paterno_persona"] . " - " ;
				else $texto = $texto . $fila["paterno_persona"] . " - " ;
				$num_autores--;
			}
		}
		
		// Liberación de memoria en el servidor.
		mysql_free_result($resultado);
		
		// Devolvemos los autores.
		return $texto;
	}
	
	/**
	 * Método que muestra el título de la sección 'Búsqueda de Publicaciones'.
	 */
	function tituloBusqueda()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Infraestructura'>Infraestructura</A> / <A HREF='index.php?pagina=1' TITLE='Ver Biblioteca IC'>Biblioteca IC</A> / B&uacute;squeda";
		$imagen = "activos/bgbiblioteca.jpg";
		$titulo = "B&uacute;squeda de Publicaciones";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Metodo que busca publicaciones interas. Los resultados los muestra en forma paginada.
	 * La búsqueda se realiza en base a el título de la publicación.
	 *
	 * @param $titulo El título de la publicación.
	 * @param $pagina El número de la página dentro de la paginación total de búsqueda.
	 */
	function buscarSinFiltro($titulo, $pagina)
	{
		// Librerías necesarias
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "buscar.php?titulo=" . $titulo . "&";
		$porpagina = 20;
		
		// Consulta que obtiene todas las publicaciones internas que coincidan con el título.
		$consulta = "SELECT id_publicacion, titulo_publicacion, anio_publicacion FROM publicacion WHERE id_ubicacion_publicacion = 1 AND titulo_publicacion LIKE '%$titulo%' ORDER BY titulo_publicacion, anio_publicacion";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay publicaciones.
		if ($total == 0)
			echo "<P CLASS='contenido'>No se encontraron publicaciones.</P>";
		
		// Cuando si hay publicaciones.
		else
		{
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Abrimos la tabla para el total, la paginación y las publicaciones.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total publicaciones en la Biblioteca IC.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para la lista de publicaciones.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD WIDTH='70%' CLASS='titulotabla' ALIGN='center'>T&iacute;tulo</TD>";
			echo "<TD WIDTH='20%' CLASS='titulotabla' ALIGN='center'>Autor</TD>";
			echo "<TD WIDTH='10%' CLASS='titulotabla' ALIGN='center'>A&ntilde;o</TD>";
			echo "</TR>";
			
			// Calculamos la condición de término.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos las publicaciones.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				printf("<TR>");
				
				// Mostramos el título.
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", strtr($tupla["titulo_publicacion"], $caracteres));
				
				// Mostramos los autores.
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $this->autores($tupla["id_publicacion"]));
				
				// Mostramos el año de publicación, si es que existe.
				if ($tupla["anio_publicacion"] != NULL)
					printf("<TD CLASS='tabla' VALIGN='top' ALIGN='center'>%d</TD>", $tupla["anio_publicacion"]);
				else printf("<TD CLASS='tabla' VALIGN='top' ALIGN='center'>&nbsp;</TD>");
				
				printf("</TR>");
			}
			
			// Cerramos la tabla, la celda y la columna.
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
		
		// Liberación de memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda.
		require("busquedapublicacion.inc");
	}
	
	/**
	 * Método que realiza la búsqueda de publicaciones internas por título, autor y
	 * año de publicación.
	 *
	 * @param $titulo El titulo de la publicación.
	 * @param $autor El nombre o apellido del autor.
	 * @param $anio El año de publicación.
	 * @param $pagina El número de la página dentro de la paginación total de búsqueda.
	 */
	function buscarConFiltro($titulo, $autor, $anio, $pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "buscar.php?titulo=" . $titulo . "&autor=" . $autor . "&anio=" . $anio . "&filtro=1&";
		$porpagina = 20;
		
		// Consulta que busca las publicaciones por título, autor y año de publicación.
		$consulta = "SELECT publicacion.id_publicacion, publicacion.titulo_publicacion, publicacion.anio_publicacion FROM publicacion, desarrollo_publicacion, persona WHERE publicacion.id_ubicacion_publicacion = 1 AND publicacion.titulo_publicacion LIKE '%$titulo%' AND (persona.paterno_persona LIKE '%$autor%' OR persona.nombres_persona LIKE '%$autor%') AND publicacion.anio_publicacion LIKE '%$anio%' AND desarrollo_publicacion.id_publicacion = publicacion.id_publicacion AND desarrollo_publicacion.id_persona = persona.id_persona GROUP BY publicacion.id_publicacion ORDER BY titulo_publicacion, anio_publicacion";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay publicaciones.
		if ($total == 0)
			echo "<P CLASS='contenido'>No se encontraron publicaciones.</P>";
		
		// Cuando si hay publicaciones.
		else
		{
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Abrimos la tabla para el total, la paginación y el listado de publicaciones.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total publicaciones en la Biblioteca IC.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para la lista de libros.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD WIDTH='70%' CLASS='titulotabla' ALIGN='center'>T&iacute;tulo</TD>";
			echo "<TD WIDTH='20%' CLASS='titulotabla' ALIGN='center'>Autor</TD>";
			echo "<TD WIDTH='10%' CLASS='titulotabla' ALIGN='center'>A&ntilde;o</TD>";
			echo "</TR>";
			
			// Calculamos la condición de término.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos los resultados (libros).
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				printf("<TR>");
				
				// Mostramos el título.
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", strtr($tupla["titulo_publicacion"], $caracteres));
				
				// Mostramos el (los) autor (es).
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $this->autores($tupla["id_publicacion"]));
				
				// Mostramos el año de publicación, si es que existe.
				if ($tupla["anio_publicacion"] != NULL)
					printf("<TD CLASS='tabla' VALIGN='top' ALIGN='center'>%d</TD>", $tupla["anio_publicacion"]);
				else printf("<TD CLASS='tabla'>&nbsp;</TD>");
				
				printf("</TR>");
			}
			
			// Cerramos la tabla, al celda y la fila.
			echo "</TABLE>";
			echo "</TD>";
			echo "</TR>";
			
			// Imprimimos la paginación.			
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->Paginar($total, $pagina, $vinculo, $porpagina);
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "</TABLE>";
		}
		
		// Liberación de memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda.
		require("busquedapublicacion.inc");
	}
	
	/**
	 * Método que muestra el título de la sección 'Publicaciones' realizadas por gente de la Escuela.
	 */
	function tituloInternas()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Investigaci&oacute;n'>Investigaci&oacute;n</A> / Publicaciones";
		$imagen = "activos/bgpublicaciones.jpg";
		$titulo = "Publicaciones";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método muestra (en forma paginada) las publicaciones realizadas por gente de la Escuela.
	 *
	 * @param $pagina El número de la página actual dentro de la paginación total.
	 */
	function internas($pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "index.php?";
		$porpagina = 10;
		
		// Consulta que obtiene las publicaciones desarrolladas por gente de la Escuela, ordenadas por título y año de publicación
		$consulta = "SELECT publicacion.id_publicacion, publicacion.titulo_publicacion, publicacion.anio_publicacion FROM publicacion, desarrollo_publicacion, usuario_interno, persona WHERE usuario_interno.id_persona = desarrollo_publicacion.id_persona AND usuario_interno.id_persona = persona.id_persona AND desarrollo_publicacion.id_publicacion = publicacion.id_publicacion GROUP BY publicacion.id_publicacion ORDER BY titulo_publicacion, anio_publicacion";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay publicaciones.
		if ($total == 0)
			echo "<P CLASS='contenido'>No se encontraron publicaciones.</P>";
		
		// Cuando si hay publicaciones.
		else
		{
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Abrimos la tabla para el total, la paginación y el listado de publicaciones.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total publicaciones realizadas por gente de la Escuela.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para la lista de publicaciones.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='455' HEIGHT='5'></TD>";
			echo "</TR>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Imprimimos la lista de proyectos.					 
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				// Seleccionamos solo el número de registros indicados.
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Mostramos el título.
				printf("<TR>");
				printf("<TD WIDTH='%s' CLASS='encabezadotabla' VALIGN='top'>&nbsp;T&iacute;tulo:</TD>", "15%");
				printf("<TD WIDTH='%s' CLASS='tabla' VALIGN='top'><B>%s</B></TD>", "85%", strtr($tupla["titulo_publicacion"], $caracteres));
				printf("</TR>");
				
				// Mostramos el (los) autor (es).
				printf("<TR>");
				printf("<TD CLASS='encabezadotabla' VALIGN='top'>&nbsp;Autor:</TD>");
				printf("<TD CLASS='tabla' VALIGN='top'><B>%s</B></TD>", $this->autores($tupla["id_publicacion"]));
				printf("</TR>");
				
				// Mostramos el año de publicación, si es que existe.
				printf("<TR>");
				printf("<TD CLASS='encabezadotabla' VALIGN='top'>&nbsp;A&ntilde;o:</TD>");
				if ($tupla["anio_publicacion"] == NULL)
					printf("<TD CLASS='tabla'>&nbsp</TD>");
				else printf("<TD CLASS='tabla' VALIGN='top'>%d</TD>", $tupla["anio_publicacion"]);
				printf("</TR>");
				
				// Espacio entre medio.
				printf("<TR>");
				printf("<TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='455' HEIGHT='5'></TD>");
				printf("</TR>");
			}
			
			// Cerramos la tabla, la celda y la fila
			echo "</TABLE>";
			echo "</TD>";
			echo "</TR>";
			
			// Imprimimos la paginación de los resultados.
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD>&nbsp;</TD></TR>";
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda simple.
		$this->formularioBusqueda();
	}
	
	/**
	 * Método que muestra el formulario de búsqueda para las publicaciones internas.
	 */
	function formularioBusqueda()
	{
		$titulo = "B&uacute;squeda de Publicaciones";
		$ocultos = "";
		$comentario = "publicaciones";
		require("busquedasimple.inc");
	}
	
	/**
	 * Método que muestra el título de la sección 'Búsqueda de Publicaciones' realizadas
	 * por gente de la Escuela.
	 */
	function tituloBusquedaInternas()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Investigaci&oacute;n'>Investigaci&oacute;n</A> / <A HREF='index.php?pagina=1' TITLE='Ver Publicaciones'>Publicaciones</A> / B&uacute;squeda";
		$imagen = "activos/bgpublicaciones.jpg";
		$titulo = "B&uacute;squeda de Publicaciones";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método busca publicaciones internas que coincidan en el título o el autor y las muestra
	 * en forma paginada.
	 *
	 * @param $palabra La palabra o frase a buscar.
	 * @param $pagina El número de página dentro de la paginación total.
	 */
	function buscarInternas($palabra, $pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "index.php?";
		$porpagina = 10;
		
		// Consulta que obtiene las publicaciones desarrolladas por gente de la Escuela, ordenadas por
		// título y año de publicación.
		$consulta = "SELECT publicacion.id_publicacion, publicacion.titulo_publicacion, publicacion.anio_publicacion FROM publicacion, desarrollo_publicacion, usuario_interno, persona WHERE (publicacion.titulo_publicacion LIKE '%$palabra%' OR persona.nombres_persona LIKE '%$palabra%' OR persona.paterno_persona LIKE '%$palabra%' OR persona.materno_persona LIKE '%$palabra%') AND usuario_interno.id_persona = desarrollo_publicacion.id_persona AND usuario_interno.id_persona = persona.id_persona AND desarrollo_publicacion.id_publicacion = publicacion.id_publicacion GROUP BY publicacion.id_publicacion ORDER BY titulo_publicacion, anio_publicacion";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay publicaciones.
		if ($total == 0)
			echo "<P CLASS='contenido'>No se encontraron publicaciones.</P>";
		
		// Cuando si hay publicaciones.
		else
		{
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Abrimos la tabla para el total, la paginación y el listado de publicaciones.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total publicaciones realizadas por gente de la Escuela.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para la lista de publicaciones.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='455' HEIGHT='5'></TD>";
			echo "</TR>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Imprimimos la lista de proyectos.					 
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				// Seleccionamos solo el número de registros indicados.
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Mostramos el título.
				printf("<TR>");
				printf("<TD WIDTH='%s' CLASS='encabezadotabla' VALIGN='top'>&nbsp;T&iacute;tulo:</TD>", "15%");
				printf("<TD WIDTH='%s' CLASS='tabla' VALIGN='top'><B>%s</B></TD>", "85%", strtr($tupla["titulo_publicacion"], $caracteres));
				printf("</TR>");
				
				// Mostramos el (los) autor (es).
				printf("<TR>");
				printf("<TD CLASS='encabezadotabla' VALIGN='top'>&nbsp;Autor:</TD>");
				printf("<TD CLASS='tabla' VALIGN='top'><B>%s</B></TD>", $this->autores($tupla["id_publicacion"]));
				printf("</TR>");
				
				// Mostramos el año de publicación, si es que existe.
				printf("<TR>");
				printf("<TD CLASS='encabezadotabla' VALIGN='top'>&nbsp;A&ntilde;o:</TD>");
				if ($tupla["anio_publicacion"] == NULL)
					printf("<TD CLASS='tabla'>&nbsp</TD>");
				else printf("<TD CLASS='tabla' VALIGN='top'>%d</TD>", $tupla["anio_publicacion"]);
				printf("</TR>");
				
				// Espacio entre medio.
				printf("<TR>");
				printf("<TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='455' HEIGHT='5'></TD>");
				printf("</TR>");
			}
			
			// Cerramos la tabla, la celda y la fila.
			echo "</TABLE>";
			echo "</TD>";
			echo "</TR>";
			
			// Imprimimos la paginación de los resultados.
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD>&nbsp;</TD></TR>";
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda simple.
		$this->formularioBusqueda();
	}
	
	/**
	 * Método que muestra el formulario para agregar una nueva publicación.
	 *
	 * @param $id_persona El identificador de la persona.
	 */
	function formularioAgregar($id_persona)
	{
		// Librerías necesarias.
		include("tipopublicacion.php");
		include("empresa.php");
		
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Tabla en donde incorporamos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Agregar Publicaci&oacute;n</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>";
		echo "<TABLE WIDTH='100%' BORDER='1' CELLPADDING='0' CELLSPACING='0' BORDERCOLOR='#F1F1F1' MM_NOCONVERT='TRUE' BGCOLOR='#FFFFFF'>";
		echo "<TR>";
		echo "<TD>";
		echo "<FORM ACTION='grabar.php' METHOD='post' NAME='formulario' onSubmit='return validarFormulario();'>";
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>T&iacute;tulo:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' TITLE='T&iacute;tulo de la publicaci&oacute;n'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Publicaci&oacute;n:</TD>";
		echo "<TD>";
		$tipo_publicacion = new tipopublicacion($this->enlace);
		$tipo_publicacion->select(1);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Editorial:</TD>";
		echo "<TD>";
		$empresa = new empresa($this->enlace);
		$empresa->selectEditoriales(-1, false);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>A&ntilde;o de Publicaci&oacute;n:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='anio' CLASS='formtextfield' MAXLENGTH='4' TABINDEX='1' TITLE='A&ntilde;o de publicaci&oacute;n'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>Incorporar a la Biblioteca IC: <INPUT TYPE='radio' NAME='en_biblioteca' VALUE='1' TABINDEX='1' CHECKED>Si <INPUT TYPE='radio' NAME='en_biblioteca' VALUE='0' TABINDEX='1'>No</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido'>&nbsp;<FONT COLOR='#CC0000'>*</FONT> Datos obligatorios</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='agregar' VALUE='Agregar' CLASS='formbutton' TABINDEX='1' TITLE='Agregar la publicaci&oacute;n'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
		echo "</TR>";
		echo "</TABLE>";
		echo "</FORM>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
	}
	
	/**
	 * Método que agrega una nueva publicación a la base de datos.
	 *
	 * @param $titulo_publicacion El título de la publicación.
	 * @param $id_persona El identificador de la persona.
	 * @param $id_tipo_publicacion El identificador del tipo de publicación.
	 * @param $id_empresa El identificador de la empresa.
	 * @param $anio_publicacion El año de la publicación.
	 * @param $en_biblioteca Si la publicación está o no en la Biblioteca IC.
	 */
	function agregar($titulo_publicacion, $id_persona, $id_tipo_publicacion, $id_empresa, $anio_publicacion, $en_biblioteca)
	{
		// Establecemos la identificación del tipo de ubicación de la publicación a agregar.
		if ($en_biblioteca == 1)
			$id_ubicacion_publicacion = 1;
		else $id_ubicacion_publicacion = 2;
		
		// Consulta para agregar la publicación a la base de datos.
		$consulta = "INSERT INTO publicacion(id_tipo_publicacion, id_ubicacion_publicacion, titulo_publicacion, anio_publicacion) VALUES($id_tipo_publicacion, $id_ubicacion_publicacion, '$titulo_publicacion', $anio_publicacion)";
		mysql_query($consulta, $this->enlace);
		
		// Obtener el identificador de la última inserción efectuada.
		$id_publicacion = mysql_insert_id();
		
		// Consulta para agregar la nueva publicación a la tabla 'desarrollo_publicacion'.
		$consulta = "INSERT INTO desarrollo_publicacion(id_persona, id_publicacion) VALUES($id_persona, $id_publicacion)";
		mysql_query($consulta, $this->enlace);
		
		// Cuando la publicación no es tesis, si tiene editorial.
		if ($id_tipo_publicacion != 2)
			$consulta = "INSERT INTO libro(id_publicacion, id_empresa) VALUES($id_publicacion, $id_empresa)";
		
		// Cuando la publicación es tesis, no tiene editorial.
		else $consulta = "INSERT INTO libro(id_publicacion) VALUES($id_publicacion)";
		
		// Efectuamos la consulta.
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de éxito de la operación.
		echo "<P ALIGN='center' CLASS='contenido'><B>TU PUBLICACION HA SIDO AGREGADA EXITOSAMENTE</B></P>";
		echo "<P CLASS='contenido'>Esta publicaci&oacute;n ha sido incorporada a tus antecedentes, por lo que se convertir&aacute; en un indicador clave de tus l&iacute;neas de investigaci&oacute;n. Adem&aacute;s se convertir&aacute; en un importante referente para las l&iacute;neas de investigaci&oacute;n de nuestra Escuela. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
	
	/**
	 * Método que lista todas las publicaciones realizadas por un usuario.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $vinculo El enlace a la página destino.
	 */
	function listar($id_persona, $vinculo)
	{
		// Consulta que obtiene el nombre del usuario con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE persona.id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$usuario = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
		mysql_free_result($resultado);
		
		// Consulta para obtener las publicaciones realizadas por el usuario.
		$consulta = "SELECT publicacion.id_publicacion, publicacion.titulo_publicacion, tipo_publicacion.desc_tipo_publicacion, publicacion.anio_publicacion, publicacion.id_ubicacion_publicacion FROM publicacion, tipo_publicacion, desarrollo_publicacion WHERE desarrollo_publicacion.id_persona = $id_persona AND desarrollo_publicacion.id_publicacion = publicacion.id_publicacion AND publicacion.id_tipo_publicacion = tipo_publicacion.id_tipo_publicacion GROUP BY publicacion.id_publicacion ORDER BY publicacion.titulo_publicacion";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);		
		
		// Cuando no hay publicaciones.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay publicaciones realizadas por $usuario.</P>";
		
		// Cuando si hay publicaciones.
		else
		{
			// Tabla en donde mostramos la lista de publicaciones.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='5' CLASS='contenido'>Hay un total de $total publicaciones relizadas por $usuario:</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'>&nbsp;</TD>";
			echo "<TD WIDTH='48%' ALIGN='center' CLASS='titulotabla'><B>T&iacute;tulo</B></TD>";
			echo "<TD WIDTH='22%' ALIGN='center' CLASS='titulotabla'><B>Tipo</B></TD>";
			echo "<TD WIDTH='5%' ALIGN='center' CLASS='titulotabla'><B>A&ntilde;o</B></TD>";
			echo "<TD WIDTH='15%' ALIGN='center' CLASS='titulotabla'><B>En Biblioteca IC</B></TD>";
			echo "</TR>";
			
			// Texto para enlazar a la operación.
			if ($vinculo == "modificar.php")
				$texto_vinculo = "Modificar";
			else $texto_vinculo = "Eliminar";
			
			// Imprimimos la lista de publicaciones.
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				printf("<TD VALIGN='top' ALIGN='center' CLASS='tabla'><A HREF='$vinculo?id=%s' TITLE='%s Publicaci&oacute;n'>%s</A></TD>", $tupla["id_publicacion"], $texto_vinculo, $texto_vinculo);
				printf("<TD VALIGN='top' CLASS='tabla'>%s</TD>", $tupla["titulo_publicacion"]);
				printf("<TD VALIGN='top' ALIGN='center' CLASS='tabla'>%s</TD>", $tupla["desc_tipo_publicacion"]);
				printf("<TD VALIGN='top' ALIGN='center' CLASS='tabla'>%s</TD>", $tupla["anio_publicacion"]);
				if ($tupla["id_ubicacion_publicacion"] == 1)
					printf("<TD VALIGN='top' ALIGN='center' CLASS='tabla'>Si</TD>");
				else printf("<TD VALIGN='top' ALIGN='center' CLASS='tabla'>No</TD>");
				printf("</TR>");
			}
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);	
	}
	
	/**
	 * Método que muestra el formulario para modificar una publicación.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_publicacion El identificador de la publicación.
	 */
	function formularioModificar($id_persona, $id_publicacion)
	{
		// Librerías necesarias.
		include("tipopublicacion.php");
		include("empresa.php");
		
		// Consulta para obtener los datos de la publicación con identificación conocida.
		$consulta = "SELECT publicacion.id_tipo_publicacion, publicacion.id_ubicacion_publicacion, publicacion.titulo_publicacion, publicacion.anio_publicacion, persona.nombres_persona, persona.paterno_persona, persona.materno_persona FROM publicacion, desarrollo_publicacion, persona WHERE publicacion.id_publicacion = $id_publicacion AND desarrollo_publicacion.id_persona = $id_persona AND desarrollo_publicacion.id_publicacion = publicacion.id_publicacion AND desarrollo_publicacion.id_persona = persona.id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Tabla en donde imprimimos el formulario de modificación.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Modificar Publicaci&oacute;n</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>";
		echo "<TABLE WIDTH='100%' BORDER='1' CELLPADDING='0' CELLSPACING='0' BORDERCOLOR='#F1F1F1' MM_NOCONVERT='TRUE' BGCOLOR='#FFFFFF'>";
		echo "<TR>";
		echo "<TD>";
		echo "<FORM ACTION='grabar.php' METHOD='post' NAME='formulario' onSubmit='return validarFormulario();'>";
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>T&iacute;tulo:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' VALUE='" . $tupla["titulo_publicacion"] . "' TITLE='T&iacute;tulo de la publicaci&oacute;n'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Publicaci&oacute;n:</TD>";
		echo "<TD>";
		$tipo_publicacion = new tipopublicacion($this->enlace);
		$tipo_publicacion->select($tupla["id_tipo_publicacion"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Editorial:</TD>";
		echo "<TD>";
		$empresa = new empresa($this->enlace);
		if ($tupla["id_tipo_publicacion"] != 2)
		{
			// Consulta para obtener los datos de la empresa realizadora de la publicación.
			$consulta = "SELECT empresa.id_empresa FROM libro, empresa WHERE libro.id_publicacion = $id_publicacion AND libro.id_empresa = empresa.id_empresa";
			$empresas = mysql_query($consulta, $this->enlace);
			$fila = mysql_fetch_array($empresas);
			$empresa->selectEditoriales($fila["id_empresa"], false);
			mysql_free_result($empresas);
		}
		else $empresa->selectEditoriales(-1, true);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>A&ntilde;o de Publicaci&oacute;n:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='anio' CLASS='formtextfield' MAXLENGTH='4' TABINDEX='1' VALUE='" . $tupla["anio_publicacion"] . "' TITLE='A&ntilde;o de publicaci&oacute;n'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>Incorporar a la Biblioteca IC: ";
		if ($tupla["id_ubicacion_publicacion"] == 1)
		{
			echo "<INPUT TYPE='radio' NAME='en_biblioteca' VALUE='1' TABINDEX='1' CHECKED>Si ";
			echo "<INPUT TYPE='radio' NAME='en_biblioteca' VALUE='0' TABINDEX='1'>No";
		}
		else
		{
			echo "<INPUT TYPE='radio' NAME='en_biblioteca' VALUE='1' TABINDEX='1'>Si ";
			echo "<INPUT TYPE='radio' NAME='en_biblioteca' VALUE='0' TABINDEX='1' CHECKED>No";
		}
		echo "</TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido'>&nbsp;<FONT COLOR='#CC0000'>*</FONT> Datos obligatorios</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_publicacion' VALUE='$id_publicacion'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar la publicaci&oacute;n'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
		echo "</TR>";
		echo "</TABLE>";
		echo "</FORM>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
	}
	
	/**
	 * Método que modifica una publicación de la base de datos.
	 *
	 * @param $id_publicacion El identificador de la publicación.
	 * @param $titulo_publicacion El título de la publicación.
	 * @param $id_tipo_publicacion El identificador del tipo de publicación.
	 * @param $id_empresa El identificador de la empresa.
	 * @param $anio_publicacion El año de la publicación.
	 * @param $en_biblioteca Si la publicación está o no en la biblioteca.
	 */
	function modificar($id_publicacion, $titulo_publicacion, $id_tipo_publicacion, $id_empresa, $anio_publicacion, $en_biblioteca)
	{
		// Establecemos la identificación del tipo de ubicación de la publicación a modificar.
		if ($en_biblioteca == 1)
			$id_ubicacion_publicacion = 1;
		else $id_ubicacion_publicacion = 2;
		
		// Consulta para modificar la publicación en la base de datos.
		$consulta = "UPDATE publicacion SET id_tipo_publicacion = $id_tipo_publicacion, id_ubicacion_publicacion = $id_ubicacion_publicacion, titulo_publicacion = '$titulo_publicacion', anio_publicacion = $anio_publicacion WHERE id_publicacion = $id_publicacion";
		mysql_query($consulta, $this->enlace);
		
		// Modificamos la tabla 'libro' en la base de datos.
		$update = "UPDATE libro ";
		// Cuando la publicación no es tesis, si tiene editorial.
		if ($id_tipo_publicacion != 2)
			$set = "SET id_empresa = $id_empresa ";
		// Cuando la publicación es tesis, no tiene editorial.
		else $set = "SET id_empresa = NULL ";
		$where = "WHERE id_publicacion = $id_publicacion";
		$consulta = $update . $set . $where;
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de éxito de la operación.
		echo "<P ALIGN='center' CLASS='contenido'><B>TU PUBLICACION HA SIDO MODIFICADA EXITOSAMENTE</B></P>";
		echo "<P CLASS='contenido'>Los datos de esta publicaci&oacute;n han sido modificados, por lo que tus antecedentes como docentes han cambiado. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
	
	/**
	 * Método que muestra el formulario para eliminar una publicación.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_publicacion El identificador de la publicación.
	 */
	function formularioEliminar($id_persona, $id_publicacion)
	{
		// Librerías necesarias.
		include("tipopublicacion.php");
		include("empresa.php");
		
		// Consulta para obtener los datos de la publicación con identificación conocida.
		$consulta = "SELECT publicacion.id_tipo_publicacion, publicacion.id_ubicacion_publicacion, publicacion.titulo_publicacion, publicacion.anio_publicacion, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, tipo_publicacion.desc_tipo_publicacion FROM publicacion, desarrollo_publicacion, persona, tipo_publicacion WHERE publicacion.id_publicacion = $id_publicacion AND desarrollo_publicacion.id_persona = $id_persona AND desarrollo_publicacion.id_publicacion = publicacion.id_publicacion AND desarrollo_publicacion.id_persona = persona.id_persona AND publicacion.id_tipo_publicacion = tipo_publicacion.id_tipo_publicacion";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Tabla para mostrar el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Eliminar Publicaci&oacute;n</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>";
		echo "<TABLE WIDTH='100%' BORDER='1' CELLPADDING='0' CELLSPACING='0' BORDERCOLOR='#F1F1F1' MM_NOCONVERT='TRUE' BGCOLOR='#FFFFFF'>";
		echo "<TR>";
		echo "<TD>";
		echo "<FORM ACTION='grabar.php' METHOD='post' NAME='formulario'>";
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>T&iacute;tulo:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["titulo_publicacion"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Publicaci&oacute;n:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='tipo_publicacion' CLASS='formtextfield' DISABLED='true' MAXLENGTH='25' VALUE='" . $tupla["desc_tipo_publicacion"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Editorial:</TD>";
		echo "<TD>";
		if ($tupla["id_tipo_publicacion"] != 2)
		{
			// Consulta para obtener los datos de la empresa realizadora de la publicación.
			$consulta = "SELECT empresa.nombre_empresa FROM libro, empresa WHERE libro.id_publicacion = $id_publicacion AND libro.id_empresa = empresa.id_empresa";
			$empresas = mysql_query($consulta, $this->enlace);
			$fila = mysql_fetch_array($empresas);
			echo "<INPUT TYPE='text' NAME='empresa' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $fila["nombre_empresa"] . "'>";
			mysql_free_result($empresas);
		}
		else echo "<INPUT TYPE='text' NAME='empresa' CLASS='formtextfield' DISABLED='true'>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>A&ntilde;o de Publicaci&oacute;n:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='anio' CLASS='formtextfield' DISABLED='true' MAXLENGTH='4' VALUE='" . $tupla["anio_publicacion"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>Incorporado a la Biblioteca IC: ";
		if ($tupla["id_ubicacion_publicacion"] == 1)
			echo "Si";
		else echo "No";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>¿Confirma que deseas eliminar esta publicaci&oacute;n?</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='confirmar' CHECKED='true' VALUE='1'>Si<BR><INPUT TYPE='radio' NAME='confirmar' VALUE='0'>No</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_publicacion' VALUE='$id_publicacion'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='aceptar' VALUE='Aceptar' CLASS='formbutton' TABINDEX='1' TITLE='Aceptar'></TD>";
		echo "</TR>";
		echo "</TABLE>";
		echo "</FORM>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
	}
	
	/**
	 * Método que elimina la publicación de la base de datos.
	 *
	 * @param $id_publicacion El identificador de la publicación.
	 * @param $confirmar Si el usuario confirma o no la eliminación de la publicación.
	 */
	function eliminar($id_publicacion, $id_persona, $confirmar)
	{
		// Cuando hay que eliminar la publicación.
		if ($confirmar == 1)
		{
			// Consulta para borrar el registro en la tabla 'bibliografia'.
			$consulta = "DELETE FROM bibliografia WHERE id_publicacion = $id_publicacion AND id_persona = $id_persona";
			mysql_query($consulta, $this->enlace);
			
			// Consulta para borrar el registro en la tabla 'libro'
			$consulta = "DELETE FROM libro WHERE id_publicacion = $id_publicacion";
			mysql_query($consulta, $this->enlace);
			
			// Consulta para borrar el registro en la tabla 'desarrollo_publicacion'
			$consulta = "DELETE FROM desarrollo_publicacion WHERE id_publicacion = $id_publicacion";
			mysql_query($consulta, $this->enlace);
			
			// Consulta para borrar el registro en la tabla 'publicacion'
			$consulta = "DELETE FROM publicacion WHERE id_publicacion = $id_publicacion";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos el mesaje de éxito de la operación.
			echo "<P ALIGN='center' CLASS='contenido'><B>TU PUBLICACION HA SIDO ELIMINADA EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Esta publicaci&oacute;n ha sido eliminada de tus antecedentes docentes y de la secci&oacute;n \"L&iacute;neas de Investigaci&oacute;n\" en nuestro sitio Web. Gracias por colaborar con nosotros.</P>";
		}
		// Cuando no hay que eliminar la publicación.
		else
		{
			echo "<P ALIGN='center' CLASS='contenido'><B>LA ELIMINACION DE TU PUBLICACION HA SIDO CANCELADA</B></P>";
			echo "<P CLASS='contenido'>Esta publicaci&oacute;n no ha sido eliminada de tus antecedentes docentes y de la secci&oacute;n \"L&iacute;neas de Investigaci&oacute;n\" en nuestro sitio Web, por lo que cualquier persona de Chile y el mundo la puede seguir viendo. Gracias por colaborar con nosotros.</P>";
		}
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
	
	/**
	 * Método que muestra el formulario para agregar una nueva publicación a la
	 * Biblioteca IC.
	 */
	function formularioAgregarBiblioteca()
	{
		// Librerías necesarias.
		include("tipopublicacion.php");
		include("empresa.php");
		
		// Tabla para incorporar el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Agregar Publicaci&oacute;n en Biblioteca IC</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>";
		echo "<TABLE WIDTH='100%' BORDER='1' CELLPADDING='0' CELLSPACING='0' BORDERCOLOR='#F1F1F1' MM_NOCONVERT='TRUE' BGCOLOR='#FFFFFF'>";
		echo "<TR>";
		echo "<TD>";
		echo "<FORM ACTION='grabar.php' METHOD='post' NAME='formulario' onSubmit='return validarFormulario();'>";
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='contenido' COLSPAN='2' ALIGN='center'>&nbsp;<B>Datos de la Publicaci&oacute;n</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";						
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>T&iacute;tulo:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' TITLE='T&iacute;tulo de la publicaci&oacute;n'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Publicaci&oacute;n:</TD>";
		echo "<TD>";
		$tipo_publicacion = new tipopublicacion($this->enlace);
		$tipo_publicacion->select(1);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Editorial:</TD>";
		echo "<TD>";
		$empresa = new empresa($this->enlace);
		$empresa->selectEditoriales(-1, false);
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>A&ntilde;o de Publicaci&oacute;n:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='anio' CLASS='formtextfield' MAXLENGTH='4' TABINDEX='1' TITLE='A&ntilde;o de publicaci&oacute;n'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='contenido' COLSPAN='2' ALIGN='center'>&nbsp;<B>Datos del Autor</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Nombres:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='nombres' CLASS='formtextfield' MAXLENGTH='50' TABINDEX='1' TITLE='Primer y segundo nombre'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>Apellido Paterno:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='paterno' CLASS='formtextfield' MAXLENGTH='25' TABINDEX='1' TITLE='Apellido paterno'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Apellido Materno:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='materno' CLASS='formtextfield' MAXLENGTH='25' TABINDEX='1' TITLE='Apellido Materno'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>E-mail:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='email' CLASS='formtextfield' MAXLENGTH='50' TABINDEX='1' TITLE='Correo electr&oacute;nico'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido'>&nbsp;<FONT COLOR='#CC0000'>*</FONT> Datos obligatorios</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='agregar' VALUE='Agregar' CLASS='formbutton' TABINDEX='1' TITLE='Agregar la publicaci&oacute;n a la Biblioteca IC'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
		echo "</TR>";
		echo "</TABLE>";
		echo "</FORM>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
	}	
	
	/**
	 * Método que agrega una nueva publicación a la Biblioteca IC de la base de datos.
	 *
	 * @param $titulo_publicacion El título de la publicación.
	 * @param $id_tipo_publicacion El identificador del tipo de publicación.
	 * @para $id_empresa El identificador de la empresa.
	 * @param $anio_publicacion El año de publicación.
	 * @param $nombres El primer y segundo nombre del autor.
	 * @param $paterno El apellido paterno del autor.
	 * @param $materno El apellido materno del autor.
	 * @param $email El correo electrónico del autor.
	 */
	function agregarBiblioteca($titulo_publicacion, $id_tipo_publicacion, $id_empresa, $anio_publicacion, $nombres, $paterno, $materno, $email)
	{
		// Librerías necesarias.
		include("persona.php");
		
		// Creamos un objeto persona y buscamos a una persona registrada (distinta) con el mismo e-mail.
		$persona = new persona($this->enlace);
		
		// Cuando el e-mail no cincide con el nombre de la persona.
		if ($persona->coincidir($email, $nombres, $paterno, $materno) == 0)
		{
			$email = strtr($email, get_html_translation_table(HTML_SPECIALCHARS));
			echo "<P ALIGN='center' CLASS='contenido'><B>NO SE PUEDE INGRESAR LOS DATOS</B></P>";
			echo "<P CLASS='contenido'>El e-mail <B>$email</B> est&aacute; siendo usado por otro usuario dentro de este Sitio Web. Por favor vuelve a ingresar los datos y cambia el e-mail que ingresaste anteriormente.</P>";
			echo "<DIV ALIGN='center'><A HREF=\"javascript:history.back(1);\" TITLE='Atr&aacute;s al formulario'><IMG SRC='../../../../librerias/btatras.gif' BORDER='0'></A></DIV>";
			exit(0);
		}
		// Cuando el e-mail coincide con el nombre de la persona.
		else
		{
			// Obtenemos el identificador de la persona.
			if (isset($email) && $email != "")
				$id_persona = $persona->buscar($email);
			else $id_persona = $persona->encontrar($nombres, $paterno, $materno);
			
			// Agregamos la persona, si no existe.
			if ($id_persona == 0)
				$id_persona = $persona->agregar($nombres, $paterno, $materno, $email);
			
			// Consulta para agregar la publicación a la base de datos.
			$consulta = "INSERT INTO publicacion(id_tipo_publicacion, id_ubicacion_publicacion, titulo_publicacion, anio_publicacion) VALUES($id_tipo_publicacion, 1, '$titulo_publicacion', $anio_publicacion)";
			mysql_query($consulta, $this->enlace);
			
			// Obtener la identificación de la última inserción efectuada en la tabla 'publicacion'.
			$id_publicacion = mysql_insert_id();		
			
			// Consulta para agregar la publicación en la tabla 'libro'.
			// Cuando la publicación no es tesis, si tiene editorial.
			if ($id_tipo_publicacion != 2)
				$consulta = "INSERT INTO libro(id_publicacion, id_empresa) VALUES($id_publicacion, $id_empresa)";
			
			// Cuando la publicación es tesis, no tiene editorial.
			else $consulta = "INSERT INTO libro(id_publicacion) VALUES($id_publicacion)";
			mysql_query($query, $this->enlace);						
			
			// Consulta para agregar el registro en la tabla 'desarrollo_publicacion'.
			$consulta = "INSERT INTO desarrollo_publicacion(id_persona, id_publicacion) VALUES($id_persona, $id_publicacion)";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos los mesajes de éxito de la operación.
			echo "<P ALIGN='center' CLASS='contenido'><B>LA PUBLICACION HA SIDO AGREGADA EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Esta publicaci&oacute;n ha sido incorporada a la Biblioteca IC. Gracias por colaborar con nosotros.</P>";
			echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
		}
	}
	
	/**
	 * Método que lista todas las publicaciones de la Biblioteca IC.
	 *
	 * @param $vinculo La página destino de la operación.
	 */
	function listarBiblioteca($vinculo)
	{
		// Consulta para obtener las publicaciones realizadas por el usuario.
		$consulta = "SELECT publicacion.id_publicacion, publicacion.titulo_publicacion, tipo_publicacion.desc_tipo_publicacion, publicacion.anio_publicacion, desarrollo_publicacion.id_persona FROM publicacion, tipo_publicacion, desarrollo_publicacion WHERE desarrollo_publicacion.id_publicacion = publicacion.id_publicacion AND publicacion.id_tipo_publicacion = tipo_publicacion.id_tipo_publicacion AND publicacion.id_ubicacion_publicacion = 1 GROUP BY publicacion.id_publicacion ORDER BY publicacion.titulo_publicacion";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);		
		
		// Cuando no hay publicaciones.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay publicaciones en la Biblioteca IC.</P>";
		
		// Cuando si hay publicaciones.
		else
		{
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='5' CLASS='contenido'>Hay un total de $total publicaciones en la Biblioteca IC:</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'>&nbsp;</TD>";
			echo "<TD WIDTH='48%' ALIGN='center' CLASS='titulotabla'><B>T&iacute;tulo</B></TD>";
			echo "<TD WIDTH='22%' ALIGN='center' CLASS='titulotabla'><B>Tipo</B></TD>";
			echo "<TD WIDTH='5%' ALIGN='center' CLASS='titulotabla'><B>A&ntilde;o</B></TD>";
			echo "</TR>";
			
			// Texto para enlazar a la operación.
			if ($vinculo == "modificar.php")
				$texto_vinculo = "Modificar";
			else $texto_vinculo = "Eliminar";
			
			// Imprimimos la lista de publicaciones.
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				printf("<TD VALIGN='top' ALIGN='center' CLASS='tabla'><A HREF='$vinculo?id=%d' TITLE='%s Publicaci&oacute;n'>%s</A></TD>", $tupla["id_publicacion"], $texto_vinculo, $texto_vinculo);
				printf("<TD VALIGN='top' CLASS='tabla'>%s</TD>", $tupla["titulo_publicacion"]);
				printf("<TD VALIGN='top' ALIGN='center' CLASS='tabla'>%s</TD>", $tupla["desc_tipo_publicacion"]);
				printf("<TD VALIGN='top' ALIGN='center' CLASS='tabla'>%s</TD>", $tupla["anio_publicacion"]);
				printf("</TR>");
			}
			echo "</TABLE>";
		}
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);	
	}
	
	/**
	 * Método que muestra el formulario para modificar una publicación de la Biblioteca IC.
	 */
	function formularioModificarBiblioteca($id_publicacion)
	{
		// Librerías necesarias.
		include("tipopublicacion.php");
		include("empresa.php");
		
		// Consulta para obtener los datos de la publicación con identificación conocida.
		$consulta = "SELECT publicacion.id_publicacion, publicacion.id_tipo_publicacion, publicacion.titulo_publicacion, publicacion.anio_publicacion, persona.id_persona, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona FROM publicacion, desarrollo_publicacion, persona WHERE publicacion.id_publicacion = $id_publicacion AND desarrollo_publicacion.id_publicacion = publicacion.id_publicacion AND desarrollo_publicacion.id_persona = persona.id_persona AND publicacion.id_ubicacion_publicacion = 1 GROUP BY publicacion.id_publicacion";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Tabla en donde incorporamos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Modificar Publicaci&oacute;n en Biblioteca IC</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>";
		echo "<TABLE WIDTH='100%' BORDER='1' CELLPADDING='0' CELLSPACING='0' BORDERCOLOR='#F1F1F1' MM_NOCONVERT='TRUE' BGCOLOR='#FFFFFF'>";
		echo "<TR>";
		echo "<TD>";
		echo "<FORM ACTION='grabar.php' METHOD='post' NAME='formulario' onSubmit='return validarFormulario();'>";
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>&nbsp;<B>Datos de la Publicaci&oacute;n</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";						
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>T&iacute;tulo:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' VALUE='" . $tupla["titulo_publicacion"] . "' MAXLENGTH='100' TABINDEX='1' TITLE='T&iacute;tulo de la publicaci&oacute;n'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Publicaci&oacute;n:</TD>";
		echo "<TD>";
		$tipo_publicacion = new tipopublicacion($this->enlace);
		$tipo_publicacion->select($tupla["id_tipo_publicacion"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Editorial:</TD>";
		echo "<TD>";
		$empresa = new empresa($this->enlace);
		if ($tupla["id_tipo_publicacion"] != 2)
		{
			// Consulta para obtener los datos de la empresa realizadora de la publicación.
			$select = "SELECT empresa.id_empresa FROM libro, empresa WHERE libro.id_publicacion = $id_publicacion AND libro.id_empresa = empresa.id_empresa";
			$empresas = mysql_query($consulta, $this->enlace);
			$fila = mysql_fetch_array($empresas);
			$empresa->selectEditoriales($fila["id_empresa"], false);
			mysql_free_result($empresas);
		}
		else $empresa->selectEditoriales(-1, true);
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>A&ntilde;o de Publicaci&oacute;n:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='anio' CLASS='formtextfield' VALUE='" . $tupla["anio_publicacion"] . "' MAXLENGTH='4' TABINDEX='1' TITLE='A&ntilde;o de publicaci&oacute;n'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>&nbsp;<B>Datos del Autor</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Nombres:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='nombres' CLASS='formtextfield' VALUE='" . $tupla["nombres_persona"] . "' MAXLENGTH='50' TABINDEX='1' TITLE='Primer y segundo nombre'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>Apellido Paterno:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='paterno' CLASS='formtextfield' VALUE='" . $tupla["paterno_persona"] . "' MAXLENGTH='25' TABINDEX='1' TITLE='Apellido paterno'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Apellido Materno:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='materno' CLASS='formtextfield' VALUE='" . $tupla["materno_persona"] . "' MAXLENGTH='25' TABINDEX='1' TITLE='Apellido materno'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>E-mail:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='email' CLASS='formtextfield' VALUE='" . $tupla["email_persona"] . "' MAXLENGTH='50' TABINDEX='1' TITLE='Correo electr&oacute;nico'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_publicacion' VALUE='$id_publicacion'><INPUT TYPE='hidden' NAME='id_persona' VALUE='" . $tupla["id_persona"] ."'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido'>&nbsp;<FONT COLOR='#CC0000'>*</FONT> Datos obligatorios</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar la publicaci&oacute;n'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
		echo "</TR>";
		echo "</TABLE>";
		echo "</FORM>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";		
	}
	
	/**
	 * Método que modifica una publicación del Biblioteca IC de la base de datos.
	 *
	 * @param $id_publicacion El identificador de la publicación.
	 * @param $titulo_publicacion El título de la publicación.
	 * @param $id_tipo_publicacion El identificador del tipo de publicación.
	 * @para $id_empresa El identificador de la empresa.
	 * @param $anio_publicacion El año de publicación.
	 * @param $id_persona El identificador de la persona.
	 * @param $nombres El primer y segundo nombre del autor.
	 * @param $paterno El apellido paterno del autor.
	 * @param $materno El apellido materno del autor.
	 * @param $email El correo electrónico del autor.
	 */
	function modificarBiblioteca($id_publicacion, $titulo_publicacion, $id_tipo_publicacion, $id_empresa, $anio_publicacion, $id_persona, $nombres, $paterno, $materno, $email)
	{
		// Cuando el e-mail si existe.
		if ($email != "")
		{
			// Librerías necesarias.
			include("persona.php");
			
			// Creamos un objeto persona y buscamos a una persona registrada (distinta) con el mismo e-mail
			$persona = new persona($this->enlace);
			
			// Cuando el e-mail no cincide con el nombre de la persona.
			if ($persona->coincidir($email, $nombres, $paterno, $materno) == 0)
			{
				$email = strtr($email, get_html_translation_table(HTML_SPECIALCHARS));
				echo "<P ALIGN='center' CLASS='contenido'><B>NO SE PUEDE INGRESAR LOS DATOS</B></P>";
				echo "<P CLASS='contenido'>El e-mail <B>$email</B> est&aacute; siendo usado por otro usuario dentro de este Sitio Web. Por favor vuelve a ingresar los datos y cambia el e-mail que ingresaste anteriormente.</P>";
				echo "<DIV ALIGN='center'><A HREF=\"javascript:history.back(1);\" TITLE='Atr&aacute;s al formulario'><IMG SRC='../../../../librerias/btatras.gif' BORDER='0'></A></DIV>";
				return;
			}
			// Cuando el e-mail si coincide con el nombre de la persona.
			else $consulta = "UPDATE persona SET nombres_persona = '$nombres', paterno_persona = '$paterno', materno_persona = '$materno', email_persona = '$email' WHERE id_persona = $id_persona";
		}
		// Cuando el e-mail no existe.
		else $consulta = "UPDATE persona SET nombres_persona = '$nombres', paterno_persona = '$paterno', materno_persona = '$materno', email_persona = NULL WHERE id_persona = $id_persona";
		
		// Ejecutamos la consulta.
		mysql_query($consulta, $this->enlace);	
		
		// Consulta para modificar la publicación en la base de datos.
		$consulta = "UPDATE publicacion SET id_tipo_publicacion = $id_tipo_publicacion, titulo_publicacion = '$titulo_publicacion', anio_publicacion = $anio_publicacion WHERE id_publicacion = $id_publicacion";
		mysql_query($consulta, $this->enlace);
		
		// Consulta para modificar la tabla 'libro'.
		$update = "UPDATE libro ";
		// Cuando la publicación no es tesis, si tiene editorial.
		if ($id_tipo_publicacion != 2)
			$set = "SET id_empresa = $id_empresa ";
		// Cuando la publicación es tesis, no tiene editorial.
		else $set = "SET id_empresa = NULL ";
		$where = "WHERE id_publicacion = $id_publicacion";
		$consulta = $update . $set . $where;
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de éxito de la operación.
		echo "<P ALIGN='center' CLASS='contenido'><B>LA PUBLICACION HA SIDO MODIFICADA EXITOSAMENTE</B></P>";
		echo "<P CLASS='contenido'>Los datos de esta publicaci&oacute;n de la Biblioteca IC han sido cambiados. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
	
	/**
	 * Método que muestra el formulario para modificar una publicación de la
	 * Biblioteca IC.
	 *
	 * @param $id_publicacion El identificador de la publicación.
	 */
	function formularioEliminarBiblioteca($id_publicacion)
	{
		// Consulta para obtener los datos de la publicación con identificación conocida.
		$consulta = "SELECT publicacion.id_publicacion, tipo_publicacion.desc_tipo_publicacion, publicacion.titulo_publicacion, publicacion.anio_publicacion, persona.id_persona, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona FROM publicacion, tipo_publicacion, desarrollo_publicacion, persona WHERE publicacion.id_publicacion = $id_publicacion AND publicacion.id_tipo_publicacion = tipo_publicacion.id_tipo_publicacion AND desarrollo_publicacion.id_publicacion = publicacion.id_publicacion AND desarrollo_publicacion.id_persona = persona.id_persona AND publicacion.id_ubicacion_publicacion = 1 GROUP BY publicacion.id_publicacion";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Tabla en donde incorporamos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Eliminar Publicaci&oacute;n en Biblioteca IC</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>";
		echo "<TABLE WIDTH='100%' BORDER='1' CELLPADDING='0' CELLSPACING='0' BORDERCOLOR='#F1F1F1' MM_NOCONVERT='TRUE' BGCOLOR='#FFFFFF'>";
		echo "<TR>";
		echo "<TD>";
		echo "<FORM ACTION='grabar.php' METHOD='post' NAME='formulario'>";
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>&nbsp;<B>Datos de la Publicaci&oacute;n</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";						
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>T&iacute;tulo:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' VALUE='" . $tupla["titulo_publicacion"] . "' DISABLED='true' MAXLENGTH='100'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Publicaci&oacute;n:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='tipo_publicacion' CLASS='formtextfield' DISABLED='true' MAXLENGTH='25' VALUE='" . $tupla["desc_tipo_publicacion"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Editorial:</TD>";
		echo "<TD>";
		if ($tupla["id_tipo_publicacion"] != 2)
		{
			// Consulta para obtener los datos de la empresa realizadora de la publicación.
			$consulta = "SELECT empresa.nombre_empresa FROM libro, empresa WHERE libro.id_publicacion = $id_publicacion AND libro.id_empresa = empresa.id_empresa";
			$empresas = mysql_query($consulta, $this->enlace);
			$fila = mysql_fetch_array($empresas);
			echo "<INPUT TYPE='text' NAME='empresa' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $fila["nombre_empresa"] . "'>";
			mysql_free_result($empresas);
		}
		else echo "<INPUT TYPE='text' NAME='empresa' CLASS='formtextfield' DISABLED='true'>";
		echo "</TD>";
		echo "</TR>";	
		echo "<TR>";
		echo "<TD CLASS='formlabel'>A&ntilde;o de Publicaci&oacute;n:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='anio' CLASS='formtextfield' VALUE='" . $tupla["anio_publicacion"] . "' DISABLED='true' MAXLENGTH='4' TABINDEX='1'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>&nbsp;<B>Datos del Autor</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Nombres:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='nombres' CLASS='formtextfield' VALUE='" . $tupla["nombres_persona"] . "' DISABLED='true' MAXLENGTH='50'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>Apellido Paterno:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='paterno' CLASS='formtextfield' VALUE='" . $tupla["paterno_persona"] . "' DISABLED='true' MAXLENGTH='25'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Apellido Materno:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='materno' CLASS='formtextfield' VALUE='" . $tupla["materno_persona"] . "' DISABLED='true' MAXLENGTH='25'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>E-mail:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='email' CLASS='formtextfield' VALUE='" . $tupla["email_persona"] . "' DISABLED='true' MAXLENGTH='50'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>¿Confirma que deseas eliminar esta publicaci&oacute;n de la Biblioteca IC?</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='confirmar' CHECKED='true' VALUE='1'>Si<BR><INPUT TYPE='radio' NAME='confirmar' VALUE='0'>No</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_publicacion' VALUE='$id_publicacion'><INPUT TYPE='hidden' NAME='id_persona' VALUE='" . $tupla["id_persona"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='aceptar' VALUE='Aceptar' CLASS='formbutton' TABINDEX='1' TITLE='Aceptar'></TD>";
		echo "</TR>";
		echo "</TABLE>";
		echo "</FORM>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";		
	}
	
	/**
	 * Método que elimina la publicación de la Biblioteca IC de la base de datos.
	 *
	 * @param $id_publicacion El identificador de la publicación.
	 * @param $id_persona El identificador de la persona.
	 * @param $confirmar Si el usuario desea o no eliminar la publicación.
	 */
	function eliminarBiblioteca($id_persona, $id_publicacion, $confirmar)
	{
		// Cuando hay que eliminar la publicación.
		if ($confirmar == 1)
		{
			// Consulta para borrar el registro en la tabla 'desarrollo_publicacion'.
			$consulta = "DELETE FROM desarrollo_publicacion WHERE id_publicacion = $id_publicacion";
			mysql_query($consulta, $this->enlace);
			
			// Consulta para borrar el registro en la tabla 'libro'.
			$consulta = "DELETE FROM libro WHERE id_publicacion = $id_publicacion";
			mysql_query($consulta, $this->enlace);
			
			// Consulta para borrar el registro en la tabla 'publicacion'.
			$consulta = "DELETE FROM publicacion WHERE id_publicacion = $id_publicacion";
			mysql_query($consulta, $this->enlace);
			
			// Consulta para borrar el registro en la tabla 'persona'.
			$consulta = "DELETE FROM persona WHERE id_persona = $id_persona";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos el mesaje de éxito de la operación.
			echo "<P ALIGN='center' CLASS='contenido'><B>LA PUBLICACION HA SIDO ELIMINADA EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Esta publicaci&oacute;n ha sido eliminada de loss antecedentes de la \"Biblioteca IC\" en nuestro sitio Web. Gracias por colaborar con nosotros.</P>";
		}
		// Cuando no hay que eliminar la publicación.
		else
		{
			echo "<P ALIGN='center' CLASS='contenido'><B>LA ELIMINANCION DE LA PUBLICACION HA SIDO CANCELADA</B></P>";
			echo "<P CLASS='contenido'>Esta publicaci&oacute;n no ha sido eliminada de los antecedentes de la \"Biblioteca IC\" en nuestro sitio Web. Gracias por colaborar con nosotros.</P>";
		}
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
}
?>