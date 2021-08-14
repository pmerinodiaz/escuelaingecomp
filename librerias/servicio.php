<?PHP
/**
 * servicio.php.
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
 * Clase que administra los registros de servicios (ofertas y solicitudes) existentes en la
 * base de datos. Las ofertas de servicios son avisos que mandan los integrantes de la Escuela
 * IC a la comunidad para ofrecer sus servicios. Las solicitudes de servicios son avisos
 * enviados por empresas y personas externas a la Escuela IC a la comunidad estudiantil.
 */

class servicio
{
	// Enlace a la base de datos.
	var $enlace;
	
	// Almacena el nombre de la oferta o solicitud de servicio.
	var $nombre_envio;
	
	/**
	 * Constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function servicio($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que muestra los servicios para los cuales existe un tipo de envío (Oferta de
	 * Servicio o Solicitud de Servicio).
	 *
	 * @param $id_tipo_envio El identificador del tipo de envío.
	 */
	function mostrar($id_tipo_envio)
	{
		// Librerias necesarias.
		include("tiempo.php");
		
		// Consulta para obtener la cantidad de servicios.
		$consulta = "SELECT COUNT(*) as num_servicio FROM envio WHERE id_tipo_envio = $id_tipo_envio";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_result($resultado, 0, "num_servicio");
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
		
		// Cuando no hay servicios.
		if ($total == 0)
			switch ($id_tipo_envio)
			{
				case 5: echo "<P CLASS='contenido'>No hay ofertas de servicio.</P>"; break;
				case 6: echo "<P CLASS='contenido'>No hay solicitudes de servicio.</P>"; break;
			}
		
		// Cuando hay servicios.
		else
		{
			// Creamos un objeto tiempo.
			$tiempo = new tiempo();
			
			// Mostramos el número total de servicios.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Mostramos la cantidad de servicio de un tipo.
			echo "<TR>";
			switch ($id_tipo_envio)
			{
				case 5:
				{
					echo "<TD ALIGN='right' COLSPAN='4' CLASS='contenido'>Hay un total de $total ofertas de servicios.</TD>";
					$this->nombre_envio = "Ofertas de Servicios";
					$txt = "ofertas";
					break;
				}
				case 6:
				{
					echo "<TD ALIGN='right' COLSPAN='4' CLASS='contenido'>Hay un total de $total solicitudes de servicios.</TD>";
					$this->nombre_envio = "Solicitudes de Servicio";
					$txt = "solicitudes";
					break;
				}
			}
			echo "</TR>";
			
			// Consulta para obtener los servicios en los cuales existen más de un servicio.
			$select = "SELECT servicio.id_servicio, servicio.nombre_servicio, COUNT(*) as num_servicio ";
			switch ($id_tipo_envio)
			{
				case 5:
				{
					$from = "FROM envio, oferta_servicio, servicio ";
					$where = "WHERE envio.id_tipo_envio = $id_tipo_envio AND envio.id_envio = oferta_servicio.id_envio AND oferta_servicio.id_servicio = servicio.id_servicio ";
					break;
				}
				case 6:
				{
					$from = "FROM envio, solicitud_servicio, servicio ";
					$where = "WHERE envio.id_tipo_envio = $id_tipo_envio AND envio.id_envio = solicitud_servicio.id_envio AND solicitud_servicio.id_servicio = servicio.id_servicio ";
					break;
				}
			}
			$group = "GROUP BY servicio.id_servicio ";
			$order = "ORDER BY servicio.nombre_servicio";
			$consulta = $select . $from . $where . $group . $order;
			$resultado = mysql_query($consulta, $this->enlace);
			$total = mysql_num_rows($resultado);
			
			// Calculamos el total de iteraciones que debemos realizar.
			if ($total > 1)
				$iteraciones = round($total / 2);
			else $iteraciones = $total;
			
			// Ciclo en donde imprimimos los servicios, con su respectiva cantidad de ofertas o solicitudes.
			for ($i=0; $i<$iteraciones; $i++)
			{
				printf("<TR>");
				
				// Imprimimos la columna izquierda.
				$fecha = $this->fechaMayor(mysql_result($resultado, $i, "id_servicio"), $id_tipo_envio);
				$this->item($resultado, $i, $tiempo, $fecha);
				
				// Imprimimos la columna derecha.
				$k = $i + $iteraciones;
				if ($k < $total)
				{
					$fecha = $this->fechaMayor(mysql_result($resultado, $k, "id_servicio"), $id_tipo_envio);
					$this->item($resultado, $k, $tiempo, $fecha);
				}
				else $this->vacio();
				
				printf("</TR>");
			}
			
			// Escribimos una fila de espacio en el final y un comentario.
			echo "<TR><TD COLSPAN='4'>&nbsp;</TD></TR>";
			echo "<TR><TD COLSPAN='4' CLASS='contenido'><IMG SRC='../../librerias/icocarpetaabierta.gif'> Se han realizado $txt de servicios durante las &uacute;ltimas 24 horas.</TD></TR>";
			echo "<TR><TD COLSPAN='4' CLASS='contenido'><IMG SRC='../../librerias/icocarpetacerrada.gif'> No se han realizado $txt de servicios durante las &uacute;ltimas 24 horas.</TD></TR>";
			echo "<TR><TD COLSPAN='4'>&nbsp;</TD></TR>";
			echo "</TABLE>";
			
			// Liberamos memoria del servidor.
			mysql_free_result($resultado);
		}
	}
	
