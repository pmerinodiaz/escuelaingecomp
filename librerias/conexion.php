<?PHP
/**
 * conexion.php.
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
 * Clase que contiene los métodos y variables enfocados a realizar una conexión a la base de
 * datos de tipo MySQL. En la conexión se utiliza al usuario 'escuelaingecomp' que fue creado para
 * administrar la base de datos 'escuelaingecomp'.
 */

class conexion
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Método constructor que no realiza ninguna tarea. Es usado solamente para instanciar a
	 * un objeto de la clase.
	 */
	function conexion()
	{
	}
	
	/**
	 * Método que retorna la conexión a la base de datos 'escuelaingecomp' de la Escuela IC.
	 * En caso de que no se haya podido realizar la conexión en forma válida, no se retorna
	 * varoles.
	 *
	 * @return $enlace El enlace a la base de datos.
	 */
	function conectar()
	{
		// Realizamos la conexión del usuario 'user' al host 'localhost'.
		$this->enlace = mysql_connect("localhost", "user", "pwd");
		
		// Cuando el usuario 'escuelaingecomp' no pudo conectarse al host 'localhost'.
		if (!$this->enlace)
		{
			printf("<P CLASS='contenido'>Conexi&oacute;n del usuario <B>user</B> al servidor <B>localhost</B> no efectuada.</P>");
	  	exit();
		}
		
		// Cuando el enlace a la base de datos 'bd' no es factible.
		if (!mysql_select_db("bd", $this->enlace))
		{
			printf("<P CLASS='contenido'>Conexi&oacute;n a la base de datos <B>escuelaingecomp</B> no efectuada.</P>");
			exit();
		}
		
		// Retornamos la conexión efectuada.
		return $this->enlace;
	}
	
	/**
	 * Método que desconecta el enlace de la base de datos 'escuelaingecomp'.
	 */
	function desconectar()
	{
		mysql_close($this->enlace);
	}
}
?>
