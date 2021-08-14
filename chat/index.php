<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Chat</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META NAME="keywords" CONTENT="video, chat, 3d, videochat, webchat, chatear, chateando, conversaciones, conversar, on-line, on, line, gentes, amigos, comunidades, estudiantes, profesores, acadéemicos, alumnos, amigas, virtuales, voz, webcam, mensajería privada, pizarra interactiva, música">
<META NAME="description" CONTENT="Desde aquí podrás participar, conocer y chatear con gente como tú... aquí encontrarás amigos y más. Comparte tus conocimientos de computación, programación, matemáticas, ingeniería y más, con gente como tú en todo el mundo.">
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
	entrar.focus();
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
 * Script en donde incremenatamos el número de visitas del tema 'Chat'.
*/

// Librerías necesarias.
include("../librerias/visitas.php");
include("../librerias/conexion.php");

// Creamos un objeto conexión y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();

// Creamos un objeto visitas e incrementamos las visitas de este tema.
$numero = new visitas($link);
$numero->incrementarTema(55);
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
					<TD WIDTH="76%" CLASS="ubicacion">Ubicaci&oacute;n: <A HREF="../home/index.php" TITLE="Ver Home">Home</A> / Chat</TD>
					<TD ROWSPAN="2" WIDTH="24%" VALIGN="TOP"><IMG SRC="activos/bgchat.jpg" WIDTH="110" HEIGHT="45"></TD>
				</TR>
				<TR> 
					<TD WIDTH="76%" CLASS="titulo">Chat</TD>
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
          <TD COLSPAN="2" CLASS="contenido"><P> <STRONG>Bienvenido a la primera macro comunidad 3D multiusuarios con Video Chat</STRONG>, totalmente interactiva y en tiempo real, dise&ntilde;ada con lo &uacute;ltimo en tecnolog&iacute;a para el desarrollo de ambientes 3D para Internet.</P></TD>
        </TR>
        <TR>
          <TD COLSPAN="2" CLASS="contenido"><TABLE WIDTH="100%"  BORDER="0" CELLPADDING="0" CELLSPACING="0">
            <TR>
              <TD WIDTH="31%" ROWSPAN="2" CLASS="contenido">Un gran ambiente tridimensional dentro del cual encontrar&aacute;s m&aacute;s de 14 espacios virtuales y descubrir&aacute;s maravillosos lugares para explorar realizando m&uacute;ltiples actividades en compa&ntilde;&iacute;a de otros visitantes.</TD>
              <TD WIDTH="69%" ALIGN="RIGHT" VALIGN="TOP"><IMG SRC="activos/logochat.jpg" WIDTH="316" HEIGHT="142"></TD>
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
          <TD COLSPAN="2" CLASS="contenido"> <P>Si no has chateado antes, te explicamos c&oacute;mo puedes conectarte y hablar con otras personas, en solo 3 pasos:</P>
          </TD>
        </TR>
        <TR>
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR>
          <TD WIDTH="14%" ALIGN="RIGHT"><IMG SRC="../librerias/ico1.gif" WIDTH="54" HEIGHT="32"></TD>
          <TD WIDTH="86%" CLASS="contenido"><A HREF="http://www.meridiano72.com/plugins/Plugin_Meridiano72.exe" TITLE="Descargar Plugin Meridiano72 (2,09 MB)">Descarga el Plugin Meridiano72</A> y guardalo en tu computador.</TD>
        </TR>
        <TR>
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR>
          <TD ALIGN="RIGHT"><IMG SRC="../librerias/ico2.gif" WIDTH="54" HEIGHT="32"></TD>
          <TD CLASS="contenido"><P>Ejecuta el Plugin haciendo doble clic al archivo descargado (Plugin_Meridiano72.exe) y acepta la instalaci&oacute;n autom&aacute;tica.</P>
          </TD>
        </TR>
        <TR>
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR>
          <TD ALIGN="RIGHT"><IMG SRC="../librerias/ico3.gif" WIDTH="54" HEIGHT="32"></TD>
          <TD CLASS="contenido">Solicita entrar a Meridiano72 pulsando el bot&oacute;n ENTRAR A MERIDIANO72 y &iexcl;adelante!.</TD>
        </TR>
        <TR>
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR>
          <TD COLSPAN="2" ALIGN="CENTER"><INPUT NAME="entrar" TYPE="BUTTON" CLASS="formbutton" VALUE="Entrar a Meridiano72" TITLE="Entrar a Meridiano72" onClick='location.href="scol://www.meridiano72.com:Meridiano72"'></TD>
        </TR>
        <TR>
          <TD COLSPAN="2">&nbsp;</TD>
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