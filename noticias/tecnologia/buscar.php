<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Noticias - Tecnolog&iacute;a - B&uacute;squeda</TITLE>
<META HTTP-EQUIV="content-type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META NAME="keywords" CONTENT="noticias, buscadores, b�squedas, motores, tecnolog�as, escuelas, ingenier�as, computaci�n, novedades, ciencias, universidades, la serena, uls, acontecimientos, �ltimas, recientes, aconteceres, noticiosos, ciencias, inform�tica">
<META NAME="description" CONTENT="P�gina donde se muestran las noticias resultantes de la b�squeda de noticias de tecnolog�a. Se muestran las noticias que coinciden en el t�tulo o la descripci�n con la palabra ingresada por el usuario.">
<META NAME="author" CONTENT="H�ctor D�az D�az - Patricio Merino D�az">
<META NAME="copyright" CONTENT="2004 Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="None">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/nivel2.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/coolmenu.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/ventanita.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/valida.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
<!--
function validarFormulario()
{
	if(validarCampo(document.formulario.palabra,isAny,false))
  	return true;
	else return false;
}
//-->
</SCRIPT>
<LINK REL="stylesheet" HREF="../../librerias/base.css" TYPE="TEXT/CSS">
<LINK REL="stylesheet" HREF="../../librerias/tema.css" TYPE="TEXT/CSS">
<LINK REL="stylesheet" HREF="../../librerias/detalle.css" TYPE="TEXT/CSS">
<LINK REL="stylesheet" HREF="../../librerias/formulario.css" TYPE="text/css">
</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/*
 * Script en donde verificamos que vengan todos los par�metros en la URL.
*/

// Cuando los par�metros son v�lidos.
if (isset($_GET['pagina']) && isset($_GET['palabra']) && $_GET['pagina'] != NULL && $_GET['palabra'] != NULL && is_numeric($_GET['pagina']) && is_string($_GET['palabra']))
	$correcto = true;
// Cuando los par�metros no son v�lidos.
else $correcto = false;
?>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="350" height="60" colspan="3" rowspan="2" valign="top">
			<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH="350" HEIGHT="60">
				<PARAM NAME="movie" VALUE="../../librerias/logoic.swf">
				<PARAM NAME="quality" VALUE="high">
				<PARAM NAME="menu" VALUE="false">
				<EMBED SRC="../../librerias/logoic.swf" WIDTH="350" HEIGHT="60" QUALITY="high" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" TYPE="application/x-shockwave-flash" MENU="false">
				</EMBED>
			</OBJECT>
		</td>
    <td width="10" height="60" rowspan="2" valign="top" bgcolor="#6699CC">&nbsp;</td>
    <td width="20" height="17" valign="top"><IMG SRC="../../librerias/curva.gif" WIDTH="20" HEIGHT="17"></td>
    <td width="240" height="17" valign="top"></td>
    <td width="6" height="17" valign="top"></td>
    <td width="154" height="17" valign="top"></td>
  </tr>
  <tr>
    <td width="420" height="43" colspan="4" valign="top" bgcolor="#6699CC">&nbsp;</td>
  </tr>
  <tr>
    <td width="154" height="540" rowspan="2" valign="top" background="../../librerias/bgmenu.gif">
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
		</td>
    <td width="6" height="60" valign="top"></td>
    <td width="460" height="60" colspan="4" valign="top"> 
            <?PHP
			/*
			 * Script en donde creamos el objeto noticia o bien el objeto error.
			*/
			
			// Cuando los par�metros son v�lidos.
			if ($correcto)
			{
				// Librer�as necesarias.
				include("../../librerias/conexion.php");
				include("../../librerias/noticia.php");
				
				// Creamos un objeto conexi�n y nos conectamos a la base de datos.
				$conexion = new conexion();
				$link = $conexion->conectar();
				
				// Creamos un objeto noticia y mostramos el t�tulo de esta secci�n.
				$noticia = new noticia($link);
				$noticia->tituloBusqueda(2);
			}
			// Cuando los par�metros no son v�lidos.
			else
			{
				// Librer�as necesarias.
				include("../../librerias/error.php");
				
				// Creamos un objeto error y mostramos el titulo de error.
				$error = new error(1, "../../", "index.php?pagina=1");
				$error->mostrarTitulo();
			}
			?>
    </td>
    <td width="6" height="60" valign="top"></td>
    <td width="154" height="540" rowspan="2" valign="top" background="../../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD><IMG SRC="../../librerias/temasrelacionados.gif" WIDTH="154" HEIGHT="19"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../tecnologia/index.php?pagina=1" TITLE="Ver Noticias de la Universidad"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Universidad</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Tecnolog&iacute;a</TD>
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
          <TD><IMG SRC="../../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
        </TR>
      </TABLE>
		</td>
  </tr>
  <tr>
    <td width="6" height="480" valign="top"></td>
    <td width="460" height="480" colspan="4" valign="top">
  		<table width="460" border="0" cellpadding="0" cellspacing="0" mm_noconvert="TRUE">
        <tr> 
          <td> 
                        <?PHP
						/*
						 * Script que muestra el listado de noticias de tecnolog�a (en forma paginada)
						 * encontradas por el buscador de noticias.
						*/
						
						// Cuando los par�metros son v�lidos.
						if ($correcto)
						{
							$noticia->buscar(2, $_GET['palabra'], $_GET['pagina']);
							$conexion->desconectar();
						}
						// Cuando los par�metros no son v�lidos.
						else $error->mostrar();
						?>
          </td>
        </tr>
      </table>
		</td>
    <td width="6" height="480" valign="top"></td>
  </tr>
  <tr>
    <td width="780" height="55" colspan="8" valign="top" bgcolor="#6699CC">
            <?PHP
			/*
			 * Script en donde se muestran los e-mails de referencia a los directores y los derechos de
			 * copia del sitio Web.
			*/
			require("../../librerias/referencia.inc");
			?>
    </td>
  </tr>
  <tr>
    <td width="154" height="1" valign="top"><img src="../../librerias/pxtransparente.gif" width="154" height="1"></td>
    <td width="6" height="1" valign="top"><img src="../../librerias/pxtransparente.gif" width="6" height="1"></td>
    <td width="190" height="1" valign="top"><img src="../../librerias/pxtransparente.gif" width="190" height="1"></td>
    <td width="10" height="1" valign="top"><img src="../../librerias/pxtransparente.gif" width="10" height="1"></td>
    <td width="20" height="1" valign="top"><img src="../../librerias/pxtransparente.gif" width="20" height="1"></td>
    <td width="240" height="1" valign="top"><img src="../../librerias/pxtransparente.gif" width="240" height="1"></td>
    <td width="6" height="1" valign="top"><img src="../../librerias/pxtransparente.gif" width="6" height="1"></td>
    <td width="154" height="1" valign="top"><img src="../../librerias/pxtransparente.gif" width="154" height="1"></td>
  </tr>
</table>
</BODY>
</HTML>