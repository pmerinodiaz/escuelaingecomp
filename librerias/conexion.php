<?PHP
/**
 * conexion.php.
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
 * Clase que contiene los m�todos y variables enfocados a realizar una conexi�n a la base de
 * datos de tipo MySQL. En la conexi�n se utiliza al usuario 'escuelaingecomp' que fue creado para
 * administrar la base de datos 'escuelaingecomp'.
 */

class conexion
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * M�todo constructor que no realiza ninguna tarea. Es usado solamente para instanciar a
	 * un objeto de la clase.
	 */
	function conexion()
	{
	}
	
	/**
	 * M�todo que retorna la conexi�n a la base de datos 'escuelaingecomp' de la Escuela IC.
	 * En caso de que no se haya podido realizar la conexi�n en forma v�lida, no se retorna
	 * varoles.
	 *
	 * @return $enlace El enlace a la base de datos.
	 */
	function conectar()
	{
		// Realizamos la conexi�n del usuario 'u190876680_comp' al host 'localhost'.
		$this->enlace = mysql_connect("localhost", "escuelaingecomp", "masterkey");
		
		// Cuando el usuario 'escuelaingecomp' no pudo conectarse al host 'localhost'.
		if (!$this->enlace)
		{
			printf("<P CLASS='contenido'>Conexi&oacute;n del usuario <B>escuelacomp</B> al servidor <B>localhost</B> no efectuada.</P>");
	  	exit();
		}
		
		// Cuando el enlace a la base de datos 'escuelaingecomp' no es factible.
		if (!mysql_select_db("escuelaingecomp", $this->enlace))
		{
			printf("<P CLASS='contenido'>Conexi&oacute;n a la base de datos <B>escuelaingecomp</B> no efectuada.</P>");
			exit();
		}
		
		// Retornamos la conexi�n efectuada.
		return $this->enlace;
	}
	
	/**
	 * M�todo que desconecta el enlace de la base de datos 'escuelaingecomp'.
	 */
	function desconectar()
	{
		mysql_close($this->enlace);
	}
}
?>
