<?PHP
/**
 * letras.php.
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
 * Clase que maneja varios métodos para gestionar el índice alfabético, con el cual
 * se enlaza al usuario a la página que contiene a los alumnos cuyo nombre comienza
 * con la letra seleccionada.
 */

class letras
{
	// Arreglo que contiene al abecedario.
	var $abecedario;
	
	/**
	 * Método constructor que setea el valor del abecedario.
	 */
	function letras()
	{
		$this->abecedario = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "&Ntilde;", "O", "P", "Q", "R", "S", "T", "U", "V", "X", "Y", "Z");
	}
	
	/**
	 * Método que muestra todo el abecedario y enlaza al usuario a una página determinada,
	 * excepto en el caso de la letra que está activa.
	 *
	 * @param $pagina El enlace a la pagina de destino.
	 * @param $activa La letra en la que se encuentra ubicado el usuario.
	 */
	function mostrar($pagina, $activa)
	{
		// Imprimimos las letras con vínculo, excepto la activa.
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