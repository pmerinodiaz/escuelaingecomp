<?PHP
/**
 * tiponoticia.php.
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
 * Clase que contiene los m�todos y variables que permiten administrar los tipos de
 * noticias existentes en la base de datos.
 */

class tiponoticia
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * M�todo constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param	$link Enlace a la base de datos.
	 */
	function tiponoticia($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que obtiene todos los tipos de noticias existentes en la base de datos
	 * y escribe un select con los resultados.
	 *
	 * @para $id_tipo_noticia El identificador del tipo de noticia.
	 */
	function select($id_tipo_noticia)
	{
		// Consulta que obtiene todos los tipos de noticias existentes.
		$consulta = "SELECT id_tipo_noticia, desc_tipo_noticia FROM tipo_noticia ORDER BY desc_tipo_noticia";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos el select.
		echo "<SELECT NAME='tipo_noticia' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos los tipos de noticias como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_tipo_noticia"] == $id_tipo_noticia)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_tipo_noticia"], $fila["desc_tipo_noticia"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_tipo_noticia"], $fila["desc_tipo_noticia"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
}
?>