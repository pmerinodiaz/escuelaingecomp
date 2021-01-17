<?PHP
/**
 * formato.php.
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
 * Clase que administra los tipos de formatos existentes en la base de datos. Los formatos
 * son los tipos de archivos que se pueden subir y bajar del sitio Web. Son utilizados
 * generalmente para administrar los iconos que se muestran en la página cuando hay archivos
 * disponibles para el usuario.
 */

class formato
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link Conexión hacia una base de datos que ya ha sido establecida.
	 */
	function formato($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que entrega el src del formato que tiene la identificación enviada.
	 *
	 * @param $id_formato El identificador del formato.
	 *
	 * @return $src_formato El string con el nombre del archivo del formato.
	 */
	function src($id_formato)
	{
		// Consulta que obtiene todos los tipos de preguntas existentes.
		$consulta = "SELECT src_formato FROM formato WHERE id_formato = $id_formato";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Devolvemos el archivo src del formato.
		return $fila["src_formato"];
	}
	
	/**
	 * Método que obtiene todos los tipos de formatos existentes en la base de datos
	 * y escribe un select con los resultados.
	 *
	 * @param $id_formato El identificador del formato.
	 */
	function select($id_formato)
	{
		// Consulta que obtiene todos los formatos existentes.
		$consulta = "SELECT id_formato, nombre_formato FROM formato ORDER BY nombre_formato";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos el select.
		echo "<SELECT NAME='formato' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos los formatos como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_formato"] == $id_formato)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_formato"], $fila["nombre_formato"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_formato"], $fila["nombre_formato"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
}
?>