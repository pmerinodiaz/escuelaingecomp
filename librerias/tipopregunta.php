<?PHP
/**
 * tipopregunta.php.
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
 * Clase que maneja los m�todos y variables de los tipos de preguntas existentes
 * en la base de datos.
 */

class tipopregunta
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * M�todo constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function tipopregunta($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que obitne todos los tipos de preguntas existentes en la base de datos.
	 *
	 * @param $id_tipo_pregunta El identificador del tipo de pregunta.
	 */
	function select($id_tipo_pregunta)
	{
		// Consulta que obtiene todos los tipos de preguntas existentes.
		$consulta = "SELECT id_tipo_pregunta, desc_tipo_pregunta FROM tipo_pregunta ORDER BY desc_tipo_pregunta";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos el select.
		echo "<SELECT NAME='tipo_pregunta' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos los tipos de preguntas como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_tipo_pregunta"] == $id_tipo_pregunta)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_tipo_pregunta"], $fila["desc_tipo_pregunta"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_tipo_pregunta"], $fila["desc_tipo_pregunta"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
}
?>