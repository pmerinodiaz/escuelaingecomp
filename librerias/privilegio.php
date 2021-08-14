<?PHP
/**
 * privilegio.php.
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
 * Clase que maneja los m�todos y variables de los tipos de privilegios existentes en
 * la base de datos para los usuarios que tienen acceso a la Intranet.
 */

class privilegio
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function privilegio($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que entrega todos los tipos de privilegios existentes en la base de
	 * datos en un select.
	 *
	 * @param $id_privilegio El identificador del privilegio donde se posiciona el select.
	 */
	function select($id_privilegio)
	{
		// Consulta que obtiene todos los tipos de privilegios.
		$consulta = "SELECT id_privilegio, desc_privilegio FROM privilegio ORDER BY desc_privilegio";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos el select.
		echo "<SELECT NAME='privilegio' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos los tipos de privilegios como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_privilegio"] == $id_privilegio)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_privilegio"], $fila["desc_privilegio"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_privilegio"], $fila["desc_privilegio"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
}
?>