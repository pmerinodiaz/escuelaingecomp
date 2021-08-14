<?PHP
/**
 * interes.php.
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
 * Clase que contiene los m�todos y variables que administran las �reas de inter�s de los
 * acad�micos que existene en el Area de Computaci�n, y que se registran en la base de
 * datos.
 */

class interes
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * M�todo constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function interes($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * M�todo que muestra el formulario de ingreso de un nuevo inter�s.
	 *
	 * @param $id_persona El identificador de la persona.
	 */
	function formularioAgregar($id_persona)
	{
		// Consulta que obtiene los antecedentes del usuario interno con identificaci�n conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Mostramos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Agregar Especialidad</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>&Aacute;rea de Inter&eacute;s:</TD>";
		echo "<TD WIDTH='70%'>";
		$this->select(1);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Interesado:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='interesado' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
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
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='agregar' VALUE='Agregar' CLASS='formbutton' TABINDEX='1' TITLE='Agregar la especialidad'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * M�todo que obtiene todos las �reas de inter�s y escribe un select con los
	 * resultados obtenidos.
	 *
	 * @param $id_area El identificador del �rea de inter�s.
	 */
	function select($id_area)
	{
		// Consulta que obtiene todos los t�tulos.
		$consulta = "SELECT id_area, nombre_area FROM area ORDER BY nombre_area";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Creamos el select.
		echo "<SELECT NAME='area' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos los t�tulos como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_area"] == $id_area)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_area"], $fila["nombre_area"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_area"], $fila["nombre_area"]);
    }
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * M�todo que agrega una nueva �rea de inter�s en la base de datos.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_area El identificador del �rea de inter�s.
	 */
	function agregar($id_persona, $id_area)
	{
		// Consulta para agregar el registro en la tabla profesion.
		$consulta = "INSERT INTO interes(id_area, id_persona) VALUES($id_area, $id_persona)";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de �xito de la operaci�n.
		echo "<P ALIGN='center' CLASS='contenido'><B>TU ESPECIALIDAD HA SIDO AGREGADA EXITOSAMENTE</B></P>";
		echo "<P CLASS='contenido'>Esta &aacute;rea de inter&eacute;s ha sido incorporada a tus antecedentes docentes, por lo que se convertir&aacute; en un indicador clave de tus l&iacute;neas de investigaci&oacute;n. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='../../docentes/index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
	
	/**
	 * M�todo que lista todos los intereses que tiene un acad�mico.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $vinculo El enlace a la p�gina de destino.
	 */
	function listar($id_persona, $vinculo)
	{
		// Consulta que obtiene informaci�n del usuario interno con identificaci�n conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE persona.id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$usuario = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
		mysql_free_result($resultado);
		
		// Consulta para obtener la lista de intereses que tiene el usuario.
		$consulta = "SELECT interes.id_interes, area.nombre_area FROM interes, area WHERE interes.id_persona = $id_persona AND interes.id_area = area.id_area ORDER BY area.nombre_area";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);		
		
		// Cuando no hay intereses.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay especialidades para $usuario.</P>";
		
		// Cuando hay intereses.
		else
		{
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='5' CLASS='contenido'>Hay un total de $total especialidades para $usuario:</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'>&nbsp;</TD>";
			echo "<TD WIDTH='90%' ALIGN='center' CLASS='titulotabla'><B>Especialidades</B></TD>";
			echo "</TR>";
			
			// Texto para enlazar a la operaci�n.
			if ($vinculo == "modificar.php")
				$texto_vinculo = "Modificar";
			else $texto_vinculo = "Eliminar";
			
			// Imprimimos la lista de �reas de intereses.
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				printf("<TD ALIGN='center' CLASS='tabla' VALIGN='top'><A HREF='$vinculo?id=%s' TITLE='%s Especialidad'>%s</A></TD>", $tupla["id_interes"], $texto_vinculo, $texto_vinculo);
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $tupla["nombre_area"]);
				printf("</TR>");
			}
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);	
	}
	
	/**
	 * M�todo que muestra el formulario de modificaci�n de una �rea de inter�s.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_interes El identificador del inter�s.
	 */
	function formularioModificar($id_persona, $id_interes)
	{
		// Consulta para obtener los datos del inter�s seleccionado por el usuario.
		$consulta = "SELECT interes.id_area, persona.nombres_persona, persona.paterno_persona, persona.materno_persona FROM interes, academico, persona WHERE interes.id_interes = $id_interes AND interes.id_persona = $id_persona AND interes.id_persona = academico.id_persona AND academico.id_persona = persona.id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Mostramos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Modificar Especialidad</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>&Aacute;rea de Inter&eacute;s:</TD>";
		echo "<TD WIDTH='70%'>";
		$this->select($tupla["id_area"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Interesado:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_interes' VALUE='$id_interes'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido'>&nbsp;<FONT COLOR='#CC0000'>*</FONT> Datos obligatorios</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar la especialidad'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * M�todo que modifica un �rea de inter�s de un acad�mico.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_interes El identificador del inter�s.
	 * @param $id_area El identificador del �rea.
	 */
	function modificar($id_persona, $id_interes, $id_area)
	{
		// Consulta para actualizar la tabla 'interes'.
		$consulta = "UPDATE interes SET id_area = $id_area WHERE id_interes = $id_interes AND id_persona = $id_persona";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de �xito de la operaci�n.
		printf("<P ALIGN='center' CLASS='contenido'><B>TU ESPECIALIDAD HA SIDO MODIFICADA EXITOSAMENTE</B></P>");	
		printf("<P CLASS='contenido'>Esta &aacute;rea de inter&eacute;s ha sido cambiada en tus antecedentes docentes, por lo que se convertir&aacute; en un indicador clave de tus l&iacute;neas de investigaci&oacute;n. Gracias por colaborar con nosotros.</P>");
		printf("<DIV ALIGN='center'><A HREF='../../docentes/index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>");
	}
	
	/**
	 * M�todo que muestra el formulario de eliminaci�n de una �rea de inter�s de un acad�mico.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_interes El identificador del inter�s.
	 */
	function formularioEliminar($id_persona, $id_interes)
	{
		// Consulta para obtener los datos del inter�s seleccionado por el usuario.
		$consulta = "SELECT area.nombre_area, persona.nombres_persona, persona.paterno_persona, persona.materno_persona FROM interes, area, academico, persona WHERE interes.id_interes = $id_interes AND interes.id_persona = $id_persona AND interes.id_area = area.id_area AND interes.id_persona = academico.id_persona AND academico.id_persona = persona.id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Mostramos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Eliminar Especialidad</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>&Aacute;rea de Inter&eacute;s:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='area' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombre_area"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Interesado:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>�Confirmas que deseas eliminar esta especialidad?</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='confirmar' CHECKED='true' VALUE='1'>Si<BR><INPUT TYPE='radio' NAME='confirmar' VALUE='0'>No</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_interes' VALUE='$id_interes'></TD>";
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
	 * M�todo que elimina un �rea de inter�s de la base de datos.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_interes El identificador del inter�s.
	 * @param $confirmar Si el usuario quiere realmente eliminar el �rea de inter�s o no.
	 */
	function eliminar($id_persona, $id_interes, $confirmar)
	{
		// Cuando quiere eliminarla.
		if ($confirmar == 1)
		{
			// Consulta para borrar el registro en la tabla 'interes'.
			$consulta = "DELETE FROM interes WHERE id_interes = $id_interes AND id_persona = $id_persona";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos el mesaje de �xito de la operaci�n.
			echo "<P ALIGN='center' CLASS='contenido'><B>TU ESPECIALIDAD HA SIDO ELIMINADA EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Esta especialidad se ha eliminado de tus antecedentes docentes, de manera que tus l&iacute;neas de investigaci&oacute;n han cambiado. Gracias por colaborar con nosotros.</P>";
		}
		// Cuando no quiere eliminarla.
		else
		{
			echo "<P ALIGN='center' CLASS='contenido'><B>TU ESPECIALIDAD NO HA SIDO ELIMINADA</B></P>";
			echo "<P CLASS='contenido'>Este especialidad no se ha eliminado de tus antecedentes docentes, de manera que tus l&iacute;neas de investigaci&oacute;n permanecen intactas. Gracias por colaborar con nosotros.</P>";
		}
		
		// Mostramos el bot�n volver.
		echo "<DIV ALIGN='center'><A HREF='../../docentes/index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
}
?>