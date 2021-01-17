<?PHP
/**
 * comentario.php.
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
 * Clase que nos proporciona métodos y variables para administrar los comentarios que se
 * hacen hacia un tutorial o software publicado en este Web. Los comentario son emitidos
 * por cualquier persona hacia un software o tutorial que se encuentra en este Web.
 */

class comentario
{
	// Enlace a la base de datos.
	var $enlace;
	
	// Juego de caracteres especiales del servidor.
	var $caracteres;
	
	/**
	 * Método constructor que inicializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function comentario($link)
	{
		$this->enlace = $link;
		$this->caracteres = get_html_translation_table(HTML_SPECIALCHARS);
	}
	
	/**
	 * Método que agrega un comentario enviado por una persona hacia una utilidad,
	 * verficando previamente la integridad de los datos.
	 */
	function agregar($id_tipo_utilidad, $id_utilidad, $nombres, $paterno, $materno, $email, $texto)
	{
		// Librerías necesarias.
		include("persona.php");
		
		// Creamos un objeto persona y buscamos la persona.
		$persona = new persona($this->enlace);
		
		// Cuando el e-mail no cincide con el nombre de la persona.
		if ($persona->coincidir($email, $nombres, $paterno, $materno) == 0)
		{
	  	$email = strtr($email, $this->caracteres);	
			printf("<P ALIGN='center' CLASS='contenido'><B>NO SE PUEDE REGISTRAR TU COMENTARIO</B></P>");
			printf("<P CLASS='contenido'>El e-mail <B>$email</B> est&aacute; siendo usado por otro usuario dentro de este Sitio Web. Por favor vuelve a ingresar tus datos y cambia el e-mail que ingresaste anteriormente.</P>");
			printf("<DIV ALIGN='center'><A HREF=\"javascript:history.back(1);\" TITLE='Atr&aacute;s'><IMG SRC='../../librerias/btatras.gif' BORDER='0' ALT='Atrás al formulario'></A></DIV>");
		}
		
	  // Cuando el e-mail coincide con el nombre de la persona.
		else
		{
	  	// Capturamos la identificación de la persona.	
			$id_persona = $persona->buscar($email);			
			
			// Agregamos la persona, si no existe.
			if ($id_persona == 0)
				$id_persona = $persona->agregar($nombres, $paterno, $materno, $email);
			
			// Obtenemos la fecha actual.
			$fecha = date("Y-m-d");
			$hora = date("H:i:s");
			
			// Consulta para agregar el envio.
			$consulta = "INSERT INTO envio(id_tipo_envio, titulo_envio, desc_envio, fecha_envio, hora_envio) VALUES(4, '', '$texto', '$fecha', '$hora')";
			mysql_query($consulta, $this->enlace);
			
			// Obtenemos el identificador de la última inserción.
			$id_envio = mysql_insert_id();
			
			// Consulta para agregar el comentario.
			$consulta = "INSERT INTO comentario(id_envio, id_persona, id_utilidad) VALUES($id_envio, $id_persona, $id_utilidad)";
			mysql_query($consulta, $this->enlace);
			
			// Vemos el tipo de utilidad.
			switch ($id_tipo_utilidad)
			{
				case 1: $texto = "software"; break; 
				case 2: $texto = "tutorial"; break; 
			}
			
			// Imprimimos los mesajes de éxito de la operación.
			printf("<P ALIGN='center' CLASS='contenido'><B>TU COMENTARIO HA SIDO AGREGADO EXITOSAMENTE</B></P>");
			printf("<P CLASS='contenido'>Este comentario estar&aacute; disponible para que cualquier persona lo lea y se convertir&aacute; en una gu&iacute;a importante para que los usuarios elijan este %s. Gracias por darnos tu opini&oacute;n.</P>", $texto);
			printf("<DIV ALIGN='center'><A HREF=\"javascript:history.back(1);\" TITLE='Volver'><IMG SRC='../../librerias/btvolver.gif' BORDER='0'></A></DIV>");
		}
	}
	
	/**
	 * Método en el cual se muestra (de forma paginada) los comentarios de una utilidad.
	 *
	 * @param $id_utilidad El identificador de la utilidad.
	 * @param $pagina El número de la página actual dentro de la paginación total.
	 */
	function mostrar($id_utilidad, $pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "comentarios.php?id=".$id_utilidad."&";
		$porpagina = 5;
		
		// Consulta que obtiene las consultas respondidas, ordenadas por orden de llegada.
		$consulta = "SELECT envio.desc_envio, envio.fecha_envio, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona FROM envio, comentario, persona WHERE comentario.id_utilidad = $id_utilidad AND envio.id_envio = comentario.id_envio AND comentario.id_persona = persona.id_persona ORDER BY envio.fecha_envio DESC, titulo_envio";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay comentarios.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay comentarios.</TD>";
		
		// Cuando si hay comentarios.
		else
		{
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			
			// Abrimos la tabla para el total, la paginación y las comentarios.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total comentarios.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>&nbsp;</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Abrimos la tabla para las comentarios.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos las comentarios.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Imprimimos la fecha de realización y la persona que lo realizó.
				$email = strtr($tupla["email_persona"], $this->caracteres);
				printf("<TR>");
				printf("<TD CLASS='tabla' VALIGN='top'>%s <B>%s %s %s</B> <A HREF='mailto:%s' TITLE='%s'>%s</A></TD>", $tupla["fecha_envio"], $tupla["nombres_persona"], $tupla["paterno_persona"], $tupla["materno_persona"], $email, $email, $email);
				printf("</TR>");
				
				// Imprimimos el comentario.
				printf("<TR>");
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", nl2br(strtr($tupla["desc_envio"], $this->caracteres)));
				printf("</TR>");
				
				// Imprimimos un espacio en blanco.
				printf("<TR><TD>&nbsp;</TD></TR>");
			}
			
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
			echo "</TD>";
			
			// Imprimimos la paginación y cerramos la tabla de los comentarios.
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD>&nbsp;</TD></TR>";
			echo "</TABLE>";
		}
		
		// Liberación de memoria en el servidor.
		mysql_free_result($resultado);
	}
}
?>