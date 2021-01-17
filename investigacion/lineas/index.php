<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Investigaci&oacute;n - L&iacute;neas de Investigaci&oacute;n</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META NAME="keywords" CONTENT="investigaciones, ciencias, científicos, ingenierías, software, sistemas, computadores, redes, programas, webs, internet, educaciones, informática, computación, operativos, modelamientos, programación, inteligencias, artificiales, agentes, matemáticas, discretas, autómatas, lenguajes, formales, grafos, gramáticas, vidas, lógicas, fuzzy, expertos, multimedias, hipermedias, interfaces, cal, bases, datos, proyectos, trabajos, tecnologías, publicaciones, libros, académicos, profesores, colegiados">
<META NAME="description" CONTENT="Página en donde se explican las líneas de investigación que lleva a cabo la Escuela Ingeniería en Computación de la ULS. Las líneas corresponden a: Sistemas de Computación y Comunicaciones de Datos, Ingeniería de Software, Informática Teórica, Sistemas Inteligentes e Informática Educativa.">
<META NAME="author" CONTENT="Héctor Díaz Díaz - Patricio Merino Díaz">
<META NAME="copyright" CONTENT="2004 Escuela Ingeniería en Computación, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="All">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/nivel2.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/coolmenu.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/ventanita.js"></SCRIPT>
<LINK REL="stylesheet" HREF="../../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../librerias/tema.css" TYPE="text/css">
</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/*
 * Script en donde incrementamos el número de visitas del tema 'Líneas de Investigación'.
*/

// Librerías necesarias.
include("../../librerias/visitas.php");
include("../../librerias/conexion.php");

// Creamos un objeto conexión y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();

