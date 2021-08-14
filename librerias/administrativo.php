<?PHP
/**
 * administrativo.php.
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
 * Clase que proporciona diferentes métodos y variales para el manejo de los administrativos
 * registrados en la base de datos. El personal administrativo de la Escuela Ingeniería en
 * Computación de la ULS lo constituyen aquellas personas que no son académicos, pero que si
 * ofrecen sus servicios de apoyo administrativo al Area de Computación. Por ejemplo:
 * Secretarias, Mantención, Conserjes, Funcionarios, etc.
 */

class administrativo
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Método contructor en el cual se inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function administrativo($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método en que se muestran todos los registros de los administrativos que tiene la
	 * Escuela Ingeniería en Computación y los enlaza a la página de su curriculum vitae.
	 */
	function mostrar()
	{
		// Consulta que obtiene a todos los administrativos.
		$consulta = "SELECT persona.id_persona, persona.nombres_persona, persona.paterno_persona, persona.materno_persona FROM persona, usuario_interno, administrativo WHERE usuario_interno.id_estado_interno = 1 AND persona.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = administrativo.id_persona ORDER BY persona.nombres_persona, persona.paterno_persona, persona.materno_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay administrativos.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay administrativos.</P>";
		
		// Cuando si hay administrativos.
		else
		{
			// Ciclo en donde mostramos a todos los administrativos en una lista.
			printf("<UL>");
			while ($tupla = mysql_fetch_array($resultado))
			{
				$nombre = $tupla["nombres_persona"]." ".$tupla["paterno_persona"]." ".$tupla["materno_persona"];
				printf("<LI><A HREF='curriculum.php?id=%d' TITLE='Ver Curriculum de %s'>%s</A></LI>", $tupla["id_persona"], $nombre, $nombre);
			}
			printf("</UL>");
		}					
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que muestra el formulario de modificación de los antecedentes administrativos de
	 * una persona que es administrativa. Este formulario se utiliza en la Intranet del sitio.
	 *
	 * @param $id_persona El identificador de la persona.
	 */
	function formularioAdministrativos($id_persona)
	{
		// Librerías necesarias.
		include("cargo.php");
		
		// Consulta que obtiene los antecedentes administrativos del usuario con identificación conocida.
		$consulta = "SELECT id_cargo, src_administrativo, fono_administrativo, fax_administrativo, horario_administrativo FROM administrativo WHERE id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Imprimimos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Antecedentes Administrativos</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>Cargo:</TD>";
		echo "<TD WIDTH='70%'>";
		$cargo = new cargo($this->enlace);
		$cargo->select($tupla["id_cargo"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel' VALIGN='top'>Fotograf&iacute;a Actual:</TD>";
		echo "<TD>";
		if (isset($tupla["src_administrativo"]) && $tupla["src_administrativo"] != "")
			echo "<IMG SRC='../../../integrantes/administrativos/activos/".$tupla["src_administrativo"]."'>";
		else echo "<IMG SRC='../../../librerias/sinfoto.gif'>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>&nbsp;</TD>";
		echo "<TD>";
		if (isset($tupla["src_administrativo"]) && $tupla["src_administrativo"] != "")
			echo "<INPUT TYPE='checkbox' NAME='cambio' TABINDEX='1' onClick='setearSRC();'>";
		else echo "<INPUT TYPE='checkbox' NAME='cambio' TABINDEX='1' CHECKED onClick='setearSRC();'>";
		echo " <SPAN CLASS='formlabel'>Cambiar la fotograf&iacute;a actual</SPAN>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>&nbsp;</TD>";
		echo "<TD>";
		if (isset($tupla["src_administrativo"]) && $tupla["src_administrativo"] != "")
			echo "<INPUT TYPE='file' NAME='imagen' TABINDEX='1' DISABLED CLASS='formtextfield' TITLE='Fotograf&iacute;a *.GIF - *.JPG (M&aacute;x. 15 KB)'>";
		else echo "<INPUT TYPE='file' NAME='imagen' TABINDEX='1' CLASS='formtextfield' TITLE='Fotograf&iacute;a *.GIF - *.JPG (M&aacute;x. 15 KB)'>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tel&eacute;fono:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='fono' CLASS='formtextfield' MAXLENGTH='10' TABINDEX='1' TITLE='Tel&eacute;fono de contacto' VALUE='".$tupla["fono_administrativo"]."'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Fax:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='fax' CLASS='formtextfield' MAXLENGTH='10' TABINDEX='1' TITLE='Fax de contacto' VALUE='".$tupla["fax_administrativo"]."'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Horario de Atenci&oacute;n:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='horario' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' TITLE='Horario de atenci&oacute;n' VALUE='".$tupla["horario_administrativo"]."'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
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
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar los antecedentes administrativos'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * Método que actualiza los antecedentes administrativos de un administrativo.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_cargo El grado acdémico de la persona.
	 * @param $archivo La imagen de la foto.
	 * @param $fono_administrativo El teléfono del administrativo.
	 * @param $fax_administrativo El fax del administrativo.
	 * @param $horario_administrativo El horario de atención del administrativo.
	 */
	function actualizar($id_persona, $id_cargo, $archivo, $fono_administrativo, $fax_administrativo, $horario_administrativo)
	{
		// Cuando hay que subir el archivo al servidor.
		if (isset($archivo))
		{
			// Cuando hay espacio en disco, el archivo existe y el archivo pesa menos o igual a 15 KB.
			if ($archivo['size'] <= diskfreespace("/") && 0 < $archivo['size'] && $archivo['size'] <= 15000)
			{
				// Consulta para obtener el nombre del archivo antiguo.
				$consulta = "SELECT src_administrativo FROM administrativo WHERE id_persona = $id_persona";
				$resultado = mysql_query($consulta, $this->enlace);
				$tupla = mysql_fetch_array($resultado);
				
				// Buscamos el archivo antiguo y lo borramos del servidor.
				$archivo_antiguo = $_SERVER["DOCUMENT_ROOT"]."/wwwic/integrantes/administrativos/activos/".$tupla["src_administrativo"];
				if (file_exists($archivo_antiguo))
					unlink($archivo_antiguo);
				
				// Copiamos el archivo nuevo al servidor.
				copy($archivo['tmp_name'], $_SERVER["DOCUMENT_ROOT"]."/wwwic/integrantes/administrativos/activos/$id_persona.gif");
				
				// Consulta para actualizar los datos del administrativo.
				$consulta = "UPDATE administrativo SET id_cargo = $id_cargo, src_administrativo = '$id_persona.gif', fono_administrativo = '$fono_administrativo', fax_administrativo = '$fax_administrativo', horario_administrativo = '$horario_administrativo' WHERE id_persona = $id_persona";
				mysql_query($consulta, $this->enlace);
				
				// Libreramos memoria del servidor.
				mysql_free_result($resultado);
				
				// Imprimimos los mesajes de éxito de la operación.
				echo "<P ALIGN='center' CLASS='contenido'><B>TUS ANTECEDENTES ADMINISTRATIVOS HAN SIDO MODIFICADOS EXITOSAMENTE</B></P>";
				echo "<P CLASS='contenido'>De ahora en adelante, t&uacute; ser&aacute;s identificado dentro de este sitio Web por los datos que acabas de registrar. Gracias por colaborar con nosotros.</P>";
				echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
			}
			// Cuando el archivo no se puede subir.
			else
			{
				// Imprimimos mensajes de error de envío.
				echo "<P CLASS='contenido' ALIGN='center'><B>NO SE PUEDEN MODIFICAR TUS ANTECEDENTES ADMINISTRATIVOS</B></P>";
				echo "<P CLASS='contenido'>Esto puede que se deba a una de las siguientes razones:</P>";
				echo "<OL CLASS='contenido'>";
				echo "<LI>No hay espacio disponible en el disco del servidor.</LI>";
				echo "<LI>La fotograf&iacute;a no existe.</LI>";
				echo "<LI>El tama&ntilde;o de la fotograf&iacute;a es superior a 15 KB.</LI>";
				echo "</OL>";
				echo "</P>";
				echo "<P CLASS='contenido'>Por favor vuelve a ingresar tus datos y cambia la fotograf&iacute;a que ingresaste anteriormente.</P>";
				echo "<P ALIGN='center'><A HREF='index.php' TITLE='Atr&aacute;s al Formulario'><IMG SRC='../../../librerias/btatras.gif' BORDER='0'></A></P>";
			}
		}
		// Cuando no hay que subir el archivo al servidor.
		else
		{
			// Consulta para actualizar los datos del administrativo.
			$consulta = "UPDATE administrativo SET id_cargo = $id_cargo, fono_administrativo = '$fono_administrativo', fax_administrativo = '$fax_administrativo', horario_administrativo = '$horario_administrativo' WHERE id_persona = $id_persona";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos los mesajes de éxito de la operación.
			echo "<P ALIGN='center' CLASS='contenido'><B>TUS ANTECEDENTES ADMINISTRATIVOS HAN SIDO MODIFICADOS EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>De ahora en adelante, t&uacute; ser&aacute;s identificado en este sitio Web por los datos que acabas de registrar. Gracias por colaborar con nosotros.</P>";
			echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
		}
	}
}
?>