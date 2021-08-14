<?PHP
/**
 * usuariointerno.php.
 * v.1.0.
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
 * Clase que proporciona diferentes funciones para el manejo de los registros de los usuarios
 * internos a la Escuela Ingeniería en Computación y que están registrados en la base de datos.
 * Esta clase extiende de la clase usuario.
 */

// Librerías necesarias.
include("usuario.php");

class usuariointerno extends usuario
{
	/**
	 * Método constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function usuariointerno($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que verifica que un usuario sea interno.
	 *
	 * @param $id_persona El identificador de la persona.
	 *
	 * @return true Cuando es interno.
	 * @return false Cuando no es interno.
	 */
	function esUsuarioInterno($id_persona)
	{
		// Consulta para buscar a la persona en usuario interno.
		$consulta = "SELECT id_persona FROM usuario_interno WHERE id_estado_interno = 1 AND id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Cuando el usuario es interno.
		if ($total > 0)
			return true;
		
		// Cuando el usuario no es interno.
		return false;
	}
	
	/**
	 * Método que verifica en la base de datos los permisos de un usuario interno.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_privilegio El identificador del privilegio.
	 *
	 * @return true Cuando tiene permiso.
	 * @return false Cuando no tiene permiso.
	 */
	function tienePermiso($id_persona, $id_privilegio)
	{
		// Cuando es integrante del CEC.
		if ($id_privilegio == 2)
		{
			// Capturamos el año actual.
			$anio = date("Y");
			
			// Consulta para ver si la persona tiene permiso al privilegio.
			$consulta = "SELECT usuario_interno.id_persona FROM permiso, usuario_interno, alumno, directorio_cec, cec WHERE permiso.id_privilegio = $id_privilegio AND permiso.id_persona = $id_persona AND permiso.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = alumno.id_persona AND alumno.id_persona = directorio_cec.id_persona AND directorio_cec.id_cec = cec.id_cec AND cec.anio_cec = $anio";
		}
		// Cuando no es integrante del CEC:
		else $consulta = "SELECT id_persona FROM permiso WHERE id_privilegio = $id_privilegio AND id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Cuando fue encontrado el permiso.
		if ($total > 0)
			return true;
		
		// Cuando no fue encontrado el permiso.
		return false;
	}
	
	/**
	 * Método que confirma la existencia de un usuario interno y captura la pregunta secreta.
	 *
	 * @param $usuario El nombre de usuario.
	 *
	 * @return true Cuando existe el usuario.
	 * @return false Cuando no existe el usuario.
	 */
	function existe($usuario)
	{
		// Consulta que obtiene la clave para un usuario.
		$consulta = "SELECT usuario_interno.id_persona, pregunta_secreta.nombre_pregunta_secreta FROM usuario, pregunta_secreta, usuario_interno WHERE usuario.id_persona = usuario_interno.id_persona AND usuario.nombre_usuario = '$usuario' AND usuario.id_pregunta_secreta = pregunta_secreta.id_pregunta_secreta AND usuario_interno.id_estado_interno = 1";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$total = mysql_num_rows($resultado);
		
		// Cuando el usuario interno existe.
		if ($total > 0)
		{
			// Capturamos la identificación de la persona.
			$this->id = $tupla["id_persona"];
			
			// Capturamos el nombre de la pregunta.
			$this->pregunta = $tupla["nombre_pregunta_secreta"];
			
			// Decimos que si existe.
			return true;
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);		
		
		// Decimos que no existe el usuario.
		return false;
	}
	
