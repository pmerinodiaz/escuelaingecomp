<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Pr&aacute;ctica - Reglamento</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META NAME="keywords" CONTENT="reglamentos, prácticas, experiencias, conocimientos, profesionales, expertos, científicos, regímenes, documentos, ofertas, estatutos, plazos, consejos, empresas">
<META NAME="description" CONTENT="En esta página se aborda el tema del reglamento interno exigido por la Escuela Ingeniería en Computación de la ULS, con respecto a la práctica profesional.">
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
 * Script en donde incrementamos el número de visitas del tema 'Reglamento de Práctica'.
*/

// Librerías necesarias.
include("../../librerias/visitas.php");
include("../../librerias/conexion.php");

// Creamos un objeto conexión y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();

// Creamos un objeto visitas e incrementamos las visitas de este tema.
$numero = new visitas($link);
$numero->incrementarTema(48);
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
    <TD WIDTH="154" HEIGHT="540" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../../librerias/bgmenu.gif">
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
					<TD WIDTH="76%" CLASS="ubicacion">Ubicaci&oacute;n: <A HREF="../../home/index.php" TITLE="Ver Home">Home</A> / <A HREF="../index.php" TITLE="Ver Pr&aacute;ctica">Pr&aacute;ctica</A> / Reglamento</TD>
					<TD ROWSPAN="2" WIDTH="24%" VALIGN="TOP"><IMG SRC="activos/bgreglamento.jpg" WIDTH="110" HEIGHT="45"></TD>
				</TR>
				<TR> 
					<TD WIDTH="76%" CLASS="titulo">Reglamento de Pr&aacute;ctica</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2"><IMG SRC="../../librerias/pxgris.gif" WIDTH="460" HEIGHT="1"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="540" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD><IMG SRC="../../librerias/temasrelacionados.gif" WIDTH="154" HEIGHT="19"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Reglamento</TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../ofertas/index.php?pagina=1" TITLE="Ver Ofertas de Pr&aacute;ctica"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Ofertas</A></TD>
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
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"> 
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
    <TD WIDTH="6" HEIGHT="480" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="480" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD CLASS="contenido">La Pr&aacute;ctica de tres meses de duraci&oacute;n, de tipo Profesional y realizada en el 5&ordm; a&ntilde;o de la carrera (9&ordm; Semestre), es obligatoria para la carrera. Deber&aacute; realizarse en una organizaci&oacute;n que pondr&aacute; a disposici&oacute;n la Escuela de Ingenier&iacute;a en Computaci&oacute;n o que el alumno por iniciativa propia lo obtenga o en su defecto esta Escuela le encomendar&aacute; al alumno ciertas tareas para cumplir con esta formalidad.</TD>
				</TR>
				<TR> 
					<TD>&nbsp;</TD>
				</TR>
				<TR> 
					<TD CLASS="contenido"><B>Selecci&oacute;n</B></TD>
				</TR>
				<TR> 
					<TD CLASS="contenido">Se efect&uacute;a considerando varios aspectos. Los principales son: tipo de labores en relaci&oacute;n con la Empresa, deseos del interesado y criterios de la Empresa.</TD>
				</TR>
				<TR> 
					<TD>&nbsp;</TD>
				</TR>
				<TR> 
					<TD CLASS="contenido"><B>Comunicaci&oacute;n a la Empresa</B></TD>
				</TR>
				<TR> 
					<TD CLASS="contenido">Una vez finalizado el proceso de selecci&oacute;n se le comunicar&aacute; a la Empresa el o los nombres de los alumnos preseleccionados o seleccionados seg&uacute;n lo desee la Empresa. Los alumnos deber&aacute;n presentarse en la Empresa con una carta - presentaci&oacute;n o certificado que los acredite como alumnos y los formularios de evaluaci&oacute;n. Al certificarse la calidad de alumnos de esta Universidad, tambi&eacute;n se est&aacute; certificando que est&aacute;n asegurados contra accidentes.</TD>
				</TR>
				<TR> 
					<TD>&nbsp;</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" VALIGN="TOP" CLASS="tema"><A HREF="activos/reglamento_practica.zip" TITLE="Descargar reglamento de pr&aacute;ctica (362 KB)"><IMG SRC="../../librerias/icozip.gif" WIDTH="16" HEIGHT="16" BORDER="0"> DESCARGAR REGLAMENTO DE PRACTICA</A></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="480" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="780" HEIGHT="55" COLSPAN="8" VALIGN="TOP" BGCOLOR="#6699CC">
      <?PHP
			/*
			 * Script en donde se muestran los e-mails de referencia a los directores y los derechos de
			 * copia del sitio web.
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