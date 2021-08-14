<?PHP
/**
 * curriculum.php.
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
 * Clase proporciona los métodos y variables para el despliegue del curriculum vitae de los
 * académicos y administrativos del Area de Computación de la ULS.
 */

class curriculum
{
	// Atributos de la clase.
	var $enlace;
	var $id;
	var $nombre;
	var $email;
	var $grado;
	var $foto;
	var $web;
	var $horario;
	var $cargo;
	var $fono;
	var $fax;
	var $caracteres;
	
	/**
	 * Constructor en donde inicializamos algunos de los atributos de esta clase.
	 *
	 * @param $link El enlace a la base de datos.
	 * @param $id El identificador de la persona.
	 */
	function curriculum($link, $id)
	{
		$this->enlace = $link;
		$this->id = $id;
		$this->nombre = "&nbsp;";
		$this->caracteres = get_html_translation_table(HTML_SPECIALCHARS);
	}
	
	/**
	 * Método que carga todos los datos de un académico desde la base de datos.
	 */
	function cargarAcademico()
	{
		// Consulta que obtiene información de un académico.
		$consulta = "SELECT persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, academico.grado_academico, academico.src_academico, persona.url_persona FROM persona, usuario_interno, academico WHERE persona.id_persona = $this->id AND usuario_interno.id_estado_interno = 1 AND persona.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = academico.id_persona";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Seteamos los datos.
		$this->nombre = mysql_result($resultado, 0, "nombres_persona") . " " . mysql_result($resultado, 0, "paterno_persona") . " " . mysql_result($resultado, 0, "materno_persona");
		$this->email = strtr(mysql_result($resultado, 0, "email_persona"), $this->caracteres);
		$this->grado = strtr(mysql_result($resultado, 0, "grado_academico"), $this->caracteres);
		$this->foto = mysql_result($resultado, 0, "src_academico");
		$this->web = strtr(mysql_result($resultado, 0, "url_persona"), $this->caracteres);
	}
	
