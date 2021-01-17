<?PHP
/**
 * software.php.
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
 * Clase que nos proporciona métodos y variables para administrar los registros de
 * software existentes en la base de datos. Esta clase extiende de la clase utilidad.
 */

// Librerías necesarias.
include("utilidad.php");

class software extends utilidad
{
	/**
	 * Método constructor que inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function software($link)
	{
		$this->enlace = $link;
		$this->caracteres = get_html_translation_table(HTML_SPECIALCHARS);
	}
	
	/**
	 * Método que muestra los sistemas operativos en los cuales hay software
	 * (Nuestros o Terceros).
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 */
	function sistemasOperativos($id_pertenencia_utilidad)
	{
		// Librerías necesarias.
		include("tiempo.php");
		
		// Consulta para obtener la cantidad de software de cierta pertenencia.
		$consulta = "SELECT COUNT(*) as num_utilidad FROM utilidad WHERE id_tipo_utilidad = 1 AND id_pertenencia_utilidad = $id_pertenencia_utilidad";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_result($resultado, 0, "num_utilidad");
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Cuando no hay software.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay software.</P>";
		
		// Cuando si hay software.
		else
		{
			// Creamos un objeto tiempo.
			$tiempo = new tiempo();
			
			// Mostramos el número total de software.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD ALIGN='right' COLSPAN='4' CLASS='contenido'>Hay un total de $total software.</TD>";
			echo "</TR>";
			
			// Consulta para obtener los sistemas operativos en los cuales existen más de un software.
			$consulta = "SELECT sistema_operativo.id_sistema_operativo, sistema_operativo.nombre_sistema_operativo, COUNT(*) AS num_utilidad FROM sistema_operativo, utilidad WHERE utilidad.id_tipo_utilidad = 1 AND utilidad.id_pertenencia_utilidad = $id_pertenencia_utilidad AND utilidad.id_sistema_operativo = sistema_operativo.id_sistema_operativo GROUP BY sistema_operativo.id_sistema_operativo ORDER BY sistema_operativo.nombre_sistema_operativo";
			$resultado = mysql_query($consulta, $this->enlace);
			$total = mysql_num_rows($resultado);
			
			// Calculamos el total de iteraciones que debemos realizar.
			if ($total > 1)
				$iteraciones = round($total / 2);
			else $iteraciones = $total;
			
			// Ciclo en donde imprimimos los sistemas operativos, con su respectiva cantidad de software.
			for ($i=0; $i<$iteraciones; $i++)
			{
				printf("<TR>");
				
				// Imprimimos la columna izquierda.
				$fecha = $this->fechaMayor(mysql_result($resultado, $i, "id_sistema_operativo"), 1, $id_pertenencia_utilidad);
				$this->seccion(1, $resultado, $i, $tiempo, $fecha);
				
				// Imprimimos la columna derecha.
				$k = $i + $iteraciones;
				if ($k < $total)
				{
					$fecha = $this->fechaMayor(mysql_result($resultado, $k, "id_sistema_operativo"), 1, $id_pertenencia_utilidad);
					$this->seccion(1, $resultado, $k, $tiempo, $fecha);
				}
				else $this->vacio();
				
				printf("</TR>");
			}
			
			// Escribimos una fila de espacio en el final y un comentario sobre las carpetas.
			echo "<TR><TD COLSPAN='4'>&nbsp;</TD></TR>";
			echo "<TR><TD COLSPAN='4' CLASS='contenido'><IMG SRC='../../librerias/icocarpetaabierta.gif'> Se han agregado uno o m&aacute;s software durante las &uacute;ltimas 24 horas.</TD></TR>";
			echo "<TR><TD COLSPAN='4' CLASS='contenido'><IMG SRC='../../librerias/icocarpetacerrada.gif'> No se han agregado software durante las &uacute;ltimas 24 horas.</TD></TR>";
			echo "<TR><TD COLSPAN='4'>&nbsp;</TD></TR>";
			echo "</TABLE>";
			
			// Liberamos memoria en el servidor.
			mysql_free_result($resultado);
		}
	}
	
	/**
	 * Método que muestra los últimos 3 software (Nuestro o De Terceros) incorporados
	 * recientemente.
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
		
		// Cuando si hay software.
		if ($total > 0)
		{
			// Contador para los software.
			$contador = 0;
			
			// Creamos un objeto tiempo.
			$tiempo = new tiempo();
			
			// Tabla para los software.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='2' ALIGN='center' BGCOLOR='F1F1F1' CLASS='contenido'><B>Ultimas incorporaciones</B></TD>";
			echo "</TR>";
			
			// Imprimimos 3 primeros software arrojados por la consulta.
			while (($tupla = mysql_fetch_array($resultado)) && ($contador < 3))
			{
				$this->item($tupla, $tiempo, true, true);
				$contador++;
			}
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
		}
		
		// Liberación de memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que genera la consulta para obtener todos los software nuestros,
	 * ordenados por fecha de recepcion.
	 *
	 * @return $consulta La consulta para obtener todos los software nuestros.
	 */
	function consultaDestacadosNuestros()
	{
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.version_utilidad, licencia.nombre_licencia, utilidad.tamanio_utilidad, utilidad.fecha_llegada, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, utilidad.desc_utilidad, sistema_operativo.nombre_sistema_operativo, sistema_operativo.src_sistema_operativo, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad ";
		$from = "FROM utilidad, formato, usuario_interno, persona, idioma, licencia, sistema_operativo ";
		$where = "WHERE utilidad.id_tipo_utilidad = 1 AND utilidad.id_pertenencia_utilidad = 1 AND utilidad.id_formato = formato.id_formato AND utilidad.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_licencia = licencia.id_licencia AND utilidad.id_sistema_operativo = sistema_operativo.id_sistema_operativo ";
		$order = "ORDER BY utilidad.fecha_llegada DESC";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where . $order;
	}
	
	/**
	 * Método que realiza la consulta para obtener todos los software de terceros,
	 * ordenados por fecha de recepcion.
	 *
	 * @return $consulta La consulta para obtener todos los software de terceros.
	 */
	function consultaDestacadosTerceros()
	{
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.version_utilidad, licencia.nombre_licencia, utilidad.tamanio_utilidad, utilidad.fecha_llegada, empresa.nombre_empresa, empresa.url_empresa, utilidad.desc_utilidad, sistema_operativo.nombre_sistema_operativo, sistema_operativo.src_sistema_operativo, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad ";
		$from = "FROM utilidad, formato, empresa, idioma, licencia, sistema_operativo ";
		$where = "WHERE utilidad.id_tipo_utilidad = 1 AND utilidad.id_pertenencia_utilidad = 2 AND utilidad.id_formato = formato.id_formato AND utilidad.id_empresa = empresa.id_empresa AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_licencia = licencia.id_licencia AND utilidad.id_sistema_operativo = sistema_operativo.id_sistema_operativo ";
		$order = "ORDER BY utilidad.fecha_llegada DESC";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where . $order;
	}
	
