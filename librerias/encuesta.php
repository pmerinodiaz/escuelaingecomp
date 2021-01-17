<?PHP
/**
 * encuesta.php.
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
 * Clase que administra las encuestas que son mostradas en este Web. Las encuestas son
 * preguntas que se van formulando cada mes a la comunidad y que tienen relación con la
 * Escuela o la Computación. El usuario escoge su respuesta para votar en dicha encuesta.
 * También se genera una breve estadística sobre dichas encuestas.
 */

class encuesta
{
	// Enlace a la base de datos.
	var $enlace;
	
	/**
	 * Método constructor en donde se inicializa el enlace a la base de datos.
	 *
	 * @param	link	Enlace a la base de datos.
	 */
	function encuesta($link)
	{
		$this->enlace = $link;
	}
	
	/**
	 * Método que muestra la encuesta del mes actual (fecha del servidor) para ser mostrada
	 * en el Home del sitio. Se muestra en un cuadro dentro del menú derecho del Home.
	*/
	function mostrarActual()
	{
		// Capturamos el mes y año actual del servidor.
		$mes_actual = date("n");
		$anio_actual = date("Y");
		
		// Consulta para obtener la encuesta correspondiente del mes y año actual.
		$consulta = "SELECT id_encuesta, pregunta_encuesta FROM encuesta WHERE id_mes = $mes_actual AND anio_encuesta = $anio_actual";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Abrimos la tabla para la encuesta.
		echo "<TABLE  WIDHT='100%' BORDER='0' CELLSPACING='0' CELLPADDING='0' MM_NOCONVERT='true'>";
		echo "<TR>";
		echo "<TD>";
		
		// Cuando hay encuesta.
		if ($tupla)
		{
			// Capturamos el identificador de la encuesta.
			$id_encuesta = $tupla["id_encuesta"];
			
			// Consulta para obtener las alternativas (respuestas) correspondientes a la encuesta actual.
			$consulta = "SELECT id_alternativa, desc_alternativa FROM alternativa WHERE id_encuesta = $id_encuesta";
			$alternativas = mysql_query($consulta, $this->enlace);
			$num_alternativas = mysql_num_rows($alternativas);
			
			// Cuando hay alternativas.
			if ($num_alternativas > 0)
			{
				// Abrimos el formulario y la tabla para la encuesta.
				echo "<FORM NAME='encuesta' METHOD='post' ACTION='../encuestas/votar.php' onSubmit='return validarEncuesta();'>";
				echo "<TABLE WIDHT='100%' BORDER='0' CELLSPACING='0' CELLPADDING='0' MM_NOCONVERT='true'>";
				echo "<TR><TD COLSPAN='2'><IMG SRC='../librerias/pxtransparente.gif' HEIGHT='5'></TD></TR>";
				
				// Mostramos la pregunta.
				printf("<TR>");
				printf("<TD COLSPAN='2' ALIGN='center' CLASS='contenido'><FONT COLOR='#29146F'>%s</FONT></TD>", $tupla["pregunta_encuesta"]);
				printf("<TR>");
				
				// Ciclo en donde imprimimos las alternativas de la encuesta.
				while ($fila = mysql_fetch_array($alternativas))
				{
					printf("<TR>");
					printf("<TD WIDTH='%s' VALIGN='top'><INPUT TYPE='radio' NAME='opcion' VALUE='%d'></TD>", "5%", $fila["id_alternativa"]);
					printf("<TD WIDTH='%s' CLASS='detalle'>%s</TD>", "95%", $fila["desc_alternativa"]);
					printf("</TR>");
				}
				
				// Mostramos el botón para votar.
				echo "<TR><TD>&nbsp;</TD></TR>";
				echo "<TR>";
				echo "<TD COLSPAN='2' ALIGN='center'><INPUT TYPE='submit' NAME='votar' VALUE='Votar' CLASS='formbutton' TABINDEX='1' TITLE='Votar en la encuesta'></TD>";
				echo "<TR>";
				echo "<TR><TD>&nbsp;</TD></TR>";
				
				// Mostramos un enlace para ver los resultados de esta encuesta.
				printf("<TR>");
				printf("<TD COLSPAN='2' ALIGN='center' CLASS='detalle'><A HREF='../encuestas/resultados.php?id=%d' TITLE='Ver resultados de la encuesta'>Ver resultados</A></TD>", $tupla["id_encuesta"]);
				printf("<TR>");
				
				// Cerramos la tabla y el formulario.
				echo "</TABLE>";
				echo "</FORM>";
			}
			
			// Liberamos memoria del servidor.
			mysql_free_result($alternativas);
		}
		
		// Cuando no hay encuesta.
		else echo "&nbsp;";
		
		// Cerramos la tabla.
		echo "</TD>";
		echo "</TR>";
		echo "</TABLE>";
		
		// Liberamos memoria del servidor.
		mysql_free_result($resultado);
	}
	
