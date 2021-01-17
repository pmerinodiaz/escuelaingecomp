<?PHP
/**
 * tesis.php.
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
 * Clase hija de la clase publicacion y que administra los registros de las tesis existentes
 * en la Base de Datos. Las tesis son las publicaciones realizadas por ex-alumnos de la Escuela
 * Ingenier�a en Computaci�n y que tienen un inter�s investigativo.
 */

// Librer�as necesarias.
include("publicacion.php");

class tesis extends publicacion 
{
	/**
	 * M�todo constructor donde inicializamos en enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function tesis($link)
	{
		$this->enlace = $link;			
	}
	
	/**
	 * M�todo que muestra el t�tulo de la secci�n 'Historial de Tesis'.
	 */
	function mostrarTitulo()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Tesis'>Tesis</A> / Historial";
		$imagen = "activos/bghistorial.jpg";
		$titulo = "Historial de Tesis";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * M�todo que muestra (en forma paginada) la lista de tesis efectuadas por alumnos
	 * de la carrera.
	 *
	 * @param $pagina El n�mero de la p�gina dentro de la paginaci�n total.
	 */
	function mostrar($pagina)
	{
		// Librer�as neceserias.
		include("paginacion.php");
		
		// Inicializaci�n de variables.
		$vinculo = "index.php?";
		$porpagina = 10;
		
		// Consulta para obtener las tesis desarrolladas por gente de la Escuela.
		$consulta = "SELECT publicacion.id_publicacion, publicacion.titulo_publicacion, publicacion.anio_publicacion, persona.id_persona, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, academico.id_tipo_academico, usuario_interno.id_estado_interno FROM publicacion, tesis, desarrollo_publicacion, alumno, persona, academico, usuario_interno WHERE publicacion.id_tipo_publicacion = 2 AND publicacion.id_publicacion = tesis.id_publicacion AND desarrollo_publicacion.id_publicacion = publicacion.id_publicacion AND desarrollo_publicacion.id_persona = alumno.id_persona AND tesis.id_persona = academico.id_persona AND usuario_interno.id_persona = academico.id_persona AND persona.id_persona = usuario_interno.id_persona GROUP BY publicacion.id_publicacion ORDER BY anio_publicacion DESC, titulo_publicacion";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay tesis.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay tesis realizadas por alumnos de nuestra Escuela.</P>";
		
		// Cuando hay tesis.
		else
		{
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Tabla para el total, la paginaci�n y la tesis.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total tesis realizadas por alumnos de nuestra Escuela.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='455' HEIGHT='5'></TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para la lista de tesis.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condici�n de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Imprimimos la lista de tesis.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				// Seleccionamos solo el n�mero de registros indicados.
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Mostramos el t�tulo.
				printf("<TR>");
				printf("<TD WIDTH='%s' CLASS='encabezadotabla' VALIGN='top'>&nbsp;T&iacute;tulo:</TD>", "23%");
				printf("<TD WIDTH='%s' CLASS='tabla' VALIGN='top'><B>%s</B></TD>", "77%", strtr($tupla["titulo_publicacion"], $caracteres));
				printf("</TR>");
				
				// Mostramos el (los) autor (es).
				printf("<TR>");
				printf("<TD CLASS='encabezadotabla' VALIGN='top'>&nbsp;Autor:</TD>");
				printf("<TD CLASS='tabla' VALIGN='top'><B>%s</B></TD>", $this->autores($tupla["id_publicacion"]));
				printf("</TR>");
				
				// Mostramos el nombre completo del profesor gu�a.
				printf("<TR>");
				printf("<TD CLASS='encabezadotabla' VALIGN='top'>&nbsp;Profesor gu&iacute;a:</TD>");
				$nombre = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
				
				// Si est� activo, lo enlazamos a su curr�culum.
				if ($tupla["id_estado_interno"] == 1)
					// Vemos el tipo de acad�mico.
					switch ($tupla["id_tipo_academico"])
					{
						case 1: printf("<TD CLASS='tabla' VALIGN='top'><A HREF='../../integrantes/academicos/completa/curriculum.php?id=%d' TITLE='Ver Curr&iacute;culum de %s'>%s</A>", $tupla["id_persona"], $nombre, $nombre); break;
						case 2: printf("<TD CLASS='tabla' VALIGN='top'><A HREF='../../integrantes/academicos/media/curriculum.php?id=%d' TITLE='Ver Curr&iacute;culum de %s'>%s</A>", $tupla["id_persona"], $nombre, $nombre); break;
						case 3: printf("<TD CLASS='tabla' VALIGN='top'><A HREF='../../integrantes/academicos/part/curriculum.php?id=%d' TITLE='Ver Curr&iacute;culum de %s'>%s</A>", $tupla["id_persona"], $nombre, $nombre); break;
					}
				
				// Mostramos el email, si es que tiene.
				if ($tupla["email_persona"])
				{
					$email = strtr($tupla["email_persona"], $caracteres);
					printf(" (<A HREF='mailto:%s' TITLE='%s'>%s</A>)", $email, $email, $email);
				}
				printf("</TD>");
				printf("</TR>");
				
				// Mostramos el a�o de publicaci�n, si es que existe.
				printf("<TR>");
				printf("<TD CLASS='encabezadotabla' VALIGN='top'>&nbsp;A&ntilde;o:</TD>");
				if ($tupla["anio_publicacion"] == NULL)
					printf("<TD CLASS='tabla' VALIGN='top'>&nbsp</TD>");
				else printf("<TD CLASS='tabla' VALIGN='top'>%d</TD>", $tupla["anio_publicacion"]);
				printf("</TR>");
				
				// Espacio entre medio.
				printf("<TR>");
				printf("<TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='455' HEIGHT='5'></TD>");
				printf("</TR>");
			}
			
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
			echo "</TD>";
			echo "</TR>";
			
			// Imprimimos la paginaci�n de los resultados.
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
		
		// Mostramos el formulario de b�squeda de tesis.
		$this->formularioBusqueda();
	}
	
