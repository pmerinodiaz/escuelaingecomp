<?PHP
/**
 * arancel.php.
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
 * Clase que maneja los registros de los aranceles anuales existentes en la base de datos.
 * El arancel corresponde al valor monetario que tiene la carrera Ingeniería en Computación
 * de la ULS en forma anual.
 */

class arancel
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Método constructor donde inicializamos el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function arancel($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que muestra el valor del arancel anual más reciente existente en la base de
	 * datos.
	 */
	function mostrar()
	{
		// Consulta que captura el año mas reciente que tenda valor de precio en la base de datos.
		$consulta = "SELECT MAX(anio_arancel) AS anio FROM arancel WHERE precio_arancel <> 0";
		$resultado = mysql_query($consulta, $this->enlace);
		$anio = mysql_result($resultado, 0, "anio");
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
		
		// Consulta para sacar el precio del arancel del año capturando anteriormente.
		$consulta = "SELECT precio_arancel FROM arancel WHERE anio_arancel = $anio";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos la tabla para mostrar el arancel.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
		
		// Mostramos el arancel con su respectivo año.
		printf("<TR>");
		printf("<TD CLASS='contenido'><B>Arancel Anual (A&ntilde;o %d)</B></TD>", $anio);
		printf("</TR>");
		printf("<TR>");
		printf("<TD CLASS='contenido'>\$%0.0f pesos chilenos.</TD>", mysql_result($resultado, 0, "precio_arancel"));
		printf("</TR>");
		
		// Cerramos la tabla.
		echo "</TABLE>";
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que muestra el formulario de ingreso de un nuevo arancel.
	 */
	function formularioAgregar()
	{
		// Capturamos el año siguiente.
		$anio_siguiente = date("Y") + 1;
		
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Agregar Arancel</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>";
		echo "<TABLE WIDTH='100%' BORDER='1' CELLPADDING='0' CELLSPACING='0' BORDERCOLOR='#F1F1F1' MM_NOCONVERT='TRUE' BGCOLOR='#FFFFFF'>";
		echo "<TR>";
		echo "<TD>";
		echo "<FORM ACTION='grabar.php' METHOD='post' NAME='formulario' onSubmit='return validarFormulario();'>";
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>A&ntilde;o:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='anio' CLASS='formtextfield' MAXLENGTH='4' TABINDEX='1' VALUE='".$anio_siguiente."' TITLE='A&ntilde;o del arancel'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Precio ($):</TD>";
		echo "<TD><INPUT TYPE='text' NAME='precio' CLASS='formtextfield' MAXLENGTH='10' TABINDEX='1' TITLE='Precio del arancel'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido'>&nbsp;<FONT COLOR='#CC0000'>*</FONT> Datos obligatorios</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'>";
		echo "<INPUT TYPE='submit' NAME='agregar' VALUE='Agregar' CLASS='formbutton' TABINDEX='1' TITLE='Agregar el arancel anual'> ";
		echo "<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
		echo "</FORM>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
	}
	
	/**
	 * Método que agrega un nuevo arancel anual a la base de datos.
	 *
	 * @param $anio_arancel El año del arancel.
	 * @param $precio_arancel El precio del arancel.
	 */
	function agregar($anio_arancel, $precio_arancel)
	{
		// Consulta para agregar el arancel.
		$consulta = "INSERT INTO arancel(anio_arancel, precio_arancel) VALUES($anio_arancel, $precio_arancel)";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de éxito de la operación.
		echo "<P ALIGN='center' CLASS='contenido'><B>EL ARANCEL HA SIDO INGRESADO EXITOSAMENTE</B></P>";
		echo "<P CLASS='contenido'>Este arancel anual de la carrera estar&aacute; disponible en la secci&oacute;n \"Postulaci&oacute;n a la Carrera\" dentro de nuestro sitio Web, para que cualquier persona de Chile y el mundo lo vea. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
	
	/**
	 * Método que lista todos los aranceles anuales existentes en la base de datos en la
	 * sección Intranet.
	 *
	 * @param $vinculo El vínculo de destino de la operación.
	 */
	function listar($vinculo)
	{
		// Consulta que obtiene los antecedentes de los aranceles.
		$consulta = "SELECT id_arancel, anio_arancel, precio_arancel FROM arancel ORDER BY anio_arancel";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);		
		
		// Cuando no hay aranceles.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay aranceles.</P>";
		
		// Cuando si hay aranceles.
		else
		{
			echo "<TABLE WIDTH='50%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='5' CLASS='contenido'>Hay un total de $total aranceles anuales:</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'>&nbsp;</TD>";
			echo "<TD WIDTH='45%' ALIGN='center' CLASS='titulotabla'><B>A&ntilde;o</B></TD>";
			echo "<TD WIDTH='45%' ALIGN='center' CLASS='titulotabla'><B>Precio ($)</B></TD>";
			echo "</TR>";
			
			// Texto para enlazar a la operación.
			if ($vinculo == "modificar.php")
				$texto_vinculo = "Modificar";
			else $texto_vinculo = "Eliminar";
			
			// Imprimimos la lista de aranceles.
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				printf("<TD ALIGN='center' CLASS='tabla' VALIGN='top'><A HREF='$vinculo?id=%s' TITLE='%s Arancel Anual'>%s</A></TD>", $tupla["id_arancel"], $texto_vinculo, $texto_vinculo);
				printf("<TD ALIGN='center' CLASS='tabla' VALIGN='top'>%d</TD>", $tupla["anio_arancel"]);
				printf("<TD ALIGN='center' CLASS='tabla' VALIGN='top'>%0.1f</TD>", $tupla["precio_arancel"]);
				printf("</TR>");
			}
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);	
	}
	
	/**
	 * Método que muestra el formulario de modificación de un arancel.
	 *
	 * @param $id_arancel El identificador del arancel.
	 */
	function formularioModificar($id_arancel)
	{
		// Consulta que obtiene los antecedentes del arancel con identificación conocida.
		$consulta = "SELECT anio_arancel, precio_arancel FROM arancel WHERE id_arancel = $id_arancel";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Tabla para modificar el arancel.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Modificar Arancel</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>";
		echo "<TABLE WIDTH='100%' BORDER='1' CELLPADDING='0' CELLSPACING='0' BORDERCOLOR='#F1F1F1' MM_NOCONVERT='TRUE' BGCOLOR='#FFFFFF'>";
		echo "<TR>";
		echo "<TD>";
		echo "<FORM ACTION='grabar.php' METHOD='post' NAME='formulario' onSubmit='return validarFormulario();'>";
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>A&ntilde;o:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='anio' CLASS='formtextfield' MAXLENGTH='4' TABINDEX='1' VALUE='".$tupla["anio_arancel"]."' TITLE='A&ntilde;o del arancel'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Precio ($):</TD>";
		printf("<TD><INPUT TYPE='text' NAME='precio' CLASS='formtextfield' MAXLENGTH='10' TABINDEX='1' VALUE='%0.2f' TITLE='Precio del arancel'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>", $tupla["precio_arancel"]);
		echo "</TR>";		
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido'>&nbsp;<FONT COLOR='#CC0000'>*</FONT> Datos obligatorios</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_arancel' VALUE='".$id_arancel."'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'>";
		echo "<INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar el arancel anual'>&nbsp;";
		echo "<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
		echo "</FORM>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
	}
	
	/**
	 * Método que modifica los datos de un arancel.
	 *
	 * @param $id_arancel El identificador del arancel.
	 * @param $anio_arancel El año del arancel.
	 * @param $precio_arancel El precio del arancel.
	 */
	function modificar($id_arancel, $anio_arancel, $precio_arancel)
	{
		// Consulta para actualizar la tabla 'arancel'.
		$consulta = "UPDATE arancel SET anio_arancel = $anio_arancel, precio_arancel = $precio_arancel WHERE id_arancel = $id_arancel";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de éxito de la operación.
		echo "<P ALIGN='center' CLASS='contenido'><B>EL ARANCEL ANUAL HA SIDO MODIFICADO EXITOSAMENTE</B></P>";	
		echo "<P CLASS='contenido'>Este arancel anual de la carrera estar&aacute; disponible en la secci&oacute;n \"Postulaci&oacute;n a la Carrera\" dentro de nuestro sitio Web, para que cualquier persona de Chile y el mundo lo vea. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
}
?>