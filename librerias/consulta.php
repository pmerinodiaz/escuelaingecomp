<?PHP
/**
 * consulta.php.
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
 * Clase que contiene los métodos y variables que administran las consultas realizadas
 * por los usuarios a este sitio Web. Las consultas son preguntas, sugerencias o reclamos
 * que envían las personas al sitio Web através de formularios.
 */

class consulta
{
	// Enlace a la base de datos.
	var $enlace;
	
	// Juego de caracteres especiales del servidor.
	var $caracteres;
	
	/**
	 * Método constructor en donde se inicializa el enlace a la base de datos y el juego de
	 * caracteres del servidor.
	 *
	 * @param $link Conexión hacia una base de datos que ya ha sido establecida.
	 */
	function consulta($link)
	{
		$this->enlace = $link;
		$this->caracteres = get_html_translation_table(HTML_SPECIALCHARS);
	}
	
	/**
	 * Método que muestra el título de la sección Consultas de Admisión.
	 */
	function tituloConsultasAdmision()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Admisi&oacute;n'>Admisi&oacute;n</A> / Consultas";
		$imagen = "activos/bgconsultas.gif";
		$titulo = "Consultas sobre la Admisi&oacute;n";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra de forma paginada las consultas de cierto tipo, que ya han sido
	 * contestadas por el Webmaster de este sitio Web.
	 *
	 * @param $id_tipo_pregunta El identificador del tipo de pregunta.
	 * @param $pagina El número de la página en donde está el usuario.
	 */
	function mostrar($id_tipo_pregunta, $pagina)
	{
		// Librerias necesarias
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "index.php?";
		$porpagina = 5;
		
		// Cuando es la primera página y las consultas son de tipo 'Admisión'.
		if ($pagina == 1 && $id_tipo_pregunta == 4)
		{
			// Imprimimos algo de información sobre las consultas de admisión.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLSPACING='0' CELLPADDING='0'>";
			echo "<TR>";
			echo "<TD WIDTH='70%' CLASS='contenido'>";
			echo "En esta secci&oacute;n se encuentran publicadas las consultas/respuestas que tienen relaci&oacute;n con el proceso de admisi&oacute;n a la carrera de Ingenier&iacute;a en Computaci&oacute;n de la <A HREF='http://www.userena.cl' TARGET='_blank' TITLE='Visitar Web de Universidad de La Serena'>Universidad de La Serena</A>.";
			echo "</TD>";
			echo "<TD WIDTH='30%' ALIGN='right' VALIGN='top'><IMG SRC='activos/logoconsultas.jpg' WIDTH='150' HEIGHT='98'></TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>&nbsp;</TD>";
			echo "</TR>";
		}
		
		// Cuando es la primera página y las consultas son las 'Preguntas Frecuentes'.
		if ($pagina == 1 && $id_tipo_pregunta == 5)
		{
			//  Imprimimos algo de información sobre las preguntas frecuentes.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLSPACING='0' CELLPADDING='0'>";
			echo "<TR>";
			echo "<TD WIDTH='80%' CLASS='contenido'>";
			echo "<P>En esta secci&oacute;n se encuentran publicadas las respuestas a muchas de tus preguntas sobre nuestro servicio.</P>";
			echo "<P>Si tienes alguna duda sobre el servicio que presta la Escuela Ingenier&iacute;a en Computaci&oacute;n de la <A HREF='http://www.userena.cl' TARGET='_blank' TITLE='Visitar Web de Universidad de La Serena'>Universidad de La Serena</A>, te recomendamos que antes de hacernolas saber, busques primero en esta secci&oacute;n si tu duda ya fue contestada.</P>";
			echo "</TD>";
			echo "<TD WIDTH='20%' ALIGN='left' VALIGN='middle'><IMG SRC='activos/logofaq.gif' WIDTH='75' HEIGHT='65'></TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>&nbsp;</TD>";
			echo "</TR>";
		}
		
		// Consulta que obtiene todas las consultas respondidas, ordenadas por orden de llegada.
		$consulta = "SELECT envio.titulo_envio, pregunta.desc_respuesta, envio.fecha_envio, persona.nombres_persona, persona.paterno_persona, persona.email_persona FROM envio, pregunta, persona WHERE pregunta.id_tipo_pregunta = $id_tipo_pregunta AND pregunta.id_estado_pregunta = 1 AND envio.id_envio = pregunta.id_envio AND pregunta.id_persona = persona.id_persona ORDER BY envio.fecha_envio DESC, titulo_envio";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay consultas.
		if ($total == 0)
		{
			echo "<TR>";
			// Preguntamos por el tipo de consulta para mostrar mensajes.
			switch ($id_tipo_pregunta)
			{
				case 4: echo "<TD COLSPAN='2' CLASS='contenido'>No hay consultas sobre la admisi&oacute;n.</TD>"; break;
				case 5: echo "<TD COLSPAN='2' CLASS='contenido'>No hay preguntas frecuentes.</TD>"; break;
			}
			echo "</TR>";
		}
		// Cuando si hay consultas.
		else
		{
			if ($pagina == 1)
				echo "<TR>";
			
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			
			// Abrimos la tabla para el total, la paginación y las consultas.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR>";
			
			// Preguntamos por el tipo de pregunta para imprimir el icono para agregar una consulta.
			switch ($id_tipo_pregunta)
			{
				case 4: echo "<TD COLSPAN='2' CLASS='tema' ALIGN='right'><A HREF='agregar.php' TITLE='Agregar consulta sobre la admisi&oacute;n'><IMG SRC='../../librerias/icoagregaconsulta.gif' BORDER='0'> AGREGAR CONSULTA</A></TD>"; break;
				case 5: echo "<TD COLSPAN='2' CLASS='tema' ALIGN='right'><A HREF='agregar.php' TITLE='Agregar pregunta'><IMG SRC='../librerias/icoagregaconsulta.gif' BORDER='0'> AGREGAR PREGUNTA</A></TD>"; break;
			}
			
			echo "</TR>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			
			// Preguntamos por el tipo de pregunta para mostrar mensajes.
			switch ($id_tipo_pregunta)
			{
				case 4: echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total consultas sobre la admisi&oacute;n.</TD>"; break;
				case 5: echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total preguntas frecuentes.</TD>"; break;
			}
			
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD>&nbsp;</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Abrimos la tabla para las consultas.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos las consultas.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Imprimimos la pregunta.
				printf("<TR>");
				printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>Pregunta:</B></TD>", "20%");
				printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>%s</B></TD>", "80%", strtr($tupla["titulo_envio"], $this->caracteres));
				printf("</TR>");
				
				// Imprimimos la respuesta.
				printf("<TR>");
				printf("<TD CLASS='tabla' VALIGN='top'><B>Respuesta:</B></TD>");
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", nl2br(strtr($tupla["desc_respuesta"], $this->caracteres)));
				printf("</TR>");
				
				// Imprimimos la persona y la fecha de realización.
				$email = strtr($tupla["email_persona"], $this->caracteres);
				printf("<TR>");
				printf("<TD COLSPAN='2' CLASS='tabla' VALIGN='TOP'>Enviada por <A HREF='mailto:%s' TITLE='%s'>%s %s</A> el %s</TD>", $email, $email, $tupla["nombres_persona"], $tupla["paterno_persona"], $tupla["fecha_envio"]);
				printf("</TR>");
				
				// Imprimimos un espacio en blanco.
				printf("<TR>");
				printf("<TD>&nbsp;</TD>");
				printf("</TR>");
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
		echo "</TABLE>";
		
		// Liberación de memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda.
		$this->formularioBusqueda($id_tipo_pregunta);
	}
	
	/**
	 * Método que muestra el formulario de búsqueda para las consultas (Admisión o FAQ).
	 *
	 * @param $id_tipo_pregunta El identificador del tipo de pregunta.
	 */
	function formularioBusqueda($id_tipo_pregunta)
	{
		switch ($id_tipo_pregunta)
		{
			case 4:
			{
				$titulo = "B&uacute;squeda de Consultas de Admisi&oacute;n";
				$comentario = "consultas de admisi&oacute;n";
				break;
			}
			case 5:
			{
				$titulo = "B&uacute;squeda de Preguntas Frecuentes";
				$comentario = "preguntas frecuentes";
				break;
			}
		}
		$ocultos = "";
		require("busquedasimple.inc");
	}
	
	/**
	 * Método que muestra el título de la sección 'Búsqueda de Consultas de Admisión'.
	 */
	function tituloBusquedaAdmision()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Admisi&oacute;n'>Admisi&oacute;n</A> / <A HREF='index.php?pagina=1' TITLE='Ver Consultas'>Consultas</A> / B&uacute;squeda";
		$imagen = "activos/bgconsultas.gif";
		$titulo = "B&uacute;squeda de Consultas";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método en el cual se buscan consultas respondidas y que coicidan en la tabla 'envio'
	 * con la palabra recibida.
	 *
	 * @param $id_tipo_pregunta El identificador del tipo de pregunta.
	 * @param $palabra La palabra o frase a buscar.
	 * @param $pagina El número de la página actual dentro de la paginación total.
	 */
	function buscar($id_tipo_pregunta, $palabra, $pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "buscar.php?palabra=" . $palabra . "&";
		$porpagina = 5;
		
		// Consulta que obtiene las consultas ya respondidas de un cierto tipo que coindicen en el
		// título o la descripción con la palabra a buscar, y se ordenan por fecha de envío.
		$consulta = "SELECT envio.titulo_envio, envio.desc_envio, pregunta.desc_respuesta, envio.fecha_envio, persona.nombres_persona, persona.paterno_persona, persona.email_persona FROM envio, pregunta, persona WHERE (envio.titulo_envio LIKE '%$palabra%' OR pregunta.desc_respuesta LIKE '%$palabra%') AND pregunta.id_tipo_pregunta = $id_tipo_pregunta AND pregunta.id_estado_pregunta = 1 AND envio.id_envio = pregunta.id_envio AND pregunta.id_persona = persona.id_persona ORDER BY envio.fecha_envio DESC, envio.titulo_envio";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay consultas.
		if ($total == 0)
		{
			// Preguntamos por el tipo de consulta para mostrar mensajes.
			switch ($id_tipo_pregunta)
			{
				case 4: echo "<P CLASS='contenido'>No se encontraron consultas sobre la admisi&oacute;n.</P>"; break;
				case 5: echo "<P CLASS='contenido'>No se encontraron preguntas frecuentes.</P>"; break;
			}
		}
		
		// Cuando si hay consultas.
		else
		{
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			
			// Tabla para el total, la paginación y las consultas.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR>";
			
			// Preguntamos por el tipo de pregunta para imprimir el icono para agregar una consulta.
			switch ($id_tipo_pregunta)
			{
				case 4: echo "<TD COLSPAN='2' CLASS='tema' ALIGN='right'><A HREF='agregar.php' TITLE='Agregar consulta sobre la admisi&oacute;n'><IMG SRC='../../librerias/icoagregaconsulta.gif' BORDER='0'> AGREGAR CONSULTA</A></TD>"; break;
				case 5: echo "<TD COLSPAN='2' CLASS='tema' ALIGN='right'><A HREF='agregar.php' TITLE='Agregar pregunta'><IMG SRC='../librerias/icoagregaconsulta.gif' BORDER='0'> AGREGAR PREGUNTA</A></TD>"; break;
			}
			
			echo "</TR>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			
			// Preguntamos por el tipo de pregunta para mostrar mensajes.
			switch ($id_tipo_pregunta)
			{
				case 4: echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total consultas sobre la admisi&oacute;n.</TD>"; break;
				case 5: echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total preguntas frecuentes.</TD>"; break;
			}
			
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD>&nbsp;</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para las consultas.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos las consultas.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Imprimimos la pregunta.
				printf("<TR>");
				printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>Pregunta:</B></TD>", "20%");
				printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>%s</B></TD>", "80%", strtr($tupla["titulo_envio"], $this->caracteres));
				printf("</TR>");
				
				// Imprimimos la respuesta.
				printf("<TR>");
				printf("<TD CLASS='tabla' VALIGN='top'><B>Respuesta:</B></TD>");
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", nl2br(strtr($tupla["desc_respuesta"], $this->caracteres)));
				printf("</TR>");
				
				// Imprimimos la persona y la fecha de envío.
				$email = strtr($tupla["email_persona"], $this->caracteres);
				printf("<TR>");
				printf("<TD COLSPAN='2' CLASS='tabla' VALIGN='TOP'>Enviada por <A HREF='mailto:%s' TITLE='%s'>%s %s</A> el %s</TD>", $email, $email, $tupla["nombres_persona"], $tupla["paterno_persona"], $tupla["fecha_envio"]);
				printf("</TR>");
				
				// Imprimimos un espacio en blanco.
				printf("<TR>");
				printf("<TD>&nbsp;</TD>");
				printf("</TR>");
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
			
			// Cerramos la tabla.
			echo "</TABLE>";
		}
		
		// Liberación de memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda.
		$this->formularioBusqueda($id_tipo_pregunta);
	}
	
	/**
	 * Método que muestra el título de la sección Agregar Consultas de Admisión.
	 */
	function tituloAgregarConsulta()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Admisi&oacute;n'>Admisi&oacute;n</A> / <A HREF='index.php?pagina=1' TITLE='Ver Consultas'>Consultas</A> / Agregar";
		$imagen = "activos/bgconsultas.gif";
		$titulo = "Agregar Consulta sobre la Admisi&oacute;n";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que agrega una consulta, verficando previamente que los datos son coherentes.
	 *
	 * @param $id_tipo_pregunta El identificador del tipo de pregunta.
	 * @param $nivel El nivel de directorios.
	 * @param $destino La página de destino una vez efectuada la operación.
	 * @param $nombres El primer y segundo nombre del usuario.
	 * @param $paterno El apellido paterno del usuario.
	 * @param $materno El apellido materno del usuario.
	 * @param $email El correo electrónico del usuario.
	 * @param $asunto El asunto del mensaje.
	 * @param $notificacion Si el usuario quiere que le notifiquen o no la respuesta a su correo.
	 * @param $texto El texto del mensaje.
	 */
	function agregar($id_tipo_pregunta, $nivel, $destino, $nombres, $paterno, $materno, $email, $asunto, $notificacion, $texto)
	{	
		// Librerías necesarias.
		include("persona.php");
		
		// Creamos un objeto persona y buscamos la persona.
		$persona = new persona($this->enlace);
		
		// Cuando el e-mail no cincide con el nombre de la persona.
		if ($persona->coincidir($email, $nombres, $paterno, $materno) == 0)
		{
			$email = strtr($email, get_html_translation_table(HTML_SPECIALCHARS));
			printf("<P ALIGN='center' CLASS='contenido'><B>NO SE PUEDE REGISTRAR TU MENSAJE</B></P>");
			printf("<P CLASS='contenido'>El e-mail <B>$email</B> est&aacute; siendo usado por otro usuario dentro de este Sitio Web. Por favor vuelve a ingresar tus datos y cambia el e-mail que ingresaste anteriormente.</P>");
			printf("<DIV ALIGN='center'><A HREF=\"javascript:history.back(1);\" TITLE='Atr&aacute;s al formulario'><IMG SRC='%slibrerias/btatras.gif' BORDER='0'></A></DIV>", $nivel);
		}
	  // Cuando el e-mail coincide con el nombre de la persona.
		else
		{
	  	// Capturamos la identificación de la persona.	
			$id_persona = $persona->buscar($email);			
			
			// Agregamos la persona, si no existe.
			if ($id_persona == 0)
				$id_persona = $persona->agregar($nombres, $paterno, $materno, $email);
			
			// Obtener la fecha y hora actual.
			$fecha = date("Y-m-d");
			$hora = date("H:i:s");
			
			// Consulta para agregar el envio.
			$consulta = "INSERT INTO envio(id_tipo_envio, titulo_envio, desc_envio, fecha_envio, hora_envio) VALUES(1, '$asunto', '$texto', '$fecha', '$hora')";
			mysql_query($consulta, $this->enlace);
			
			// Obtener el id de la última inserción.
			$id_envio = mysql_insert_id();
			
			// Consulta para agregar la pregunta.
			$consulta = "INSERT INTO pregunta(id_envio, id_persona, id_tipo_pregunta, id_estado_pregunta, notificar_respuesta) VALUES($id_envio, $id_persona, $id_tipo_pregunta, 2, '$notificacion')";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos los mesajes de éxito de la operación.
			printf("<P ALIGN='center' CLASS='contenido'><B>TU MENSAJE HA SIDO REGISTRADO EXITOSAMENTE</B></P>");
			printf("<P CLASS='contenido'>Dentro de 48 hrs. (como m&aacute;ximo) ser&aacute; contestada tu pregunta. Gracias por darnos tu opini&oacute;n.</P>");
			printf("<DIV ALIGN='center'><A HREF='%s' TITLE='Volver'><IMG SRC='%slibrerias/btvolver.gif' BORDER='0'></A></DIV>", $destino, $nivel);
		}
	}
	
	/**
	 * Método que imprime el título de la sección FAQ.
	 */
	function tituloFAQ()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / Preguntas Frecuentes";
		$imagen = "activos/bgfaq.jpg";
		$titulo = "Preguntas Frecuentes";
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra el título de la sección 'Búsqueda de Preguntas Frecuentes'.
	 */
	function tituloBusquedaFAQ()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php?pagina=1' TITLE='Ver Preguntas Frecuentes'>Preguntas Frecuentes</A> / B&uacute;squeda";
		$imagen = "activos/bgfaq.jpg";
		$titulo = "B&uacute;squeda de Preguntas Frecuentes";
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra el título de la sección 'Agregar Pregunta Frecuente'.
	 */
	function tituloAgregarFAQ()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php?pagina=1' TITLE='Ver Preguntas Frecuentes'>Preguntas Frecuentes</A> / Agregar";
		$imagen = "activos/bgfaq.jpg";
		$titulo = "Agregar Pregunta Frecuente";
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que imprime el título de la sección 'Contáctenos'.
	 */
	function tituloContacto()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / Cont&aacute;ctenos";
		$titulo = "Cont&aacute;ctenos";
		$imagen = "activos/bgcontactenos.jpg";
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
}
?>