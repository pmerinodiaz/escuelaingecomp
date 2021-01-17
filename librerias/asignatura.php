<?PHP
/**
 * asignatura.php.
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
 * Clase que representa a las asignaturas que se cursan en la carrera Ingeniería en
 * Computación de la ULS. Esta clase administra los registros de las asignaturas existentes
 * en la base de datos. Las asignaturas tienen una descripción general, objetivos generales,
 * objetivos específicos, contenidos y una bibliografía.
 */

class asignatura
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param $link Conexión hacia una base de datos que ya ha sido establecida.
	 */
	function asignatura($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que muestra el plan de estudio vigente de la carrera. Se muestra información del
	 * nivel, código, nombre de la asignatura, requisitos, periodicidad y ciclo.
	 */
	function planEstudio()
	{
		// Valores por defecto.
		$ciclo = "";
		$nivel = -1;
		
		// Consulta que lista las asignaturas del plan de estudio.
		$consulta = "SELECT asignatura.id_asignatura, asignatura.anio_asignatura, nivel.numero_nivel, asignatura.codigo_asignatura, asignatura.nombre_asignatura, asignatura.hr_teoria, asignatura.hr_ejercicio, asignatura.hr_laboratorio, periodicidad.nombre_periodicidad, ciclo.nombre_ciclo FROM asignatura, malla, nivel, periodicidad, ciclo WHERE asignatura.id_malla = malla.id_malla AND malla.id_estado_malla = 1 AND periodicidad.id_periodicidad = asignatura.id_periodicidad AND nivel.id_nivel = asignatura.id_nivel AND ciclo.id_ciclo = asignatura.id_ciclo ORDER BY ciclo.nombre_ciclo, asignatura.anio_asignatura, nivel.id_nivel, asignatura.codigo_asignatura";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay asignaturas.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay asignaturas.</P>";
		
		// Cuando si hay asignaturas.
		else
		{
			// Abrimos la tabla e imprimimos el encabezado.
			echo "<TABLE WIDHT='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD WIDTH='5%' CLASS='titulotabla' ALIGN='center'>Nivel</TD>";
			echo "<TD WIDTH='10%' CLASS='titulotabla' ALIGN='center'>C&oacute;digo</TD>";
			echo "<TD WIDTH='45%' CLASS='titulotabla' ALIGN='center'>Asignatura</TD>";
			echo "<TD WIDTH='10%' CLASS='titulotabla' ALIGN='center'>T-E-L</TD>";
			echo "<TD WIDTH='20%' CLASS='titulotabla' ALIGN='center'>Requisito</TD>";
			echo "<TD WIDTH='10%' CLASS='titulotabla' ALIGN='center'>Periodicidad</TD>";
			echo "</TR>";
			
			// Imprimimos las asignaturas.
			while ($fila = mysql_fetch_array($resultado))
			{
				// Se muestra el ciclo solo una vez.
				if ($ciclo != $fila["nombre_ciclo"])
				{
					$ciclo = $fila["nombre_ciclo"];
					printf("<TR>");
					printf("<TD COLSPAN='7' CLASS='tabla' ALIGN='center' VALIGN='top'>CICLO %s</TD>", strtoupper($ciclo));
					printf("</TR>");
				}
				else printf("<TR>");
				
				// Se muestra el nivel solo una vez.
				if ($nivel != $fila["numero_nivel"])
				{
					$nivel = $fila["numero_nivel"];
					printf("<TD CLASS='tabla' ALIGN='center' VALIGN='top'>%d</TD>", $nivel);
				}
				else printf("<TD CLASS='tabla'>&nbsp;</TD>");
				
				// Mostramos el código.
				printf("<TD CLASS='tabla' ALIGN='center' VALIGN='top'>%s</TD>", $fila["codigo_asignatura"]);
				
				// Mostramos el nombre.
				printf("<TD CLASS='tabla' VALIGN='top'><A HREF='../../asignaturas/descripcion.php?id=%d' TITLE='Ver Programa de Estudio de %s'>%s</A></TD>", $fila["id_asignatura"], $fila["nombre_asignatura"], $fila["nombre_asignatura"]);
				
				// Mostramos el T-E-L.
				printf("<TD CLASS='tabla' ALIGN='center' VALIGN='top'>%d-%d-%d</TD>", $fila["hr_teoria"], $fila["hr_ejercicio"], $fila["hr_laboratorio"]);
				
				// Mostramos los requisitos.
				printf("<TD CLASS='tabla' ALIGN='center' VALIGN='top'>%s</TD>", $this->requisitos($fila["id_asignatura"]));
				
				// Mostramos la periodicidad.
				printf("<TD CLASS='tabla' ALIGN='center' VALIGN='top'>%s</TD>", $fila["nombre_periodicidad"]);
				
				// Se cierra la fila.
				if ($ciclo == $fila["nombre_ciclo"])
					printf("</TR>");
			}
			
			// Imprimimos dos las filas de espacios en blanco.
			echo "<TR><TD COLSPAN='6'>&nbsp;</TD></TR>";
			echo "<TR><TD COLSPAN='6'>&nbsp;</TD></TR>";
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que devuelve un string con los requisitos que tiene una asignatura.
	 *
	 * @param $id_asignatura El identificador de la asignatura.
	 *
	 * @return $texto El string con los códigos de las asignaturas que son requisitos.
	 */
	function requisitos($id_asignatura)
	{
		// Texto en donde almacenamos los requisitos.
		$texto = "";
		
		// Filtramos por identificación de asignatura.
		switch ($id_asignatura)
		{
			// Esto es solo para la malla actual (año 2002), ya que el Modelo de Datos no lo controla.
			case 45: $texto = "Ingreso"; break;
			case 46: $texto = "Ingreso"; break;
			case 47: $texto = "Ingreso"; break;
			case 69: $texto = "Ciclo B&aacute;sico"; break;
			case 78: $texto = "6º Nivel"; break;
			case 82: $texto = "Seg&uacute;n Cont."; break;
			case 83: $texto = "Seg&uacute;n Cont."; break;
			case 84: $texto = "Seg&uacute;n Cont."; break;
			case 85: $texto = "Seg&uacute;n Cont."; break;
			case 86: $texto = "7º Nivel"; break;
			default:
			{
				// Consulta que busca los requisitos de la asignatura.
				$consulta = "SELECT asignatura.codigo_asignatura FROM asignatura, requisito WHERE requisito.id_asignatura = $id_asignatura AND requisito.id_asignatura_requisito = asignatura.id_asignatura";
				$requisitos = mysql_query($consulta, $this->enlace);
				$num_requisitos = mysql_num_rows($requisitos);
				
				// Recorremos los requisitos para concadenarlos en el string.
				while ($tupla = mysql_fetch_array($requisitos))
				{
					// Si hay un solo requisito.
					if ($num_requisitos == 1)
						$texto = $texto.$tupla["codigo_asignatura"];
					
					// Si hay más de un requisito.
					else
					{
						$texto = $texto.$tupla["codigo_asignatura"]." - ";
						$num_requisitos--;
					}
				}
				// Liberamos memoria en el servidor.
				mysql_free_result($requisitos);
				
				break;
			}
		}
		
		return $texto;
	}
	
	/**
	 * Método que muestra las asignaturas de la malla nueva.
	 */
	function mostrar()
	{
		// Valor por defecto.
		$nivel = -1;
		
		// Consulta que muestra la lista de asignaturas vigentes del plan de estudio.
		$consulta = "SELECT asignatura.id_asignatura, nivel.numero_nivel, asignatura.codigo_asignatura, asignatura.nombre_asignatura, asignatura.url_asignatura FROM asignatura, malla, nivel WHERE asignatura.id_malla = malla.id_malla AND malla.id_estado_malla = 1 AND nivel.id_nivel = asignatura.id_nivel ORDER BY asignatura.anio_asignatura, nivel.id_nivel, asignatura.codigo_asignatura";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay asignaturas.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay asignaturas.</P>";
		
		// Cuando si hay asignaturas.
		else
		{
			// Abrimos tabla para las asignaturas.
			echo "<TABLE WIDHT='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD WIDTH='5%' ALIGN='center' CLASS='titulotabla'>Sem</TD>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'>C&oacute;digo</TD>";
			echo "<TD WIDTH='50%' ALIGN='center' CLASS='titulotabla'>Asignatura</TD>";
			echo "<TD WIDTH='45%' ALIGN='center' CLASS='titulotabla'>Sitio Web</TD>";
			echo "</TR>";
			
			// Ciclo en donde se imprimen las asignaturas.
			while ($fila = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				
				// Mostramos el nivel solo una vez.
				if ($nivel != $fila["numero_nivel"])
				{
					$nivel = $fila["numero_nivel"];
					printf("<TD ALIGN='center' CLASS='tabla'>%d</TD>", $nivel);
				}
				else printf("<TD CLASS='tabla'>&nbsp;</TD>");
				
				// Mostramos el código.
				printf("<TD ALIGN='center' CLASS='tabla'>%s</TD>", $fila["codigo_asignatura"]);
				
				// Mostramos el nombre.
				printf("<TD CLASS='tabla'><A HREF='descripcion.php?id=%d' TITLE='Ver Programa de Estudio de %s'>%s</A></TD>", $fila["id_asignatura"], $fila["nombre_asignatura"], $fila["nombre_asignatura"]);
				
				// Mostramos la dirección Web, si existe.
				if ($fila["url_asignatura"])
					printf("<TD BGCOLOR='F1F3F3' CLASS='tabla'><A HREF='http://%s' TARGET='_blank' TITLE='Visitar Web de %s'>http://%s</A></TD>", $fila["url_asignatura"], $fila["nombre_asignatura"], $fila["url_asignatura"]);
				else printf("<TD BGCOLOR='F1F3F3' CLASS='tabla'>&nbsp;</TD>");
				
				printf("</TR>");
			}
			
			// Imprimimos el fin de la tabla.		
			echo "<TR>";
			echo "<TD COLSPAN='4'>&nbsp;</TD>";
			echo "</TR>";
			echo "</TABLE>";
		}
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que muestra el título de la sección Asignaturas.
	 *
	 * @param $id_asignatura El identificador de la asignatura.
	 * @param $item El elemento en donde esta ubicado el usuario.
	 */
	function mostrarTitulo($item, $id_asignatura)
	{
		// Consulta para obtener el nombre de la asignatura.
		$consulta = "SELECT nombre_asignatura FROM asignatura WHERE id_asignatura = $id_asignatura";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		
		// Mostramos el título.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD WIDTH='76%' CLASS='ubicacion'>Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php' TITLE='Ver Asignaturas'>Asignaturas</A> / ";
		echo $fila["nombre_asignatura"];
		echo "</TD>";
		echo "<TD ROWSPAN='2' WIDTH='24%' VALIGN='TOP'><IMG SRC='activos/bgasignaturas.jpg' WIDTH='110' HEIGHT='45'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='76%' HEIGHT='21' CLASS='titulo'>";
		echo $fila["nombre_asignatura"];
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'><IMG SRC='../librerias/pxgris.gif' WIDTH='460' HEIGHT='1'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='opcion'>";
		
		// Cuando es Descripción.
		if ($item == 1)
			echo "[ Descripci&oacute;n ] ";
		else printf("<A HREF='descripcion.php?id=%d' TITLE='Ver Descripci&oacute;n de %s'>[ Descripci&oacute;n ]</A> ", $id_asignatura, $fila["nombre_asignatura"]);
		
		// Cuando es Objetivos.
		if ($item == 2)
			echo "[ Objetivos ] ";
		else printf("<A HREF='objetivos.php?id=%d' TITLE='Ver Objetivos de %s'>[ Objetivos ]</A> ", $id_asignatura, $fila["nombre_asignatura"]);
		
		// Cuando es Contenidos.
		if ($item == 3)
			echo "[ Contenidos ] ";
		else printf("<A HREF='contenidos.php?id=%d' TITLE='Ver Contenidos de %s'>[ Contenidos ]</A> ", $id_asignatura, $fila["nombre_asignatura"]);
		
		// Cuando es Bibliografía.
		if ($item == 4)
			echo "[ Bibliograf&iacute;a ] ";
		else printf("<A HREF='bibliografia.php?id=%d' TITLE='Ver Bibliograf&iacute;a de %s'>[ Bibliograf&iacute;a ]</A> ", $id_asignatura, $fila["nombre_asignatura"]);
		
		echo "</TD>";
		echo "</TR>";
		echo "<TR><TD>&nbsp;</TD></TR>";
		echo "</TABLE>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método en el cual se muestra la descripción completa de una asignatura.
	 *
	 * @param $id_asignatura El identificador de la asignatura.
	 */
	function descripcion($id_asignatura)
	{
		// Librerías necesarias.
		include("formato.php");
		
		// Consulta que muestra toda la información de una asignatura.
		$consulta = "SELECT	asignatura.nombre_asignatura, nivel.numero_nivel, asignatura.codigo_asignatura, asignatura.hr_teoria, asignatura.hr_ejercicio, asignatura.hr_laboratorio, asignatura.anio_asignatura, semestre.nombre_semestre, periodicidad.nombre_periodicidad, ciclo.nombre_ciclo, asignatura.url_asignatura, asignatura.desc_asignatura, asignatura.url_programa, asignatura.id_formato FROM asignatura, malla, nivel, semestre, periodicidad, ciclo WHERE asignatura.id_asignatura = $id_asignatura AND malla.id_estado_malla = 1 AND asignatura.id_malla = malla.id_malla AND asignatura.id_nivel = nivel.id_nivel AND asignatura.id_semestre = semestre.id_semestre AND asignatura.id_periodicidad = periodicidad.id_periodicidad AND asignatura.id_ciclo = ciclo.id_ciclo";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		
		// Tabla para la descripción completa.
		printf("<TABLE WIDTH='%s' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>", "100%");
		printf("<TR>");
		printf("<TD CLASS='contenido' COLSPAN='2'><STRONG>DESCRIPCION</STRONG></TD>");
		printf("</TR>");
		printf("<TR>");
		printf("<TD COLSPAN='2'>&nbsp;</TD>");
		printf("</TR>");
		
		// Mostramos el nombre.
		printf("<TR>");
		printf("<TD CLASS='contenido' WIDTH='%s'><STRONG>Nombre:</STRONG></TD>", "25%");
		printf("<TD CLASS='contenido' WIDTH='%s'>%s</TD>", "75%", $fila["nombre_asignatura"]);
		printf("</TR>");
		
		// Mostramos el nivel.
		printf("<TR>");
		printf("<TD CLASS='contenido'><STRONG>Nivel:</STRONG></TD>");
		printf("<TD CLASS='contenido'>%s</TD>", $fila["numero_nivel"]);
		printf("</TR>");
		
		// Mostramos el código.
		printf("<TR>");
		printf("<TD CLASS='contenido'><STRONG>C&oacute;digo:</STRONG></TD>");
		printf("<TD CLASS='contenido'>%s</TD>", $fila["codigo_asignatura"]);
		printf("</TR>");
		
		// Mostramos el T-E-L.
		printf("<TR>");
		printf("<TD CLASS='contenido'><STRONG>T-E-L:</STRONG></TD>");
		printf("<TD CLASS='contenido'>%d-%d-%d</TD>", $fila["hr_teoria"], $fila["hr_ejercicio"], $fila["hr_laboratorio"]);
		printf("</TR>");
		
		// Mostramos los requisitos.
		printf("<TR>");
		printf("<TD CLASS='contenido'><STRONG>Requisito:</STRONG></TD>");
		printf("<TD CLASS='contenido'>%s</TD>", $this->requisitos($id_asignatura));
		printf("</TR>");
		
		// Mostramos el año.
		printf("<TR>");
		printf("<TD CLASS='contenido'><STRONG>A&ntilde;o:</STRONG></TD>");
		printf("<TD CLASS='contenido'>%s</TD>", $fila["anio_asignatura"]);
		printf("</TR>");
		
		// Mostramos el semestre.
		printf("<TR>");
		printf("<TD CLASS='contenido'><STRONG>Semestre:</STRONG></TD>");
		printf("<TD CLASS='contenido'>%s</TD>", $fila["nombre_semestre"]);
		printf("</TR>");
		
		// Mostramos la periodicidad.
		printf("<TR>");
		printf("<TD CLASS='contenido'><STRONG>Periodicidad:</STRONG></TD>");
		printf("<TD CLASS='contenido'>%s</TD>", $fila["nombre_periodicidad"]);
		printf("</TR>");
		
		// Mostramos el ciclo.
		printf("<TR>");
		printf("<TD CLASS='contenido'><STRONG>Ciclo:</STRONG></TD>");
		printf("<TD CLASS='contenido'>%s</TD>", $fila["nombre_ciclo"]);
		printf("</TR>");
		
		// Mostramos el sitio Web, si es que existe.
		if (isset($fila["url_asignatura"]) && $fila["url_asignatura"] != "")
		{
			printf("<TR>");
			printf("<TD CLASS='contenido'><STRONG>Sitio Web:</STRONG></TD>");
			printf("<TD CLASS='contenido'><A HREF='http://%s' TARGET='_blank' TITLE='Visitar Web de %s'>http://%s</A></TD>", $fila["url_asignatura"], $fila["nombre_asignatura"], $fila["url_asignatura"]);
			printf("</TR>");
		}
		
		// Mostramos la descripción de la asignatura, si existe.
		if (isset($fila["desc_asignatura"]) && $fila["desc_asignatura"] != "")
		{
			printf("<TR><TD COLSPAN='2'>&nbsp;</TD></TR>");
			printf("<TR>");
			printf("<TD CLASS='contenido' COLSPAN='2'>%s</TD>", nl2br(strtr($fila["desc_asignatura"], get_html_translation_table(HTML_SPECIALCHARS))));
			printf("</TR>");
		}
		
		// Mostramos el enlace al programa, si existe.
		if (isset($fila["url_programa"]) && $fila["url_programa"] != "")
		{
			$formato = new formato($this->enlace);
			printf("<TR><TD COLSPAN='2'>&nbsp;</TD></TR>");
			printf("<TR>");
			printf("<TD COLSPAN='2' CLASS='contenido'><A HREF='%s' TITLE='Descargar Programa de Estudio de %s'><IMG SRC='../librerias/%s' BORDER='0'> Descargar Programa de Estudio</A></TD>", $fila["url_programa"], $fila["nombre_asignatura"], $formato->src($fila["id_formato"]));
			printf("</TR>");
		}
		
		// Espacios en blanco y cierre de la tabla.
		printf("<TR><TD COLSPAN='2'>&nbsp;</TD></TR>");
		printf("<TR><TD COLSPAN='2'>&nbsp;</TD></TR>");
		printf("</TABLE>");
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/*
	 * Método que lista los objetivos de una aisgnatura.
	 *
	 * @param $id_asignatura El identificador de la asignatura.
	 */
	function objetivos($id_asignatura)
	{
		// Consulta para obtener los objetivos de la asignatura.
		$consulta = "SELECT desc_objetivo FROM objetivo WHERE id_asignatura = $id_asignatura";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Tabla para la objetivos.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><STRONG>OJETIVOS</STRONG></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>&nbsp;</TD>";
		echo "</TR>";
		echo "<TD CLASS='contenido'>";
		echo "<UL>";
		
		// Capturamos el juego de caracteres existentes.
		$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
		
		// Ciclo en donde se muestran los objetivos.
		while ($fila = mysql_fetch_array($resultado))
			printf("<LI>%s</LI>", nl2br(strtr($fila["desc_objetivo"], $caracteres)));
		
		// Cerramos la agrupación y la tabla.
		echo "</UL>";
		echo "</TD>";
		echo "</TABLE>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/*
	 * Método que muestra los contenidos de una asignatura.
	 *
	 * @param $id_asignatura El identificador de la asignatura.
	 */
	function contenidos($id_asignatura)
	{
		// Consulta para buscar los capítulos de una asignatura.
		$consulta = "SELECT id_capitulo, numero_capitulo, nombre_capitulo FROM capitulo WHERE id_asignatura = $id_asignatura ORDER BY numero_capitulo";
		$capitulos = mysql_query($consulta, $this->enlace);
		
		// Abrimos la tabla para los contenidos.
		echo "<TABLE WIDHT='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido' COLSPAN='2'><STRONG>CONTENIDOS</STRONG></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>&nbsp;</TD>";
		echo "</TR>";
		
		// Capturamos el juego de caracteres existentes.
		$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
		
		// Ciclo en donde mostramos los capítulos.
		while ($fila = mysql_fetch_array($capitulos))
		{
			printf("<TR>");
			printf("<TD CLASS='contenido' COLSPAN='2'><STRONG>Cap. %d. %s</STRONG></TD>", $fila["numero_capitulo"], strtr($fila["nombre_capitulo"], $caracteres));
			printf("</TR>");
			
			// Capturamos la identificación del capítulo para listar los tópicos.
			$id_capitulo = $fila["id_capitulo"];
			$consulta = "SELECT numero_topico, nombre_topico FROM topico WHERE id_capitulo = $id_capitulo ORDER BY numero_topico";
			$topicos = mysql_query($consulta, $this->enlace);
			
			// Ciclo en donde mostramos los tópicos de un capítulo.
			while ($tupla = mysql_fetch_array($topicos))
			{
				printf("<TR>");
				printf("<TD CLASS='contenido' WIDTH='%s' VALIGN='top'>%d.%d</TD>", "15%", $fila["numero_capitulo"], $tupla["numero_topico"]);
				printf("<TD CLASS='contenido' WIDTH='%s' VALIGN='top'>%s</TD>", "85%", strtr($tupla["nombre_topico"], $caracteres));
				printf("</TR>");
			}
			
			// Imprimimos un espacio entre medio.
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			
			// Liberamos memoria en el servidor.
			mysql_free_result($topicos);
		}
		
		// Imprimimos un espacio en blanco y cerramos la tabla.
		echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
		echo "</TABLE>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($capitulos);
	}
	
	/*
	 * Método en el cual mostramos la bibliografía de una asignatura.
	 *
	 * @param $id_asignatura El identificador de la asignatura.
	 */
	function bibliografia($id_asignatura)
	{
		// Consulta que muestra los libros de la bibliografía de una asignatura.
		$consulta = "SELECT publicacion.id_publicacion, publicacion.titulo_publicacion, empresa.nombre_empresa, publicacion.anio_publicacion FROM bibliografia, publicacion, libro, empresa WHERE bibliografia.id_asignatura = $id_asignatura AND bibliografia.id_publicacion = libro.id_publicacion AND libro.id_publicacion = publicacion.id_publicacion AND libro.id_empresa = empresa.id_empresa ORDER BY titulo_publicacion";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos la tabla para mostrar la bibliografía.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><STRONG>BIBLIOGRAFIA</STRONG></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='contenido'>";
		echo "<UL>";
		
		// Capturamos el juego de caracteres existentes.
		$caracteres = get_html_translation_table(HTML_SPECIALCHARS);
		
		// Ciclo para mostrar los libros de la bibliografía.
		while ($tupla = mysql_fetch_array($resultado))
		{
			printf("<LI>");
			$id_publicacion = $tupla["id_publicacion"];
			
			// Consulta para buscar los autores de una publicación.
			$consulta = "SELECT persona.paterno_persona FROM persona, desarrollo_publicacion WHERE desarrollo_publicacion.id_publicacion = $id_publicacion AND desarrollo_publicacion.id_persona = persona.id_persona";
			$autores = mysql_query($consulta, $this->enlace);
			$num_autores = mysql_num_rows($autores);
			$contador = 0;
			
			// Ciclo para mostrar a los autores de una publicación.
			while ($fila = mysql_fetch_array($autores))
			{
				if ($contador == $num_autores - 1)
					printf("<B>%s. </B>", $fila["paterno_persona"]);
				else printf("<B>%s - </B>", $fila["paterno_persona"]);
				$contador++;
			}
			
			// Liberamos memoria del servidor.
			mysql_free_result($autores);
			
			// Imprimimos el título, editorial (si tiene) y el año de publicación.
			printf("\"%s\", ", strtr($tupla["titulo_publicacion"], $caracteres));
			if (isset($tupla["nombre_empresa"]))
				printf("Editorial %s", strtr($tupla["nombre_empresa"], $caracteres));
			
			// Mostramos el año de publicación.
			if ($tupla["anio_publicacion"] > 0)
				printf(", %d.", $tupla["anio_publicacion"]);
			else printf(".");
			
			printf("</LI>");
		}
		
		// Imprimimos el final de la tabla.
		echo "</UL>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR><TD>&nbsp;</TD></TR>";
		echo "</TABLE>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que obtiene el nombre de la asignatura con identificación conocida.
	 *
	 * @param $id_asignatura El identificador de la asignatura.
	 * @return $nombre_asignatura El nombre de la asignatura.
	 */
	function nombre($id_asignatura)
	{
		// Consulta para obtener el nombre de la asignatura.
		$consulta = "SELECT nombre_asignatura FROM asignatura WHERE id_asignatura = $id_asignatura";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Devolvemos el nombre de la asignatura.
		return $fila["nombre_asignatura"];
	}
	
	/**
	 * Método que muestra el formulario de ingreso de una nueva asignatura dictada.
	 *
	 * @param $id_persona El identificador de la persona.
	 */
	function formularioAgregarDictada($id_persona)
	{
		// Librerías necesarias.
		include("semestre.php");
		
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Mostramos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Agregar Asignatura Dictada</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>Asignatura:</TD>";
		echo "<TD WIDTH='70%'>";
		$this->select(-1);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Semestre:</TD>";
		echo "<TD>";
		$semestre = new semestre($this->enlace);
		$semestre->select(1);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>A&ntilde;o:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='anio' CLASS='formtextfield' MAXLENGTH='4' TABINDEX='1' TITLE='A&ntilde;o en que se dict&oacute; la asignatura'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Dictada por:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='interesado' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='".$tupla["nombres_persona"]." ".$tupla["paterno_persona"]." ".$tupla["materno_persona"]."'></TD>";
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
		echo "<INPUT TYPE='submit' NAME='agregar' VALUE='Agregar' CLASS='formbutton' TABINDEX='1' TITLE='Agregar la asignatura dictada'>&nbsp;";
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
	 * Método que agrega una nueva asignatura dictada en la base de datos.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_asignatura El identificador de la asignatura.
	 * @param $id_semestre El identificador del semestre.
	 * @param $anio_dicta El año en que se dictó la asignatura.
	 */
	function agregarDictada($id_persona, $id_asignatura, $id_semestre, $anio_dicta)
	{
		// Consulta para agregar el registro en la tabla dicta.
		$consulta = "INSERT INTO dicta(id_asignatura, id_semestre, id_persona, anio_dicta) VALUES($id_asignatura, $id_semestre, $id_persona, $anio_dicta)";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de éxito de la operación.
		echo "<P ALIGN='center' CLASS='contenido'><B>TU ASIGNATURA DICTADA HA SIDO AGREGADA EXITOSAMENTE</B></P>";
		echo "<P CLASS='contenido'>Esta asignatura ha sido incorporada a tus antecedentes docentes, por lo que se convertir&aacute; en un indicador clave de tu curriculum docente. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='../../docentes/index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
	
	/*
	 * Método que obtiene todos los tipos de asignaturas existentes en la base de datos y escribe
	 * un select con los resultados.
	 *
	 * @param $id_asignatura El identificador de la asignatura.
	 */
	function select($id_asignatura)
	{
		// Consulta que obtiene todos las asignaturas existentes.
		$consulta = "SELECT id_asignatura, nombre_asignatura FROM asignatura GROUP BY nombre_asignatura ORDER BY nombre_asignatura ";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Abrimos el select.
		echo "<SELECT NAME='asignatura' CLASS='formlist' TABINDEX='1'>";
		
		// Ciclo en donde imprimimos las asignaturas como opciones del select.
		while ($fila = mysql_fetch_array($resultado))
		{
			if ($fila["id_asignatura"] == $id_asignatura)
				printf("<OPTION VALUE='%d' SELECTED>%s</OPTION>", $fila["id_asignatura"], $fila["nombre_asignatura"]);
			else printf("<OPTION VALUE='%d'>%s</OPTION>", $fila["id_asignatura"], $fila["nombre_asignatura"]);
		}
		
		// Cerramos el select.
		echo "</SELECT>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que lista todas las asignaturas dictadas por una persona.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $vinculo El vínculo a la página.
	 */
	function listarDictadas($id_persona, $vinculo)
	{
		// Consulta que obtiene los antecedentes del académico con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE persona.id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$usuario = $tupla["nombres_persona"]." ".$tupla["paterno_persona"]." ".$tupla["materno_persona"];
		mysql_free_result($resultado);
		
		// Consulta que obtiene las asignaturas dictadas por la persona.
		$consulta = "SELECT dicta.id_dicta, asignatura.nombre_asignatura, semestre.nombre_semestre, dicta.anio_dicta FROM dicta, asignatura, semestre WHERE dicta.id_persona = $id_persona AND dicta.id_asignatura = asignatura.id_asignatura AND dicta.id_semestre = semestre.id_semestre ORDER BY anio_dicta";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);		
		
		// Cuando no hay asignaturas.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay asignaturas.</P>";
		
		// Cuando si hay asignaturas.
		else
		{
			echo "<TABLE WIDTH='80%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='5' CLASS='contenido'>Hay un total de $total asignaturas dictadas por $usuario:</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD WIDTH='15%' ALIGN='center' CLASS='titulotabla'>&nbsp;</TD>";
			echo "<TD WIDTH='65%' ALIGN='center' CLASS='titulotabla'><B>Asignatura</B></TD>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'><B>Semestre</B></TD>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'><B>A&ntilde;o</B></TD>";
			echo "</TR>";
			
			// Texto para enlazar a la operación.
			if ($vinculo == "modificar.php")
				$texto_vinculo = "Modificar";
			else $texto_vinculo = "Eliminar";
			
			// Imprimimos la lista de asignaturas dictadas.
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				printf("<TD ALIGN='center' CLASS='tabla' VALIGN='top'><A HREF='$vinculo?id=%s' TITLE='%s Asignatura Dictada'>%s</A></TD>", $tupla["id_dicta"], $texto_vinculo, $texto_vinculo);
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $tupla["nombre_asignatura"]);
				printf("<TD ALIGN='center' CLASS='tabla' VALIGN='top'>%s</TD>", $tupla["nombre_semestre"]);
				printf("<TD ALIGN='center' CLASS='tabla' VALIGN='top'>%s</TD>", $tupla["anio_dicta"]);
				printf("</TR>");
			}
			
			// Cerramos la tabla.
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);	
	}
	
	/**
	 * Método que muestra el formulario de modificación de una asignatura dictada.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_dicta El identificador de la tabla dicta.
	 */
	function formularioModificarDictada($id_persona, $id_dicta)
	{
		// Librerías necesarias.
		include("semestre.php");
		
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida.
		$consulta = "SELECT persona.nombres_persona, persona.paterno_persona, persona.materno_persona, dicta.id_asignatura, dicta.id_semestre, dicta.anio_dicta FROM persona, academico, dicta, asignatura WHERE dicta.id_dicta = $id_dicta AND persona.id_persona = academico.id_persona AND academico.id_persona = dicta.id_persona AND dicta.id_asignatura = asignatura.id_asignatura AND dicta.id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Mostramos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Modificar Asignatura Dictada</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>Asignatura:</TD>";
		echo "<TD WIDTH='70%'>";
		$this->select($tupla["id_asignatura"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Semestre:</TD>";
		echo "<TD>";
		$semestre = new semestre($this->enlace);
		$semestre->select($tupla["id_semestre"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>A&ntilde;o:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='anio' CLASS='formtextfield' MAXLENGTH='4' TABINDEX='1' TITLE='A&ntilde;o en que se dict&oacute; la asignatura' VALUE='".$tupla["anio_dicta"]."'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Dictada por:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='interesado' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='".$tupla["nombres_persona"]." ".$tupla["paterno_persona"]." ".$tupla["materno_persona"]."'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_dicta' VALUE='$id_dicta'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido'>&nbsp;<FONT COLOR='#CC0000'>*</FONT> Datos obligatorios</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'>";
		echo "<INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar la asignatura dictada'>&nbsp;";
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
	 * Método que modifica una asignatura dictada por un académico.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_dicta El identificador del dicta.
	 * @param $id_asigantura El identificador de la asignatura.
	 * @param $id_semestre El identificador del semestre.
	 * @param $anio_dicta El año en que se dictó la asignatura.
	 */
	function modificarDictada($id_persona, $id_dicta, $id_asignatura, $id_semestre, $anio_dicta)
	{
		// Consulta para actualizar la tabla 'dicta'.
		$consulta = "UPDATE dicta SET id_asignatura = $id_asignatura, id_semestre = $id_semestre, anio_dicta = $anio_dicta WHERE id_dicta = $id_dicta AND id_persona = $id_persona";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de éxito de la operación.
		echo "<P ALIGN='center' CLASS='contenido'><B>TU ASIGNATURA DICTADA HA SIDO MODIFICADA EXITOSAMENTE</B></P>";	
		echo "<P CLASS='contenido'>Esta asignatura ha sido modificada en tus antecedentes docentes, por lo que se convertir&aacute; en un indicador clave de tu curriculum docente. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='../../docentes/index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
	
	/**
	 * Método que muestra el formulario para eliminar una asignatura dictada.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_dicta El identificador de la tabla dicta.
	 */
	function formularioEliminarDictada($id_persona, $id_dicta)
	{
		// Consulta que obtiene la asignatura dictadas por la persona.
		$consulta = "SELECT persona.nombres_persona, persona.paterno_persona, persona.materno_persona, asignatura.nombre_asignatura, semestre.nombre_semestre, dicta.anio_dicta FROM persona, academico, dicta, asignatura, semestre WHERE persona.id_persona = $id_persona AND persona.id_persona = academico.id_persona AND academico.id_persona = dicta.id_persona AND dicta.id_dicta = $id_dicta AND dicta.id_asignatura = asignatura.id_asignatura AND dicta.id_semestre = semestre.id_semestre";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Mostramos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Eliminar Asignatura Dictada</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>Asignatura:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='asignatura' CLASS='formtextfield' MAXLENGTH='50' DISABLED='true' VALUE='".$tupla["nombre_asignatura"]."'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Semestre:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='semestre' CLASS='formtextfield' MAXLENGTH='25' DISABLED='true' VALUE='".$tupla["nombre_semestre"]."'></TD>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>A&ntilde;o:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='anio' CLASS='formtextfield' MAXLENGTH='4' DISABLED='true' VALUE='".$tupla["anio_dicta"]."'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Dictada por:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='interesado' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='".$tupla["nombres_persona"]." ".$tupla["paterno_persona"]." ".$tupla["materno_persona"]."'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>¿Confirmas que deseas eliminar esta asignatura dictada?</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>";
		echo "<INPUT TYPE='radio' NAME='confirmar' CHECKED='true' VALUE='1'>Si<BR>";
		echo "<INPUT TYPE='radio' NAME='confirmar' VALUE='0'>No";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_dicta' VALUE='$id_dicta'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'>";
		echo "<INPUT TYPE='submit' NAME='aceptar' VALUE='Aceptar' CLASS='formbutton' TABINDEX='1' TITLE='Aceptar'>";
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
	 * Método que elimina una asignatura dictada por un académico de la base de datos.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_dicta El identificador de la tabla dicta.
	 * @param $confirmar Si el usuario quiere realmente eliminar el área de interés o no.
	 */
	function eliminarDictada($id_persona, $id_dicta, $confirmar)
	{
		// Cuando quiere eliminarla.
		if ($confirmar == 1)
		{
			// Consulta para borrar el registro en la tabla 'dicta'.
			$consulta = "DELETE FROM dicta WHERE id_dicta = $id_dicta AND id_persona = $id_persona";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos el mesaje de éxito de la operación.
			echo "<P ALIGN='center' CLASS='contenido'><B>TU ASIGNATURA DICTADA HA SIDO ELIMINADA EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Esta asignatura ha sido eliminada de tus antecedentes docentes, de manera que tu curriculum docente ha cambiado. Gracias por colaborar con nosotros.</P>";
		}
		// Cuando no quiere eliminarla.
		else
		{
			echo "<P ALIGN='center' CLASS='contenido'><B>TU ASIGNATURA DICTADA NO HA SIDO ELIMINADA</B></P>";
			echo "<P CLASS='contenido'>Este asignatura no se ha eliminado de tus antecedentes docentes, de manera que tu curriculum docente permanece intacto. Gracias por colaborar con nosotros.</P>";
		}
		
		// Mostramos el botón volver.
		echo "<DIV ALIGN='center'><A HREF='../../docentes/index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
}
?>