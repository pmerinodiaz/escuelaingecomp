<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Carrera - Malla Curricular</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META NAME="keywords" CONTENT="mallas, curriculares, estudios, asignaturas, clases, cursos, ramos, pre-grado, semestres, electivos, ciclos, titulaciones, ciencias, prácticas, planes, estudios, objetivos, roles, perfiles, profesionales, carreras, ingenierías, ingenieros, informática, computación, universidades, uls, serena">
<META NAME="description" CONTENT="Página en donde se muestra gráficamente la información de la nueva malla curricular de la carrera ingeniería en computación de la ULS. Aquí están todas las asignaturas de la nueva malla.">
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
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0" onLoad="openWindow('malla.php','MallaCurricular','width=740,height=450,left=0,top=0');">
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/**
 * Script en donde incrementamos el número de visitas del tema 'Malla Curricular'.
*/

include("../../librerias/visitas.php");
include("../../librerias/conexion.php");

// Creamos un objeto conexión y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();

// Creamos un objeto visitas e incrementamos las vistas de este tema.
$numero = new visitas($link);
$numero->incrementarTema(11);
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
    <TD WIDTH="154" HEIGHT="950" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../../librerias/bgmenu.gif">
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
					<TD WIDTH="76%" CLASS="ubicacion">Ubicaci&oacute;n: <A HREF="../../home/index.php" TITLE="Ver Home">Home</A> / <A HREF="../index.php" TITLE="Ver Carrera">Carrera</A> / Malla Curricular</TD>
					<TD ROWSPAN="2" WIDTH="24%" VALIGN="TOP"><IMG SRC="activos/bgmalla.jpg" WIDTH="110" HEIGHT="45"></TD>
				</TR>
				<TR> 
					<TD WIDTH="76%" CLASS="titulo">Malla Curricular</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2"><IMG SRC="../../librerias/pxgris.gif" WIDTH="460" HEIGHT="1"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="950" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD><IMG SRC="../../librerias/temasrelacionados.gif" WIDTH="154" HEIGHT="19"></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../perfil/index.php" TITLE="Ver Perfil Profesional"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Perfil Profesional</A></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../roles/index.php" TITLE="Ver Roles"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Roles</A></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../objetivos/index.php" TITLE="Ver Objetivos"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Objetivos</A></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../objetivos/generales/index.php" TITLE="Ver Objetivos Generales">&#149; Generales</A></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../objetivos/especificos/index.php" TITLE="Ver Objetivos Espec&iacute;ficos">&#149; Espec&iacute;ficos</A></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../planestudio/index.php" TITLE="Ver Plan de Estudio"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Plan de Estudio</A></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../titulacion/index.php" TITLE="Ver Titulaci&oacute;n"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Titulaci&oacute;n</A></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Malla Curricular</TD>
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
						/**
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
				<TR> 
					<TD>&nbsp;</TD>
				</TR>
				<TR> 
					<TD ALIGN="CENTER"><A HREF="#" onClick="openWindow('malla.php','MallaCurricular','width=740,height=450,left=0,top=0');" TITLE="Ver Malla Curricular Interactiva"><IMG SRC="activos/bannermalla.gif" WIDTH="120" HEIGHT="45" BORDER="0"></A></TD>
				</TR>
			</TABLE>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="6" HEIGHT="890" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="890" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD WIDTH="35%" ROWSPAN="2"><IMG SRC="activos/logomalla.jpg" WIDTH="160" HEIGHT="119"></TD>
					<TD WIDTH="65%" CLASS="contenido">Las asignaturas y actividades que conforman el curr&iacute;culum de la carrera, se distribuyen en 10 semestres, enmarc&aacute;ndose en las siguientes &aacute;reas fundamentales: <A HREF="#basico" TITLE="Ver Ciclo B&aacute;sico">Ciclo B&aacute;sico</A>, <A HREF="#superior" TITLE="Ver Ciclo Superior">Ciclo Superior</A>, <A HREF="#electivos" TITLE="Ver Cursos Electivos">Cursos Electivos</A> y <A HREF="#practica" TITLE="Ver Pr&aacute;ctica">Pr&aacute;ctica</A>.</TD>
				</TR>
				<TR> 
					<TD WIDTH="65%" ALIGN="RIGHT"><A HREF="javascript:;" onClick="openWindow('malla.php','MallaCurricular','width=740,height=450,left=0,top=0');" TITLE="Ver Malla Curricular Interactiva"><IMG SRC="activos/linkmalla.gif" WIDTH="210" HEIGHT="25" BORDER="0"></A></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2">&nbsp;</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido"><B>Ciclo B&aacute;sico<A NAME="basico"></A></B></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido">Corresponde a los primeros 4 semestres de la carrera, y su prop&oacute;sito es entregar al alumno una s&oacute;lida formaci&oacute;n en Ciencias B&aacute;sicas de la Ingenier&iacute;a, junto con los fundamentos de la Ingenier&iacute;a Inform&aacute;tica, de tal manera de proveerlo de una base conceptual que le permita acceder a una comprensi&oacute;n acabada de los problemas que ha de enfrentar en su vida profesional.</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2">&nbsp;</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido"><B>Ciclo Superior<A NAME="superior"></A></B></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido"> 
						<P>Corresponde a los 6 semestres restantes de la carrera, y su prop&oacute;sito es entrenar al alumno en proponer, solucionar, experimentar e implementar las soluciones en las l&iacute;neas de desarrollo que le ofrece el &Aacute;rea de Computaci&oacute;n. Este ciclo est&aacute; compuesto por:</P>
						<UL>
							<LI><B>Area Profesional</B>: Su prop&oacute;sito es entregar las herramientas metodol&oacute;gicas y t&eacute;cnicas, junto con las tendencias en la tecnolog&iacute;a de la informaci&oacute;n, aplicables en la planificaci&oacute;n, gesti&oacute;n, dise&ntilde;o y construcci&oacute;n de soluciones inform&aacute;ticas para las organizaciones.</LI>
							<LI><B>Area Especializaci&oacute;n</B>: Su prop&oacute;sito es permitir al alumno perfeccionarse, seg&uacute;n sus intereses en alguna de las l&iacute;neas de desarrollo que el Area de Computaci&oacute;n pone a disposici&oacute;n, e incluso con la posibilidad de complementar su formaci&oacute;n acad&eacute;mica con asignaturas de otras disciplinas afines. Para tal efecto se dispone de una lista de cursos Electivos que puede cursar.</LI>
							<LI><B>Area Complementaria</B>: Su prop&oacute;sito es entregar al alumno elementos que le permitan acercarse a la realidad pol&iacute;tica social, &eacute;tica y cultural que preocupan al hombre contempor&aacute;neo. Para ello se incluyen asignaturas human&iacute;sticas, empresariales y de idiomas.</LI>
						</UL>
					</TD>
				</TR>
				<TR>
					<TD COLSPAN="2">&nbsp;</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido"><B>Cursos Electivos<A NAME="electivos"></A></B></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido">Corresponde a una serie de cursos, cuyo objetivo es prepara al alumno en el manejo de las tecnolog&iacute;as emergentes, d&aacute;ndole con ello la oportunidad de egresar con un conocimiento m&aacute;s acabado.</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2">&nbsp;</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido"><B><A HREF="../../practica/index.php" TITLE="Ver Pr&aacute;ctica">Pr&aacute;ctica</A><A NAME="practica"></A></B></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido">El alumno para completar su curr&iacute;culum, necesita llevar a cabo un trabajo pr&aacute;ctico por espacio de 3 meses, en una organizaci&oacute;n que pondr&aacute; a disposici&oacute;n la Escuela de Ingenier&iacute;a en Computaci&oacute;n o que el alumno por iniciativa propia lo obtenga o en su defecto esta Escuela le encomendar&aacute; al alumno ciertas tareas para cumplir con esta formalidad.</TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="890" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="780" HEIGHT="55" COLSPAN="8" VALIGN="TOP" BGCOLOR="#6699CC">
      <?PHP
			/**
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