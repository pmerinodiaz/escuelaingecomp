<?PHP
/**
 * practica.php.
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
 * Clase que contiene m�todos y variables para administrar todo lo referente a las pr�cticas
 * que se encuentran registradas en la base de datos. Las pr�cticas son los trabajos que deben
 * realizar los alumnos de la carrera Ingenier�a en Computaci�n en alguna empresa conocida.
 * Esto es requerido en la malla curricular.
 */

class practica
{
  // Enlace a la base de datos.
	var $enlace;
	
	// Juego de caracteres especiales del servidor.
	var $caracteres;
	
	/**
	 * M�todo constructor donde se incializa el enlace a la base de datos.
	 *
	 * @param $link El enlace a la base de datos.
	 */
	function practica($link)
	{
		$this->enlace = $link;
		$this->caracteres = get_html_translation_table(HTML_SPECIALCHARS);
	}
	
	/**
	 * M�todo que muestra el t�tulo de la secci�n 'Ofertas de Pr�ctica'.
	 */
	function mostrarTitulo()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Pr&aacute;ctica'>Pr&aacute;ctica</A> / Ofertas";
		$imagen = "activos/bgofertas.jpg";
		$titulo = "Ofertas de Pr&aacute;ctica";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * M�todo en el cual se muestra (en forma paginada) la lista de solicitudes
	 * de pr�ctica.
	 *
	 * @param $pagina El n�mero de la p�gina dentro de la paginaci�n total.
	 */
	function mostrar($pagina)
	{
		// Librer�as necesarias.
		include("paginacion.php");
		
		// Inicializaci�n de variables.
		$vinculo = "index.php?";
		$porpagina = 5;
		
		// Consulta que obtiene la informaci�n de las solicitudes de pr�ctica profesional efectuadas.
		$consulta = "SELECT persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, envio.titulo_envio, envio.desc_envio, solicitud_servicio.inicio_solicitud_servicio, solicitud_servicio.fin_solicitud_servicio, solicitud_servicio.id_empresa FROM persona, envio, solicitud_servicio, usuario WHERE solicitud_servicio.id_servicio = 1 AND persona.id_persona = usuario.id_persona AND envio.id_envio = solicitud_servicio.id_envio AND solicitud_servicio.id_persona = usuario.id_persona ORDER BY inicio_solicitud_servicio DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay ofertas de pr�ctica.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay ofertas de pr&aacute;ctica.</P>";
		
		// Cuando si hay ofertas de pr�ctica.
		else
		{
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			
			// Tabla para el total, la paginaci�n y las ofertas de pr�ctica.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total ofertas de pr&aacute;ctica.</TD>";			
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";			
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>&nbsp;</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para las ofertas de pr�ctica.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condici�n de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos las ofertas.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Imprimimos la solicitud y el t�tulo.
				printf("<TR>");
				printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>Solicitud:</B></TD>", "23%");
				printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>%s</B></TD>", "77%", strtr($tupla["titulo_envio"], $this->caracteres));
				printf("</TR>");
				
				// Imprimimos el autor y su email, si existe.
				printf("<TR>");
				printf("<TD CLASS='tabla' VALIGN='top'><B>Autor:</B></TD>");
				$nombre = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
				printf("<TD CLASS='tabla' VALIGN='top'>%s", $nombre);
				if ($tupla["email_persona"])
				{
					$email = strtr($tupla["email_persona"], $this->caracteres);
					printf(" (<A HREF='mailto:%s' TITLE='%s'>%s</A>)", $email, $email, $email);
				}
				printf("</TD>");
				printf("</TR>");			
				
				// Mostramos el nombre de la empresa, si existe.	
				$id_empresa = $tupla["id_empresa"];
				if (isset($id_empresa) && $id_empresa != NULL)
				{
					// Query para obtener el nombre de la empresa.
					$consulta = "SELECT nombre_empresa, url_empresa FROM empresa WHERE empresa.id_empresa = $id_empresa";
					$resp = mysql_query($consulta, $this->enlace);
					$fila = mysql_fetch_array($resp);
					
					// Imprimimos la empresa.
					printf("<TR>");
					printf("<TD CLASS='tabla' VALIGN='top'><B>Empresa:</B></TD>");
					$empresa = strtr($fila["nombre_empresa"], $this->caracteres);
					if ($fila["url_empresa"])
						printf("<TD CLASS='tabla' VALIGN='top'><A HREF='http://%s' TITLE='Visitar Web de %s' TARGET='_blank'>%s</A></TD>", strtr($fila["url_empresa"], $this->caracteres), $empresa, $empresa);
					else printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $empresa);
					printf("</TR>");
					
					// Liberaci�n de memoria en el servidor.
					mysql_free_result($resp);
				}
				
				// Imprimimos la fecha de inicio y t�rmino de la solicitud.
				printf("<TR>");
				printf("<TD CLASS='tabla' VALIGN='top'><B>Inicio / T&eacute;rmino:</B></TD>");
				printf("<TD CLASS='tabla' VALIGN='top'>%s / %s</TD>", $tupla["inicio_solicitud_servicio"], $tupla["fin_solicitud_servicio"]);
				printf("</TR>");
				
				// Imprimimos la descripci�n.
				printf("<TR>");
				printf("<TD CLASS='tabla' COLSPAN='2'>%s</TD>", nl2br(strtr($tupla["desc_envio"], $this->caracteres)));
				printf("</TR>");
				
				// Imprimimos un espacio en blanco.
				echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			}
			
			// Cierre de la tabla de las ofertas de pr�ctica.
			echo "</TABLE>";
			echo "</TD>";
			echo "</TR>";	
			
