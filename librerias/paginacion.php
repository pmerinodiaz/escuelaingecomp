<?PHP
/**
 * paginacion.php.
 * v. 1.0.
 * Diciembre, 2004.
 *
 * Copyright (C) 2004 por H�ctor D�az D�az - Patricio Merino D�az.
 * Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile.
 * Todos los derechos reservados.
 *
 * No se asume ninguna  responsabilidad por el  uso o  alteraci�n  de este software.
 * Este software se proporciona como es y sin garant�a de ning�n tipo de su funcionamiento
 * y en ning�n caso ser� el autor responsable de da�os o perjuicios que se deriven del mal
 * uso del software, a�n cuando este haya sido notificado de la posibilidad de dicho da�o.
 *
 * Clase que contiene los m�todos que permiten paginar los resultados obtenidos de una
 * consulta efectuada a una tabla. La paginaci�n corresponde a la divisi�n en una cantidad
 * n de p�ginas con m registros, para mostrar los resultados de una consulta que tiene a
 * lo sumo m*n registros.
 */

class paginacion
{
	// El n�mero total de registros arrojados por la consulta.
	var $total;
	
	// El n�mero de la p�gina en el cual se encuentra el usuario.
	var $pagina;
	
	// El link a la p�gina destino.
	var $enlace;
	
	// La cantidad de registros que se muestra por p�gina.
	var $porpagina;
	
	/**
	 * M�todo constructor que inicializa los valores de los atributos de la clase.
	 *
	 * @param $total El n�mero total de registros arrojados por la consulta.
	 * @param $pagina El n�mero de la p�gina en el cual se encuentra el usuario.
	 * @param $enlace El link a la p�gina destino.
	 * @param $porpagina La cantidad de registros que se muestra por p�gina.
	 */
	function paginacion($total, $pagina, $enlace, $porpagina)
	{
		$this->total = $total;
		$this->pagina = $pagina;
		$this->enlace = $enlace;
		$this->porpagina = $porpagina;
	}
	
	/**
	 * M�todo que permite dividir un total de p�ginas en partes, las cuales pueden ser
	 * navegadas a trav�s de links (esto es llamado 'paginar').
	 *
	 * @return $texto El texto que contiene la paginaci�n y sus v�nculos.
	 */
	function paginar()
	{
		// Texto donde se guardan los links.
		$texto = "";
		
		// Le agregamos el link a la p�gina de inicio y a la anterior.
		$texto = $texto.$this->inicio($this->pagina, $this->enlace).$this->anterior($this->pagina, $this->enlace);
		
		// P�ginaci�n del total de p�ginas.
		for ($i=1; $i<=$this->total; $i+=$this->porpagina) 
		{
			$item = (int) ($i/$this->porpagina + 1);
			if ($item != $this->pagina)
				$texto = $texto."<A HREF='".$this->enlace."pagina=".$item."' TITLE='Ver P&aacute;gina ".$item."'>".$item."</A> ";
			else $texto = $texto.$item." ";
		}
		
		// Le agregamos el link a la p�gina siguiente y a la �ltima.
		$texto = $texto.$this->siguiente($this->pagina, $item, $this->enlace).$this->fin($this->pagina, $item, $this->enlace);
		
		// Retornamos el texto.
		return $texto;
	}
	
	/**
	 * M�todo que devuelve el men� de navegaci�n de los resultados de una consulta.
	 * Consiste en los links para adelante y para atr�s en el sistema de paginaci�n.
	 *
	 * @return $texto El texto que contiene la navegaci�n y sus v�nculos.
	 */
	function navegar()
	{
		// Texto donde se guarda la navegaci�n.
		$texto = "";
		
		// Calculamos el n�mero de p�ginas.
		for ($i=1; $i<=$this->total; $i+=$this->porpagina) 
		$item = (int) ($i/$this->porpagina + 1);
		
		// Generamos la navegaci�n.
		$texto = $this->anterior($this->pagina, $this->enlace).$this->siguiente($this->pagina, $item, $this->enlace);
		
		// Devolvemos el texto generado.
		return $texto;
	}
	
	/**
	 * M�todo que entrega el link a la primera p�gina de la paginaci�n total que se hace.
	 *
	 * @return $texto El texto que contiene el v�nculo al inicio.
	 */
	function inicio($pagina_actual, $link)
	{
		// Texto en donde guardamos el link.
		$texto = "";
		
		// La p�gina anterior.
		$pagina_anterior = $pagina_actual - 1;
		
		// Vemos el link.
		if ($pagina_actual == 1)
			$texto = $texto."|<< ";
		else $texto = $texto."<A HREF='".$link."pagina=1' TITLE='Ver Primera P&aacute;gina'>|<<</A> ";
	
		// Retornamos el texto.
		return $texto;		
	}
	
	/**
	 * M�todo que entrega el link a la p�gina anterior de la p�gina actual en la paginaci�n
	 * total.
	 *
	 * @return $texto El texto que contiene el v�nculo al anterior.
	 */
	function anterior($pagina_actual, $link)
	{
		// Texto en donde guardamos el link.
		$texto = "";
		
		// La p�gina anterior.
		$pagina_anterior = $pagina_actual - 1;
		
		// Vemos el link.
		if ($pagina_actual == 1)
			$texto = $texto."<< ";
		else $texto = $texto."<A HREF='".$link."pagina=$pagina_anterior' TITLE='Ver P&aacute;gina Anterior'><<</A> ";
		
		// Retornamos el texto
		return $texto;
	}
	
	/**
	 * M�todo que entrega el link a la siguiente p�gina de la p�gina actual en la paginaci�n total.
	 *
	 * @return $texto El texto que contiene el v�nculo al siguiente.
	 */
	function siguiente($pagina_actual, $todas, $link)
	{
		// Texto en donde guardamos el link.
		$texto = "";
		
		// La siguiente p�gina.
		$pagina_siguiente = $pagina_actual + 1;
		
		// Vemos el link.
		if ($pagina_actual == $todas)
			$texto = $texto.">> ";
		else $texto = $texto."<A HREF='".$link."pagina=$pagina_siguiente' TITLE='Ver Siguiente P&aacute;gina'>>></A> ";
		
		// Retornamos el texto.
		return $texto;
	}
	
	/**
	 * M�todo que entrega el link a la �ltima p�gina de la paginaci�n total que se hace.
	 *
	 * @return $texto El texto que contiene el v�nculo al fin.
	 */
	function fin($pagina_actual, $todas, $link)
	{
		// Texto en donde guardamos el link.
		$texto = "";
		
		// La siguiente p�gina.
		$pagina_siguiente = $pagina_actual + 1;
		
		// Vemos el link.
		if ($pagina_actual == $todas)
			$texto = $texto.">>| ";
		else $texto = $texto."<A HREF='".$link."pagina=$todas' TITLE='Ver &Uacute;ltima P&aacute;gina'>>>|</A>";
		
		// Retornamos el texto.
		return $texto;
	}
}
?>