<?PHP
/**
 * licencia.php.
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
 * Clase que maneja los m�todos y variables de los tipos de licencias existentes
 * en la base de datos.
 */

class licencia
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * M�todo constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link Enlace a la base de datos.
	 */
	function licencia($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que obtiene todos los tipos de licencias existentes en la base de datos
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