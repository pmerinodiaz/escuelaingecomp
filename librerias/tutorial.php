<?PHP
/**
 * tutorial.php.
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
 * Clase que nos proporciona m�todos y variables para administrar los registros de
 * los tutoriales existentes en la base de datos. Esta clase extiende de la clase utilidad.
 */

// Librer�as necesarias.
include("utilidad.php");

class tutorial extends utilidad
{
	/**
	 * M�todo constructor que inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function tutorial($link)
	{
		$this->enlace = $link;
		$this->caracteres = get_html_translation_table(HTML_SPECIALCHARS);
	}
	
	/**
	 * M�todo que muestra los aparatados en los cuales hay tutoriales de cierta
	 * pertenencia (Nuestros o Terceros).
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 */
	function apartados($id_pertenencia_utilidad)
	{
		// Librer�as necesarias.
		include("tiempo.php");
		
		// Consulta para obtener la cantidad de tutoriales de cierta pertenencia.
		$consulta = "SELECT COUNT(*) as num_utilidad FROM utilidad WHERE id_tipo_utilidad = 2 AND id_pertenencia_utilidad = $id_pertenencia_utilidad";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_result($resultado, 0, "num_utilidad");
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Cuando no hay tutoriales.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay tutoriales.</P>";
		
		// Cuando si hay tutoriales.
		else
		{
			// Creamos un objeto tiempo.
			$tiempo = new tiempo();
			
			// Mostramos el n�mero total de tutoriales.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD ALIGN='right' COLSPAN='4' CLASS='contenido'>Hay un total de $total tutoriales.</TD>";
			echo "</TR>";
			
			// Consulta para obtener los apartados en los cuales existen m�s de un tutorial.
			$consulta = "SELECT apartado.id_apartado, apartado.nombre_apartado, COUNT(*) as num_utilidad FROM apartado, utilidad WHERE utilidad.id_tipo_utilidad = 2 AND utilidad.id_pertenencia_utilidad = $id_pertenencia_utilidad AND utilidad.id_apartado = apartado.id_apartado GROUP BY apartado.id_apartado ORDER BY apartado.nombre_apartado";
			$resultado = mysql_query($consulta, $this->enlace);
			$total = mysql_num_rows($resultado);
			
			// Calculamos el total de iteraciones que debemos realizar.
			if ($total > 1)
				$iteraciones = round($total / 2);
			else $iteraciones = $total;
			
			// Ciclo en donde imprimimos los apartados, con su respectiva cantidad de tutoriales.
			for ($i=0; $i<$iteraciones; $i++)
			{
				printf("<TR>");
				
				// Imprimimos la columna izquierda.
				$fecha = $this->fechaMayor(mysql_result($resultado, $i, "id_apartado"), 2, $id_pertenencia_utilidad);
				$this->seccion(2, $resultado, $i, $tiempo, $fecha);
				
				// Imprimimos la columna derecha.
				$k = $i + $iteraciones;
				if ($k < $total)
				{
					$fecha = $this->fechaMayor(mysql_result($resultado, $k, "id_apartado"), 2, $id_pertenencia_utilidad);
					$this->seccion(2, $resultado, $k, $tiempo, $fecha);
				}
				else $this->vacio();
				
				printf("</TR>");
			}
			
			// Escribimos una fila de espacio en el final y un comentario sobre las carpetas.
			echo "<TR><TD COLSPAN='4'>&nbsp;</TD></TR>";
			echo "<TR><TD COLSPAN='4' CLASS='contenido'><IMG SRC='../../librerias/icocarpetaabierta.gif'> Se han agregado uno o m&aacute;s tutoriales durante las &uacute;ltimas 24 horas.</TD></TR>";
			echo "<TR><TD COLSPAN='4' CLASS='contenido'><IMG SRC='../../librerias/icocarpetacerrada.gif'> No se han agregado tutoriales durante las &uacute;ltimas 24 horas.</TD></TR>";
			echo "<TR><TD COLSPAN='4'>&nbsp;</TD></TR>";
			echo "</TABLE>";
			
			// Liberamos memoria en el servidor.
			mysql_free_result($resultado);
		}
	}
	
