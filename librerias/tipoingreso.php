<?PHP
/**
 * tipoingreso.php.
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
 * Clase que maneja los tipos de ingresos existentes en la base de datos. Los tipos de
 * ingresos corresponden a los sistemas de PAA ó PSU. Los cuales son los que se aplican
 * a los postulantes a las Universidades.
 */

class tipoingreso
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Método constructor donde inicializamos el enlace a la base de datos.
	 *
	 * @param $link Enlace a la base de datos.
	 */
	function tipoingreso($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que retorna un string con el nombre de un tipo de ingreso.
	 *
	 * @param $id_tipo_ingreso El identificador del tipo de ingreso a mostrar.
	 *
	 * @return $desc_tipo_ingreso El nombre de un tipo de ingreso con identificador conocido.
	 */
	function nombre($id_tipo_ingreso)
	{
		// Consulta que obtiene el nombre de un tipo de ingreso.
		$consulta = "SELECT desc_tipo_ingreso FROM tipo_ingreso WHERE id_tipo_ingreso = $id_tipo_ingreso";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Devolvemos el nombre del tipo de ingreso.
		return mysql_result($resultado, 0, "desc_tipo_ingreso");
	}
}
?>