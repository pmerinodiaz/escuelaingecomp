<?PHP
/**
 * requisitoingreso.php.
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
 * Clase que administra los requisitos de los ingresos a la carrera. Los requisitos de
 * ingreso son las condiciones que se les piden a los postulante a la carrera el primer a�o
 * que ingresan a la carrera.
 */

class requisitoingreso
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * M�todo constructor que inicializa el enlace de la base de datos.
	 *
	 * @param link Enlace a la base de datos.
	 */
	function requisitoingreso($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que muestra los requisitos de un tipo de ingreso en espec�fico.
	 *
	 * @param id_tipo_ingreso El identificador del tipo de ingreso.
	 */
	function mostrar($id_tipo_ingreso)
	{
		// Librerias necesarias.
		include("tipoingreso.php");
		
		// Consulta que lista los requisitos de un tipo de ingreso.
		$consulta = "SELECT desc_requisito_ingreso, porcentaje_requisito_ingreso FROM requisito_ingreso WHERE id_tipo_ingreso = $id_tipo_ingreso ORDER BY porcentaje_requisito_ingreso DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Creamos un objeto tipoingreso y capturamos el nombre del tipo.
		$ingreso = new tipoingreso($this->enlace);
		$tipo = $ingreso->nombre($id_tipo_ingreso);
		
		// Abrimos la tabla para mostrar los requisitos.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Requisitos de Ingreso $tipo</B></TD>";
		echo "</TR>";
		
		// Cuando no hay requisitos.
		if ($total == 0)
		{
			echo "<TR>";
			echo "<TD CLASS='contenido'>No hay requisitos para la $tipo.</TD>";
			echo "</TR>";
		}
		
		// Cuando hay requisitos.
		else
		{
			// Ciclo en donde imprimimos los requisitos.
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				printf("<TD CLASS='contenido'>%s %0.1f%s</TD>", $tupla["desc_requisito_ingreso"], $tupla["porcentaje_requisito_ingreso"], "%");
				printf("</TR>");
			}
		}
		
		// Cerramos la tabla.
		echo "</TABLE>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
}
?>