	/**
	 * M�todo que muestra el formulario de b�squeda de tesis.
	 */
	function formularioBusqueda()
	{
		$titulo = "B&uacute;squeda de Tesis";
		$ocultos = "";
		$comentario = "tesis";
		require("busquedasimple.inc");
	}
	
	/**
	 * M�todo que muestra el t�tulo de la secci�n 'B�squeda de Tesis'.
	 */
	function tituloBusqueda()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Tesis'>Tesis</A> / <A HREF='index.php?pagina=1' TITLE='Ver Historial'>Historial</A> / B&uacute;squeda";
		$imagen = "activos/bghistorial.jpg";
		$titulo = "B&uacute;squeda de Tesis";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * M�todo que busca las tesis que coincidan con la palabra ingrsada por el usuario.
	 *
	 * @param $palabra La palabra o frase a buscar.
	 * @param $pagina El n�mero de la p�gina actual dentro de la paginaci�n total.
	 */
	function buscar($palabra, $pagina)
	{
		// Librer�as necesarias.
		include("paginacion.php");
		
		// Inicializaci�n de variables.
		$vinculo = "index.php?palabra=" . $palabra . "&";
		$porpagina = 10;
		
		// Consulta para mostrar las tesis desarrolladas por gente de la Escuela y que coinciden
		// en el t�tulo con la palabra ingresada.
		$select = "SELECT publicacion.id_publicacion, publicacion.titulo_publicacion, publicacion.anio_publicacion, persona.id_persona, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, academico.id_tipo_academico, usuario_interno.id_estado_interno ";
		$from = "FROM publicacion, tesis, desarrollo_publicacion, alumno, persona, academico, usuario_interno ";
		$where = "WHERE publicacion.id_tipo_publicacion = 2 AND (publicacion.titulo_publicacion LIKE '%$palabra%' OR persona.nombres_persona LIKE '%$palabra%' OR persona.paterno_persona LIKE '%$palabra%' OR persona.materno_persona LIKE '%$palabra%') AND publicacion.id_publicacion = tesis.id_publicacion AND desarrollo_publicacion.id_publicacion = publicacion.id_publicacion AND desarrollo_publicacion.id_persona = alumno.id_persona AND tesis.id_persona = academico.id_persona AND usuario_interno.id_persona = academico.id_persona AND persona.id_persona = usuario_interno.id_persona ";
		$group = "GROUP BY publicacion.id_publicacion ";
		$order = "ORDER BY anio_publicacion DESC, titulo_publicacion";
		$consulta = $select . $from . $where . $group . $order;
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay tesis.
		if ($total == 0)
			echo "<P CLASS='contenido'>No se encontraron tesis realizadas por alumnos de nuestra Escuela.</P>";
		
		// Cuando hay tesis.
		else
		{
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Tabla para el total, la paginaci�n y las tesis.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total tesis realizadas por alumnos de nuestra Escuela.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='455' HEIGHT='5'></TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para la lista de tesis.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condici�n de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Imprimimos la lista de tesis.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				// Seleccionamos solo el n�mero de registros indicados.
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Mostramos el t�tulo.
				printf("<TR>");
				printf("<TD WIDTH='%s' CLASS='encabezadotabla' VALIGN='top'>&nbsp;T&iacute;tulo:</TD>", "23%");
				printf("<TD WIDTH='%s' CLASS='tabla' VALIGN='top'><B>%s</B></TD>", "77%", strtr($tupla["titulo_publicacion"], $caracteres));
				printf("</TR>");
				
				// Mostramos el (los) autor (es).
				printf("<TR>");
				printf("<TD CLASS='encabezadotabla' VALIGN='top'>&nbsp;Autor:</TD>");
				printf("<TD CLASS='tabla' VALIGN='top'><B>%s</B></TD>", $this->autores($tupla["id_publicacion"]));
				printf("</TR>");
				
				// Mostramos el nombre completo del profesor gu�a.
				printf("<TR>");
				printf("<TD CLASS='encabezadotabla' VALIGN='top'>&nbsp;Profesor gu&iacute;a:</TD>");
				$nombre = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
				
				// Si est� activo, lo enlazamos a su curr�culum.
				if ($tupla["id_estado_interno"] == 1)
					// Vemos el tipo de acad�mico.
					switch ($tupla["id_tipo_academico"])
					{
						case 1: printf("<TD CLASS='tabla' VALIGN='top'><A HREF='../../integrantes/academicos/completa/curriculum.php?id=%d' TITLE='Ver Curr&iacute;culum de %s'>%s</A>", $tupla["id_persona"], $nombre, $nombre); break;
						case 2: printf("<TD CLASS='tabla' VALIGN='top'><A HREF='../../integrantes/academicos/media/curriculum.php?id=%d' TITLE='Ver Curr&iacute;culum de %s'>%s</A>", $tupla["id_persona"], $nombre, $nombre); break;
						case 3: printf("<TD CLASS='tabla' VALIGN='top'><A HREF='../../integrantes/academicos/part/curriculum.php?id=%d' TITLE='Ver Curr&iacute;culum de %s'>%s</A>", $tupla["id_persona"], $nombre, $nombre); break;
					}
				
				// Mostramos el email, si es que tiene.
				if ($tupla["email_persona"])
				{
					$email = strtr($tupla["email_persona"], $caracteres);
					printf(" (<A HREF='mailto:%s' TITLE='%s'>%s</A>)", $email, $email, $email);
				}
				printf("</TD>");
				printf("</TR>");
				
				// Mostramos el a�o de publicaci�n, si es que existe.
				printf("<TR>");
				printf("<TD CLASS='encabezadotabla' VALIGN='top'>&nbsp;A&ntilde;o:</TD>");
				if ($tupla["anio_publicacion"] == NULL)
					printf("<TD CLASS='tabla' VALIGN='top'>&nbsp</TD>");
				else printf("<TD CLASS='tabla' VALIGN='top'>%d</TD>", $tupla["anio_publicacion"]);
				printf("</TR>");
				
				// Espacio entre medio.
				printf("<TR>");
				printf("<TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='455' HEIGHT='5'></TD>");
				printf("</TR>");
			}
			
			// Cerramos la tabla de las tesis.
			echo "</TABLE>";
			echo "</TD>";
			echo "</TR>";
			
			// Imprimimos la paginaci�n de los resultados.
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
		
		// Mostramos el formulario de b�squeda de tesis.
		$this->formularioBusqueda();
	}
}
?>