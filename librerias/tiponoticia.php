<?PHP
/**
 * tiponoticia.php.
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
 * Clase que contiene los métodos y variables que permiten administrar los tipos de
 * noticias existentes en la base de datos.
 */

class tiponoticia
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Método constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param	$link Enlace a la base de datos.
	 */
	function tiponoticia($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que obtiene todos los tipos de noticias existentes en la base de datos
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