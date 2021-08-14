<?PHP
/**
 * apartado.php.
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
 * Clase que maneja los m�todos y variables de las tipos de apartados existentes en la
 * base de datos. Los apartados son los temas a los que se relacionan los software y
 * tutoriales que se suben en el sitio Web.
 */

class apartado
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Metodo constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param link El enlace a la base de datos.
	*/
	function apartado($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que obtiene todas los apartados existentes en la base de datos y
	 * escribe un select con los resultados.
	 *
	 * @param id_apartado El identificador el dapartado donde posicionarse.
	*/
	function select($id_apartado)
	{
		// Consulta que obtiene todos los tipos de apartados existentes.
		$consulta = "SELECT id_apartado, nombre_apartado FROM apartado ORDER BY nombre_apartado";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos el select
		echo "<SELECT NAME='apartado' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos los apartados como opciones del select
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_apartado"] == $id_apartado)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_apartado"], $fila["nombre_apartado"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_apartado"], $fila["nombre_apartado"]);
    }
		
		// Cerramos el select
		echo "</SELECT>";
		
		// Liberamos memoria
		mysql_free_result($resultado);
	}
	
	/*
	 * M�todo que retorna un string con el nombre del apartado.
	 *
	 * @param $id_apartado El identificador del apartado.
	 * @return $nombre_apartado El nombre del apartado.
	*/
	function nombre($id_apartado)
	{
		// Consulta para obtener el nombre del apartado.
		$consulta = "SELECT nombre_apartado FROM apartado WHERE id_apartado = $id_apartado";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Devolvemos el nombre encontrado.
		return $fila["nombre_apartado"];
	}
}
?>