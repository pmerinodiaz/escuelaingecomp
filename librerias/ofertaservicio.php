<?PHP
/**
 * ofertaservicio.php.
 * v.1.0.
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
 * Clase que administra los registros de las ofertas de servicios enviadas por los integrantes
 * de la Escuela IC a la comunidad exterior y que están guardados en la base de datos.
 */

class ofertaservicio
{
	// Enlace a la base de datos.
	var $enlace;
	
	// Juego de caracteres especiales del servidor.
	var $caracteres;
	
	/**
	 * Método constructor que inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function ofertaservicio($link)
	{
		$this->enlace = $link;
		$this->caracteres = get_html_translation_table(HTML_SPECIALCHARS);
	}
	
	/**
	 * Método que muestra las últimas 3 ofertas de servicio incorporados recientemente.
	 */
	function destacadas()
	{
		$consulta = "SELECT persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, envio.titulo_envio, envio.desc_envio, envio.fecha_envio, oferta_servicio.inicio_oferta_servicio, oferta_servicio.fin_oferta_servicio, servicio.nombre_servicio FROM persona, envio, oferta_servicio, usuario_interno, servicio WHERE envio.id_tipo_envio = 5 AND persona.id_persona = usuario_interno.id_persona AND envio.id_envio = oferta_servicio.id_envio AND oferta_servicio.id_persona = usuario_interno.id_persona AND oferta_servicio.id_servicio = servicio.id_servicio ORDER BY envio.fecha_envio DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando hay ofertas.
		if ($total > 0)
		{
			// Contador para los ofertas.
			$contador = 0;
			
			// Creamos un objeto tiempo.
			$tiempo = new tiempo();
			
			// Tabla para los ofertas.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='2' ALIGN='center' BGCOLOR='F1F1F1' CLASS='contenido'><B>Ultimas ofertas</B></TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='1' HEIGHT='5'></TD></TR>";
			
			// Imprimimos las 3 primeras ofertas arrojadas por la consulta.
			while (($tupla = mysql_fetch_array($resultado)) && ($contador < 3))
			{
				$this->item($tupla, $tiempo, true);
				$contador++;
			}
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
		}
		
		// Liberación de memoria del servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que imprime las ofertas de servicios.
	 *
	 * @param $tupla La fila del resultado del query que se imprime.
	 * @param $tiempo El objeto tiempo.
	 * @param $esdestacada Si la oferta de servicio es o no destacada.
	 */
	function item($tupla, $tiempo, $esdestacada)
	{
		// Imprimimos el título de la oferta de servicio.
		printf("<TR>");
		printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>T&iacute;tulo:</B></TD>", "23%");
		printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>%s</B>", "77%", strtr($tupla["titulo_envio"], $this->caracteres));
		if ($tiempo->entreLapso($tupla["fecha_envio"], 24))
			printf(" <IMG SRC='../../librerias/iconuevo.gif'>");
		printf("</TD>");
		printf("</TR>");
		
		// Imprimimos el servicio al cual corresponde, en el caso de las destacadas.
		if ($esdestacada)
		{
			printf("<TR>");
			printf("<TD CLASS='tabla' VALIGN='top'><B>Servicio:</B></TD>");
			printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $tupla["nombre_servicio"]);
			printf("</TR>");
		}
		
		// Imprimimos el autor del mensaje y su email, si existe.
		printf("<TR>");
		printf("<TD CLASS='tabla' VALIGN='top'><B>Autor:</B></TD>");
		$nombre = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
		printf("<TD CLASS='tabla' VALIGN='top'>%s", $nombre);
		if ($tupla["email_persona"])
		{
			$email = strtr($tupla["email_persona"], $this->caracteres);
			printf(" (<A HREF='mailto:%s' TITLE='%s'>%s</A>)", $email, $email, $email);
		}
		printf("</TD>");
		printf("</TR>");	
		
		// Imprimimos la fecha de inicio y termino.
		printf("<TR>");
		printf("<TD CLASS='tabla' VALIGN='top'><B>Inicio / T&eacute;rmino:</B></TD>");
		printf("<TD CLASS='tabla' VALIGN='top'>%s / %s</TD>", $tupla["inicio_oferta_servicio"], $tupla["fin_oferta_servicio"]);
		printf("</TR>");
		
		// Imprimimos la descripcion.
		printf("<TR>");
		printf("<TD CLASS='tabla' COLSPAN='2'>%s</TD>", nl2br(strtr($tupla["desc_envio"], $this->caracteres)));
		printf("</TR>");
		
		// Imprimimos un espacio en blanco.
		echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
	}
	