	/**
	 * Método que retorna la fecha mayor (es decir, la más reciente) de una oferta o solicitud
	 * de servicio que tiene los parámetros enviados.
	 *
	 * @param $id_servicio El identificador del servicio.
	 * @param $id_tipo_envio El identificador del tipo de envío.
	 *
	 * @return $fecha_mayor La mayor fecha encontrada en una oferta o solicitud de servicio.
	 */
	function fechaMayor($id_servicio, $id_tipo_envio)
	{
		// Consulta para obtener las fechas de llegadas de las ofertas o solicitudes.
		$select = "SELECT fecha_envio ";
		switch ($id_tipo_envio)
		{
			case 5:
			{
				$from = "FROM envio, oferta_servicio, servicio ";
				$where = "WHERE envio.id_tipo_envio = $id_tipo_envio AND envio.id_envio = oferta_servicio.id_envio AND oferta_servicio.id_servicio = $id_servicio ";
				break;
			}
			case 6:
			{
				$from = "FROM envio, solicitud_servicio, servicio ";
				$where = "WHERE envio.id_tipo_envio = $id_tipo_envio AND envio.id_envio = solicitud_servicio.id_envio AND solicitud_servicio.id_servicio = $id_servicio ";
				break;
			}
		}
		$order = "ORDER BY fecha_envio DESC";
		$consulta = $select . $from . $where . $order;
		$resultado = mysql_query($consulta, $this->enlace);
		
		return mysql_result($resultado, 0, "fecha_envio");
	}
	
	/**
	 * Método en el cual se imprimen las celdas con la carpeta, el apartado y el número de servicios.
	 *
	 * @param $resultado La fila resultado del query.
	 * @param $indice El índice de la fila.
	 * @param $tiempo El objeto tiempo.
	 * @param $fecha La fecha mayor de llegada.
	 */
	function item($resultado, $indice, $tiempo, $fecha)
	{
		// Imprimimos un tipo de carpeta dependiendo de si se agregaron nuevas servicios durante
		// las últimas 24 hr.
		if ($tiempo->entreLapso($fecha, 24))
			printf("<TD WIDTH='%s' ALIG='center' CLASS='tabla'><IMG SRC='../../librerias/icocarpetaabierta.gif'></TD>", "5%");
		else printf("<TD WIDTH='%s' ALIG='center' CLASS='tabla'><IMG SRC='../../librerias/icocarpetacerrada.gif'></TD>", "5%");
		
		// Imprimimos el nombre del servicio con el número de ofertas o solicitudes servicios que contiene.
		printf("<TD WIDTH='%s' CLASS='tabla'><A HREF='servicios.php?id=%d&pagina=1' TITLE='Ver %s de %s'>%s</A> (%s)</TD>", "45%", mysql_result($resultado, $indice, "id_servicio"), $this->nombre_envio, mysql_result($resultado, $indice, "nombre_servicio"), mysql_result($resultado, $indice, "nombre_servicio"), mysql_result($resultado, $indice, "num_servicio"));
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
	 * Método que retorna un string con el nombre del servicio.
	 *
	 * @param $id_servicio El identificador del servicio.
	 *
	 * @return $nombre_servicio El nombre del servicio.
	 */
	function nombre($id_servicio)
	{
		// Consulta para obtener el nombre del apartado.
		$consulta = "SELECT nombre_servicio FROM servicio WHERE id_servicio = $id_servicio";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		return $fila["nombre_servicio"];
	}
}
?>