// Creamos un objeto visitas e incrementamos las visitas de este tema.
$numero = new visitas($link);
$numero->incrementarTema(23);
$conexion->desconectar();
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD WIDTH="350" HEIGHT="60" COLSPAN="3" ROWSPAN="2" VALIGN="TOP">
			<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH="350" HEIGHT="60">
    		<PARAM NAME="movie" VALUE="../../librerias/logoic.swf">
    		<PARAM NAME="quality" VALUE="high">
    		<PARAM NAME="menu" VALUE="false">
    		<EMBED SRC="../../librerias/logoic.swf" WIDTH="350" HEIGHT="60" QUALITY="high" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" TYPE="application/x-shockwave-flash" MENU="false">
    		</EMBED>
			</OBJECT>
		</TD>
    <TD WIDTH="10" HEIGHT="60" ROWSPAN="2" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
    <TD WIDTH="20" HEIGHT="17" VALIGN="TOP"><IMG SRC="../../librerias/curva.gif" WIDTH="20" HEIGHT="17"></TD>
    <TD WIDTH="240" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="6" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="17" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="420" HEIGHT="43" COLSPAN="4" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="1400" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../../librerias/bgmenu.gif"> 
      <TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD><IMG SRC="../../librerias/infogeneral.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="181"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../../librerias/infolocal.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
				<TR> 
		      <TD><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="127"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../../librerias/miscelaneos.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="60" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD WIDTH="76%" CLASS="ubicacion">Ubicaci&oacute;n: <A HREF="../../home/index.php" TITLE="Ver Home">Home</A> / <A HREF="../index.php" TITLE="Ver Investigaci&oacute;n">Investigaci&oacute;n</A> / L&iacute;neas de Investigaci&oacute;n</TD>
					<TD ROWSPAN="2" WIDTH="24%" VALIGN="TOP"><IMG SRC="activos/bglineas.jpg" WIDTH="110" HEIGHT="45"></TD>
				</TR>
				<TR> 
					<TD WIDTH="76%" CLASS="titulo">L&iacute;neas de Investigaci&oacute;n</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2"><IMG SRC="../../librerias/pxgris.gif" WIDTH="460" HEIGHT="1"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="1400" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../../librerias/bgmenu.gif"> 
      <TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD><IMG SRC="../../librerias/temasrelacionados.gif" WIDTH="154" HEIGHT="19"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">L&iacute;neas de Investigaci&oacute;n</TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../proyectos/index.php?pagina=1" TITLE="Ver Proyectos"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Proyectos</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../publicaciones/index.php?pagina=1" TITLE="Ver Publicaciones"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Publicaciones</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD><IMG SRC="../../librerias/herramientas.gif" WIDTH="154" HEIGHT="19"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"> 
            <?PHP
						/*
						 * Script en donde se muestra las opciones de herramientas que tiene el sitio Web.
						*/
						$nivel = "../../";
						require("../../librerias/herramientas.inc");
						?>
          </TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
        </TR>
      </TABLE>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="6" HEIGHT="1340" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="1340" COLSPAN="4" VALIGN="TOP"> 
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD COLSPAN="2" CLASS="contenido" VALIGN="TOP">La Escuela de Computaci&oacute;n concentra su actividad acad&eacute;mica en docencia, investigaci&oacute;n y asistencia t&eacute;cnica, en torno a cinco l&iacute;neas de desarrollo que</TD>
				</TR>
				<TR> 
					<TD WIDTH="55%" CLASS="contenido" VALIGN="TOP">originan las especialidades: <A HREF="#computacion" TITLE="Ver Sistemas de Computaci&oacute;n y Comunicaciones de Datos">Sistemas de Computaci&oacute;n y Comunicaciones de Datos</A>, <A HREF="#ingenieria" TITLE="Ver Ingenier&iacute;a de Software">Ingenier&iacute;a de Software</A>, <A HREF="#teorica" TITLE="Ver Inform&aacute;tica Te&oacute;rica">Inform&aacute;tica Te&oacute;rica</A>, <A HREF="#inteligentes" TITLE="Ver Sistemas Inteligentes">Sistemas Inteligentes</A> e <A HREF="#educativa" TITLE="Ver Inform&aacute;tica Educativa">Inform&aacute;tica Educativa</A>, en las cuales se concentran la mayor&iacute;a de las asignaturas del Plan de Estudio.</TD>
					<TD WIDTH="45%" VALIGN="TOP" ALIGN="CENTER"><IMG SRC="activos/logolineas.gif" WIDTH="200" HEIGHT="130"></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2">&nbsp;</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido"><B>Sistemas de Computaci&oacute;n y Comunicaciones de Datos<A NAME="computacion"></A></B></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido">
						<P>En esta &aacute;rea se estudian los aspectos conceptuales relacionados con la construcci&oacute;n, operaci&oacute;n, soporte y mantenci&oacute;n de sistemas computacionales, considerando los servicios, herramientas e interfaces que ofrecen. Desarrollando actividades en:</P>
						<UL>
							<LI>Arquitectura de Computadores. </LI>
							<LI>Sistemas Operativos y Redes de Computadores.</LI>
							<LI>Sistemas de Computaci&oacute;n Distribuida y Paralela.</LI>
							<LI>Construcci&oacute;n de Sistemas de Informaci&oacute;n WWW.</LI>
							<LI>Sistemas Gr&aacute;ficos e Inteligentes.</LI>
						</UL>
					</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2">&nbsp;</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido"><B>Ingenier&iacute;a de Software<A NAME="ingenieria"></A></B></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido">
						<P>En esta &aacute;rea se estudian los aspectos conceptuales involucrados en el proceso de desarrollo de productos de software. Para tal efecto, se preocupa de c&oacute;mo lograr un buen dise&ntilde;o y de c&oacute;mo administrar este proceso, cubriendo especialmente aspectos del modelamiento de datos y las interfaces usuarias. Desarrollando actividades en:</P>
						<UL>
							<LI>Ingenier&iacute;a de Software. </LI>
							<LI>Modelamiento de los datos y sistemas de base de datos.</LI>
							<LI>Metodolog&iacute;as y herramientas de desarrollo de software.</LI>
							<LI>Interfaces humano-computador.</LI>
							<LI>Tecnolog&iacute;as Internet y Web.</LI>
						</UL></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2">&nbsp;</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido"><B>Inform&aacute;tica Te&oacute;rica<A NAME="teorica"></A></B></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido">
						<P>En esta &aacute;rea se estudian los aspectos te&oacute;ricos y fundamentos de la programaci&oacute;n. Para tal efecto, se preocupa de estudiar los fundamentos matem&aacute;ticos que est&aacute;n detr&aacute;s del dise&ntilde;o y an&aacute;lisis de algoritmos, las diversas implementaciones y aplicaciones de las estructuras de datos, como tambi&eacute;n de la parte sem&aacute;ntica de los lenguajes formales. Desarrollando actividades en:</P>
						<UL>
							<LI>Matem&aacute;ticas discretas. </LI>
							<LI>Teor&iacute;a de Aut&oacute;matas y Lenguajes Formales.</LI>
							<LI>Dise&ntilde;o y An&aacute;lisis de Algoritmos.</LI>
							<LI>Teor&iacute;a de Grafos y Gram&aacute;ticas de Grafos.</LI>
							<LI>Especificaciones Algebraicas.</LI>
						</UL></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2">&nbsp;</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido"><B>Sistemas Inteligentes<A NAME="inteligentes"></A></B></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido">
						<P>En esta &aacute;rea se estudian los Sistemas Inteligentes como una gran l&iacute;nea de desarrollo que abarca: Reconocimiento de Formas, Redes Neuronales y Algoritmos Gen&eacute;ticos entre otras. Desarrollando actividades en:</P>
						<UL>
							<LI>Inteligencia Artificial. </LI>
							<LI>Vida Artificial.</LI>
							<LI>Programaci&oacute;n L&oacute;gica.</LI>
							<LI>Sistemas Expertos.</LI>
							<LI>Teor&iacute;a Fuzzy.</LI>
						</UL></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2">&nbsp;</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido"><B>Inform&aacute;tica Educativa<A NAME="educativa"></A></B></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido">
						<P>En esta &aacute;rea se estudian los aspectos te&oacute;ricos y pr&aacute;cticos de la utilizaci&oacute;n de herramientas computacionales en el proceso de ense&ntilde;anza aprendizaje, ya sea como medios did&aacute;cticos o de apoyo a la labor docente. Desarrollando actividades de las siguientes l&iacute;neas de trabajo:</P>
						<UL>
							<LI>Interfaces humano-computador. </LI>
							<LI>Multimedia e Hipermedia.</LI>
							<LI>CAL.</LI>
							<LI>Tecnolog&iacute;as Internet y Web.</LI>
						</UL></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="1340" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="780" HEIGHT="55" COLSPAN="8" VALIGN="TOP" BGCOLOR="#6699CC">
      <?PHP
			/*
			 * Script en donde se muestran los e-mails de referencia a los directores y los derechos de
			 * copia del sitio Web.
			*/
			require("../../librerias/referencia.inc");
			?>
    </TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="190" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="190" HEIGHT="1"></TD>
    <TD WIDTH="10" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="10" HEIGHT="1"></TD>
    <TD WIDTH="20" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="20" HEIGHT="1"></TD>
    <TD WIDTH="240" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="240" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
  </TR>
</TABLE>
</BODY>
</HTML>