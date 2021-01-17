<?PHP
/**
 * puntaje.php.
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
 * Clase que maneja los registros de los puntajes de ingreso anuales existentes en la base
 * de datos 'ingecomp'. Los puntajes que se manejan son los m�nimos, promedios y m�ximos
 * por a�o. Adem�s contiene los m�todos que calculan el puntaje ponderado de ingreso a la
 * carrera Ingenier�a en Computaci�n.
 */

class puntaje
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * M�todo constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param link Enlace a la base de datos.
	 */
	function puntaje($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que muestra los puntajes de ingreso m�s recientes, correspondientes al tipo
	 * de ingreso especificado.
	 */
	function mostrar()
	{
		// Obtenemos el mayor a�o.
		$anio = $this->anioMayor();
		
		// Obtenemos los puntajes del a�o anteriormente especificado.
		$historial = $this->puntajes($anio);
		
		// Abrimos la tabla para mostrar los puntajes.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
		
		// Mostramos el puntaje m�nimo, con su respectivo a�o.
		printf("<TR>");
		printf("<TD CLASS='contenido'><B>Puntaje M&iacute;nimo (A&ntilde;o %d)</B></TD>", $anio);
		printf("</TR>");
		printf("<TR>");
		printf("<TD CLASS='contenido'>%0.2f puntos.</TD>", $historial[0]);
		printf("</TR>");
		printf("<TR><TD>&nbsp;</TD></TR>");
		
		// Mostramos el puntaje promedio, con su respectivo a�o.
		printf("<TR>");
		printf("<TD CLASS='contenido'><B>Puntaje Promedio (A&ntilde;o %d)</B></TD>", $anio);
		printf("</TR>");
		printf("<TR>");
		printf("<TD CLASS='contenido'>%0.2f puntos.</TD>", $historial[1]);
		printf("</TR>");
		printf("<TR><TD>&nbsp;</TD></TR>");
		
		// Mostramo el puntaje m�ximo, con su respectivo a�o.
		printf("<TR>");
		printf("<TD CLASS='contenido'><B>Puntaje M&aacute;ximo (A&ntilde;o %d)</B></TD>", $anio);
		printf("</TR>");
		printf("<TR>");
		printf("<TD CLASS='contenido'>%0.2f puntos.</TD>", $historial[2]);
		printf("</TR>");
		
		// Cerramos la tabla.
		echo "</TABLE>";
	}
	
	/**
	 * M�todo que retorna el a�o mayor de la tabla 'puntaje' que tenga datos de puntajes
	 * m�nimos, m�ximos y promedios.
	 *
	 * @return anio El a�o mayor que tiene datos.
	 */
	function anioMayor()
	{
		// Consulta que captura el a�o mas reciente que tiene puntajes.
		$consulta = "SELECT MAX(anio_puntaje) AS anio_mayor FROM puntaje WHERE minimo_puntaje <> 0 AND promedio_puntaje <> 0 AND maximo_puntaje <> 0";
		$resultado = mysql_query($consulta, $this->enlace);
		$anio = mysql_result($resultado, 0, "anio_mayor");
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
		
		return $anio;
	}
	
	/**
	 * M�todo que retorna un arreglo (m�nimo, promedio y m�ximo) con los puntajes de un
	 * a�o en espec�fico.
	 *
	 * @param anio El a�o en donde se muestra los puntajes.
	 *
	 * @return historial El areglo con los puntajes de ingreso.
	*/
	function puntajes($anio)
	{
		// Consulta para sacar los puntajes del a�o.
		$consulta = "SELECT minimo_puntaje, promedio_puntaje, maximo_puntaje FROM puntaje WHERE anio_puntaje = $anio";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Creamos un arreglo con el historial de los puntajes.
		$historial = array(mysql_result($resultado, 0, "minimo_puntaje"), mysql_result($resultado, 0, "promedio_puntaje"), mysql_result($resultado, 0, "maximo_puntaje"));
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
		
		return $historial;
	}
	
	/**
	 * M�todo que muestra el t�tulo de la secci�n 'C�lculo de Puntaje'.
	 */
	function tituloCalculoPuntaje()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Admisi&oacute;n'>Admisi&oacute;n</A> / <A HREF='index.php' TITLE='Ver C&aacute;lculo Puntaje'>C&aacute;lculo Puntaje</A> / Resultados";
		$imagen = "activos/bgcalculopuntaje.jpg";
		$titulo = "Resultados C&aacute;lculo Puntaje";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * M�todo en donde se calcula el puntaje de ingreso ponderado y se muestran los resultados
	 * obtenidos. Este resultado es comparado con los puntajes de a�os pasados y se estima la
	 * posibilidad de que el usuario tenga una buena chance de ingresar a la carrera. Tambi�n
	 * se muestran los puntajes con los cuales fueron comparados los resultados.
	 *
	 * @param nota La nota de ense�anza media.
	 * @param region La regi�n del pa�s de procedencia.
	 * @param preferencia La preferencia a la ULS.
	 * @param lenguaje El puntaje en la PSU lenguaje.
	 * @param matematicas El puntaje en la PSU matem�ticas.
	 * @param ciencias El puntaje en la PSU ciencias.
	 * @param tipo_ingreso El identificador del tipo de ingreso.
	 */
	function calcular($nota, $region, $preferencia, $lenguaje, $matematicas, $ciencias)
	{
		// Abrimos la tabla para los resultados.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
  	echo "<TR>";
    echo "<TD WIDTH='60%' CLASS='contenido' VALIGN='top'><P>Tu puntaje final de ingreso a la carrera de Ingenier&iacute;a en Computaci&oacute;n de la ULS es de ";
		
		// Obtenemos el mayor a�o que registra puntajes.
		$anio = $this->anioMayor();
		
		// Obtenemos los puntajes del a�o anteriormente especificado.
		$historial = $this->puntajes($anio);
		
		// Capturamos los valores de los puntajes.
		$minimo = $historial[0];
		$promedio = $historial[1];
		$maximo = $historial[2];
		
		// F�rmula para el c�lculo del puntaje ponderado.
		$ponderado = 100*0.3*$nota + 0.25*$lenguaje + 0.25*$matematicas + 0.2*$ciencias;
		
		// Asignaci�n de la bonificaci�n por preferencia.
		switch ($preferencia)
		{
			case 1: $adicional = $ponderado+30; break;
			case 2: $adicional = $ponderado+20; break;
			case 3: $adicional = $ponderado+10; break;
			default: $adicional = $ponderado; break;
		}
		
		// Asignaci�n de la bonificaci�n por regi�n de procedencia.
		if ($region == 4)
			$adicional+=10;
		
		// Imprimimos el puntaje ponderado.
		printf("<B>$adicional puntos.</B></P>");
		
		// Imprimimos donde el rango en donde se encuentra el puntaje ponderado.
		if ($ponderado < 450)
			printf("<B>��Te fue mal!!</B> Tu puntaje est&aacute; por debajo del puntaje m&iacute;nimo de ingreso exigido por la Universidad de La Serena.");
		else
			if ($adicional > $maximo)
				printf("<B>��Te fue excelente!!</B> Comparado con el a&ntilde;o %d, tu puntaje est&aacute; sobre el puntaje m&aacute;ximo de ingreso a la carrera.", $anio);
			else
				if ($adicional < $minimo)
		    	printf("<B>��Te fue regular!!</B> Comparado con el a&ntilde;o %d, tu puntaje est&aacute; por debajo del puntaje m&iacute;nimo de ingreso a la carrera.", $anio);
				else printf("<B>��Te fue bien!!</B> Comparado con el a&ntilde;o %d, tu puntaje est&aacute; entre el rango de puntajes m&iacute;nimos y m&aacute;ximos de ingreso a la carrera.", $anio);   
		
		// Imprimimos otros datos.
		echo "</TD>";
    echo "<TD WIDTH='40%' ALIGN='center'><IMG SRC='activos/logouls.gif' WIDTH='99' HEIGHT='100'></TD>";
  	echo "</TR>";
  	echo "<TR>";
    echo "<TD COLSPAN='2'>&nbsp;</TD>";
  	echo "</TR>";
  	echo "<TR>";
    echo "<TD COLSPAN='2' CLASS='contenido'>Puntaje M&iacute;nimo de ingreso a la ULS: <FONT COLOR='#CC0000'>450 puntos.</FONT></TD>";
		echo "</TR>";
  	echo "<TR>";
    echo "<TD COLSPAN='2' CLASS='contenido'>Puntaje M&iacute;nimo de ingreso a la carrera (A&ntilde;o $anio): <FONT COLOR='#CC0000'>$minimo puntos.</FONT></TD>";
  	echo "</TR>";
  	echo "<TR>";
    echo "<TD COLSPAN='2' CLASS='contenido'>Puntaje Promedio de ingreso a la carrera (A&ntilde;o $anio): <FONT COLOR='#CC0000'>$promedio puntos.</FONT></TD>";
		echo "</TR>";
  	echo "<TR>";
    echo "<TD COLSPAN='2' CLASS='contenido'>Puntaje M&aacute;ximo de ingreso a la carrera (A&ntilde;o $anio): <FONT COLOR='#CC0000'>$maximo puntos.</FONT></TD>";
		echo "</TR>";
  	echo "<TR>";
    echo "<TD COLSPAN='2'>&nbsp;</TD>";
  	echo "</TR>";
  	echo "<TR>";
    echo "<TD COLSPAN='2' ALIGN='center'><A HREF='index.php' TITLE='Volver a C&aacute;lculo Puntaje'><IMG SRC='../../librerias/btvolver.gif' WIDTH='50' HEIGHT='16' BORDER='0'></A></TD>";
		echo "</TR>";
		echo "</TABLE>";
	}
}
?>