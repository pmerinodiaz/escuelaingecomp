<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Home</TITLE>
<META HTTP-EQUIV="content-type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META NAME="keywords" CONTENT="escuela ingenier�a en computaci�n, universidad de la serena, chile, uls, departamentos de matem�ticas, inform�tica, licenciaturas, profesionales, universitarios, profesores, cient�ficos, ense�anza superior, noticias, investigaci�n, nuevas tecnolog�as, sistemas computacionales, ofertas de trabajo, solicitudes de trabajo, tutoriales, software, programas, cursos, asignaturas, ramos, webmail, intranet, chat, empleos, pr�cticas profesionales, servicios">
<META NAME="description" CONTENT="Sitio Web de la Escuela Ingenier�a en Computaci�n de la ULS, donde encontrar�s toda la informaci�n de nuestra prestigiosa instituci�n, profesores, alumnos y mucho m�s...">
<META NAME="author" CONTENT="H�ctor D�az D�az - Patricio Merino D�az">
<META NAME="copyright" CONTENT="2004 Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="All">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/nivel1.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/coolmenu.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/rollower.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/fecha.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/valida.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
<!--
function validarBuscador()
{
	if(validarCampo(document.buscador.palabra,isAny,false))
  	return true;
	return false;
}
function validarEncuesta()
{
  for(i=0;i<document.encuesta.opcion.length;i++)
	 	if(document.encuesta.opcion[i].checked)
		{
			seleccion=true;
			return true;
		}
	alert("Error: Ingresa tu opci&oacute;n.");
	return false;
}
//-->
</SCRIPT>
<LINK REL="stylesheet" HREF="../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/detalle.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/destacado.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/formulario.css" TYPE="text/css">
</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0" onLoad="MM_preloadImages('activos/noticiasover.gif','activos/busquedaover.gif','activos/sitiosover.gif','activos/encuestasover.gif')">
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/**
 * Script en donde se realiza la conecci�n a la base de datos de la aplicaci�n. Se realiza
 * una sola vez y al comienzo de la p�gina. Esto debido a que en scripts psoteriores la
 * conexi�n es usada varias veces.
*/

// Librer�as necesarias.
include("../librerias/conexion.php");

