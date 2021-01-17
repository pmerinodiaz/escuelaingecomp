<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Radio</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META NAME="keywords" CONTENT="radio, música, saludos, noticias, on-line, on, line, comunidades, estudiantes, profesores, académicos, alumnos, amigas, virtuales, voz, mensajería, mensajes, noticias, avisos, públicos, internet, meridiano72">
<META NAME="description" CONTENT="Desde aquí podrás escuchar la mejor música programada on-line por nuestra comunidad, enviar saludos, informarte de las principales noticias, publicar avisos económicos y muchas otras actividades.">
<META NAME="author" CONTENT="Héctor Díaz Díaz - Patricio Merino Díaz">
<META NAME="copyright" CONTENT="2004 Escuela Ingeniería en Computación, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="All">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/nivel1.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/coolmenu.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/ventanita.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
<!--
function setearFoco()
{
	escuchar.focus();
}
//-->
</SCRIPT>
<LINK REL="stylesheet" HREF="../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/tema.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/detalle.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/formulario.css" TYPE="text/css">
</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0" onLoad="setearFoco();">
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/*
 * Script en donde incremenatamos el número de visitas del tema 'Radio'.
*/

// Librerías necesarias.
include("../librerias/visitas.php");
include("../librerias/conexion.php");

// Creamos un objeto conexión y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();