	/**
	 * Método que muestra el título de la sección Ofertas de servicios.
	 *
	 * @param $id_servicio El identificador del servicio.
	 */
	function mostrarTitulo($id_servicio)
	{
		// Librerías necesarias.
		include("servicio.php");
		
		// Creamos un objeto servicio y capturamos el nombre.
		$servicio = new servicio($this->enlace);
		$nombre = $servicio->nombre($id_servicio);
		
		// Imprimimos el título.
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Servicios'>Servicios</A> / <A HREF='index.php' TITLE='Ver Ofertas'>Ofertas</A> / " . $nombre;
		$imagen = "activos/bgofertas.jpg";
		$titulo = $nombre;
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra (en forma paginada) las ofertas de servicios existentes en la Base
	 * de Datos.
	 *
	 * @param $id_servicio El identificador del servicio.
	 * @param $pagina La página actual dentro de la paginación total.
	 */
	function mostrar($id_servicio, $pagina)
	{
		// Librerias necesarias.
		include("paginacion.php");
		include("tiempo.php");
		
		// Inicialización de variables.
		$vinculo = "servicios.php?id=" . $id_servicio . "&";
		$porpagina = 5;
		
		// Realizamos la consulta.
		$consulta = "SELECT persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, envio.titulo_envio, envio.desc_envio, envio.fecha_envio, oferta_servicio.inicio_oferta_servicio, oferta_servicio.fin_oferta_servicio FROM persona, envio, oferta_servicio, usuario_interno WHERE oferta_servicio.id_servicio = $id_servicio AND envio.id_tipo_envio = 5 AND persona.id_persona = usuario_interno.id_persona AND envio.id_envio = oferta_servicio.id_envio AND oferta_servicio.id_persona = usuario_interno.id_persona ORDER BY envio.fecha_envio DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay servicios.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay ofertas de servicios.</P>";
		// Cuando hay servicios.
		else
		{
			// Creamos un objeto paginacion y un objeto tiempo.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$tiempo = new tiempo();
			
			// Abrimos la tabla para el total, la paginación y las ofertas de servicios.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total ofertas de servicios.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD>&nbsp;</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Abrimos la tabla para las ofertas.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos las ofertas.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				$this->item($tupla, $tiempo, false);
			}
			
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
			echo "</TD>";
			
			// Imprimimos la paginación.			
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "</TABLE>";
		}
		
		// Liberación de memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda.
		$this->formularioBusqueda($id_servicio);
	}
	
	/**
	 * Método que muestra el formulario de búsqueda para las ofertas de servicios.
	 *
	 * @param $id_servicio El identificador del servicio.
	 */
	function formularioBusqueda($id_servicio)
	{
		$titulo = "B&uacute;squeda de Ofertas de Servicios";
		$ocultos = "<INPUT TYPE='hidden' NAME='id' VALUE='$id_servicio'>";
		$comentario = "ofertas de servicios";
		require("busquedasimple.inc");
	}
	