	/**
	 * Método que muestra la tabla con el título de la sección en la que nos encontramos
	 * (Jornada Completa, Media Jornada o Part-Time) y el nombre del académico.
	 *
	 * @param $id_tipo_academico El identificador del tipo de académico.
	 */
	function tituloAcademico($id_tipo_academico)
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../../index.php' TITLE='Ver Integrantes'>Integrantes</A> / <A HREF='../index.php' TITLE='Ver Acad&eacute;micos'>Acad&eacute;micos</A> / ";
		switch ($id_tipo_academico)
		{
			case 1:
			{
				$ubicacion = $ubicacion . "<A HREF='index.php' TITLE='Ver Acad&eacute;micos Jornada Completa'>Jornada Completa</A> /";
				$imagen = "activos/bgjornadacompleta.jpg";
				break;
			}
			case 2:
			{
				$ubicacion = $ubicacion . "<A HREF='index.php' TITLE='Ver Acad&eacute;micos Media Jornada'>Media Jornada</A> /";
				$imagen = "activos/bgmediajornada.jpg";
				break;
			}
			case 3:
			{
				$ubicacion = $ubicacion . "<A HREF='index.php' TITLE='Ver Acad&eacute;micos Part-Time'>Part-Time</A> /";
				$imagen = "activos/bgpart-time.jpg";
				break;
			}
		}		
		$titulo = $this->nombre;
		$pixel = "../../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método en el cual se muestra la tabla con todo los datos del académico.
	 */
	function datosAcademico()
	{
		echo "<TABLE WIDTH='100%' BORDER='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD WIDTH='30%' ROWSPAN='8' ALIGN='CENTER' VALIGN='MIDDLE'>";
		
		// Mostramos la foto del academico, si es que existe.
		if ($this->foto)
			printf("<IMG SRC='../activos/%s'>", $this->foto);
		else printf("<IMG SRC='../../../librerias/sinfoto.gif'>");
		
		echo "</TD>";
		echo "<TD WIDTH='70%' CLASS='titulotabla'>Nombre:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='70%' CLASS='tabla'>";
		
		// Mostramos el nombre.
		echo $this->nombre;
		
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='70%' CLASS='titulotabla'>Grado Acad&eacute;mico:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='70%' CLASS='tabla'>";
		
		// Mostramos el grado académico.
		echo $this->grado;
		
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='70%' CLASS='titulotabla'>T&iacute;tulo Profesional:</TD>";
		echo "</TR>";
		echo "<TR>";					
		echo "<TD CLASS='tabla'>";
		
		// Consulta que obtiene los títulos de un académico.
		$consulta = "SELECT titulo.nombre_titulo, empresa.nombre_empresa, empresa.url_empresa FROM academico, profesion, titulo, empresa WHERE academico.id_persona = $this->id AND academico.id_persona = profesion.id_persona AND titulo.id_titulo = profesion.id_titulo AND empresa.id_empresa = profesion.id_empresa";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay títulos.
		if ($total == 0)
			echo "&nbsp;";
		// Cuando hay títulos.
		else
		{
			// Ciclo en donde imprimimos los títulos, con su respectiva institución de egreso.
			while ($tupla = mysql_fetch_array($resultado))
			{
				// Mostramos el título.
				printf("%s, ", $tupla["nombre_titulo"]);
				
				// Mostramos la institución de egreso con su vínculo (en caso de existir).
				$empresa = strtr($tupla["nombre_empresa"], $this->caracteres);
				if ($tupla["url_empresa"])
					printf(" <A HREF='http://%s' TARGET='_blank' TITLE='Visitar Web de %s'>%s</A>.<BR>", strtr($tupla["url_empresa"], $this->caracteres), $empresa, $empresa);
				else printf(" %s.<BR>", $empresa);
			}
		}
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
		
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='titulotabla'>E-mail:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='70%' CLASS='tabla'>";
		
		// Mostramos el e-mail, si es que existe.
		if ($this->email)
			printf("<A HREF='mailto:%s' TITLE='%s'>%s</A>", $this->email, $this->email, $this->email);
		else echo "&nbsp;";
		
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='titulotabla'>Sitio Web:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='tabla'>";
		
		// Mostramos el vínculo al sitio Web, si es que existe.
		if ($this->web)
			printf("<A HREF='http://%s' TARGET='_blank' TITLE='Visitar Web de %s'>http://%s</A>", $this->web, $this->nombre, $this->web);
		else echo "&nbsp;";
		
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='titulotabla'>Especialidad:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='tabla'>";
		
		// Consulta que obtiene las áreas de interés de un académico.
		$consulta = "SELECT area.nombre_area FROM area, interes WHERE interes.id_persona = $this->id AND interes.id_area = area.id_area ORDER BY nombre_area";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay intereses.
		if ($total == 0)
			echo "&nbsp;";
		// Cuando hay intereses.
		else
		{
			echo "<BR>";
			echo "<UL>";
			
			// Ciclo en donde imprimimos los intereses.
			while ($tupla = mysql_fetch_array($resultado))
				printf("<LI>%s</LI>", $tupla["nombre_area"]);
			echo "</UL>";
			echo "<BR>";
		}
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
		
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='titulotabla'>Asignaturas Dictadas:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='tabla'>";
		
		// Consulta para mostrar las asignaturas dictadas por un académico en años anteriores.
		$consulta = "SELECT asignatura.nombre_asignatura FROM asignatura, dicta WHERE dicta.id_persona = $this->id AND dicta.id_asignatura = asignatura.id_asignatura GROUP BY asignatura.nombre_asignatura ORDER BY asignatura.nombre_asignatura";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay asignaturas dictadas.
		if ($total == 0)
			echo "&nbsp;";
		// Cuando hay asignaturas dictadas.
		else
		{
			printf("<BR>");
			printf("<UL>");
			
			// Ciclo en donde imprimimos las asignaturas dictadas.
			while ($tupla = mysql_fetch_array($resultado))
				printf("<LI>%s</LI>", $tupla["nombre_asignatura"]);
			printf("</UL>");
			printf("<BR>");
		}
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
		
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='titulotabla'>Publicaciones:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='tabla'>";
		
		// Consulta que muestra las publicaciones de un académico.
		$consulta = "SELECT publicacion.id_publicacion, publicacion.titulo_publicacion, publicacion.anio_publicacion FROM publicacion, desarrollo_publicacion, persona, academico WHERE  persona.id_persona = $this->id AND publicacion.id_publicacion = desarrollo_publicacion.id_publicacion AND desarrollo_publicacion.id_persona = persona.id_persona AND persona.id_persona = academico.id_persona ORDER BY titulo_publicacion";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay publicaciones.
		if ($total == 0)
			echo "&nbsp;";
		// Cuando hay publicaciones.
		else
		{
			printf("<BR>");
			printf("<UL>");
			
			// Ciclo en donde imprimimos las publicaciones.
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<LI>");
				
				// Imprimimos el título de la publicación.
				printf("%s", strtr($tupla["titulo_publicacion"], $this->caracteres));
				
				// Consulta para obtener la empresa editorial.
				$id_publicacion = $tupla["id_publicacion"];
				$consulta = "SELECT empresa.nombre_empresa, empresa.url_empresa FROM libro, empresa WHERE libro.id_empresa = empresa.id_empresa AND libro.id_publicacion = $id_publicacion";
				$result = mysql_query($consulta, $this->enlace);
				$total = mysql_num_rows($result);
				$registro = mysql_fetch_array($result);
				
				// Cuando hay editorial.
				if ($total > 0)
				{
					// Mostramos la editorial con su vínculo (en caso de existir).
					$editorial = strtr($registro["nombre_empresa"], $this->caracteres);
					if ($registro["url_empresa"])
						printf(", <A HREF='http://%s' TARGET='_blank' TITLE='Visitar Web de %s'>%s</A>", strtr($registro["url_empresa"], $this->caracteres), $editorial, $editorial);
					else printf(", %s", $editorial);
				}
				
				// Liberamos memoria del servidor.
				mysql_free_result($result);
				
				// Mostramos el año de publicación, si es que existe.
				if (!$tupla["anio_publicacion"])
					printf(".");
				else printf(", %d.", $tupla["anio_publicacion"]);
				printf("</LI>");
			}
			printf("</UL>");
			printf("<BR>");
		}
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);						
		
		echo "</TD>";
		echo "</TR>";
		echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
		echo "<TR><TD COLSPAN='2' ALIGN='center'><A HREF=\"javascript:history.back(1);\" TITLE='Volver'><IMG SRC='../../../librerias/btvolver.gif' BORDER='0'></A></TD></TR>";
		echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
		echo "</TABLE>";
	}
	
	/**
	 * Método que carga los datos de un administrativo desde la base de datos.
	 */
	function cargarAdministrativo()
	{
		// Consulta que obtiene toda la información de un administrativo.
		$consulta = "SELECT persona.id_persona, persona.nombres_persona, persona.paterno_persona, persona.materno_persona, persona.email_persona, persona.url_persona, administrativo.src_administrativo, administrativo.fono_administrativo, administrativo.fax_administrativo, administrativo.horario_administrativo, cargo.nombre_cargo FROM persona, usuario_interno, administrativo, cargo WHERE persona.id_persona = $this->id AND usuario_interno.id_estado_interno = 1 AND persona.id_persona = usuario_interno.id_persona AND usuario_interno.id_persona = administrativo.id_persona AND administrativo.id_cargo = cargo.id_cargo";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Seteamos los datos.
		$this->nombre = mysql_result($resultado, 0, "nombres_persona") . " " . mysql_result($resultado, 0, "paterno_persona") . " " . mysql_result($resultado, 0, "materno_persona");
		$this->email = strtr(mysql_result($resultado, 0, "email_persona"), $this->caracteres);
		$this->web = strtr(mysql_result($resultado, 0, "url_persona"), $this->caracteres);
		$this->cargo = mysql_result($resultado, 0, "nombre_cargo");
		$this->foto = mysql_result($resultado, 0, "src_administrativo");
		$this->fono = mysql_result($resultado, 0, "fono_administrativo");
		$this->fax = mysql_result($resultado, 0, "fax_administrativo");
		$this->horario = strtr(mysql_result($resultado, 0, "horario_administrativo"), $this->caracteres);
	}
	
	/**
	 * Método que muestra la tabla con el título de la sección 'Administrativos'.
	 */
	function tituloAdministrativo()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Integrantes'>Integrantes</A> / <A HREF='index.php' TITLE='Ver Administrativos'>Administrativos</A> / Curriculum";
		$imagen = "activos/bgadministrativos.jpg";
		$titulo = $this->nombre;
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método en el cual se muestra la tabla con los datos del administrativo.
	 */
	function datosAdministrativo()
	{
		echo "<TABLE WIDTH='100%' BORDER='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD WIDTH='30%' ROWSPAN='8' ALIGN='CENTER' VALIGN='MIDDLE'>";
		
		// Mostramos la foto del academico, si es que existe.
		if (!$this->foto)
			printf("<IMG SRC='../../librerias/sinfoto.gif'>");
		else printf("<IMG SRC='activos/%s'>", $this->foto);
		
		echo "</TD>";
		echo "<TD WIDTH='70%' CLASS='titulotabla'>Nombre:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='70%' CLASS='tabla'>";
		
		// Mostramos el nombre.
		echo $this->nombre;
		
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='70%' CLASS='titulotabla'>Cargo:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='70%' CLASS='tabla'>";
		
		// Mostramos el cargo que desempeña.
		echo $this->cargo;
		
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='70%' CLASS='titulotabla'>Tel&eacute;fono / Fax:</TD>";
		echo "</TR>";
		echo "<TR>";					
		echo "<TD CLASS='tabla'>";
		
		// Imprimimos el fono, si es que existe.
		if (!$this->fono && !$this->fax)
			echo "&nbsp;";
		else echo $this->fono . " / " . $this->fax;
		
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='titulotabla'>E-mail:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH='70%' CLASS='tabla'>";
		
		// Imprimimos el e-mail, si es que existe.
		if ($this->email)
			printf("<A HREF='mailto:%s' TITLE='%s'>%s</A>", $this->email, $this->email, $this->email);
		else echo "&nbsp;";
		
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='titulotabla'>Sitio Web:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='tabla'>";
		
		// Mostramos el vínculo al sitio Web, si es que existe.
		if ($this->web)
			printf("<A HREF='http://%s' TARGET='_blank' TITLE='Visitar Web de %s'>http://%s</A>", $this->web, $this->nombre, $this->web);
		else echo "&nbsp;";
		
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='titulotabla'>Horario de Atenci&oacute;n:</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='tabla'>";
		
		// Imprimimos el horario.
		echo $this->horario;						
		
		echo "</TD>";
		echo "</TR>";
		echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
		echo "<TR><TD COLSPAN='2' ALIGN='center'><A HREF=\"javascript:history.back(1);\" TITLE='Volver'><IMG SRC='../../librerias/btvolver.gif' BORDER='0'></A></TD></TR>";
		echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
		echo "</TABLE>";
	}
}
?>