// Creamos un objeto visitas e incrementamos las visitas de este tema.
$numero = new visitas($link);
$numero->incrementarTema(64);
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD WIDTH="350" HEIGHT="60" COLSPAN="4" ROWSPAN="2" VALIGN="TOP">
			<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH="350" HEIGHT="60">
    		<PARAM NAME="movie" VALUE="../librerias/logoic.swf">
    		<PARAM NAME="quality" VALUE="high">
    		<PARAM NAME="menu" VALUE="false">
    		<EMBED SRC="../librerias/logoic.swf" WIDTH="350" HEIGHT="60" QUALITY="high" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" TYPE="application/x-shockwave-flash" MENU="false">
    		</EMBED>
			</OBJECT>
		</TD>
    <TD WIDTH="10" HEIGHT="60" ROWSPAN="2" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
    <TD WIDTH="20" HEIGHT="17" VALIGN="TOP"><IMG SRC="../librerias/curva.gif" WIDTH="20" HEIGHT="17"></TD>
    <TD WIDTH="239" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="1" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="6" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="17" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="420" HEIGHT="43" COLSPAN="5" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="540" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD><IMG SRC="../librerias/infogeneral.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="181"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../librerias/infolocal.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="127"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../librerias/miscelaneos.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="5" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="1" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="60" COLSPAN="5" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD WIDTH="76%" CLASS="ubicacion">Ubicaci&oacute;n: <A HREF="../home/index.php" TITLE="Ver Home">Home</A> / Radio </TD>
					<TD ROWSPAN="2" WIDTH="24%" VALIGN="TOP"><IMG SRC="activos/bgradio.jpg" WIDTH="110" HEIGHT="45"></TD>
				</TR>
				<TR> 
					<TD WIDTH="76%" CLASS="titulo">Radio</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2"><IMG SRC="../librerias/pxgris.gif" WIDTH="460" HEIGHT="1"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="540" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD><IMG SRC="../librerias/pxblanco.gif" WIDTH="154" HEIGHT="1"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../librerias/herramientas.gif" WIDTH="154" HEIGHT="19"></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../librerias/bgbox.gif"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../librerias/bgbox.gif"> 
            <?PHP
						/*
						 * Script en donde se muestra las opciones de herramientas que tiene el sitio Web.
						*/
						$nivel = "../";
						require("../librerias/herramientas.inc");
						?>
          </TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../librerias/bgbox.gif"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../librerias/bgbox.gif"><IMG SRC="../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
				</TR>
			</TABLE>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="5" HEIGHT="480" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="480" COLSPAN="5" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR>
          <TD COLSPAN="2" CLASS="contenido"><TABLE WIDTH="100%"  BORDER="0" CELLPADDING="0" CELLSPACING="0">
            <TR>
              <TD WIDTH="67%" ROWSPAN="2" VALIGN="TOP" CLASS="contenido">
								<P><strong>Escucha radio on-line</strong></P>
                <P>Desde ahora puedes escuchar la mejor m&uacute;sica programada on-line por nuestra comunidad, env&iacute;a saludos, inf&oacute;rmate de las principales noticias, publica avisos econ&oacute;micos y muchas otras actividades.</P>
							</TD>
              <TD WIDTH="33%" ALIGN="RIGHT" VALIGN="TOP"><IMG SRC="activos/logoradio.jpg" WIDTH="245" HEIGHT="145"></TD>
            </TR>
            <TR>
              <TD ALIGN="RIGHT" VALIGN="TOP" CLASS="detalle"><A HREF="http://www.meridiano72.com" TARGET="_blank" TITLE="Visistar Web de Meridiano72">www.meridiano72.com</A></TD>
            </TR>
          </TABLE></TD>
        </TR>
        <TR>
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR>
          <TD COLSPAN="2" CLASS="contenido">Si no has escuchado radio on-line antes, te explicamos c&oacute;mo puedes conectarte y escuchar la radio, en solo 3 pasos:</TD>
        </TR>
        <TR>
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR>
          <TD WIDTH="14%" ALIGN="RIGHT"><IMG SRC="../librerias/ico1.gif" WIDTH="54" HEIGHT="32"></TD>
          <TD WIDTH="86%"><SPAN CLASS="contenido"><A HREF="http://www.real.com/R/RDX.arcade-dnld.R/software-dl.real.com/141e8376ef4e58346315/windows/mrkt/R30MXD/RealPlayer10-5GOLD_es.exe" TITLE="Descargar Real Player (11,01 MB)">Descarga Real Player</A>  o <A HREF="http://download.nullsoft.com/winamp/client/winamp505_full.exe" TITLE="Descargar Winamp (4,35 MB)">descarga Winamp</A> y guardalo en tu computador.</SPAN></TD>
        </TR>
        <TR>
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR>
          <TD ALIGN="RIGHT"><IMG SRC="../librerias/ico2.gif" WIDTH="54" HEIGHT="32"></TD>
          <TD CLASS="contenido">Ejecuta el instalador de Real Player o Winamp haciendo doble clic al archivo descargado y acepta la instalaci&oacute;n autom&aacute;tica.</TD>
        </TR>
        <TR>
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR>
          <TD ALIGN="RIGHT"><IMG SRC="../librerias/ico3.gif" WIDTH="54" HEIGHT="32"></TD>
          <TD CLASS="contenido"><SPAN CLASS="contenido">Solicita escuchar la radio Meridiano72 pulsando el bot&oacute;n "Escuchar radio Meridiano72 " y &iexcl;adelante!.</SPAN></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR>
          <TD COLSPAN="2" ALIGN="CENTER"><INPUT NAME="escuchar" TYPE="BUTTON" CLASS="formbutton" VALUE="Escuchar radio Meridiano72" TITLE="Escuchar radio Meridiano72" onClick='location.href="http://www.dominioweb.cl:8200/listen.pls"'></TD>
        </TR>
      </TABLE>
		</TD>
    <TD WIDTH="1" HEIGHT="480" VALIGN="TOP"></TD>
    <TD WIDTH="6" HEIGHT="480" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="780" HEIGHT="55" COLSPAN="10" VALIGN="TOP" BGCOLOR="#6699CC">
			<?PHP
			/*
			 * Script en donde se muestran los e-mails de referencia a los directores y los derechos de
			 * copia del sitio Web.
			*/
			require("../librerias/referencia.inc");
			?>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
    <TD WIDTH="5" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="5" HEIGHT="1"></TD>
    <TD WIDTH="1" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="1"></TD>
    <TD WIDTH="190" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="190" HEIGHT="1"></TD>
    <TD WIDTH="10" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="10" HEIGHT="1"></TD>
    <TD WIDTH="20" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="20" HEIGHT="1"></TD>
    <TD WIDTH="239" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="239" HEIGHT="1"></TD>
    <TD WIDTH="1" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
  </TR>
</TABLE>
</BODY>
</HTML>