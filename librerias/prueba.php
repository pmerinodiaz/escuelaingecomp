<?PHP
/**
 * prueba.php.
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
 * Clase que sivre para administrar las pruebas, controles, examenes y otros tipos de
 * evaluaciones, que están registradas en la base de datos y que están a disposición para
 * el público en general.
 */

class prueba
{
	// Enlace a la base de datos.
	var $enlace;
	
	// Juego de caracteres especiales del servidor.
	var $caracteres;
	
	/**
	 * Método constructor que inicializa el enlace de la base de datos.
	 *
	 * @param link El enlace a la base de datos.
	 */
	function prueba($link)
	{
		$this->enlace = $link;
		$this->caracteres = get_html_translation_table(HTML_SPECIALCHARS);
	}
	
	/**
	 * Método que muestra el listado asignaturas con su respectivo número de pruebas.
	 */
	function banco()
	{
		// Librerías necesarias.
		include ("tiempo.php");
		
		// Consulta para obtener todas las pruebas.
		$consulta = "SELECT * FROM prueba";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		mysql_free_result($resultado);
		
		// Cuando no hay pruebas.
		if ($total <= 0)
			echo "<P CLASS='contenido'>No hay pruebas.</P>";
		// Cuando hay pruebas.
		else
		{
			// Creamos un objeto tiempo.
			$tiempo = new tiempo();
			
			// Tabla para el total de pruebas y el encabezado.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR CLASS='contenido'>";
			echo "<TD ALIGN='right' COLSPAN='3'>Hay un total de $total pruebas.</TD>";
			echo "</TR>";
			echo "<TR CLASS='titulotabla'>";
			echo "<TD WIDTH='10%' ALIGN='center'>&nbsp;</TD>";
			echo "<TD WIDTH='70%' ALIGN='center'>Asignatura</TD>";
			echo "<TD WIDTH='20%' ALIGN='center'>Pruebas</TD>";
			echo "</TR>";
			
			// Consulta para obtener todas las asignaturas.
			$consulta = "SELECT id_asignatura, nombre_asignatura FROM asignatura GROUP BY nombre_asignatura ORDER BY nombre_asignatura";
			$resultado = mysql_query($consulta, $this->enlace);
			
			// Ciclo donde se muestran las asignaturas.
			while ($fila = mysql_fetch_array($resultado))
			{
				// Consulta para obtener el total de pruebas de la asignatura.
				$id_asignatura = $fila["id_asignatura"];
				$consulta = "SELECT fecha_recepcion FROM prueba WHERE id_asignatura = $id_asignatura ORDER BY fecha_recepcion DESC";
				$pruebas = mysql_query($consulta, $this->enlace);
				$num_pruebas = mysql_num_rows($pruebas);
				
				// Cuando si hay pruebas, mostramos la asignatura.
				if ($num_pruebas > 0)
				{
					// Abrimos una fila.
					printf("<TR>");
					
					// Cuando la útlima prueba que se agregó fue entre las últimas 24 horas.
					if ($tiempo->entreLapso(mysql_result($pruebas, 0, "fecha_recepcion"), 24))
						printf("<TD ALIGN='center' CLASS='tabla'><IMG SRC='../librerias/icocarpetaabierta.gif'></TD>");
					
					// Cuando la útlima prueba que se agregó fue después de las últimas 24 hrs.	
					else printf("<TD ALIGN='center' CLASS='tabla'><IMG SRC='../librerias/icocarpetacerrada.gif'></TD>");
					
					// Mostramos el nombre de la asignatura.
					printf("<TD CLASS='tabla'><A HREF='pruebas.php?id=%d&pagina=1' TITLE='Ver Pruebas de %s'>%s</A></TD>", $id_asignatura, $fila["nombre_asignatura"], $fila["nombre_asignatura"]);
					
					// Mostramos el número de pruebas.
					printf("<TD CLASS='tabla' ALIGN='center'>%d</TD>", $num_pruebas);
					
					// Cerramos la fila.
					printf("</TR>");
				}
				
				// Liberamos memoria en el servidor.
				mysql_free_result($pruebas);
			}
			
			// Escribimos una fila de espacio en el final y un comentario.
			echo "<TR><TD COLSPAN='3'>&nbsp;</TD></TR>";
			echo "<TR><TD COLSPAN='3' CLASS='contenido'><IMG SRC='../librerias/icocarpetaabierta.gif'> Se han agregado una o más pruebas durante las &uacute;ltimas 24 horas.</TD></TR>";
			echo "<TR><TD COLSPAN='3' CLASS='contenido'><IMG SRC='../librerias/icocarpetacerrada.gif'> No se han agregado pruebas durante las &uacute;ltimas 24 horas.</TD></TR>";
			echo "<TR><TD COLSPAN='3'>&nbsp;</TD></TR>";
			echo "</TABLE>";
			
			// Liberamos memoria en el servidor.
			mysql_free_result($resultado);
		}
	}
	
