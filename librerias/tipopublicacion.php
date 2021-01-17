<?PHP
/**
 * tipopublicacion.php.
 * v.1.0.
 * Diciembre, 2004.
 *
 * Copyright (C) 2004 por Héctor Díaz Díaz - Patricio Merino Díaz.
 * Escuela Ingeniería en Computacion, Universidad de La Serena, Chile.
 * Todos los derechos reservados.
 *
 * No se asume ninguna  responsabilidad por el  uso o  alteración  de este software.
 * Este software se proporciona como es y sin garantía de ningún tipo de su funcionamiento
 * y en ningún caso será el autor responsable de daños o perjuicios que se deriven del mal
 * uso del software, aún cuando este haya sido notificado de la posibilidad de dicho daño.
 *
 * Clase que mcontiene los métodos y variables que permiten administrar los tipos de
 * publicaciones existentes en la base de datos.
 */

class tipopublicacion
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Método constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link Conexión hacia una base de datos que ya ha sido establecida.
	 */
	function tipopublicacion($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que obtiene todos los tipos de publicaciones existentes desde la base de datos
	 * y escribe un select con los resultados.
	 *
	 * @param $id_tipo_publicacion El identificador del tipo de publicación.
	 */
	function select($id_tipo_publicacion)
	{
		// Consulta que obtiene todos los tipos de publicaciones existentes.
		$consulta = "SELECT id_tipo_publicacion, desc_tipo_publicacion FROM tipo_publicacion ORDER BY desc_tipo_publicacion";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos el select.
		echo "<SELECT NAME='tipo_publicacion' CLASS='formlist' TABINDEX='1' onChange='setearEditorial();'>";
		
		// Ciclo en donde imprimimos los tipos de publicaciones como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_tipo_publicacion"] == $id_tipo_publicacion)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_tipo_publicacion"], $fila["desc_tipo_publicacion"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_tipo_publicacion"], $fila["desc_tipo_publicacion"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
}
?>