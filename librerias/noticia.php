<?PHP
/**
 * noticia.php.
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
 * Clase que administra las noticias que son publicadas en este sitio Web. Las noticias son
 * contenidos o avisos que se publican periodicamente en este Web. Las noticias pueden ser
 * sobre la Universidad de La Serena o tecnología.
 */

class noticia
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param	$link Enlace a la base de datos.
	 */
	function noticia($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que muestra las cinco noticias más recientemente publicadas, sobre la Universidad.
	 * Las noticias se muestran en una marquisina tipo JavaScript en el Home del sitio.
	 */
	function mostrarDestacadas()
	{
		// Consulta que obtiene todas las noticias sobre la Universidad, ordenadas por fecha de rececepción.
		$consulta = "SELECT envio.id_envio, envio.titulo_envio, envio.fecha_envio FROM envio, noticia WHERE envio.id_tipo_envio = 3 AND envio.id_envio = noticia.id_envio AND noticia.id_tipo_noticia = 1 ORDER BY envio.fecha_envio DESC, envio.hora_envio DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Contador de las noticias.
		$contador = 0;
		
		// Abrimos la marquesina JavaScript.
		echo "<SCRIPT LANGUAGE=\"JavaScript\">";
		echo "document.write('<MARQUEE ID=\"scrollnoticias\" DIRECTION=\"up\" WIDTH=\"152px\" HEIGHT=\"100px\" SCROLLAMOUNT=\"2\" SCROLLDELAY=\"90\" STYLE=\"border:1 solid #999999; BACKGROUND-COLOR:#FFFFFF\">');";
		echo "scrollnoticias.onmouseover=new Function('scrollnoticias.scrollAmount=0');";
		echo "scrollnoticias.onmouseout=new Function('scrollnoticias.scrollAmount=2');";
		
		// Cuando si existen noticias.
		if ($total > 0)
		{
			// Obtenemos el juego de caracteres especiales existentes en el servidor.
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Imprimimos solo cinco noticias.
			while (($fila = mysql_fetch_array($resultado)) && ($contador < 5))
			{
				// Imprimimos la fecha, el titulo y un enlace para que el usuario pueda ver el detalle de la noticia.
				$titulo = strtr($fila["titulo_envio"], $caracteres);
				printf("document.write('<DIV CLASS=\"detalle\"><A HREF=\"../noticias/universidad/noticia.php?id=%d\" TITLE=\"Ver detalles de %s\">%s. %s...</A></DIV><BR>');", $fila["id_envio"], $titulo, $fila["fecha_envio"], $titulo);
				$contador++;
			}
		}
		
		// Cerramos la marquesina JavaScript.
		echo "document.write('</MARQUEE>');";
		echo "</SCRIPT>";
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que muestra el título de la sección noticias (Universidad o Tecnología).
	 *
	 * @param $id_tipo_noticia El identificador del tipo de noticia.
	 */
	function mostrarTitulo($id_tipo_noticia)
	{
		// Dependiendo del tipo de noticias, configuramos los mensajes.
		switch ($id_tipo_noticia)
		{
			case 1:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Noticias'>Noticias</A> / Universidad</TD>";
				$imagen = "activos/bguniversidad.jpg";
				$titulo = "Noticias de la Universidad";
				break;
			}
			case 2:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Noticias'>Noticias</A> / Tecnolog&iacute;a</TD>";
				$imagen = "activos/bgtecnologia.jpg";
				$titulo = "Noticias de Tecnolog&iacute;a";
				break;
			}
		}
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Metodo que lista las noticias (en forma paginada) de algún tipo de
	 * noticia (Universidad o Tecnología).
	 *
	 * @param $id_tipo_noticia El identificador del tipo de noticia.
	 * @param $pagina El número de la página actual dentro de la paginación total.
	 */
	function mostrar($id_tipo_noticia, $pagina)
	{			
	  // Librerías necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$enlace = "index.php?";
		$porpagina = 5;
		
		// Consulta para listar las noticias del algún tipo (Universidad o Tecnología)
		// ordenadas por fecha del envío.
		$consulta = "SELECT envio.id_envio, envio.titulo_envio, envio.fecha_envio, envio.desc_envio, noticia.src_noticia FROM envio, noticia WHERE envio.id_tipo_envio = 3 AND envio.id_envio = noticia.id_envio AND noticia.id_tipo_noticia = $id_tipo_noticia ORDER BY fecha_envio DESC, hora_envio DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay noticias.
		if ($total == 0)
			switch ($id_tipo_noticia)
			{
				case 1: echo "<P CLASS='contenido'>No hay noticias de la Universidad.</P>"; break;
				case 2: echo "<P CLASS='contenido'>No hay noticias de Tecnolog&iacute;a.</P>"; break;
			}
		
		// Cuando si hay noticias.
		else
		{
			// Creamos un objeto paginaciópn.
			$paginacion = new paginacion($total, $pagina, $enlace, $porpagina);
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Tabla para el total, la paginación y las noticias.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			switch ($id_tipo_noticia)
			{
				case 1: echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total noticias de la Universidad.</TD>"; break;
				case 2: echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total noticias de Tecnolog&iacute;a.</TD>"; break;
			}
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "<TR><TD COLSPAN='2'>";
			
			// Tabla para las noticias.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos las noticias.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Imprimimos el título.
				$titulo = strtr($tupla["titulo_envio"], $caracteres);
				printf("<TR>");
				printf("<TD COLSPAN='2' CLASS='contenido'><A HREF='noticia.php?id=%d' TITLE='Ver detalles de %s'><B>%s</B></A></TD>", $tupla["id_envio"], $titulo, $titulo);
				printf("</TR>");
				
				// Imprimimos la fecha.
				printf("<TR>");
				printf("<TD COLSPAN='2' CLASS='detalle'><B>%s</B></TD>", $tupla["fecha_envio"]);
				printf("</TR>");
				
				// Imprimimos la imagen y la descripción.
				printf("<TR>");
				printf("<TD WIDTH='%s' VALIGN='center'><A HREF='noticia.php?id=%d' TITLE='Ver detalles de %s'><IMG SRC='../activos/%s' BORDER='0'></A></TD>", "25%", $tupla["id_envio"], $titulo, $tupla["src_noticia"], $titulo);
				printf("<TD WIDTH='%s' CLASS='contenido' VALIGN='top'>%s...</TD>", "75%", strtr(substr($tupla["desc_envio"], 0, 350), $caracteres));
				printf("</TR>");
				
				// Imprimimos un espacio en blanco.
				printf("<TR><TD>&nbsp;</TD></TD>");
			}
			
			// Cerramos la tabla de las noticias.
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
		
		// Mostramos el formulario de búsqueda.
		$this->formularioBusqueda($id_tipo_noticia);
		
		// Liberación de memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que muestra el formulario de búsqueda para las noticias
	 * (Universidad o Tecnología).
	 *
	 * @param $id_tipo_noticia El identificador del tipo de noticia.
	 */
	function formularioBusqueda($id_tipo_noticia)
	{
		// Dependiendo del tipo de noticia, configuramos los mensajes.
		switch ($id_tipo_noticia)
		{
			case 1:
			{
				$titulo = "B&uacute;squeda de Noticias de la Universidad";
				$comentario = "noticias de la universidad";
				break;
			}
			case 2:
			{
				$titulo = "B&uacute;squeda de Noticias de Tecnolog&iacute;a";
				$comentario = "noticias de tecnolog&iacute;a";
				break;
			}
		}
		$ocultos = "";
		require("busquedasimple.inc");
	}
	
	/**
	 * Método que muestra el título de la sección búsqueda de noticias
	 * (Universidad o Tecnología).
	 */
	function tituloBusqueda($id_tipo_noticia)
	{
		// Dependiendo del tipo de noticia, configuramos los mensajes.
		switch ($id_tipo_noticia)
		{
			case 1:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Noticias'>Noticias</A> / <A HREF='index.php?pagina=1' TITLE='Ver Universidad'>Universidad</A> / B&uacute;squeda";
				$imagen = "activos/bguniversidad.jpg";
				$titulo = "B&uacute;squeda de Noticias de Universidad";
				break;
			}
			case 2:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Noticias'>Noticias</A> / <A HREF='index.php?pagina=1' TITLE='Ver Tecnolog&iacute;a'>Tecnolog&iacute;a</A> / B&uacute;squeda";
				$imagen = "activos/bgtecnologia.jpg";
				$titulo = "B&uacute;squeda de Noticias de Tecnolog&iacute;a";
				break;
			}
		}
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que busca noticias de algún tipo que coincidan con la palabra indicada
	 * y las muestra en forma paginada.
	 */
	function buscar($id_tipo_noticia, $palabra, $pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$enlace = "buscar.php?palabra=" . $palabra . "&";
		$porpagina = 5;
		
		// Consulta para listar las noticias que coinciden en el título o la descripción
		// con la palabra ingresada.
		$consulta = "SELECT envio.id_envio, envio.titulo_envio, envio.fecha_envio, envio.desc_envio, noticia.src_noticia FROM envio, noticia WHERE (envio.titulo_envio LIKE '%$palabra%' OR envio.desc_envio LIKE '%$palabra%') AND envio.id_tipo_envio = 3 AND noticia.id_tipo_noticia = $id_tipo_noticia AND envio.id_envio = noticia.id_envio ORDER BY fecha_envio DESC, hora_envio DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay noticias.
		if ($total == 0)
			switch ($id_tipo_noticia)
			{
				case 1: echo "<P CLASS='contenido'>No se encontraron noticias de la Universidad.</P>"; break;
				case 2: echo "<P CLASS='contenido'>No se encontraron de Tecnolog&iacute;a.</P>"; break;
			}
		
		// Cuando si hay noticias.
		else
		{
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $enlace, $porpagina);
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Mostramos la navegación.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			switch ($id_tipo_noticia)
			{
				case 1: echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total noticias de la Universidad.</TD>"; break;
				case 2: echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total noticias de Tecnolog&iacute;a.</TD>"; break;
			}
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "<TR><TD COLSPAN='2'>";
			
			// Tabla para las noticias.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos las noticias.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Imprimimos el título.
				$titulo = strtr($tupla["titulo_envio"], $caracteres);
				printf("<TR>");
				printf("<TD COLSPAN='2' CLASS='contenido'><A HREF='noticia.php?id=%d' TITLE='Ver detalles de %s'><B>%s</B></A></TD>", $tupla["id_envio"], $titulo, $titulo);
				printf("</TR>");
				
				// Imprimimos la fecha.
				printf("<TR>");
				printf("<TD COLSPAN='2' CLASS='detalle'><B>%s</B></TD>", $tupla["fecha_envio"]);
				printf("</TR>");
				
				// Imprimimos la imagen y la descripción.
				printf("<TR>");
				printf("<TD WIDTH='%s' VALIGN='center'><A HREF='noticia.php?id=%d' TITLE='Ver detalles de %s'><IMG SRC='../activos/%s' BORDER='0'></A></TD>", "25%", $tupla["id_envio"], $titulo, $tupla["src_noticia"], $titulo);
				printf("<TD WIDTH='%s' CLASS='contenido' VALIGN='top'>%s...</TD>", "75%", strtr(substr($tupla["desc_envio"], 0, 350), $caracteres));
				printf("</TR>");
				
				// Imprimimos un espacio en blanco.
				printf("<TR><TD>&nbsp;</TD></TD>");
			}
			
			// Cerramos la tabla de las noticias.
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
		
		// Mostramos el formulario de búsqueda.
		$this->formularioBusqueda($id_tipo_noticia);
		
		// Liberación de memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que muestra el título de la sección 'Detalles de la Noticia'.
	 *
	 * @param $id_tipo_noticia El identificador del tipo de noticia.
	 */
	function tituloDetalles($id_tipo_noticia)
	{
		// Dependiendo del tipo de noticia, configuramos los mensajes.
		switch ($id_tipo_noticia)
		{
			case 1:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Noticias'>Noticias</A> / <A HREF='index.php?pagina=1' TITLE='Ver Universidad'>Universidad</A> / Detalles";
				$imagen = "activos/bguniversidad.jpg";
				break;
			}
			case 2:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Noticias'>Noticias</A> / <A HREF='index.php?pagina=1' TITLE='Ver Tecnolog&iacute;a'>Tecnolog&iacute;a</A> / Detalles";
				$imagen = "activos/bgtecnologia.jpg";
				break;
			}
		}
		$titulo = "Detalles de la Noticia";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra los detalles de una noticia (Universidad o Tecnología)
	 * elegida anteriormente por el usuario.
	 *
	 * @param $id_tipo_noticia El identificador del tipo de noticia.
	 * @param $id_envio El identificador del envío.
	 */
	function detallar($id_tipo_noticia, $id_envio)
	{
		// Consulta para listar la noticias especificada.
		$consulta = "SELECT envio.id_envio, envio.titulo_envio, envio.fecha_envio, envio.desc_envio, noticia.src_noticia, noticia.url_noticia FROM envio, noticia WHERE envio.id_tipo_envio = 3 AND envio.id_envio = $id_envio AND envio.id_envio = noticia.id_envio AND noticia.id_tipo_noticia = $id_tipo_noticia";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		$fila = mysql_fetch_array($resultado);
		
		// Cuando la noticia no existe.
		if ($total == 0)
		{
			$error = new error(1, "../../", "index.php?pagina=1");
			$error->mostrar();
		}
		
		// Cuando la noticia si existe.
		else
		{
			// Capturamos el juego de caracteres.
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Tabla para la noticia.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
			
			// Mostramos el título.
			printf("<TR>");
			printf("<TD CLASS='contenido'><B>%s</B></TD>", strtr($fila["titulo_envio"], $caracteres));
			printf("</TR>");
			
			// Mostramos la fecha.
			printf("<TR>");
			printf("<TD CLASS='detalle'>%s</TD></TR>", $fila["fecha_envio"]);
			printf("</TR>");
			printf("<TR><TD>&nbsp;</TD></TR>");
			
			// Mostramos la imagen y la descripción.
			printf("<TR>");
			printf("<TD VALIGN='TOP' CLASS='contenido'><IMG SRC='../activos/%s' ALIGN='left'> %s</TD>", $fila["src_noticia"], nl2br(strtr($fila["desc_envio"], $caracteres)));
			printf("</TR>");
      printf("<TR><TD>&nbsp;</TD></TR>");
			
			// Mostramos la url de la noticia, en caso de existir.
			if ($fila["url_noticia"])
      {
				$url = strtr($fila["url_noticia"], $caracteres);
				printf("<TR>");
      	printf("<TD CLASS='contenido'>M&aacute;s informaci&oacute;n: <A HREF='http://%s' TITLE='Visitar este Web' TARGET='_blank'>http://%s</A>", $url, $url);
        printf("</TR>");
      }
			
			// Mostramos el botón 'volver'.
			echo "<TR><TD>&nbsp;</TD></TR>";
			echo "<TR><TD ALIGN='center'><A HREF=\"javascript:history.back(1);\" TITLE='Volver'><IMG SRC='../../librerias/btvolver.gif' BORDER='0'></A></TD></TR>";
			echo "<TR><TD>&nbsp;</TD></TR>";
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método en donde se muestra el formulario de ingreso de una nueva noticia.
	 *
	 * @param $id_persona El identificador de la persona.
	 */
	function formularioAgregar($id_persona)
	{
		// Librerías necesarias.
		include("tiponoticia.php");
		
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Fecha actual.
		$fecha = date("Y-m-d");
		
		// Tabla en donde incorporamos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Agregar Noticia</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>";
		echo "<TABLE WIDTH='100%' BORDER='1' CELLPADDING='0' CELLSPACING='0' BORDERCOLOR='#F1F1F1' MM_NOCONVERT='TRUE' BGCOLOR='#FFFFFF'>";
		echo "<TR>";
		echo "<TD>";
		echo "<FORM ACTION='grabar.php' METHOD='post' NAME='formulario' onSubmit='return validarFormulario();' ENCTYPE='multipart/form-data'>";
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>T&iacute;tulo:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' TITLE='T&iacute;tulo de la noticia'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Noticia:</TD>";
		echo "<TD>";
		$tipo_noticia = new tiponoticia($this->enlace);
		$tipo_noticia->select(1);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Fecha:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='fecha' CLASS='formtextfield' MAXLENGTH='10' VALUE='$fecha' TABINDEX='1' TITLE='Fecha de la noticia (aa-mm-dd)'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Imagen:</TD>";
		echo "<TD><INPUT TYPE='file' NAME='imagen' CLASS='formtextfield' TABINDEX='1' TITLE='Imagen *.GIF - *.JPG (M&aacute;x. 15 KB)'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Sitio Web:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='sitio_web' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' TITLE='Sitio Web para m&aacute;s informaci&oacute;n sobre la noticia (No incluir el protocolo http://)'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel' COLSPAN='2' ALIGN='center'>Texto:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='center'><TEXTAREA NAME='descripcion' CLASS='formtextarea' ROWS='10' TABINDEX='1' TITLE='Descripci&oacute;n de la noticia'></TEXTAREA> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
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
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='agregar' VALUE='Agregar' CLASS='formbutton' TABINDEX='1' TITLE='Agregar la noticia'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * Método que agrega un noticia a la base de datos.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $titulo El título de la persona.
	 * @param $tipo_noticia El tipo de noticia.
	 * @param $fecha La fecha de la noticia.
	 * @param $imagen El archivo imagen de la noticia.
	 * @param $sitio_web El sitio Web de la noticia.
	 * @param $descripcion La descripción de la noticia.
	 */
	function agregar($id_persona, $titulo, $tipo_noticia, $fecha, $imagen, $sitio_web, $descripcion)
	{
		// Cuando hay espacio en disco, el archivo existe y el archivo es menor o igual a 15 Kb.
		if ($imagen['size'] <= diskfreespace("C:/") && 0 < $imagen['size'] && $imagen['size'] <= 15000)
		{
			// Obtener la hora actual.
			$hora = date("H:i:s");
			
			// Consulta para insertar el registro en la tabla envio.
			$consulta = "INSERT INTO envio(id_tipo_envio, titulo_envio, desc_envio, fecha_envio, hora_envio) VALUES (3, '$titulo', '$descripcion', '$fecha', '$hora')";
			mysql_query($consulta, $this->enlace);
			
			// Obtenemos el último id_envio ingresado.
			$id_envio = mysql_insert_id();
			
			// Copiamos el archivo al servidor.
			copy($imagen['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . "/wwwic/noticias/activos/" . $id_envio . ".gif");
			
			// Consulta para insertar el registro en la tabla noticia.
			$consulta = "INSERT INTO noticia(id_envio, id_tipo_noticia, id_persona, src_noticia, url_noticia) VALUES ($id_envio, $tipo_noticia, $id_persona, '$id_envio.gif', '$sitio_web')";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos mensajes de éxito.
			echo "<P CLASS='contenido' ALIGN='center'><B>TU NOTICIA FUE AGREGADA EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Esta noticia ser&aacute; publicada en la secci&oacute;n \"Noticias\" dentro de este sitio Web. Gracias por colaborar con nosotros.</P>";
			echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
		}
		// Cuando el archivo no se puede subir.
		else
		{
			// Imprimimos mensajes de error de envío.
			echo "<P CLASS='contenido' ALIGN='center'><B>TU NOTICIA NO PUDO AGREGARSE EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Esto se puede deber una de las siguientes razones:</P>";
			echo "<OL CLASS='contenido'>";
			echo "<LI>No hay espacio en el disco del servidor.</LI>";
			echo "<LI>La imagen no existe.</LI>";
			echo "<LI>El tama&ntilde;o de la imagen es superior a 15 KB.</LI>";
			echo "<OL>";
			echo "<P ALIGN='center'><A HREF='index.php' TITLE='Atr&aacute;s al Formulario'><IMG SRC='../../../../librerias/btatras.gif' BORDER='0'></A></P>";
		}
	}
	
	/**
	 * Método que lista todas las noticias realizadas por un usuario.
	 */
	function listar($id_persona, $vinculo)
	{
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE persona.id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$usuario = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
		mysql_free_result($resultado);
		
		// Consulta para obtener la lista de noticias realizadas por el usuario.
		$consulta = "SELECT envio.id_envio, envio.titulo_envio, tipo_noticia.desc_tipo_noticia, envio.fecha_envio FROM envio, noticia, tipo_noticia, usuario_interno WHERE envio.id_envio = noticia.id_envio AND noticia.id_persona = $id_persona AND noticia.id_persona = usuario_interno.id_persona AND noticia.id_tipo_noticia = tipo_noticia.id_tipo_noticia AND envio.id_tipo_envio = 3 ORDER BY fecha_envio, hora_envio";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);		
		
		// Cuando no hay noticias.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay noticias realizadas por $usuario.</P>";
		
		// Cuando si hay noticias.
		else
		{
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='5' CLASS='contenido'>Hay un total de $total noticias relizadas por $usuario:</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'>&nbsp;</TD>";
			echo "<TD WIDTH='50%' ALIGN='center' CLASS='titulotabla'><B>T&iacute;tulo</B></TD>";
			echo "<TD WIDTH='20%' ALIGN='center' CLASS='titulotabla'><B>Tipo de Noticia</B></TD>";
			echo "<TD WIDTH='20%' ALIGN='center' CLASS='titulotabla'><B>Fecha</B></TD>";
			echo "</TR>";
			
			// Texto para enlazar a la operación.
			if ($vinculo == "modificar.php")
				$texto_vinculo = "Modificar";
			else $texto_vinculo = "Eliminar";
			
			// Imprimimos la lista de noticias.
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				printf("<TD ALIGN='center' CLASS='tabla'><A HREF='$vinculo?id=%s' TITLE='%s Noticia'>%s</A></TD>", $tupla["id_envio"], $texto_vinculo, $texto_vinculo);
				printf("<TD CLASS='tabla'>%s</TD>", $tupla["titulo_envio"]);
				printf("<TD ALIGN='center' CLASS='tabla'>%s</TD>", $tupla["desc_tipo_noticia"]);
				printf("<TD ALIGN='center' CLASS='tabla'>%s</TD>", $tupla["fecha_envio"]);
				printf("</TR>");
			}
			echo "</TABLE>";
		}
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);	
	}
	
	/**
	 * Método en donde se muestra el formulario de modificación de una noticia.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_envio El identificador del envío.
	 */
	function formularioModificar($id_persona, $id_envio)
	{
		// Librerías necesarias.
		include("tiponoticia.php");
		
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida..
		$consulta = "SELECT envio.id_envio, envio.titulo_envio, noticia.id_tipo_noticia, envio.fecha_envio, noticia.src_noticia, noticia.url_noticia, envio.desc_envio, persona.nombres_persona, persona.paterno_persona, persona.materno_persona FROM envio, noticia, usuario_interno, persona WHERE persona.id_persona = $id_persona AND envio.id_envio = $id_envio AND envio.id_tipo_envio = 3 AND envio.id_envio = noticia.id_envio AND noticia.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Tabla en done incorporamos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Modificar Noticia</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>";
		echo "<TABLE WIDTH='100%' BORDER='1' CELLPADDING='0' CELLSPACING='0' BORDERCOLOR='#F1F1F1' MM_NOCONVERT='TRUE' BGCOLOR='#FFFFFF'>";
		echo "<TR>";
		echo "<TD>";
		echo "<FORM ACTION='grabar.php' METHOD='post' NAME='formulario' onSubmit='return validarFormulario();' ENCTYPE='multipart/form-data'>";
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>T&iacute;tulo:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' VALUE='" . $tupla["titulo_envio"] . "' TITLE='T&iacute;tulo de la noticia'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Noticia:</TD>";
		echo "<TD>";
		$tipo_noticia = new tiponoticia($this->enlace);
		$tipo_noticia->select($tupla["id_tipo_noticia"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Fecha:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='fecha' CLASS='formtextfield' MAXLENGTH='10' TABINDEX='1' VALUE='" . $tupla["fecha_envio"] . "' TITLE='Fecha de la noticia (aa-mm-dd)'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel' VALIGN='top'>Imagen Actual:</TD>";
		echo "<TD>";
		echo "<IMG SRC='../../../../noticias/activos/" . $tupla["src_noticia"] . "'>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>&nbsp;</TD>";
		echo "<TD>";
		echo "<INPUT TYPE='checkbox' NAME='cambio' TABINDEX='1' onClick='setearSRC();'> ";
		echo "<SPAN CLASS='formlabel'>Cambiar la imagen actual</SPAN>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>&nbsp;</TD>";
		echo "<TD>";
		echo "<INPUT TYPE='file' NAME='imagen' TABINDEX='1' CLASS='formtextfield' TITLE='Imagen *.GIF - *.JPG (M&aacute;x. 15 KB)' DISABLED='true'>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Sitio Web:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='sitio_web' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' VALUE='" . $tupla["url_noticia"] . "' TITLE='Sitio Web para m&aacute;s informaci&oacute;n sobre la noticia (No incluir el protocolo http://)'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel' COLSPAN='2' ALIGN='center'>Texto:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='center'><TEXTAREA NAME='descripcion' CLASS='formtextarea' ROWS='10' TABINDEX='1' TITLE='Descripci&oacute;n de la noticia'>" . $tupla["desc_envio"] . "</TEXTAREA> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido'>&nbsp;<FONT COLOR='#CC0000'>*</FONT> Datos obligatorios</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_envio' VALUE='" . $tupla["id_envio"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar la noticia'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * Método que realiza los cambios en la base de datos para cambiar una noticia dada.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_envio El identificador del envío.
	 * @param $cambiar_imagen Si se desea cambiar o no la imagen actual de la noticia.
	 * @param $titulo_envio El título del noticia.
	 * @param $id_tipo_noticia El identificador del tipo de noticia.
	 * @param $fecha_envio La fecha de envío de la noticia.
	 * @param $src_noticia El archivo que contiene la imagen de la noticia.
	 * @param $url_noticia El sitio Web para más información sobre la noticia.
	 * @param $desc_envio La descripción de la noticia.
	 */
	function modificar($id_persona, $id_envio, $cambiar_imagen, $titulo_envio, $id_tipo_noticia, $fecha_envio, $src_noticia, $url_noticia, $desc_envio)
	{
		// Cuando el usuario quiere cambiar la imagen.
		if ($cambiar_imagen)
		{
			// Cuando hay espacio en disco, el archivo existe y el archivo es menor o igual a 15KB.
			if ($src_noticia['size'] <= diskfreespace("C:/") && 0 < $src_noticia['size'] && $src_noticia['size'] <= 15000)
			{
				// Consulta para actualizar el registro de un envio en la tabla 'envio'.
				$consulta = "UPDATE envio SET titulo_envio = '$titulo_envio', desc_envio = '$desc_envio', fecha_envio = '$fecha_envio' WHERE id_envio = $id_envio";
				mysql_query($consulta, $this->enlace);
				
				// Consulta para actualizar el registro de una noticia en la tabla 'noticia'.
				$consulta = "UPDATE noticia SET id_tipo_noticia = $id_tipo_noticia, src_noticia = '$id_envio.gif', url_noticia = '$url_noticia' WHERE id_envio = $id_envio AND id_persona = $id_persona";
				mysql_query($consulta, $this->enlace);
				
				// Borramos el archivo antiguo del servidor.
				$archivo_antiguo = $_SERVER["DOCUMENT_ROOT"] . "/wwwic/noticias/activos/" . $id_envio . ".gif";
				if (file_exists($archivo_antiguo))
					unlink($archivo_antiguo);
				
				// Copiamos el archivo al servidor.
				copy($src_noticia['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . "/wwwic/noticias/activos/" . $id_envio . ".gif");
				
				// Imprimimos mensajes de éxito.
				echo "<P CLASS='contenido' ALIGN='center'><B>TU NOTICIA FUE MODIFICADA EXITOSAMENTE</B></P>";
				echo "<P CLASS='contenido'>Los datos de la noticia han sido modificados. Gracias por colaborar con nosotros.</P>";
				echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
			}
			// Cuando el archivo no se puede subir.
			else
			{
				// Imprimimos mensajes de error de envío.
				echo "<P CLASS='contenido' ALIGN='center'><B>TU NOTICIA NO PUDO MODIFICARSE EXITOSAMENTE</B></P>";
				echo "<P CLASS='contenido'>Esto se puede deber una de las siguientes razones:</P>";
				echo "<OL CLASS='contenido'>";
				echo "<LI>No hay espacio en el disco del servidor.</LI>";
				echo "<LI>El archivo no existe.</LI>";
				echo "<LI>El tama&ntilde;o del archivo es superior a 15 KB.</LI>";
				echo "<OL>";
				echo "<P ALIGN='center'><A HREF='index.php' TITLE='Atr&aacute;s al Formulario'><IMG SRC='../../../../librerias/btatras.gif' BORDER='0'></A></P>";
			}
		}
		// Cuando el usuario no quiere cambiar la imagen.
		else
		{
			// Consulta para actualizar el registro de un envio en la tabla 'envio'.
			$consulta = "UPDATE envio SET titulo_envio = '$titulo_envio', desc_envio = '$desc_envio', fecha_envio = '$fecha_envio' WHERE id_envio = $id_envio";
			mysql_query($consulta, $this->enlace);
			
			// Consulta para actualizar el registro de una noticia en la tabla 'noticia'.
			$consulta = "UPDATE noticia SET id_tipo_noticia = $id_tipo_noticia, url_noticia = '$url_noticia' WHERE id_envio = $id_envio AND id_persona = $id_persona";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos mensajes de éxito.
			echo "<P CLASS='contenido' ALIGN='center'><B>TU NOTICIA FUE MODIFICADA EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Los datos de la noticia han sido modificados. Gracias por colaborar con nosotros.</P>";
			echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
		}
	}
	
	/**
	 * Método que muestra el formulario para eliminar una noticia.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_envio El identificador del envío.
	 */
	function formularioEliminar($id_persona, $id_envio)
	{
		// Librerías necesarias.
		include("tiponoticia.php");
		
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida.
		$consulta = "SELECT envio.id_envio, envio.titulo_envio, noticia.id_tipo_noticia, envio.fecha_envio, noticia.src_noticia, noticia.url_noticia, envio.desc_envio, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, tipo_noticia.desc_tipo_noticia FROM envio, noticia, usuario_interno, persona, tipo_noticia WHERE persona.id_persona = $id_persona AND envio.id_envio = $id_envio AND envio.id_tipo_envio = 3 AND envio.id_envio = noticia.id_envio AND noticia.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona AND noticia.id_tipo_noticia = tipo_noticia.id_tipo_noticia";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Tabla en donde incoramos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Eliminar Noticia</B></TD>";
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
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["titulo_envio"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Noticia:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='tipo_noticia' CLASS='formtextfield' DISABLED='true' MAXLENGTH='25' VALUE='" . $tupla["desc_tipo_noticia"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Fecha:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='fecha' CLASS='formtextfield' MAXLENGTH='10' DISABLED='true' VALUE='" . $tupla["fecha_envio"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel' VALIGN='top'>Imagen:</TD>";
		echo "<TD>";
		echo "<IMG SRC='../../../../noticias/activos/" . $tupla["src_noticia"] . "'>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Sitio Web:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='sitio_web' CLASS='formtextfield' MAXLENGTH='100' DISABLED='true' VALUE='" . $tupla["url_noticia"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel' COLSPAN='2' ALIGN='center'>Texto:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='center'><TEXTAREA NAME='descripcion' CLASS='formtextarea' ROWS='10' DISABLED='true'>" . $tupla["desc_envio"] . "</TEXTAREA></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>¿Confirma que deseas eliminar &eacute;sta noticia?</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='confirmar' CHECKED='true' VALUE='1' TABINDEX='1'>Si<BR><INPUT TYPE='radio' NAME='confirmar' VALUE='0' TABINDEX='1'>No</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'><INPUT TYPE='hidden' NAME='id_envio' VALUE='" . $tupla["id_envio"] . "'></TD>";
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
	 * Método que elimina de la base de datos una noticia elegida por el usuario.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_envio El identificador del envío.
	 * @param $confirmar Si el usuario desea o no eliminar la noticia.
	 */
	function eliminar($id_persona, $id_envio, $confirmar)
	{
		// Cuando hay que eliminar la noticia.
		if ($confirmar == 1)
		{
			// Consulta para borrar el registro en la tabla 'noticia'.
			$consulta = "DELETE FROM noticia WHERE id_envio = $id_envio";
			mysql_query($consulta, $this->enlace);
			
			// Consulta para borrar el registro en la tabla 'envio'.
			$consulta = "DELETE FROM envio WHERE id_envio = $id_envio";
			mysql_query($consulta, $this->enlace);
			
			// Borramos el archivo del servidor.
			$archivo = $_SERVER["DOCUMENT_ROOT"] . "/wwwic/noticias/activos/" . $id_envio . ".gif";
			if (file_exists($archivo))
				unlink($archivo);
			
			// Imprimimos el mesaje de éxito de la operación.
			echo "<P ALIGN='center' CLASS='contenido'><B>TU NOTICIA HA SIDO ELIMINADA EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Esta noticia ha sido eliminada de la secci&oacute;n \"Noticias\" en nuestro sitio Web. Gracias por colaborar con nosotros.</P>";
		}
		// Cuando no hay que eliminar la noticia.
		else
		{
			echo "<P ALIGN='center' CLASS='contenido'><B>LA ELIMINACION DE TU NOTICIA HA SIDO CANCELADA</B></P>";
			echo "<P CLASS='contenido'>Esta noticia no ha sido eliminada de la secci&oacute;n \"Noticias\" en nuestro sitio Web, por lo que cualquier persona de Chile y el mundo lo puede seguir viendo. Gracias por colaborar con nosotros.</P>";
		}
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
}
?>
