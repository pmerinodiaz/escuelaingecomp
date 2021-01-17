<?PHP
/**
 * control.php.
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
 * Clase que controla la accesibilidad de un usuario a las páginas de la Intranet a través
 * de sesiones del PHP. Dependiendo de los privilegios que tenga un usuario, se le permite
 * acceder a diversas funcionalidades dentro del sistema.
 */

class control
{
	// Enlace a la base de datos.
	var $enlace;
	
	// Error ocurrido en el inicio de sesión.
	var $error;
	
	// Identificación de la persona que aprobó el control.
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
	 * Método que verifica la correctitud del nombre de usuario, contraseña y privilegio.
	 *
	 * @param $nombre El nombre de usuario.
	 * @param $clave La clave secreta.
	 * @param $privilegio El identificador del privilegio.
	 * @return true Cuando los datos son válidos.
	 * @return false Cuando los datos no son válidos.
	 */
	function validar($nombre, $clave, $privilegio)
	{
	    // Librerías necesarias.
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
					// Guardamos la identificación del usuario.
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
	 * Método que devuelve el error ocurrido.
	 *
	 * @return $error El error ocurrido en el proceso de logon.
	 */
	function error()
	{
		return $this->error;
	}
	
	/**
	 * Método que devuelve la identificación de la persona que pasó el control.
	 *
	 * @return $id_persona El identificador de la persona.
	 */
	function idPersona()
	{
		return $this->id_persona;
	}
}
?>