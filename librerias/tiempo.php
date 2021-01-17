<?PHP
/**
 * tiempo.php.
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
	 * M�todo que retorna true cuando la fecha enviada como par�metro est� en el lapso de horas
	 * enviada como par�metro. En caso contrario, retorna false.
	 *
	 * @param $fecha_pasada La fecha inicial (pasada).
	 * @param $horas Las horas transcurridas desde la fecha inicial.
	 *
	 * @return true Cuando la fecha pasada est� dentro del lapso de horas.
	 * @return false Cuando la fecha pasada no est� dentro del lapso de horas.
	 */
	function entreLapso($fecha_pasada, $horas)
	{
		// Cuando la fecha pasada est� entre las hrs. indicadas.
		if ((strtotime($this->fecha_actual) - strtotime($fecha_pasada))/3600 <= $horas)
			return true;
		
		// Cuando la fecha pasada est� fuera de las hrs. indicadas.
		return false;
	}
}
?>