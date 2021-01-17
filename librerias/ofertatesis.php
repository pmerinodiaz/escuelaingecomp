<?PHP
/**
 * ofertatesis.php.
 * v. 1.0.
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
 * Clase que administra los registros de las ofertas de tesis existentes en la base de datos.
 * Las ofertas de tesis son temas enviados por los acedémicos de la Escuela a la comunidad
 * estudiantil para ser desarrollados por estos.
 */

class ofertatesis
{
	// Enlace a la base de datos.
	var $enlace;
	
	// Juego de caracteres especiales del servidor.
	var $caracteres;
	
	/**
	 * Constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function ofertatesis($link)
	{
		$this->enlace = $link;
		$this->caracteres = get_html_translation_table(HTML_SPECIALCHARS);
	}
	
	/**
	 * Método que muestra el título de la sección 'Ofertas de Tesis'.
	 */
	function mostrarTitulo()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Tesis'>Tesis</A> / Ofertas";
		$imagen = "activos/bgofertas.jpg";
		$titulo = "Ofertas de Tesis";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método en el cual se muestra (en forma paginada) las ofertas de tesis.
	 *
	 * @param $pagina El número de la página actual dentro de la paginación total.
	 */
	function mostrar($pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "index.php?";
		$porpagina = 5;
		
		// Imprimimos algo de información sobre las ofertas de tesis.
		if ($pagina == 1)
		{
			echo "<TABLE WIDTH='100%' BORDER='0' CELLSPACING='0' CELLPADDING='0'>";
			echo "<TR>";
			echo "<TD WIDTH='70%' CLASS='contenido'>";
			echo "Los temas de tesis y memorias ofrecidos aqu&iacute;, son para ser desarrollados como Tesis de Grado o Memoria de T&iacute;tulo por alumnos de la Escuela Ingenier&iacute;a en Computaci&oacute;n de la <A HREF='http://www.userena.cl' TARGET='_blank' TITLE='Visitar Web de Universidad de La Serena'>Universidad de La Serena</A>. Y fueron entregados por los <A HREF='../../integrantes/academicos/index.php' TITLE='Ver Acad&eacute;micos'>acad&eacute;micos</A> de nuestra Escuela.";
			echo "</TD>";
			echo "<TD WIDTH='30%' ALIGN='right' VALIGN='top'><IMG SRC='activos/logoofertas.jpg' WIDTH='150' HEIGHT='120'></TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>&nbsp;</TD>";
			echo "</TR>";
		}
		
		// Consulta que lista información de ofertas de tesis realizadas.
		$consulta = "SELECT envio.titulo_envio, persona.id_persona, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, envio.desc_envio, envio.fecha_envio, academico.id_tipo_academico FROM envio, oferta_tesis, persona, usuario_interno, academico WHERE envio.id_tipo_envio = 2 AND envio.id_envio = oferta_tesis.id_envio AND usuario_interno.id_estado_interno = 1 AND persona.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = academico.id_persona AND oferta_tesis.id_persona = academico.id_persona ORDER BY envio.fecha_envio DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no ofertas de tesis.
		if ($total == 0)
		{
			echo "<TR>";
			echo "<TD COLSPAN='2' CLASS='contenido'>No hay ofertas de tesis.</TD>";
			echo "</TR>";
		}
		
		// Cuando hay ofertas de tesis.
		else
		{
			if ($pagina == 1)
				echo "<TR>";
			
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			
			// Tabla para el total, la paginación y las ofertas de tesis.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total ofertas de tesis.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD>&nbsp;</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para las ofertas de tesis.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos las ofertas de tesis.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Imprimimos el título de la oferta de tesis.
				printf("<TR>");
				printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>T&iacute;tulo:</B></TD>", "15%");
				printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>%s</B></TD>", "85%", strtr($tupla["titulo_envio"], $this->caracteres));
				printf("</TR>");
				
				// Imprimimos el autor.
				printf("<TR>");
				printf("<TD CLASS='tabla' VALIGN='top'><B>Autor:</B></TD>");
				$nombre = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
				
				// Vemos el tipo de académico.
				switch ($tupla["id_tipo_academico"])
				{
					case 1: printf("<TD CLASS='tabla' VALIGN='top'><A HREF='../../integrantes/academicos/completa/curriculum.php?id=%d' TITLE='Ver Curr&iacute;culum de %s'>%s</A>", $tupla["id_persona"], $nombre, $nombre); break;
					case 2: printf("<TD CLASS='tabla' VALIGN='top'><A HREF='../../integrantes/academicos/media/curriculum.php?id=%d' TITLE='Ver Curr&iacute;culum de %s'>%s</A>", $tupla["id_persona"], $nombre, $nombre); break;
					case 3: printf("<TD CLASS='tabla' VALIGN='top'><A HREF='../../integrantes/academicos/part/curriculum.php?id=%d' TITLE='Ver Curr&iacute;culum de %s'>%s</A>", $tupla["id_persona"], $nombre, $nombre); break;
				}
				if ($tupla["email_persona"])
				{
					$email = strtr($tupla["email_persona"], $this->caracteres);
					printf(" (<A HREF='mailto:%s' TITLE='%s'>%s</A>)</TD>", $email, $email, $email);
				}
				printf("</TR>");
				
				// Imprimimos la descripción.
				printf("<TR>");
				printf("<TD COLSPAN='2' CLASS='tabla' VALIGN='top'>%s</TD>", nl2br(strtr($tupla["desc_envio"], $this->caracteres)));
				printf("</TR>");
				
				// Imprimimos la fecha de envío.
				printf("<TR>");
				printf("<TD COLSPAN='2' CLASS='tabla' VALIGN='top'><B>Enviada el %s</B></TD>", $tupla["fecha_envio"]);
				printf("</TR>");
				
				// Imprimimos un espacio en blanco.
				printf("<TR><TD>&nbsp;</TD></TR>");
			}
			
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
			echo "</TD>";
			
			if ($pagina == 1)
				echo "</TR>";
			
			// Imprimimos la paginación.
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
		}
		
