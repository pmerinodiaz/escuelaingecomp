<?PHP
/**
 * tiposervicio.php.
 * v.1.0.
 * Diciembre, 2004.
 *
 * Copyright (C) 2004 por H�ctor D�az D�az - Patricio Merino D�az.
 * Escuela Ingenier�a en Computacion, Universidad de La Serena, Chile.
 * Todos los derechos reservados.
 *
 * No se asume ninguna  responsabilidad por el  uso o  alteraci�n  de este software.
 * Este software se proporciona como es y sin garant�a de ning�n tipo de su funcionamiento
 * y en ning�n caso ser� el autor responsable de da�os o perjuicios que se deriven del mal
 * uso del software, a�n cuando este haya sido notificado de la posibilidad de dicho da�o.
 *
 * Clase que maneja los m�todos y variables que administran los tipos de servicios
 * existentes en la base de datos.
 */

class tiposervicio
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function tiposervicio($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que obtiene todas los tipos de servicios existentes en la base de datos
	 * y escribe un select con los resultados.
	 *
	 * @param $id_servicio El identificador del servicio.
	 */
	function select($id_servicio)
	{
		// Consulta que obtiene todos los tipos de preguntas secretas existentes.
		$consulta = "SELECT id_servicio, nombre_servicio FROM servicio ORDER BY nombre_servicio";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos el select.
		echo "<SELECT NAME='tipo_servicio' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos los tipos de servicios como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_servicio"] == $id_servicio)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_servicio"], $fila["nombre_servicio"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_servicio"], $fila["nombre_servicio"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
}
?>