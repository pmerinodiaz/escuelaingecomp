<?PHP
/**
 * visitas.php.
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
 * Clase que representa las visitas que hacen los usuarios a un p�gina de este sitio web. En
 * el momento que el usuario visita una p�gina, se incrementa el n�mero de visitas en las tablas
 * de la base de datos. Solo algunas p�ginas tienen la propiedad de registrar las visitas de los
 * usuarios.
 */

class visitas
{
  // Enlace a la base de datos.
	var $enlace;
	
	/**
	 * M�todo constructor	que incializa el enlace a una base de datos.
	 *
	 * @param $link Conexi�n hacia una base de datos que ya ha sido establecida.
	 */
	function visitas($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que incrementa el n�mero de visitas del tema con identificador conocido.
	 *
	 * @param $id_tema El identificador del tema.
	 */
	function incrementarTema($id_tema)
	{
		// Consulta para obtener el n�mero de visitas que tiene un tema en espec�fico.
		$consulta = "SELECT visitas_tema FROM tema WHERE id_tema = $id_tema";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Liberamos memoria utilizada en la consulta anterior.
		mysql_free_result($resultado);
		
		// Incrementamos el n�mero de visitas del tema.
		$visitas = $tupla["visitas_tema"] + 1;
		
		// Consulta para actualizar la tabla 'tema' con el nuevo n�mero de visitas.
		$consulta = "UPDATE tema SET visitas_tema = $visitas WHERE id_tema = $id_tema";
		mysql_query($consulta, $this->enlace);
	}
}
?>