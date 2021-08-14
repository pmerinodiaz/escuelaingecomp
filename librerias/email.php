<?PHP
/**
 * email.php.
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
 * Clase que contiene varios métodos y variables para manejar el envío de e-mail a usuarios.
 * Esta clase requiere que el servidor de correo esté funcionando sin problemas.
 */

class email
{
	// E-mail de origen.
	var $origen;
	
  // E-mail de destino.
	var $destino;
	
	// Asunto del e-mail.
	var $asunto;
	
	// Pequeño comentario, después de enviarse el correo.
	var $comentario;
	
	/**
	 * Constructor en donde se inicializan los atributos de la clase.
	 *
	 * @param $origen El e-mail de origen.
	 * @param $destino El e-mail de destino.
	 * @param $asunto El asunto del e-mail.
	 * @param $comentario El comentario del e-mail.
	 */
	function email($origen, $destino, $asunto, $comentario)
	{
		$this->origen = $origen;
		$this->destino = $destino;
		$this->asunto = $asunto;
		$this->comentario = $comentario;
	}
	
	/**
	 * Método que envía un e-mail desde el origen al destino indicado (1: Recomendación,
	 * 2: Recordar Clave).
	 *
	 * @param $tipo El tipo de envío ha efectuar.
	 */
	function enviar($tipo)
	{
		// Información adicional en el e-mail.
		$from = "From:Escuela Ingeniería en Computación de la ULS <" . $this->origen . ">";
		$content = "Content-type:text/html\n";
		$adicional = $from . $content;
		
		// Dependiendo del tipo del mensaje, configuramos el mensaje.
		switch ($tipo)
		{
			// El mensaje es una recomendación.
			case 1: $contenido = "RECOMENDACION DE ESTE WEB\nRECOMENDACION SITIO WEB ESCUELA INGENIERIA EN COMPUTACION ULS\n===============================================================\n" . $this->comentario . "\n===============================================================\nEsperamos que tu paso por nuestro sitio sea muy provechoso.\nCopyright (C) " . date("Y") . " Escuela Ingeniería en Computación de la ULS\nhttp://www.escuelaingecomp.tk"; break;
			// El mensaje es un recordatorio de clave.
			case 2: $contenido = "RECORDATORIO DE CLAVE\nREGISTRO SITIO WEB ESCUELA INGENIERIA EN COMPUTACION ULS\n========================================================\n" . $this->comentario . "\n========================================================\nEsperamos que disfrutes de nuestros servicios.\nCopyright (C) " . date("Y") . " Escuela Ingeniería en Computación de la ULS\nhttp://www.escuelaingecomp.tk"; break;
			// El mensaje es una respuesta a una consulta.
			case 3: $contenido = "RESPUESTA DE MENSAJE\nRESPUESTA DESDE SITIO WEB ESCUELA INGENIERIA EN COMPUTACION ULS\n===============================================================\n" . $this->comentario . "\n===============================================================\nEsperamos que disfrutes de nuestros servicios.\nCopyright (C) " . date("Y") . " Escuela Ingeniería en Computación de la ULS\nhttp://www.escuelaingecomp.tk"; break;
		}
		
		// Enviamos el mensaje.
		mail($this->destino, $this->asunto, $contenido, $adicional);
	}
}
?>