	/**
	 * M�todo que muestra los �ltimos tres tutoriales de cierta pertenencia (Nuestro
	 * o De Terceros) incorporados recientemente.
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 */
	function destacados($id_pertenencia_utilidad)
	{
		// Realizamos la consulta.
		switch ($id_pertenencia_utilidad)
		{
			case 1: $consulta = $this->consultaDestacadosNuestros(); break;
			case 2: $consulta = $this->consultaDestacadosTerceros(); break;
		}
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando si hay tutoriales.
		if ($total > 0)
		{
			// Contador para los tutoriales.
			$contador = 0;
			
			// Creamos un objeto tiempo.
			$tiempo = new tiempo();
			
			// Tabla para los tutoriales.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='2' ALIGN='center' BGCOLOR='F1F1F1' CLASS='contenido'><B>Ultimas incorporaciones</B></TD>";
			echo "</TR>";
			
			// Imprimimos los tres primeros tutoriales arrojados por la consulta.
			while (($tupla = mysql_fetch_array($resultado)) && ($contador < 3))
			{
				$this->item($tupla, $tiempo, true, true);
				$contador++;
			}
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
		}
		
		// Liberaci�n de memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * M�todo que realiza el query para obtener todos los tutoriales nuestros,
	 * ordenados por fecha de recepci�n.
	 *
	 * @return $consulta La consulta para obtener todos los software de terceros.
	 */
	function consultaDestacadosNuestros()
	{
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.tamanio_utilidad, utilidad.fecha_llegada, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, utilidad.desc_utilidad, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad, apartado.nombre_apartado ";
		$from = "FROM utilidad, formato, usuario_interno, persona, idioma, apartado ";
		$where = "WHERE utilidad.id_tipo_utilidad = 2 AND utilidad.id_pertenencia_utilidad = 1 AND utilidad.id_formato = formato.id_formato AND utilidad.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_apartado = apartado.id_apartado ";
		$order = "ORDER BY utilidad.fecha_llegada DESC";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where . $order;
	}
	
	/**
	 * M�todo que realiza el query para obtener todos los tutoriales de terceros,
	 * ordenados por fecha de recepci�n.
	 *
	 * @return $consulta La consulta para obtener todos los software de terceros.
	 */
	function consultaDestacadosTerceros()
	{
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.tamanio_utilidad, utilidad.fecha_llegada, empresa.nombre_empresa, empresa.url_empresa, utilidad.desc_utilidad, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad, apartado.nombre_apartado ";
		$from = "FROM utilidad, formato, empresa, idioma, apartado ";
		$where = "WHERE utilidad.id_tipo_utilidad = 2 AND utilidad.id_pertenencia_utilidad = 2 AND utilidad.id_formato = formato.id_formato AND utilidad.id_empresa = empresa.id_empresa AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_apartado = apartado.id_apartado ";
		$order = "ORDER BY utilidad.fecha_llegada DESC";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where . $order;
	}
	
	/**
	 * M�todo que imprime un tutorial (Nuestro o De Terceros).
	 *
	 * @param $tupla La tupla resultante de una consulta.
	 * @param $tiempo El objeto tiempo.
	 * @param $esdestacado Si se est� mostrando en la secci�n 'destacados' o no.
	 * @param $vincular Si se desea vincular o no al software.
	 */
	function item($tupla, $tiempo, $esdestacada, $vincular)
	{
		// Imprimimos el formato, con el t�tulo, el v�nculo al sitio de descarga y el icono
		// si es nuevo.
		printf("<TR>");
		printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>T&iacute;tulo:</B></TD>", "15%");
		printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'>", "85%");
		$nombre = strtr($tupla["nombre_utilidad"], $this->caracteres);
		if ($vincular)
			printf("<A HREF='enlazar.php?id=%d' TITLE='Acceder a %s'><IMG SRC='../../librerias/%s' BORDER='0'> <B>%s</B></A>", $tupla["id_utilidad"], $nombre, $tupla["src_formato"], $nombre);
		else printf("<IMG SRC='../../librerias/%s' BORDER='0'> <B>%s</B></A>", $tupla["src_formato"], $nombre);
		if ($tiempo->entreLapso($tupla["fecha_llegada"], 24))
			printf(" <IMG SRC='../../librerias/iconuevo.gif'>");
		printf("</TD>");
		printf("</TR>");
		
		// Mostramos el nombre de apartado, en caso de ser destacada.
		if ($esdestacada)
		{
			printf("<TR>");
			printf("<TD CLASS='tabla' VALIGN='top'><B>Apartado:</B></TD>");
			printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $tupla["nombre_apartado"]);
			printf("</TR>");
		}
		
		// Imprimimos el autor.
		printf("<TR>");
		printf("<TD CLASS='tabla' VALIGN='top'><B>Autor:</B></TD>");
		switch ($tupla["id_pertenencia_utilidad"])
		{
			// Imprimimos el autor (nombre completo) y su e-mail (si tiene).
			case 1:
			{
				printf("<TD CLASS='tabla' VALIGN='top'>%s %s %s", $tupla["nombres_persona"], $tupla["paterno_persona"], $tupla["materno_persona"]);
				if ($tupla["email_persona"])
				{
					$email = strtr($tupla["email_persona"], $this->caracteres);
					printf(" (<A HREF='mailto:%s' TITLE='%s'>%s</A>)", $email, $email, $email);
				}
				break;
			}
			// Imprimimos el nombre de la empresa y su sitio web (si tiene).
			case 2:
			{
				$empresa = strtr($tupla["nombre_empresa"], $this->caracteres);
				if ($tupla["url_empresa"])
					printf("<TD CLASS='tabla' VALIGN='top'>Forma parte de <A HREF='http://%s' TITLE='Visitar Web de %s' TARGET='_blank'>%s</A>", strtr($tupla["url_empresa"], $this->caracteres), $empresa, $empresa);
				else printf("<TD CLASS='tabla' VALIGN='top'>Forma parte de %s", $empresa);
				break;
			}
		}
		printf("</TD>");
		printf("</TR>");
		
		// Imprimimos la descripci�n.
		printf("<TR>");
		printf("<TD CLASS='tabla' VALIGN='TOP' COLSPAN='2'>%s</TD>", nl2br(strtr($tupla["desc_utilidad"], $this->caracteres)));
		printf("</TR>");
		
		// Imprimimos el idioma y el icono del idioma.
		printf("<TR>");
		printf("<TD CLASS='tabla' VALIGN='top'><B>Idioma:</B></TD>");
		printf("<TD CLASS='tabla' VALIGN='top'>%s <IMG SRC='../../librerias/%s'></TD>", $tupla["nombre_idioma"], $tupla["src_idioma"]);
		printf("</TR>");
		
		// Calculamos la valoraci�n de la utilidad (valoraci�n = puntuacion/votos).
		if ($tupla["votos_utilidad"] > 0)
			$valoracion = $tupla["puntuacion_utilidad"]/$tupla["votos_utilidad"];
		else $valoracion = 0.0;
		
		// Obtenemos el n�mero de comentarios de la utilidad.
		$num_comentarios = $this->numeroComentarios($tupla["id_utilidad"]);
		
		// Tabla para el n�mero de comentarios, la valoraci�n, las visitas y los �conos
		// de ver comentarios, comentar y votar.
		printf("<TR>");
		printf("<TD COLSPAN='2'>");
		printf("<TABLE WIDTH='%s' BORDER='0' CELLPADDING='0' CELLSPACING='0'>", "100%");
		printf("<TR>");
		printf("<TD BGCOLOR='#FFFFFF' CLASS='tabla' VALIGN='top' WIDTH='%s'>Comentarios: %d - Valoraci&oacute;n: ", "70%", $num_comentarios);
		if ($valoracion > 0.0)
		{
			if ($valoracion < 4.0)
				printf("<IMG SRC='../../librerias/icoreprobado.gif'> ");
			else printf("<IMG SRC='../../librerias/icoaprobado.gif'> ");
		}
		printf("( %0.1f / %d votos ) - Visitas: %d</TD>", $valoracion, $tupla["votos_utilidad"], $tupla["visitas_utilidad"]);
		printf("<TD BGCOLOR='#FFFFFF' CLASS='tabla' VALIGN='top' WIDTH='%s' ALIGN='right'>", "30%");
		if ($num_comentarios > 0)
			printf("<A HREF='comentarios.php?id=%d&pagina=1' TITLE='Ver Comentarios'><IMG SRC='../../librerias/icocomentarios.gif' BORDER='0'></A> ", $tupla["id_utilidad"]);
		printf("<A HREF='comentar.php?id=%d' TITLE='Comentar'><IMG SRC='../../librerias/icocomentar.gif' BORDER='0'></A> ", $tupla["id_utilidad"]);
		printf("<A HREF='votar.php?id=%d' TITLE='Votar'><IMG SRC='../../librerias/icovotar.gif' BORDER='0'></A> ", $tupla["id_utilidad"]);
		printf("</TD>");
		printf("</TR>");
		printf("</TABLE>");
		
		// Imprimimos un espacio en blanco.
		echo "</TD>";
		echo "</TR>";
		echo "<TR><TD>&nbsp;</TD></TR>";
	}
	
