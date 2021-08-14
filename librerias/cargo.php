<?PHP
/**
 * cargo.php.
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
 * Clase que contiene los m�todos y variables que permiten administrar los cargos administrativos
 * existentes en la base de datos. Los cargos son puestos de trabajos existentes en la Escuela
 * de Ingenier�a en Computaci�n y que son asignados a los administrativos.
 */

class cargo
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * M�todo constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param	$link Enlace a la base de datos.
	 */
	function cargo($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que obtiene todos los cargos existentes en la base de datos y escribe un
	 * select con los resultados.
	 *
	 * @para $id_cargo El identificador del cargo.
	 */
	function select($id_cargo)
	{
		// Consulta que obtiene todos los cargos existentes.
		$consulta = "SELECT id_cargo, nombre_cargo FROM cargo ORDER BY nombre_cargo";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos el select.
		echo "<SELECT NAME='cargo' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos los cargos como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_cargo"] == $id_cargo)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_cargo"], $fila["nombre_cargo"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_cargo"], $fila["nombre_cargo"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
}
?>