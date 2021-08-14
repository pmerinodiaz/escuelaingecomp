<?PHP
/**
 * ayudante.php.
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
 * Clase que administra los registro de los alumnos ayudantes en las asignaturas que se
 * dicatan en la carrera de Ingeniería en Computación de la ULS. Los ayudantes son alumnos
 * que trabajan como ayudantes de académicos en las diversas asignatura de la carrera de
 * Ingeniería en Computación.
 */

class ayudante
{
	// Enlace a la base de datos.
	var $enlace;
	
	// Juego de caracteres especiales del servidor.
	var $caracteres;		
	
	/**
	 * Método constructor que inicializa el enlace de la base de datos.
	 */
	function ayudante($link)
	{
		$this->enlace = $link;
		$this->caracteres = get_html_translation_table(HTML_SPECIALCHARS);
	}
	
	/**
	 * Método que muestra un listado con todos los años en los cuales hay ayudantías.
	 */
	function mostrarAnio()
	{
		// Consulta que obtiene todos los años en que existe ayudantías.
		$consulta = "SELECT anio_ayudantia FROM ayudantia GROUP BY anio_ayudantia ORDER BY anio_ayudantia DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay ayudantías.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay alumnos ayudantes.</P>";
		
		// Cuando si hay ayudantías.
		else
		{
			// Ciclo en donde recorremos los resultados y mostramos los años.
			printf("<UL>");
			while ($tupla = mysql_fetch_array($resultado))
			  printf("<LI><A HREF='ayudantes.php?anio=%d' TITLE='Ver Ayudantes del A&ntilde;o %d'>Ayudantes del A&ntilde;o %d</A></LI>", $tupla["anio_ayudantia"], $tupla["anio_ayudantia"], $tupla["anio_ayudantia"]);
			printf("</UL>");
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que muestra el título de la sección Ayudantes.
	 */
	function titulo($anio)
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Integrantes'>Integrantes</A> / <A HREF='index.php' TITLE='Ver Ayudantes'>Ayudantes</A> / A&ntilde;o " . $anio;
		$imagen = "activos/bgayudantes.jpg";
		$titulo = "Ayudantes del A&ntilde;o " . $anio;
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra a los ayudantes que tiene la Escuela Ingeniería en Computación
	 * del año actual.
	 */
	function mostrar($anio)
	{
		// Consulta para obtener a los alumnos ayudantes.
		$consulta = "SELECT ayudantia.id_semestre, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, asignatura.id_asignatura, malla.id_estado_malla, asignatura.nombre_asignatura FROM ayudantia, alumno, persona, usuario_interno, asignatura, malla WHERE ayudantia.anio_ayudantia = $anio  AND usuario_interno.id_estado_interno = 1 AND ayudantia.id_persona = alumno.id_persona AND alumno.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = persona.id_persona AND ayudantia.id_asignatura = asignatura.id_asignatura AND asignatura.id_malla = malla.id_malla ORDER BY ayudantia.id_semestre, asignatura.nombre_asignatura";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay alumnos ayudantes.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay alumnos ayudantes.</P>";
		
		// Cuando si hay alumnos ayudantes.
		else
		{
			// Valores por defecto.
			$semestre = 0;
			
			// Tabla para la lista de alumnos ayudantes.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Ciclo en donde recorremos a los alumnos ayudantes.
			while ($tupla = mysql_fetch_array($resultado))
			{
				// Se muestra el semestre una sola vez.
				if ($semestre != $tupla["id_semestre"])
				{
					$semestre = $tupla["id_semestre"];
					echo "<TR><TD COLSPAN='3'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='1' HEIGHT='3'></TR></TD>";
					echo "<TR>";
					echo "<TD COLSPAN='3' CLASS='contenido'><B>Ayudant&iacute;as del ";
					switch ($semestre)
					{
						case 1: echo "Primer Semestre"; break;
						case 2: echo "Segundo Semestre"; break;
					}
					echo "</B></TD>";
					echo "<TR><TD COLSPAN='3'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='1' HEIGHT='7'></TR></TD>";
					echo "</TR>";
					echo "<TR>";
					
					// Imprimimos el encabezado de la tabla de las ayudantías.
					echo "<TD WIDTH='40%' CLASS='titulotabla' ALIGN='center'>Asignatura</TD>";
					echo "<TD WIDTH='25%' CLASS='titulotabla' ALIGN='center'>Ayudante</TD>";
					echo "<TD WIDTH='35%' CLASS='titulotabla' ALIGN='center'>E-mail</TD>";
					echo "</TR>";
				}
				else printf("<TR>");
				
				// Mostramos la asignatura, con un vínculo al programa de estudio (si es de la malla vigente).
				if ($tupla["id_estado_malla"] == 1)
					printf("<TD CLASS='tabla' VALIGN='top'><A HREF='../../asignaturas/descripcion.php?id=%d' TITLE='Ver Programa de Estudio de %s'>%s</A></TD>", $tupla["id_asignatura"], $tupla["nombre_asignatura"], $tupla["nombre_asignatura"]);
				else printf("<TD CLASS='tabla'>%s</TD>", $tupla["nombre_asignatura"]);
				
				// Mostramos el nombre completo del ayudante.
				$nombre = $tupla["nombres_persona"]." ".$tupla["paterno_persona"]." ".$tupla["materno_persona"];
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $nombre);
				
				// Mostramos el e-mail del ayudante, si existe.
				if (isset($tupla["email_persona"]) && $tupla["email_persona"] != "")
				{
					$email = strtr($tupla["email_persona"], $this->caracteres);
					printf("<TD CLASS='tabla' VALIGN='top'><A HREF='mailto:%s' TITLE='%s'>%s</A></TD>", $email, $email, $email);
				}
				else echo "<TD CLASS='tabla' VALIGN='top'>&nbsp;</TD>";
				
				echo "</TR>";
			}
			
			// Imprimimos el fin de la tabla alumnos ayudantes.
			echo "<TR><TD COLSPAN='3'>&nbsp;</TD></TR>";
			echo "<TR><TD COLSPAN='3' ALIGN='center'><A HREF='javascript:history.back(1);' TITLE='Volver'><IMG SRC='../../librerias/btvolver.gif' BORDER='0'></A></TD></TR>";
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
}
?>