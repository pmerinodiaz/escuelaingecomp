<?PHP
/**
 * tiempo.php.
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
 * Clase que maneja la forma de medir el tiempo transcurrido entre dos tiempos, y que es
 * ocupada por algunas operaciones que necesitan saber esto para mostrar resultados no iguales.
 */

class tiempo
{
	// Alamacena la fecha actual del servidor.
	var $fecha_actual;
	
	/**
	 * Constrcutor que captura la fecha actual del sistema.
	 */
	function tiempo()
	{
		$this->fecha_actual = date("Y") . "-" . date("m") . "-" . date("d");
	}
	
	/**
	 * Método que retorna true cuando la fecha enviada como parámetro está en el lapso de horas
	 * enviada como parámetro. En caso contrario, retorna false.
	 *
	 * @param $fecha_pasada La fecha inicial (pasada).
	 * @param $horas Las horas transcurridas desde la fecha inicial.
	 *
	 * @return true Cuando la fecha pasada está dentro del lapso de horas.
	 * @return false Cuando la fecha pasada no está dentro del lapso de horas.
	 */
	function entreLapso($fecha_pasada, $horas)
	{
		// Cuando la fecha pasada está entre las hrs. indicadas.
		if ((strtotime($this->fecha_actual) - strtotime($fecha_pasada))/3600 <= $horas)
			return true;
		
		// Cuando la fecha pasada está fuera de las hrs. indicadas.
		return false;
	}
}
?>