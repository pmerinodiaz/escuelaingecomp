<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Admisi&oacute;n - Postulaci&oacute;n - ULS</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META NAME="keywords" CONTENT="postulaciones, pruebas, requisitos, universidades, serena, uls, carreras, ingenierías, computación, admisiones, consejos, rectores, cálculos, puntajes, consultas, preguntas, dudas, paa, psu, ingresos, regiones, postular">
<META NAME="description" CONTENT="Página que muestra la información del proceso de postulación a la Universidad de La Serena. Se muestran el máximo de postulaciones, el puntaje ponderado mínimo, el puntaje adicional por preferencia, el puntaje adicional por región de procedencia, los ingresos especiales y la referencia al lugar con más informaciones.">
<META NAME="author" CONTENT="Héctor Díaz Díaz - Patricio Merino Díaz">
<META NAME="copyright" CONTENT="2004 Escuela Ingeniería en Computación, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="All">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/nivel3.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/coolmenu.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/ventanita.js"></SCRIPT>
<LINK REL="stylesheet" HREF="../../../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../../librerias/tema.css" TYPE="text/css">
</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/**
 * Script en donde incrementamos el número de visitas del tema 'Postulación a la ULS'.
*/

// Librerías necesarias.
include("../../../librerias/conexion.php");
include("../../../librerias/visitas.php");

// Creamos un objeto conexión y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();