	/**
	 * Método que muestra el título de la sección 'Encuestas'.
	 */
	function mostrarTitulo()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / Encuestas";
		$imagen = "activos/bgencuestas.jpg";
		$titulo = "Encuestas";
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que muestra (en forma paginada) la lista de todas las encuestas encontradas
	 * en la base de datos.
	 *
	 * @param $pagina El número de la página actual dentro de la paginación total.
	 */
	function mostrar($pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "index.php?";
		$porpagina = 5;
		
		// En la primera página mostramos algo de información.
		if ($pagina == 1)
		{
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0' MM_NOCONVERT='TRUE'>";
			echo "<TR>";
      echo "<TD WIDTH='34%' VALIGN='top'><IMG SRC='activos/logoencuestas.jpg' WIDTH='150' HEIGHT='100'></TD>";
      echo "<TD WIDTH='66%' VALIGN='top' CLASS='contenido'><P>En esta secci&oacute;n se encuentran reflejados gr&aacute;ficamente, los resultados obtenidos de las diferentes encuestas que se han ido formulando en este Web. Participa votando en cualquiera de estos temas, eligiendo primero tu alternativa, y luego haciendo clic sobre VOTAR.</P></TD>";
      echo "</TR>";
      echo "<TR>";
      echo "<TD COLSPAN='2'>&nbsp;</TD>";
			echo "</TR>";
		}
		
		// Consulta para obtener todas las encuestas, ordenadas por fecha.
		$consulta = "SELECT encuesta.id_encuesta, encuesta.pregunta_encuesta, SUM(alternativa.votos_alternativa) AS num_usuarios, mes.nombre_mes, encuesta.anio_encuesta FROM encuesta, alternativa, mes WHERE encuesta.id_encuesta = alternativa.id_encuesta AND encuesta.id_mes = mes.id_mes GROUP BY encuesta.id_encuesta ORDER BY encuesta.anio_encuesta DESC, encuesta.id_mes DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay encuestas.
		if ($total == 0)
		{
			echo "<TR>";
			echo "<TD COLSPAN='2' CLASS='contenido'>No hay encuestas.</TD>";
			echo "</TR>";
		}
		// Cuando hay encuestas.
		else
		{
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			
			// Cuando es la primera página.
			if ($pagina == 1)
				echo "<TR><TD COLSPAN='2'>";			
			
			// Tabla para el total, la paginación y las encuestas.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Hay un total de $total encuestas.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD>&nbsp;</TD></TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos las consultas.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Capturamos la identificación de la encuesta.
				$id_encuesta = $tupla["id_encuesta"];
				
				// Query para obtener las alternativas correspondientes a la encuesta.
				$consulta = "SELECT id_alternativa, desc_alternativa, votos_alternativa FROM alternativa WHERE id_encuesta = $id_encuesta";
				$alternativas = mysql_query($consulta, $this->enlace);
				$num_alternativas = mysql_num_rows($alternativas);
				
				// Cuando hay alternativas.
				if ($num_alternativas > 0)
				{
					// Abrimos el formulario y la tabla para la encuesta.
					echo "<FORM NAME='encuesta' METHOD='post' ACTION='votar.php'>";
					echo "<TABLE WIDTH='100%' BORDER='0' CELLSPACING='0' CELLPADDING='0' MM_NOCONVERT='true'>";
					
					// Mostramos la pregunta.
					printf("<TR>");
					printf("<TD COLSPAN='5' ALIGN='center' CLASS='tabla'><B>%s</B></TD>", $tupla["pregunta_encuesta"]);
					printf("</TR>");
					printf("<TR><TD COLSPAN='5'>&nbsp;</TD></TR>");
					
					// Mostramos el número de usuarios.
					printf("<TR>");
					printf("<TD COLSPAN='3'>&nbsp;</TD>");
					printf("<TD COLSPAN='2' CLASS='detalle'>Resultado de %d usuarios:</TD>", $tupla["num_usuarios"]);
					printf("</TR>");
					
					// Ciclo en donde recorremos las alternativas.
					while ($fila = mysql_fetch_array($alternativas))
					{
						printf("<TR>");
						
						// Imprimimos un espacio en blanco.
						echo "<TD WIDTH='15%'>&nbsp;</TD>";
						
						// Imprimimos la alternativa.
						printf("<TD WIDTH='%s' VALIGN='top'><INPUT TYPE='radio' NAME='opcion' VALUE='%d'></TD>", "5%", $fila["id_alternativa"]);
						printf("<TD WIDTH='%s' CLASS='detalle' VALIGN='top'>%s</TD>", "25%", $fila["desc_alternativa"]);
						
						// Calculamos el procentaje.
						if ($tupla["num_usuarios"] > 0)
							$porcentaje = (100.0 * $fila["votos_alternativa"])/$tupla["num_usuarios"];
						else $porcentaje = 0.0;
						
						// Imprimimos el gráfico.
						printf("<TD WIDTH='%s'><IMG SRC='../librerias/pxrojo.gif' WIDTH='%d' HEIGHT='10'></TD>", "15%", $porcentaje);
						
						// Imprimimos el procentaje.
						printf("<TD WIDTH='%s' ALIGN='right' CLASS='contenido'>%0.1f%s</TD>", "10%", $porcentaje, "%");
						printf("</TR>");
					}
					
					// Imprimimos el botón para votar, la fecha y año de inicio de la encuesta.
					printf("<TR>");
					printf("<TD COLSPAN='2'>&nbsp;</TD>");
					printf("<TD COLSPAN='1'><INPUT TYPE='submit' NAME=Votar' VALUE='Votar' CLASS='formbutton' TABINDEX='1' TITLE='Votar en la encuesta'></TD>");
					printf("<TD COLSPAN='2' CLASS='detalle'>Desde %s, %d</TD>", $tupla["nombre_mes"], $tupla["anio_encuesta"]);
					printf("<TR>");
					
					// Cerramos la tabla y el formulario.
					echo "</TABLE>";
					echo "</FORM>";
				}
				
				// Liberamos memoria en el servidor.
				mysql_free_result($alternativas);
			}
			
			// Cerramos la celda, la fila y la tabla. Imprimimos la paginación.
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD>&nbsp;</TD></TR>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "</TABLE>";
			
			// Cuando es la primera página.
			if ($pagina == 1)
				echo "</TD></TR>";
		}
		
