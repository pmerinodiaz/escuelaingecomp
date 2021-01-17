<?PHP
/**
 * semestre.php.
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
 * Clase que representa a los semestres correspondientes a la carrera Ingenier�a en
 * Computaci�n de la ULS. Los semestres son registrados en la base de datos. En el caso
 * de la carrera Ingenier�a en Computaci�n de la ULS existen solo dos semestres.
 */

class semestre
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link Conexi�n hacia una base de datos que ya ha sido establecida.
	 */
	function semestre($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que obtiene todos los semestres existentes en la base de datos y escribe
	 * un select con los resultados.
	 *
	 * @param $id_persona El identificador del semestre.
	 */
	function select($id_semestre)
	{
		// Consulta que obtiene todos los semestres existentes en la base de datos.
		$consulta = "SELECT id_semestre, nombre_semestre FROM semestre ORDER BY nombre_semestre ";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos el select.
		echo "<SELECT NAME='semestre' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos los formatos como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_semestre"] == $id_semestre)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_semestre"], $fila["nombre_semestre"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_semestre"], $fila["nombre_semestre"]);
	  }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
}
?>