			// Imprimimos la paginaci�n.			
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "</TABLE>";
		}
		
		// Liberaci�n de memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de b�squeda.
		$this->formularioBusqueda();
	}
	
	/**
	 * M�todo que muestra el formulario de b�squeda para las ofertas de pr�ctica.
	 */
	function formularioBusqueda()
	{
		$titulo = "B&uacute;squeda de Ofertas de Pr&aacute;ctica";
		$ocultos = "";
		$comentario = "ofertas de pr&aacute;ctica";
		require("busquedasimple.inc");
	}
	
	/**
	 * M�todo que muestra el t�tulo de la secci�n 'B�squeda de Ofertas de Pr�ctica'.
	 */
	function tituloBusqueda()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Pr&aacute;ctica'>Pr&aacute;ctica</A> / <A HREF='index.php?pagina=1' TITLE='Ver Ofertas'>Ofertas</A> / B&uacute;squeda";
		$imagen = "activos/bgofertas.jpg";
		$titulo = "B&uacute;squeda de Ofertas de Pr&aacute;ctica";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * M�todo en el cual se buscan las ofertas de pr�cticas que coincidan con la
	 * palabra o frase ingresada.
	 */
	function buscar($palabra, $pagina)
	{
		// Librer�as necesarias.
		include("paginacion.php");
		
		// Inicializaci�n de variables.
		$vinculo = "buscar.php?palabra=" .$palabra. "&";
		$porpagina = 5;
		
		// Consulta que obtiene las ofertas de practica que coinciden con la alabra ingresada.
		$consulta = "SELECT persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, envio.titulo_envio, envio.desc_envio, solicitud_servicio.inicio_solicitud_servicio, solicitud_servicio.fin_solicitud_servicio, solicitud_servicio.id_empresa FROM persona, envio, solicitud_servicio, usuario WHERE solicitud_servicio.id_servicio = 1 AND (envio.titulo_envio LIKE '%$palabra%' OR envio.desc_envio LIKE '%$palabra%') AND persona.id_persona = usuario.id_persona AND envio.id_envio = solicitud_servicio.id_envio AND solicitud_servicio.id_persona = usuario.id_persona ORDER BY inicio_solicitud_servicio DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay ofertas de pr�ctica.
		if ($total == 0)
			echo "<P CLASS='contenido'>No se encontraron ofertas de pr&aacute;ctica.</P>";
		
		// Cuano si hay ofertas de pr�ctica.
		else
		{
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			
			// Tabla para el total, la paginaci�n y las ofertas.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total ofertas de pr&aacute;ctica.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";			
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>&nbsp;</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para las ofertas.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condici�n de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos las ofertas.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Imprimimos la el titulo de la solicitud.
				printf("<TR>");
				printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>Solicitud:</B></TD>", "23%");
				printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>%s</B></TD>", "77%", strtr($tupla["titulo_envio"], $this->caracteres));
				printf("</TR>");
				
				// Imprimimos el autor del mensaje y su email, si existe.
				printf("<TR>");
				printf("<TD CLASS='tabla' VALIGN='top'><B>Autor:</B></TD>");
				$nombre = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
				printf("<TD CLASS='tabla' VALIGN='top'>%s", $nombre);
				if ($tupla["email_persona"])
				{
					$email = strtr($tupla["email_persona"], $this->caracteres);
					printf(" (<A HREF='mailto:%s' TITLE='%s'>%s</A>)", $email, $email, $email);
				}
				printf("</TD>");
				printf("</TR>");			
				
				// Mostramos el nombre de la empresa.	
				$id_empresa = $tupla["id_empresa"];
				if (isset($id_empresa) && $id_empresa != NULL)
				{
					// Consulta para obtener el nombre de la empresa.
					$consulta = "SELECT nombre_empresa, url_empresa FROM empresa WHERE empresa.id_empresa = $id_empresa";
					$resp = mysql_query($consulta, $this->enlace);
					$fila = mysql_fetch_array($resp);
					
					// Imprimimos la empresa.
					printf("<TR>");
					printf("<TD CLASS='tabla' VALIGN='top'><B>Empresa:</B></TD>");
					$empresa = strtr($fila["nombre_empresa"], $this->caracteres);
					if ($fila["url_empresa"])
						printf("<TD CLASS='tabla' VALIGN='top'><A HREF='http://%s' TITLE='Visitar Web de %s' TARGET='_blank'>%s</A></TD>", strtr($fila["url_empresa"], $this->caracteres), $empresa, $empresa);
					else printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $empresa);
					printf("</TR>");
					
					// Liberaci�n de memoria en el servidor.
					mysql_free_result($resp);
				}
				
				// Imprimimos la fecha de inicio y t�rmino.
				printf("<TR>");
				printf("<TD CLASS='tabla' VALIGN='top'><B>Inicio / T&eacute;rmino:</B></TD>");
				printf("<TD CLASS='tabla' VALIGN='top'>%s / %s</TD>", $tupla["inicio_solicitud_servicio"], $tupla["fin_solicitud_servicio"]);
				printf("</TR>");
				
				// Imprimimos la descripci�n.
				printf("<TR>");
				printf("<TD CLASS='tabla' COLSPAN='2'>%s</TD>", nl2br(strtr($tupla["desc_envio"], $this->caracteres)));
				printf("</TR>");
				
				// Imprimimos un espacio en blanco.
				echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			}
			
			// Cierre tabla de las ofertas de pr�ctica.
			echo "</TABLE>";
			echo "</TD>";
			echo "</TR>";	
			
			// Imprimimos la paginaci�n.			
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "</TABLE>";
		}
		
		// Liberaci�n de memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de b�squeda.
		$this->formularioBusqueda();
	}
}
?>