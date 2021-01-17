<?PHP
/**
 * persona.php.
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
 * Clase que administra a las personas que surgen en este sistema. Las personas que se
 * manejan van desde los autores de publicaciones hasta los usuarios del sitio Web. Estas
 * personas se registran en la base de datos 'ingecomp'.
 */

class persona
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Método constructor en donde se inicializa el enlace a la dase de datos.
	 *
	 * @param $link Conexión hacia una base de datos que ya ha sido establecida.
	 */
	function persona($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que verifica que el e-mail de la persona coincide con el nombre enviado.
	 *
	 * @param $email El correo electrónico de la persona.
	 * @param $nombres El primer y segundo nombre de la persona.
	 * @param $paterno El apellido paterno de la persona.
	 * @param $paterno El apellido materno de la persona.
	 *
	 * @return 1 Cuando si coinciden.
	 * @return 0 Cuando no coinciden.
	 */
	function coincidir($email, $nombres, $paterno, $materno)
	{
		// Obtenemos el identificador de la persona.
		if ($email != "")
			$id_persona = $this->buscar($email);
		else $id_persona = $this->encontrar($nombres, $paterno, $materno);
		
		// Si no fue encontrada.
		if ($id_persona == 0)
			return 1;
		
		// Cuando si fue encontrada.
		else
		{
			// Consulta para buscar a la persona con identificador conocido.
			$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE id_persona = $id_persona";
			$resultado = mysql_query($consulta, $this->enlace);
			$fila = mysql_fetch_array($resultado);
			
			// Cuando coincide el nombre completo.
			if ($fila["nombres_persona"] == $nombres && $fila["paterno_persona"] == $paterno && $fila["materno_persona"] == $materno)
				return 1;
			
			// Liberamos memoria del servidor.
			mysql_free_result($resultado);
		}
		
		// Cuando no coinciden.
		return 0;
	}
	
	/**
	 * Método que retorna el identificador de una persona con e-mail conocido.
	 *
	 * @param	$email	El correo electrónico de la persona.
	 *
	 * @return $id_persona	El identificador de la persona.
	 */
	function buscar($email)
	{
		// Consulta para buscar la persona con e-mail conocido.
		$consulta = "SELECT id_persona FROM persona WHERE email_persona = '$email'";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		
		// Enviamos la identificación de la persona.
		return $fila["id_persona"];
	}
	
	/**
	 * Método que retorna el identificador de una persona con nombre conocido.
	 *
	 * @param	$nombres	El primer y segundo nombre de la persona.
	 * @param $paterno	El apellido paterno de la persona.
	 * @param $materno	El apellido materno de la persona.
	 *
	 * @return $id_persona El identificador de la persona.
	 */
	function encontrar($nombres, $paterno, $materno)
	{
		// Consulta para buscar la persona con nombre conocido.
		$consulta = "SELECT id_persona FROM persona WHERE nombres_persona = '$nombres' AND paterno_persona = '$paterno' AND materno_persona = '$materno'";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		
		// Enviamos la identificación de la persona.
		return $fila["id_persona"];
	}
	
	/**
	 * Método que agrega una nueva persona a la tabla 'persona y retorna el identificador
	 * asignado a la nueva persona.
	 *
	 * @param	$nombres Primer y segundo nombre de la persona.
	 * @param	$paterno Apellido paterno de la persona.
	 * @param	$materno Apellido materno de la persona.
	 * @param	$email Correo electrónico de la persona.
	 */
	function agregar($nombres, $paterno, $materno, $email)
	{
		// Consulta que inserta el registro de la persona.
		$insert = "INSERT INTO persona(nombres_persona, paterno_persona, materno_persona, email_persona) ";
		
		// Cuando el e-mail si existe.
		if ($email != "")
		{
			// Cuando el apellido materno si existe.
			if ($materno != "")
				$values = "VALUES('$nombres', '$paterno', '$materno', '$email')";
			// Cuando el apellido materno no existe.
			else $values = "VALUES('$nombres', '$paterno', NULL, '$email')";
		}
		// Cuando el e-mail no existe.
		else
		{
			// Cuando el apellido materno si existe.
			if ($materno != "")
				$values = "VALUES('$nombres', '$paterno', '$materno', NULL)";
			// Cuando el apellido materno no existe.
			else $values = "VALUES('$nombres', '$paterno', NULL, NULL)";
		}
		
		// Hacemos la inserción.
		$consulta = $insert . $values;
	  mysql_query($consulta, $this->enlace);
		
		// Enviamos el identificador asignado en la última inserción.
		return mysql_insert_id();
	}
}
?>