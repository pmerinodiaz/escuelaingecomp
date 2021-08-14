<?PHP
/**
 * usuario.php.
 * v.1.0.
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
 * Clase que administra los registros de los usuarios. Los usuarios son personas que se han
 * registrado en el sitio Web con su nombre de usuario y clave secreta.
 */

class usuario
{
	// Enlace a la base de datos.
	var $enlace;
	
	// Identificador del usuario.
	var $id;
	
	// La pregunta secreta del usuario.
	var $pregunta;
	
	// El email del usuario.
	var $email;
	
	// El nombre del usuario.
	var $nombre;
	
	// La clave secreta del usuario.
	var $clave;
	
	/**
	 * Constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function usuario($link)
	{
		$this->enlace = $link;
		$this->id = 0;
		$this->pregunta = "";
		$this->email = "";
		$this->nombre = "";
		$this->clave = "";
	}
	
	/**
	 * Método que verifica en la base de datos el nombre de usuario y contraseña.
	 *
	 * @param $nombre El nombre del usuario.
	 * @param $clave La clave secreta del usuario.
	 *
	 * @return true Cuando el usuario está en la base de datos.
	 * @return false Cuando el usuario no está en la base de datos.
	 */
	function esUsuario($nombre, $clave)
	{
		// Consulta que obtiene el identificador de la persona con nombre de usuario y clave conocidos.
		$consulta = "SELECT id_persona FROM usuario WHERE nombre_usuario = '$nombre' AND clave_usuario = '$clave'";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando el usuario coincide en su nombre y clave.
		if ($total > 0)
		{
			$fila = mysql_fetch_array($resultado);
			$this->id = $fila["id_persona"];
			return true;
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Cuando el usuario no coincide en su nombre y/o clave.
		return false;
	}
	
	/**
	 * Método que confirma la respuesta secreta de un usuario.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $respuesta La respuesta secreta de la persona.
	 *
	 * @return true Cuando la respuesta es correcta.
	 * @return false Cuando la respuesta es incorrecta.
	 */
	function confirmarRespuesta($id_persona, $respuesta)
	{
		// Consulta que obtiene la clave secreta de un usuario con id_persona y respuesta conocida.
		$consulta = "SELECT persona.email_persona, usuario.nombre_usuario, usuario.clave_usuario FROM persona, usuario WHERE persona.id_persona = usuario.id_persona AND usuario.id_persona = $id_persona AND usuario.respuesta_secreta = '$respuesta'";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);		
		$tupla = mysql_fetch_array($resultado);
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Cuando se encuentra resultados con éxito.
		if ($total > 0)
		{
			// Capturamos el email de la persona.
			$this->email = $tupla["email_persona"];
			
			// Capturamos el nombre del usuario.
			$this->nombre = $tupla["nombre_usuario"];
			
			// Capturamos la clave secreta del usuario.
			$this->clave = $tupla["clave_usuario"];
			
			// Decimos que la respuesta si es correcta.
			return true;
		}
		
		// Decimos que la respuesta no es correcta.
		return false;
	}
	
	/**
	 * Método que envia por correo la clave de un usuario.
	 */
	function enviarClave()
	{
		// Librerias necesarias.
		include("email.php");
		
		// Creamos el email y lo enviamos.
		$email = new email("escuelaingecomp@gmail.com", $this->email, "Recordatorio de clave", "Tus datos para autentificarte en nuestro sitio son:<BR><BR>Usuario:" . $this->nombre . "<BR>Clave:" . $this->clave);
		$email->enviar(2);
	}
	
	/**
	 * Método que retorna la identificación del usuario.
	 */
	function id()
	{
		return $this->id;
	}
	
	/**
	 * Método que entrega la pregunta secreta de un usuario.
	 */
	function pregunta()
	{
		return $this->pregunta;
	}
	
	/**
	 * Método que entrega el email de un usuario.
	 */
	function email()
	{
		return $this->email;
	}
	
	/**
	 * Método que devuelve la clave de usuario.
	 */
	function clave()
	{
		return $this->clave;
	}
}
?>