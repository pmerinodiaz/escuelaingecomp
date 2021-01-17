<?PHP
/**
 * control.php.
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
 * Clase que controla la accesibilidad de un usuario a las p�ginas de la Intranet a trav�s
 * de sesiones del PHP. Dependiendo de los privilegios que tenga un usuario, se le permite
 * acceder a diversas funcionalidades dentro del sistema.
 */

class control
{
	// Enlace a la base de datos.
	var $enlace;
	
	// Error ocurrido en el inicio de sesi�n.
	var $error;
	
	// Identificaci�n de la persona que aprob� el control.
	var $id_persona;
	
	/**
	 * Constructor en donde se inicializan los atributos miembros.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function control($link)
	{
		$this->enlace = $link;
		$this->error = 0;
		$this->id_persona = 0;
	}
	
	/**
	 * M�todo que verifica la correctitud del nombre de usuario, contrase�a y privilegio.
	 *
	 * @param $nombre El nombre de usuario.
	 * @param $clave La clave secreta.
	 * @param $privilegio El identificador del privilegio.
	 * @return true Cuando los datos son v�lidos.
	 * @return false Cuando los datos no son v�lidos.
	 */
	function validar($nombre, $clave, $privilegio)
	{
	    // Librer�as necesarias.
		include("usuariointerno.php");
		
		// Creamos un objeto usuario interno.
		$usuario_interno = new usuariointerno($this->enlace);
		
		// Cuando los datos son correctos.
		if ($usuario_interno->esUsuario($nombre, $clave))
		{
			// Obtenemos el identificador del usuario.
			$id = $usuario_interno->id();
			
			// Cuando el usuario es interno.
			if ($usuario_interno->esUsuarioInterno($id))
			{
				// Cuando el usuario interno tiene permiso.
				if ($usuario_interno->tienePermiso($id, $privilegio))
				{
					// Guardamos la identificaci�n del usuario.
					$this->id_persona = $id;
					
					// Devolvemos la correctitud.	
					return true;
				}
				
				// Cuando el usuario interno no tiene permiso.
				else $this->error = 3;
			}
			
			// Cuando el usuario no es interno.
			else $this->error = 2;
		}
		
		// Cuando no es usuario.
		else $this->error = 1;
		
		return false;
	}
	
	/**
	 * M�todo que devuelve el error ocurrido.
	 *
	 * @return $error El error ocurrido en el proceso de logon.
	 */
	function error()
	{
		return $this->error;
	}
	
	/**
	 * M�todo que devuelve la identificaci�n de la persona que pas� el control.
	 *
	 * @return $id_persona El identificador de la persona.
	 */
	function idPersona()
	{
		return $this->id_persona;
	}
}
?>