	/**
	 * M�todo que muestra el t�tulo de la secci�n del apartado en tutoriales
	 * (Nuestros o Terceros).
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_sistema_operativo El identificador del sistema operativo.
	 */
	function mostrarTitulo($id_pertenencia_utilidad, $id_apartado)
	{
		// Librer�as necesarias.
		include("apartado.php");
		
		// Creamos un objeto apartado y capturamos el nombre del apartado.
		$apartado = new apartado($this->enlace);
		$nombre = $apartado->nombre($id_apartado);
		
		// Dependiendo de la pertenencia de la utilidad, asignamos el t�tulo.
		switch ($id_pertenencia_utilidad)
		{
			case 1:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Tutoriales'>Tutoriales</A> / <A HREF='index.php' TITLE='Ver Nuestros'>Nuestros</A> / $nombre";
				$imagen = "activos/bgnuestros.jpg";
				break;
			}
			case 2:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Tutoriales'>Tutoriales</A> / <A HREF='index.php' TITLE='Ver de Terceros'>De Terceros</A> / $nombre";
				$imagen = "activos/bgterceros.jpg";
				break;
			}
		}
		$titulo = $nombre;
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * M�todo que muestra (en forma paginada) los tutoriales (Nuestro o Terceros)
	 * existentes en la base de datos.
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_apartado El identificador del apartado.
	 * @param $pagina El n�mero de la p�gina actual dentro de la paginaci�n total.
	 */
	function mostrar($id_pertenencia_utilidad, $id_apartado, $pagina)
	{
		// Librerias necesarias.
		include("paginacion.php");
		include("tiempo.php");
		
		// Inicializaci�n de variables.
		$vinculo = "tutoriales.php?id=" . $id_apartado . "&";
		$porpagina = 20;
		
		// Realizamos la consulta.
		switch ($id_pertenencia_utilidad)
		{
			case 1: $consulta = $this->consultaNuestros($id_apartado); break;
			case 2: $consulta = $this->consultaTerceros($id_apartado); break;
		}
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay tutoriales.
		if ($total == 0)
		{
			// Preguntamos por la pertenencia del tutorial.
			switch ($id_pertenencia_utilidad)
			{
				case 1: echo "<P CLASS='contenido'>No hay tutoriales nuestros.</P>"; break;
				case 2: echo "<P CLASS='contenido'>No hay tutoriales de terceros.</P>"; break;
			}
		}
		
		// Cuando si hay tutoriales.
		else
		{
			// Creamos un objeto paginacion y un objeto tiempo.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$tiempo = new tiempo();
			
			// Abrimos la tabla para el total, la paginaci�n y los tutoriales.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			
			// Preguntamos por la pertenencia del tutorial para mostrar mensajes.
			switch ($id_pertenencia_utilidad)
			{
				case 1: echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total tutoriales nuestros.</TD>"; break;
				case 2: echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total tutoriales de terceros.</TD>"; break;
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
			
			// Abrimos la tabla para los tutoriales.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condici�n de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos los tutoriales.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				$this->item($tupla, $tiempo, false, true);
			}
			
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
			echo "</TD>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "</TABLE>";
		}
		
		// Liberaci�n de memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de b�squeda.
		$this->formularioBusqueda($id_pertenencia_utilidad, $id_apartado);
	}
	
	/**
	 * M�todo que realiza la consulta para obtener informaci�n de nuestros tutoriales.
	 *
	 * @param $id_apartado El identificador del apartado.
	 *
	 * @return $consulta La consulta generada.
	 */
	function consultaNuestros($id_apartado)
	{
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.tamanio_utilidad, utilidad.fecha_llegada, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, utilidad.desc_utilidad, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad ";
		$from = "FROM utilidad, formato, usuario_interno, persona, idioma ";
		$where = "WHERE utilidad.id_tipo_utilidad = 2 AND utilidad.id_pertenencia_utilidad = 1 AND utilidad.id_apartado = $id_apartado AND utilidad.id_formato = formato.id_formato AND utilidad.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona AND utilidad.id_idioma = idioma.id_idioma ";
		$order = "ORDER BY utilidad.fecha_llegada DESC";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where . $order;
	}
	
	/**
	 * M�todo que realiza la consulta para obtener informaci�n de los tutoriales de terceros.
	 *
	 * @param $id_apartado El identificador del apartado.
	 *
	 * @return $consulta La consulta generada.
	 */
	function consultaTerceros($id_apartado)
	{
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.tamanio_utilidad, utilidad.fecha_llegada, empresa.nombre_empresa, empresa.url_empresa, utilidad.desc_utilidad, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad ";
		$from = "FROM utilidad, formato, empresa, idioma ";
		$where = "WHERE utilidad.id_tipo_utilidad = 2 AND utilidad.id_pertenencia_utilidad = 2 AND utilidad.id_apartado = $id_apartado AND utilidad.id_formato = formato.id_formato AND utilidad.id_empresa = empresa.id_empresa AND utilidad.id_idioma = idioma.id_idioma ";
		$order = "ORDER BY utilidad.fecha_llegada DESC";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where . $order;
	}
	
	/**
	 * M�todo que muestra el formulario de b�squeda para los tutoriales (Nuestros o Terceros).
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_sistema_operativo El identificador del sistema operativo.
	 */
	function formularioBusqueda($id_pertenencia_utilidad, $id_apartado)
	{
		switch ($id_pertenencia_utilidad)
		{
			case 1:
			{
				$titulo = "B&uacute;squeda de Nuestros Tutoriales";
				$comentario = "nuestros tutoriales";
				break;
			}
			case 2:
			{
				$titulo = "B&uacute;squeda de Tutoriales de Terceros";
				$comentario = "tutoriales de terceros";
				break;
			}
		}
		$ocultos = "<INPUT TYPE='hidden' NAME='id' VALUE='$id_apartado'>";
		require("busquedasimple.inc");
	}
	
	/**
	 * M�todo que muestra el t�tulo de la secci�n B�squeda de Tutorial (nuestros o de
	 * terceros).
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_apartado El identificador del apartado.
	 */
	function tituloBusqueda($id_pertenencia_utilidad, $id_apartado)
	{
		// Librer�as necesarias.
		include("apartado.php");
		
		// Creamos un objeto apartado y capturamos el nombre del apartado.
		$apartado = new apartado($this->enlace);
		$nombre = $apartado->nombre($id_apartado);
		
		// Dependiendo de la pertenencia de la utilidad, asignamos el t�tulo.
		switch ($id_pertenencia_utilidad)
		{
			case 1:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Tutoriales'>Tutoriales</A> / <A HREF='index.php' TITLE='Ver Nuestros'>Nuestros</A> / <A HREF='tutoriales.php?id=$id_apartado&pagina=1' TITLE='Ver $nombre'>$nombre</A> / B&uacute;squeda";
				$imagen = "activos/bgnuestros.jpg";
				$titulo = "B&uacute;squeda de Nuestros Tutoriales";
				break;
			}
			case 2:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Tutoriales'>Tutoriales</A> / <A HREF='index.php' TITLE='Ver de Terceros'>De Terceros</A> / <A HREF='tutoriales.php?id=$id_apartado&pagina=1' TITLE='Ver $nombre'>$nombre</A> / B&uacute;squeda";
				$imagen = "activos/bgterceros.jpg";
				$titulo = "B&uacute;squeda de Tutoriales de Terceros";
				break;
			}
		}
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * M�todo que busca los tutoriales (Nuestros o de Terceros) de cierto apartado
	 * y los resultados los muestra (en forma paginada).
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_apartado El identificador del apartado.
	 * @param $palabra La palabra o frase a buscar.
	 * @param $pagina El n�mero actual de la p�gina dentro de la paginaci�n total.
	 */
	function buscar($id_pertenencia_utilidad, $id_apartado, $palabra, $pagina)
	{
		// Librer�as necesarias.
		include("paginacion.php");
		include("tiempo.php");
		
		// Inicializaci�n de variables.
		$vinculo = "tutoriales.php?id=" . $id_apartado . "&";
		$porpagina = 20;
		
		// Realizamos la consulta.
		switch ($id_pertenencia_utilidad)
		{
			case 1: $consulta = $this->consultaBusquedaNuestros($id_apartado, $palabra); break;
			case 2: $consulta = $this->consultaBusquedaTerceros($id_apartado, $palabra); break;
		}
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay tutoriales.
		if ($total == 0)
		{
			// Preguntamos por la pertenencia del tutorial.
			switch ($id_pertenencia_utilidad)
			{
				case 1: echo "<P CLASS='contenido'>No se encontraron tutoriales nuestros.</P>"; break;
				case 2: echo "<P CLASS='contenido'>No se encontraron tutoriales de terceros.</P>"; break;
			}
		}
		
		// Cuando si hay tutoriales.
		else
		{
			// Creamos un objeto paginacion y un objeto tiempo.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$tiempo = new tiempo();
			
			// Abrimos la tabla para el total, la paginaci�n y los tutoriales.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			
			// Preguntamos por la pertenencia del tutorial para mostrar mensajes.
			switch ($id_pertenencia_utilidad)
			{
				case 1: echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total tutoriales nuestros.</TD>"; break;
				case 2: echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total tutoriales de terceros.</TD>"; break;
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
			
			// Abrimos la tabla para los tutoriales.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condici�n de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos los tutoriales.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				$this->item($tupla, $tiempo, false, true);
			}
			
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
			echo "</TD>";
			
			// Imprimimos la paginaci�n.
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "</TABLE>";
		}
		
		// Liberaci�n de memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de b�squeda.
		$this->formularioBusqueda($id_pertenencia_utilidad, $id_apartado);
	}
	
	/**
	 * M�todo que realiza la consulta para obtener informaci�n de un tutorial nuestro
	 * que coinciden con la palabra enviada.
	 *
	 * @param $id_apartado El identificador del apartado.
	 * @param $palabra La palabra o frase a buscar.
	 *
	 * @return $consulta La consulta generada.
	 */
	function consultaBusquedaNuestros($id_apartado, $palabra)
	{
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.tamanio_utilidad, utilidad.fecha_llegada, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, utilidad.desc_utilidad, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad ";
		$from = "FROM utilidad, formato, usuario_interno, persona, idioma ";
		$where = "WHERE utilidad.id_apartado = $id_apartado AND (utilidad.nombre_utilidad LIKE '%$palabra%' OR utilidad.desc_utilidad LIKE '%$palabra%') AND utilidad.id_tipo_utilidad = 2 AND utilidad.id_pertenencia_utilidad = 1 AND utilidad.id_formato = formato.id_formato AND utilidad.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona AND utilidad.id_idioma = idioma.id_idioma ";
		$order = "ORDER BY utilidad.fecha_llegada DESC";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where;
	}
	
	/**
	 * M�todo que realiza la consulta para obtener informaci�n de un tutorial de terceros
	 * que coinciden con la palabra enviada.
	 *
	 * @param $id_apartado El identificador del apartado.
	 * @param $palabra La palabra o frase a buscar.
	 *
	 * @return $consulta La consulta generada.
	 */
	function consultaBusquedaTerceros($id_apartado, $palabra)
	{
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.tamanio_utilidad, utilidad.fecha_llegada, empresa.nombre_empresa, empresa.url_empresa, utilidad.desc_utilidad, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad ";
		$from = "FROM utilidad, formato, empresa, idioma ";
		$where = "WHERE utilidad.id_apartado = $id_apartado AND (utilidad.nombre_utilidad LIKE '%$palabra%' OR utilidad.desc_utilidad LIKE '%$palabra%') AND utilidad.id_tipo_utilidad = 2 AND utilidad.id_pertenencia_utilidad = 2 AND utilidad.id_formato = formato.id_formato AND utilidad.id_empresa = empresa.id_empresa AND utilidad.id_idioma = idioma.id_idioma ";
		$order = "ORDER BY utilidad.fecha_llegada DESC";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where;
	}
	
	/**
	 * M�todo que muestra el t�tulo de la secci�n 'Acceso al tutorial' (Nuestros o
	 * De Terceros).
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_utilidad El identificador de la utilidad.
	 */
	function tituloAcceso($id_pertenencia_utilidad, $id_utilidad)
	{
		// Consulta para capturamos el nombre del apartado en que estamos.
		$consulta = "SELECT apartado.id_apartado, apartado.nombre_apartado FROM utilidad, apartado WHERE id_utilidad = $id_utilidad AND utilidad.id_apartado = apartado.id_apartado";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		$id_apartado = $fila["id_apartado"];
		$apartado = $fila["nombre_apartado"];
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Dependiendo de la pertenencia de la utilidad, configuramos los mensajes.
		switch ($id_pertenencia_utilidad)
		{
			case 1:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Tutoriales'>Tutoriales</A> / <A HREF='index.php' TITLE='Ver Nuestros'>Nuestros</A> / <A HREF='tutoriales.php?id=$id_apartado&pagina=1' TITLE='Ver $apartado'>$apartado</A> / Acceso";
				$imagen = "activos/bgnuestros.jpg";
				break;
			}
			case 2:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Tutoriales'>Tutoriales</A> / <A HREF='index.php' TITLE='Ver de Terceros'>De Terceros</A> / <A HREF='tutoriales.php?id=$id_apartado&pagina=1' TITLE='Ver $apartado'>$apartado</A> / Acceso";
				$imagen = "activos/bgterceros.jpg";
				break;
			}
		}
		$titulo = "Acceso al Tutorial";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * M�todo que muestra en forma detallada la informaci�n de un tutorial (Nuestro o De Terceros).
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $opcion La opci�n que se escogi�.
	 * @param $tipo_comentario El tipo de comentario correspondiente a la secci�n.
	 * @param $id_utilidad El identificador de la utilidad.
	 */
	function detallar($id_pertenencia_utilidad, $opcion, $tipo_comentario, $id_utilidad)
	{
		// Librerias necesarias.
		include("tiempo.php");
		
		// Realizamos la consulta.
		switch ($id_pertenencia_utilidad)
		{
			case 1: $query = $this->consultaDetallarNuestro($id_utilidad); break;
			case 2: $query = $this->consultaDetallarTerceros($id_utilidad); break;
		}
		$resultado = mysql_query($query, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Cuando no hay tutorial.
		if (!$resultado)
		{
			// Preguntamos por la pertenencia del tutorial.
			switch ($id_pertenencia_utilidad)
			{
				case 1: echo "<P CLASS='contenido'>No existe este tutorial nuestro.</P>"; break;
				case 2: echo "<P CLASS='contenido'>No existe este tutorial de terceros.</P>"; break;
			}
		}
		// Cuando si hay tutorial.
		else
		{
			// Creamos un objeto tiempo.
			$tiempo = new tiempo();
			
			// Mostramos los detalles del tutorial.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			if ($opcion == 1)
				$this->item($tupla, $tiempo, true, false);
			else $this->item($tupla, $tiempo, true, true);
			switch ($tipo_comentario)
			{
				case 1: printf("<TR><TD CLASS='contenido' COLSPAN='2'>Si no se abre autom&aacute;ticamente, pulsa <A HREF='%s' TITLE='Acceder directamente' TARGET='_blank'>aqu&iacute;</A>.</TD></TR>", strtr($tupla["url_utilidad"], $this->caracteres)); break;
				case 2: printf("<TR><TD CLASS='contenido' COLSPAN='2'>Haz tus comentarios u opiniones sobre este tutorial.</TD></TR>"); break;
				case 3: printf("<TR><TD CLASS='contenido' COLSPAN='2'>Estos son los comentarios que han efectuado los usuarios a este tutorial.</TD></TR>"); break;
				case 4: printf("<TR><TD CLASS='contenido' COLSPAN='2'>Haz tus votaci&oacute;n sobre este tutorial.</TD></TR>"); break;
			}
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "<TR><TD COLSPAN='2' ALIGN='center'><A HREF=\"javascript:history.back(1);\" TITLE='Volver'><IMG SRC='../../librerias/btvolver.gif' BORDER='0'></A></TD></TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "</TABLE>";
			
			// Incrementamos las visitas y la actualizamos.
			if ($opcion == 1)
			{
				$visitas = $tupla["visitas_utilidad"] + 1;
				$this->actualizarVisitas($tupla["id_utilidad"], $visitas);
			}
		}
	}
	
	/**
	 * M�todo que rehaliza el query para obtener informaci�n de un tutorial nuestro.
	 *
	 * @param $id_utilidad El identificador de la utilidad.
	 *
	 * @return $consulta La consutla generada.
	 */
	function consultaDetallarNuestro($id_utilidad)
	{
		$select = "SELECT utilidad.id_utilidad, utilidad.url_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.tamanio_utilidad, utilidad.fecha_llegada, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, utilidad.desc_utilidad, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad, apartado.nombre_apartado ";
		$from = "FROM utilidad, formato, usuario_interno, persona, idioma, apartado ";
		$where = "WHERE utilidad.id_utilidad = $id_utilidad AND utilidad.id_tipo_utilidad = 2 AND utilidad.id_pertenencia_utilidad = 1 AND utilidad.id_formato = formato.id_formato AND utilidad.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_apartado = apartado.id_apartado";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where;
	}
	
	/**
	 * M�todo que rehaliza para obtener informaci�n de un tutorial de terceros.
	 *
	 * @param $id_utilidad El identificador de la utilidad.
	 *
	 * @return $consulta La consutla generada.
	 */
	function consultaDetallarTerceros($id_utilidad)
	{
		$select = "SELECT utilidad.id_utilidad, utilidad.url_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.tamanio_utilidad, utilidad.fecha_llegada, empresa.nombre_empresa, empresa.url_empresa, utilidad.desc_utilidad, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad, apartado.nombre_apartado ";
		$from = "FROM utilidad, formato, empresa, idioma, apartado ";
		$where = "WHERE utilidad.id_utilidad = $id_utilidad AND utilidad.id_tipo_utilidad = 2 AND utilidad.id_pertenencia_utilidad = 2 AND utilidad.id_formato = formato.id_formato AND utilidad.id_empresa = empresa.id_empresa AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_apartado = apartado.id_apartado";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where;
	}
	
	/**
	 * M�todo que muestra el t�tulo de la secci�n comentar el tutorial.
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_utilidad El identificador de la utilidad.
	 */
	function tituloComentar($id_pertenencia_utilidad, $id_utilidad)
	{
		// Consulta para capturar el nombre del apartado en que estamos.
		$consulta = "SELECT apartado.id_apartado, apartado.nombre_apartado FROM utilidad, apartado WHERE id_utilidad = $id_utilidad AND utilidad.id_apartado = apartado.id_apartado";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		$id_apartado = $fila["id_apartado"];
		$apartado = $fila["nombre_apartado"];
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Dependiendo de la pertenencia de la utilidad configuramos los mensajes.
		switch ($id_pertenencia_utilidad)
		{
			case 1:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Tutoriales'>Tutoriales</A> / <A HREF='index.php' TITLE='Ver Nuestros'>Nuestros</A> / <A HREF='tutoriales.php?id=$id_apartado&pagina=1' TITLE='Ver $apartado'>$apartado</A> / Comentar";
				$imagen = "activos/bgnuestros.jpg";
				break;
			}
			case 2:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Tutoriales'>Tutoriales</A> / <A HREF='index.php' TITLE='Ver de Terceros'>De Terceros</A> / <A HREF='tutoriales.php?id=$id_apartado&pagina=1' TITLE='Ver $apartado'>$apartado</A> / Comentar";
				$imagen = "activos/bgterceros.jpg";
				break;
			}
		}
		$titulo = "Comentar el Tutorial";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * M�todo que muestra el t�tulo de la secci�n 'Ver comentarios' del tutorial.
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_utilidad El identificador de la utilidad.
	 */
	function tituloComentarios($id_pertenencia_utilidad, $id_utilidad)
	{
		// Consulta para capturamos el nombre del apartado en que estamos.
		$consulta = "SELECT apartado.id_apartado, apartado.nombre_apartado FROM utilidad, apartado WHERE id_utilidad = $id_utilidad AND utilidad.id_apartado = apartado.id_apartado";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		$id_apartado = $fila["id_apartado"];
		$apartado = $fila["nombre_apartado"];
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Dependiendo de la pertenencia de la utilidad, configuramos el t�tulo.
		switch ($id_pertenencia_utilidad)
		{
			case 1:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Tutoriales'>Tutoriales</A> / <A HREF='index.php' TITLE='Ver Nuestros'>Nuestros</A> / <A HREF='tutoriales.php?id=$id_apartado&pagina=1' TITLE='Ver $apartado'>$apartado</A> / Comentarios";
				$imagen = "activos/bgnuestros.jpg";
				break;
			}
			case 2:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Tutoriales'>Tutoriales</A> / <A HREF='index.php' TITLE='Ver de Terceros'>De Terceros</A> / <A HREF='tutoriales.php?id=$id_apartado&pagina=1' TITLE='Ver $apartado'>$apartado</A> / Comentarios";
				$imagen = "activos/bgterceros.jpg";
				break;
			}
		}
		$titulo = "Comentarios del Tutorial";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * M�todo que muestra el t�tulo de la secci�n 'Votaci�n' por un tutorial.
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_utilidad El identificador de la utilidad.
	 */
	function tituloVotar($id_pertenencia_utilidad, $id_utilidad)
	{
		// Consulta para capturar el nombre del apartado en que estamos.
		$consulta = "SELECT apartado.id_apartado, apartado.nombre_apartado FROM utilidad, apartado WHERE id_utilidad = $id_utilidad AND utilidad.id_apartado = apartado.id_apartado";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		$id_apartado = $fila["id_apartado"];
		$apartado = $fila["nombre_apartado"];
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Dependiendo de la pertenencia de la utilidad, configuramos el t�tulo.
		switch ($id_pertenencia_utilidad)
		{
			case 1:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Tutoriales'>Tutoriales</A> / <A HREF='index.php' TITLE='Ver Nuestros'>Nuestros</A> / <A HREF='tutoriales.php?id=$id_apartado&pagina=1' TITLE='Ver $apartado'>$apartado</A> / Votaci&oacute;n";
				$imagen = "activos/bgnuestros.jpg";
				break;
			}
			case 2:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Tutoriales'>Tutoriales</A> / <A HREF='index.php' TITLE='Ver de Terceros'>De Terceros</A> / <A HREF='tutoriales.php?id=$id_apartado&pagina=1' TITLE='Ver $apartado'>$apartado</A> / Votaci&oacute;n";
				$imagen = "activos/bgterceros.jpg";
				break;
			}
		}
		$titulo = "Votaci&oacute;n del Tutorial";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * M�todo que muestra las estad�sticas (m�s visitados, m�s comentados o m�s
	 * votados) de los tutoriales.
	 *
	 * @param $tipo El tipo de estad�stica a mostrar.
	 * @param $tiempo El objeto tiempo ya inicializado.
	 */
	function estadisticas($tipo, $tiempo)
	{
		// Vemos el tipo de estad�stica.
		switch ($tipo)
		{
			case 1: $consulta = $this->consultaVisitados(); break;
			case 2: $consulta = $this->consultaComentados(); break;
			case 3: $consulta = $this->consultaVotados(); break;
		}
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Contador para los tutoriales.
		$contador = 0;
		
		// Tabla para los tutoriales.
		echo "<TABLE WIDTH='100%' BORDER='0'>";
		echo "<TR>";
		
		// Vemos el tipo de estad�stica.
		switch ($tipo)
		{
			case 1: echo "<TD COLSPAN='2' ALIGN='center' BGCOLOR='F1F1F1' CLASS='contenido'><B>Los tutoriales m&aacute;s visitados</B></TD>"; break;
			case 2: echo "<TD COLSPAN='2' ALIGN='center' BGCOLOR='F1F1F1' CLASS='contenido'><B>Los tutoriales m&aacute;s comentados</B></TD>"; break;
			case 3: echo "<TD COLSPAN='2' ALIGN='center' BGCOLOR='F1F1F1' CLASS='contenido'><B>Los tutoriales m&aacute;s votados</B></TD>"; break;
		}
		echo "</TR>";
		echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
		
		// Cuando no hay tutoriales.
		if ($total == 0)
		{
			// Vemos el tipo de estad�stica.
			switch ($tipo)
			{
				case 1: echo "<TR><TD COLSPAN='2' CLASS='contenido'>No hay tutoriales visitados.</TD></TR><TR><TD COLSPAN='2'>&nbsp;</TD></TR>"; break;
				case 2: echo "<TR><TD COLSPAN='2' CLASS='contenido'>No hay tutoriales comentados.</TD></TR><TR><TD COLSPAN='2'>&nbsp;</TD></TR>"; break;
				case 3: echo "<TR><TD COLSPAN='2' CLASS='contenido'>No hay tutoriales votados.</TD></TR><TR><TD COLSPAN='2'>&nbsp;</TD></TR>"; break;
			}
		}
		// Cuando si hay tutoriales.
		else
		{
			// Imprimimos 3 primeros tutoriales arrojados por la consulta.
			while (($tupla = mysql_fetch_array($resultado)) && ($contador < 3))
			{
				$this->itemEstadistica($tupla, $tiempo);
				$contador++;
			}
		}
		// Cerramos la tabla y la columna.
		echo "</TABLE>";
		
		// Liberaci�n de memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * M�todo que retorna el string con la consulta de los tutoriales ordenados
	 * por n�mero de visitas.
	 *
	 * @return $consulta La consulta generada.
	 */
	function consultaVisitados()
	{
		// Consulta para obtener todos los tutoriales, ordenados por n�mero de visitas.
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.tamanio_utilidad, utilidad.fecha_llegada, utilidad.desc_utilidad, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad, apartado.nombre_apartado ";
		$from = "FROM utilidad, formato, idioma, apartado ";
		$where = "WHERE utilidad.id_tipo_utilidad = 2 AND utilidad.visitas_utilidad > 0 AND utilidad.id_formato = formato.id_formato AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_apartado = apartado.id_apartado ";
		$order = "ORDER BY visitas_utilidad DESC, utilidad.nombre_utilidad";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where . $order;
	}
	
	/**
	 * M�todo que retorna el string con la consulta de los tutoriales ordenados
	 * por n�mero de comentarios.
	 *
	 * @return $consulta La consulta generada.
	 */
	function consultaComentados()
	{
		// Consulta para obtener todos los tutoriales, ordenados por n�mero de comentarios.
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.tamanio_utilidad, utilidad.fecha_llegada, utilidad.desc_utilidad, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad, COUNT(*) AS num_comentarios, apartado.nombre_apartado ";
		$from = "FROM utilidad, formato, idioma, comentario, apartado ";
		$where = "WHERE utilidad.id_tipo_utilidad = 2 AND utilidad.id_formato = formato.id_formato AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_utilidad = comentario.id_utilidad AND utilidad.id_apartado = apartado.id_apartado ";
		$group = "GROUP BY utilidad.id_utilidad ";
		$order = "ORDER BY num_comentarios DESC, utilidad.nombre_utilidad";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where . $group . $order;
	}
	
	/**
	 * M�todo que retorna el string con la consulta de los tutoriales ordenados
	 * por n�mero de votos.
	 *
	 * @return $consulta La consulta generada.
	 */
	function consultaVotados()
	{
		// Consulta para obtener todos los tutoriales, ordenados por n�mero de votos.
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.tamanio_utilidad, utilidad.fecha_llegada, utilidad.desc_utilidad, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad, apartado.nombre_apartado ";
		$from = "FROM utilidad, formato, idioma, apartado ";
		$where = "WHERE utilidad.id_tipo_utilidad = 2 AND utilidad.votos_utilidad > 0 AND utilidad.id_formato = formato.id_formato AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_apartado = apartado.id_apartado ";
		$order = "ORDER BY votos_utilidad DESC, utilidad.nombre_utilidad";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where . $order;
	}
	
	/**
	 * M�todo que imprime un tutorial destacado en las estadisticas.
	 *
	 * @param $tupla La tupla resultante de una consulta.
	 * @param $tiempo El objeto tiempo.
	 */
	function itemEstadistica($tupla, $tiempo)
	{
		// Imprimimos el formato, con el t�tulo, el v�nculo al sitio de descarga y el
		// icono si es nuevo.
		printf("<TR>");
		printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>T&iacute;tulo:</B></TD>", "15%");
		printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'>", "85%");
		switch ($tupla["id_pertenencia_utilidad"])
		{
			case 1: $ruta = "../nuestros/"; break;
			case 2: $ruta = "../terceros/"; break;
		}
		$nombre = strtr($tupla["nombre_utilidad"], $this->caracteres);
		printf("<A HREF='%senlazar.php?id=%d' TITLE='Acceder a %s'><IMG SRC='../../librerias/%s' BORDER='0'> <B>%s</B></A>", $ruta, $tupla["id_utilidad"], $nombre, $tupla["src_formato"], $nombre);
		if ($tiempo->entreLapso($tupla["fecha_llegada"], 24))
			printf(" <IMG SRC='../../librerias/iconuevo.gif'>");
		printf("</TD>");
		printf("</TR>");
		
		// Mostramos el nombre de apartado.
		printf("<TR>");
		printf("<TD CLASS='tabla' VALIGN='top'><B>Apartado:</B></TD>");
		printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $tupla["nombre_apartado"]);
		printf("</TR>");
		
		// Imprimimos el autor.
		switch ($tupla["id_pertenencia_utilidad"])
		{
			case 1: $autor = $this->autorNuestros($tupla["id_utilidad"]); break;
			case 2: $autor = $this->autorTerceros($tupla["id_utilidad"]); break;
		}
		printf("<TR>");
		printf("<TD CLASS='tabla' VALIGN='top'><B>Autor:</B></TD>");
		printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $autor);
		printf("</TR>");
		
		// Imprimimos la descripci�n.
		printf("<TR>");
		printf("<TD CLASS='tabla' VALIGN='TOP' COLSPAN='2'>%s</TD>", nl2br(strtr($tupla["desc_utilidad"], $this->caracteres)));
		printf("</TR>");
		
		// Imprimimos el idioma y el icono del idioma.
		printf("<TR>");
		printf("<TD CLASS='tabla' VALIGN='top'><B>Idioma:</B></TD>");
		printf("<TD CLASS='tabla' VALIGN='top'>%s <IMG SRC='../../librerias/%s'></TD>", $tupla["nombre_idioma"], $tupla["src_idioma"]);
		printf("</TR>");
		
		// Calculamos la valoraci�n de la utilidad (valoraci�n = puntuacion/votos).
		if ($tupla["votos_utilidad"] > 0)
			$valoracion = $tupla["puntuacion_utilidad"]/$tupla["votos_utilidad"];
		else $valoracion = 0.0;
		
		// Obtenemos el n�mero de comentarios de la utilidad.
		$num_comentarios = $this->numeroComentarios($tupla["id_utilidad"]);
		
		// Tabla para el n�mero de comentarios, la valoraci�n, las visitas y los �conos
		// de ver comentarios, comentar y votar.
		printf("<TR>");
		printf("<TD COLSPAN='2'>");
		printf("<TABLE WIDTH='%s' BORDER='0' CELLPADDING='0' CELLSPACING='0'>", "100%");
		printf("<TR>");
		printf("<TD BGCOLOR='#FFFFFF' CLASS='tabla' VALIGN='top' WIDTH='%s'>Comentarios: %d - Valoraci&oacute;n: ", "70%", $num_comentarios);
		if ($valoracion > 0.0)
		{
			if ($valoracion < 4.0)
				printf("<IMG SRC='../../librerias/icoreprobado.gif'> ");
			else printf("<IMG SRC='../../librerias/icoaprobado.gif'> ");
		}
		printf("( %0.1f / %d votos ) - Visitas: %d</TD>", $valoracion, $tupla["votos_utilidad"], $tupla["visitas_utilidad"]);
		printf("<TD BGCOLOR='#FFFFFF' CLASS='tabla' VALIGN='top' WIDTH='%s' ALIGN='right'>", "30%");
		if ($num_comentarios > 0)
			printf("<A HREF='%scomentarios.php?id=%d&pagina=1' TITLE='Ver Comentarios'><IMG SRC='../../librerias/icocomentarios.gif' BORDER='0'></A> ", $ruta, $tupla["id_utilidad"]);
		printf("<A HREF='%scomentar.php?id=%d' TITLE='Comentar'><IMG SRC='../../librerias/icocomentar.gif' BORDER='0'></A> ", $ruta, $tupla["id_utilidad"]);
		printf("<A HREF='%svotar.php?id=%d' TITLE='Votar'><IMG SRC='../../librerias/icovotar.gif' BORDER='0'></A> ", $ruta, $tupla["id_utilidad"]);
		printf("</TD>");
		printf("</TR>");
		printf("</TABLE>");
		printf("</TD>");
		printf("</TR>");
		
		// Imprimimos un espacio en blanco.
		echo "<TR><TD>&nbsp;</TD></TR>";
	}
	
	/**
	 * M�todo que construye el formulario para ingresar a un nuevo tutorial a la
	 * base de datos.
	 *
	 * @param $id_persona El identificador del persona.
	 */
	function formularioAgregar($id_persona)
	{
		// Librer�as necesarias.
		include("apartado.php");
		include("idioma.php");
		include("formato.php");
		
		// Consulta que obtiene los antecedentes del usuario interno con identificaci�n conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Escribimos la tabla para el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Agregar Tutorial</B></TD>";
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
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='50' TABINDEX='1' TITLE='T&iacute;tulo del tutorial'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Apartado:</TD>";
		echo "<TD>";
		$apartado = new apartado($this->enlace);
		$apartado->select(0);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Idioma:</TD>";
		echo "<TD>";
		$idioma = new idioma($this->enlace);
		$idioma->select(3);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Formato:</TD>";
		echo "<TD>";
		$formato = new formato($this->enlace);
		$formato->select(1);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='archivo_internet' CHECKED='true' onClick='deshabilitarSRC();' VALUE='1' TABINDEX='1'> El archivo ya est&aacute; en Internet</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>URL: <INPUT TYPE='text' NAME='url_archivo' CLASS='formtextfield' MAXLENGTH='100' VALUE='http://' TABINDEX='1' TITLE='URL donde se encuentra el archivo (Incluir el protocolo http:// � ftp://)'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='archivo_internet' onClick='deshabilitarURL();' VALUE='0' TABINDEX='1'> Debo subir el archivo a Internet</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>SRC: <INPUT TYPE='file' NAME='src_archivo' CLASS='formtextfield' DISABLED='true' TABINDEX='1' TITLE='Archivo *.DOC - *.EXE - *.HTML - *.PDF - *.PS - *.RAR - *.RTF - *.RPM - *.TAR - *.TXT - *.ZIP (M&aacute;x. 1 MB)'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel' COLSPAN='2' ALIGN='center'>Texto:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='center'><TEXTAREA NAME='descripcion' CLASS='formtextarea' ROWS='10' TABINDEX='1' TITLE='Descripci&oacute;n del tutorial'></TEXTAREA> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
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
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='agregar' VALUE='Agregar' CLASS='formbutton' TABINDEX='1' TITLE='Agregar el tutorial'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * M�todo que agrega un nuevo tutorial a la base de datos.
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_apartado El identificador del apartado.
	 * @param $id_idioma El identificador del idioma.
	 * @param $id_formato El identificador del formato.
	 * @param $id_persona El identificador de la persona.
	 * @param $titulo El t�tulo del tutorial.
	 * @param $descripcion La descripci�n del tutorial.
	 * @param $esta_subido Si el archivo est� subido a Internet o no.
	 * @param $archivo El archivo del tutorial.
	 */
	function agregar($id_pertenencia_utilidad, $id_apartado, $id_idioma, $id_formato, $id_persona, $titulo, $descripcion, $esta_subido, $archivo)
	{
		// Obtener la hora actual.
		$fecha = date("Y-m-d");
		
		// Cuando el archivo ya est� subido a la Internet.
		if ($esta_subido)
		{
			// Consulta para insertar el registro de un tutorial en la tabla 'utilidad'.
			$consulta = "INSERT INTO utilidad(id_pertenencia_utilidad, id_apartado, id_idioma, id_formato, id_tipo_utilidad, id_persona, nombre_utilidad, desc_utilidad, url_utilidad, visitas_utilidad, votos_utilidad, puntuacion_utilidad, fecha_llegada) VALUES ($id_pertenencia_utilidad, $id_apartado, $id_idioma, $id_formato, 2, $id_persona, '$titulo', '$descripcion', '$archivo', 0, 0, 0, '$fecha')";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos mensajes de �xito de la operaci�n.
			echo "<P CLASS='contenido' ALIGN='center'><B>TU TUTORIAL FUE AGREGADO EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Este tutorial ser&aacute; publicado en la secci&oacute;n \"Nuestros Tutoriales\" dentro de este sitio Web. Gracias por colaborar con nosotros.</P>";
			echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
		}
		// Cuando el archivo no est� subido a la Internet.
		else
		{
			// Cuando hay espacio en disco, el archivo existe y el archivo es menor o igual a 1MB.
			if ($archivo['size'] <= diskfreespace("/") && 0 < $archivo['size'] && $archivo['size'] <= 1000000)
			{
				// Consulta para obtener el mayor identificador en la tabla 'utilidad'.
				$consulta = "SELECT MAX(id_utilidad) AS mayor FROM utilidad";
				$resultado = mysql_query($consulta, $this->enlace);
				$fila = mysql_fetch_array($resultado);
				
				// Asignamos el nombre el archivo que vamos a subir.
				$id_utilidad = ($fila["mayor"] + 1);
				$nombre_archivo = $id_utilidad . substr($archivo['name'], strpos($archivo['name'], "."));
				$url_utilidad = "http://" . $_SERVER["SERVER_NAME"] . "/tutoriales/activos/" . $nombre_archivo;
				
				// Transformamos de kb a KB.
				$tamanio_utilidad = $archivo['size'] / 8;
				
				// Consulta para insertar el registro de un software en la tabla 'utilidad'.
				$consulta = "INSERT INTO utilidad(id_utilidad, id_pertenencia_utilidad, id_apartado, id_idioma, id_formato, id_tipo_utilidad, id_persona, nombre_utilidad, desc_utilidad, url_utilidad, tamanio_utilidad, visitas_utilidad, votos_utilidad, puntuacion_utilidad, fecha_llegada) VALUES ($id_utilidad, $id_pertenencia_utilidad, $id_apartado, $id_idioma, $id_formato, 2, $id_persona, '$titulo', '$descripcion', '$url_utilidad', $tamanio_utilidad, 0, 0, 0, '$fecha')";
				mysql_query($consulta, $this->enlace);
				
				// Copiamos el archivo al servidor
				copy($archivo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . "/wwwic/tutoriales/activos/" . $nombre_archivo);
				
				// Imprimimos mensajes de �xito.
				echo "<P CLASS='contenido' ALIGN='center'><B>TU TUTORIAL FUE AGREGADO EXITOSAMENTE</B></P>";
				echo "<P CLASS='contenido'>Este tutorial ser&aacute; publicado en la secci&oacute;n \"Nuestros Tutoriales\" dentro de este sitio Web. Gracias por colaborar con nosotros.</P>";
				echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
			}
			// Cuando el archivo no se puede subir.
			else
			{
				// Imprimimos mensajes de error de envio.
				echo "<P CLASS='contenido' ALIGN='center'><B>TU TUTORIAL NO PUDO AGREGARSE EXITOSAMENTE</B></P>";
				echo "<P CLASS='contenido'>Esto se puede deber una de las siguientes razones:</P>";
				echo "<OL CLASS='contenido'>";
				echo "<LI>No hay espacio en el disco del servidor.</LI>";
				echo "<LI>El archivo no existe.</LI>";
				echo "<LI>El tama&ntilde;o del archivo es superior a 1000 KB.</LI>";
				echo "<OL>";
				echo "<P ALIGN='center'><A HREF='index.php' TITLE='Atr&aacute;s al Formulario'><IMG SRC='../../../../librerias/btatras.gif' BORDER='0'></A></P>";
			}
		}
	}
	
	/**
	 * M�todo que lista todos los tutoriales nuestros realizados por un usuario.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $vinculo La p�gina destino de la operaci�n.
	 */
	function listar($id_persona, $id_pertenencia_utilidad, $vinculo)
	{
		// Consulta que obtiene los antecedentes del usuario interno con identificaci�n conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE persona.id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$usuario = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
		mysql_free_result($resultado);
		
		// Consulta para obtener todos los tutoriales agregados por la persona.
		$consulta = "SELECT utilidad.id_utilidad, formato.nombre_formato, utilidad.nombre_utilidad, apartado.nombre_apartado, idioma.nombre_idioma FROM utilidad, formato, usuario_interno, idioma, apartado WHERE utilidad.id_tipo_utilidad = 2 AND utilidad.id_pertenencia_utilidad = $id_pertenencia_utilidad AND utilidad.id_formato = formato.id_formato AND utilidad.id_persona = $id_persona AND utilidad.id_persona = usuario_interno.id_persona AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_apartado = apartado.id_apartado ORDER BY utilidad.fecha_llegada";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay tutoriales.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay tutoriales realizados por $usuario.</P>";
			
		// Cuando si hay tutoriales.
		else
		{
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='6' CLASS='contenido'>Hay un total de $total tutoriales relizados por $usuario:</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'>&nbsp;</TD>";
			echo "<TD WIDTH='40%' ALIGN='center' CLASS='titulotabla'><B>T&iacute;tulo</B></TD>";
			echo "<TD WIDTH='30%' ALIGN='center' CLASS='titulotabla'><B>Apartado</B></TD>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'><B>Idioma</B></TD>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'><B>Formato</B></TD>";
			echo "</TR>";
			
			// Texto para enlazar a la operaci�n.
			if ($vinculo == "modificar.php")
				$texto_vinculo = "Modificar";
			else $texto_vinculo = "Eliminar";
			
			// Imprimimos la lista de tutoriales.			
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				printf("<TD ALIGN='center' VALIGN='top' CLASS='tabla'><A HREF='$vinculo?id=%s' TITLE='%s Tutorial'>%s</A></TD>", $tupla["id_utilidad"], $texto_vinculo, $texto_vinculo);
				printf("<TD VALIGN='top' CLASS='tabla'>%s</TD>", $tupla["nombre_utilidad"]);
				printf("<TD VALIGN='top' CLASS='tabla'>%s</TD>", $tupla["nombre_apartado"]);
				printf("<TD ALIGN='center' VALIGN='top' CLASS='tabla'>%s</TD>", $tupla["nombre_idioma"]);
				printf("<TD ALIGN='center' VALIGN='top' CLASS='tabla'>%s</TD>", $tupla["nombre_formato"]);
				printf("</TR>");
			}
			echo "</TABLE>";
		}
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * M�todo que muestra el formulario de modificaci�n de un tutorial.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_utilidad El identificador de la utilidad.
	 */
	function formularioModificar($id_persona, $id_pertenencia_utilidad, $id_utilidad)
	{
		// Librer�as necesarias.
		include("apartado.php");
		include("idioma.php");
		include("formato.php");
		
		// Consulta para obtener informaci�n del tutorial.
		$consulta = "SELECT utilidad.nombre_utilidad, apartado.id_apartado, idioma.id_idioma, formato.id_formato, utilidad.desc_utilidad, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, utilidad.url_utilidad FROM utilidad, formato, usuario_interno, idioma, apartado, persona WHERE utilidad.id_tipo_utilidad = 2 AND utilidad.id_pertenencia_utilidad = $id_pertenencia_utilidad AND utilidad.id_utilidad = $id_utilidad AND utilidad.id_persona = $id_persona AND utilidad.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_apartado = apartado.id_apartado AND utilidad.id_formato = formato.id_formato";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Escribimos la tabla para el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Modificar Tutorial</B></TD>";
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
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='50' TABINDEX='1' VALUE='" . $tupla["nombre_utilidad"] . "' TITLE='T&iacute;tulo del tutorial'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Apartado:</TD>";
		echo "<TD>";
		$apartado = new apartado($this->enlace);
		$apartado->select($tupla["id_apartado"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Idioma:</TD>";
		echo "<TD>";
		$idioma = new idioma($this->enlace);
		$idioma->select($tupla["id_idioma"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Formato:</TD>";
		echo "<TD>";
		$formato = new formato($this->enlace);
		$formato->select($tupla["id_formato"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='archivo_internet' CHECKED='true' onClick='deshabilitarSRC();' VALUE='1' TABINDEX='1'> El archivo ya est&aacute; en Internet</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>URL: <INPUT TYPE='text' NAME='url_archivo' CLASS='formtextfield' MAXLENGTH='100' VALUE='" . $tupla["url_utilidad"] . "' TABINDEX='1' TITLE='URL donde se encuentra el archivo (Incluir el protocolo http:// � ftp://)'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='archivo_internet' onClick='deshabilitarURL();' VALUE='0' TABINDEX='1'> Debo subir el archivo a Internet</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>SRC: <INPUT TYPE='file' NAME='src_archivo' CLASS='formtextfield' DISABLED='true' TABINDEX='1' TITLE='Archivo *.DOC - *.EXE - *.HTML - *.PDF - *.PS - *.RAR - *.RTF - *.RPM - *.TAR - *.TXT - *.ZIP (M&aacute;x. 1 MB)'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel' COLSPAN='2' ALIGN='center'>Texto:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='center'><TEXTAREA NAME='descripcion' CLASS='formtextarea' ROWS='10' TABINDEX='1' TITLE='Descripci&oacute;n del tutorial'>" . $tupla["desc_utilidad"] . "</TEXTAREA> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_utilidad' VALUE='" . $id_utilidad . "'</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido'>&nbsp;<FONT COLOR='#CC0000'>*</FONT> Datos obligatorios</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar el tutorial'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * M�todo que modifica los datos de un tutorial.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_utilidad El identificador de la utilidad.
	 * @param $titulo El t�tulo del tutorial.
	 * @param $id_apartado El identificador del apartado.
	 * @param $id_idioma El identificador del idioma.
	 * @param $id_formato El identificador del formato.
	 * @param $esta_subido Si el archivo est� subido a Internet o no.
	 * @param $archivo El archivo del tutorial.
	 * @param $descripcion La descripci�n del tutorial.
	 */
	function modificar($id_persona, $id_utilidad, $titulo, $id_apartado, $id_idioma, $id_formato, $esta_subido, $archivo, $descripcion)
	{
		// Cuando el archivo ya est� subido a la Internet.
		if ($esta_subido)
		{
			// Consulta para actualizar el registro de un software en la tabla 'utilidad'.
			$consulta = "UPDATE utilidad SET id_apartado = $id_apartado, id_idioma = $id_idioma, id_formato = $id_formato, nombre_utilidad = '$titulo', desc_utilidad = '$descripcion', url_utilidad = '$archivo' WHERE id_utilidad = $id_utilidad AND id_persona = $id_persona";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos mensajes de �xito de la operaci�n.
			echo "<P CLASS='contenido' ALIGN='center'><B>TU TUTORIAL FUE MODIFICADO EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Los datos del tutorial han sido modificados. Gracias por colaborar con nosotros.</P>";
			echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
		}
		// Cuando el archivo no est� subido a la Internet.
		else
		{
			// Cuando hay espacio en disco, el archivo existe y el archivo es menor o igual a 1MB.
			if ($archivo['size'] <= diskfreespace("/") && 0 < $archivo['size'] && $archivo['size'] <= 1000000)
			{
				// Consulta para obtener el nombre del archivo antiguo (que ya est� en el servidor).
				$consulta = "SELECT url_utilidad FROM utilidad WHERE id_utilidad = $id_utilidad";
				$resultado = mysql_query($consulta, $this->enlace);
				$tupla = mysql_fetch_array($resultado);
				mysql_free_result($resultado);
				
				// Asignamos el nombre el archivo que vamos a subir.
				$nombre_archivo = $id_utilidad . substr($archivo['name'], strpos($archivo['name'], "."));
				$url_utilidad = "http://" . $_SERVER["SERVER_NAME"] . "/tutoriales/activos/" . $nombre_archivo;
				
				// Transformamos de kb a KB.
				$tamanio_utilidad = $archivo['size'] / 8;
				
				// Consulta para actualizar el registro de un tutorial en la tabla 'utilidad'.
				$consulta = "UPDATE utilidad SET id_apartado = $id_apartado, id_idioma = $id_idioma, id_formato = $id_formato, nombre_utilidad = '$titulo', desc_utilidad = '$descripcion', url_utilidad = '$url_utilidad', tamanio_utilidad = $tamanio_utilidad WHERE id_utilidad = $id_utilidad AND id_persona = $id_persona";
				mysql_query($consulta, $this->enlace);
				
				// Borramos el archivo antiguo del servidor.
				$archivo_antiguo = $_SERVER["DOCUMENT_ROOT"] . "/wwwic/tutoriales/activos/" . basename($tupla["url_utilidad"]);
				if (file_exists($archivo_antiguo))
					unlink($archivo_antiguo);
				
				// Copiamos el archivo al servidor.
				copy($archivo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . "/wwwic/tutoriales/activos/" . $nombre_archivo);
				
				// Imprimimos mensajes de �xito.
				echo "<P CLASS='contenido' ALIGN='center'><B>TU TUTORIAL FUE MODIFICADO EXITOSAMENTE</B></P>";
				echo "<P CLASS='contenido'>Los datos del tutorial han sido modificados. Gracias por colaborar con nosotros.</P>";
				echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
			}
			// Cuando el archivo no se puede subir.
			else
			{
				// Imprimimos mensajes de error de envio
				echo "<P CLASS='contenido' ALIGN='center'><B>TU TUTORIAL NO PUDO MODIFICARSE EXITOSAMENTE</B></P>";
				echo "<P CLASS='contenido'>Esto se puede deber una de las siguientes razones:</P>";
				echo "<OL CLASS='contenido'>";
				echo "<LI>No hay espacio en el disco del servidor.</LI>";
				echo "<LI>El archivo no existe.</LI>";
				echo "<LI>El tama&ntilde;o del archivo es superior a 1000 KB.</LI>";
				echo "<OL>";
				echo "<P ALIGN='center'><A HREF='index.php' TITLE='Atr&aacute;s al Formulario'><IMG SRC='../../../../librerias/btatras.gif' BORDER='0'></A></P>";
			}
		}
	}
	
	/**
	 * M�todo que muestra el formulario con los datos de un tutorial, para posteriormente ser
	 * eliminado.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_utilidad El identificador de la utilidad.
	 */
	function formularioEliminar($id_persona, $id_pertenencia_utilidad, $id_utilidad)
	{
		// Consulta para obtener informaci�n del tutorial.
		$consulta = "SELECT utilidad.nombre_utilidad, apartado.nombre_apartado, idioma.nombre_idioma, formato.nombre_formato, utilidad.desc_utilidad, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, utilidad.url_utilidad FROM utilidad, formato, usuario_interno, idioma, apartado, persona WHERE utilidad.id_tipo_utilidad = 2 AND utilidad.id_pertenencia_utilidad = $id_pertenencia_utilidad AND utilidad.id_utilidad = $id_utilidad AND utilidad.id_persona = $id_persona AND utilidad.id_persona = $id_persona AND utilidad.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_apartado = apartado.id_apartado AND utilidad.id_formato = formato.id_formato";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Escribimos la tabla para incorporar el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Eliminar Tutorial</B></TD>";
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
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='50' DISABLED='true' VALUE='" . $tupla["nombre_utilidad"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Apartado:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='apartado' CLASS='formtextfield' MAXLENGTH='100' DISABLED='true' VALUE='" . $tupla["nombre_apartado"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Idioma:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='idioma' CLASS='formtextfield' MAXLENGTH='25' DISABLED='true' VALUE='" . $tupla["nombre_idioma"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Formato:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='formato' CLASS='formtextfield' MAXLENGTH='4' DISABLED='true' VALUE='" . $tupla["nombre_formato"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>URL:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='url_archivo' CLASS='formtextfield' MAXLENGTH='100' DISABLED='true' VALUE='" . $tupla["url_utilidad"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel' COLSPAN='2' ALIGN='center'>Texto:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='center'><TEXTAREA NAME='descripcion' CLASS='formtextarea' ROWS='10' DISABLED='true'>" . $tupla["desc_utilidad"] . "</TEXTAREA></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>�Confirma que deseas eliminar este software?</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='confirmar' CHECKED='true' VALUE='1' TABINDEX='1'>Si<BR><INPUT TYPE='radio' NAME='confirmar' VALUE='0' TABINDEX='1'>No</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_utilidad' VALUE='" . $id_utilidad . "'</TD>";
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
	 * M�todo que elimina un tutorial de la base de datos.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_utilidad El identificador de la utilidad.
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $confirmar Si el usuario confirma o no la eliminaci�n del tutorial.
	 */
	function eliminar($id_persona, $id_utilidad, $id_pertenencia_utilidad, $confirmar)
	{
		// Cuando el software se quiere eliminar.
		if ($confirmar == 1)
		{
			// Consulta para obtener el nombre del archivo de la utilidad.
			$consulta = "SELECT url_utilidad FROM utilidad WHERE id_utilidad = $id_utilidad AND id_persona = $id_persona AND id_pertenencia_utilidad = $id_pertenencia_utilidad";
			$resultado = mysql_query($consulta, $this->enlace);
			$tupla = mysql_fetch_array($resultado);
			mysql_free_result($resultado);
			
			// Consulta para borrar el registro en la tabla 'utilidad'.
			$consulta = "DELETE FROM utilidad WHERE id_utilidad = $id_utilidad AND id_persona = $id_persona AND id_pertenencia_utilidad = $id_pertenencia_utilidad";
			mysql_query($consulta, $this->enlace);
			
			// Borramos el archivo del servidor.
			$archivo = $_SERVER["DOCUMENT_ROOT"] . "/wwwic/tutoriales/activos/" . basename($tupla["url_utilidad"]);
			if (file_exists($archivo))
				unlink($archivo);
			
			// Imprimimos el mesaje de �xito de la operaci�n.
			echo "<P ALIGN='center' CLASS='contenido'><B>TU TUTORIAL HA SIDO ELIMINADO EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Este tutorial ha sido eliminado de la secci&oacute;n \"Nuestros Tutoriales\" de nuestro sitio Web. Gracias por colaborar con nosotros.</P>";
		}
		// Cuando el software no se quiere eliminar.
		else
		{
			echo "<P ALIGN='center' CLASS='contenido'><B>LA ELIMINACION DE TU TUTORIAL HA SIDO CANCELADA</B></P>";
			echo "<P CLASS='contenido'>Este tutorial no ha sido eliminado de la secci&oacute;n \"Nuestros Tutoriales\" de nuestro sitio Web, por lo que cualquier persona de Chile y el mundo lo puede seguir visitando. Gracias por colaborar con nosotros.</P>";
		}
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
}
?>