		// Cerramos la tabla de la información.
		if ($pagina == 1)
			echo "</TABLE>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda.
		$this->formularioBusqueda();
	}
	
	/**
	 * Método que muestra el formulario de búsqueda de encuestas.
	 */
	function formularioBusqueda()
	{
		$titulo = "B&uacute;squeda de Encuestas";
		$ocultos = "";
		$comentario = "encuestas";
		require("busquedasimple.inc");
	}
	
	/**
	 * Método que muestra el título de la sección 'Votar en Encuesta'.
	 */
	function tituloVotar()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php?pagina=1' TITLE='Ver Encuestas'>Encuestas</A> / Votaci&oacute;n";
		$imagen = "activos/bgencuestas.jpg";
		$titulo = "Votaci&oacute;n en Encuesta";
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que actualiza las votaciones por una alternativa de una encuesta.
	 *
	 * @param $id_alternativa El identificador de la alternativa.
	 */
	function votar($id_alternativa)
	{
		// Consulta para obtener los votos de una alternativa.
		$consulta = "SELECT id_encuesta, votos_alternativa FROM alternativa WHERE id_alternativa = $id_alternativa";
		$resultado = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($resultado);
		
		// Incrementamos el número de votos.
		$votos = $tupla["votos_alternativa"] + 1;
		
		// Consulta para actualizar el número de votos.
		$consulta = "UPDATE alternativa SET votos_alternativa = $votos WHERE id_alternativa = $id_alternativa";
		$resultado = mysql_query($consulta, $this->enlace);
		
		// Imprimimos los mesajes de éxito.
		printf("<P ALIGN='center' CLASS='contenido'><B>TU VOTO HA SIDO REGISTRADO EXITOSAMENTE</B></P>");
		printf("<P CLASS='contenido'>Abajo se encuentran reflejados gr&aacute;ficamente los resultados obtenidos en esta encuesta. Gracias por darnos tu opini&oacute;n.</P>");
		
		// Mostramos los detalles de la encuesta.
		$this->detallar($tupla["id_encuesta"]);
	}
	
	/**
	 * Método que muestra en detalle los resultados de una encuesta.
	 *
	 * @param $id_encuesta El identificador de la encuesta.
	 */
	function detallar($id_encuesta)
	{
		// Consulta para obtener datos de la encuesta.
		$consulta = "SELECT encuesta.pregunta_encuesta, SUM(alternativa.votos_alternativa) AS num_usuarios, mes.nombre_mes, encuesta.anio_encuesta FROM encuesta, alternativa, mes WHERE encuesta.id_encuesta = $id_encuesta AND encuesta.id_encuesta = alternativa.id_encuesta AND encuesta.id_mes = mes.id_mes GROUP BY encuesta.id_encuesta";
		$encuestas = mysql_query($consulta, $this->enlace);
		$tupla = mysql_fetch_array($encuestas);
		
		// Consulta para obtener las alternativas correspondientes a la encuesta.
		$consulta = "SELECT desc_alternativa, votos_alternativa FROM alternativa WHERE id_encuesta = $id_encuesta";
		$alternativas = mysql_query($consulta, $this->enlace);
		
		// Tabla para detallar la encuesta.
		echo "<TABLE WIDTH='100%' BORDER='0' CELLSPACING='0' CELLPADDING='0' MM_NOCONVERT='true'>";
		
		// Mostramos la pregunta.
		printf("<TR>");
		printf("<TD COLSPAN='4' ALIGN='center' CLASS='tabla'><B>%s</B></TD>", $tupla["pregunta_encuesta"]);
		printf("</TR>");
		printf("<TR><TD COLSPAN='4'>&nbsp;</TD></TR>");
		
		// Te mostramos el número de usuarios.
		printf("<TR>");
		printf("<TD COLSPAN='1'>&nbsp;</TD>");
		printf("<TD COLSPAN='3' CLASS='detalle'>Resultado de %d usuarios:</TD>", $tupla["num_usuarios"]);
		printf("</TR>");
		
		// Ciclo en donde recorremos las alternativas.
		while ($fila = mysql_fetch_array($alternativas))
		{
			printf("<TR>");
			
			// Imprimimos la alternativa.
			printf("<TD WIDTH='%s' CLASS='detalle' VALIGN='top'>%s</TD>", "30%", $fila["desc_alternativa"]);
			
			// Calculamos el procentaje.
			if ($tupla["num_usuarios"] > 0)
				$porcentaje = (100.0 * $fila["votos_alternativa"])/$tupla["num_usuarios"];
			else $porcentaje = 0.0;
			
			// Imprimimos el gráfico.
			printf("<TD WIDTH='%s'><IMG SRC='../librerias/pxrojo.gif' WIDTH='%d' HEIGHT='10'></TD>", "20%", $porcentaje);
			
			// Imprimimos el procentaje.
			printf("<TD WIDTH='%s' ALIGN='right' CLASS='contenido'>%0.1f%s</TD>", "10%", $porcentaje, "%");
			
			// Imprimimos un espacio en blanco.
			echo "<TD WIDTH='40%'>&nbsp;</TD>";
			echo "</TR>";
		}
		
		// Imprimimos la fecha de emisión.
		printf("<TR><TD COLSPAN='4'>&nbsp;</TD></TR>");
		printf("<TR>");
		printf("<TD COLSPAN='4' CLASS='detalle'>Desde %s, %d</TD>", $tupla["nombre_mes"], $tupla["anio_encuesta"]);
		printf("<TR>");
		
		// Imprimimos el botón volver.
		echo "<TR><TD COLSPAN='4'>&nbsp;</TD></TR>";
		echo "<TR><TD COLSPAN='4' ALIGN='center'><A HREF=\"javascript:history.back(1);\" TITLE='Volver'><IMG SRC='../librerias/btvolver.gif' BORDER='0'></A></TD></TR>";
		echo "</TABLE>";
		
		// Liberamos memoria en el servidor.
		mysql_free_result($encuestas);
		mysql_free_result($alternativas);
	}
	
	/**
	 * Método que muestra el título de la sección 'Búsqueda de Encuestas'.
	 */
	function tituloBusqueda()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php?pagina=1' TITLE='Ver Encuestas'>Encuestas</A> / B&uacute;squeda";
		$imagen = "activos/bgencuestas.jpg";
		$titulo = "B&uacute;squeda de Encuestas";
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
	
	/**
	 * Método que busca encuestas por coincidencias en la pregunta y muestra los resultados en
	 * forma paginada.
	 *
	 * @param $palabra La palabra o frase a buscar.
	 * @param $pagina El número de la página actual dentro de la paginación total.
	 */
	function buscar($palabra, $pagina)
	{
		// Librerías necesarias.
		include("paginacion.php");
		
		// Inicialización de variables.
		$vinculo = "buscar.php?palabra=" . $palabra . "&";
		$porpagina = 5;
		
		// Consulta para obtener todas las encuestas que coincidan en la pregunta o las alternativas
		// con la palabra ingresada.
		$consulta = "SELECT encuesta.id_encuesta, encuesta.pregunta_encuesta, SUM(alternativa.votos_alternativa) AS num_usuarios, mes.nombre_mes, encuesta.anio_encuesta FROM encuesta, alternativa, mes WHERE encuesta.pregunta_encuesta LIKE '%$palabra%' AND encuesta.id_encuesta = alternativa.id_encuesta AND encuesta.id_mes = mes.id_mes GROUP BY encuesta.id_encuesta ORDER BY encuesta.anio_encuesta DESC, encuesta.id_mes DESC";
		$resultado = mysql_query($consulta, $this->enlace);
		$total = mysql_num_rows($resultado);
		
		// Cuando no hay encuestas.
		if ($total == 0)
			echo "<P CLASS='contenido'>No se encontraron encuestas.</TD>";
		
		// Cuando hay encuestas.
		else
		{
			// Creamos un objeto paginacion.
			$paginacion = new paginacion($total, $pagina, $vinculo, $porpagina);
			
			// Tabla para el total, la paginación y las encuestas.
			echo "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD WIDTH='90%' CLASS='contenido'>Se encontraron $total encuestas.</TD>";
			echo "<TD WIDTH='10%' CLASS='contenido' ALIGN='right'>";
			echo $paginacion->navegar();
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD>&nbsp;</TD></TR>";
			echo "<TR>";
			echo "<TD COLSPAN='2'>";
			
			// Calculamos la condición de stop.
			$termino = $pagina*$porpagina;
			if ($total < $termino)
				$termino = $total;
			
			// Ciclo en donde imprimimos las consultas.
			for ($i=$pagina*$porpagina-$porpagina; $i<$termino; $i++)
			{
				mysql_data_seek($resultado, $i);
				$tupla = mysql_fetch_array($resultado);
				
				// Capturamos la identificación de la encuesta.
				$id_encuesta = $tupla["id_encuesta"];
				
				// Consulta para obtener las alternativas correspondientes a la encuesta.
				$consulta = "SELECT id_alternativa, desc_alternativa, votos_alternativa FROM alternativa WHERE id_encuesta = $id_encuesta";
				$alternativas = mysql_query($consulta, $this->enlace);
				$num_alternativas = mysql_num_rows($alternativas);
				
				// Cuando hay alternativas.
				if ($num_alternativas > 0)
				{
					// Abrimos el formulario y la tabla para la encuesta.
					echo "<FORM NAME='encuesta' METHOD='post' ACTION='votar.php'>";
					echo "<TABLE WIDTH='100%' BORDER='0' CELLSPACING='0' CELLPADDING='0' MM_NOCONVERT='true'>";
					
					// Mostramos la pregunta.
					printf("<TR>");
					printf("<TD COLSPAN='5' ALIGN='center' CLASS='tabla'><B>%s</B></TD>", $tupla["pregunta_encuesta"]);
					printf("</TR>");
					printf("<TR><TD COLSPAN='5'>&nbsp;</TD></TR>");
					
					// Te mostramos el número de usuarios.
					printf("<TR>");
					printf("<TD COLSPAN='3'>&nbsp;</TD>");
					printf("<TD COLSPAN='2' CLASS='detalle'>Resultado de %d usuarios:</TD>", $tupla["num_usuarios"]);
					printf("</TR>");
					
					// Ciclo en donde recorremos las alternativas.
					while ($fila = mysql_fetch_array($alternativas))
					{
						printf("<TR>");
						
						// Imprimimos un espacio en blanco.
						echo "<TD WIDTH='15%'>&nbsp;</TD>";
						
						// Imprimimos la alternativa.
						printf("<TD WIDTH='%s' VALIGN='top'><INPUT TYPE='radio' NAME='opcion' VALUE='%d'></TD>", "5%", $fila["id_alternativa"]);
						printf("<TD WIDTH='%s' CLASS='detalle' VALIGN='top'>%s</TD>", "25%", $fila["desc_alternativa"]);
						
						// Calculamos el procentaje.
						if ($tupla["num_usuarios"] > 0)
							$porcentaje = (100.0 * $fila["votos_alternativa"])/$tupla["num_usuarios"];
						else $porcentaje = 0.0;
						
						// Imprimimos el gráfico.
						printf("<TD WIDTH='%s'><IMG SRC='../librerias/pxrojo.gif' WIDTH='%d' HEIGHT='10'></TD>", "15%", $porcentaje);
						
						// Imprimimos el procentaje.
						printf("<TD WIDTH='%s' ALIGN='right' CLASS='contenido'>%0.1f%s</TD>", "10%", $porcentaje, "%");
						printf("</TR>");
					}
					
					// Imprimimos el botón para votar, la fecha y año de inicio de la encuesta.
					printf("<TR>");
					printf("<TD COLSPAN='2'>&nbsp;</TD>");
					printf("<TD COLSPAN='1'><INPUT TYPE='submit' NAME=Votar' VALUE='Votar' CLASS='formbutton' TABINDEX=1></TD>");
					printf("<TD COLSPAN='2' CLASS='detalle'>Desde %s, %d</TD>", $tupla["nombre_mes"], $tupla["anio_encuesta"]);
					printf("<TR>");
					
					// Cerramos la tabla y el formulario.
					echo "</TABLE>";
					echo "</FORM>";
				}
				
				// Liberamos memoria en el servidor.
				mysql_free_result($alternativas);
			}
			
			// Cerramos la celda, la fila y la tabla. Imprimimos la paginación.
			echo "</TD>";
			echo "</TR>";
			echo "<TR><TD>&nbsp;</TD></TR>";
			echo "<TR BGCOLOR='#E3E9F4'>";
			echo "<TD COLSPAN='2' CLASS='contenido' ALIGN='center'>";
			echo $paginacion->paginar();
			echo "</TD>";
			echo "</TR>";
			echo "</TABLE>";
		}
		
		// Liberamos memoria en el servidor.
		mysql_free_result($resultado);
		
		// Mostramos el formulario de búsqueda.
		$this->formularioBusqueda();
	}
	
	/**
	 * Método que imprime el título de la sección 'Resultados de Encuesta'.
	 */
	function tituloResultados()
	{
		$ubicacion = "Ubicaci&oacute;n: <A HREF='../home/index.php' TITLE='Ver Home'>Home</A> / <A HREF='index.php?pagina=1' TITLE='Ver Encuestas'>Encuestas</A> / Resultados";
		$imagen = "activos/bgencuestas.jpg";
		$titulo = "Resultados de Encuesta";
		$pixel = "../librerias/pxgris.gif";
		require("titulo.inc");
	}
}
?>