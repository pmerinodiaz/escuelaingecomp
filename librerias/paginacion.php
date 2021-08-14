<?PHP
/**
 * paginacion.php.
 * v. 1.0.
 * Diciembre, 2004.
 *
 * Copyright (C) 2004 por Héctor Díaz Díaz - Patricio Merino Díaz.
 * Escuela Ingeniería en Computación, Universidad de La Serena, Chile.
 * Todos los derechos reservados.
 *
 * No se asume ninguna  responsabilidad por el  uso o  alteración  de este software.
 * Este software se proporciona como es y sin garantía de ningún tipo de su funcionamiento
 * y en ningún caso será el autor responsable de daños o perjuicios que se deriven del mal
 * uso del software, aún cuando este haya sido notificado de la posibilidad de dicho daño.
 *
 * Clase que contiene los métodos que permiten paginar los resultados obtenidos de una
 * consulta efectuada a una tabla. La paginación corresponde a la división en una cantidad
 * n de páginas con m registros, para mostrar los resultados de una consulta que tiene a
 * lo sumo m*n registros.
 */

class paginacion
{
	// El número total de registros arrojados por la consulta.
	var $total;
	
	// El número de la página en el cual se encuentra el usuario.
	var $pagina;
	
	// El link a la página destino.
	var $enlace;
	
	// La cantidad de registros que se muestra por página.
	var $porpagina;
	
	/**
	 * Método constructor que inicializa los valores de los atributos de la clase.
	 *
	 * @param $total El número total de registros arrojados por la consulta.
	 * @param $pagina El número de la página en el cual se encuentra el usuario.
	 * @param $enlace El link a la página destino.
	 * @param $porpagina La cantidad de registros que se muestra por página.
	 */
	function paginacion($total, $pagina, $enlace, $porpagina)
	{
		$this->total = $total;
		$this->pagina = $pagina;
		$this->enlace = $enlace;
		$this->porpagina = $porpagina;
	}
	
	/**
	 * Método que permite dividir un total de páginas en partes, las cuales pueden ser
	 * navegadas a través de links (esto es llamado 'paginar').
	 *
	 * @return $texto El texto que contiene la paginación y sus vínculos.
	 */
	function paginar()
	{
		// Texto donde se guardan los links.
		$texto = "";
		
		// Le agregamos el link a la página de inicio y a la anterior.
		$texto = $texto.$this->inicio($this->pagina, $this->enlace).$this->anterior($this->pagina, $this->enlace);
		
		// Páginación del total de páginas.
		for ($i=1; $i<=$this->total; $i+=$this->porpagina) 
		{
			$item = (int) ($i/$this->porpagina + 1);
			if ($item != $this->pagina)
				$texto = $texto."<A HREF='".$this->enlace."pagina=".$item."' TITLE='Ver P&aacute;gina ".$item."'>".$item."</A> ";
			else $texto = $texto.$item." ";
		}
		
		// Le agregamos el link a la página siguiente y a la última.
		$texto = $texto.$this->siguiente($this->pagina, $item, $this->enlace).$this->fin($this->pagina, $item, $this->enlace);
		
		// Retornamos el texto.
		return $texto;
	}
	
	/**
	 * Método que devuelve el menú de navegación de los resultados de una consulta.
	 * Consiste en los links para adelante y para atrás en el sistema de paginación.
	 *
	 * @return $texto El texto que contiene la navegación y sus vínculos.
	 */
	function navegar()
	{
		// Texto donde se guarda la navegación.
		$texto = "";
		
		// Calculamos el número de páginas.
		for ($i=1; $i<=$this->total; $i+=$this->porpagina) 
		$item = (int) ($i/$this->porpagina + 1);
		
		// Generamos la navegación.
		$texto = $this->anterior($this->pagina, $this->enlace).$this->siguiente($this->pagina, $item, $this->enlace);
		
		// Devolvemos el texto generado.
		return $texto;
	}
	
	/**
	 * Método que entrega el link a la primera página de la paginación total que se hace.
	 *
	 * @return $texto El texto que contiene el vínculo al inicio.
	 */
	function inicio($pagina_actual, $link)
	{
		// Texto en donde guardamos el link.
		$texto = "";
		
		// La página anterior.
		$pagina_anterior = $pagina_actual - 1;
		
		// Vemos el link.
		if ($pagina_actual == 1)
			$texto = $texto."|<< ";
		else $texto = $texto."<A HREF='".$link."pagina=1' TITLE='Ver Primera P&aacute;gina'>|<<</A> ";
	
		// Retornamos el texto.
		return $texto;		
	}
	
	/**
	 * Método que entrega el link a la página anterior de la página actual en la paginación
	 * total.
	 *
	 * @return $texto El texto que contiene el vínculo al anterior.
	 */
	function anterior($pagina_actual, $link)
	{
		// Texto en donde guardamos el link.
		$texto = "";
		
		// La página anterior.
		$pagina_anterior = $pagina_actual - 1;
		
		// Vemos el link.
		if ($pagina_actual == 1)
			$texto = $texto."<< ";
		else $texto = $texto."<A HREF='".$link."pagina=$pagina_anterior' TITLE='Ver P&aacute;gina Anterior'><<</A> ";
		
		// Retornamos el texto
		return $texto;
	}
	
	/**
	 * Método que entrega el link a la siguiente página de la página actual en la paginación total.
	 *
	 * @return $texto El texto que contiene el vínculo al siguiente.
	 */
	function siguiente($pagina_actual, $todas, $link)
	{
		// Texto en donde guardamos el link.
		$texto = "";
		
		// La siguiente página.
		$pagina_siguiente = $pagina_actual + 1;
		
		// Vemos el link.
		if ($pagina_actual == $todas)
			$texto = $texto.">> ";
		else $texto = $texto."<A HREF='".$link."pagina=$pagina_siguiente' TITLE='Ver Siguiente P&aacute;gina'>>></A> ";
		
		// Retornamos el texto.
		return $texto;
	}
	
	/**
	 * Método que entrega el link a la última página de la paginación total que se hace.
	 *
	 * @return $texto El texto que contiene el vínculo al fin.
	 */
	function fin($pagina_actual, $todas, $link)
	{
		// Texto en donde guardamos el link.
		$texto = "";
		
		// La siguiente página.
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