	/**
	 * Método para titulo de una busqueda de ofertas de servicio.
	 *
	 * @param $id_servicio El identificador del servicio.
	 */
	function tituloBusqueda($id_servicio)
	{
		// Librerías necesarias.
		include("servicio.php");
		
		// Creamos un objeto servicio y capturamos el nombre.
		$servicio = new servicio($this->enlace);
		$nombre = $servicio->nombre($id_servicio);
		
		// Imprimimos el título.
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Servicios'>Servicios</A> / <A HREF='index.php' TITLE='Ver Ofertas'>Ofertas</A> / <A HREF='servicios.php?id=$id_servicio&pagina=1' TITLE='Ver " . $nombre . "'>" . $nombre . "</A> /";
		$imagen = "activos/bgofertas.jpg";
		$titulo = "B&uacute;squeda de Ofertas de Servicios";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra (en forma paginada) las ofertas de servicios existentes en la
	 * base de datos y que coinciden con la palabra ingresada por el usuario.
	 *
	 * @param $id_servicio El identificador del servicio.
	 * @param $palabra La palabra o frase a buscar en las ofertas de servicio.
	 * @param $pagina El número de la página actual dentro de la paginación total.
	 */
	function buscar($id_servicio, $palabra, $pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		include("tiempo.php");
		
		// Inicialización de variables.
		$vinculo = "buscar.php?id=" . $id_servicio . "&palabra=" . $palabra . "&";
		$porpagina = 5;
		
		// Realizamos la consulta.
		$consulta = "SELECT persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, envio.titulo_envio, envio.desc_envio, envio.fecha_envio, oferta_servicio.inicio_oferta_servicio, oferta_servicio.fin_oferta_servicio FROM persona, envio, oferta_servicio, usuario_interno WHERE oferta_servicio.id_servicio = $id_servicio AND envio.id_tipo_envio = 5 AND persona.id_persona = usuario_interno.id_persona AND envio.id_envio = oferta_servicio.id_envio AND oferta_servicio.id_persona = usuario_interno.id_persona AND (envio.titulo_envio LIKE '%$palabra%' OR envio.desc_envio LIKE '%$palabra%') ORDER BY envio.fecha_envio DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay ofertas.
		if ($total == 0)
			echo "<P CLASS='contenido'>No se encontraron ofertas de servicios.</P>";
		// Cuando hay ofertas.
		else
		{
			// Creamos un objeto paginacion y un objeto tiempo.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$tiempo = new tiempo();
			
			// Abrimos la tabla para el total, la paginación y las ofertas de servicios.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total ofertas de servicios.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD>&nbsp;</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Abrimos la tabla para las ofertas.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos las ofertas.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				$this->item($tupla, $tiempo, false);
			}
			
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
			echo "</TD>";
			
			// Imprimimos la paginación.
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "</TABLE>";
		}
		
		// Liberación de memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda.
		$this->formularioBusqueda($id_servicio);
	}
	