// Creamos un objeto conexi�n y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR> 
    <TD WIDTH="350" HEIGHT="60" COLSPAN="4" ROWSPAN="2" VALIGN="TOP">
			<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH="350" HEIGHT="60">
        <PARAM NAME="movie" VALUE="../librerias/logoic.swf">
        <PARAM NAME="quality" VALUE="high">
        <PARAM NAME="menu" VALUE="false">
        <EMBED SRC="../librerias/logoic.swf" QUALITY="high" MENU="false" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" TYPE="application/x-shockwave-flash" WIDTH="350" HEIGHT="60">
				</EMBED> 
      </OBJECT></TD>
    <TD WIDTH="10" HEIGHT="60" ROWSPAN="2" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
    <TD WIDTH="20" HEIGHT="17" VALIGN="TOP"><IMG SRC="../librerias/curva.gif" WIDTH="20" HEIGHT="17"></TD>
    <TD WIDTH="230" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="16" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="17" VALIGN="TOP"></TD>
  </TR>
  <TR> 
    <TD WIDTH="420" HEIGHT="43" COLSPAN="4" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
  </TR>
  <TR> 
    <TD WIDTH="154" HEIGHT="560" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../librerias/bgmenu.gif"> 
      <TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0" MM_NOCONVERT="TRUE">
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
    <TD WIDTH="1" HEIGHT="175" VALIGN="TOP"></TD>
    <TD WIDTH="455" HEIGHT="175" COLSPAN="5" VALIGN="TOP"> 
      <TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%" MM_NOCONVERT="TRUE">
        <TR> 
          <TD><IMG SRC="../librerias/pxtransparente.gif" WIDTH="280" HEIGHT="1"></TD>
          <TD><IMG SRC="../librerias/pxtransparente.gif" WIDTH="120" HEIGHT="1"></TD>
          <TD><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="1"></TD>
        </TR>
        <TR> 
          <TD ROWSPAN="3" VALIGN="top"><IMG SRC="activos/uls1.jpg" WIDTH="280" HEIGHT="160"></TD>
          <TD VALIGN="top"><IMG SRC="activos/uls2.jpg" WIDTH="120" HEIGHT="65"></TD>
          <TD><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="65"></TD>
        </TR>
        <TR> 
          <TD ROWSPAN="2" VALIGN="top" CLASS="detalle">La <A HREF="http://www.userena.cl" TARGET="_blank" TITLE="Visitar Web de Universidad de La Serena">Universidad de La Serena</A> es una prestigiosa universidad con m&aacute;s de cien a&ntilde;os de experiencia acad&eacute;mica de alto nivel y basada en los desaf&iacute;os cient&iacute;ficos y tecnol&oacute;gicos y culturales de Chile y el mundo.</TD>
        </TR>
      </TABLE>
		</TD>
    <TD WIDTH="16" HEIGHT="175" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="560" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../librerias/bgmenu.gif"> 
      <TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD><IMG SRC="../librerias/pxblanco.gif" WIDTH="154" HEIGHT="1"></TD>
        </TR>
        <TR> 
          <TD><IMG SRC="../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
        </TR>
        <TR> 
          <TD><A HREF="../noticias/index.php" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('RollowerNoticias','','activos/noticiasover.gif',1);" TITLE="Ver Noticias"><IMG SRC="activos/noticiasup.gif" NAME="RollowerNoticias" WIDTH="154" HEIGHT="17" BORDER="0"></A></TD>
        </TR>
        <TR> 
          <TD STYLE="padding-left: 1px;">
            <?PHP
						/**
						 * Script en donde se muestran las �ltimas cinco noticias m�s recientes de la Universidad de
						 * La Serena.
						*/
						
						// Librer�as necesarias.
						include("../librerias/noticia.php");
						
						// Creamos un objeto noticia y mostramos las noticias destacadas.
						$noticia = new noticia($link);
						$noticia->mostrarDestacadas();
						?>
          </TD>
        </TR>
				<TR> 
          <TD><A HREF="../busqueda/index.php" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('RollowerBusqueda','','activos/busquedaover.gif',1);" TITLE="Ver B�squeda"><IMG SRC="activos/busquedaup.gif" NAME="RollowerBusqueda" WIDTH="154" HEIGHT="17" BORDER="0"></A></TD>
        </TR>
        <TR> 
          <TD><IMG SRC="../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
        </TR>
        <TR> 
          <TD>
						<FORM NAME="buscador" METHOD="GET" ACTION="../busqueda/web/search.php" onSubmit="return validarBuscador();">
              <TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
                <TR> 
                  <TD>&nbsp;</TD>
                </TR>
                <TR> 
                  <TD ALIGN="CENTER"><INPUT TYPE="text" NAME="palabra" CLASS="formtextfield" TABINDEX="1" TITLE="Una palabra o frase de este Web"></TD>
                </TR>
                <TR> 
                  <TD ALIGN="CENTER"><INPUT TYPE="submit" NAME="buscar" VALUE="Buscar" CLASS="formbutton" TABINDEX="1" TITLE="Buscar una palabra o frase de este Web"></TD>
                </TR>
              </TABLE>
            </FORM>
					</TD>
        </TR>
				<TR> 
          <TD><IMG SRC="../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
        </TR>
        <TR> 
          <TD><A HREF="../sitios/index.php?pagina=1" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('RollowerSitios','','activos/sitiosover.gif',1);" TITLE="Ver Sitios de Inter�s"><IMG SRC="activos/sitiosup.gif" NAME="RollowerSitios" WIDTH="154" HEIGHT="17" BORDER="0"></A></TD>
        </TR>
        <TR>
          <TD><IMG SRC="../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
        </TR>
        <TR> 
          <TD> 
            <?PHP
						/**
						 * Script en donde se muestran los tres enlaces (sitios de inter�s) del sitio
						 * Web m�s visitados.
						*/
						
						// Librer�as necesarias.
						include("../librerias/sitiointeres.php");
						
						// Creamos un objeto sitio y mostramos los sitios de inter�s m�s visitados.
						$sitio = new sitiointeres($link);
						$sitio->mostrarDestacados();
						?>
          </TD>
        </TR>
        <TR> 
          <TD><IMG SRC="../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
        </TR>
        <TR> 
          <TD><A HREF="../encuestas/index.php?pagina=1" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('RollowerEncuestas','','activos/encuestasover.gif',1);" TITLE="Ver Encuestas"><IMG SRC="activos/encuestasup.gif" NAME="RollowerEncuestas" WIDTH="154" HEIGHT="17" BORDER="0"></A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../librerias/bgbox.gif"><IMG SRC="../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../librerias/bgbox.gif"> 
            <?PHP
						/**
						 * Script en donde se muestra la encuesta del mes actual.
						*/
						
						// Librer�as necesarias.
						include("../librerias/encuesta.php");
						
						// Creamos un objeto encuesta y mostramos la encuesta del mes actual.
						$encuesta = new encuesta($link);
						$encuesta->mostrarActual();
						?>
          </TD>
        </TR>
        <TR> 
          <TD><IMG SRC="../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
        </TR>
      </TABLE>
		</TD>
  </TR>
  <TR> 
    <TD WIDTH="1" HEIGHT="365" VALIGN="TOP"></TD>
    <TD WIDTH="10" HEIGHT="365" VALIGN="TOP"></TD>
    <TD WIDTH="445" HEIGHT="365" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD CLASS="detalle">
						<SCRIPT LANGUAGE="JavaScript">
						<!--
						document.write(obtenerFecha());
						//-->
						</SCRIPT>
					</TD>
        </TR>
        <TR> 
          <TD WIDTH="100%"><IMG SRC="activos/boxcelesteizq.gif" WIDTH="10" HEIGHT="20"><IMG SRC="activos/destacados.gif" WIDTH="71" HEIGHT="20"><IMG SRC="../librerias/pxceleste.gif" WIDTH="354" HEIGHT="20"><IMG SRC="activos/boxcelesteder.gif" WIDTH="10" HEIGHT="20"></TD>
        </TR>
        <TR> 
          <TD>&nbsp;</TD>
        </TR>
        <TR> 
          <TD> 
            <?PHP
						/**
						 * Script en donde se muestran los cinco temas del sitio Web m�s visitados.
						*/
						
						// Librer�as necesarias.
						include("../librerias/tema.php");
						
						// Creamos un objeto tema y mostramos los temas m�s visitados.
						$tema = new tema($link);
						$tema->mostrarDestacados();
						
						// Desconectamos la base de datos.
						$conexion->desconectar();
						?>
          </TD>
        </TR>
        <TR>
          <TD>&nbsp;</TD>
        </TR>
      </TABLE>
		</TD>
    <TD WIDTH="16" HEIGHT="365" VALIGN="TOP"></TD>
  </TR>
  <TR> 
    <TD WIDTH="780" HEIGHT="55" COLSPAN="9" VALIGN="TOP" BGCOLOR="#6699CC"> 
      <?PHP
			/**
			 * Script en donde se muestran los e-mails de referencia a los directores y los derechos de
			 * copia del sitio web.
			*/
			require("../librerias/referencia.inc");
			?>
    </TD>
  </TR>
  <TR> 
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
    <TD WIDTH="1" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="1"></TD>
    <TD WIDTH="10" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="10" HEIGHT="1"></TD>
    <TD WIDTH="185" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="185" HEIGHT="1"></TD>
    <TD WIDTH="10" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="10" HEIGHT="1"></TD>
    <TD WIDTH="20" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="20" HEIGHT="1"></TD>
    <TD WIDTH="230" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="230" HEIGHT="1"></TD>
    <TD WIDTH="16" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="16" HEIGHT="1"></TD>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
  </TR>
</TABLE>
</BODY>
</HTML>
