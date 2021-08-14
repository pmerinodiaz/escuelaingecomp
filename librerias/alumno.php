<?PHP
/**
 * alumno.php.
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
 * Clase que administra los registros de los alumnos existentes en la base de datos. Los
 * alumnos son las personas que cursan asignaturas en la carrera de Ingenier�a en Computaci�n
 * en la ULS o bien aquellos que son tesistas.
 */

class alumno
{
	// Enlace a la base de datos.
	var $enlace;
	
	// Juego de caracteres especiales del servidor.
	var $caracteres;		
	
	/**
	 * M�todo constructor que inicializa el enlace a la base de datos y setea el juego de
	 * caracteres del servidor.
	 *
	 * @param link El enlace a la base de datos.
	 */
	function alumno($link)
	{
		$this->enlace = $link;
		$this->caracteres = get_html_translation_table(HTML_SPECIALCHARS);
	}
	
	/**
	 * M�todo que muestra el t�tulo de la secci�n 'Directorio de Alumnos'.
	 */
	function tituloDirectorio()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Integrantes'>Integrantes</A> / <A HREF='index.php' TITLE='Ver Alumnos'>Alumnos</A> / Directorio</TD>";
		$imagen = "activos/bgalumnos.jpg";
		$titulo = "Directorio de Alumnos";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * M�todo en que muestran a todos los alumnos (en forma paginada) que tiene la Escuela
	 * Ingenier�a en Computaci�n y cuyo apellido paterno comienza con la letra especificada
	 * en los par�metros.
	 *
	 * @param $indice La primera letra del comienzo del apellido paterno.
	 * @param $pagina La p�gina actual dentro de la paginaci�n total.
	 */
	function mostrar($indice, $pagina)
	{
		// Librer�as necesarias.
		include("paginacion.php");
		include("letras.php");
		
		// Inicializaci�n de variables.
		$vinculo = "alumnos.php?letra=".$indice."&";
		$porpagina = 25;
		
		// Consulta que lista los alumnos.
		$consulta = "SELECT persona.paterno_persona, persona.materno_persona, persona.nombres_persona, persona.email_persona, persona.url_persona FROM persona, usuario_interno, alumno WHERE persona.paterno_persona LIKE '$indice%' AND usuario_interno.id_estado_interno = 1 AND persona.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = alumno.id_persona ORDER BY paterno_persona, materno_persona, nombres_persona, email_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Creamos un objeto letras.
		$letra = new letras();
		
		// Abrimos la tabla para el abecedario, el total, la paginaci�n y la lista de alumnos.
		echo "<TABLE WIDTH='100%' BORDER='0'>";					
		echo "<TR>";
		echo "<TD ALIGN='center' CLASS='contenido'>";
		$letra->mostrar("alumnos.php", $indice);
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>";
		
		// Cuando no hay alumnos.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay alumnos.</P>";
		
		// Cuando si hay alumnos.
		else
		{
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			
			// Imprimimos la cantidad de alumnos y las flechas de navegaci�n para las p�ginas.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total alumnos.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='1' HEIGHT='7'></TD></TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para la lista de alumnos.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD WIDTH='40%' ALIGN='center' CLASS='titulotabla'>Nombre</TD>";
			echo "<TD WIDTH='30%' ALIGN='center' CLASS='titulotabla'>E-mail</TD>";
			echo "<TD WIDTH='30%' ALIGN='center' CLASS='titulotabla'>Sitio Web</TD>";
			echo "</TR>";
			
			// Calculamos la condici�n de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde recorrimos los alumnos.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Mostramos el nombre completo.
				printf("<TR>");
				$nombre = $tupla["nombres_persona"]." ".$tupla["paterno_persona"]." ".$tupla["materno_persona"];
				printf("<TD CLASS='tabla'>%s</TD>", $nombre);
				
				// Mostramos el e-mail, si es que existe.
				if (isset($tupla["email_persona"]) && $tupla["email_persona"] != "")
				{
					$email = strtr($tupla["email_persona"], $this->caracteres);
					printf("<TD CLASS='tabla'><A HREF='mailto:%s' TITLE='%s'>%s</A></TD>", $email, $email, $email);
				}
				else printf("<TD CLASS='tabla'>&nbsp;</TD>");
				
				// Mostramos el sitio web, si es que existe.
				if (isset($tupla["url_persona"]) && $tupla["url_persona"] != "")
				{
					$url = strtr($tupla["url_persona"], $this->caracteres);
					printf("<TD CLASS='tabla'><A HREF='http://%s' TARGET='_blank' TITLE='Visitar Web de %s'>http://%s</A></TD>", $url, $nombre, $url);
				}
				else printf("<TD CLASS='tabla'>&nbsp;</TD>");
				
				printf("</TR>");
			}
			
			// Cerramos la tabla de los alumnos.
			echo "</TABLE>";
			echo "</TD>";
			echo "<TR><TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='1' HEIGHT='7'></TD></TR>";
			echo "</TR>";
			
			// Imprimimos la paginaci�n.			
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "</TABLE>";
		}
		
