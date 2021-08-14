<?PHP
/**
 * proyecto.php.
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
 * Clase que administra los proyectos de investigación que se realizan dentro de la Escuela
 * IC. Los proyectos son trabajos de investigación que realizan los académicos del Area de
 * Computación de la ULS y que se refieren a las Líneas de Investigación que tiene la Escuela.
 */

class proyecto
{
  // Enlace a la base de datos.
	var $enlace;
	
	// Juego especial de caracteres del servidor.
	var $caracteres;
	
	/**
	 * Método constructor en donde se inicializa el enlace a la Base de Datos.
	 *
	 * @param $link Enlace a la base de datos.
	 */
	function proyecto($link)
	{
		$this->enlace = $link;
		$this->caracteres = get_html_translation_table(HTML_SPECIALCHARS);
	}
	
	/**
	 * Método que muestra el título de la sección 'Proyectos'.
	 */
	function mostrarTitulo()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Investigaci&oacute;n'>Investigaci&oacute;n</A> / Proyectos";
		$imagen = "activos/bgproyectos.jpg";
		$titulo = "Proyectos";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra (en forma paginada) los proyectos existentes en la base de datos.
	 *
	 * @param $pagina Número de la página actual dentro de la paginación total.
	 */
	function mostrar($pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "index.php?";
		$porpagina = 5;
		
		// Consulta para mostrar los proyectos de la Escuela.
		$consulta = "SELECT proyecto.id_proyecto, proyecto.titulo_proyecto, proyecto.inicio_proyecto, proyecto.fin_proyecto, tipo_proyecto.desc_tipo_proyecto FROM proyecto, tipo_proyecto WHERE proyecto.id_tipo_proyecto = tipo_proyecto.id_tipo_proyecto ORDER BY fin_proyecto DESC, inicio_proyecto DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay proyectos.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay proyectos en la Escuela Ingenier&iacute;a en Computaci&oacute;n.</TD>";
		
		// Cuando hay proyectos.
		else
		{
			// Creamos el objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			
			// Abrimos la tabla para el total, la paginación y la lista de proyectos.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total proyectos.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Abrimos la tabla para los proyectos.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='455' HEIGHT='5'></TD>";
			echo "</TR>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Imprimimos los proyectos.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				// Seleccionamos solo el número de registros indicados.
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Mostramos el título.
				printf("<TR>");
				printf("<TD CLASS='encabezadotabla' WIDTH='%s' VALIGN='top'>&nbsp;T&iacute;tulo:</TD>", "35%");
				printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>&nbsp;%s</B></TD>", "65%", strtr($tupla["titulo_proyecto"], $this->caracteres));
				printf("</TR>");
				
				// Mostramos el nombre del tipo de proyecto.
				printf("<TR>");
				printf("<TD CLASS='encabezadotabla' VALIGN='top'>&nbsp;Tipo de Proyecto:</TD>");
				printf("<TD CLASS='tabla' VALIGN='top'>&nbsp;%s</TD>", $tupla["desc_tipo_proyecto"]);
				printf("</TR>");
				
				// Consulta para buscar las empresas que garantizan el proyecto.
				$id_proyecto = $tupla["id_proyecto"];
				$consulta = "SELECT empresa.nombre_empresa, empresa.url_empresa, tipo_garantia.desc_tipo_garantia FROM garantia, empresa, tipo_garantia WHERE  garantia.id_proyecto = $id_proyecto AND garantia.id_empresa = empresa.id_empresa AND garantia.id_tipo_garantia = tipo_garantia.id_tipo_garantia ORDER BY desc_tipo_garantia";
				$result = mysql_query($consulta, $this->enlace);
				
				// Ciclo para recorrer las empresas.
				while ($fila = mysql_fetch_array($result))
				{
					// Mostramos el nombre de la empresa con su repectivo tipo de garantía.
					$empresa = strtr($fila["nombre_empresa"], $this->caracteres);
					printf("<TR>");
					printf("<TD CLASS='encabezadotabla' VALIGN='top'>&nbsp;Empresa %s:</TD>", $fila["desc_tipo_garantia"]);
					
					// Establecemos un vínculo al sitio web de la empresa, de haberlo.
					if ($fila["url_empresa"])
						printf("<TD CLASS='tabla' VALIGN='top'>&nbsp;<A HREF='http://%s' TARGET='_blank' TITLE='Visitar Web de %s'>%s</A></TD>", strtr($fila["url_empresa"], $this->caracteres), $empresa, $empresa);
					else printf("<TD CLASS='tabla' VALIGN='top'>&nbsp;%s</TD>", $empresa);
					printf("</TR>");
				}
				
				// Liberamos memoria del servidor.
				mysql_free_result($result);
				
				// Mostramos la fecha inicio y término.
				printf("<TR>");
				printf("<TD CLASS='encabezadotabla' VALIGN='top'>&nbsp;A&ntilde;o inicio - A&ntilde;o t&eacute;rmino:</TD>");
				printf("<TD CLASS='tabla' VALIGN='top'>&nbsp;%s - %s</TD>", $tupla["inicio_proyecto"], $tupla["fin_proyecto"]);
				printf("</TR>");
				
				// Espacio blanco entre medio.
				printf("<TR>");
				printf("<TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='455' HEIGHT='5'></TD>");
				printf("</TR>");
			}
			
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
			echo "</TD>";
			echo "</TR>";
			
			// Imprimimos la paginación.			
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "</TABLE>";
		}
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda.
		$this->formularioBusqueda();
	}
	
	/**
	 * Método que muestra el formulario de búsqueda para los proyectos.
	 */
	function formularioBusqueda()
	{
		$titulo = "B&uacute;squeda de Proyectos";
		$ocultos = "";
		$comentario = "proyectos";
		require("busquedasimple.inc");
	}
	
	/**
	 * Método que muestra el título de la sección 'Búsqueda de Proyectos'.
	 */
	function tituloBusqueda()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='../index.php' TITLE='Ver Investigaci&oacute;n'>Investigaci&oacute;n</A> / <A HREF='index.php?pagina=1' TITLE='Ver Proyectos'>Proyectos</A> / B&uacute;squeda";
		$imagen = "activos/bgproyectos.jpg";
		$titulo = "B&uacute;squeda de Proyectos";
		$pixel = "../../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que busca proyectos que coincidan con la palabra ingresada y los muestra en
	 * forma paginada.
	 *
	 * @param $palabra La palabra o frase a buscar en los proyectos.
	 * @param $pagina Número de la págin actual dentro de la paginación total.
	 */
	function buscar($palabra, $pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "index.php?palabra=" . $palabra . "&";
		$porpagina = 5;
		
		// Consulta para mostrar los proyectos de la Escuela que coinciden con la palabra.
		$consulta = "SELECT proyecto.id_proyecto, proyecto.titulo_proyecto, proyecto.inicio_proyecto, proyecto.fin_proyecto, tipo_proyecto.desc_tipo_proyecto FROM proyecto, tipo_proyecto, empresa, garantia WHERE (proyecto.titulo_proyecto LIKE '%$palabra%' OR empresa.nombre_empresa LIKE '%$palabra%') AND proyecto.id_tipo_proyecto = tipo_proyecto.id_tipo_proyecto AND proyecto.id_proyecto = garantia.id_proyecto AND garantia.id_empresa = empresa.id_empresa GROUP BY proyecto.id_proyecto ORDER BY fin_proyecto DESC, inicio_proyecto DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay proyectos.
		if ($total == 0)
			echo "<P CLASS='contenido'>No se encontraron proyectos.</TD>";
		
		// Cuando hay proyectos.
		else
		{
			// Creamos el objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			
			// Abrimos la tabla para el total, la paginación y la lista de proyectos.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total proyectos.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Abrimos la tabla para los proyectos.
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='455' HEIGHT='5'></TD>";
			echo "</TR>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Imprimimos los proyectos.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				// Seleccionamos solo el número de registros indicados.
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Mostramos el título.
				printf("<TR>");
				printf("<TD CLASS='encabezadotabla' WIDTH='%s' VALIGN='top'>&nbsp;T&iacute;tulo:</TD>", "35%");
				printf("<TD CLASS='tabla' WIDTH='%s' VALIGN='top'><B>&nbsp;%s</B></TD>", "65%", strtr($tupla["titulo_proyecto"], $this->caracteres));
				printf("</TR>");
				
				// Mostramos el nombre del tipo de proyecto.
				printf("<TR>");
				printf("<TD CLASS='encabezadotabla' VALIGN='top'>&nbsp;Tipo de Proyecto:</TD>");
				printf("<TD CLASS='tabla' VALIGN='top'>&nbsp;%s</TD>", $tupla["desc_tipo_proyecto"]);
				printf("</TR>");
				
				// Consulta para buscar las empresas que garantizan el proyecto.
				$id_proyecto = $tupla["id_proyecto"];
				$consulta = "SELECT empresa.nombre_empresa, empresa.url_empresa, tipo_garantia.desc_tipo_garantia FROM garantia, empresa, tipo_garantia WHERE  garantia.id_proyecto = $id_proyecto AND garantia.id_empresa = empresa.id_empresa AND garantia.id_tipo_garantia = tipo_garantia.id_tipo_garantia ORDER BY desc_tipo_garantia";
				$result = mysql_query($consulta, $this->enlace);
				
				// Ciclo para recorrer las empresas.
				while ($fila = mysql_fetch_array($result))
				{
					// Mostramos el nombre de la empresa con su repectivo tipo de garantía.
					$empresa = strtr($fila["nombre_empresa"], $this->caracteres);
					printf("<TR>");
					printf("<TD CLASS='encabezadotabla' VALIGN='top'>&nbsp;Empresa %s:</TD>", $fila["desc_tipo_garantia"]);
					
					// Establecemos un vínculo al sitio web de la empresa, de haberlo.
					if ($fila["url_empresa"])
						printf("<TD CLASS='tabla' VALIGN='top'>&nbsp;<A HREF='http://%s' TARGET='_blank' TITLE='Visitar Web de %s'>%s</A></TD>", strtr($fila["url_empresa"], $this->caracteres), $empresa, $empresa);
					else printf("<TD CLASS='tabla' VALIGN='top'>&nbsp;%s</TD>", $empresa);
					printf("</TR>");
				}
				
				// Liberamos memoria del servidor.
				mysql_free_result($result);
				
				// Mostramos la fecha inicio y término.
				printf("<TR>");
				printf("<TD CLASS='encabezadotabla' VALIGN='top'>&nbsp;A&ntilde;o inicio - A&ntilde;o t&eacute;rmino:</TD>");
				printf("<TD CLASS='tabla' VALIGN='top'>&nbsp;%s - %s</TD>", $tupla["inicio_proyecto"], $tupla["fin_proyecto"]);
				printf("</TR>");
				
				// Espacio blanco entre medio.
				printf("<TR>");
				printf("<TD COLSPAN='2'><IMG SRC='../../librerias/pxtransparente.gif' WIDTH='455' HEIGHT='5'></TD>");
				printf("</TR>");
			}
			
			// Cerramos la tabla y la columna.
			echo "</TABLE>";
			echo "</TD>";
			echo "</TR>";
			
			// Imprimimos la paginación.			
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD COLSPAN='2'>&nbsp;</TD></TR>";
			echo "</TABLE>";
		}
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda.
		$this->formularioBusqueda();
	}
	
	/**
	 * Método que muestra el formulario para agregar un nuevo proyecto.
	 */
	function formularioAgregar()
	{
		// Librerías necesarias.
		include("tipoproyecto.php");
		include("empresa.php");
		
		// Tabla en donde se muestra el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Agregar Proyecto</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>T&iacute;tulo:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' TITLE='T&iacute;tulo del proyecto'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Proyecto:</TD>";
		echo "<TD>";
		$tipo_proyecto = new tipoproyecto($this->enlace);
		$tipo_proyecto->select(2);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Empresa Financiante:</TD>";
		echo "<TD>";
		$empresa = new empresa($this->enlace);
		$empresa->select(-1, "financiante");
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Empresa Patrocinante:</TD>";
		echo "<TD>";
		$empresa->select(-1, "patrocinante");
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>A&ntilde;o de Inicio:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='inicio' CLASS='formtextfield' MAXLENGTH='4' TABINDEX='1' TITLE='A&ntilde;o de inicio del proyecto'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>A&ntilde;o de T&eacute;rmino:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='fin' CLASS='formtextfield' MAXLENGTH='4' TABINDEX='1' TITLE='A&ntilde;o de t&eacute;rmino del proyecto'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
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
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='agregar' VALUE='Agregar' CLASS='formbutton' TABINDEX='1' TITLE='Agregar el proyecto'>&nbsp;<INPUT TYPE='reset' NAME='limpiar' VALUE='Limpiar' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * Método que agrega un nuevo proyecto a la base de datos.
	 *
	 * @param $titulo_proyecto El título del proyecto.
	 * @param $id_tipo_proyecto El identificdor del tipo de proyecto.
	 * @param $id_empresa_financiante El identificador de la empresa financiante.
	 * @param $id_empresa_patrocinante El identificador de la empresa patrocinante.
	 * @param $inicio_proyecto El año de inicio del proyecto.
	 * @param $fin_proyecto El año de término del proyecto.
	 */
	function agregar($titulo_proyecto, $id_tipo_proyecto, $id_empresa_financiante, $id_empresa_patrocinante, $inicio_proyecto, $fin_proyecto)
	{
		// Consulta para agregar el registro en la tabla 'proyecto'.
		$consulta = "INSERT INTO proyecto(id_tipo_proyecto, titulo_proyecto, inicio_proyecto, fin_proyecto) VALUES($id_tipo_proyecto, '$titulo_proyecto', '$inicio_proyecto', '$fin_proyecto')";
		mysql_query($consulta, $this->enlace);
		
		// Obtener el identificador de la última inserción.
		$id_proyecto = mysql_insert_id();
		
		// Consulta para agregar el registro en la tabla 'garantia'.
		$consulta = "INSERT INTO garantia(id_proyecto, id_empresa, id_tipo_garantia) VALUES($id_proyecto, $id_empresa_financiante, 1)";
		mysql_query($consulta, $this->enlace);
		
		// Consulta para agregar el registro en la tabla 'garantia'.
		$consulta = "INSERT INTO garantia(id_proyecto, id_empresa, id_tipo_garantia) VALUES($id_proyecto, $id_empresa_patrocinante, 2)";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de éxito de la operación.
		echo "<P ALIGN='center' CLASS='contenido'><B>TU PROYECTO HA SIDO INGRESADO EXITOSAMENTE</B></P>";
		echo "<P CLASS='contenido'>Este proyecto estar&aacute; disponible en la secci&oacute;n \"Proyectos de Investigaci&oacute;n\" de nuestro sitio Web, para que cualquier persona lo vea y sepa cual ha sido nuestro trabajo. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
	
	/**
	 * Método que lista todos los proyectos que tiene la Escuela Ingeniería en Computación.
	 *
	 * @param $vinculo El vínculo a la página destino de la operación.
	 */
	function listar($vinculo)
	{
		// Consulta para obtener la lista de proyectos.
		$consulta = "SELECT proyecto.id_proyecto, proyecto.titulo_proyecto, tipo_proyecto.desc_tipo_proyecto, proyecto.inicio_proyecto, proyecto.fin_proyecto FROM proyecto, tipo_proyecto WHERE proyecto.id_tipo_proyecto = tipo_proyecto.id_tipo_proyecto ORDER BY proyecto.fin_proyecto DESC, proyecto.inicio_proyecto DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);		
		
		// Cuando no hay proyectos.
		if ($total == 0)
			echo "<P CLASS='contenido'>No hay proyectos de investigaci&oacute;n.</P>";
		
		// Cuando si hay proyectos.
		else
		{
			echo "<TABLE WIDTH='100%' BORDER='0'>";
			echo "<TR>";
			echo "<TD COLSPAN='5' CLASS='contenido'>Hay un total de $total proyectos.</TD>";
			echo "</TR>";
			echo "<TR>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'>&nbsp;</TD>";
			echo "<TD WIDTH='65%' ALIGN='center' CLASS='titulotabla'><B>T&iacute;tulo</B></TD>";
			echo "<TD WIDTH='10%' ALIGN='center' CLASS='titulotabla'><B>Tipo</B></TD>";
			echo "<TD WIDTH='15%' ALIGN='center' CLASS='titulotabla'><B>Inicio - T&eacute;rmino</B></TD>";
			echo "</TR>";
			
			// Texto para enlazar a la operación.
			if ($vinculo == "modificar.php")
				$texto_vinculo = "Modificar";
			else $texto_vinculo = "Eliminar";
			
			// Imprimimos la lista de proyectos.
			while ($tupla = mysql_fetch_array($resultado))
			{
				printf("<TR>");
				printf("<TD ALIGN='center' CLASS='tabla'><A HREF='$vinculo?id=%s' TITLE='%s Proyecto'>%s</A></TD>", $tupla["id_proyecto"], $texto_vinculo, $texto_vinculo);
				printf("<TD CLASS='tabla'>%s</TD>", $tupla["titulo_proyecto"]);
				printf("<TD ALIGN='center' CLASS='tabla'>%s</TD>", $tupla["desc_tipo_proyecto"]);
				printf("<TD ALIGN='center' CLASS='tabla'>%s - %s</TD>", $tupla["inicio_proyecto"], $tupla["fin_proyecto"]);
				printf("</TR>");
			}
			echo "</TABLE>";
		}
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);	
	}
	
	/**
	 * Método que muestra el formulario para modificar un proyecto de investigación.
	 *
	 * @param $id_proyecto El identificador del proyecto.
	 */
	function formularioModificar($id_proyecto)
	{
		// Librerías necesarias.
		include("tipoproyecto.php");
		include("empresa.php");
		
		// Consulta para obtener los datos del proyecto.
		$consulta = "SELECT id_tipo_proyecto, titulo_proyecto, inicio_proyecto, fin_proyecto FROM proyecto WHERE id_proyecto = $id_proyecto";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Tabla en donde mostramos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Modificar Proyecto</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>T&iacute;tulo:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='100' TABINDEX='1' VALUE='" . $tupla["titulo_proyecto"] . "' TITLE='T&iacute;tulo del proyecto'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Proyecto:</TD>";
		echo "<TD>";
		$tipo_proyecto = new tipoproyecto($this->enlace);
		$tipo_proyecto->select($tupla["id_tipo_proyecto"]);
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Empresa Financiante:</TD>";
		echo "<TD>";
		// Consulta para obtener los datos de la empresa financiante.
		$consulta = "SELECT empresa.id_empresa FROM proyecto, garantia, empresa WHERE proyecto.id_proyecto = $id_proyecto AND proyecto.id_proyecto = garantia.id_proyecto AND garantia.id_tipo_garantia = 1 AND garantia.id_empresa = empresa.id_empresa";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		$empresa = new empresa($this->enlace);
		$empresa->select($fila["id_empresa"], "financiante");
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Empresa Patrocinante:</TD>";
		echo "<TD>";
		// Consulta para obtener los datos de la empresa patrocinante.
		$consulta = "SELECT empresa.id_empresa FROM proyecto, garantia, empresa WHERE proyecto.id_proyecto = $id_proyecto AND proyecto.id_proyecto = garantia.id_proyecto AND garantia.id_tipo_garantia = 2 AND garantia.id_empresa = empresa.id_empresa";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		$empresa->select($fila["id_empresa"], "patrocinante");
		echo " <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN>";
		echo "</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>A&ntilde;o de Inicio:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='inicio' CLASS='formtextfield' MAXLENGTH='4' TABINDEX='1' VALUE='" . $tupla["inicio_proyecto"] . "' TITLE='A&ntilde;o de inicio del proyecto'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>A&ntilde;o de T&eacute;rmino:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='fin' CLASS='formtextfield' MAXLENGTH='4' TABINDEX='1' VALUE='" . $tupla["fin_proyecto"] . "' TITLE='A&ntilde;o de t&eacute;rmino del proyecto'> <SPAN CLASS='contenido'><FONT COLOR='#CC0000'>*</FONT></SPAN></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_proyecto' VALUE='$id_proyecto'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='contenido'>&nbsp;<FONT COLOR='#CC0000'>*</FONT> Datos obligatorios</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT TYPE='submit' NAME='modificar' VALUE='Modificar' CLASS='formbutton' TABINDEX='1' TITLE='Modificar el proyecto'>&nbsp;<INPUT TYPE='reset' NAME='restablecer' VALUE='Restablecer' CLASS='formbutton' TABINDEX='1' TITLE='Limpiar el formulario'></TD>";
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
	 * Método que modifica los datos de un proyecto en la base de datos.
	 *
	 * @param $id_proyecto El identificador del proyecto.
	 * @param $titulo_proyecto El título del proyecto.
	 * @param $id_tipo_proyecto El identificador del tipo de proyecto.
	 * @param $id_empresa_financiante El identificador de la empresa financiante.
	 * @param $id_empresa_patrocinante El identificador de la empresa patrocinante.
	 * @param $inicio_proyecto El año de inicio del proyecto.
	 * @param $fin_proyecto El año de término del proyecto.
	 */
	function modificar($id_proyecto, $titulo_proyecto, $id_tipo_proyecto, $id_empresa_financiante, $id_empresa_patrocinante, $inicio_proyecto, $fin_proyecto)
	{
		// Consulta para modificar el registro en la tabla 'proyecto'.
		$consulta = "UPDATE proyecto SET id_tipo_proyecto = $id_tipo_proyecto, titulo_proyecto = '$titulo_proyecto', inicio_proyecto = $inicio_proyecto, fin_proyecto = $fin_proyecto WHERE id_proyecto = $id_proyecto";
		mysql_query($consulta, $this->enlace);
		
		// Consulta para modificar el registro en la tabla 'garantia'.
		$consulta = "UPDATE garantia SET id_empresa = $id_empresa_financiante WHERE id_proyecto = $id_proyecto AND id_tipo_garantia = 1";
		mysql_query($consulta, $this->enlace);
		
		// Consulta para modificar el registro en la tabla 'garantia'.
		$consulta = "UPDATE garantia SET id_empresa = $id_empresa_patrocinante WHERE id_proyecto = $id_proyecto AND id_tipo_garantia = 2";
		mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mensajes de éxito de la operación.
		echo "<P ALIGN='center' CLASS='contenido'><B>TU PROYECTO HA SIDO MODIFICADO EXITOSAMENTE</B></P>";
		echo "<P CLASS='contenido'>Los datos del proyecto han cambiado. Este proyecto est&aacute; disponible en la secci&oacute;n \"Proyectos de Investigaci&oacute;n\" de nuestro sitio Web, para que cualquier persona lo vea y sepa cual ha sido nuestro trabajo. Gracias por colaborar con nosotros.</P>";
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
	
	/**
	 * Método que muestra el formulario para eliminar un proyecto.
	 *
	 * @param $id_proyecto El identificador del proyecto.
	 */
	function formularioEliminar($id_proyecto)
	{
		// Consulta para obtener los datos del proyecto.
		$consulta = "SELECT proyecto.id_tipo_proyecto, tipo_proyecto.desc_tipo_proyecto, proyecto.titulo_proyecto, proyecto.inicio_proyecto, proyecto.fin_proyecto FROM proyecto, tipo_proyecto WHERE proyecto.id_proyecto = $id_proyecto AND proyecto.id_tipo_proyecto = tipo_proyecto.id_tipo_proyecto";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Tabla en donde imprimimos el formulario.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
		echo "<TR>";
		echo "<TD CLASS='contenido'><B>Eliminar Proyecto</B></TD>";
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
		echo "<TD WIDTH='30%' CLASS='formlabel'>T&iacute;tulo:</TD>";
		echo "<TD WIDTH='70%'><INPUT TYPE='text' NAME='titulo' CLASS='formtextfield' MAXLENGTH='100' DISABLED='true' VALUE='" . $tupla["titulo_proyecto"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Tipo de Proyecto:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='tipo_proyecto' CLASS='formtextfield' MAXLENGTH='25' DISABLED='true' VALUE='" . $tupla["desc_tipo_proyecto"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Empresa Financiante:</TD>";
		// Consulta para obtener los datos de la empresa financiante.
		$consulta = "SELECT empresa.nombre_empresa FROM proyecto, garantia, empresa WHERE proyecto.id_proyecto = $id_proyecto AND proyecto.id_proyecto = garantia.id_proyecto AND garantia.id_tipo_garantia = 1 AND garantia.id_empresa = empresa.id_empresa";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		echo "<TD><INPUT TYPE='text' NAME='financiante' CLASS='formtextfield' MAXLENGTH='100' DISABLED='true' VALUE='" . $fila["nombre_empresa"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>Empresa Patrocinante:</TD>";
		// Consulta para obtener los datos de la empresa patrocinante.
		$consulta = "SELECT empresa.nombre_empresa FROM proyecto, garantia, empresa WHERE proyecto.id_proyecto = $id_proyecto AND proyecto.id_proyecto = garantia.id_proyecto AND garantia.id_tipo_garantia = 2 AND garantia.id_empresa = empresa.id_empresa";
		$resultado = mysql_query($consulta, $this->enlace);
		$fila = mysql_fetch_array($resultado);
		mysql_free_result($resultado);
		echo "<TD><INPUT TYPE='text' NAME='patrocinante' CLASS='formtextfield' MAXLENGTH='100' DISABLED='true' VALUE='" . $fila["nombre_empresa"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>A&ntilde;o de Inicio:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='inicio' CLASS='formtextfield' MAXLENGTH='4' DISABLED='true' VALUE='" . $tupla["inicio_proyecto"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD CLASS='formlabel'>A&ntilde;o de T&eacute;rmino:</TD>";
		echo "<TD><INPUT TYPE='text' NAME='fin' CLASS='formtextfield' MAXLENGTH='4' DISABLED='true' VALUE='" . $tupla["fin_proyecto"] . "'></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'>¿Confirma que deseas eliminar este proyecto?</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2' CLASS='formlabel'><INPUT TYPE='radio' NAME='confirmar' CHECKED='true' VALUE='1'>Si<BR><INPUT TYPE='radio' NAME='confirmar' VALUE='0'>No</TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD COLSPAN='2'>&nbsp;<INPUT TYPE='hidden' NAME='id_proyecto' VALUE='$id_proyecto'></TD>";
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
	 * Método que elimina un proyecto en la base de datos.
	 *
	 * @param $id_proyecto El identificador del proyecto.
	 * @param $confirmar Si el usuario desea realmente eliminar el proyecto.
	 */
	function eliminar($id_proyecto, $confirmar)
	{
		// Cuando hay que eliminar el proyecto.
		if ($confirmar == 1)
		{
			// Eliminamos el registro en la tabla 'garantia'.
			$consulta = "DELETE FROM garantia WHERE id_proyecto = $id_proyecto";
			mysql_query($consulta, $this->enlace);
			
			// Eliminamos el registro en la tabla 'proyecto'.
			$consulta = "DELETE FROM proyecto WHERE id_proyecto = $id_proyecto";
			mysql_query($consulta, $this->enlace);
			
			// Imprimimos los mesajes de éxito de la operación.
			echo "<P ALIGN='center' CLASS='contenido'><B>EL PROYECTO HA SIDO ELIMINADO EXITOSAMENTE</B></P>";
			echo "<P CLASS='contenido'>Este proyecto ha sido eliminado de los registros de proyectos de investigaci&oacute;n realizados en la Escuela Ingenier&iacute;a en Computaci&oacute;n, que se encuentran en la secci&oacute;n \"Proyectos\" de nuestro sitio Web. Gracias por colaborar con nosotros.</P>";
		}
		// Cuando no hay que eliminar el proyecto.
		else
		{
			echo "<P ALIGN='center' CLASS='contenido'><B>LA ELIMINACION DEL PROYECTO HA SIDO CANCELADA</B></P>";
			echo "<P CLASS='contenido'>Este proyecto no ha sido eliminado de los registros de proyectos de investigaci&oacute;n realizados en la Escuela Ingenier&iacute;a en Computaci&oacute;n, que se encuentran en la secci&oacute;n \"Proyectos\" de nuestro sitio Web, por lo que cualquier persona de Chile y el mundo lo puede seguir viendo. Gracias por colaborar con nosotros.</P>";
		}
		echo "<DIV ALIGN='center'><A HREF='index.php' TITLE='Volver'><IMG SRC='../../../../librerias/btvolver.gif' BORDER='0'></A></DIV>";
	}
}
?>