// Creamos un objeto visitas e incrementamos las visitas de este tema.
$numero = new visitas($link);
$numero->incrementarTema(19);
$conexion->desconectar();
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD WIDTH="350" HEIGHT="60" COLSPAN="3" ROWSPAN="2" VALIGN="TOP">
			<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH="350" HEIGHT="60">
				<PARAM NAME="movie" VALUE="../../../librerias/logoic.swf">
				<PARAM NAME="quality" VALUE="high">
				<PARAM NAME="menu" VALUE="false">
				<EMBED SRC="../../../librerias/logoic.swf" WIDTH="350" HEIGHT="60" QUALITY="high" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" TYPE="application/x-shockwave-flash" MENU="false">
				</EMBED>
			</OBJECT>
		</TD>
    <TD WIDTH="10" HEIGHT="60" ROWSPAN="2" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
    <TD WIDTH="20" HEIGHT="17" VALIGN="TOP"><IMG SRC="../../../librerias/curva.gif" WIDTH="20" HEIGHT="17"></TD>
    <TD WIDTH="240" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="6" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="17" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="420" HEIGHT="43" COLSPAN="4" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="1048" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../../../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD><IMG SRC="../../../librerias/infogeneral.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="181"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../../../librerias/infolocal.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="127"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../../../librerias/miscelaneos.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="60" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD WIDTH="76%" CLASS="ubicacion">Ubicaci&oacute;n: <A HREF="../../../home/index.php" TITLE="Ver Home">Home</A> / <A HREF="../../index.php" TITLE="Ver Admisi&oacute;n">Admisi&oacute;n</A> / <A HREF="../index.php" TITLE="Ver Postulaci&oacute;n">Postulaci&oacute;n</A> / ULS</TD>
					<TD ROWSPAN="2" WIDTH="24%" VALIGN="TOP"><IMG SRC="activos/bguls.jpg" WIDTH="110" HEIGHT="45"></TD>
				</TR>
				<TR> 
					<TD WIDTH="76%" CLASS="titulo">Postulaci&oacute;n a la ULS</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2"><IMG SRC="../../../librerias/pxgris.gif" WIDTH="460" HEIGHT="1"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="1048" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../../../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD><IMG SRC="../../../librerias/temasrelacionados.gif" WIDTH="154" HEIGHT="19"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><A HREF="../index.php" TITLE="Ver Postulaci&oacute;n"><IMG SRC="../../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Postulaci&oacute;n</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1">&#149; ULS</TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../carrera/index.php" TITLE="Ver Postulaci&oacute;n a la Carrera">&#149; Carrera</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><A HREF="../../calculopuntaje/index.php" TITLE="Ver C&aacute;lculo Puntaje"><IMG SRC="../../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">C&aacute;lculo Puntaje</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><A HREF="../../consultas/index.php?pagina=1" TITLE="Ver Consultas"><IMG SRC="../../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Consultas</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD><IMG SRC="../../../librerias/herramientas.gif" WIDTH="154" HEIGHT="19"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif"> 
            <?PHP
						/*
						 * Script en donde se muestra las opciones de herramientas que tiene el sitio Web.
						*/
						$nivel = "../../../";
						require("../../../librerias/herramientas.inc");
						?>
          </TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif"><IMG SRC="../../../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
        </TR>
      </TABLE>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="6" HEIGHT="988" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="988" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD WIDTH="65%" VALIGN="TOP" CLASS="contenido">La postulaci&oacute;n a la <A HREF="http://www.userena.cl" TARGET="_blank" TITLE="Visitar Web de Universidad de La Serena">Universidad de La Serena</A> se rige por los procedimientos generales para todas las instituciones de educaci&oacute;n superior adscritas al Consejo de Rectores. Los plazos de inscripci&oacute;n y postulaci&oacute;n son los que se indican en la Gu&iacute;a de Ingreso a las Universidades Chilenas, que se publica en el diario <A HREF="http://www.lanacion.cl" TARGET="_blank" TITLE="Ver Web de La Naci&oacute;n">La Naci&oacute;n</A>. Dicho documento </TD>
          <TD ALIGN="CENTER" WIDTH="35%" VALIGN="MIDDLE"><IMG SRC="activos/logouls1.jpg" WIDTH="144" HEIGHT="100"></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido">-que se difunde a&ntilde;o a a&ntilde;o- contiene la informaci&oacute;n oficial y definitiva relativa a carreras, vacantes y requisitos necesarios para postular a cualquier carrera de la <A HREF="http://www.userena.cl" TARGET="_blank" TITLE="Visitar Web de Universidad de La Serena">Universidad de La Serena</A>.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>M&aacute;ximo de Postulaciones</B></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido">El n&uacute;mero m&aacute;ximo de postulaciones a la <A HREF="http://www.userena.cl" TARGET="_blank" TITLE="Visitar Web de Universidad de La Serena">Universidad de La Serena</A> son cinco.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>Puntaje Ponderado M&iacute;nimo</B></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido">La <A HREF="http://www.userena.cl" TARGET="_blank" TITLE="Visitar Web de Universidad de La Serena">Universidad de La Serena</A> exige para postular a todas sus carreras un promedio P.S.U. de 450 puntos, con excepci&oacute;n de la carrera Psicolog&iacute;a que exige un promedio ponderado de 580 puntos.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>Puntaje Adicional por Preferencia</B></TD>
        </TR>
        <TR> 
          <TD WIDTH="65%" VALIGN="TOP" CLASS="contenido">La <A HREF="http://www.userena.cl" TARGET="_blank" TITLE="Visitar Web de Universidad de La Serena">Universidad de La Serena</A> bonificar&aacute; por preferencia de postulaci&oacute;n como sigue: 1ra preferencia 30 puntos, 2da preferencia 20 puntos y 3ra preferencia 10 puntos. Esta bonificaci&oacute;n se otorga sobre el puntaje m&iacute;nimo ponderado para la carrera. </TD>
          <TD WIDTH="35%" ALIGN="CENTER" VALIGN="TOP"><IMG SRC="activos/logouls2.jpg" WIDTH="135" HEIGHT="100"></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>Puntaje Adicional por Regi&oacute;n de Procedencia</B></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido">La <A HREF="http://www.userena.cl" TARGET="_blank" TITLE="Visitar Web de Universidad de La Serena">Universidad de La Serena</A> bonificar&aacute; con 10 puntos a todas las postulaciones que hayan obtenido su Licencia de Educaci&oacute;n Media en Establecimientos Educacionales de la IV Regi&oacute;n.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><STRONG>Ingresos Especiales</STRONG></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido">
						<P>Para alumnos regulares con un m&iacute;nimo de dos semestres aprobados, que deseen cambiarse de carrera en forma interna, traslados de alumnos de otras universidades chilenas o extranjeras que deseen incorporarse a la carrera de origen o a otra diferente, postulantes chilenos o extranjeros que hayan finalizado 
            sus estudios de Ense&ntilde;anza Media o equivalente en otro pa&iacute;s. Titulados en &eacute;sta u otra Instituci&oacute;n de Educaci&oacute;n Superior. Todos los postulantes deben cumplir con el Reglamento de R&eacute;gimen de Estudios de la Universidad de La Serena.</P>
            <P>Las fechas de postulaci&oacute;n y los requisitos deben consultarse en las direcciones y tel&eacute;fonos que aparecen al final de la p&aacute;gina.</P></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>Mayores Informaciones</B></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido">Departamento de Admisi&oacute;n y Matr&iacute;cula.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido">Calle Benavente 980, La Serena.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido">Tel&eacute;fono: (51) 204082.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido">Fax: (51) 204240.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido">Sitio Web: <A HREF="http://www.userena.cl" TARGET="_blank" TITLE="Visitar Web de Universidad de La Serena">www.userena.cl</A></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
      </TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="988" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="780" HEIGHT="55" COLSPAN="8" VALIGN="TOP" BGCOLOR="#6699CC">
      <?PHP
			/*
			 * Script en donde se muestran los e-mails de referencia a los directores y los derechos de
			 * copia del sitio Web.
			*/
			require("../../../librerias/referencia.inc");
			?>
    </TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="190" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="190" HEIGHT="1"></TD>
    <TD WIDTH="10" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="10" HEIGHT="1"></TD>
    <TD WIDTH="20" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="20" HEIGHT="1"></TD>
    <TD WIDTH="240" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="240" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
  </TR>
</TABLE>
</BODY>
</HTML>