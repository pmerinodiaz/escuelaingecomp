<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Escuela - Rese&ntilde;a Hist&oacute;rica</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META NAME="keywords" CONTENT="rese�as, historias, hist�ricas, hist�ricos, escuelas, misiones, objetivos, carreras, ingenier�as, computaci�n, inform�tica, facultades, universidades, uls, �reas">
<META NAME="description" CONTENT="P�gina que muestra informaci�n sobre la rese�a hist�rica de la Escuela Ingenier�a en Computaci�n. Se muestra la informaci�n de c�mo haci� y forj� la carrera.">
<META NAME="author" CONTENT="H�ctor D�az D�az - Patricio Merino D�az">
<META NAME="copyright" CONTENT="2004 Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile">
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
/**
 * Script en donde incrementamos el n�mero de visitas del tema 'Rese�a Hist�rica'.
*/

// Librer�as necesarias.
include("../../librerias/visitas.php");
include("../../librerias/conexion.php");

// Creamos un objeto conexi�n y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();

// Creamos un objeto visitas e incrementamos las visitas para este tema.
$numero = new visitas($link);
$numero->incrementarTema(1);
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
			</OBJECT></TD>
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
    <TD WIDTH="154" HEIGHT="635" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../../librerias/bgmenu.gif">
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
					<TD WIDTH="76%" CLASS="ubicacion">Ubicaci&oacute;n: <A HREF="../../home/index.php" TITLE="Ver Home">Home</A> / <A HREF="../index.php" TITLE="Ver Escuela">Escuela</A> / Rese&ntilde;a Hist&oacute;rica</TD>
					<TD ROWSPAN="2" WIDTH="24%" VALIGN="TOP"><IMG SRC="activos/bghistoria.jpg" WIDTH="110" HEIGHT="45"></TD>
				</TR>
				<TR> 
					<TD WIDTH="76%" CLASS="titulo">Rese&ntilde;a Hist&oacute;rica</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2"><IMG SRC="../../librerias/pxgris.gif" WIDTH="460" HEIGHT="1"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="635" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD><IMG SRC="../../librerias/temasrelacionados.gif" WIDTH="154" HEIGHT="19"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Rese&ntilde;a Hist&oacute;rica</TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../mision/index.php" TITLE="Ver Misi&oacute;n"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Misi&oacute;n</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../objetivos/index.php" TITLE="Ver Objetivos"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Objetivos</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../objetivos/generales/index.php" TITLE="Ver Objetivos Generales">&#149; Generales</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="8"><A HREF="../objetivos/especificos/index.php" TITLE="Ver Objetivos Especificos">&#149; Espec&iacute;ficos</A></TD>
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
      </TABLE></TD>
  </TR>
  <TR>
    <TD WIDTH="6" HEIGHT="575" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="575" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
  			<TR> 
  				<TD COLSPAN="2" CLASS="contenido">La carrera de Ingenier&iacute;a en Computaci&oacute;n surge como el prop&oacute;sito de incrementar la oferta acad&eacute;mica basada en la revoluci&oacute;n tecnol&oacute;gica que estaba experimentando la computaci&oacute;n e inform&aacute;tica en nuestra sociedad y en la formaci&oacute;n acad&eacute;mica del personal que dictaba las asignaturas de computaci&oacute;n a las distintas carreras.</TD>
    		</TR>
    		<TR> 
      		<TD COLSPAN="2">&nbsp;</TD>
    		</TR>
    		<TR> 
      		<TD WIDTH="55%" CLASS="contenido"> 
        	<P>Hoy en d&iacute;a la carrera de Ingenier&iacute;a en Computaci&oacute;n se ha transformado en una de las alternativas acad&eacute;micas de mayor demanda dentro del concierto nacional, situaci&oacute;n a la que no escapa la <A HREF="http://www.userena.cl" TARGET="_blank" TITLE="Visitar Web de Universidad de La Serena">Universidad de La Serena</A>, pues los 40 vacantes ofrecidos por nuestra Universidad se completan con las listas de seleccionados, cuyos puntajes sobrepasan los 617 puntos.</P>
          <P>Desde su creaci&oacute;n, a&ntilde;o 1995 hasta hoy, la carrera de Ingenier&iacute;a en Computaci&oacute;n esta siendo ofrecida por la <A HREF="http://fciencias.userena.cl" TARGET="_blank" TITLE="Visitar Web de Facultad de Ciencias">Facultad de Ciencias</A> de la <A HREF="http://www.userena.cl" TARGET="_blank" TITLE="Visitar Web de Universidad de La Serena">Universidad de La Serena</A>, coordinada por la Escuela de Ingenier&iacute;a en</P>
      		</TD>
      		<TD VALIGN="TOP" ALIGN="CENTER" WIDTH="45%"><IMG SRC="activos/logohistoria.jpg" WIDTH="180" HEIGHT="230"></TD>
    		</TR>
    		<TR> 
      		<TD COLSPAN="2" CLASS="contenido"> 
        	<P>Computaci&oacute;n y sustentada acad&eacute;micamente por el &Aacute;rea de Computaci&oacute;n de la <A HREF="http://fciencias.userena.cl" TARGET="_blank" TITLE="Visitar Web de Facultad de Ciencias">Facultad de Ciencias</A>.</P>
        	<P>Desde entonces el avance tecnol&oacute;gico en la computaci&oacute;n e inform&aacute;tica no ha cesado, m&aacute;s a&uacute;n nuestra sociedad est&aacute; siendo influenciada por un proceso de transformaci&oacute;n e incorporaci&oacute;n de nuevas tecnolog&iacute;as, a las cuales no podemos quedarnos atr&aacute;s, pues la actividad profesional que realizan nuestros egresados est&aacute;n insertas dentro de las &aacute;reas m&aacute;s complejas y de un alto grado de especializaci&oacute;n.</P>
      		</TD>
    		</TR>
  		</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="575" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="780" HEIGHT="55" COLSPAN="8" VALIGN="TOP" BGCOLOR="#6699CC">
      <?PHP
			/**
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