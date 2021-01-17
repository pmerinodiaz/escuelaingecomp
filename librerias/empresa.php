<?PHP
/**
 * empresa.php.
 * v. 1.0.
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
 * Clase que contiene los métodos y variables que manejan los registros de las empresas
 * existentes en la base de datos.
 */

class empresa
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function empresa($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que obtiene todas las empresas que son universidades y escribe un select
	 * con los resultados obtenidos.
	 *
	 * @param $id_empresa El identificador de la empresa.
	 */
	function selectUniversidades($id_empresa)
	{
		// Consulta que obtiene todas las universidades existentes.
		$consulta = "SELECT id_empresa, nombre_empresa FROM empresa WHERE id_tipo_empresa = 6 ORDER BY nombre_empresa";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Creamos el select.
		echo "<SELECT NAME='empresa' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos las editoriales como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_empresa"] == $id_empresa)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_empresa"], $fila["nombre_empresa"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_empresa"], $fila["nombre_empresa"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que obtiene todas las empresas que son editoriales y escribe un <INPUT TYPE='SELECT'>
	 * con los resultados.
	 *
	 * @param $id_empresa El identificador de la empresa.
	 * @param $deshabilitar Si se desea deshabilitar o no el componente.
	 */
	function selectEditoriales($id_empresa, $deshabilitar)
	{
		// Consulta que obtiene todas las editoriales existentes.
		$consulta = "SELECT id_empresa, nombre_empresa FROM empresa WHERE id_tipo_empresa IN (6, 7, 8, 9, 10, 12, 16, 26) ORDER BY nombre_empresa";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Creamos el select.
		if ($deshabilitar)
			echo "<SELECT NAME='empresa' CLASS='formlist' TABINDEX='1' DISABLED>";
		else echo "<SELECT NAME='empresa' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos las editoriales como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_empresa"] == $id_empresa)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_empresa"], $fila["nombre_empresa"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_empresa"], $fila["nombre_empresa"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que obtiene todas las empresas y escribe un select con los resultados.
	 *
	 * @param $id_empresa El identificador de la empresa.
	 * @param $nombre_select El nombre que tendrá el select.
	 */
	function select($id_empresa, $nombre_select)
	{
		// Consulta que obtiene todas las editoriales existentes.
		$consulta = "SELECT id_empresa, nombre_empresa FROM empresa ORDER BY nombre_empresa";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Creamos el select.
		echo "<SELECT NAME='$nombre_select' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos las editoriales como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_empresa"] == $id_empresa)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_empresa"], $fila["nombre_empresa"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_empresa"], $fila["nombre_empresa"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
}
?>