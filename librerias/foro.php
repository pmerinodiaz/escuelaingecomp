<?PHP
/**
 * foro.php.
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
 * Clase contiene los métodos y variables quer permiten administrar los foros de discusión
 * existentes en la base de datos. Los foros son temas en los cuales los usuario pueden
 * agregar mensajes para que cualquier usuario del sitio Web los vea.
 */

class foro
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Método constructor que inicializa el enlace de la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function foro($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que muestra el listado foros (sólo los que tiene mensajes) con su
	 * respectivo número de mensajes enviados.
	 */
	function mostrar()
	{
		// Librerías necesarias.
		include("tiempo.php");
		
		// Consulta para obtener todos los foros que tienen al menos una nota.
		$consulta = "SELECT foro.id_foro, foro.nombre_foro, foro.fecha_creacion FROM foro ORDER BY foro.nombre_foro";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay foros.
		if ($total <= 0)
			echo "<P CLASS='contenido'>No hay foros.</P>";
		
		// Cuando si hay foros.
		else
		{
			// Creamos un objeto tiempo.
			$tiempo = new tiempo();
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Tabla para el total de foros y el encabezado.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR CLASS='contenido'>";
			echo "<TD ALIGN='right' COLSPAN='3'>Hay un total de $total foros.</TD>";
			echo "</TR>";
			echo "<TR CLASS='titulotabla'>";
			echo "<TD WIDTH='10%' ALIGN='center'>&nbsp;</TD>";
			echo "<TD WIDTH='70%' ALIGN='center'>Foro</TD>";
			echo "<TD WIDTH='20%' ALIGN='center'>Mensajes</TD>";
			echo "</TR>";
			
			// Ciclo donde se muestran los foros.
			while ($fila = mysql_fetch_array($resultado))
			{
				// Abrimos una fila.
				printf ("<TR>");
				
				// Capturamos la fecha del último mensajes enviado en el foro.
				$fecha = $this->fechaMayor($fila["id_foro"]);
				
				// Cuando la fecha existe.
				if ($fecha != NULL)
				{
					// Cuando al foro se le han agregado mensajes entre las últimas 24 horas.
					if ($tiempo->entreLapso($fecha, 24))
						printf("<TD ALIGN='center' CLASS='tabla'><IMG SRC='../librerias/icocarpetaabierta.gif'></TD>");
					
					// Cuando al foro no se le han agregado mensajes durante las últimas 24 hrs.
					else printf("<TD ALIGN='center' CLASS='tabla'><IMG SRC='../librerias/icocarpetacerrada.gif'></TD>");
				}
				// Cuando la fecha no existe.
				else printf("<TD ALIGN='center' CLASS='tabla'><IMG SRC='../librerias/icocarpetacerrada.gif'></TD>");
				
				// Mostramos el nombre del foro y el icono, si es nuevo.
				$nombre = strtr($fila["nombre_foro"], $caracteres);
				printf("<TD CLASS='tabla'>");
				if ($tiempo->entreLapso($fila["fecha_creacion"], 24))
					printf("<A HREF='foro.php?id=%d&pagina=1' TITLE='Ver Foro de %s'>%s <IMG SRC='../librerias/iconuevo.gif' BORDER='0'></A>", $fila["id_foro"], $nombre, $nombre);
				else printf("<A HREF='foro.php?id=%d&pagina=1' TITLE='Ver Foro de %s'>%s</A>", $fila["id_foro"], $nombre, $nombre);
				printf("</TD>");
				
				// Mostramos el número de notas.
				printf ("<TD CLASS='tabla' ALIGN='center'>%d</TD>", $this->numeroNotas($fila["id_foro"]));
				
				// Cerramos la fila.
				printf ("</TR>");
			}
			
			// Escribimos una fila de espacio en el final y un comentario.
			echo "<TR><TD COLSPAN='3'>&nbsp;</TD></TR>";
			echo "<TR><TD COLSPAN='3' CLASS='contenido'><IMG SRC='../librerias/icocarpetaabierta.gif'> Se han agregado uno o m&aacute;s mensajes durante las &uacute;ltimas 24 horas.</TD></TR>";
			echo "<TR><TD COLSPAN='3' CLASS='contenido'><IMG SRC='../librerias/icocarpetacerrada.gif'> No se han agregado mensajes durante las &uacute;ltimas 24 horas.</TD></TR>";
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que retorna la fecha mayor (es decir, la más reciente) de entre las notas
	 * de un foro.
	 *
	 * @param $id_foro El identificador del foro.
	 * @return $fecha_envio La fecha de envío del último mensaje del foro.
	 */
	function fechaMayor($id_foro)
	{
		// Consulta para obtener las fechas de llegadas de las notas.
		$consulta = "SELECT envio.fecha_envio FROM envio, nota WHERE envio.id_tipo_envio = 7 AND envio.id_envio = nota.id_envio AND nota.id_foro = $id_foro ORDER BY envio.fecha_envio DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Devolvemos la fecha de envío.
		return $fila["fecha_envio"];
	}
	
	/**
	 * Método que retorna el número de notas para un foro.
	 *
	 * @param $id_foro El identificador del foro.
	 * @return $num_notas El número de notas de un foro.
	 */
	function numeroNotas($id_foro)
	{
		// Consulta para obtener el número de notas de un foro.
		$consulta = "SELECT COUNT(*) AS num_notas FROM nota WHERE id_foro = $id_foro";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Devolvemos el contador de las respuestas.
		return mysql_result($resultado, 0, "num_notas");
	}
	
	/**
	 * Método que muestra el título de la sección 'Foro de...'.
	 *
	 * @param $id_foro El identificador del foro.
	 */
	function mostrarTitulo($id_foro)
	{
		$nombre = $this->nombre($id_foro);
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php' TITLE='Ver Foros'>Foros</A> / " . $nombre;
		$imagen = "activos/bgforos.jpg";
		$titulo = "Foro de " . $nombre;
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que retorna el nombre de un foro con identidad conocida.
	 *
	 * @param $id_foro El identificador del foro.
	 * @return $nombre_foro El nombre del foro.
	 */
	function nombre($id_foro)
	{
		// Consulta para obtener el nombre de un foro.
		$consulta = "SELECT nombre_foro FROM foro WHERE id_foro = $id_foro";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Devolvemos el nombre encontrado.
		return $fila["nombre_foro"];
	}
	
	/**
	 * Método que muestra los temas (en forma paginada) enviados para un foro.
	 *
	 * @param $id_foro El identificador del foro.
	 * @param $pagina El número de página dentro de la paginación total.
	 */
	function temas($id_foro, $pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		include("tiempo.php");
		
		// Inicialización de variables.
		$vinculo = "foro.php?id=" . $id_foro . "&";
		$porpagina = 20;
		
		// Mostramos el icono para agregar un tema.
		echo "<DIV CLASS='tema' ALIGN='right'><A HREF='agregar.php?id=$id_foro' TITLE='Agregar tema'><IMG SRC='../librerias/icoagregatema.gif' BORDER='0'> AGREGAR TEMA</A></DIV>";
		
		// Consulta para obtener los temas de cierto foro.
		$consulta = "SELECT envio.id_envio, envio.titulo_envio, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, envio.fecha_envio FROM envio, nota, persona WHERE envio.id_tipo_envio = 7 AND envio.id_envio = nota.id_envio AND nota.id_foro = $id_foro AND ISNULL(nota.id_envio_contesta) AND nota.id_persona = persona.id_persona ORDER BY envio.fecha_envio DESC, envio.hora_envio DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay temas.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay temas.</P>";
		
		// Cuando si hay temas.
		else
		{
			// Creamos un objeto paginación y un objeto tiempo.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$tiempo = new tiempo();
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Abrimos la tabla para el total, la paginación y los temas.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total temas.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Abrimos la tabla para los temas.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD WIDTH='53%' CLASS='titulotabla' ALIGN='center'>Tema</TD>";
			echo "<TD WIDTH='25%' CLASS='titulotabla' ALIGN='center'>Autor</TD>";
			echo "<TD WIDTH='5%' CLASS='titulotabla' ALIGN='center'>Respuestas</TD>";
			echo "<TD WIDTH='17%' CLASS='titulotabla' ALIGN='center'>Fecha</TD>";
			echo "</TR>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos los temas.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				$this->itemTema($tupla, $tiempo, $caracteres);
			}
			
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
			echo "</TD>";
			
			// Imprimimos la paginación.			
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "<TR><TD COLSPAN='2' CLASS='contenido'><IMG SRC='../librerias/icotemahoy.gif' BORDER='0'> Temas creados hoy</TD></TR>";
			echo "<TR><TD COLSPAN='2' CLASS='contenido'><IMG SRC='../librerias/icotemaantiguo.gif' BORDER='0'> Temas creados anteriormente</TD></TR>";
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda.
		$this->formularioBusqueda($id_foro);
	}
	
	/**
	 * Método que muestra un tema enviado por una persona.
	 *
	 * @param $tupla La fila resultante.
	 * @param $tiempo El objeto tiempo ya inicializado.
	 * @param $caracteres El juego de caracteres especiales del servidor.
	 */
	function itemTema($tupla, $tiempo, $caracteres)
	{
		printf("<TR>");
		
		// Mostramos el nombre del tema, con el icono de hoy o pasado.
		$titulo = strtr($tupla["titulo_envio"], $caracteres);
		if ($tiempo->entreLapso($tupla["fecha_envio"], 0))
			$imagen = "icotemahoy.gif";
		else $imagen = "icotemaantiguo.gif";
		printf("<TD CLASS='tabla' VALIGN='top'><A HREF='tema.php?id=%d&pagina=1' TITLE='Ver tema %s'><IMG SRC='../librerias/%s' BORDER='0'> %s</A></TD>", $tupla["id_envio"], $titulo, $imagen, $titulo);
		
		// Mostramos el nombre del autor del tema.
		$autor = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
		if ($tupla["email_persona"])
		{
			$email = strtr($tupla["email_persona"], $caracteres);
			printf("<TD CLASS='tabla' VALIGN='top' ALIGN='center'><A HREF='mailto:%s' TITLE='%s'>%s</A></TD>", $email, $email, $autor);
		}
		else printf("<TD CLASS='tabla' VALIGN='top' ALIGN='center'>%s</TD>", $autor);
		
		// Mostramos el número de respuestas para el tema.
		$respuestas = $this->numeroRespuestas($tupla["id_envio"]);
		printf("<TD CLASS='tabla' VALIGN='top' ALIGN='center'>%d</TD>", $respuestas);
		
		// Mostramos la fecha del tema.
		printf("<TD CLASS='tabla' VALIGN='top' ALIGN='center'>%s</TD>", $tupla["fecha_envio"]);
		printf("</TR>");
	}
	
	/**
	 * Método que retorna el número de respuestas para un tema.
	 *
	 * @param $id_envio El identificador del envío.
	 * @return $num_respuestas El número de respuestas de un mensaje.
	 */
	function numeroRespuestas($id_envio)
	{
		// Consulta para obtener el número de respuestas de un tema.
		$consulta = "SELECT COUNT(*) AS num_respuestas FROM nota WHERE id_envio_contesta = $id_envio";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Devolvemos el contador de las respuestas.
		return mysql_result($resultado, 0, "num_respuestas");
	}
	
	/**
	 * Método que muestra el formulario de búsqueda para los foros.
	 *
	 * @param $id_foro El identificador del foro.
	 */
	function formularioBusqueda($id_foro)
	{
		$titulo = "B&uacute;squeda de Temas en Foro";
		$ocultos = "<INPUT TYPE='hidden' NAME='id' VALUE='$id_foro'>";
		$comentario = "temas del foro";
		require("busquedasimple.inc");
	}
	
	/**
	 * Método que muestra el título de la sección 'Búsqueda de Temas en Foro'.
	 *
	 * @param $id_foro El identificador del foro.
	 */
	function tituloBusqueda($id_foro)
	{
		$nombre = $this->nombre($id_foro);
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php' TITLE='Ver Foros'>Foros</A> / <A HREF='foro.php?id=" . $id_foro . "&pagina=1' TITLE='Ver " . $nombre . "'>" . $nombre . "</A> / B&uacute;squeda";
		$imagen = "activos/bgforos.jpg";
		$titulo = "B&uacute;squeda de Temas en Foro";
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que busca los temas enviados para un foro, que coinciden con la palabra
	 * o frase ingresada y los muestra (en forma paginada).
	 *
	 * @param $id_foro El identificador del foro.
	 * @param $palabra La palabra o frase a buscar.
	 * @param $pagina La página actual dentro de la paginación total.
	 */
	function buscar($id_foro, $palabra, $pagina)
	{
		// Librerias necesarias.
		include("paginacion.php");
		include("tiempo.php");
		
		// Inicialización de variables.
		$vinculo = "buscar.php?id=" . $id_foro . "&palabra=" . $palabra . "&";
		$porpagina = 20;
		
		// Consulta para obtener los temas coincidentes con la palabra ingresada.
		$consulta = "SELECT envio.id_envio, envio.titulo_envio, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, envio.fecha_envio FROM envio, nota, persona WHERE envio.id_tipo_envio = 7 AND envio.id_envio = nota.id_envio AND nota.id_foro = $id_foro AND ISNULL(nota.id_envio_contesta) AND nota.id_persona = persona.id_persona AND (envio.titulo_envio LIKE '%$palabra%' OR envio.desc_envio LIKE '%$palabra%' OR persona.nombres_persona LIKE '%$palabra%' OR persona.paterno_persona LIKE '%$palabra%' OR persona.materno_persona LIKE '%$palabra%') ORDER BY envio.fecha_envio DESC, envio.hora_envio DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no se encontraron temas.
		if ($total == 0)
			echo "<P CLASS='contenido'>No se encontraron temas.</P>";
		
		// Cuando si se encontraron temas.
		else
		{
			// Creamos un objeto paginacion y un objeto tiempo.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$tiempo = new tiempo();
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Mostramos el icono para agregar un tema.
			echo "<DIV CLASS='tema' ALIGN='right'><A HREF='agregar.php?id=$id_foro' TITLE='Agregar tema'><IMG SRC='../librerias/icoagregatema.gif' BORDER='0'> AGREGAR TEMA</A></DIV>";
			
			// Abrimos la tabla para el total, la paginación y los temas.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total temas.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Abrimos la tabla para los temas.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD WIDTH='53%' CLASS='titulotabla' ALIGN='center'>Tema</TD>";
			echo "<TD WIDTH='25%' CLASS='titulotabla' ALIGN='center'>Autor</TD>";
			echo "<TD WIDTH='5%' CLASS='titulotabla' ALIGN='center'>Respuestas</TD>";
			echo "<TD WIDTH='17%' CLASS='titulotabla' ALIGN='center'>Fecha</TD>";
			echo "</TR>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos los temas.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				$this->itemTema($tupla, $tiempo, $caracteres);
			}
			
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
			echo "</TD>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "<TR><TD COLSPAN='2' CLASS='contenido'><IMG SRC='../librerias/icotemahoy.gif' BORDER='0'> Temas creados hoy</TD></TR>";
			echo "<TR><TD COLSPAN='2' CLASS='contenido'><IMG SRC='../librerias/icotemaantiguo.gif' BORDER='0'> Temas creados anteriormente</TD></TR>";
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda.
		$this->formularioBusqueda($id_foro);
	}
	
	/**
	 * Método que muestra el título de la sección 'Agregar Tema al Foro' o bien el título
	 * 'Agregar Mensaje al Foro'.
	 *
	 * @param $tipo El tipo de título a mostrar.
	 * @param $id_foro El identificdor del foro.
	 */
	function tituloAgregarNota($tipo, $id_foro)
	{
		$nombre = $this->nombre($id_foro);
		
		// Dependiendo del tipo, configuramos los mensajes.
		switch ($tipo)
		{
			case 1:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php' TITLE='Ver Foros'>Foros</A> / <A HREF='foro.php?id=" . $id_foro . "&pagina=1' TITLE='Ver " . $nombre . "'>" . $nombre . "</A> / Agregar Tema";
				$titulo = "Agregar Tema al Foro";
				break;
			}
			case 2:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php' TITLE='Ver Foros'>Foros</A> / <A HREF='foro.php?id=" . $id_foro . "&pagina=1' TITLE='Ver " . $nombre . "'>" . $nombre . "</A> / Agregar Mensaje";
				$titulo = "Agregar Mensaje en el Tema";
				break;
			}
		}
		$imagen = "activos/bgforos.jpg";
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que despliega el formulario de ingreso de un nuevo tema al foro.
	 *
	 * @param $id_foro El identificador del foro.
	 */
	function formularioAgregarNota($id_foro)
	{
		$descripcion = "<P CLASS='contenido'>Con esta opci&oacute;n podr&aacute;s agregar un nuevo tema al foro.</P><P CLASS='contenido'>Introduce tus datos personales junto con el texto que quieras agregar al foro y luego pulsa ENVIAR.</P>";
		$destino = "grabar.php";
		$ocultos = "<INPUT TYPE='hidden' NAME='id' VALUE='$id_foro'>";
		require("agregamensaje.inc");
	}
	
	/**
	 * Método que agrega una nota, verficando previamente que los datos son coherentes.
	 *
	 * @param $destino La página destino.
	 * @param $nombres El primer y segundo nombre del usuario.
	 * @param $paterno El apellido paterno del usuario.
	 * @param $materno El apellido materno del usuario.
	 * @param $email El correo electrónico del usuario.
	 * @param $asunto El asunto del mensaje.
	 * @param $notificacion Si el usuario desea o no recibir notificación.
	 * @param $texto El texto del mensaje.
	 * @param $id_foro El identificador del foro.
	 * @param $id_envio_contesta El identificador del envío que responde a una pregunta.
	 */
	function agregarNota($destino, $nombres, $paterno, $materno, $email, $asunto, $notificacion, $texto, $id_foro, $id_envio_contesta)
	{
		// Librerías necesarias.
		include("persona.php");
		
		if ($id_envio_contesta == NULL)
			$tipo = "tema";
		else $tipo = "mensaje";
		
		// Creamos un objeto persona y buscamos la persona.
		$persona = new persona($this->enlace);
		
		// Cuando el e-mail no cincide con el nombre de la persona.
		if ($persona->coincidir($email, $nombres, $paterno, $materno) == 0)
		{
	  	$email = strtr($email, get_html_translation_table(HTML_SPECIALCHARS));
			echo "<P ALIGN='center' CLASS='contenido'><B>NO SE PUEDE REGISTRAR TU " . strtoupper($tipo) . "</B></P>";
			echo "<P CLASS='contenido'>El e-mail <B>$email</B> est&aacute; siendo usado por otro usuario dentro de este Sitio Web. Por favor vuelve a ingresar tus datos y cambia el e-mail que ingresaste anteriormente.</P>";
			echo "<DIV ALIGN='center'><A HREF=\"javascript:history.back(1);\" TITLE='Atr&aacute;s al formulario'><IMG SRC='../librerias/btatras.gif' BORDER='0'></A></DIV>";
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
			
			// Consulta para agregar el envío.
			$consulta = "INSERT INTO envio(id_tipo_envio, titulo_envio, desc_envio, fecha_envio, hora_envio) VALUES(7, '$asunto', '$texto', '$fecha', '$hora')";
			mysql_query($consulta, $this->enlace);
			
			// Obtenemos el identificador de la última inserción.
			$id_envio = mysql_insert_id();
			
			// Consulta para agregar la nota.
			$insert = "INSERT INTO nota(id_envio, id_foro, id_envio_contesta, id_persona, recibir_respuesta) ";
			if ($id_envio_contesta == NULL)
				$values = "VALUES($id_envio, $id_foro, NULL, $id_persona, '$notificacion')";
			else $values = "VALUES($id_envio, $id_foro, $id_envio_contesta, $id_persona, '$notificacion')";
			$consulta = $insert . $values;
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos los mesajes de éxito de la operación.
			echo "<P ALIGN='center' CLASS='contenido'><B>TU " . strtoupper($tipo) . " HA SIDO REGISTRADO EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>El " . $tipo . " estar&aacute; disponible para que cualquier persona lo vea. Si alguna persona se interesa en tu " . $tipo . ", te comentar&aacute; o respondar&aacute; tu " . $tipo . ". Gracias por enviarnos tu " . $tipo . ".</P>";
			echo "<DIV ALIGN='center'><A HREF='$destino' TITLE='Volver'><IMG SRC='../librerias/btvolver.gif' BORDER='0'></A></DIV>";
		}
	}
	
	/**
	 * Método que muestra el título de la sección 'Mensajes en el Tema'.
	 *
	 * @param $id_envio El identificador del envío.
	 */
	function tituloTema($id_envio)
	{
		// Consulta para obtener la identificación y el nombre del foro de un mensaje.
		$consulta = "SELECT foro.id_foro, foro.nombre_foro FROM envio, nota, foro WHERE envio.id_tipo_envio = 7 AND envio.id_envio = $id_envio AND envio.id_envio = nota.id_envio AND nota.id_foro = foro.id_foro";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Devolvemos el nombre encontrado.
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php' TITLE='Ver Foros'>Foros</A> / <A HREF='foro.php?id=" . $fila["id_foro"] . "&pagina=1' TITLE='Ver " . $fila["nombre_foro"] . "'>" . $fila["nombre_foro"] . "</A> / Tema";
		$imagen = "activos/bgforos.jpg";
		$titulo = "Mensajes en el Tema";
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra las notas (en forma paginada) enviados para un tema del foro.
	 *
	 * @param $id_envio El identificador del envío.
	 * @param $pagina El número de la página dentro de la paginación total.
	 */
	function notas($id_envio, $pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "tema.php?id=" . $id_envio . "&";
		$porpagina = 5;
		
		// Consulta para obtener los mensajes de cierto tema.
		$consulta = "SELECT envio.titulo_envio, envio.desc_envio, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, envio.fecha_envio, nota.id_foro FROM envio, nota, persona WHERE envio.id_tipo_envio = 7 AND envio.id_envio = nota.id_envio AND (nota.id_envio = $id_envio OR nota.id_envio_contesta = $id_envio) AND nota.id_persona = persona.id_persona ORDER BY envio.fecha_envio, envio.hora_envio";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay mensajes.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay mensajes.</P>";
		
		// Cuando si hay mensajes.
		else
		{
			// Creamos un objeto paginación.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
			
			// Abrimos la tabla para el total, la paginación y los mensajes.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total mensajes.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "<TR><TD COLSPAN='2'>";
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos los mensajes.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				$this->itemNota($tupla, $caracteres);
				$id_foro = $tupla["id_foro"];
			}
			
			// Imprimimos la paginación
			echo "</TABLE>";
			echo "</TD>";
			echo "</TR>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario para enviar un mensaje en el tema.
		$this->formularioAgregarMensaje($id_foro, $id_envio);
	}
	
	/**
	 * Método que muestra el formato de impresión para un mensaje.
	 *
	 * @param $tupla La fila obtenida de la consulta.
	 * @param $caracteres El juego especial de caracteres del servidor.
	 */
	function itemNota($tupla, $caracteres)
	{
		// Imprimimos el título del mensaje.
		printf("<TR>");
		printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>Asunto:</B></TD>", "15%");
		printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>%s</B></TD>", "85%", strtr($tupla["titulo_envio"], $caracteres));
		printf("</TR>");
		
		// Imprimimos la respuesta.
		printf("<TR>");
		printf("<TD COLSPAN='2' CLASS='tabla' VALIGN='top'>%s</TD>", nl2br(strtr($tupla["desc_envio"], $caracteres)));
		printf("</TR>");
		
		// Imprimimos el autor y la fecha de realización.
		$autor = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
		printf("<TR>");
		printf("<TD COLSPAN='2' CLASS='tabla' VALIGN='TOP'>");
		if ($tupla["email_persona"])
		{
			$email = strtr($tupla["email_persona"], $caracteres);
			printf("Enviado por <A HREF='mailto:%s' TITLE='%s'>%s</A> ", $email, $email, $autor);
		}
		else printf("Enviado por %s ", $autor);
		printf("el %s", $tupla["fecha_envio"]);
		printf("</TD>");
		printf("</TR>");
		
		// Imprimimos un espacio en blanco.
		printf("<TR><TD>&nbsp;</TD></TR>");
	}
	
	/**
	 * Método que muestra el formulario para agregar un mensaje en el tema.
	 *
	 * @param $id_foro El identificador del foro.
	 * @param $id_envio El identificador del envío.
	 */
	function formularioAgregarMensaje($id_foro, $id_envio)
	{
		$descripcion = "<P CLASS='contenido'><B>Agregar Mensaje en el Tema</B>";
		$destino = "registrar.php";
		$ocultos = "<INPUT TYPE='hidden' NAME='id' VALUE='$id_foro'><INPUT TYPE='hidden' NAME='id_envio' VALUE='$id_envio'>";
		require("agregamensaje.inc");
	}
	
	/**
	 * Método que muestra el formulario para agregar un nuevo foro a la base de datos.
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
		
		// Escribimos la tabla para incorporar el foro.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Agregar Foro</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>Nombre del Foro:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='nombre' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' TITLE='Nombre del foro'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
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
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='agregar' VALUE='Agregar' CLASS='formbutton' TABINDEX='1' TITLE='Agregar el foro'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * Método que agrega un nuevo foro a la base de datos.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $nombre_foro El nombre dle foro.
	 */
	function agregar($id_persona, $nombre_foro)
	{
		// Obtener la fecha actual.
		$fecha = date("Y-m-d");
		
		// Consulta para agregar el foro.
		$consulta = "INSERT INTO foro(id_persona, nombre_foro, fecha_creacion) VALUES($id_persona, '$nombre_foro', '$fecha')";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de éxito de la operación.
		echo "<P ALIGN='center' CLASS='contenido'><B>TU FORO HA SIDO AGREGADO EXITOSAMENTE</B></P>";
		echo "<P CLASS='contenido'>Este foro estar&aacute; disponible en la secci&oacute;n \"Foros\" de nuestro sitio Web, para que cualquier persona de Chile y el mundo participe en &eacute;l. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
	
	/**
	 * Método que lista todos los foros que ha creado un usuario interno.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $vinculo El enlace a la página de destino.
	 */
	function listar($id_persona, $vinculo)
	{
		// Consulta que obtiene información del usuario interno con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE persona.id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$usuario = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
		mysql_free_result($resultado);
		
		// Consulta para obtener la lista de foros que tiene el usuario interno.
		$consulta = "SELECT id_foro, nombre_foro, fecha_creacion FROM foro WHERE id_persona = $id_persona ORDER BY fecha_creacion DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);		
		
		// Cuando no hay foros.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay foros creados por $usuario.</P>";
		
		// Cuando hay foros.
		else
		{
			echo "<TABLE WIDTH='60%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='5' CLASS='contenido'>Hay un total de $total foros creados por $usuario:</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD WIDTH='15%' ALIGN='center' CLASS='titulotabla'>&nbsp;</TD>";
			echo "<TD WIDTH='65%' ALIGN='center' CLASS='titulotabla'><B>Foros</B></TD>";
			echo "<TD WIDTH='20%' ALIGN='center' CLASS='titulotabla'><B>Fecha</B></TD>";
			echo "</TR>";
			
			// Texto para enlazar a la operación.
			if ($vinculo == "modificar.php")
				$texto_vinculo = "Modificar";
			else $texto_vinculo = "Eliminar";
			
			// Imprimimos la lista de foros.
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				printf("<TD ALIGN='center' CLASS='tabla' VALIGN='top'><A HREF='$vinculo?id=%s' TITLE='%s Foro'>%s</A></TD>", $tupla["id_foro"], $texto_vinculo, $texto_vinculo);
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $tupla["nombre_foro"]);
				printf("<TD CLASS='tabla' VALIGN='top' ALIGN='center'>%s</TD>", $tupla["fecha_creacion"]);
				printf("</TR>");
			}
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);	
	}
	
	/**
	 * Método que muestra el formulario de modificación de un foro.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_foro El identificador del foro.
	 */
	function formularioModificar($id_persona, $id_foro)
	{
		// Consulta para obtener los datos del foro seleccionado por el usuario.
		$consulta = "SELECT foro.nombre_foro, persona.nombres_persona, persona.paterno_persona, persona.materno_persona FROM foro, usuario_interno, persona WHERE foro.id_foro = $id_foro AND foro.id_persona = $id_persona AND foro.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Mostramos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Modificar Foro</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>Nombre del Foro:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='nombre' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' TITLE='Nombre del foro' VALUE='" . $tupla["nombre_foro"] . "'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_foro' VALUE='$id_foro'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido'>&nbsp;<FONT COLOR='#CC0000'>*</FONT> Datos obligatorios</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar el foro'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * Método que modifica un foro creado por un usuario interno.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_foro El identificador del foro.
	 * @param $nombre_foro El nombre del foro.
	 */
	function modificar($id_persona, $id_foro, $nombre_foro)
	{
		// Obtener la fecha actual.
		$fecha = date("Y-m-d");
		
		// Consulta para actualizar la tabla 'foro'.
		$consulta = "UPDATE foro SET nombre_foro = '$nombre_foro', fecha_creacion = '$fecha' WHERE id_foro = $id_foro AND id_persona = $id_persona";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de éxito de la operación.
		printf("<P ALIGN='center' CLASS='contenido'><B>TU FORO HA SIDO MODIFICADO EXITOSAMENTE</B></P>");	
		printf("<P CLASS='contenido'>Este foro ha sido cambiado y est&aacute; disponible en la secci&oacute;n \"Foros\" de nuestro sitio Web, para que cualquier persona de Chile y el mundo participe en &eacute;l. Gracias por colaborar con nosotros.</P>");
		printf("<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>");
	}
	
	/**
	 * Método que muestra el formulario para eliminar un foro.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_foro El identificador del foro.
	 */
	function formularioEliminar($id_persona, $id_foro)
	{
		// Consulta para obtener los datos del foro seleccionado por el usuario.
		$consulta = "SELECT foro.nombre_foro, persona.nombres_persona, persona.paterno_persona, persona.materno_persona FROM foro, usuario_interno, persona WHERE foro.id_foro = $id_foro AND foro.id_persona = $id_persona AND foro.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Mostramos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Eliminar Foro</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>Nombre del Foro:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='nombre' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' VALUE='" . $tupla["nombre_foro"] . "' DISABLED='true'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>¿Confirmas que deseas eliminar esta especialidad?</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='confirmar' CHECKED='true' VALUE='1'>Si<BR><INPUT TYPE='radio' NAME='confirmar' VALUE='0'>No</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_foro' VALUE='$id_foro'></TD>";
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
	 * Método que elimina un foro de la base de datos.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_foro El identificador del foro.
	 * @param $confirmar Si el usuario quiere realmente eliminar el foro o no.
	 */
	function eliminar($id_persona, $id_foro, $confirmar)
	{
		// Cuando quiere eliminar el foro.
		if ($confirmar == 1)
		{
			// Consulta para obtener todos los identificadores de los envíos cuya relación sea el foro a eliminar.
			$consulta = "SELECT id_envio FROM nota WHERE id_foro = $id_foro";
			$resultado = mysql_query($consulta, $this->enlace);
			
			// Ciclo en donde borramos las notas del foro.
			while ($tupla = mysql_fetch_array($resultado))
			{
				// Consulta para borrar los registros en la tabla 'nota'.
				$consulta = "DELETE FROM nota WHERE id_envio = " . $tupla["id_envio"] . " AND id_foro = " . $id_foro . "";
				mysql_query($consulta, $this->enlace);
				
				// Consulta para borrar los registros en la tabla 'envio'.
				$consulta = "DELETE FROM envio WHERE id_envio = " . $tupla["id_envio"] . " AND id_tipo_envio = 7";
				mysql_query($consulta, $this->enlace);
			}
			
			// Liberamos memoria del servidor.
			mysql_free_result($resultado);
			
			// Consulta para borrar el registro en la tabla 'foro'.
			$consulta = "DELETE FROM foro WHERE id_foro = $id_foro AND id_persona = $id_persona";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos el mesaje de éxito de la operación.
			echo "<P ALIGN='center' CLASS='contenido'><B>TU FORO HA SIDO ELIMINADO EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Este foro se ha eliminado de la secci&oacute;n \"Foros\" de nuestro sitio Web, de manera que las personas ya no podr&aacute;n seguir participando en &eacute;l. Gracias por colaborar con nosotros.</P>";
		}
		// Cuando no quiere eliminarla.
		else
		{
			echo "<P ALIGN='center' CLASS='contenido'><B>TU FORO NO HA SIDO ELIMINADO</B></P>";
			echo "<P CLASS='contenido'>Este foro no se ha eliminado de la secci&oacute;n \"Foros\" de nuestro sitio Web, de manera que las personas podr&aacute;n seguir participando en &eacute;l. Gracias por colaborar con nosotros.</P>";
		}
		
		// Mostramos el botón volver.
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
}
?>