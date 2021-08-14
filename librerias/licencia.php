<?PHP
/**
 * licencia.php.
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
 * Clase que maneja los métodos y variables de los tipos de licencias existentes
 * en la base de datos.
 */

class licencia
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Método constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link Enlace a la base de datos.
	 */
	function licencia($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que obtiene todos los tipos de licencias existentes en la base de datos
	 * y escribe un select con los resultados.
	 *
	 * @param $id_licencia El identificador de la licencia.
	 */
	function select($id_licencia)
	{
		// Consulta que obtiene todos los tipos de licencias existentes.
		$consulta = "SELECT id_licencia, nombre_licencia FROM licencia ORDER BY nombre_licencia";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos el select.
		echo "<SELECT NAME='licencia' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos los tipos de licencias como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_licencia"] == $id_licencia)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_licencia"], $fila["nombre_licencia"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_licencia"], $fila["nombre_licencia"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
}
?>