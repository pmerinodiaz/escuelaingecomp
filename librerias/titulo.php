<?PHP
/**
 * titulo.php.
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
 * Clase que contiene los m�todo y variables que manejan los t�tulos profesionales de los
 * acad�micos que existenen en el Area de Computaci�n.
 */

class titulo
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * M�todo constructor en donde se inicializa el enlace a la Base de Datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function titulo($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que muestra el formulario de ingreso de un nuevo t�tulo profesional.
	 *
	 * @param $id_persona El identificador de la persona.
	 */
	function formularioAgregar($id_persona)
	{	
		// Librer�as necesarias.
		include("empresa.php");
		
		// Consulta que obtiene los antecedentes del usuario interno con identificaci�n conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Mostramos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Agregar T&iacute;tulo Profesional</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>";
		echo "<TABLE WIDTH='100%' BORDER='1' CELLPADDING='0' CELLSPACING='0' BORDERCOLOR='#F1F1F1' MM_NOCONVERT='TRUE' BGCOLOR='#FFFFFF'>";
		echo "<TR>";
		echo "<TD>";
		echo "<FORM ACTION='grabar.php' METHOD='post' NAME='formulario'>";
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>T&iacute;tulo Profesional:</TD>";
		echo "<TD WIDTH='70%'>";
		$this->select(1);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Instituci&oacute;n de Egreso:</TD>";
		echo "<TD>";
		$empresa = new empresa($this->enlace);
		$empresa->selectUniversidades(1);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Titulado:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
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
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='agregar' VALUE='Agregar' CLASS='formbutton' TABINDEX='1' TITLE='Agregar el t&iacute;tulo profesional'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * M�todo que obtiene todos los t�tulos y escribe un select con los resultados.
	 *
	 * @param $id_titulo El identificador del t�tulo profesional.
	 */
	function select($id_titulo)
	{
		// Consulta que obtiene todos los t�tulos existentes en la base de datos.
		$consulta = "SELECT id_titulo, nombre_titulo FROM titulo ORDER BY nombre_titulo";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Creamos el select.
		echo "<SELECT NAME='titulo' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos los t�tulos como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_titulo"] == $id_titulo)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_titulo"], $fila["nombre_titulo"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_titulo"], $fila["nombre_titulo"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * M�todo que agrega un nuevo t�tulo profesional para un acad�mico de la Base de Datos.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_titulo El identificador del t�tulo.
	 * @param $id_empresa El identificador de la empresa.
	 */
	function agregar($id_persona, $id_titulo, $id_empresa)
	{
		// Consulta para agregar el registro en la tabla profesi�n.
		$consulta = "INSERT INTO profesion(id_empresa, id_titulo, id_persona) VALUES($id_empresa, $id_titulo, $id_persona)";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de �xito de la operaci�n.
		echo "<P ALIGN='center' CLASS='contenido'><B>TU TITULO PROFESIONAL HA SIDO AGREGADO EXITOSAMENTE</B></P>";
		echo "<P CLASS='contenido'>Este t&iacutetulo profesional se ha incorporado a tus antecedentes docentes, de manera que mejora tu curr&iacute;culum profesional. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='../../docentes/index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
	
	/**
	 * M�todo que lista todos los t�tulos que tiene un acad�mico, los cuales posteriormente
	 * ser�n eliminados.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $vinculo El enlace a la p�gina de destino.
	 */
	function listar($id_persona, $vinculo)
	{
		// Consulta que obtiene los antecedentes del usuario interno con identificaci�n conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE persona.id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$usuario = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
		mysql_free_result($resultado);
		
		// Consulta para obtener la lista de t�tulos que tiene el usuario.
		$consulta = "SELECT profesion.id_profesion, titulo.nombre_titulo, empresa.nombre_empresa FROM profesion, titulo, empresa WHERE profesion.id_persona = $id_persona AND profesion.id_titulo = titulo.id_titulo AND profesion.id_empresa = empresa.id_empresa ORDER BY titulo.nombre_titulo, empresa.nombre_empresa";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);		
		
		// Cuando no hay t�tulos.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay t&iacute;tulos profesionales para $usuario.</P>";
		
		// Cuando hay t�tulos.
		else
		{
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='5' CLASS='contenido'>Hay un total de $total t&iacute;tulos profesionales para $usuario:</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'>&nbsp;</TD>";
			echo "<TD WIDTH='45%' ALIGN='center' CLASS='titulotabla'><B>T&iacute;tulo</B></TD>";
			echo "<TD WIDTH='45%' ALIGN='center' CLASS='titulotabla'><B>Instituci&oacute;n</B></TD>";
			echo "</TR>";
			
			// Texto para enlazar a la operaci�n.
			if ($vinculo == "modificar.php")
				$texto_vinculo = "Modificar";
			else $texto_vinculo = "Eliminar";
			
			// Imprimimos la lista de t�tulos.
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				printf("<TD ALIGN='center' CLASS='tabla' VALIGN='top'><A HREF='$vinculo?id=%s' TITLE='%s T&iacute;tulo Profesional'>%s</A></TD>", $tupla["id_profesion"], $texto_vinculo, $texto_vinculo);
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $tupla["nombre_titulo"]);
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $tupla["nombre_empresa"]);
				printf("</TR>");
			}
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);	
	}
	
	/**
	 * M�todo que muestra el formulario de modificaci�n de un nuevo t�tulo profesional.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_profesion El identificador de la profesion.
	 */
	function formularioModificar($id_persona, $id_profesion)
	{
		// Librer�as necesarias.
		include("empresa.php");
		
		// Consulta para obtener la lista de t�tulos que tiene el usuario.
		$consulta = "SELECT profesion.id_profesion, profesion.id_titulo, profesion.id_empresa, persona.nombres_persona, persona.paterno_persona, persona.materno_persona FROM profesion, academico, persona WHERE profesion.id_profesion = $id_profesion AND profesion.id_persona = $id_persona AND profesion.id_persona = academico.id_persona AND academico.id_persona = persona.id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Imprimimos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Modificar T&iacute;tulo Profesional</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>";
		echo "<TABLE WIDTH='100%' BORDER='1' CELLPADDING='0' CELLSPACING='0' BORDERCOLOR='#F1F1F1' MM_NOCONVERT='TRUE' BGCOLOR='#FFFFFF'>";
		echo "<TR>";
		echo "<TD>";
		echo "<FORM ACTION='grabar.php' METHOD='post' NAME='formulario'>";
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>T&iacute;tulo Profesional:</TD>";
		echo "<TD WIDTH='70%'>";
		$this->select($tupla["id_titulo"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Instituci&oacute;n de Egreso:</TD>";
		echo "<TD>";
		$empresa = new empresa($this->enlace);
		$empresa->selectUniversidades($tupla["id_empresa"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Titulado:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_profesion' VALUE='" . $tupla["id_profesion"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido'>&nbsp;<FONT COLOR='#CC0000'>*</FONT> Datos obligatorios</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar el t&iacute;tulo profesional'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * M�todo que modifica un t�tulo profesional.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_profesion El identificador de la profesion.
	 * @param $id_titulo El identificador del t�tulo profesional.
	 * @param $id_empresa El identificador de la empresa.
	 */
	function modificar($id_persona, $id_profesion, $id_titulo, $id_empresa)
	{
		// Consulta para actualizar la tabla 'profesion'.
		$consulta = "UPDATE profesion SET id_titulo = '$id_titulo', id_empresa = '$id_empresa' WHERE id_profesion = $id_profesion AND id_persona = $id_persona";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de �xito de la operaci�n.
		printf("<P ALIGN='center' CLASS='contenido'><B>TU TITULO PROFESIONAL HA SIDO MODIFICADO EXITOSAMENTE</B></P>");	
		printf("<P CLASS='contenido'>Este t&iacutetulo profesional se ha modificado en tus antecedentes docentes, de manera que tu curr&iacute;culum profesional ha cambiado. Gracias por colaborar con nosotros.</P>");
		printf("<DIV ALIGN='center'><A HREF='../../docentes/index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>");
	}
	
	/**
	 * M�todo que muestra el formulario de eliminaci�n de un t�tulo profesional.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_profesion El identificador de la profesion.
	 */
	function formularioEliminar($id_persona, $id_profesion)
	{	
		// Consulta para obtener el t�tulos que tiene el usuario.
		$consulta = "SELECT profesion.id_profesion, titulo.nombre_titulo, empresa.nombre_empresa, persona.nombres_persona, persona.paterno_persona, persona.materno_persona FROM profesion, titulo, empresa, academico, persona WHERE profesion.id_profesion = $id_profesion AND profesion.id_persona = $id_persona AND profesion.id_titulo = titulo.id_titulo AND profesion.id_empresa = empresa.id_empresa AND profesion.id_persona = academico.id_persona AND academico.id_persona = persona.id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Mostramos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Eliminar T&iacute;tulo Profesional</B></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>";
		echo "<TABLE WIDTH='100%' BORDER='1' CELLPADDING='0' CELLSPACING='0' BORDERCOLOR='#F1F1F1' MM_NOCONVERT='TRUE' BGCOLOR='#FFFFFF'>";
		echo "<TR>";
		echo "<TD>";
		echo "<FORM ACTION='grabar.php' METHOD='post' NAME='formulario'>";
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0'>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>T&iacute;tulo Profesional:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='100' DISABLED='true' VALUE='" . $tupla["nombre_titulo"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Instituci&oacute;n de Egreso:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='100' DISABLED='true' VALUE='" . $tupla["nombre_empresa"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Titulado:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>�Confirmas que deseas eliminar este t&iacute;tulo profesional?</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='confirmar' CHECKED='true' VALUE='1'>Si<BR><INPUT TYPE='radio' NAME='confirmar' VALUE='0'>No</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_profesion' VALUE='" . $tupla["id_profesion"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='aceptar' VALUE='Aceptar' CLASS='formbutton' TABINDEX='1' TITLE='Aceptar'></TD>";
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
	 * M�todo que elimina un t�tulo profesional de la Base de Datos.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_profesion El identificador de la profesion.
	 * @param $confirmar Si el usuario quiere o no eliminar el t�tulo profesional.
	 */
	function eliminar($id_persona, $id_profesion, $confirmar)
	{
		// Cuando quiere eliminarlo.
		if ($confirmar == 1)
		{
			// Borramos el registro en la tabla profesion.
			$consulta = "DELETE FROM profesion WHERE id_profesion = $id_profesion AND id_persona = $id_persona";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos el mesaje de �xito de la operaci�n.
			echo "<P ALIGN='center' CLASS='contenido'><B>TU TITULO PROFESIONAL HA SIDO ELIMINADO EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Este t&iacutetulo profesional se ha eliminado de tus antecedentes docentes, de manera que tu curr&iacute;culum profesional ha cambiado. Gracias por colaborar con nosotros.</P>";
		}
		// Cuando no quiere eliminarlo.
		else
		{
			echo "<P ALIGN='center' CLASS='contenido'><B>TU TITULO PROFESIONAL NO HA SIDO ELIMINADO</B></P>";
			echo "<P CLASS='contenido'>Este t&iacutetulo profesional no se ha eliminado de tus antecedentes docentes, de manera que tu curr&iacute;culum profesional permanece intacto. Gracias por colaborar con nosotros.</P>";
		}
		
		// Mostramos el bot�n volver.
		echo "<DIV ALIGN='center'><A HREF='../../docentes/index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
}
?>