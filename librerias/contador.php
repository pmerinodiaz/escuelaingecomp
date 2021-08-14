<?PHP
/**
 * contador.php.
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
 * Clase que administra los registros de las visitas en el contador que existe en la base de
 * datos del sitio Web. Las visitas se registran por cada vez que un usuario abre una secci�n
 * del sitio Web.
 */

class contador
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link Enlace a la base de datos.
	 */
	function contador($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que incrementa el n�mero de visitas diarias.
	 */
	function incrementar()
	{
		// Obtenci�n de la fecha del servidor en formato 'aa-mm-dd'.
		$fecha_actual = date("Y-m-d");
		
		// Consulta para obtener el n�mero de visitas del d�a actual.
		$consulta = "SELECT visitas_contador FROM contador WHERE fecha_contador = '$fecha_actual'";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$total = mysql_num_rows($resultado);
		
		// Liberamos memoria utilizada en la consulta anterior.
		mysql_free_result($resultado);
		
		// Cuando hay registros del d�a actual en la tabla 'contador'.
		if ($total > 0)
		{
			// Incrementamos el n�mero de visitas del tema.
			$visitas = $tupla["visitas_contador"] + 1;
			
			// Consulta para actualizar la tabla 'contador' con el nuevo n�mero de visitas del d�a actual.
			$consulta = "UPDATE contador SET visitas_contador = $visitas WHERE fecha_contador = '$fecha_actual'";
			mysql_query($consulta, $this->enlace);
		}
		// Cuando no hay registros del d�a actual en la tabla 'contador'.
		else
		{
			// Consulta para insertar el registro del d�a actual en la tabla 'contador'.
			$consulta = "INSERT INTO contador(fecha_contador, visitas_contador) VALUES('$fecha_actual', 1)";
			mysql_query($consulta, $this->enlace);
		}
	}
}
?>