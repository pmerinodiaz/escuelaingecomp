<?PHP
/**
 * tipoprueba.php.
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
 * Clase que contiene m�todo y variables que permiten administrar los registros de
 * pruebas enviadas al Banco de Pruebas del sitio Web.
 */

class tipoprueba
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * M�todo constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param link El enlace a la base de datos.
	 */
	function tipoprueba($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que obtiene todos los tipos de prueba existentes en la base de datos y
	 * escribe un select con los resultados.
	 *
	 * @param $id_tipo_prueba El identificador del tipo de prueba.
	 */
	function select($id_tipo_prueba)
	{
		// Consulta que obtiene todos los tipos de pruebas existentes.
		$consulta = "SELECT id_tipo_prueba, desc_tipo_prueba FROM tipo_prueba ORDER BY desc_tipo_prueba ";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos el select.
		echo "<SELECT NAME='tipo_prueba' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos los tipos de pruebas como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_tipo_prueba"] == $id_tipo_prueba)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_tipo_prueba"], $fila["desc_tipo_prueba"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_tipo_prueba"], $fila["desc_tipo_prueba"]);
	    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
}
?>