		// Liberación de memoria en el servidor.
		mysql_free_result($resultado);
		
		// Cerramos la tabla.
		echo "</TABLE>";
		
		// Mostramos el formulario de búsqueda.
		$this->formularioBusqueda();
	}
	
	/**
	 * Método que muestra el formulario de búsqueda para las ofertas de tesis.
	 */
	function formularioBusqueda()
	{
		$titulo = "B&uacute;squeda de Ofertas de Tesis";
		$ocultos = "";
		$comentario = "ofertas de tesis";
		require("busquedasimple.inc");
	}
	
	/**
	 * Método que muestra el título de la sección 'Búsqueda de Ofertas de Tesis'.
	 */
	function tituloBusqueda()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Tesis'>Tesis</A> / <A HREF='index.php?pagina=1' TITLE='Ver Ofertas'>Ofertas</A> / B&uacute;squeda";
		$imagen = "activos/bgofertas.jpg";
		$titulo = "B&uacute;squeda de Ofertas de Tesis";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método en el cual se buscan (en forma paginada) las ofertas de tesis que coinciden en el
	 * título o la descripción o el nombre del autor, con la palabra ingresada por el usuario.
	 *
	 * @param $palabra La palabra o frase a buscar.
	 * @param $pagina El número de la página actual dentro de la paginación total.
	 */
	function buscar($palabra, $pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "index.php?palabra=" . $palabra . "&";
		$porpagina = 5;
		
		// Consulta que lista información de ofertas de tesis hechas.
		$consulta = "SELECT envio.titulo_envio, persona.id_persona, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, envio.desc_envio, envio.fecha_envio, academico.id_tipo_academico FROM envio, oferta_tesis, persona, usuario_interno, academico WHERE envio.id_tipo_envio = 2 AND (envio.titulo_envio LIKE '%$palabra%' OR envio.desc_envio LIKE '%$palabra%' OR persona.nombres_persona LIKE '%$palabra%' OR persona.paterno_persona LIKE '%$palabra%' OR persona.materno_persona LIKE '%$palabra%') AND envio.id_envio = oferta_tesis.id_envio AND usuario_interno.id_estado_interno = 1 AND persona.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = academico.id_persona AND oferta_tesis.id_persona = academico.id_persona ORDER BY envio.fecha_envio DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no fueron hayadas ofertas de tesis.
		if ($total == 0)
			echo "<P CLASS='contenido'>No fueron encotradas ofertas de tesis.</P>";
		
		// Cuando si fueron encontradas ofertas de tesis.
		else
		{
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			
			// Tabla para el menú, la navegación y la paginación.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total ofertas de tesis.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD>&nbsp;</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para las ofertas de tesis.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos las ofertas de tesis.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Imprimimos el título de la oferta de tesis.
				printf("<TR>");
				printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>T&iacute;tulo:</B></TD>", "15%");
				printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>%s</B></TD>", "85%", strtr($tupla["titulo_envio"], $this->caracteres));
				printf("</TR>");
				
				// Imprimimos el autor.
				printf("<TR>");
				printf("<TD CLASS='tabla' VALIGN='top'><B>Autor:</B></TD>");
				$nombre = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
				
				// Vemos el tipo de académico.
				switch ($tupla["id_tipo_academico"])
				{
					case 1: printf("<TD CLASS='tabla' VALIGN='top'><A HREF='../../integrantes/academicos/completa/curriculum.php?id=%d' TITLE='Ver Curr&iacute;culum de %s'>%s</A>", $tupla["id_persona"], $nombre, $nombre); break;
					case 2: printf("<TD CLASS='tabla' VALIGN='top'><A HREF='../../integrantes/academicos/media/curriculum.php?id=%d' TITLE='Ver Curr&iacute;culum de %s'>%s</A>", $tupla["id_persona"], $nombre, $nombre); break;
					case 3: printf("<TD CLASS='tabla' VALIGN='top'><A HREF='../../integrantes/academicos/part/curriculum.php?id=%d' TITLE='Ver Curr&iacute;culum de %s'>%s</A>", $tupla["id_persona"], $nombre, $nombre); break;
				}
				if ($tupla["email_persona"])
				{
					$email = strtr($tupla["email_persona"], $this->caracteres);
					printf(" (<A HREF='mailto:%s' TITLE='%s'>%s</A>)</TD>", $email, $email, $email);
				}
				printf("</TR>");
				
				// Imprimimos la descripción.
				printf("<TR>");
				printf("<TD COLSPAN='2' CLASS='tabla' VALIGN='top'>%s</TD>", nl2br(strtr($tupla["desc_envio"], $this->caracteres)));
				printf("</TR>");
				
				// Imprimimos la fecha de envío.
				printf("<TR>");
				printf("<TD COLSPAN='2' CLASS='tabla' VALIGN='top'><B>Enviada el %s</B></TD>", $tupla["fecha_envio"]);
				printf("</TR>");
				
				// Imprimimos un espacio en blanco.
				printf("<TR><TD>&nbsp;</TD></TR>");
			}
			
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
			echo "</TD>";
			echo "</TR>";
			
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
		$this->formularioBusqueda();
	}
	
	/**
	 * Método que muestra el formulario de envío de una nueva ofertas de tesis.
	 *
	 * @param $id_persona El identificador de la persona.
	 */
	function formularioAgregar($id_persona)
	{
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Capturamos la fecha actual.
		$fecha = date("Y-m-d");
		
		// Tabla en donde incorporamos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Agregar Oferta de Tesis</B></TD>";
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
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' TITLE='T&iacute;tulo de la oferta de tesis'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel' COLSPAN='2' ALIGN='center'>Texto:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='center'><TEXTAREA NAME='descripcion' CLASS='formtextarea' ROWS='10' TABINDEX='1' TITLE='Descripci&oacute;n de la oferta de tesis'></TEXTAREA> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
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
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='agregar' VALUE='Agregar' CLASS='formbutton' TABINDEX='1' TITLE='Agregar la oferta de tesis'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * Método que agrega una nueva oferta de tesis en la base de datos.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $titulo_envio El título de la oferta de tesis.
	 * @param $desc_envio La descripción de la oferta de tesis.
	 */
	function agregar($id_persona, $titulo_envio, $desc_envio)
	{
		// Obtener la fecha y hora actual.
		$fecha_envio = date("Y-m-d");
		$hora_envio = date("H:i:s");
		
		// Consulta para agregar el envio.
		$consulta = "INSERT INTO envio(id_tipo_envio, titulo_envio, desc_envio, fecha_envio, hora_envio) VALUES(2, '$titulo_envio', '$desc_envio', '$fecha_envio', '$hora_envio')";
		mysql_query($consulta, $this->enlace);
		
		// Obtener el identificador de la última inserción.
		$id_envio = mysql_insert_id();
		
		// Consulta para agregar la oferta de tesis.
		$consulta = "INSERT INTO oferta_tesis(id_envio, id_persona) VALUES($id_envio, $id_persona)";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de éxito de la operación.
		echo "<P ALIGN='center' CLASS='contenido'><B>TU OFERTA DE TESIS HA SIDO AGREGADA EXITOSAMENTE</B></P>";
		echo "<P CLASS='contenido'>Esta oferta de tesis estar&aacute; disponible en la secci&oacute;n \"Ofertas de Tesis\" de nuestro sitio Web, para que los alumnos de la carrera Ingeniería en Computación la vean. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
	
	/**
	 * Método que lista todas las ofertas de tesis realizadas por un usuario.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $vinculo La página destino de la operación.
	 */
	function listar($id_persona, $vinculo)
	{
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE persona.id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$usuario = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
		mysql_free_result($resultado);
		
		// Consulta para obtener la lista de ofertas de tesis realizadas por el usuario.
		$consulta = "SELECT envio.id_envio, envio.titulo_envio, envio.fecha_envio FROM envio, oferta_tesis, academico WHERE envio.id_envio = oferta_tesis.id_envio AND oferta_tesis.id_persona = $id_persona AND oferta_tesis.id_persona = academico.id_persona AND envio.id_tipo_envio = 2 ORDER BY fecha_envio DESC, hora_envio DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);		
		
		// Cuando no hay ofertas.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay ofertas de tesis realizadas por $usuario.</P>";
		
		// Cuando hay ofertas.
		else
		{
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='5' CLASS='contenido'>Hay un total de $total ofertas de tesis relizadas por $usuario:</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'>&nbsp;</TD>";
			echo "<TD WIDTH='70%' ALIGN='center' CLASS='titulotabla'><B>T&iacute;tulo</B></TD>";
			echo "<TD WIDTH='20%' ALIGN='center' CLASS='titulotabla'><B>Fecha</B></TD>";
			echo "</TR>";
			
			// Texto para enlazar a la operación.
			if ($vinculo == "modificar.php")
				$texto_vinculo = "Modificar";
			else $texto_vinculo = "Eliminar";
			
			// Imprimimos la lista de ofertas de tesis.
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				printf("<TD ALIGN='center' CLASS='tabla'><A HREF='$vinculo?id=%s' TITLE='%s Oferta de Tesis'>%s</A></TD>", $tupla["id_envio"], $texto_vinculo, $texto_vinculo);
				printf("<TD CLASS='tabla'>%s</TD>", $tupla["titulo_envio"]);
				printf("<TD ALIGN='center' CLASS='tabla'>%s</TD>", $tupla["fecha_envio"]);
				printf("</TR>");
			}
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);	
	}
	
	/**
	 * Método que muestra el formulario de modificación de una ofertas de tesis.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_envio El identificador del envío.
	 */
	function formularioModificar($id_persona, $id_envio)
	{
		// Consulta que obtiene los antecedentes de la oferta de tesis con identificación conocida.
		$consulta = "SELECT envio.id_envio, envio.titulo_envio, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, envio.fecha_envio, envio.desc_envio FROM envio, oferta_tesis, academico, persona WHERE envio.id_envio = $id_envio AND oferta_tesis.id_persona = $id_persona AND envio.id_envio = oferta_tesis.id_envio AND oferta_tesis.id_persona = academico.id_persona AND envio.id_tipo_envio = 2 AND academico.id_persona = persona.id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Tabla en donde incorporamos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Modificar Oferta de Tesis</B></TD>";
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
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' VALUE='" . $tupla["titulo_envio"] . "' TITLE='T&iacute;tulo de la oferta de tesis'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel' COLSPAN='2' ALIGN='center'>Texto:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='center'><TEXTAREA NAME='descripcion' CLASS='formtextarea' ROWS='10' TABINDEX='1' TITLE='Descripci&oacute;n de la oferta de tesis'>" . $tupla["desc_envio"] . "</TEXTAREA> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
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
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar la oferta de tesis'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * Método que modifica una oferta de tesis.
	 *
	 * @param $id_envio El identificador del envío.
	 * @param $titulo_envío El título de la oferta de tesis.
	 * @param $desc_envio La descripción de la oferta de tesis.
	 */
	function modificar($id_envio, $titulo_envio, $desc_envio)
	{
		// Obtener la fecha y hora actual.
		$fecha_envio = date("Y-m-d");
		$hora_envio = date("H:i:s");
		
		// Consulta para actualizamos la tabla 'envio'.
		$consulta = "UPDATE envio SET titulo_envio = '$titulo_envio', desc_envio = '$desc_envio', fecha_envio = '$fecha_envio', hora_envio = '$hora_envio' WHERE id_envio = $id_envio";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de éxito de la operación
		echo "<P ALIGN='center' CLASS='contenido'><B>TU OFERTA DE TESIS HA SIDO MODIFICADA EXITOSAMENTE</B></P>";	
		echo "<P CLASS='contenido'>Los datos de la oferta de tesis han cambiado. Esta oferta de tesis est&aacute; disponible en la secci&oacute;n \"Tesis\" de nuestro sitio Web, para que los alumnos de la carrera Ingeniería en Computación la vean. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
	
	/**
	 * Método que muestra el formulario de eliminación de una oferta de tesis.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_envio El identificador del envío.
	 */
	function formularioEliminar($id_persona, $id_envio)
	{
		// Consulta que obtiene los antecedentes de la oferta de tesis con identificación conocida..
		$consulta = "SELECT envio.id_envio, envio.titulo_envio, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, envio.fecha_envio, envio.desc_envio FROM envio, oferta_tesis, academico, persona WHERE envio.id_envio = $id_envio AND oferta_tesis.id_persona = $id_persona AND envio.id_envio = oferta_tesis.id_envio AND oferta_tesis.id_persona = academico.id_persona AND envio.id_tipo_envio = 2 AND academico.id_persona = persona.id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Tabla en donde incorporamos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Eliminar Oferta de Tesis</B></TD>";
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
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' TABINDEX='1' VALUE='" . $tupla["titulo_envio"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Fecha de Env&iacute;o:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='fecha' CLASS='formtextfield' DISABLED='true' MAXLENGTH='10' TABINDEX='1' VALUE='" . $tupla["fecha_envio"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel' COLSPAN='2' ALIGN='center'>Texto:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='center'><TEXTAREA NAME='descripcion' CLASS='formtextarea' ROWS='10' DISABLED='true' TABINDEX='1'>" . $tupla["desc_envio"] . "</TEXTAREA></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>¿Confirma que deseas eliminar esta oferta de tesis?</TD>";
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
	 * Método que elimina una oferta de tesis de la base de datos.
	 *
	 * @param $id_envio El identificador del envío.
	 * @param $confirmar Si el usuario desea o no eliminar la oferta de tesis.
	 */
	function eliminar($id_envio, $confirmar)
	{
		// Cuando hay que eliminar la oferta de tesis.
		if ($confirmar == 1)
		{
			// Consulta para borrar el registro en la tabla 'oferta_tesis'.
			$consulta = "DELETE FROM oferta_tesis WHERE id_envio = $id_envio";
			mysql_query($consulta, $this->enlace);
			
			// Consulta para borrar el registro en la tabla 'envio'.
			$consulta = "DELETE FROM envio WHERE id_envio = $id_envio";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos el mesaje de éxito de la operación.
			echo "<P ALIGN='center' CLASS='contenido'><B>TU OFERTA DE TESIS HA SIDO ELIMINADA EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Esta oferta de tesis ha sido eliminada de los registros que se encuentran en la secci&oacute;n \"Tesis\" de nuestro sitio Web. Gracias por colaborar con nosotros.</P>";
		}
		// Cuando no hay que eliminar la oferta de tesis.
		else
		{
			echo "<P ALIGN='center' CLASS='contenido'><B>LA ELIMINACION DE TU OFERTA DE TESIS HA SIDO CANCELADA</B></P>";
			echo "<P CLASS='contenido'>Esta oferta de tesis no ha sido eliminada de los registros que se encuentran en la secci&oacute;n \"Tesis\" de nuestro sitio Web, por lo que los alumnos de la carrera Ingeniería en Computación la pueden seguir viendo. Gracias por colaborar con nosotros.</P>";
		}
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
}
?>