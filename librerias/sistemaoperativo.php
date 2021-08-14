<?PHP
/**
 * sistemaoperativo.php.
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
 * Clase que administra los registros de los sistemas operativos o plataformas existente
 * en la base de datos.
 */

class sistemaoperativo
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link Enlace a la base de datos.
	 */
	function sistemaoperativo($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que incrementa el número de visitas del sistema operativo con nombre conocido.
	 *
	 * @param $sistema El nombre del sistema operativo.
	 */
	function incrementar($sistema)
	{
		// Consulta para obtener el número de visitas del sistema operativo.
		$consulta = "SELECT visitas_sistema_operativo FROM sistema_operativo WHERE nombre_sistema_operativo = '$sistema'";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$total = mysql_num_rows($resultado);
		
		// Liberamos memoria utilizada en la consulta anterior.
		mysql_free_result($resultado);
		
		// Cuando hay registros del sistema operativo en la tabla 'sistema_operativo'.
		if ($total > 0)
		{
			// Incrementamos el número de visitas del sistema operativo.
			$visitas = $tupla["visitas_sistema_operativo"] + 1;
			
			// Consulta para actualizar el número de visitas del sistema operativo.
			$consulta = "UPDATE sistema_operativo SET visitas_sistema_operativo = $visitas WHERE nombre_sistema_operativo = '$sistema'";
			mysql_query($consulta, $this->enlace);
		}
	}
	
	/**
	 * Método que obtiene todas los sistemas operativos existentes en la base de datos
	 * y escribe un select con los resultados.
	 *
	 * @param $id_sistema_operativo El identificador del sistema operativo.
	 */
	function select($id_sistema_operativo)
	{
		// Consulta que obtiene todos los sistemas operativos.
		$consulta = "SELECT id_sistema_operativo, nombre_sistema_operativo FROM sistema_operativo ORDER BY nombre_sistema_operativo";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos el select.
		echo "<SELECT NAME='sistema_operativo' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos los sistemas operativos como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_sistema_operativo"] == $id_sistema_operativo)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_sistema_operativo"], $fila["nombre_sistema_operativo"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_sistema_operativo"], $fila["nombre_sistema_operativo"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que retorna un string con el nombre del sistema operativo.
	 *
	 * @param $id_sistema_operativo El identificador del sistema operativo.
	 * @return $nombre_sistema_operativo El nombre del sistema operativo.
	 */
	function nombre($id_sistema_operativo)
	{
		// Consulta para obtener el nombre del sistema operativo.
		$consulta = "SELECT nombre_sistema_operativo FROM sistema_operativo WHERE id_sistema_operativo = $id_sistema_operativo";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Devolvemos el nombre encontrado.
		return $fila["nombre_sistema_operativo"];
	}
	
	/**
	 * Método que muestra la lista de sistemas operativos desde la base de datos y configura
	 * las estadísticas resultantes por sistema operativo.
	 */
	function estadisticas()
	{
		// Consulta para obtener el total de visitas por sistema operativo.
		$consulta = "SELECT SUM(visitas_sistema_operativo) AS total_visitas FROM sistema_operativo";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Capturamos el total de visitas por sistema operativo.
		$total_visitas = $tupla["total_visitas"];
		
		// Imprimimos la tabla en donde mostramos las estadísticas.
		echo "<TABLE WIDTH='100%' BORDER='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='5' CLASS='contenido'>Hay un total de $total_visitas visitas por sistema operativo.</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' ALIGN='center' CLASS='titulotabla'><B>Sistema Operativo</B></TD>";
		echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'><B>Visitas</B></TD>";
		echo "<TD WIDTH='60%' ALIGN='center' CLASS='titulotabla' COLSPAN='2'><B>Porcentaje</B></TD>";
		echo "</TR>";
		
		// Consulta para obtener el total de visitas para cada sistema operativo de la tabla.
		$consulta = "SELECT src_sistema_operativo, nombre_sistema_operativo, SUM(visitas_sistema_operativo) AS visitas_sistema_operativo FROM sistema_operativo GROUP BY id_sistema_operativo ORDER BY visitas_sistema_operativo DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Ciclo en donde imprimimos el sistema operativo con su respectivo porcentaje y total.
		while ($tupla = mysql_fetch_array($resultado))
		{
			printf("<TR>");
			
			// Mostramos el icono y el nombre del sistema operativo.
			printf("<TD CLASS='tabla' VALIGN='top'><IMG SRC='../../../../librerias/%s'> %s</TD>", $tupla["src_sistema_operativo"], $tupla["nombre_sistema_operativo"]);
			
			// Mostramos el número de visitas del navegador.
			printf("<TD CLASS='tabla' VALIGN='top' ALIGN='center'>%d</TD>", $tupla["visitas_sistema_operativo"]);
			
			// Calculamos el porcentaje.
			if ($total_visitas > 0)
				$porcentaje = 100 * $tupla["visitas_sistema_operativo"] / $total_visitas;
			else $porcentaje = 0.0;
			
			// Mostramos el gráfico del porcentaje.
			printf("<TD CLASS='tabla' VALIGN='top'><IMG SRC='../../../../librerias/pxrojo.gif' WIDTH='%d' HEIGHT='10'></TD>", $porcentaje*2);
			
			// Mostramos el porcentaje.
			printf("<TD CLASS='tabla' VALIGN='top' ALIGN='right'>%0.1f %s</TD>", $porcentaje, "%");
			printf("</TR>");
		}
		
		// Cerramos la tabla.
		echo "</TABLE>";
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
}
?>