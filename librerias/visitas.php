<?PHP
/**
 * visitas.php.
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
 * Clase que representa las visitas que hacen los usuarios a un página de este sitio web. En
 * el momento que el usuario visita una página, se incrementa el número de visitas en las tablas
 * de la base de datos. Solo algunas páginas tienen la propiedad de registrar las visitas de los
 * usuarios.
 */

class visitas
{
  // Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Método constructor	que incializa el enlace a una base de datos.
	 *
	 * @param $link Conexión hacia una base de datos que ya ha sido establecida.
	 */
	function visitas($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que incrementa el número de visitas del tema con identificador conocido.
	 *
	 * @param $id_tema El identificador del tema.
	 */
	function incrementarTema($id_tema)
	{
		// Consulta para obtener el número de visitas que tiene un tema en específico.
		$consulta = "SELECT visitas_tema FROM tema WHERE id_tema = $id_tema";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Liberamos memoria utilizada en la consulta anterior.
		mysql_free_result($resultado);
		
		// Incrementamos el número de visitas del tema.
		$visitas = $tupla["visitas_tema"] + 1;
		
		// Consulta para actualizar la tabla 'tema' con el nuevo número de visitas.
		$consulta = "UPDATE tema SET visitas_tema = $visitas WHERE id_tema = $id_tema";
		mysql_query($consulta, $this->enlace);
	}
}
?>