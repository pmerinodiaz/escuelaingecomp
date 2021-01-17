<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Foros</TITLE>
<META HTTP-EQUIV="content-type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META NAME="keywords" CONTENT="foros, discusiones, comentarios, conversar, conversaciones, temas, forums, preguntas, preguntar, dudas, dudar, cuestionarios, estudiantes, profesores, alumnos, acad�micos, inform�tica, computaci�n, ciencias, lenguajes, programaci�n, universidades, uls, serena, la serena, escuelas">
<META NAME="description" CONTENT="Para incentivar la integraci�n y colaboraci�n de la comunidad de estudiantil de nuestra Escuela, hemos creado los Foros de Discusi�n, en donde podr�s publicar tus inquietudes y comentarios sobre los diversos temas, e intercambiar tus experiencias e ideas con otros usuarios.">
<META NAME="author" CONTENT="H�ctor D�az D�az - Patricio Merino D�az">
<META NAME="copyright" CONTENT="2004 Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="All">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/nivel1.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/coolmenu.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/ventanita.js"></SCRIPT>
<LINK REL="stylesheet" HREF="../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/tema.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/tabla.css" TYPE="text/css">
</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/*
 * Script en donde incrementamos el n�mero de visitas del tema 'Foros'.
*/

// Librer�as necesarias.
include("../librerias/visitas.php");
include("../librerias/conexion.php");

// Creamos un objeto conexi�n y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();

// Creamos un objeto visitas e incrementamos las visitas de este tema.
$numero = new visitas($link);
$numero->incrementarTema(53);
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD WIDTH="350" HEIGHT="60" COLSPAN="3" ROWSPAN="2" VALIGN="TOP">
			<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH="350" HEIGHT="60">
    		<PARAM NAME="movie" VALUE="../librerias/logoic.swf">
    		<PARAM NAME="quality" VALUE="high">
    		<PARAM NAME="menu" VALUE="false">
    		<EMBED SRC="../librerias/logoic.swf" WIDTH="350" HEIGHT="60" QUALITY="high" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" TYPE="application/x-shockwave-flash" MENU="false">
    		</EMBED>
			</OBJECT></TD>
    <TD WIDTH="10" HEIGHT="60" ROWSPAN="2" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
    <TD WIDTH="20" HEIGHT="17" VALIGN="TOP"><IMG SRC="../librerias/curva.gif" WIDTH="20" HEIGHT="17"></TD>
    <TD WIDTH="240" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="6" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="17" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="420" HEIGHT="43" COLSPAN="4" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
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
			</TABLE></TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="60" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD WIDTH="76%" CLASS="ubicacion">Ubicaci&oacute;n: <A HREF="../home/index.php" TITLE="Ver Home">Home</A> / Foros</TD>
					<TD ROWSPAN="2" WIDTH="24%" VALIGN="TOP"><IMG SRC="activos/bgforos.jpg" WIDTH="110" HEIGHT="45"></TD>
				</TR>
				<TR> 
					<TD WIDTH="76%" CLASS="titulo">Foros</TD>
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
    <TD WIDTH="6" HEIGHT="480" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="480" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
        <TR> 
          <TD WIDTH="59%" CLASS="contenido"><STRONG>Participa, Comunica, Interact&uacute;a!!</STRONG>. Para incentivar la integraci&oacute;n y colaboraci&oacute;n de la comunidad de estudiantil de nuestra Escuela, hemos creado los Foros de Discusi&oacute;n, en donde podr&aacute;s publicar tus inquietudes y comentarios sobre los diversos temas, e intercambiar tus experiencias e ideas con otros usuarios.</TD>
          <TD WIDTH="41%" ALIGN="CENTER" VALIGN="TOP"><IMG SRC="activos/logoforos.jpg" WIDTH="168" HEIGHT="130"></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">
                        <?PHP
						/*
						 * Script en donde se listan todos los foros con sus respectivas cantidad de
						 * mensajes existentes para dicho foro.
						*/
						
						// Librer�as necesarias.
						include("../librerias/foro.php");
						
						// Creamos un objeto foro y mostramos el listado de foros.
						$foro = new foro($link);
						$foro->mostrar();
						$conexion->desconectar();
						?>
          </TD>
        </TR>
        <TR>
          <TD COLSPAN="2">&nbsp;</TD>
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
			 * copia del sitio Web.
			*/
			require("../librerias/referencia.inc");
			?>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="190" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="190" HEIGHT="1"></TD>
    <TD WIDTH="10" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="10" HEIGHT="1"></TD>
    <TD WIDTH="20" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="20" HEIGHT="1"></TD>
    <TD WIDTH="240" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="240" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
  </TR>
</TABLE>
</BODY>
</HTML>