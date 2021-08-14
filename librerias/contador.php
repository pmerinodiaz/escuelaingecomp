<?PHP
/**
 * contador.php.
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
 * Clase que administra los registros de las visitas en el contador que existe en la base de
 * datos del sitio Web. Las visitas se registran por cada vez que un usuario abre una sección
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
	 * Método que incrementa el número de visitas diarias.
	 */
	function incrementar()
	{
		// Obtención de la fecha del servidor en formato 'aa-mm-dd'.
		$fecha_actual = date("Y-m-d");
		
		// Consulta para obtener el número de visitas del día actual.
		$consulta = "SELECT visitas_contador FROM contador WHERE fecha_contador = '$fecha_actual'";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$total = mysql_num_rows($resultado);
		
		// Liberamos memoria utilizada en la consulta anterior.
		mysql_free_result($resultado);
		
		// Cuando hay registros del día actual en la tabla 'contador'.
		if ($total > 0)
		{
			// Incrementamos el número de visitas del tema.
			$visitas = $tupla["visitas_contador"] + 1;
			
			// Consulta para actualizar la tabla 'contador' con el nuevo número de visitas del día actual.
			$consulta = "UPDATE contador SET visitas_contador = $visitas WHERE fecha_contador = '$fecha_actual'";
			mysql_query($consulta, $this->enlace);
		}
		// Cuando no hay registros del día actual en la tabla 'contador'.
		else
		{
			// Consulta para insertar el registro del día actual en la tabla 'contador'.
			$consulta = "INSERT INTO contador(fecha_contador, visitas_contador) VALUES('$fecha_actual', 1)";
			mysql_query($consulta, $this->enlace);
		}
	}
}
?>