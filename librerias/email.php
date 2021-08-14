<?PHP
/**
 * email.php.
 * v.1.0.
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
 * Clase que contiene varios m�todos y variables para manejar el env�o de e-mail a usuarios.
 * Esta clase requiere que el servidor de correo est� funcionando sin problemas.
 */

class email
{
	// E-mail de origen.
	var $origen;
	
  // E-mail de destino.
	var $destino;
	
	// Asunto del e-mail.
	var $asunto;
	
	// Peque�o comentario, despu�s de enviarse el correo.
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
	 * M�todo que env�a un e-mail desde el origen al destino indicado (1: Recomendaci�n,
	 * 2: Recordar Clave).
	 *
	 * @param $tipo El tipo de env�o ha efectuar.
	 */
	function enviar($tipo)
	{
		// Informaci�n adicional en el e-mail.
		$from = "From:Escuela Ingenier�a en Computaci�n de la ULS <" . $this->origen . ">";
		$content = "Content-type:text/html\n";
		$adicional = $from . $content;
		
		// Dependiendo del tipo del mensaje, configuramos el mensaje.
		switch ($tipo)
		{
			// El mensaje es una recomendaci�n.
			case 1: $contenido = "RECOMENDACION DE ESTE WEB\nRECOMENDACION SITIO WEB ESCUELA INGENIERIA EN COMPUTACION ULS\n===============================================================\n" . $this->comentario . "\n===============================================================\nEsperamos que tu paso por nuestro sitio sea muy provechoso.\nCopyright (C) " . date("Y") . " Escuela Ingenier�a en Computaci�n de la ULS\nhttp://www.escuelaingecomp.tk"; break;
			// El mensaje es un recordatorio de clave.
			case 2: $contenido = "RECORDATORIO DE CLAVE\nREGISTRO SITIO WEB ESCUELA INGENIERIA EN COMPUTACION ULS\n========================================================\n" . $this->comentario . "\n========================================================\nEsperamos que disfrutes de nuestros servicios.\nCopyright (C) " . date("Y") . " Escuela Ingenier�a en Computaci�n de la ULS\nhttp://www.escuelaingecomp.tk"; break;
			// El mensaje es una respuesta a una consulta.
			case 3: $contenido = "RESPUESTA DE MENSAJE\nRESPUESTA DESDE SITIO WEB ESCUELA INGENIERIA EN COMPUTACION ULS\n===============================================================\n" . $this->comentario . "\n===============================================================\nEsperamos que disfrutes de nuestros servicios.\nCopyright (C) " . date("Y") . " Escuela Ingenier�a en Computaci�n de la ULS\nhttp://www.escuelaingecomp.tk"; break;
		}
		
		// Enviamos el mensaje.
		mail($this->destino, $this->asunto, $contenido, $adicional);
	}
}
?>