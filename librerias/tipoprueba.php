<?PHP
/**
 * tipoprueba.php.
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
 * Clase que contiene método y variables que permiten administrar los registros de
 * pruebas enviadas al Banco de Pruebas del sitio Web.
 */

class tipoprueba
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Método constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param link El enlace a la base de datos.
	 */
	function tipoprueba($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que obtiene todos los tipos de prueba existentes en la base de datos y
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