	/**
	 * Método que muestra los antecedentes de un usuario interno en un formulario
	 * para su posterior modificación.
	 *
	 * @param $id_persona El identificador de la persona.
	 */
	function mostrarAntecedentes($id_persona)
	{
		// Librerías necesarias.
		include("preguntasecreta.php");
		
		// Consulta que obtiene los antecedentes del usuario interna con identificación conocida.
		$consulta = "SELECT persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, persona.url_persona, usuario.nombre_usuario, usuario.clave_usuario, usuario.id_pregunta_secreta, usuario.respuesta_secreta FROM persona, usuario, usuario_interno WHERE usuario_interno.id_persona = $id_persona AND usuario_interno.id_estado_interno = 1 AND persona.id_persona = usuario.id_persona AND usuario.id_persona = usuario_interno.id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Imprimimos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Antecedentes Personales</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>Nombres:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='nombres' CLASS='formtextfield' MAXLENGTH='50' TABINDEX='1' TITLE='Primer y segundo nombre' VALUE='" . $tupla["nombres_persona"] . "'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Apellido paterno:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='paterno' CLASS='formtextfield' MAXLENGTH='25' TABINDEX='1' TITLE='Apellido paterno' VALUE='" . $tupla["paterno_persona"] . "'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Apellido materno:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='materno' CLASS='formtextfield' MAXLENGTH='25' TABINDEX='1' TITLE='Apellido materno' VALUE='" . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>E-mail:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='email' CLASS='formtextfield' MAXLENGTH='50' TABINDEX='1' TITLE='Correo electr&oacute;nico' VALUE='" . $tupla["email_persona"] . "'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Sitio Web:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='web' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' TITLE='Sitio Web (No incluir el protocolo http://)' VALUE='" . $tupla["url_persona"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Usuario:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='usuario' CLASS='formtextfield' MAXLENGTH='50' DISABLED='true' TITLE='Nombre de usuario (RUT completo)' VALUE='" . $tupla["nombre_usuario"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Nueva clave:</TD>";
		echo "<TD><INPUT TYPE='password' NAME='nueva_clave1' CLASS='formtextfield' MAXLENGTH='25' TABINDEX='1' TITLE='Nueva clave secreta'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Repetir nueva clave:</TD>";
		echo "<TD><INPUT TYPE='password' NAME='nueva_clave2' CLASS='formtextfield' MAXLENGTH='25' TABINDEX='1' TITLE='Nueva clave secreta'></TD>";
		echo "</TR>";
		echo "<TR>";
		$pregunta_secreta = new preguntasecreta($this->enlace);
		echo "<TD CLASS='formlabel'>Pregunta secreta:</TD>";
		echo "<TD>";
		$pregunta_secreta->select($tupla["id_pregunta_secreta"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Respuesta secreta:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='respuesta_secreta' CLASS='formtextfield' MAXLENGTH='50' TABINDEX='1' TITLE='Respuesta secreta' VALUE='" . $tupla["respuesta_secreta"] . "'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN>";
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
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar los antecedentes personales'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * Método que actualiza los antecedentes de un usuario interno.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $nombres_persona El primer y segundo nombre de la persona.
	 * @param $paterno_persona El apellido paterno de la persona.
	 * @param $materno_persona El apellido materno de la persona.
	 * @param $email_persona El correo electrónico de la persona.
	 * @param $url_persona El sitio Web de la persona.
	 * @param $clave_usuario La clave secreta de usuario.
	 * @param $id_pregunta_secreta El identificador de la pregunta secreta.
	 * @param 4respuesta_secreta La respuesta a la pregunta secreta.
	 */
	function actualizarAntecedentes($id_persona, $nombres_persona, $paterno_persona, $materno_persona, $email_persona, $url_persona, $clave_usuario, $id_pregunta_secreta, $respuesta_secreta)
	{
		// Librerías necesarias.
		include("persona.php");
		
		// Creamos un objeto persona y buscamos a una persona registrada (distinta) con el mismo e-mail.
		$persona = new persona($this->enlace);
		$id_persona_buscada = $persona->buscar($email_persona);
		
		// Cuando si estaba registrado el e-mail en otra persona.
		if ($id_persona_buscada != 0 && $id_persona_buscada != $id_persona)
		{
			$email = strtr($email_persona, get_html_translation_table(HTML_SPECIALCHARS));
			echo "<P ALIGN='center' CLASS='contenido'><B>NO SE PUEDEN ACTUALIZAR TUS ANTECEDENTES PERSONALES</B></P>";
			echo "<P CLASS='contenido'>El e-mail <B>$email</B> est&aacute; siendo usado por otro usuario dentro de este sitio Web. Por favor vuelve a ingresar tus datos y cambia el e-mail que ingresaste anteriormente.</P>";
			echo "<DIV ALIGN='center'><A HREF=\"javascript:history.back(1);\" TITLE='Atr&aacute;s al formulario'><IMG SRC='../../../librerias/btatras.gif' BORDER='0'></A></DIV>";
		}
		// Cuando no estaba registrado el e-mail en otra persona.
		else
		{
			// Consulta para actualizar los datos de la tabla usuario.
			$update = "UPDATE usuario ";
			$set = "SET id_pregunta_secreta = $id_pregunta_secreta, respuesta_secreta = '$respuesta_secreta'";
			if ($clave_usuario)
				$set = $set . ", clave_usuario = '$clave_usuario' ";
			else $set = $set . " ";
			$where = "WHERE id_persona = $id_persona";
			$consulta = $update . $set . $where;
			mysql_query($consulta, $this->enlace);
			
			// Consulta para actualizar los datos de la tabla persona.
			$consulta = "UPDATE persona SET nombres_persona = '$nombres_persona', paterno_persona = '$paterno_persona', email_persona = '$email_persona', materno_persona = '$materno_persona', url_persona = '$url_persona' WHERE id_persona = $id_persona";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos los mesajes de éxito de la operación.
			echo "<P ALIGN='center' CLASS='contenido'><B>TUS ANTECEDENTES PERSONALES HAN SIDO MODIFICADOS EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>De ahora en adelante, t&uacute; ser&aacute;s identificado dentro de este sitio Web por los datos que acabas de registrar. Gracias por colaborar con nosotros.</P>";
			echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
		}
	}
}
?>