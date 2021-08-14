<?PHP
/**
 * error.php.
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
 * Clase que proporciona un listado de errorres clasificados y controlados (llamadas excepciones)
 * que son manejados en todo el sitio Web. Los mensajes de los errores son mostrados en la página
 * Web donde ocurrió el error con el motivo de hacerle notar al usuario el fallo ocurrido. Esto
 * para que el mismo ingrese datos válidos en el sitio Web.
 */

class error
{
	// El tipo de error ocurrido.
	var $tipo_error;
	
	// El nivel de directorios dentro del sitio.
	var $nivel;
	
	// El vínculo (link) de destino.
	var $vinculo;
	
	/**
	 * Método constructor que setea los valores de todos los atributos de la clase.
	 *
	 * @param tipo_error El tipo de error ocurrido.
	 * @param nivel El nivel de directorios dentro del sitio.
	 * @param vinculo El vínculo (link) de destino.
	 */
	function error($tipo_error, $nivel, $vinculo)
	{
		$this->tipo_error = $tipo_error;
		$this->nivel = $nivel;
		$this->vinculo = $vinculo;
	}
	
	/**
	 * Método que imprime el título con del error ocurrido.
	 */
	function mostrarTitulo()
	{
		$ubicacion = "&nbsp;";
		$titulo = "Error";
		$imagen = $this->nivel . "librerias/bgerror.gif";
		$pixel = $this->nivel . "librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra el tipo de error ocurrido y las posibles recomedaciones
	 * al usuario para que corrija el error.
	 */
	function mostrar()
	{
		$mensaje = "";
		$recomendacion = "";
		
		// Mostramos diferentes mensajes, según el tipo de error.
		switch ($this->tipo_error)
		{
			// Cuando falta algún parámetro enviado en la URL.
			case 1:
			{
				$mensaje = "No se encuentra la p&aacute;gina.";
				$recomendacion = "Puede que hayas accedico a esta p&aacute;gina alterando los valores de los par&aacute;metros que se escriben en la barra de direcciones.";
				break;
			}
			// Cuando alguna variable del formulario no existe.
			case 2:
			{
				$mensaje = "Los datos del formulario no existen.";
				$recomendacion = "Puede que hayas accedico a esta p&aacute;gina sin antes haber ingresado tus datos en la p&aacute;gina <A HREF='$this->vinculo' TITLE='Ver $this->vinculo'>$this->vinculo</A>.";
				break;
			}
			// Cuando algún parámetro enviado en la URL es incorrecto.
			case 3:
			{
				$mensaje = "No se encuentra la p&aacute;gina.";
				$recomendacion = "";
				break;
			}
		}
		
		// Tabla en donde imprimimos más detalles del error ocurrido.
		printf("<TABLE WIDTH='%s' BORDER='0'>", "100%");
		printf("<TR><TD CLASS='contenido'><B>%s</B></TD></TR>", $mensaje);
		printf("<TR><TD>&nbsp;</TD></TR>");
		printf("<TR><TD CLASS='contenido'>%s</TD></TR>", $recomendacion);
		printf("<TR><TD>&nbsp;</TD></TR>");
		printf("<TR><TD><IMG SRC='%slibrerias/pxgris.gif' WIDTH='455' HEIGHT='1'></TD></TR>", $this->nivel);
		printf("<TR><TD>&nbsp;</TD></TR>");
		printf("<TR><TD CLASS='contenido'>");
		printf("<P>Pruebe lo siguiente:</P>");
		printf("<UL>");
		printf("<LI>Si escribi&oacute; la direcci&oacute;n de la p&aacute;gina en la barra de direcciones, compruebe haber ingresado sus datos anteriormente en la p&aacute;gina que contiene el formulario.</LI>");
		printf("<LI>Si escribi&oacute; la direcci&oacute;n de la p&aacute;gina en la barra de direcciones, compruebe que la ha escrito correctamente.</LI>");
		printf("<LI>Abra la p&aacute;gina principal del sitio <A HREF='%shome/index.php' TITLE='Ver Home'>Home</A> y busque v&iacute;nculos a la información que desee.</LI>", $this->nivel);
		printf("<LI>Haga clic en el bot&oacute;n <A HREF=\"javascript:history.back(1);\" TITLE='Atr&aacute;s'>Atr&aacute;s</A> para probar otro v&iacute;nculo.</LI>");
		printf("</UL>");
		printf("</TD></TR>");
		printf("<TR><TD>&nbsp;</TD></TR>");
		printf("<TR><TD><IMG SRC='%slibrerias/pxgris.gif' WIDTH='455' HEIGHT='1'></TD></TR>", $this->nivel);
		printf("<TR><TD>&nbsp;</TD></TR>");
		printf("<TR><TD CLASS='contenido'>");
		printf("<P>Informaci&oacute;n t&eacute;cnica del persona de soporte de este sitio:</P>");
		printf("<UL>");
		printf("<LI>M&aacute;s informaci&oacute;n:<BR><A HREF='mailto:escuelaingecomp@gmail.com' TITLE='escuelaingecomp@gmail.com'>Soporte T&eacute;cnico del Sitio</A>.</LI>");
		printf("</UL>");
		printf("</TD></TR>");
		printf("</TABLE>");
	}
}
?>