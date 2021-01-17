<?PHP
/**
 * preguntasecreta.php.
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
 * Clase que maneja los m�todos y variables de las preguntas secretas existentes en la base
 * de datos. Las preguntas secretas se usan en caso de que un usuario olvide o pierda su
 * clave secreta.
 */

class preguntasecreta
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function preguntasecreta($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que obtiene todas las preguntas secretas existentes en la base de datos
	 * y escribe un select con los resultados.
	 *
	 * @param $id_pregunta_secreta El identificador de la pregunta secreta.
	 */
	function select($id_pregunta_secreta)
	{
		// Consulta que obtiene todos los tipos de preguntas secretas existentes.
		$consulta = "SELECT id_pregunta_secreta, nombre_pregunta_secreta FROM pregunta_secreta ORDER BY nombre_pregunta_secreta";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos el select.
		echo "<SELECT NAME='pregunta_secreta' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos los tipos de preguntas como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_pregunta_secreta"] == $id_pregunta_secreta)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_pregunta_secreta"], $fila["nombre_pregunta_secreta"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_pregunta_secreta"], $fila["nombre_pregunta_secreta"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
}
?>