	/**
	 * Método que muestra las últimas tres pruebas incorporadas.
	 */
	function destacadas()
	{
		// Consulta que obtiene todas las pruebas ordenadas por fecha de recepción.
		$consulta = "SELECT prueba.id_prueba, formato.src_formato, prueba.tamanio_prueba, tipo_prueba.desc_tipo_prueba, prueba.numero_prueba, prueba.anio_prueba, semestre.nombre_semestre, persona.nombres_persona, persona.paterno_persona, persona.email_persona, prueba.fecha_recepcion, prueba.visitas_prueba, asignatura.nombre_asignatura FROM prueba, semestre, tipo_prueba, formato, persona, asignatura WHERE prueba.id_semestre = semestre.id_semestre AND prueba.id_formato = formato.id_formato AND prueba.id_tipo_prueba = tipo_prueba.id_tipo_prueba AND prueba.id_persona = persona.id_persona AND prueba.id_asignatura = asignatura.id_asignatura ORDER BY prueba.fecha_recepcion DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando si hay pruebas.
		if ($total > 0)
		{
			// Contador para los pruebas.
			$contador = 0;
			
			// Creamos un objeto tiempo.
			$tiempo = new tiempo();
			
			// Tabla para los software.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='2' ALIGN='center' BGCOLOR='F1F1F1' CLASS='contenido'><B>Ultimas incorporaciones</B></TD>";
			echo "</TR>";
			
			// Imprimimos las 3 primeras pruebas arrojados por la consulta.
			while (($tupla = mysql_fetch_array($resultado)) && ($contador < 3))
			{
				$this->item($tupla, $tiempo, true);
				$contador++;
			}
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
		}
		
		// Liberación de memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que imprime una prueba.
	 *
	 * @param $tupla Una fila de la consulta.
	 * @param $tiempo El objeto tiempo.
	 * @param $esdestacada Si la prueba es o no destacada.
	 */
	function item($tupla, $tiempo, $esdestacada)
	{
		// Tabla para mostrar la información de la prueba.
		printf("<TABLE WIDTH='%s' BORDER='0'>", "100%");
		
		// Mostramos el archivo, el formato, el vínculo al sitio de descarga, el tamaño
		// y el icono si es nuevo.
		printf("<TR>");
		printf("<TD WIDTH='%s' BGCOLOR='C9D6F5' CLASS='tabla'><STRONG>&nbsp;Archivo:</STRONG></TD>", "20%");
		printf("<TD WIDTH='%s' CLASS='tabla'>", "80%");
		if ($esdestacada)
			printf("<A HREF='enlazar.php?id=%d' TITLE='Acceder a la prueba'><IMG SRC='../librerias/%s' WIDTH='16' HEIGHT='16' BORDER='0'> Descargar</A> (%d KB)", $tupla["id_prueba"], $tupla["src_formato"], $tupla["tamanio_prueba"]);
		else printf("<IMG SRC='../librerias/%s' WIDTH='16' HEIGHT='16' BORDER='0'> Descargar (%d KB)", $tupla["src_formato"], $tupla["tamanio_prueba"]);
		if ($tiempo->entreLapso($tupla["fecha_recepcion"], 24))
			printf(" <IMG SRC='../librerias/iconuevo.gif'>");
		printf("</TD>");
		printf("</TR>");
		
		// Mostramos el nombre de la asignatura.
		printf("<TR>");
		printf("<TD BGCOLOR='C9D6F5' CLASS='tabla'><STRONG>&nbsp;Asignatura:</STRONG></TD>");
		printf("<TD CLASS='tabla'>%s</TD>", $tupla["nombre_asignatura"]);
		printf("</TR>");
		
		// Mostramos el tipo y número de prueba.
		printf("<TR>");
		printf("<TD BGCOLOR='C9D6F5' CLASS='tabla'><STRONG>&nbsp;Evaluación:</STRONG></TD>");
		printf("<TD CLASS='tabla'>%s %d</TD>", $tupla["desc_tipo_prueba"], $tupla["numero_prueba"]);
		printf("</TR>");
		
		// Mostramos el año de la prueba.
		printf("<TR>");
		printf("<TD BGCOLOR='C9D6F5' CLASS='tabla'><STRONG>&nbsp;A&ntilde;o:</STRONG></TD>");
		printf("<TD CLASS='tabla'>%d</TD>", $tupla["anio_prueba"]);
		printf("</TR>");
		
		// Mostramos el semestre de la prueba.
		printf("<TR>");
		printf("<TD BGCOLOR='C9D6F5' CLASS='tabla'><STRONG>&nbsp;Semestre:</STRONG></TD>");
		printf("<TD CLASS='tabla'>%s</TD>", $tupla["nombre_semestre"]);
		printf("</TR>");
		
		// Mostramos la persona que lo envió y la fecha.
		printf("<TR>");
		printf("<TD COLSPAN='2'>");
		printf("<TABLE WIDTH='%s' BORDER='0' CELLPADDING='0' CELLSPACING='0'>", "100%");
		printf("<TR>");
		if ($tupla["email_persona"])
		{
			$email = strtr($tupla["email_persona"], $this->caracteres);
			printf("<TD WIDTH='%s' CLASS='tabla'>&nbsp;Enviada por <A HREF='mailto:%s' TITLE='%s'>%s %s</A> el %s.</TD>", "70%", $email, $email, $tupla["nombres_persona"], $tupla["paterno_persona"], $tupla["fecha_recepcion"]);
		}
		else printf("<TD WIDTH='%s' CLASS='tabla'>&nbsp;Enviada por %s %s el %s.</TD>", "70%", $tupla["nombres_persona"], $tupla["paterno_persona"], $tupla["fecha_recepcion"]);
		printf("<TD WIDTH='%s' CLASS='tabla' ALIGN='right'>Descargas: %d</TD>", "30%", $tupla["visitas_prueba"]);
		printf("</TR>");
		printf("<TR><TD COLSPAN='2'>&nbsp;</TD></TR>");
		printf("</TABLE>");
		printf("</TD>");
		printf("</TR>");
	}
	
	/**
	 * Método que muestra el título de la sección, con el nombre de la asignatura enviada
	 * como parámetro.
	 *
	 * @param $id_asignatura El identificador de la asignatura.
	 */
	function mostrarTitulo($id_asignatura)
	{
		// Librerías necesarias.
		include("asignatura.php");
		
		// Cremos un objeto asignatura y capturamos el nombre de la asignatura.
		$asignatura = new asignatura($this->enlace);
		$titulo = $asignatura->nombre($id_asignatura);
		
		// Configuramos y mostramos el título.
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php' TITLE='Ver Banco de Pruebas'>Banco de Pruebas</A> / " . $titulo;
		$imagen = "activos/bgbancopruebas.jpg";
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Méotodo que muestra (en forma paginada) las pruebas de una asignatura.
	 *
	 * @param $id_asignatura El identificador de la asignatura.
	 * @param $pagina El número de la página actual dentro de la paginación total.
	 */
	function mostrar($id_asignatura, $pagina)
	{
		// Librerías necesarias.
		include ("paginacion.php");
		include ("tiempo.php");
		
		// Inicialización de variables.
		$vinculo = "pruebas.php?id=" . $id_asignatura . "&";
		$porpagina = 10;
		
		// Consulta para obtener todas las pruebas de una asignatura dada.
		$consulta = "SELECT prueba.id_prueba, formato.src_formato, prueba.tamanio_prueba, tipo_prueba.desc_tipo_prueba, prueba.numero_prueba, prueba.anio_prueba, semestre.nombre_semestre, persona.nombres_persona, persona.paterno_persona, persona.email_persona, prueba.fecha_recepcion, prueba.visitas_prueba FROM prueba, semestre, tipo_prueba, formato, persona WHERE prueba.id_asignatura = $id_asignatura AND prueba.id_semestre = semestre.id_semestre AND prueba.id_formato = formato.id_formato AND prueba.id_tipo_prueba = tipo_prueba.id_tipo_prueba AND prueba.id_persona = persona.id_persona ORDER BY tipo_prueba.desc_tipo_prueba, prueba.numero_prueba, prueba.anio_prueba DESC, semestre.nombre_semestre";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay pruebas.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay pruebas.</TD>";
		// Cuando hay pruebas.
		else
		{
			// Creamos un objeto paginación y tiempo.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			$tiempo = new tiempo();
			
			// Tabla para el total, la paginación y las pruebas.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total pruebas.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Tabla para las pruebas.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Para controlar el tipo de prueba y el número de prueba.
			$tipo_prueba = "";
			$numero_prueba = -1;
			
			// Ciclo en donde imprimimos las pruebas.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Se muestra el tipo y número de prueba solo una vez.
				if ($tipo_prueba != $tupla["desc_tipo_prueba"] || $numero_prueba != $tupla["numero_prueba"])
				{
					$tipo_prueba = $tupla["desc_tipo_prueba"];
					$numero_prueba = $tupla["numero_prueba"];
					printf("<TR>");
					printf("<TD COLSPAN='2' CLASS='titulotabla' ALIGN='center'>%s %d</TD>", $tupla["desc_tipo_prueba"], $tupla["numero_prueba"]);
					printf("</TR>");
				}
				
				// Mostramos el archivo.
				printf("<TR>");
				printf("<TD WIDTH='%s' BGCOLOR='C9D6F5' CLASS='tabla'><STRONG>&nbsp;Archivo:</STRONG></TD>", "20%");
				printf("<TD WIDTH='%s' CLASS='tabla'>", "80%");
				printf("<A HREF='enlazar.php?id=%d' TITLE='Acceder a la Prueba'><IMG SRC='../librerias/%s' WIDTH='16' HEIGHT='16' BORDER='0'> Descargar</A> (%d KB)", $tupla["id_prueba"], $tupla["src_formato"], $tupla["tamanio_prueba"]);
				if ($tiempo->entreLapso($tupla["fecha_recepcion"], 24))
					printf(" <IMG SRC='../librerias/iconuevo.gif'>");
				printf("</TD>");
				printf("</TR>");
				
				// Mostramos el año de la prueba.
				printf("<TR>");
				printf("<TD BGCOLOR='C9D6F5' CLASS='tabla'><STRONG>&nbsp;A&ntilde;o:</STRONG></TD>");
				printf("<TD CLASS='tabla'>%d</TD>", $tupla["anio_prueba"]);
				printf("</TR>");
				
				// Mostramos el semestre de la prueba.
				printf("<TR>");
				printf("<TD BGCOLOR='C9D6F5' CLASS='tabla'><STRONG>&nbsp;Semestre:</STRONG></TD>");
				printf("<TD CLASS='tabla'>%s</TD>", $tupla["nombre_semestre"]);
				printf("</TR>");
				
				// Mostramos la persona que lo envió y la fecha.
				printf("<TR>");
				printf("<TD COLSPAN='2'>");
				printf("<TABLE WIDTH='%s' BORDER='0' CELLPADDING='0' CELLSPACING='0'>", "100%");
				printf("<TR>");
				if ($tupla["email_persona"])
				{
					$email = strtr($tupla["email_persona"], $this->caracteres);
					printf("<TD WIDTH='%s' CLASS='tabla'>&nbsp;Enviada por <A HREF='mailto:%s' TITLE='%s'>%s %s</A> el %s.</TD>", "70%", $email, $email, $tupla["nombres_persona"], $tupla["paterno_persona"], $tupla["fecha_recepcion"]);
				}
				else printf("<TD WIDTH='%s' CLASS='tabla'>&nbsp;Enviada por %s %s el %s.</TD>", "70%", $tupla["nombres_persona"], $tupla["paterno_persona"], $tupla["fecha_recepcion"]);
				printf("<TD WIDTH='%s' CLASS='tabla' ALIGN='right'>Descargas: %d</TD>", "30%", $tupla["visitas_prueba"]);
				printf("</TR>");
				printf("</TABLE>");
				printf("</TD>");
				printf("</TR>");
				
				// Imprimimos un espacio en blanco.
				echo "<TR><TD COLSPAN='2'><IMG SRC='../librerias/pxtransparente.gif' WIDTH='455' HEIGHT='5'></TD></TR>";
			}
			
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
			echo "</TD>";
			
			// Imprimimos la paginación.
			echo "<TR><TD>&nbsp;</TD></TR>";
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
	
	/**
	 * Método que retorna el URL del archivo de la prueba.
	 *
	 * @param $id_prueba El identificador de la prueba.
	 * @return $url_prueba El vínculo a la prueba.
	 */
	function url($id_prueba)
	{
		// Consulta para obtener la URL de la prueba.
		$consulta = "SELECT url_prueba FROM prueba WHERE id_prueba = $id_prueba";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		return $tupla["url_prueba"];
	}
	
	/**
	 * Método que muestra el título de la sección "Acceso a la Prueba".
	 *
	 * @param $id_prueba el identificador de la prueba.
	 */
	function tituloAcceso($id_prueba)
	{
		// Consulta para capturar la identificación y nombre de la asignatura en que estamos.
		$consulta = "SELECT asignatura.id_asignatura, asignatura.nombre_asignatura FROM prueba, asignatura WHERE prueba.id_prueba = $id_prueba AND prueba.id_asignatura = asignatura.id_asignatura";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		$id_asignatura = $fila["id_asignatura"];
		$nombre_asignatura = $fila["nombre_asignatura"];
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Configuramos y mostramos el título.
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php' TITLE='Ver Banco de Pruebas'>Banco de Pruebas</A> / <A HREF='pruebas.php?id=$id_asignatura&pagina=1' TITLE='Ver Pruebas de $nombre_asignatura'>$nombre_asignatura</A> / Acceso" ;
		$imagen = "activos/bgbancopruebas.jpg";
		$titulo = "Acceso a la Prueba";
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método donde se muestran los detalles de la prueba elegida por el usuario para descargar,
	 * posteriormente se incrementan el número de descargas de la prueba.
	 *
	 * @param $id_prueba El identificador de la prueba.
	 */
	function detallar($id_prueba)
	{
		// Librerias necesarias.
		include("tiempo.php");
		
		// Consulta para obtener todos los datos de una prueba.
		$consulta = "SELECT prueba.id_prueba, prueba.url_prueba, formato.src_formato, prueba.tamanio_prueba, tipo_prueba.desc_tipo_prueba, prueba.numero_prueba, prueba.anio_prueba, semestre.nombre_semestre, persona.nombres_persona, persona.paterno_persona, persona.email_persona, prueba.fecha_recepcion, prueba.visitas_prueba, asignatura.nombre_asignatura FROM prueba, semestre, tipo_prueba, formato, persona, asignatura WHERE prueba.id_prueba = $id_prueba AND prueba.id_semestre = semestre.id_semestre AND prueba.id_formato = formato.id_formato AND prueba.id_tipo_prueba = tipo_prueba.id_tipo_prueba AND prueba.id_persona = persona.id_persona AND prueba.id_semestre = semestre.id_semestre AND prueba.id_asignatura = asignatura.id_asignatura";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Cuando hay pruebas.
		if ($tupla)
		{
			// Creamos un objeto tiempo.
			$tiempo = new tiempo();
			
			// Mostramos los detalles de la prueba.
			$this->item($tupla, $tiempo, false);
			
			// Incrementamos las descargas y actualizamos la tabla.
			$visitas = $tupla["visitas_prueba"] + 1;
			$this->actualizarVisitas($id_prueba, $visitas);
			
			// Mostramos el botón para regresar.
			printf("<TR><TD CLASS='contenido' COLSPAN='2'>Si no se abre autom&aacute;ticamente, pulsa <A HREF='%s' TITLE='Acceder directamente' TARGET='_blank'>aqu&iacute;</A>.</TD></TR>", $tupla["url_prueba"]);
			printf("<TR><TD COLSPAN='2'>&nbsp;</TD></TR>");
			printf("<TR><TD COLSPAN='2' ALIGN='center'><A HREF=\"javascript:history.back(1);\" TITLE='Volver'><IMG SRC='../librerias/btvolver.gif' BORDER='0'></A></TD></TR>");
			printf("<TR><TD COLSPAN='2'>&nbsp;</TD></TR>");
			printf("</TABLE>");
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método donde se actualiza el número de descargas de la prueba.
	 *
	 * @param $id_prueba El identificador de la prueba.
	 * @param $visitas El número de visitas de la prueba.
	 */
	function actualizarVisitas($id_prueba, $visitas)
	{
		// Consulta para actualizar las visitas de la prueba.
		$consulta = "UPDATE prueba SET visitas_prueba = $visitas WHERE id_prueba = $id_prueba";
		$resultado = mysql_query($consulta, $this->enlace);
	}
	
	/**
	 * Método que construye el formulario para ingresar a una nueva prueba a
	 * la base de datos.
	 *
	 * @param $id_persona El identificador de la persona.
	 */
	function formularioAgregar($id_persona)
	{
		// Librerías necesarias.
		include("asignatura.php");
		include("semestre.php");
		include("tipoprueba.php");
		include("formato.php");
		
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Tabla en donde incorporamos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Agregar Prueba</B></TD>";
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
		echo "<TD CLASS='formlabel'>Enviada por:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Asignatura:</TD>";
		echo "<TD>";
		$asignatura = new asignatura($this->enlace);
		$asignatura->select(-1);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Prueba:</TD>";
		echo "<TD>";
		$tipoprueba = new tipoprueba($this->enlace);
		$tipoprueba->select(1);
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>Prueba N&uacute;mero:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='numero' CLASS='formtextfield' MAXLENGTH='2' TABINDEX='1' TITLE='N&uacute;mero de la prueba'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>A&ntilde;o:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='anio' CLASS='formtextfield' MAXLENGTH='4' TABINDEX='1' TITLE='A&ntilde;o de la prueba'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Formato:</TD>";
		echo "<TD>";
		$formato = new formato($this->enlace);
		$formato->select(1);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='archivo_internet' CHECKED='true' onClick='deshabilitarSRC();' VALUE='1' TABINDEX='1'> El archivo ya est&aacute; en Internet</TD>";
		echo "</TR>";		
		echo "<TR>";		
		echo "<TD COLSPAN='2' CLASS='formlabel'>URL: <INPUT TYPE='text' NAME='url_archivo' CLASS='formtextfield' MAXLENGTH='100' VALUE='http://' TABINDEX='1' TITLE='URL donde se encuentra el archivo (Incluir el protocolo http:// ó ftp://)'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='archivo_internet' onClick='deshabilitarURL();' VALUE='0' TABINDEX='1'> Debo subir el archivo a Internet</TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>SRC: <INPUT TYPE='file' NAME='src_archivo' CLASS='formtextfield' DISABLED='true' TABINDEX='1' TITLE='Archivo *.DOC - *.EXE - *.HTML - *.PDF - *.PS - *.RAR - *.RTF - *.RPM - *.TAR - *.TXT - *.ZIP (M&aacute;x. 1 MB)'></TD>";
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
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='agregar' VALUE='Agregar' CLASS='formbutton' TABINDEX='1' TITLE='Agregar la prueba'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * Método que agrega un nueva prueba a la base de datos.
	 *
	 * @param $id_asignatura El identificador de la asignatura.
	 * @param $id_persona El identificador de la persona.
	 * @param $id_formato El identificador del formato.
	 * @param $id_semestre El identificador del semestre.
	 * @param $id_tipo_prueba El identificador del tipo de prueba.
	 * @param $numero El número de la prueba.
	 * @param $anio El año de la prueba.
	 * @param $esta_subido Si el archivo está subido en Internet o no.
	 * @param $archivo El archivo que contiene la prueba.
	 */
	function agregar($id_asignatura, $id_persona, $id_formato, $id_semestre, $id_tipo_prueba, $numero, $anio, $esta_subido, $archivo)
	{
		// Obtener la fecha actual.
		$fecha = date("Y-m-d");
		
		// Cuando el archivo ya está subido a la Internet.
		if ($esta_subido)
		{
			// Consulta para insertar el registro de una prueba en la tabla 'prueba'.
			$consulta = "INSERT INTO prueba(id_asignatura, id_persona, id_formato, id_semestre, id_tipo_prueba, numero_prueba, anio_prueba, url_prueba, visitas_prueba, fecha_recepcion) VALUES ($id_asignatura, $id_persona, $id_formato, $id_semestre, $id_tipo_prueba, $numero, $anio, '$archivo', 0, '$fecha')";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos mensajes de éxito de la operación.
			echo "<P CLASS='contenido' ALIGN='center'><B>TU PRUEBA FUE AGREGADA EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Esta prueba ser&aacute; publicada en la secci&oacute;n \"Banco de Pruebas\" dentro de este sitio Web. Gracias por colaborar con nosotros.</P>";
			echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
		}
		// Cuando el archivo no está subido a la Internet.
		else
		{
			// Cuando hay espacio en disco y el archivo es menor o igual a 1MB.
			if ($archivo['size'] <= diskfreespace("C:/") && 0 < $archivo['size'] && $archivo['size'] <= 1000000)
			{
				// Consulta para obtener el mayor identificador en la tabla 'utilidad'.
				$consulta = "SELECT MAX(id_prueba) AS mayor FROM prueba";
				$resultado = mysql_query($consulta, $this->enlace);
				$fila = mysql_fetch_array($resultado);
				
				// Asignamos el nombre el archivo que vamos a subir.
				$id_prueba = ($fila["mayor"] + 1);
				$nombre_archivo = $id_prueba . substr($archivo['name'], strpos($archivo['name'], "."));
				$url_prueba = "http://" . $_SERVER["SERVER_NAME"] . "/pruebas/activos/" . $nombre_archivo;
				
				// Transformamos de kb a KB.
				$tamanio_prueba = $archivo['size'] / 8;
				
				// Consulta para insertar el registro de una prueba en la tabla 'prueba'.
				$consulta = "INSERT INTO prueba(id_prueba, id_asignatura, id_persona, id_formato, id_semestre, id_tipo_prueba, numero_prueba, anio_prueba, url_prueba, tamanio_prueba, visitas_prueba, fecha_recepcion) VALUES ($id_prueba, $id_asignatura, $id_persona, $id_formato, $id_semestre, $id_tipo_prueba, $numero, $anio, '$url_prueba', $tamanio_prueba, 0, '$fecha')";
				mysql_query($consulta, $this->enlace);
				
				// Copiamos el archivo al servidor.
				copy($archivo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . "/wwwic/pruebas/activos/" . $nombre_archivo);
				
				// Imprimimos mensajes de éxito.
				echo "<P CLASS='contenido' ALIGN='center'><B>TU PRUEBA FUE AGREGADA EXITOSAMENTE</B></P>";
				echo "<P CLASS='contenido'>Esta prueba ser&aacute; publicada en la secci&oacute;n \"Banco de Pruebas\" dentro de este sitio Web. Gracias por colaborar con nosotros.</P>";
				echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
			}
			// Cuando el archivo no se puede subir.
			else
			{
				// Imprimimos mensajes de error de envío.
				echo "<P CLASS='contenido' ALIGN='center'><B>TU PRUEBA NO PUDO AGREGARSE EXITOSAMENTE</B></P>";
				echo "<P CLASS='contenido'>Esto se puede deber una de las siguientes razones:</P>";
				echo "<OL CLASS='contenido'>";
				echo "<LI>No hay espacio en el disco del servidor.</LI>";
				echo "<LI>El archivo no existe.</LI>";
				echo "<LI>El tama&ntilde;o del archivo es superior a 1000 KB.</LI>";
				echo "<OL>";
				echo "<P ALIGN='center'><A HREF='index.php' TITLE='Atr&aacute;s al Formulario'><IMG SRC='../../../../librerias/btatras.gif' BORDER='0'></A></P>";
			}
		}
	}
	
	/**
	 * Método que lista todas las pruebas realizadas por un usuario.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $vinculo La página de destino de la operación.
	 */
	function listar($id_persona, $vinculo)
	{
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona FROM persona WHERE persona.id_persona = $id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		$usuario = $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"];
		mysql_free_result($resultado);
		
		// Consulta para obtener la lista de pruebas realizadas por el usuario.
		$consulta = "SELECT id_prueba, nombre_asignatura, nombre_semestre, nombre_formato, desc_tipo_prueba, anio_prueba, numero_prueba, fecha_recepcion FROM asignatura, formato, tipo_prueba, prueba, semestre WHERE semestre.id_semestre = prueba.id_semestre and asignatura.id_asignatura = prueba.id_asignatura and formato.id_formato = prueba.id_formato and tipo_prueba.id_tipo_prueba = prueba.id_tipo_prueba and prueba.id_persona = $id_persona ORDER BY fecha_recepcion, nombre_asignatura";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay pruebas.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay pruebas agregadas por $usuario.</P>";
		
		// Cuando si hay pruebas.
		else
		{
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='5' CLASS='contenido'>Hay un total de $total pruebas agregadas por $usuario:</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'>&nbsp;</TD>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'><B>Prueba</B></TD>";
			echo "<TD WIDTH='30%' ALIGN='center' CLASS='titulotabla'><B>Asignatura</B></TD>";
			echo "<TD WIDTH='15%' ALIGN='center' CLASS='titulotabla'><B>Tipo Prueba</B></TD>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'><B>Semestre</B></TD>";
			echo "<TD WIDTH='5%' ALIGN='center' CLASS='titulotabla'><B>A&ntilde;o</B></TD>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'><B>Formato</B></TD>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'><B>Fecha Recepci&oacute;n</B></TD>";
			echo "</TR>";
			
			// Texto para enlazar a la operación.
			if ($vinculo == "modificar.php")
				$texto_vinculo = "Modificar";
			else $texto_vinculo = "Eliminar";
			
			// Imprimimos la lista de pruebas.
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				printf("<TD ALIGN='center' CLASS='tabla' VALIGN='top'><A HREF='$vinculo?id=%s' TITLE='%s Prueba'>%s</A></TD>", $tupla["id_prueba"], $texto_vinculo, $texto_vinculo);
				printf("<TD CLASS='tabla' ALIGN='center' VALIGN='top'>%s</TD>", $tupla["numero_prueba"]);
				printf("<TD CLASS='tabla' VALIGN='top'>%s</TD>", $tupla["nombre_asignatura"]);
				printf("<TD CLASS='tabla' ALIGN='center' VALIGN='top'>%s</TD>", $tupla["desc_tipo_prueba"]);
				printf("<TD CLASS='tabla' ALIGN='center' VALIGN='top'>%s</TD>", $tupla["nombre_semestre"]);
				printf("<TD CLASS='tabla' ALIGN='center' VALIGN='top'>%s</TD>", $tupla["anio_prueba"]);
				printf("<TD CLASS='tabla' ALIGN='center' VALIGN='top'>%s</TD>", $tupla["nombre_formato"]);
				printf("<TD CLASS='tabla' ALIGN='center' VALIGN='top'>%s</TD>", $tupla["fecha_recepcion"]);	
				printf("</TR>");
			}
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);	
	}
	
	/**
	 * Método que muestra un formulario en donde se permite modificar una prueba enviada
	 * anteriormente por un usuario.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_prueba El identificador de la prueba.
	 */
	function formularioModificar($id_persona, $id_prueba)
	{
		// Librerías necesarias.
		include("asignatura.php");
		include("semestre.php");
		include("tipoprueba.php");
		include("formato.php");
		
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona , numero_prueba, anio_prueba, id_formato, id_asignatura, id_semestre, id_tipo_prueba, url_prueba FROM prueba, persona WHERE prueba.id_persona = persona.id_persona AND prueba.id_prueba = $id_prueba AND prueba.id_persona = $id_persona";	
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Tabla en donde incorporamos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Modificar Prueba</B></TD>";
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
		echo "<TD CLASS='formlabel'>Enviada por:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Asignatura:</TD>";
		echo "<TD>";
		$asignatura = new asignatura($this->enlace);
		$asignatura->select($tupla["id_asignatura"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Prueba:</TD>";
		echo "<TD>";
		$tipoprueba = new tipoprueba($this->enlace);
		$tipoprueba->select($tupla["id_tipo_prueba"]);
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>Prueba N&uacute;mero:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='numero' CLASS='formtextfield' MAXLENGTH='2' VALUE='" . $tupla["numero_prueba"] . "' TABINDEX='1' TITLE='N&uacute;mero de la prueba'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='30%' CLASS='formlabel'>A&ntilde;o:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='anio' CLASS='formtextfield' MAXLENGTH='4' VALUE='" . $tupla["anio_prueba"] . "' TABINDEX='1' TITLE='A&ntilde;o de la prueba'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Formato:</TD>";
		echo "<TD>";
		$formato = new formato($this->enlace);
		$formato->select($tupla["id_formato"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='archivo_internet' CHECKED='true' onClick='deshabilitarSRC();' VALUE='1' TABINDEX='1'> El archivo ya est&aacute; en Internet</TD>";
		echo "</TR>";		
		echo "<TR>";		
		echo "<TD COLSPAN='2' CLASS='formlabel'>URL: <INPUT TYPE='text' NAME='url_archivo' CLASS='formtextfield' MAXLENGTH='100' VALUE='" . $tupla["url_prueba"] . "' TABINDEX='1' TITLE='URL donde se encuentra el archivo (Incluir el protocolo http:// ó ftp://)'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='archivo_internet' onClick='deshabilitarURL();' VALUE='0' TABINDEX='1'> Debo subir el archivo a Internet</TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>SRC: <INPUT TYPE='file' NAME='src_archivo' CLASS='formtextfield' DISABLED='true' TABINDEX='1' TITLE='Archivo *.DOC - *.EXE - *.HTML - *.PDF - *.PS - *.RAR - *.RTF - *.RPM - *.TAR - *.TXT - *.ZIP (M&aacute;x. 1 MB)'></TD>";
		echo "</TR>";		
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_prueba' VALUE='" . $id_prueba . "'</TD>";
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
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar la prueba'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * Método que modifica una prueba en la base de datos.
	 *
	 * @param $id_persona El identificador de la persona.
	 * @param $id_prueba El identificador de la prueba.
	 * @param $id_asignatura El identificador de la asignatura.
	 * @param $id_formato El identificador del formato.
	 * @param $id_semestre El identificador del semestre.
	 * @param $id_tipo_prueba El identificador del tipo de prueba.
	 * @param $numero El número de la prueba.
	 * @param $anio El año de la prueba.
	 * @param $esta_subido Si el archivo está subido o no a la Internet.
	 * @param $archivo El archivo que contiene la prueba.
	 */
	function modificar($id_persona, $id_prueba, $id_asignatura, $id_formato, $id_semestre, $id_tipo_prueba, $numero, $anio, $esta_subido, $archivo)
	{
		// Cuando el archivo ya está subido a la Internet.
		if ($esta_subido)
		{
			// Consulta para insertar el registro de una prueba en la tabla 'prueba'.
			$consulta = "UPDATE prueba SET id_asignatura = $id_asignatura, id_formato = $id_formato, id_semestre = $id_semestre, id_tipo_prueba = $id_tipo_prueba, numero_prueba = $numero, anio_prueba = $anio, url_prueba = '$archivo' WHERE id_prueba = $id_prueba AND id_persona = $id_persona";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos mensajes de éxito de la operación.
			echo "<P CLASS='contenido' ALIGN='center'><B>TU PRUEBA FUE MOFIFICADA EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Los datos de la prueba han sido modificados. Gracias por colaborar con nosotros.</P>";
			echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
		}
		// Cuando el archivo ya está subido a la Internet.
		else
		{
			// Cuando hay espacio en disco, el archivo existe y el archivo es menor o igual a 1MB.
			if ($archivo['size'] <= diskfreespace("C:/") && 0 < $archivo['size'] && $archivo['size'] <= 1000000)
			{
				// Consulta para obtener el nombre del archivo antiguo (que ya está en el servidor).
				$consulta = "SELECT url_prueba FROM prueba WHERE id_prueba = $id_prueba AND id_persona = $id_persona";
				$resultado = mysql_query($consulta, $this->enlace);
				$tupla = mysql_fetch_array($resultado);
				mysql_free_result($resultado);
				
				// Asignamos el nombre el archivo que vamos a subir.
				$nombre_archivo = $id_prueba . substr($archivo['name'], strpos($archivo['name'], "."));
				$url_prueba = "http://" . $_SERVER["SERVER_NAME"] . "/pruebas/activos/" . $nombre_archivo;
				
				// Transformamos de kb a KB.
				$tamanio_prueba = $archivo['size'] / 8;
				
				// Consulta para actualizar el registro de una prueba en la tabla 'prueba'.
				$consulta = "UPDATE prueba SET id_asignatura = $id_asignatura, id_formato = $id_formato, id_semestre = $id_semestre, id_tipo_prueba = $id_tipo_prueba, numero_prueba = $numero, anio_prueba = $anio, url_prueba = '$url_prueba', tamanio_prueba = $tamanio_prueba WHERE id_prueba = $id_prueba ";
				mysql_query($consulta, $this->enlace);
				
				// Borramos el archivo antiguo del servidor.
				$archivo_antiguo = $_SERVER["DOCUMENT_ROOT"] . "/wwwic/pruebas/activos/" . basename($tupla["url_prueba"]);
				if (file_exists($archivo_antiguo))
					unlink($archivo_antiguo);
				
				// Copiamos el archivo al servidor.
				copy($archivo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . "/wwwic/pruebas/activos/" . $nombre_archivo);
				
				// Imprimimos los mensajes de éxito.
				echo "<P CLASS='contenido' ALIGN='center'><B>TU PRUEBA FUE MODIFICADA EXITOSAMENTE</B></P>";
				echo "<P CLASS='contenido'>Los datos de la prueba han sido modificados. Gracias por colaborar con nosotros.</P>";
				echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
			}
			// Cuando el archivo no se puede subir.
			else
			{
				// Imprimimos mensajes de error de envío.
				echo "<P CLASS='contenido' ALIGN='center'><B>TU PRUEBA NO PUDO MODIFICARSE EXITOSAMENTE</B></P>";
				echo "<P CLASS='contenido'>Esto se puede deber una de las siguientes razones:</P>";
				echo "<OL CLASS='contenido'>";
				echo "<LI>No hay espacio en el disco del servidor.</LI>";
				echo "<LI>El archivo no existe.</LI>";
				echo "<LI>El tama&ntilde;o del archivo es superior a 1000 KB.</LI>";
				echo "<OL>";
				echo "<P ALIGN='center'><A HREF='index.php' TITLE='Atr&aacute;s al Formulario'><IMG SRC='../../../../librerias/btatras.gif' BORDER='0'></A></P>";
			}
		}
	}
	
	/**
	 * Método que muestra un formulario en donde se permite eliminar una prueba realizada
	 * anteriormente por un usuario.
	 *
	 * @param $id_prueba El identificador de la prueba.
	 */
	function formularioEliminar($id_persona, $id_prueba)
	{
		// Consulta que obtiene los antecedentes del usuario interno con identificación conocida.
		$consulta = "SELECT nombres_persona, paterno_persona, materno_persona , numero_prueba, anio_prueba, nombre_formato, nombre_asignatura, nombre_semestre, desc_tipo_prueba, url_prueba FROM prueba, persona, formato, tipo_prueba, asignatura, semestre WHERE prueba.id_persona = persona.id_persona AND formato.id_formato = prueba.id_formato AND semestre.id_semestre = prueba.id_semestre AND tipo_prueba.id_tipo_prueba = prueba.id_tipo_prueba AND asignatura.id_asignatura = prueba.id_asignatura AND prueba.id_prueba = $id_prueba AND prueba.id_persona = $id_persona";	
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		
		// Tabla en donde mostramos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Eliminar Prueba</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>Enviada por:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='autor' CLASS='formtextfield' DISABLED='true' MAXLENGTH='90' VALUE='" . $tupla["nombres_persona"] . " " . $tupla["paterno_persona"] . " " . $tupla["materno_persona"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Asignatura:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='asignatura' CLASS='formtextfield' DISABLED='true' MAXLENGTH='50' VALUE='" . $tupla["nombre_asignatura"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Prueba:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='tipo_prueba' CLASS='formtextfield' DISABLED='true' MAXLENGTH='25' VALUE='" . $tupla["desc_tipo_prueba"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Semestre:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='semestre' CLASS='formtextfield' DISABLED='true' MAXLENGTH='25' VALUE='" . $tupla["nombre_semestre"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Prueba N&uacute;mero:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='numero' CLASS='formtextfield' DISABLED='true' MAXLENGTH='2' VALUE='" . $tupla["numero_prueba"] . "' TABINDEX='1'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>A&ntilde;o:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='anio' CLASS='formtextfield' DISABLED='true' MAXLENGTH='4' VALUE='" . $tupla["anio_prueba"] . "' TABINDEX='1'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Formato:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='formato' CLASS='formtextfield' DISABLED='true' MAXLENGTH='4' VALUE='" . $tupla["nombre_formato"] . "' TABINDEX='1'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>URL:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='url' CLASS='formtextfield' DISABLED='true' MAXLENGTH='100' VALUE='" . $tupla["url_prueba"] . "' TABINDEX='1'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>¿Confirma que deseas eliminar &eacute;sta prueba?</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='confirmar' CHECKED='true' VALUE='1' TABINDEX='1'>Si<BR><INPUT TYPE='radio' NAME='confirmar' VALUE='0' TABINDEX='1'>No</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_prueba' VALUE='" . $id_prueba . "'</TD>";
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
	 * Método que elimina una prueba de la base de datos.
	 */
	function eliminar($id_persona, $id_prueba, $confirmar)
	{
		// Cuando hay que eliminar la prueba.
		if ($confirmar == 1)
		{
			// Consulta para obtener el nombre del archivo de la prueba.
			$consulta = "SELECT url_prueba FROM prueba WHERE id_prueba = $id_prueba AND id_persona = $id_persona";
			$resultado = mysql_query($consulta, $this->enlace);
			$tupla = mysql_fetch_array($resultado);
			mysql_free_result($resultado);
			
			// Consulta para borrar el registro en la tabla 'prueba'.
			$consulta = "DELETE FROM prueba WHERE id_prueba = $id_prueba AND id_persona = $id_persona";
			mysql_query($consulta, $this->enlace);
			
			// Borramos el archivo del servidor.
			$archivo = $_SERVER["DOCUMENT_ROOT"] . "/wwwic/pruebas/activos/" . basename($tupla["url_prueba"]);
			if (file_exists($archivo))
				unlink($archivo);
			
			// Imprimimos el mesaje de éxito de la operación.
			echo "<P ALIGN='center' CLASS='contenido'><B>TU PRUEBA HA SIDO ELIMINADA EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Esta prueba ha sido eliminada de la secci&oacute;n \"Banco de Pruebas\" de nuestro sitio Web. Gracias por colaborar con nosotros.</P>";
		}
		// Cuando el software no se quiere eliminar.
		else
		{
			echo "<P ALIGN='center' CLASS='contenido'><B>LA ELIMINACION DE TU PRUEBA HA SIDO CANCELADA</B></P>";
			echo "<P CLASS='contenido'>Esta prueba no ha sido eliminada de la secci&oacute;n \"Banco de Pruebas\" de nuestro sitio Web, por lo que cualquier persona de Chile y el mundo lo puede seguir visitando. Gracias por colaborar con nosotros.</P>";
		}
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
}
?>