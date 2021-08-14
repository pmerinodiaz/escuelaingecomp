<?PHP
/**
 * utilidad.php.
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
 * Clase que contiene los método y variables que manejan los registros de utilidades
 * (software y tutoriales) existentes en la base de datos.
 */

class utilidad
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
	function utilidad($link)
	{
		$this->enlace = $link;
		$this->caracteres = get_html_translation_table(HTML_SPECIALCHARS);
	}
	
	/**
	 * Método que retorna la fecha mayor (es decir, la más reciente) de una utilidad con
	 * los parámetros enviados.
	 *
	 * @param $id El identificador del sistema operativo o del apartado.
	 * @param $id_tipo_utilidad El identificador del tipo de utilidad.
	 * @param $id_pertenencia_utilidad El identificador de la pertenencia de la utilidad.
	 *
	 * @return $fecha_llegada La fecha de llegada de la utilidad.
	 */
	function fechaMayor($id, $id_tipo_utilidad, $id_pertenencia_utilidad)
	{
		// Consulta para obtener las fechas de llegadas de las utilidades.
		$select = "SELECT fecha_llegada ";
		$from = "FROM utilidad ";
		switch ($id_tipo_utilidad)
		{
			case 1: $where = "WHERE id_sistema_operativo = $id AND id_tipo_utilidad = $id_tipo_utilidad AND id_pertenencia_utilidad = $id_pertenencia_utilidad "; break;
			case 2: $where = "WHERE id_apartado = $id AND id_tipo_utilidad = $id_tipo_utilidad AND id_pertenencia_utilidad = $id_pertenencia_utilidad "; break;
		}
		$order = "ORDER BY fecha_llegada DESC";
		$consulta = $select . $from . $where . $order;
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Devolvemos la fecha de llegada.
		return mysql_result($resultado, 0, "fecha_llegada");
	}
	
	/**
	 * Método en el cual se imprimen las celdas con la carpeta, la sección y el número de utilidades.
	 *
	 * @param $id_tipo_utilidad El identificador del tipo de utilidad.
	 * @param $resultado La fila resultante de una consulta.
	 * @param $indice El índice o puntero en la fila.
	 * @param $tiempo El objeto tiempo ya inicializado.
	 * @param $fecha La fecha de llegada.
	 */
	function seccion($id_tipo_utilidad, $resultado, $indice, $tiempo, $fecha)
	{
		// Imprimimos un tipo de carpeta dependiendo de si se agregaron nuevas utilidades durante
		// las últimas 24 hr.
		if ($tiempo->entreLapso($fecha, 24))
			printf("<TD WIDTH='%s' ALIG='center' CLASS='tabla'><IMG SRC='../../librerias/icocarpetaabierta.gif'></TD>", "5%");
		else printf("<TD WIDTH='%s' ALIG='center' CLASS='tabla'><IMG SRC='../../librerias/icocarpetacerrada.gif'></TD>", "5%");
		
		// Imprimimos el nombre del apartado con el número de utilidades que contiene.
		switch ($id_tipo_utilidad)
		{
			case 1:
			{
				$sistema = strtr(mysql_result($resultado, $indice, "nombre_sistema_operativo"), $this->caracteres);
				printf("<TD WIDTH='%s' CLASS='tabla'><A HREF='software.php?id=%d&pagina=1' TITLE='Ver Software de %s'>%s</A> (%s)</TD>", "45%", mysql_result($resultado, $indice, "id_sistema_operativo"), $sistema, $sistema, mysql_result($resultado, $indice, "num_utilidad"));
				break;
			}
			case 2:
			{
				$apartado = strtr(mysql_result($resultado, $indice, "nombre_apartado"), $this->caracteres);
				printf("<TD WIDTH='%s' CLASS='tabla'><A HREF='tutoriales.php?id=%d&pagina=1' TITLE='Ver Tutoriales de %s'>%s</A> (%s)</TD>", "45%", mysql_result($resultado, $indice, "id_apartado"), $apartado, $apartado, mysql_result($resultado, $indice, "num_utilidad"));
				break;
			}
		}
	}
	
	/**
	 * Método que imprime dos celdas con los caracteres de vacío.
	 */
	function vacio()
	{
		printf("<TD WIDTH='%s' CLASS='tabla'>&nbsp;</TD>", "5%");
		printf("<TD WIDTH='%s' CLASS='tabla'>&nbsp;</TD>", "45%");
	}
	
	/**
	 * Método que retorna el número de comentarios que tiene una utilidad.
	 *
	 * @param $id_utilidad El identificador de la utilidad.
	 *
	 * @return $num_comentarios El número de comentarios que tiene la utilidad.
	 */
	function numeroComentarios($id_utilidad)
	{
		// Consulta para obtener el total de comentarios de una utilidad.
		$consulta = "SELECT COUNT(*) AS num_comentarios FROM comentario WHERE id_utilidad = $id_utilidad";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Devolvemos el número de comentarios obtenido.
		return $fila["num_comentarios"];
	}
	
	/**
	 * Método donde se actualiza el número de visitas de una utilidad.
	 *
	 * @param $id_utilidad El identificador de la utilidad.
	 * @param $visitas El nuevo número de visitas de la utilidad.
	 */
	function actualizarVisitas($id_utilidad, $visitas)
	{
		// Consulta para actualizar las visitas de la utilidad.
		$consulta = "UPDATE utilidad SET visitas_utilidad = $visitas WHERE id_utilidad = $id_utilidad";
		$resultado = mysql_query($consulta, $this->enlace);
	}
	
	/**
	 * Método que retorna el URL de una utilidad.
	 *
	 * @param $id_utilidad El identificador de la utilidad.
	 *
	 * @return $url_utilidad El url de la utilidad.
	 */
	function url($id_utilidad)
	{
		// Consulta para obtener la URL de una utilidad.
		$consulta = "SELECT url_utilidad FROM utilidad WHERE id_utilidad = $id_utilidad";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Devolvemos el url encontrado.
		return $tupla["url_utilidad"];
	}
	
	/**
	 * Método que actualiza en la base de datos la votación (puntuación y votos) de
	 * una utilidad.
	 *
	 * @param $id_tipo_utilidad El identificador del tipo de utilidad.
	 * @param $id_utilidad El identificador de la utilidad.
	 * @param $nota La nota orotgada a la utilidad.
	 */
	function votar($id_tipo_utilidad, $id_utilidad, $nota)
	{
		// Consultas para actualizar la nota y los votos de la utilidad.
		$puntuacion = $this->puntuacion($id_utilidad) + $nota;
		$votos = $this->votos($id_utilidad) + 1;
		
		// Consulta para actualizar la puntuacion.
		$consulta = "UPDATE utilidad SET puntuacion_utilidad = $puntuacion, votos_utilidad = $votos WHERE id_utilidad = $id_utilidad";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Vemos el tipo de utilidad.
		switch ($id_tipo_utilidad)
		{
			case 1: $texto = "software"; break;
			case 2: $texto = "tutorial"; break;
		}
		
		// Imprimimos los mesajes de éxito de la operación.
		printf("<P ALIGN='center' CLASS='contenido'><B>TU VOTACION HA SIDO REGISTRADA EXITOSAMENTE</B></P>");
		printf("<P CLASS='contenido'>La nota promedio de este %s estar&aacute; disponible para que cualquier persona la vea y se convertir&aacute; en una gu&iacute;a importante para que los usuarios elijan este %s. Gracias por darnos tu voto.</P>", $texto, $texto);
		printf("<DIV ALIGN='center'><A HREF=\"javascript:history.back(1);\" TITLE='Volver'><IMG SRC='../../librerias/btvolver.gif' BORDER='0'></A></DIV>");
	}
	
	/**
	 * Método que retorna la puntuación existente de una utilidad.
	 *
	 * @param $id_utilidad El identificador de la utilidad.
	 *
	 * @return $puntuacion_utilidad La puntuación que tiene la utilidad.
	 */
	function puntuacion($id_utilidad)
	{
		// Consulta para obtener la nota anterior de la utilidad.
		$consulta = "SELECT puntuacion_utilidad FROM utilidad WHERE id_utilidad = $id_utilidad";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Devolvemos la puntuación.
		return $tupla["puntuacion_utilidad"];
	}
	
	/**
	 * Método que retorna la cantidad de votos existente de una utilidad.
	 *
	 * @param $id_utilidad El identificador de la utilidad.
	 * @return $votos_utilidad El número de votos que tiene la utilidad.
	 */
	function votos($id_utilidad)
	{
		// Consulta para obtener los votos de una utilidad.
		$consulta = "SELECT votos_utilidad FROM utilidad WHERE id_utilidad = $id_utilidad";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Devolvemos los votos obtenidos.
		return $tupla["votos_utilidad"];
	}
	
	/**
	 * Método que retorna el string con el nombre del autor de una utilidad nuestra.
	 *
	 * @param $id_utilidad El identificador de la utilidad.
	 *
	 * @return $autor El nombre del autor de la utilidad.
	 */
	function autorNuestros($id_utilidad)
	{
		// Consulta para obtener el nombre del autor.
		$consulta = "SELECT persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona FROM utilidad, usuario_interno, persona WHERE utilidad.id_utilidad = $id_utilidad AND utilidad.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Capturamos el nombre completo y el e-mail (si tiene).
		$autor = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
		if ($tupla["email_persona"])
		{
			$email = strtr($tupla["email_persona"], $this->caracteres);
			$autor =  $autor . " (<A HREF='mailto:" . $email . "' TITLE='" . $email . "'>" . $email . "</A>)";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Devolvemos el string con el autor.
		return $autor;
	}
	
	/**
	 * Método que retorna el string con el nombre del empresa autora de una utilidad
	 * de terceros.
	 *
	 * @param $id_utilidad El identificador de la utilidad.
	 *
	 * @return $autor El nombre de la empresa autora de la utilidad.
	 */
	function autorTerceros($id_utilidad)
	{
		$consulta = "SELECT empresa.nombre_empresa, empresa.url_empresa FROM utilidad, empresa WHERE utilidad.id_utilidad = $id_utilidad AND utilidad.id_empresa = empresa.id_empresa";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Capturamos el nombre de la empresa y el sitio web (si tiene).
		$autor = "Forma parte de ";
		$empresa = strtr($tupla["nombre_empresa"], $this->caracteres);
		if ($tupla["url_empresa"])
			$autor =  $autor . "<A HREF='http://" . strtr($tupla["url_empresa"], $this->caracteres) . "' TITLE='Visitar Web de " . $empresa . "' TARGET='_blank'>" . $empresa . "</A>";
		else $autor =  $autor . $empresa;
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Devolvemos el string con el autor.
		return $autor;
	}
}
?>