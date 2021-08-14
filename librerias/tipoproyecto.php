<?PHP
/**
 * tipoproyecto.php.
 * v. 1.0.
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
 * Clase que contiene los m�todos y variables que permiten administrar los tipos
 * de proyectos existentes en la base de datos.
 */

class tipoproyecto
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * M�todo constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link Enlace a la base de datos.
	 */
	function tipoproyecto($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que obtiene todos los tipos de proyectos existentes en la base de
	 * datos y escribe un select con los resultados.
	 *
	 * @param $id_tipo_proyecto El identificador del tipo de proyecto.
	 */
	function select($id_tipo_proyecto)
	{
		// Consulta que obtiene todos los tipos de proyectos existentes.
		$consulta = "SELECT id_tipo_proyecto, desc_tipo_proyecto FROM tipo_proyecto ORDER BY desc_tipo_proyecto";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos el select.
		echo "<SELECT NAME='tipo_proyecto' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos los tipos de publicaciones como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_tipo_proyecto"] == $id_tipo_proyecto)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_tipo_proyecto"], $fila["desc_tipo_proyecto"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_tipo_proyecto"], $fila["desc_tipo_proyecto"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
}
?>