<?PHP
/**
 * tipoingreso.php.
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
 * Clase que maneja los tipos de ingresos existentes en la base de datos. Los tipos de
 * ingresos corresponden a los sistemas de PAA � PSU. Los cuales son los que se aplican
 * a los postulantes a las Universidades.
 */

class tipoingreso
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * M�todo constructor donde inicializamos el enlace a la base de datos.
	 *
	 * @param $link Enlace a la base de datos.
	 */
	function tipoingreso($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que retorna un string con el nombre de un tipo de ingreso.
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