		// Cerramos la tabla de las letras.
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
		
		// Mostramos el formulario de b�squeda de alumnos.
		require("busquedaalumno.inc");
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * M�todo que muestra el t�tulo de la secci�n 'B�squeda de Alumnos'.
	 */
	function tituloBusqueda()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Integrantes'>Integrantes</A> / <A HREF='index.php' TITLE='Ver Alumnos'>Alumnos</A> / B&uacute;squeda</TD>";
		$imagen = "activos/bgalumnos.jpg";
		$titulo = "B&uacute;squeda de Alumnos";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * M�todo en que busca y muestra a los alumnos (en forma paginada) que tiene la Escuela
	 * Ingenier�a en Computacion y cuyos apellidos y nombres coinciden con los especificados
	 * en los par�metros.
	 *
	 * @param $nombres Los nombres del alumno.
	 * @param $apellidos Los apellidos del alumno.
	 * @param $pagina La p�gina actual dentro de la paginaci�n total.
	 */
	function buscar($nombres, $apellidos, $pagina)
	{
		// Librer�as necesarias.
		include("paginacion.php");
		include("letras.php");
		
		// Inicializaci�n de variables.
		$vinculo = "buscar.php?nombres=".$nombres."&apellidos=".$apellidos."&";
		$porpagina = 25;
		
		// Consulta que lista los alumnos cuyo nombre y apellido coincide con el especificado.
		$consulta = "SELECT persona.paterno_persona, persona.materno_persona, persona.nombres_persona, persona.email_persona, persona.url_persona FROM persona, usuario_interno, alumno WHERE (persona.nombres_persona LIKE '%$nombres%' AND (persona.paterno_persona LIKE '%$apellidos%' OR persona.materno_persona LIKE '%$apellidos%')) AND usuario_interno.id_estado_interno = 1 AND usuario_interno.id_persona = persona.id_persona AND usuario_interno.id_persona = alumno.id_persona ORDER BY persona.paterno_persona, persona.materno_persona, persona.nombres_persona, persona.email_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Creamos un objeto letras.
		$letra = new letras();
		
		// Abrimos la tabla para el directorio de las letras.
		echo "<TABLE WIDTH='100%' BORDER='0'>";					
		echo "<TR>";
		echo "<TD ALIGN='center' CLASS='contenido'>";
		$letra->mostrar("alumnos.php", "");
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>";
		
		// Cuando no hay alumnos.
		if ($total == 0)
			echo "<P CLASS='contenido'>No se encontraron alumnos.</P>";
		
		// Cuando hay alumnos.
		else
		{
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			
			// Tabla para el total, la paginaci�n y la lista de alumnos.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total alumnos.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='1' HEIGHT='7'></TD></TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para la lista de alumnos.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD WIDTH='40%' ALIGN='center' CLASS='titulotabla'>Nombre</TD>";
			echo "<TD WIDTH='30%' ALIGN='center' CLASS='titulotabla'>E-mail</TD>";
			echo "<TD WIDTH='30%' ALIGN='center' CLASS='titulotabla'>Sitio Web</TD>";
			echo "</TR>";
			
			// Calculamos la condici�n de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde recorremos los alumnos.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Mostramos el nombre completo.
				printf("<TR>");
				$nombre = $tupla["nombres_persona"]." ".$tupla["paterno_persona"]." ".$tupla["materno_persona"];
				printf("<TD CLASS='tabla'>%s</TD>", $nombre);
				
				// Mostramos el e-mail, si es que existe.
				if (isset($tupla["email_persona"]) && $tupla["email_persona"] != "")
				{
					$email = strtr($tupla["email_persona"], $this->caracteres);
					printf("<TD CLASS='tabla'><A HREF='mailto:%s' TITLE='%s'>%s</A></TD>", $email, $email, $email);
				}
				else printf("<TD CLASS='tabla'>&nbsp;</TD>");
				
				// Mostramos el sitio web, si es que existe.
				if (isset($tupla["url_persona"]) && $tupla["url_persona"] != "")
				{
					$url = strtr($tupla["url_persona"], $this->caracteres);
					printf("<TD CLASS='tabla'><A HREF='http://%s' TARGET='_blank' TITLE='Visitar Web de %s'>http://%s</A></TD>", $url, $nombre, $url);
				}
				else printf("<TD CLASS='tabla'>&nbsp;</TD>");
				
				printf("</TR>");
			}
			
			// Cerramos la tabla alumnos.
			echo "</TABLE>";
			echo "</TD>";
			echo "<TR><TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='1' HEIGHT='7'></TD></TR>";
			echo "</TR>";
			
			// Imprimimos la paginaci�n.			
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "</TABLE>";
		}
		
		// Cerramos la tabla de las letras.
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
		
		// Mostramos el formulario de b�squeda de alumnos.
		require("busquedaalumno.inc");
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
}
?>