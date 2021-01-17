<?PHP
/**
 * academico.php.
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
 * Clase que proporciona diferentes métodos para el manejo de los registros de los académicos
 * existentes en la base de datos. Los académicos son personas que dictan asignaturas para la
 * carrera Ingeniería en Computación de la ULS. Estos académicos pueden encontrarse activos
 * o inactivos. Los académicos pueden ser académicos de jornada completa, de media jornada o
 * part-time.
 */

class academico
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Método constructor en donde inicializamos el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function academico($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que muestra a todos los académicos de algún tipo que tiene el área de
	 * computación y enlaza los nombres de los académicos a la página de su curriculum
	 * vitae.
	 *
	 * @param $id_tipo_academico El identificador del tipo de académico.
	 */
	function mostrar($id_tipo_academico)
	{
		// Consulta que obtiene todos los académicos de un tipo en específico.
		$consulta = "SELECT persona.id_persona, persona.nombres_persona, persona.paterno_persona, persona.materno_persona FROM persona, usuario_interno, academico WHERE academico.id_tipo_academico = $id_tipo_academico AND usuario_interno.id_estado_interno = 1 AND persona.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = academico.id_persona ORDER BY persona.nombres_persona, persona.paterno_persona, persona.materno_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay académicos.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay acad&eacute;micos.</P>";
		
		// Cuando si hay académicos.
		else
		{
			// Ciclo en donde recorremos los resultados y mostramos los académicos en una lista.
			printf("<UL>");
			while ($tupla = mysql_fetch_array($resultado))
			{
			  $nombre = $tupla["nombres_persona"]." ".$tupla["paterno_persona"]." ".$tupla["materno_persona"];
			  printf("<LI><A HREF='curriculum.php?id=%d' TITLE='Ver Curriculum de %s'>%s</A></LI>", $tupla["id_persona"], $nombre, $nombre);
			}
			printf("</UL>");
		}
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que muestra el formulario para modificar los antecedentes docentes que tiene
	 * un académico. Este formulario se muestra en la sección de la Intranet del sitio Web.
	 *
	 * @param $id_persona El identificador de la persona.
	 */
	function formularioDocentes($id_persona)
	{
		// Consulta que obtiene los antecedentes docentes del académico con identificación conocida.
		$consulta = "SELECT academico.src_academico, academico.grado_academico FROM persona, usuario_interno, academico WHERE persona.id_persona = $id_persona AND usuario_interno.id_estado_interno = 1 AND persona.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = academico.id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Imprimimos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Antecedentes Docentes</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>Grado Acad&eacute;mico:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='grado' CLASS='formtextfield' MAXLENGTH='60' TABINDEX='1' TITLE='Grado acad&eacute;mico' VALUE='".$tupla["grado_academico"]."'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel' VALIGN='top'>Fotograf&iacute;a Actual:</TD>";
		echo "<TD>";
		if (isset($tupla["src_academico"]) && $tupla["src_academico"] != "")
			echo "<IMG SRC='../../../integrantes/academicos/activos/".$tupla["src_academico"]."'>";
		else echo "<IMG SRC='../../../librerias/sinfoto.gif'>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>&nbsp;</TD>";
		echo "<TD>";
		if (isset($tupla["src_academico"]) && $tupla["src_academico"] != "")
			echo "<INPUT TYPE='checkbox' NAME='cambio' TABINDEX='1' onClick='setearSRC();'>";
		else echo "<INPUT TYPE='checkbox' NAME='cambio' TABINDEX='1' CHECKED onClick='setearSRC();'>";
		echo " <SPAN CLASS='formlabel'>Cambiar la fotograf&iacute;a actual</SPAN>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>&nbsp;</TD>";
		echo "<TD>";
		if (isset($tupla["src_academico"]) && $tupla["src_academico"] != "")
			echo "<INPUT TYPE='file' NAME='imagen' TABINDEX='1' DISABLED CLASS='formtextfield' TITLE='Fotograf&iacute;a *.GIF - *.JPG (M&aacute;x. 15 KB)'>";
		else echo "<INPUT TYPE='file' NAME='imagen' TABINDEX='1' CLASS='formtextfield' TITLE='Fotograf&iacute;a *.GIF - *.JPG (M&aacute;x. 15 KB)'>";
		echo "</TD>";
		echo "</TR>";
		
		// Consulta que obtiene los títulos profesionales del académico con identificación conocida.
		$consulta = "SELECT titulo.nombre_titulo, empresa.nombre_empresa FROM profesion, empresa, titulo WHERE profesion.id_persona = $id_persona AND profesion.id_titulo = titulo.id_titulo AND profesion.id_empresa = empresa.id_empresa ORDER BY titulo.nombre_titulo, empresa.nombre_empresa";
		$resultado = mysql_query($consulta, $this->enlace);
		echo "<TR>";
		echo "<TD CLASS='formlabel' VALIGN='top'>T&iacute;tulos Profesionales:</TD>";
		echo "<TD>";
		$i = 1;
		while ($tupla = mysql_fetch_array($resultado))
		{
			echo "<INPUT TYPE='text' NAME='titulo$i' CLASS='formtextfield' DISABLED MAXLENGTH='200' VALUE='".$tupla["nombre_titulo"].", ".$tupla["nombre_empresa"]."'><BR>";
			$i++;
		}
		mysql_free_result($resultado);
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>&nbsp;</TD>";
		echo "<TD>";
		echo "<INPUT TYPE='button' NAME='agregar_titulo' VALUE='Agregar' CLASS='formbuttoninter' TABINDEX='1' TITLE='Agregar T&iacute;tulo Profesional' onClick='location.href=\"../titulos/agregar/index.php\";'>&nbsp;";
		echo "<INPUT TYPE='button' NAME='modificar_titulo' VALUE='Modificar' CLASS='formbuttoninter' TABINDEX='1' TITLE='Modificar T&iacute;tulo Profesional' onClick='location.href=\"../titulos/modificar/index.php\";'>&nbsp;";
		echo "<INPUT TYPE='button' NAME='eliminar_titulo' VALUE='Eliminar' CLASS='formbuttoninter' TABINDEX='1' TITLE='Eliminar T&iacute;tulo Profesional' onClick='location.href=\"../titulos/eliminar/index.php\";'>";
		echo "</TD>";
		echo "</TR>";
		
		// Consulta que obtiene las especialidades del académico con identificación conocida.
		$consulta = "SELECT area.nombre_area FROM interes, area WHERE interes.id_persona = $id_persona AND interes.id_area = area.id_area ORDER BY area.nombre_area";
		$resultado = mysql_query($consulta, $this->enlace);
		echo "<TR>";
		echo "<TD CLASS='formlabel' VALIGN='top'>Especialidades:</TD>";
		echo "<TD>";
		$i = 1;
		while ($tupla = mysql_fetch_array($resultado))
		{
			echo "<INPUT TYPE='text' NAME='especialidad$i' CLASS='formtextfield' DISABLED MAXLENGTH='100' VALUE='".$tupla["nombre_area"]."'><BR>";
			$i++;
		}
		mysql_free_result($resultado);
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>&nbsp;</TD>";
		echo "<TD>";
		echo "<INPUT TYPE='button' NAME='agregar_especialidad' VALUE='Agregar' CLASS='formbuttoninter' TABINDEX='1' TITLE='Agregar Especialidad' onClick='location.href=\"../especialidades/agregar/index.php\";'>&nbsp;";
		echo "<INPUT TYPE='button' NAME='modificar_especialidad' VALUE='Modificar' CLASS='formbuttoninter' TABINDEX='1' TITLE='Modificar Especialidad' onClick='location.href=\"../especialidades/modificar/index.php\";'>&nbsp;";
		echo "<INPUT TYPE='button' NAME='eliminar_especialidad' VALUE='Eliminar' CLASS='formbuttoninter' TABINDEX='1' TITLE='Eliminar Especialidad' onClick='location.href=\"../especialidades/eliminar/index.php\";'>";
		echo "</TD>";
		echo "</TR>";
		
		// Consulta que obtiene las asignaturas dictadas por el académico con identificación conocida.
		$consulta = "SELECT asignatura.nombre_asignatura FROM dicta, asignatura WHERE dicta.id_persona = $id_persona AND dicta.id_asignatura = asignatura.id_asignatura GROUP BY asignatura.nombre_asignatura ORDER BY asignatura.nombre_asignatura";
		$resultado = mysql_query($consulta, $this->enlace);
		echo "<TR>";
		echo "<TD CLASS='formlabel' VALIGN='top'>Asignaturas Dictadas:</TD>";
		echo "<TD>";
		$i = 1;
		while ($tupla = mysql_fetch_array($resultado))
		{
			echo "<INPUT TYPE='text' NAME='asignatura$i' CLASS='formtextfield' DISABLED MAXLENGTH='50' VALUE='".$tupla["nombre_asignatura"]."'><BR>";
			$i++;
		}
		mysql_free_result($resultado);
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>&nbsp;</TD>";
		echo "<TD>";
		echo "<INPUT TYPE='button' NAME='agregar_asignatura' VALUE='Agregar' CLASS='formbuttoninter' TABINDEX='1' TITLE='Agregar Asignatura Dictada' onClick='location.href=\"../asignaturas/agregar/index.php\";'>&nbsp;";
		echo "<INPUT TYPE='button' NAME='modificar_asignatura' VALUE='Modificar' CLASS='formbuttoninter' TABINDEX='1' TITLE='Modificar Asignatura Dictada' onClick='location.href=\"../asignaturas/modificar/index.php\";'>&nbsp;";
		echo "<INPUT TYPE='button' NAME='eliminar_asignatura' VALUE='Eliminar' CLASS='formbuttoninter' TABINDEX='1' TITLE='Eliminar Asignatura Dictada' onClick='location.href=\"../asignaturas/eliminar/index.php\";'>";
		echo "</TD>";
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
		echo "<INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar los antecedentes docentes'>&nbsp;";
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
	 * Método que actualiza los antecedentes docentes de un académico con identificación
	 * conocida.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $grado El grado académico del académico.
	 * @param $archivo El archivo de la imagen del académico.
	 */
	function actualizar($id_persona, $grado, $archivo)
	{
		// Cuando hay que subir el archivo al servidor.
		if (isset($archivo))
		{
			// Cuando hay espacio en disco, el archivo existe y el archivo pesa menos o igual a 15 KB.
			if ($archivo['size'] <= diskfreespace("/") && 0 < $archivo['size'] && $archivo['size'] <= 15000)
			{
				// Consulta para obtener el nombre del archivo antiguo.
				$consulta = "SELECT src_academico FROM academico WHERE id_persona = $id_persona";
				$resultado = mysql_query($consulta, $this->enlace);
				$tupla = mysql_fetch_array($resultado);
				
				// Buscamos el archivo antiguo y lo borramos del servidor.
				$archivo_antiguo = $_SERVER["DOCUMENT_ROOT"]."/wwwic/integrantes/academicos/activos/".$tupla["src_academico"];
				if (file_exists($archivo_antiguo))
					unlink($archivo_antiguo);
				
				// Libreramos memoria del servidor.
				mysql_free_result($resultado);
				
				// Copiamos el nuevo archivo al servidor.
				copy($archivo['tmp_name'], $_SERVER["DOCUMENT_ROOT"]."/wwwic/integrantes/academicos/activos/$id_persona.gif");
				
				// Consulta para actualizar los datos del académico.
				$consulta = "UPDATE academico SET grado_academico = '$grado', src_academico = '$id_persona.gif' WHERE id_persona = $id_persona";
				mysql_query($consulta, $this->enlace);
				
				// Imprimimos los mesajes de éxito de la operación.
				echo "<P ALIGN='center' CLASS='contenido'><B>TUS ANTECEDENTES DOCENTES HAN SIDO MODIFICADOS EXITOSAMENTE</B></P>";
				echo "<P CLASS='contenido'>De ahora en adelante, t&uacute; ser&aacute;s identificado dentro de este sitio Web por los datos que acabas de registrar. Gracias por colaborar con nosotros.</P>";
				echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
			}
			// Cuando el archivo no se puede subir.
			else
			{
				// Imprimimos mensajes de error de envío.
				echo "<P CLASS='contenido' ALIGN='center'><B>NO SE PUEDEN MODIFICAR TUS ANTECEDENTES DOCENTES</B></P>";
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
			// Consulta para actualizar los datos del académico.
			$consulta = "UPDATE academico SET grado_academico = '$grado' WHERE id_persona = $id_persona";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos los mensajes de éxito de la operación.
			echo "<P ALIGN='center' CLASS='contenido'><B>TUS ANTECEDENTES DOCENTES HAN SIDO MODIFICADOS EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>De ahora en adelante, t&uacute; ser&aacute;s identificado en este sitio Web por los datos que acabas de registrar. Gracias por colaborar con nosotros.</P>";
			echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
		}
	}
}
?>