<?PHP
/**
 * letras.php.
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
 * Clase que maneja varios m�todos para gestionar el �ndice alfab�tico, con el cual
 * se enlaza al usuario a la p�gina que contiene a los alumnos cuyo nombre comienza
 * con la letra seleccionada.
 */

class letras
{
	// Arreglo que contiene al abecedario.
	var $abecedario;
	
	/**
	 * M�todo constructor que setea el valor del abecedario.
	 */
	function letras()
	{
		$this->abecedario = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "&Ntilde;", "O", "P", "Q", "R", "S", "T", "U", "V", "X", "Y", "Z");
	}
	
	/**
	 * M�todo que muestra todo el abecedario y enlaza al usuario a una p�gina determinada,
	 * excepto en el caso de la letra que est� activa.
	 *
	 * @param $pagina El enlace a la pagina de destino.
	 * @param $activa La letra en la que se encuentra ubicado el usuario.
	 */
	function mostrar($pagina, $activa)
	{
		// Imprimimos las letras con v�nculo, excepto la activa.
		echo "<B>";
		for ($i=0; $i<count($this->abecedario); $i++)
		{
			if ($activa == $this->abecedario[$i])
				printf("<FONT COLOR='#CC0000'>%s </FONT>", $this->abecedario[$i]);
			else printf("<A HREF='%s?letra=%s&pagina=1' TITLE='Ver alumnos cuyo apellido paterno empieza con la letra %s'>%s</A> ", $pagina, $this->abecedario[$i], $this->abecedario[$i], $this->abecedario[$i]);
		}
		echo "</B>";
	}
}
?>