	/**
	 * Método que muestra el formulario de envío de una nueva ofertas de servicio.
	 *
	 * @param $id_persona El identificador de la persona.
	 */
	function formularioAgregar($id_persona)
	{
		// Librerías necesarias.
		include("tiposervicio.php");
		
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Fecha actual del sistema.
		$fecha = date("Y-m-d");
		
		// Tabla para imprimir el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Agregar Oferta de Servicio</B></TD>";
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
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' TITLE='T&iacute;tulo de la oferta de servicio'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Fecha de Inicio:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='inicio' CLASS='formtextfield' MAXLENGTH='10' VALUE='$fecha' TABINDEX='1' TITLE='Fecha de inicio de la oferta de servicio (aa-mm-dd)'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Fecha de T&eacute;rmino:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='termino' CLASS='formtextfield' MAXLENGTH='10' TABINDEX='1' TITLE='Fecha de t&eacute;rmino de la oferta de servicio (aa-mm-dd)'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Servicio:</TD>";
		echo "<TD>";
		$tipo_servicio = new tiposervicio($this->enlace);
		$tipo_servicio->select(0);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel' COLSPAN='2' ALIGN='center'>Texto:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='center'><TEXTAREA NAME='descripcion' CLASS='formtextarea' ROWS='10' TABINDEX='1' TITLE='Descripci&oacute;n de la oferta de servicio'></TEXTAREA> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
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
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='agregar' VALUE='Agregar' CLASS='formbutton' TABINDEX='1' TITLE='Agregar la oferta de servicio'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * Método que agrega una nueva oferta de servicio a la base de datos.
	 *
	 * @param $titulo El título de la oferta de servicio.
	 * @param $id_persona El identificador de la persona.
	 * @param $inicio La fecha de inicio de la oferta de servicio.
	 * @param $termino La fecha de término de la oferta de servicio.
	 * @param $descripcion La descripción de la oferta de servicio.
	 */
	function agregar($titulo, $id_persona, $inicio, $termino, $tipo_servicio, $descripcion)
	{
		// Obtener la fecha y hora actual.
		$fecha = date("Y-m-d");
		$hora = date("H:i:s");
		
		// Consulta para agregar el envio.
		$consulta = "INSERT INTO envio(id_tipo_envio, titulo_envio, desc_envio, fecha_envio, hora_envio) VALUES(5, '$titulo', '$descripcion', '$fecha', '$hora')";
		mysql_query($consulta, $this->enlace);
		
		// Obtener el identificador de la última inserción.
		$id_envio = mysql_insert_id();
		
		// Consulta para agregar la oferta de servicio.
		$consulta = "INSERT INTO oferta_servicio(id_envio, id_servicio, id_persona, inicio_oferta_servicio, fin_oferta_servicio) VALUES($id_envio, $tipo_servicio, $id_persona, '$inicio', '$termino')";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de éxito de la operación.
		echo "<P ALIGN='center' CLASS='contenido'><B>TU OFERTA DE SERVICIO HA SIDO INGRESADA EXITOSAMENTE</B></P>";
		echo "<P CLASS='contenido'>Esta oferta de servicio estar&aacute; disponible en la secci&oacute;n \"Ofertas de Servicios\" de nuestro sitio Web, para cualquier persona de Chile y el mundo la vea. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
	
	/**
	 * Método que lista todas las ofertas de servicio realizadas por un usuario.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $vinculo El URL destino de la operación.
	 */
	function listar($id_persona, $vinculo)
	{
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE persona.id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$usuario = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
		mysql_free_result($resultado);
		
		// Consulta para obtener la lista de ofertas de servicio realizadas por el usuario.
		$consulta = "SELECT envio.id_envio, envio.titulo_envio, oferta_servicio.inicio_oferta_servicio, oferta_servicio.fin_oferta_servicio, servicio.nombre_servicio FROM envio, oferta_servicio, servicio WHERE envio.id_envio = oferta_servicio.id_envio AND oferta_servicio.id_persona = $id_persona AND oferta_servicio.id_servicio = servicio.id_servicio AND envio.id_tipo_envio = 5 ORDER BY fecha_envio, hora_envio";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);		
		
		// Cuando no hay ofertas.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay ofertas de servicios realizadas por $usuario.</P>";
		
		// Listamos todas las ofertas para este usuario.
		else
		{
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='5' CLASS='contenido'>Hay un total de $total ofertas de servicios relizadas por $usuario:</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'>&nbsp;</TD>";
			echo "<TD WIDTH='35%' ALIGN='center' CLASS='titulotabla'><B>T&iacute;tulo</B></TD>";
			echo "<TD WIDTH='21%' ALIGN='center' CLASS='titulotabla'><B>Tipo de Servicio</B></TD>";
			echo "<TD WIDTH='17%' ALIGN='center' CLASS='titulotabla'><B>Fecha de Inicio</B></TD>";
			echo "<TD WIDTH='17%' ALIGN='center' CLASS='titulotabla'><B>Fecha de T&eacute;rmino</B></TD>";
			echo "</TR>";
			
			// Texto para enlazar a la operación.
			if ($vinculo == "modificar.php")
				$texto_vinculo = "Modificar";
			else $texto_vinculo = "Eliminar";
			
			// Imprimimos la lista de ofertas de servicios.			
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				printf("<TD ALIGN='center' CLASS='tabla'><A HREF='$vinculo?id=%s' TITLE='%s Oferta de Servicio'>%s</A></TD>", $tupla["id_envio"], $texto_vinculo, $texto_vinculo);
				printf("<TD CLASS='tabla'>%s</TD>", $tupla["titulo_envio"]);
				printf("<TD ALIGN='center' CLASS='tabla'>%s</TD>", $tupla["nombre_servicio"]);
				printf("<TD ALIGN='center' CLASS='tabla'>%s</TD>", $tupla["inicio_oferta_servicio"]);
				printf("<TD ALIGN='center' CLASS='tabla'>%s</TD>", $tupla["fin_oferta_servicio"]);	
				printf("</TR>");
			}
			echo "</TABLE>";
		}
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);	
	}
	
	/**
	 * Método que muestra un formulario en donde se permite modificar una oferta de servicio
	 * realizada anteriormente por un usuario.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_envio El identificador del envío.
	 */
	function formularioModificar($id_persona, $id_envio)
	{
		// Librerías necesarias.
		include("tiposervicio.php");
		
		// Consulta que obtiene la información de la oferta de servicio.
		$consulta = "SELECT envio.id_envio, envio.titulo_envio, envio.desc_envio, servicio.id_servicio, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, oferta_servicio.inicio_oferta_servicio, oferta_servicio.fin_oferta_servicio FROM envio, oferta_servicio, servicio, persona WHERE envio.id_envio = oferta_servicio.id_envio AND oferta_servicio.id_envio = $id_envio AND oferta_servicio.id_persona = $id_persona AND oferta_servicio.id_persona = persona.id_persona AND oferta_servicio.id_servicio = servicio.id_servicio AND envio.id_tipo_envio = 5";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);		
		
		// Tabla en donde mostramos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Modificar Oferta de Servicio</B></TD>";
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
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' VALUE='" . $tupla["titulo_envio"] . "' TABINDEX='1' TITLE='T&iacute;tulo de la oferta de servicio'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Fecha de Inicio:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='inicio' CLASS='formtextfield' MAXLENGTH='10' VALUE='" . $tupla["inicio_oferta_servicio"] . "' TABINDEX='1' TITLE='Fecha de inicio de la oferta de servicio (aa-mm-dd)'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Fecha de T&eacute;rmino:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='termino' CLASS='formtextfield' MAXLENGTH='10' VALUE='" . $tupla["fin_oferta_servicio"] . "' TABINDEX='1' TITLE='Fecha de t&eacute;rmino de la oferta de servicio (aa-mm-dd)'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Servicio:</TD>";
		echo "<TD>";
		$tipo_servicio = new tiposervicio($this->enlace);
		$tipo_servicio->select($tupla["id_servicio"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='center' CLASS='formlabel'>Texto:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='center'><TEXTAREA NAME='descripcion' CLASS='formtextarea' ROWS='10' TABINDEX='1' TITLE='Descripci&oacute;n de la oferta de servicio'>" . $tupla["desc_envio"] . "</TEXTAREA> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD><INPUT TYPE='hidden' NAME='id_envio' VALUE='" . $tupla["id_envio"] . "'></TD>";
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
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar la oferta de servicio'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * Método que modifica una oferta de servicio.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $titulo El título de la oferta de servicio.
	 * @param $inicio La fecha de inicio de la oferta de servicio.
	 * @param $termino La fecha de término de la oferta de servicio.
	 * @param $descripcion La descripción de la oferta de servicio.
	 * @param $id_envio El identificador del envío.
	 */
	function modificar($id_persona, $titulo, $inicio, $termino, $servicio, $descripcion, $id_envio)
	{
		// Consulta para modificar el envio.
		$consulta = "UPDATE envio SET titulo_envio = '$titulo', desc_envio = '$descripcion' WHERE id_envio = $id_envio";
		mysql_query($consulta, $this->enlace);
		
		// Consulta para modificar la oferta de servicio.
		$consulta = "UPDATE oferta_servicio SET id_servicio = $servicio, inicio_oferta_servicio = '$inicio', fin_oferta_servicio = '$termino' WHERE id_envio = $id_envio AND id_persona = $id_persona";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de éxito de la operación.
		echo "<P ALIGN='center' CLASS='contenido'><B>TU OFERTA DE SERVICIO HA SIDO MODIFICADA EXITOSAMENTE</B></P>";
		echo "<P CLASS='contenido'>Esta oferta de servicio est&aacute; disponible en la secci&oacute;n \"Ofertas de Servicios\" de nuestro sitio Web, para cualquier persona de Chile y el mundo la vea. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
	
	/**
	 * Método que muestra un formulario con información de una oferta de servicio.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_envio El identificador del envío.
	 */
	function formularioEliminar($id_persona, $id_envio)
	{
		// Consulta para obtener la información de la oferta de servicio.
		$consulta = "SELECT envio.id_envio, envio.titulo_envio, envio.desc_envio, servicio.nombre_servicio, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, oferta_servicio.inicio_oferta_servicio, oferta_servicio.fin_oferta_servicio FROM envio, oferta_servicio, servicio, persona WHERE envio.id_envio = oferta_servicio.id_envio AND oferta_servicio.id_envio = $id_envio AND oferta_servicio.id_persona=$id_persona and oferta_servicio.id_persona=persona.id_persona and oferta_servicio.id_servicio=servicio.id_servicio and envio.id_tipo_envio=5";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);		
		
		// Tabla para el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Eliminar Oferta de Servicio</B></TD>";
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
		echo "<TD CLASS='formlabel'>Fecha de Inicio:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='inicio' CLASS='formtextfield' DISABLED='true' MAXLENGTH='10' VALUE='" . $tupla["inicio_oferta_servicio"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Fecha de T&eacute;rmino:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='termino' CLASS='formtextfield' DISABLED='true' MAXLENGTH='10' VALUE='" . $tupla["fin_oferta_servicio"] . "'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Servicio:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='tipo_servicio' CLASS='formtextfield' DISABLED='true' MAXLENGTH='30' VALUE='" . $tupla["nombre_servicio"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='center' CLASS='formlabel'>Texto:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='center'><TEXTAREA NAME='descripcion' CLASS='formtextarea' DISABLED='true' ROWS='10'>" . $tupla["desc_envio"] . "</TEXTAREA></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";	
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>¿Confirma que deseas eliminar esta oferta de servicio?</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='confirmar' CHECKED='true' VALUE='1'>Si<BR><INPUT TYPE='radio' NAME='confirmar' VALUE='0'>No</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_envio' VALUE='" . $tupla["id_envio"] . "'></TD>";
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
	 * Método que elimina una oferta de servicio de la base de datos.
	 *
	 * @param $id_envio El identificador del envío.
	 * @param $confirmar Si el usuario quiere eleiminar la oferta de servicio o no.
	 */
	function eliminar($id_envio, $confirmar)
	{
		if ($confirmar == 1)
		{
			// Borramos el registro en la tabla 'oferta_servicio'.
			$consulta = "DELETE FROM oferta_servicio WHERE id_envio = $id_envio";
			mysql_query($consulta, $this->enlace);
			
			// Borramos el registro en la tabla 'envio'.
			$consulta = "DELETE FROM envio WHERE id_envio = $id_envio";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos el mesaje de éxito de la operación.
			echo "<P ALIGN='center' CLASS='contenido'><B>TU OFERTA DE SERVICIO HA SIDO ELIMINADA EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Esta oferta de servicio ha sido eliminada de la secci&oacute;n \"Ofertas de Servicios\" en nuestro sitio Web. Gracias por colaborar con nosotros.</P>";
		}
		else
		{
			echo "<P ALIGN='center' CLASS='contenido'><B>LA ELIMINACION DE TU OFERTA DE SERVICIO HA SIDO CANCELADA</B></P>";
			echo "<P CLASS='contenido'>Esta oferta de servicio no ha sido eliminada de la secci&oacute;n \"Ofertas de Servicios\" en nuestro sitio Web, por lo que cualquier persona de Chile y el mundo la puede seguir viendo. Gracias por colaborar con nosotros.</P>";
		}
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
}
?>