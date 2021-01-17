<?PHP
/**
 * cec.php.
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
 * Clase que administra los registros de los alumnos que integran el CEC de la Escuela
 * Ingeniería en Computación existentes en la Base de Datos. El CEC es el Centro de
 * Estudiantes de Computación y cada año lo componene nuevos alumnos.
 */

class cec
{
	// Enlace a la base de datos.
	var $enlace;
	
	// Juego de caracteres especiales del servidor.
	var $caracteres;		
	
	/**
	 * Método constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function cec($link)
	{
		$this->enlace = $link;
		$this->caracteres = get_html_translation_table(HTML_SPECIALCHARS);
	}
	
	/**
	 * Método que muestra un listado con todos los años en los cuales hay registros
	 * de directtivas del CEC.
	 */
	function mostrarAnio()
	{
		// Consulta que obtiene todos los años en que existe CEC.
		$consulta = "SELECT cec.anio_cec FROM cec, directorio_cec WHERE cec.id_cec = directorio_cec.id_cec GROUP BY cec.anio_cec ORDER BY cec.anio_cec DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay CEC.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay CEC.</P>";
		
		// Cuando si hay CEC.
		else
		{
			// Ciclo en donde recorremos los resultados y mostramos los años.
			printf("<UL>");
			while ($tupla = mysql_fetch_array($resultado))
			  printf("<LI><A HREF='cec.php?anio=%d' TITLE='Ver CEC del A&ntilde;o %d'>CEC del A&ntilde;o %d</A></LI>", $tupla["anio_cec"], $tupla["anio_cec"], $tupla["anio_cec"]);
			printf("</UL>");
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que muestra el título de la sección CEC.
	 */
	function titulo($anio)
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Integrantes'>Integrantes</A> / <A HREF='index.php' TITLE='Ver CEC'>CEC</A> / A&ntilde;o " . $anio;
		$imagen = "activos/bgcec.jpg";
		$titulo = "CEC del A&ntilde;o " . $anio;
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método en que muestran a los alumnos que integran el CEC de un año determinado.
	 *
	 * @param $anio El año del CEC.
	 */
	function mostrar($anio)
	{
		// Consulta que lista los alumnos del CEC de un año determinado.
		$consulta = "SELECT persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, directorio_cec.cargo_directorio_cec FROM persona, usuario_interno, alumno, directorio_cec, cec WHERE cec.anio_cec = $anio AND usuario_interno.id_estado_interno = 1 AND persona.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = alumno.id_persona AND alumno.id_persona = directorio_cec.id_persona AND directorio_cec.id_cec = cec.id_cec";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay alumnos en el CEC.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay alumnos del CEC.</P>";
		
		// Cuando hay alumnos en el CEC.
		else
		{
			echo "<P CLASS='contenido'>La Directiva del a&ntilde;o $anio est&aacute; constituida por los siguientes alumnos:</P>";
			
			// Tabla para la lista de alumnos integrantes del CEC.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD WIDTH='30%' CLASS='titulotabla' ALIGN='center'>Cargo</TD>";
			echo "<TD WIDTH='30%' CLASS='titulotabla' ALIGN='center'>Alumno</TD>";
			echo "<TD WIDTH='40%' CLASS='titulotabla' ALIGN='center'>E-mail</TD>";
			echo "</TR>";
			
			// Ciclo en donde recorremos a los alumnos integrantes del CEC.
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				
				// Mostramos el cargo.
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $tupla["cargo_directorio_cec"]);
				
				// Mostramos el nombre completo del alumno.
				$nombre = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $nombre);
				
				// Mostramos el e-mail del ayudante, si existe.
				if ($tupla["email_persona"])
				{
					$email = strtr($tupla["email_persona"], $this->caracteres);
					printf("<TD CLASS='tabla' VALIGN='top'><A HREF='mailto:%s' TITLE='%s'>%s</A></TD>", $email, $email, $email);
				}
				else printf("<TD CLASS='tabla' VALIGN='top'>&nbsp;</TD>");
				
				printf("</TR>");
			}
			
			// Imprimimos el fin de la tabla alumnos integrantes del CEC.
			echo "<TR><TD COLSPAN='3'>&nbsp;</TD></TR>";
			echo "<TR><TD COLSPAN='3' ALIGN='center'><A HREF='javascript:history.back(1);' TITLE='Volver'><IMG SRC='../../librerias/btvolver.gif' BORDER='0'></A></TD></TR>";
			echo "</TABLE>";
		}
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que muestra el formulario de modificación de los antecedentes del cargo
	 * de una persona en el CEC.
	 *
	 * @param $id_persona El identificador de la persona.
	 */
	function formularioCEC($id_persona)
	{
		// Capturamos el año actual.
		$anio = date("Y");
		
		// Consulta que obtiene el cargo del CEC del usuario con identificación conocida.
		$consulta = "SELECT directorio_cec.id_directorio_cec, directorio_cec.cargo_directorio_cec, persona.nombres_persona, persona.paterno_persona, persona.materno_persona FROM directorio_cec, cec, alumno, persona WHERE directorio_cec.id_persona = $id_persona AND cec.anio_cec = $anio AND directorio_cec.id_cec = cec.id_cec AND directorio_cec.id_persona = alumno.id_persona AND alumno.id_persona = persona.id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Imprimimos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Antecedentes CEC</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>";
		echo "<TABLE WIDTH='100%' BORDER='1' CELLPADDING='0' CELLSPACING='0' BORDERCOLOR='#F1F1F1' MM_NOCONVERT='TRUE' BGCOLOR='#FFFFFF'>";
		echo "<TR>";
		echo "<TD>";
		echo "<FORM ACTION='grabar.php' METHOD='post' NAME='formulario' onSubmit='return validarFormulario();' ENCTYPE='multipart/form-data'>";
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>Cargo en CEC ".$anio.":</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='cargo' CLASS='formtextfield' MAXLENGTH='50' TABINDEX='1' TITLE='Cargo en CEC ".$anio."' VALUE='".$tupla["cargo_directorio_cec"]."'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Alumno:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='alumno' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' DISABLED VALUE='".$tupla["nombres_persona"]." ".$tupla["paterno_persona"]." ".$tupla["materno_persona"]."'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_directorio_cec' VALUE='".$tupla["id_directorio_cec"]."'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido'>&nbsp;<FONT COLOR='#CC0000'>*</FONT> Datos obligatorios</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'>";
		echo "<INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar los antecedentes CEC'>&nbsp;";
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
	 * Método que actualiza los datos de un alumno que tiene un cargo en el CEC.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_directorio_cec El identificador del directorio del CEC.
	 * @param $cargo El nombre del cargo.
	 */
	function actualizar($id_persona, $id_directorio_cec, $cargo)
	{
		// Consulta para actualizar los datos de la tabla 'directorio_cec'.
		$consulta = "UPDATE directorio_cec SET cargo_directorio_cec = '$cargo' WHERE id_directorio_cec = $id_directorio_cec AND id_persona = $id_persona";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de éxito de la operación.
		echo "<P ALIGN='center' CLASS='contenido'><B>TUS ANTECEDENTES CEC HAN SIDO MODIFICADOS EXITOSAMENTE</B></P>";
		echo "<P CLASS='contenido'>De ahora en adelante, t&uacute; ser&aacute;s identificado dentro de este sitio Web por los datos que acabas de registrar. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
}
?>