	/**
	 * Método que imprime un software (Nuestro o De Terceros).
	 *
	 * @param $tupla La tupla resultante de una consulta.
	 * @param $tiempo El objeto tiempo.
	 * @param $esdestacado Si se está mostrando en la sección 'destacados' o no.
	 * @param $vincular Si se desea vincular o no al software.
	 */
	function item($tupla, $tiempo, $esdestacado, $vincular)
	{
		// Imprimimos el formato, con el nombre, el vínculo al sitio de descarga y el icono
		// si es nuevo.
		printf("<TR>");
		printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>Nombre:</B></TD>", "15%");
		printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'>", "85%");
		$nombre = strtr($tupla["nombre_utilidad"], $this->caracteres);
		$version = strtr($tupla["version_utilidad"], $this->caracteres);
		if ($vincular)
			printf("<A HREF='enlazar.php?id=%d' TITLE='Acceder a %s v%s'><IMG SRC='../../librerias/%s' BORDER='0'> <B>%s v%s</B></A>", $tupla["id_utilidad"], $nombre, $version, $tupla["src_formato"], $nombre, $version);
		else printf("<IMG SRC='../../librerias/%s' BORDER='0'> <B>%s v%s</B></A>", $tupla["src_formato"], $nombre, $version);
		if ($tiempo->entreLapso($tupla["fecha_llegada"], 24))
			printf(" <IMG SRC='../../librerias/iconuevo.gif'>");
		printf("</TD>");
		printf("</TR>");
		
		// Imprimimos el sistema operativo, en caso de encontrarse en la sección destacados.
		if ($esdestacado)
		{
			printf("<TR>");
			printf("<TD CLASS='tabla' VALIGN='top'><B>Sistema:</B></TD>");
			printf("<TD CLASS='tabla' VALIGN='top'>%s <IMG SRC='../../librerias/%s'></TD>", $tupla["nombre_sistema_operativo"], $tupla["src_sistema_operativo"]);
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
		
		// Imprimimos la descripción.
		printf("<TR>");
		printf("<TD CLASS='tabla' VALIGN='TOP' COLSPAN='2'>%s</TD>", nl2br(strtr($tupla["desc_utilidad"], $this->caracteres)));
		printf("</TR>");
		
		// Imprimimos la licencia.
		printf("<TR>");
		printf("<TD CLASS='tabla' VALIGN='top'><B>Licencia:</B></TD>");
		printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $tupla["nombre_licencia"]);
		printf("</TR>");
		
		// Imprimimos el idioma y el icono del idioma.
		printf("<TR>");
		printf("<TD CLASS='tabla' VALIGN='top'><B>Idioma:</B></TD>");
		printf("<TD CLASS='tabla' VALIGN='top'>%s <IMG SRC='../../librerias/%s'></TD>", $tupla["nombre_idioma"], $tupla["src_idioma"]);
		printf("</TR>");
		
		// Calculamos la valoración de la utilidad (valoración = puntuacion/votos).
		if ($tupla["votos_utilidad"] > 0)
			$valoracion = $tupla["puntuacion_utilidad"]/$tupla["votos_utilidad"];
		else $valoracion = 0.0;
		
		// Obtenemos el número de comentarios de la utilidad.
		$num_comentarios = $this->numeroComentarios($tupla["id_utilidad"]);
		
		// Tabla para el número de comentarios, la valoración, las visitas y los íconos de
		// ver comentarios, comentar y votar.
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
	 * Método que muestra el título de la sección del apartado en software
	 * (Nuestros o Terceros).
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_sistema_operativo El identificador del sistema operativo.
	 */
	function mostrarTitulo($id_pertenencia_utilidad, $id_sistema_operativo)
	{
		// Librerías necesarias.
		include("sistemaoperativo.php");
		
		// Creamos un objeto sistema operativo y capturamos el nombre del sistema operativo.
		$sistema = new sistemaoperativo($this->enlace);
		$nombre = $sistema->nombre($id_sistema_operativo);
		
		// Dependiendo de la pertenencia de la utilidad, asignamos el título.
		switch ($id_pertenencia_utilidad)
		{
			case 1:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Software'>Software</A> / <A HREF='index.php' TITLE='Ver Nuestros'>Nuestros</A> / $nombre";
				$imagen = "activos/bgnuestros.jpg";
				break;
			}
			case 2:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Software'>Software</A> / <A HREF='index.php' TITLE='Ver de Terceros'>De Terceros</A> / $nombre";
				$imagen = "activos/bgterceros.jpg";
				break;
			}
		}
		$titulo = $nombre;
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra (en forma paginada) los software (Nuestro o Terceros) existentes
	 * en la Base de Datos.
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_sistema_operativo El identificador del sistema operativo.
	 * @param $pagina El número de la página actual dentro de la paginación total.
	 */
	function mostrar($id_pertenencia_utilidad, $id_sistema_operativo, $pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		include("tiempo.php");
		
		// Inicialización de variables.
		$vinculo = "software.php?id=" . $id_sistema_operativo . "&";
		$porpagina = 20;
		
		// Realizamos el query.
		switch ($id_pertenencia_utilidad)
		{
			case 1: $consulta = $this->consultaNuestros($id_sistema_operativo); break;
			case 2: $consulta = $this->consultaTerceros($id_sistema_operativo); break;
		}
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay software.
		if ($total == 0)
		{
			// Preguntamos por la pertenencia del software.
			switch ($id_pertenencia_utilidad)
			{
				case 1: echo "<P CLASS='contenido'>No hay software nuestros.</P>"; break;
				case 2: echo "<P CLASS='contenido'>No hay software de terceros.</P>"; break;
			}
		}
		
		// Cuando si hay software.
		else
		{
			// Creamos un objeto paginacion y un objeto tiempo.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$tiempo = new tiempo();
			
			// Abrimos la tabla para el total, la paginación y los software.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			
			// Preguntamos por la pertenencia del software para mostrar mensajes.
			switch ($id_pertenencia_utilidad)
			{
				case 1: echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total software nuestros.</TD>"; break;
				case 2: echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total software de terceros.</TD>"; break;
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
			
			// Abrimos la tabla para los software.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos los software.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				$this->item($tupla, $tiempo, false, true);
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
		$this->formularioBusqueda($id_pertenencia_utilidad, $id_sistema_operativo);
	}
	
	/**
	 * Método que realiza la consulta para obtener información de nuestros software
	 * referentes a un sistema operativo.
	 *
	 * @param $id_sistema_operativo El identificador del sistema operativo.
	 *
	 * @return $consulta La consulta generada.
	 */
	function consultaNuestros($id_sistema_operativo)
	{
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.version_utilidad, licencia.nombre_licencia, utilidad.tamanio_utilidad, utilidad.fecha_llegada, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, utilidad.desc_utilidad, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad ";
		$from = "FROM utilidad, formato, usuario_interno, persona, idioma, licencia ";
		$where = "WHERE utilidad.id_sistema_operativo = $id_sistema_operativo AND utilidad.id_tipo_utilidad = 1 AND utilidad.id_pertenencia_utilidad = 1 AND utilidad.id_formato = formato.id_formato AND utilidad.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_licencia = licencia.id_licencia ";
		$order = "ORDER BY utilidad.fecha_llegada DESC";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where . $order;
	}
	
	/**
	 * Método que rehaliza para obtener información de los software de terceros
	 * referentes a un sistema operativo.
	 *
	 * @param $id_sistema_operativo El identificador del sistema operativo.
	 *
	 * @return $consulta La consulta generada.
	 */
	function consultaTerceros($id_sistema_operativo)
	{
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.version_utilidad, licencia.nombre_licencia, utilidad.tamanio_utilidad, utilidad.fecha_llegada, empresa.nombre_empresa, empresa.url_empresa, utilidad.desc_utilidad, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad ";
		$from = "FROM utilidad, formato, empresa, idioma, licencia ";
		$where = "WHERE utilidad.id_sistema_operativo = $id_sistema_operativo AND utilidad.id_tipo_utilidad = 1 AND utilidad.id_pertenencia_utilidad = 2 AND utilidad.id_formato = formato.id_formato AND utilidad.id_empresa = empresa.id_empresa AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_licencia = licencia.id_licencia ";
		$order = "ORDER BY utilidad.fecha_llegada DESC";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where . $order;
	}
	
	/**
	 * Método que muestra el formulario de búsqueda para los software (Nuestros o Terceros).
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_sistema_operativo El identificador del sistema operativo.
	 */
	function formularioBusqueda($id_pertenencia_utilidad, $id_sistema_operativo)
	{
		switch ($id_pertenencia_utilidad)
		{
			case 1:
			{
				$titulo = "B&uacute;squeda de Nuestros Software";
				$comentario = "nuestros software";
				break;
			}
			case 2:
			{
				$titulo = "B&uacute;squeda de Software de Terceros";
				$comentario = "software de terceros";
				break;
			}
		}
		$ocultos = "<INPUT TYPE='hidden' NAME='id' VALUE='$id_sistema_operativo'>";
		require("busquedasimple.inc");
	}
	
	/**
	 * Método que muestra el título de la sección 'Búsqueda de Software'
	 * (Nuestros o De terceros).
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_sistema_operativo El identificador del sistema operativo.
	 */
	function tituloBusqueda($id_pertenencia_utilidad, $id_sistema_operativo)
	{
		// Librerías necesarias.
		include("sistemaoperativo.php");
		
		// Creamos un objeto sistema operativo y capturamos el nombre del sistema operativo.
		$sistema = new sistemaoperativo($this->enlace);
		$nombre = $sistema->nombre($id_sistema_operativo);
		
		// Dependiendo de la pertenencia de la utilidad, configuramos los mensajes.
		switch ($id_pertenencia_utilidad)
		{
			case 1:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Software'>Software</A> / <A HREF='index.php' TITLE='Ver Nuestros'>Nuestros</A> / <A HREF='software.php?id=$id_sistema_operativo&pagina=1' TITLE='Ver $nombre'>$nombre</A> / B&uacute;squeda";
				$imagen = "activos/bgnuestros.jpg";
				$titulo = "B&uacute;squeda de Nuestros Software";
				break;
			}
			case 2:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Software'>Software</A> / <A HREF='index.php' TITLE='Ver de Terceros'>De Terceros</A> / <A HREF='software.php?id=$id_sistema_operativo&pagina=1' TITLE='Ver $nombre'>$nombre</A> / B&uacute;squeda";
				$imagen = "activos/bgterceros.jpg";
				$titulo = "B&uacute;squeda de Software de Terceros";
				break;
			}
		}
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que busca los software (Nuestros o de Terceros) de cierto sistema operativo
	 * y los resultados los muestra (en forma paginada).
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_sistema_operativo El identificador del sistema operativo.
	 * @param $palabra La palabra o frase a buscar.
	 * @param $pagina El número actual de la página dentro de la paginación total.
	 */
	function buscar($id_pertenencia_utilidad, $id_sistema_operativo, $palabra, $pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		include("tiempo.php");
		
		// Inicialización de variables.
		$vinculo = "software.php?id=" . $id_sistema_operativo . "&";
		$porpagina = 20;
		
		// Realizamos la consulta.
		switch ($id_pertenencia_utilidad)
		{
			case 1: $consulta = $this->consultaBusquedaNuestros($id_sistema_operativo, $palabra); break;
			case 2: $consulta = $this->consultaBusquedaTerceros($id_sistema_operativo, $palabra); break;
		}
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay software.
		if ($total == 0)
		{
			// Preguntamos por la pertenencia del software.
			switch ($id_pertenencia_utilidad)
			{
				case 1: echo "<P CLASS='contenido'>No se encontraron software nuestros.</P>"; break;
				case 2: echo "<P CLASS='contenido'>No se encontraron software de terceros.</P>"; break;
			}
		}
		
		// Cuando si hay software.
		else
		{
			// Creamos un objeto paginacion y un objeto tiempo.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$tiempo = new tiempo();
			
			// Abrimos la tabla para el total, la paginación y los software.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			
			// Preguntamos por la pertenencia del software para mostrar mensajes.
			switch ($id_pertenencia_utilidad)
			{
				case 1: echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total software nuestros.</TD>"; break;
				case 2: echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total software de terceros.</TD>"; break;
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
			
			// Abrimos la tabla para los software.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos los software.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				$this->item($tupla, $tiempo, false, true);
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
		$this->formularioBusqueda($id_pertenencia_utilidad, $id_sistema_operativo);
	}
	
	/**
	 * Método que realiza la consulta para obtener información de un software nuestro
	 * que coinciden con la palabra enviada.
	 *
	 * @param $id_sistema_operativo El identificador del sistema operativo.
	 * @param $palabra La palabra o frase a buscar.
	 *
	 * @return $consulta La consulta generada.
	 */
	function consultaBusquedaNuestros($id_sistema_operativo, $palabra)
	{
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.version_utilidad, licencia.nombre_licencia, utilidad.tamanio_utilidad, utilidad.fecha_llegada, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, utilidad.desc_utilidad, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad ";
		$from = "FROM utilidad, formato, usuario_interno, persona, idioma, licencia ";
		$where = "WHERE utilidad.id_sistema_operativo = $id_sistema_operativo AND (utilidad.nombre_utilidad LIKE '%$palabra%' OR utilidad.desc_utilidad LIKE '%$palabra%') AND utilidad.id_tipo_utilidad = 1 AND utilidad.id_pertenencia_utilidad = 1 AND utilidad.id_formato = formato.id_formato AND utilidad.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_licencia = licencia.id_licencia ";
		$order = "ORDER BY utilidad.fecha_llegada DESC";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where;
	}
	
	/**
	 * Método que realiza la consulta para obtener información de un software de terceros
	 * que coinciden con la palabra enviada.
	 *
	 * @param $id_sistema_operativo El identificador del sistema operativo.
	 * @param $palabra La palabra o frase a buscar.
	 *
	 * @return $consulta La consulta generada.
	 */
	function consultaBusquedaTerceros($id_sistema_operativo, $palabra)
	{
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.version_utilidad, licencia.nombre_licencia, utilidad.tamanio_utilidad, utilidad.fecha_llegada, empresa.nombre_empresa, empresa.url_empresa, utilidad.desc_utilidad, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad ";
		$from = "FROM utilidad, formato, empresa, idioma, licencia ";
		$where = "WHERE utilidad.id_sistema_operativo = $id_sistema_operativo AND (utilidad.nombre_utilidad LIKE '%$palabra%' OR utilidad.desc_utilidad LIKE '%$palabra%') AND utilidad.id_tipo_utilidad = 1 AND utilidad.id_pertenencia_utilidad = 2 AND utilidad.id_formato = formato.id_formato AND utilidad.id_empresa = empresa.id_empresa AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_licencia = licencia.id_licencia ";
		$order = "ORDER BY utilidad.fecha_llegada DESC";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where;
	}
	
	/**
	 * Método que muestra el título de la sección 'Acceso al software' (Nuestros o De Terceros).
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_utilidad El identificador de la utilidad.
	 */
	function tituloAcceso($id_pertenencia_utilidad, $id_utilidad)
	{
		// Consulta para capturar la identificación y nombre del sistema operativo
		// en que estamos.
		$consulta = "SELECT sistema_operativo.id_sistema_operativo, sistema_operativo.nombre_sistema_operativo FROM utilidad, sistema_operativo WHERE id_utilidad = $id_utilidad AND utilidad.id_sistema_operativo = sistema_operativo.id_sistema_operativo";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		$id_sistema_operativo = $fila["id_sistema_operativo"];
		$nombre_sistema_operativo = $fila["nombre_sistema_operativo"];
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Dependiendo de la pertenencia de la utilidad, configuramos los mensajes.
		switch ($id_pertenencia_utilidad)
		{
			case 1:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Software'>Software</A> / <A HREF='index.php' TITLE='Ver Nuestros'>Nuestros</A> / <A HREF='software.php?id=$id_sistema_operativo&pagina=1' TITLE='Ver $nombre_sistema_operativo'>$nombre_sistema_operativo</A> / Acceso";
				$imagen = "activos/bgnuestros.jpg";
				break;
			}
			case 2:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Software'>Software</A> / <A HREF='index.php' TITLE='Ver de Terceros'>De Terceros</A> / <A HREF='software.php?id=$id_sistema_operativo&pagina=1' TITLE='Ver $nombre_sistema_operativo'>$nombre_sistema_operativo</A> / Acceso";
				$imagen = "activos/bgterceros.jpg";
				break;
			}
		}
		$titulo = "Acceso al Software";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra en forma detallada la información de un software
	 * (Nuestro o De Terceros).
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $opcion La opción que se escogió.
	 * @param $tipo_comentario El tipo de comentario correspondiente a la sección.
	 * @param $id_utilidad El identificador de la utilidad.
	 */
	function detallar($id_pertenencia_utilidad, $opcion, $tipo_comentario, $id_utilidad)
	{
		// Librerías necesarias.
		include("tiempo.php");
		
		// Realizamos la consulta.
		switch ($id_pertenencia_utilidad)
		{
			case 1: $consulta = $this->consultaDetalladaNuestro($id_utilidad); break;
			case 2: $consulta = $this->consultaDetalladaTerceros($id_utilidad); break;
		}
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Cuando no hay software.
		if (!$resultado)
		{
			// Preguntamos por la pertenencia del software.
			switch ($id_pertenencia_utilidad)
			{
				case 1: echo "<P CLASS='contenido'>No existe este software nuestro.</P>"; break;
				case 2: echo "<P CLASS='contenido'>No existe este software de terceros.</P>"; break;
			}
		}
		// Cuando si hay software.
		else
		{
			// Creamos un objeto tiempo.
			$tiempo = new tiempo();
			
			// Mostramos los detalles del software.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			if ($opcion == 1)
				$this->item($tupla, $tiempo, true, false);
			else $this->item($tupla, $tiempo, true, true);
			
			// Configuramos el comentario.
			switch ($tipo_comentario)
			{
				case 1: printf("<TR><TD CLASS='contenido' COLSPAN='2'>Si no se abre autom&aacute;ticamente, pulsa <A HREF='%s' TITLE='Acceder directamente' TARGET='_blank'>aqu&iacute;</A>.</TD></TR>", strtr($tupla["url_utilidad"], $this->caracteres)); break;
				case 2: printf("<TR><TD CLASS='contenido' COLSPAN='2'>Haz tus comentarios u opiniones sobre este software.</TD></TR>"); break;
				case 3: printf("<TR><TD CLASS='contenido' COLSPAN='2'>Estos son los comentarios que han efectuado los usuarios a este software.</TD></TR>"); break;
				case 4: printf("<TR><TD CLASS='contenido' COLSPAN='2'>Haz tu votaci&oacute;n sobre este software.</TD></TR>"); break;
			}
			
			// Imprimimos el botón 'volver'.
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
	 * Método que realiza la consulta para obtener información de un software nuestro.
	 *
	 * @param $id_utilidad El identificador de la utilidad.
	 *
	 * @return $consulta La consutla generada.
	 */
	function consultaDetalladaNuestro($id_utilidad)
	{
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.version_utilidad, licencia.nombre_licencia, utilidad.tamanio_utilidad, utilidad.fecha_llegada, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, utilidad.desc_utilidad, sistema_operativo.nombre_sistema_operativo, sistema_operativo.src_sistema_operativo, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad, utilidad.url_utilidad ";
		$from = "FROM utilidad, formato, usuario_interno, persona, idioma, licencia, sistema_operativo ";
		$where = "WHERE utilidad.id_utilidad = $id_utilidad AND utilidad.id_tipo_utilidad = 1 AND utilidad.id_pertenencia_utilidad = 1 AND utilidad.id_formato = formato.id_formato AND utilidad.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_licencia = licencia.id_licencia AND utilidad.id_sistema_operativo = sistema_operativo.id_sistema_operativo ";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where;
	}
	
	/**
	 * Método que realiza para obtener información de un software de terceros.
	 *
	 * @param $id_utilidad El identificador de la utilidad.
	 *
	 * @return $consulta La consutla generada.
	 */
	function consultaDetalladaTerceros($id_utilidad)
	{
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.version_utilidad, licencia.nombre_licencia, utilidad.tamanio_utilidad, utilidad.fecha_llegada, empresa.nombre_empresa, empresa.url_empresa, utilidad.desc_utilidad, sistema_operativo.nombre_sistema_operativo, sistema_operativo.src_sistema_operativo, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad, utilidad.url_utilidad ";
		$from = "FROM utilidad, formato, empresa, idioma, licencia, sistema_operativo ";
		$where = "WHERE utilidad.id_utilidad = $id_utilidad AND utilidad.id_tipo_utilidad = 1 AND utilidad.id_pertenencia_utilidad = 2 AND utilidad.id_formato = formato.id_formato AND utilidad.id_empresa = empresa.id_empresa AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_licencia = licencia.id_licencia AND utilidad.id_sistema_operativo = sistema_operativo.id_sistema_operativo ";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where;
	}
	
	/**
	 * Método que muestra el título de la sección comentar el software (Nuestro o Terceros).
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_utilidad El identificador de la utilidad.
	 */
	function tituloComentar($id_pertenencia_utilidad, $id_utilidad)
	{
		// Consulta para capturar el nombre del sistema operativo en que estamos.
		$consulta = "SELECT sistema_operativo.id_sistema_operativo, sistema_operativo.nombre_sistema_operativo FROM utilidad, sistema_operativo WHERE id_utilidad = $id_utilidad AND utilidad.id_sistema_operativo = sistema_operativo.id_sistema_operativo";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		$id_sistema_operativo = $fila["id_sistema_operativo"];
		$nombre_sistema_operativo = $fila["nombre_sistema_operativo"];
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Dependiendo de la pertenencia de la utilidad configuramos los mensajes.
		switch ($id_pertenencia_utilidad)
		{
			case 1:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Software'>Software</A> / <A HREF='index.php' TITLE='Ver Nuestros'>Nuestros</A> / <A HREF='software.php?id=$id_sistema_operativo&pagina=1' TITLE='Ver $nombre_sistema_operativo'>$nombre_sistema_operativo</A> / Comentar";
				$imagen = "activos/bgnuestros.jpg";
				break;
			}
			case 2:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Software'>Software</A> / <A HREF='index.php' TITLE='Ver de Terceros'>De Terceros</A> / <A HREF='software.php?id=$id_sistema_operativo&pagina=1' TITLE='Ver $nombre_sistema_operativo'>$nombre_sistema_operativo</A> / Comentar";
				$imagen = "activos/bgterceros.jpg";
				break;
			}
		}
		$titulo = "Comentar el Software";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra el título de la sección 'Ver comentarios' del software.
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_utilidad El identificador de la utilidad.
	 */
	function tituloComentarios($id_pertenencia_utilidad, $id_utilidad)
	{
		// Consulta para capturar el nombre del sistema operativo en que estamos.
		$consulta = "SELECT sistema_operativo.id_sistema_operativo, sistema_operativo.nombre_sistema_operativo FROM utilidad, sistema_operativo WHERE id_utilidad = $id_utilidad AND utilidad.id_sistema_operativo = sistema_operativo.id_sistema_operativo";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		$id_sistema_operativo = $fila["id_sistema_operativo"];
		$nombre_sistema_operativo = $fila["nombre_sistema_operativo"];
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Dependiendo de la pertenencia de la utilidad, configuramos el título.
		switch ($id_pertenencia_utilidad)
		{
			case 1:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Software'>Software</A> / <A HREF='index.php' TITLE='Ver Nuestros'>Nuestros</A> / <A HREF='software.php?id=$id_sistema_operativo&pagina=1' TITLE='Ver $nombre_sistema_operativo'>$nombre_sistema_operativo</A> / Comentarios";
				$imagen = "activos/bgnuestros.jpg";
				break;
			}
			case 2:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Software'>Software</A> / <A HREF='index.php' TITLE='Ver de Terceros'>De Terceros</A> / <A HREF='software.php?id=$id_sistema_operativo&pagina=1' TITLE='Ver $nombre_sistema_operativo'>$nombre_sistema_operativo</A> / Comentarios";
				$imagen = "activos/bgterceros.jpg";
				break;
			}
		}
		$titulo = "Comentarios del Software";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra el título de la sección 'Votación' por un software.
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_utilidad El identificador de la utilidad.
	 */
	function tituloVotar($id_pertenencia_utilidad, $id_utilidad)
	{
		// Consulta para capturar el nombre del sistema operativo en que estamos.
		$consulta = "SELECT sistema_operativo.id_sistema_operativo, sistema_operativo.nombre_sistema_operativo FROM utilidad, sistema_operativo WHERE id_utilidad = $id_utilidad AND utilidad.id_sistema_operativo = sistema_operativo.id_sistema_operativo";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		$id_sistema_operativo = $fila["id_sistema_operativo"];
		$nombre_sistema_operativo = $fila["nombre_sistema_operativo"];
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Dependiendo de la pertenencia de la utilidad, configuramos el título.
		switch ($id_pertenencia_utilidad)
		{
			case 1:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Software'>Software</A> / <A HREF='index.php' TITLE='Ver Nuestros'>Nuestros</A> / <A HREF='software.php?id=$id_sistema_operativo&pagina=1' TITLE='Ver $nombre_sistema_operativo'>$nombre_sistema_operativo</A> / Votaci&oacute;n";
				$imagen = "activos/bgnuestros.jpg";
				break;
			}
			case 2:
			{
				$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Software'>Software</A> / <A HREF='index.php' TITLE='Ver de Terceros'>De Terceros</A> / <A HREF='software.php?id=$id_sistema_operativo&pagina=1' TITLE='Ver $nombre_sistema_operativo'>$nombre_sistema_operativo</A> / Votaci&oacute;n";
				$imagen = "activos/bgterceros.jpg";
				break;
			}
		}
		$titulo = "Votaci&oacute;n del Software";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra las estadísticas (más visitados, más comentados o más votados)
	 * de los software.
	 *
	 * @param $tipo El tipo de estadística a mostrar.
	 * @param $tiempo El objeto tiempo ya inicializado.
	 */
	function estadisticas($tipo, $tiempo)
	{
		// Vemos el tipo de estadística.
		switch ($tipo)
		{
			case 1: $consulta = $this->consultaVisitados(); break;
			case 2: $consulta = $this->consultaComentados(); break;
			case 3: $consulta = $this->consultaVotados(); break;
		}
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Contador para los software.
		$contador = 0;
		
		// Tabla para los software.
		echo "<TABLE WIDTH='100%' BORDER='0'>";
		echo "<TR>";
		
		// Vemos el tipo de estadística.
		switch ($tipo)
		{
			case 1: echo "<TD COLSPAN='2' ALIGN='center' BGCOLOR='F1F1F1' CLASS='contenido'><B>Los software m&aacute;s visitados</B></TD>"; break;
			case 2: echo "<TD COLSPAN='2' ALIGN='center' BGCOLOR='F1F1F1' CLASS='contenido'><B>Los software m&aacute;s comentados</B></TD>"; break;
			case 3: echo "<TD COLSPAN='2' ALIGN='center' BGCOLOR='F1F1F1' CLASS='contenido'><B>Los software m&aacute;s votados</B></TD>"; break;
		}
		echo "</TR>";
		echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
		
		// Cuando no hay software.
		if ($total == 0)
		{
			// Vemos el tipo de estadística.
			switch ($tipo)
			{
				case 1: echo "<TR><TD COLSPAN='2' CLASS='contenido'>No hay software visitados.</TD></TR><TR><TD COLSPAN='2'>&nbsp;</TD></TR>"; break;
				case 2: echo "<TR><TD COLSPAN='2' CLASS='contenido'>No hay software comentados.</TD></TR><TR><TD COLSPAN='2'>&nbsp;</TD></TR>"; break;
				case 3: echo "<TR><TD COLSPAN='2' CLASS='contenido'>No hay software votados.</TD></TR><TR><TD COLSPAN='2'>&nbsp;</TD></TR>"; break;
			}
		}
		// Cuando si hay software.
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
		
		// Liberación de memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que retorna el string con la consulta que obtiene todos los software
	 * ordenados por número de visitas.
	 *
	 * @return $consulta La consulta generada.
	 */
	function consultaVisitados()
	{
		// Consulta para obtener todos los software, ordenados por número de visitas.
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.version_utilidad, licencia.nombre_licencia, utilidad.tamanio_utilidad, utilidad.fecha_llegada, utilidad.desc_utilidad, sistema_operativo.nombre_sistema_operativo, sistema_operativo.src_sistema_operativo, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad ";
		$from = "FROM utilidad, formato, idioma, licencia, sistema_operativo ";
		$where = "WHERE utilidad.id_tipo_utilidad = 1 AND utilidad.visitas_utilidad > 0 AND utilidad.id_formato = formato.id_formato AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_licencia = licencia.id_licencia AND utilidad.id_sistema_operativo = sistema_operativo.id_sistema_operativo ";
		$order = "ORDER BY visitas_utilidad DESC, utilidad.nombre_utilidad";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where . $order;
	}
	
	/**
	 * Método que retorna el string con la consulta de los software ordenados por
	 * número de comentarios.
	 *
	 * @return $consulta La consulta generada.
	 */
	function consultaComentados()
	{
		// Consulta para obtener todos los software, ordenados por número de comentarios.
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.version_utilidad, licencia.nombre_licencia, utilidad.tamanio_utilidad, utilidad.fecha_llegada, utilidad.desc_utilidad, sistema_operativo.nombre_sistema_operativo, sistema_operativo.src_sistema_operativo, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad, COUNT(*) AS num_comentarios ";
		$from = "FROM utilidad, formato, idioma, licencia, sistema_operativo, comentario ";
		$where = "WHERE utilidad.id_tipo_utilidad = 1 AND utilidad.id_formato = formato.id_formato AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_licencia = licencia.id_licencia AND utilidad.id_sistema_operativo = sistema_operativo.id_sistema_operativo AND utilidad.id_utilidad = comentario.id_utilidad ";
		$group = "GROUP BY utilidad.id_utilidad ";
		$order = "ORDER BY num_comentarios DESC, utilidad.nombre_utilidad";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where . $group . $order;
	}
	
	/**
	 * Método que retorna el string con la consulta de los software ordenados por
	 * número de votos.
	 *
	 * @return $consulta La consulta generada.
	 */
	function consultaVotados()
	{
		// Consulta para obtener todos los software, ordenados por número de votos.
		$select = "SELECT utilidad.id_utilidad, formato.src_formato, utilidad.nombre_utilidad, utilidad.version_utilidad, licencia.nombre_licencia, utilidad.tamanio_utilidad, utilidad.fecha_llegada, utilidad.desc_utilidad, sistema_operativo.nombre_sistema_operativo, sistema_operativo.src_sistema_operativo, idioma.nombre_idioma, idioma.src_idioma, utilidad.votos_utilidad, utilidad.puntuacion_utilidad, utilidad.visitas_utilidad, utilidad.id_pertenencia_utilidad ";
		$from = "FROM utilidad, formato, idioma, licencia, sistema_operativo ";
		$where = "WHERE utilidad.id_tipo_utilidad = 1 AND utilidad.votos_utilidad > 0 AND utilidad.id_formato = formato.id_formato AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_licencia = licencia.id_licencia AND utilidad.id_sistema_operativo = sistema_operativo.id_sistema_operativo ";
		$order = "ORDER BY votos_utilidad DESC, utilidad.nombre_utilidad";
		
		// Concadenamos la consulta y la retornamos.
		return $select . $from . $where . $order;
	}
	
	/**
	 * Método que imprime un software destacado en las estadisticas.
	 *
	 * @param $tupla La tupla resultante de una consulta.
	 * @param $tiempo El objeto tiempo.
	 */
	function itemEstadistica($tupla, $tiempo)
	{
		// Imprimimos el formato, con el título, el vínculo al sitio de descarga y
		// el icono si es nuevo.
		printf("<TR>");
		printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>Nombre:</B></TD>", "15%");
		printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'>", "85%");
		switch ($tupla["id_pertenencia_utilidad"])
		{
			case 1: $ruta = "../nuestros/"; break;
			case 2: $ruta = "../terceros/"; break;
		}
		$nombre = strtr($tupla["nombre_utilidad"], $this->caracteres);
		$version = strtr($tupla["version_utilidad"], $this->caracteres);
		printf("<A HREF='%senlazar.php?id=%d' TITLE='Acceder a %s v%s'><IMG SRC='../../librerias/%s' BORDER='0'> <B>%s v%s</B></A>", $ruta, $tupla["id_utilidad"], $nombre, $version, $tupla["src_formato"], $nombre, $version);
		if ($tiempo->entreLapso($tupla["fecha_llegada"], 24))
			printf(" <IMG SRC='../../librerias/iconuevo.gif'>");
		printf("</TD>");
		printf("</TR>");
		
		// Imprimimos el sistema operativo.
		printf("<TR>");
		printf("<TD CLASS='tabla' VALIGN='top'><B>Sistema:</B></TD>");
		printf("<TD CLASS='tabla' VALIGN='top'>%s <IMG SRC='../../librerias/%s'></TD>", $tupla["nombre_sistema_operativo"], $tupla["src_sistema_operativo"]);
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
		
		// Imprimimos la descripción.
		printf("<TR>");
		printf("<TD CLASS='tabla' VALIGN='TOP' COLSPAN='2'>%s</TD>", nl2br(strtr($tupla["desc_utilidad"], $this->caracteres)));
		printf("</TR>");
		
		// Imprimimos la licencia.
		printf("<TR>");
		printf("<TD CLASS='tabla' VALIGN='top'><B>Licencia:</B></TD>");
		printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $tupla["nombre_licencia"]);
		printf("</TR>");
		
		// Imprimimos el idioma y el icono del idioma.
		printf("<TR>");
		printf("<TD CLASS='tabla' VALIGN='top'><B>Idioma:</B></TD>");
		printf("<TD CLASS='tabla' VALIGN='top'>%s <IMG SRC='../../librerias/%s'></TD>", $tupla["nombre_idioma"], $tupla["src_idioma"]);
		printf("</TR>");
		
		// Calculamos la valoración de la utilidad (valoración = puntuacion/votos).
		if ($tupla["votos_utilidad"] > 0)
			$valoracion = $tupla["puntuacion_utilidad"]/$tupla["votos_utilidad"];
		else $valoracion = 0.0;
		
		// Obtenemos el número de comentarios de la utilidad.
		$num_comentarios = $this->numeroComentarios($tupla["id_utilidad"]);
		
		// Tabla para el número de comentarios, la valoración, las visitas y los
		// iconos de ver comentarios, comentar y votar.
		printf("<TR>");
		printf("<TD COLSPAN='2'>");
		printf("<TABLE WIDTH='%s' BORDER='0' CELLPADDING='0' CELLSPACING='0'>", "100%");
		printf("<TR>");
		printf("<TD BGCOLOR='#FFFFFF' CLASS='tabla' VALIGN='top' WIDTH='%s'>Comentarios: %d - Valoración: ", "70%", $num_comentarios);
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
	 * Método que construye el formulario para ingresar a un nuevo software a la base de datos.
	 *
	 * @param $id_persona El identificador de la persona.
	 */
	function formularioAgregar($id_persona)
	{
		// Librerías necesarias.
		include("sistemaoperativo.php");
		include("licencia.php");
		include("idioma.php");
		include("formato.php");
		
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Escribimos la tabla para el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Agregar Software</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>Nombre:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='nombre' CLASS='formtextfield' MAXLENGTH='50' TABINDEX='1' TITLE='Nombre del software'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>Versi&oacute;n:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='version' CLASS='formtextfield' MAXLENGTH='10' TABINDEX='1' TITLE='N&uacute;mero de versi&oacute;n del software'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Sistema Operativo:</TD>";
		echo "<TD>";
		$sistema_operativo = new sistemaoperativo($this->enlace);
		$sistema_operativo->select(4);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Licencia:</TD>";
		echo "<TD>";
		$licencia = new licencia($this->enlace);
		$licencia->select(1);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
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
		echo "<TD COLSPAN='2' CLASS='formlabel'>URL: <INPUT TYPE='text' NAME='url_archivo' CLASS='formtextfield' MAXLENGTH='100' VALUE='http://' TABINDEX='1' TITLE='URL donde se encuentra el archivo (Incluir el protocolo http:// ó ftp://)'></TD>";
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
		echo "<TD COLSPAN='2' ALIGN='center'><TEXTAREA NAME='descripcion' CLASS='formtextarea' ROWS='10' TABINDEX='1' TITLE='Descripci&oacute;n del software'></TEXTAREA> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
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
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='agregar' VALUE='Agregar' CLASS='formbutton' TABINDEX='1' TITLE='Agregar el software'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * Método que agrega un nuevo software a la base de datos.
	 *
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $id_sistema_operativo El identificador del sistema operativo.
	 * @param $id_idioma El identificador del idioma.
	 * @param $id_formato El identificador del formato.
	 * @param $id_licencia El identificador de la licencia.
	 * @param $id_persona El identificador de la persona.
	 * @param $nombre El nombre del software.
	 * @param $version La versión del software.
	 * @param $esta_subido Si el archivo está subido a Internet o no.
	 * @param $archivo El archivo a subir.
	 */
	function agregar($id_pertenencia_utilidad, $id_sistema_operativo, $id_idioma, $id_formato, $id_licencia, $id_persona, $nombre, $descripcion, $version, $esta_subido, $archivo)
	{
		// Obtener la hora actual.
		$fecha = date("Y-m-d");
		
		// Cuando el archivo ya está subido a la Internet.
		if ($esta_subido)
		{
			// Consulta para insertar el registro de un software en la tabla 'utilidad'.
			$consulta = "INSERT INTO utilidad(id_pertenencia_utilidad, id_sistema_operativo, id_idioma, id_formato, id_licencia, id_tipo_utilidad, id_persona, nombre_utilidad, desc_utilidad, version_utilidad, url_utilidad, visitas_utilidad, votos_utilidad, puntuacion_utilidad, fecha_llegada) VALUES($id_pertenencia_utilidad, $id_sistema_operativo, $id_idioma, $id_formato, $id_licencia, 1, $id_persona, '$nombre', '$descripcion', '$version', '$archivo', 0, 0, 0, '$fecha')";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos mensajes de éxito de la operación
			echo "<P CLASS='contenido' ALIGN='center'><B>TU SOFTWARE FUE AGREGADO EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Este programa ser&aacute; publicado en la secci&oacute;n \"Nuestros Software\" dentro de este sitio Web. Gracias por colaborar con nosotros.</P>";
			echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
		}
		// Cuando el archivo no está subido a la Internet.
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
				$id_utilidad = $fila["mayor"] + 1;
				$nombre_archivo = $id_utilidad . substr($archivo['name'], strpos($archivo['name'], "."));
				$url_utilidad = "http://" . $_SERVER["SERVER_NAME"] . "/software/activos/" . $nombre_archivo;
				
				// Transformamos de kb a KB.
				$tamanio_utilidad = $archivo['size'] / 8;
				
				// Consulta para insertar el registro de un software en la tabla 'utilidad'.
				$consulta = "INSERT INTO utilidad(id_utilidad, id_pertenencia_utilidad, id_sistema_operativo, id_idioma, id_formato, id_licencia, id_tipo_utilidad, id_persona, nombre_utilidad, desc_utilidad, version_utilidad, url_utilidad, tamanio_utilidad, visitas_utilidad, votos_utilidad, puntuacion_utilidad, fecha_llegada) VALUES ($id_utilidad, $id_pertenencia_utilidad, $id_sistema_operativo, $id_idioma, $id_formato, $id_licencia, 1, $id_persona, '$nombre', '$descripcion', '$version', '$url_utilidad', $tamanio_utilidad, 0, 0, 0, '$fecha')";
				mysql_query($consulta, $this->enlace);
				
				// Copiamos el archivo al servidor
				copy($archivo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . "/wwwic/software/activos/" . $nombre_archivo);
				
				// Imprimimos mensajes de éxito.
				echo "<P CLASS='contenido' ALIGN='center'><B>TU SOFTWARE FUE AGREGADO EXITOSAMENTE</B></P>";
				echo "<P CLASS='contenido'>Este programa ser&aacute; publicado en la secci&oacute;n \"Nuestros Software\" dentro de este sitio Web. Gracias por colaborar con nosotros.</P>";
				echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
			}
			// Cuando el archivo no se puede subir.
			else
			{
				// Imprimimos mensajes de error de envio.
				echo "<P CLASS='contenido' ALIGN='center'><B>TU SOFTWARE NO PUDO AGREGARSE EXITOSAMENTE</B></P>";
				echo "<P CLASS='contenido'>Esto se puede deber una de las siguientes razones:</P>";
				echo "<OL CLASS='contenido'>";
				echo "<LI>No hay espacio en el disco del servidor.</LI>";
				echo "<LI>El archivo no existe.</LI>";
				echo "<LI>El tama&ntilde;o del archivo es superior a 1000 KB.</LI>";
				echo "<OL>";
				echo "<P CLASS='contenido'>Por favor vuelve a ingresar tus datos y cambia el archivo que ingresaste anteriormente.</P>";
				echo "<P ALIGN='center'><A HREF='index.php' TITLE='Atr&aacute;s al Formulario'><IMG SRC='../../../../librerias/btatras.gif' BORDER='0'></A></P>";
			}
		}
	}
	
	/**
	 * Método que lista todos los software nuestros realizados por un usuario.
	 *
	 * $@param $id_persona El identificador de la persona.
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 * @param $vinculo La página destino.
	 */
	function listar($id_persona, $vinculo)
	{
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE persona.id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$usuario = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
		mysql_free_result($resultado);
		
		// Consulta para obtener los software enviados por la persona.
		$consulta = "SELECT utilidad.id_utilidad, utilidad.nombre_utilidad, formato.nombre_formato, utilidad.version_utilidad, licencia.nombre_licencia, sistema_operativo.nombre_sistema_operativo, idioma.nombre_idioma FROM utilidad, formato, usuario_interno, idioma, licencia, sistema_operativo WHERE utilidad.id_tipo_utilidad = 1 AND utilidad.id_pertenencia_utilidad = 1 AND utilidad.id_formato = formato.id_formato AND utilidad.id_persona = $id_persona AND utilidad.id_persona = usuario_interno.id_persona AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_licencia = licencia.id_licencia AND utilidad.id_sistema_operativo = sistema_operativo.id_sistema_operativo ORDER BY utilidad.fecha_llegada";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay software.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay software realizados por $usuario.</P>";
		
		// Listamos todas los software para este usuario.
		else
		{
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='6' CLASS='contenido'>Hay un total de $total software relizados por $usuario:</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'>&nbsp;</TD>";
			echo "<TD WIDTH='40%' ALIGN='center' CLASS='titulotabla'><B>Nombre</B></TD>";
			echo "<TD WIDTH='20%' ALIGN='center' CLASS='titulotabla'><B>Sistema</B></TD>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'><B>Licencia</B></TD>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'><B>Idioma</B></TD>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'><B>Formato</B></TD>";
			echo "</TR>";
			
			// Texto para enlazar a la operación.
			if ($vinculo == "modificar.php")
				$texto_vinculo = "Modificar";
			else $texto_vinculo = "Eliminar";
			
			// Imprimimos la lista de ofertas de servicios.
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				printf("<TD ALIGN='center' CLASS='tabla'><A HREF='$vinculo?id=%s' TITLE='%s Software'>%s</A></TD>", $tupla["id_utilidad"], $texto_vinculo, $texto_vinculo);
				printf("<TD CLASS='tabla'>%s v.%s</TD>", $tupla["nombre_utilidad"], $tupla["version_utilidad"]);
				printf("<TD ALIGN='center' CLASS='tabla'>%s</TD>", $tupla["nombre_sistema_operativo"]);
				printf("<TD ALIGN='center' CLASS='tabla'>%s</TD>", $tupla["nombre_licencia"]);
				printf("<TD ALIGN='center' CLASS='tabla'>%s</TD>", $tupla["nombre_idioma"]);
				printf("<TD ALIGN='center' CLASS='tabla'>%s</TD>", $tupla["nombre_formato"]);
				printf("</TR>");
			}
			echo "</TABLE>";
		}
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que muestra el formulario de modificación de un software.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_utilidad El identificador de la utilidad.
	 */
	function formularioModificar($id_persona, $id_utilidad)
	{
		// Librerías necesarias.
		include("sistemaoperativo.php");
		include("licencia.php");
		include("idioma.php");
		include("formato.php");
		
		// Consulta para obtener la información del software.
		$consulta = "SELECT utilidad.nombre_utilidad, utilidad.version_utilidad, licencia.id_licencia, sistema_operativo.id_sistema_operativo, idioma.id_idioma, formato.id_formato, utilidad.desc_utilidad, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, utilidad.url_utilidad FROM utilidad, formato, usuario_interno, idioma, licencia, sistema_operativo, persona WHERE utilidad.id_tipo_utilidad = 1 AND utilidad.id_utilidad = $id_utilidad AND utilidad.id_persona = $id_persona AND utilidad.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_licencia = licencia.id_licencia AND utilidad.id_sistema_operativo = sistema_operativo.id_sistema_operativo AND utilidad.id_formato = formato.id_formato";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Escribimos la tabla donde se incorpora el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Modificar Software</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>Nombre:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='nombre' CLASS='formtextfield' MAXLENGTH='50' TABINDEX='1' VALUE='" . $tupla["nombre_utilidad"] . "' TITLE='Nombre del software'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>Versi&oacute;n:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='version' CLASS='formtextfield' MAXLENGTH='10' TABINDEX='1' VALUE='" . $tupla["version_utilidad"] . "' TITLE='N&uacute;mero de versi&oacute;n del software'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Sistema Operativo:</TD>";
		echo "<TD>";
		$sistema_operativo = new sistemaoperativo($this->enlace);
		$sistema_operativo->select($tupla["id_sistema_operativo"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Licencia:</TD>";
		echo "<TD>";
		$licencia = new licencia($this->enlace);
		$licencia->select($tupla["id_licencia"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
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
		echo "<TD COLSPAN='2' CLASS='formlabel'>URL: <INPUT TYPE='text' NAME='url_archivo' CLASS='formtextfield' MAXLENGTH='100' VALUE='" . $tupla["url_utilidad"] . "' TABINDEX='1' TITLE='URL donde se encuentra el archivo (Incluir el protocolo http:// ó ftp://)'></TD>";
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
		echo "<TD COLSPAN='2' ALIGN='center'><TEXTAREA NAME='descripcion' CLASS='formtextarea' ROWS='10' TABINDEX='1' TITLE='Descripci&oacute;n del software'>" . $tupla["desc_utilidad"] . "</TEXTAREA> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
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
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar el software'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * Método que modifica los datos de un software.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_utilidad El identificador de la utilidad.
	 * @param $id_sistema_operativo El identificador del sistema operativo.
	 * @param $id_idioma El identificador del idioma.
	 * @param $id_formato El identificador del formato.
	 * @param $id_licencia El identificador de la licencia.
	 * @param $nombre El nombre del software.
	 * @param $version La versión del software.
	 * @param $esta_subido Si el archivo está subido a Internet o no.
	 * @param $archivo El archivo a subir.
	 */
	function modificar($id_persona, $id_utilidad, $nombre, $version, $id_sistema_operativo, $id_licencia, $id_idioma, $id_formato, $id_licencia, $esta_subido, $archivo, $descripcion)
	{
		// Cuando el archivo ya está subido a la Internet.
		if ($esta_subido)
		{
			// Consulta para actualizar el registro de un software en la tabla 'utilidad'.
			$consulta = "UPDATE utilidad SET id_sistema_operativo = $id_sistema_operativo, id_idioma = $id_idioma, id_formato = $id_formato, id_licencia = $id_licencia, nombre_utilidad = '$nombre', desc_utilidad = '$descripcion', version_utilidad = '$version', url_utilidad = '$archivo' WHERE id_utilidad = $id_utilidad AND id_persona = $id_persona";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos mensajes de éxito de la operación.
			echo "<P CLASS='contenido' ALIGN='center'><B>TU SOFTWARE FUE MODIFICADO EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Los datos del software han sido modificados. Gracias por colaborar con nosotros.</P>";
			echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
		}
		// Cuando el archivo no está subido a la Internet.
		else
		{
			// Cuando hay espacio en disco, el archivo existe y el archivo es menor o igual a 1MB.
			if ($archivo['size'] <= diskfreespace("/") && 0 < $archivo['size'] && $archivo['size'] <= 1000000)
			{
				// Consulta para obtener el nombre del archivo antiguo (que ya está en el servidor).
				$consulta = "SELECT url_utilidad FROM utilidad WHERE id_utilidad = $id_utilidad";
				$resultado = mysql_query($consulta, $this->enlace);
				$tupla = mysql_fetch_array($resultado);
				mysql_free_result($resultado);
				
				// Asignamos el nombre el archivo que vamos a subir.
				$nombre_archivo = $id_utilidad . substr($archivo['name'], strpos($archivo['name'], "."));
				$url_utilidad = "http://" . $_SERVER["SERVER_NAME"] . "/software/activos/" . $nombre_archivo;
				
				// Transformamos de kb a KB.
				$tamanio_utilidad = $archivo['size'] / 8;
				
				// Consulta para actualizar el registro de un software en la tabla 'utilidad'.
				$consulta = "UPDATE utilidad SET id_sistema_operativo = $id_sistema_operativo, id_idioma = $id_idioma, id_formato = $id_formato, id_licencia = $id_licencia, nombre_utilidad = '$nombre', desc_utilidad = '$descripcion', version_utilidad = '$version', url_utilidad = '$url_utilidad', tamanio_utilidad = $tamanio_utilidad WHERE id_utilidad = $id_utilidad AND id_persona = $id_persona";
				mysql_query($consulta, $this->enlace);
				
				// Borramos el archivo antiguo del servidor.
				$archivo_antiguo = $_SERVER["DOCUMENT_ROOT"] . "/wwwic/software/activos/" . basename($tupla["url_utilidad"]);
				if (file_exists($archivo_antiguo))
					unlink($archivo_antiguo);
				
				// Copiamos el nuevo archivo al servidor.
				copy($archivo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . "/wwwic/software/activos/" . $nombre_archivo);
				
				// Imprimimos mensajes de éxito de la operación.
				echo "<P CLASS='contenido' ALIGN='center'><B>TU SOFTWARE FUE MODIFICADO EXITOSAMENTE</B></P>";
				echo "<P CLASS='contenido'>Los datos del software han sido modificados. Gracias por colaborar con nosotros.</P>";
				echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
			}
			// Cuando el archivo no se puede subir.
			else
			{
				// Imprimimos mensajes de error de envio.
				echo "<P CLASS='contenido' ALIGN='center'><B>TU SOFTWARE NO PUDO MODIFICARSE EXITOSAMENTE</B></P>";
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
	 * Método que muestra el formulario con los datos de un software, para posteriormente
	 * ser eliminado.
	 *
	 * @param $id_persona El identificdor de la persona.
	 * @param $id_utilidad El identificador de la utilidad.
	 */
	function formularioEliminar($id_persona, $id_utilidad)
	{
		// Consulta para obtener los software agregados por el usuario.
		$consulta = "SELECT utilidad.nombre_utilidad, utilidad.version_utilidad, licencia.nombre_licencia, sistema_operativo.nombre_sistema_operativo, idioma.nombre_idioma, formato.nombre_formato, utilidad.desc_utilidad, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, utilidad.url_utilidad FROM utilidad, formato, usuario_interno, idioma, licencia, sistema_operativo, persona WHERE utilidad.id_tipo_utilidad = 1 AND utilidad.id_utilidad = $id_utilidad AND utilidad.id_persona = $id_persona AND utilidad.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona AND utilidad.id_idioma = idioma.id_idioma AND utilidad.id_licencia = licencia.id_licencia AND utilidad.id_sistema_operativo = sistema_operativo.id_sistema_operativo AND utilidad.id_formato = formato.id_formato";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Escribimos la tabla en donde se adjunta el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Eliminar Software</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>Nombre:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='nombre' CLASS='formtextfield' MAXLENGTH='50' DISABLED='true' VALUE='" . $tupla["nombre_utilidad"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Versi&oacute;n:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='version' CLASS='formtextfield' MAXLENGTH='10' DISABLED='true' VALUE='" . $tupla["version_utilidad"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Sistema Operativo:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='sistema_operativo' CLASS='formtextfield' MAXLENGTH='20' DISABLED='true' VALUE='" . $tupla["nombre_sistema_operativo"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Autor:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='90' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Licencia:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='licencia' CLASS='formtextfield' MAXLENGTH='10' DISABLED='true' VALUE='" . $tupla["nombre_licencia"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Idioma:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='idioma' CLASS='formtextfield' MAXLENGTH='10' DISABLED='true' VALUE='" . $tupla["nombre_idioma"] . "'></TD>";
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
		echo "<TD COLSPAN='2' CLASS='formlabel'>¿Confirma que deseas eliminar este software?</TD>";
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
	 * Método que elimina un software de la base de datos.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_utilidad El identificador de la utilidad.
	 * @param $confirmar Si el usuario confirma eliminar o no el software.
	 */
	function eliminar($id_persona, $id_utilidad, $confirmar)
	{
		// Cuando el software se quiere eliminar.
		if ($confirmar == 1)
		{
			// Consulta para obtener el nombre del archivo de la utilidad.
			$consulta = "SELECT url_utilidad FROM utilidad WHERE id_utilidad = $id_utilidad AND id_persona = $id_persona";
			$resultado = mysql_query($consulta, $this->enlace);
			$tupla = mysql_fetch_array($resultado);
			mysql_free_result($resultado);
			
			// Consulta para borrar el registro en la tabla 'utilidad'.
			$consulta = "DELETE FROM utilidad WHERE id_utilidad = $id_utilidad AND id_persona = $id_persona";
			mysql_query($consulta, $this->enlace);
			
			// Borramos el archivo del servidor.
			$archivo = $_SERVER["DOCUMENT_ROOT"] . "/wwwic/software/activos/" . basename($tupla["url_utilidad"]);
			if (file_exists($archivo))
				unlink($archivo);
			
			// Imprimimos el mesaje de éxito de la operación.
			echo "<P ALIGN='center' CLASS='contenido'><B>TU SOFTWARE HA SIDO ELIMINADO EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Este software ha sido eliminado de la secci&oacute;n \"Nuestros Software\" de nuestro sitio Web. Gracias por colaborar con nosotros.</P>";
		}
		// Cuando el software no se quiere eliminar.
		else
		{
			echo "<P ALIGN='center' CLASS='contenido'><B>LA ELIMINACION DE TU SOFTWARE HA SIDO CANCELADA</B></P>";
			echo "<P CLASS='contenido'>Este software no ha sido eliminado de la secci&oacute;n \"Nuestros Software\" de nuestro sitio Web, por lo que cualquier persona de Chile y el mundo lo puede seguir visitando. Gracias por colaborar con nosotros.</P>";
		}
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
}
?>