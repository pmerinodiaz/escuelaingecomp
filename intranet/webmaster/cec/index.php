<?PHP
$nivel_directorio = "../../";
$tipo_permiso = "webmaster";
include("../../../librerias/seguridad.php");
?>
<HTML>
<HEAD>
<TITLE>INTR@NET Escuela Ingenier&iacute;a en Computaci&oacute;n - Webmaster - CEC</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META NAME="author" CONTENT="Héctor Díaz Díaz - Patricio Merino Díaz">
<META NAME="copyright" CONTENT="2004 Escuela Ingeniería en Computación, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="None">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/nivel3.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/coolmenu.js"></SCRIPT>
<LINK REL="stylesheet" HREF="../../../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../../librerias/destacado.css" TYPE="text/css">
</HEAD>
<BODY BACKGROUND="../../../librerias/bgintranet.gif" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/menuwebmaster.js"></SCRIPT>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD WIDTH="780" HEIGHT="110" COLSPAN="3" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD WIDTH="85%" BGCOLOR="#6699CC">
						<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" WIDTH="350" HEIGHT="60">
							<PARAM NAME="movie" VALUE="../../../librerias/logoic.swf">
							<PARAM NAME="quality" VALUE="high">
							<PARAM NAME="menu" VALUE="false">
							<EMBED SRC="../../../librerias/logoic.swf" QUALITY="high" MENU="false" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer" TYPE="application/x-shockwave-flash" WIDTH="350" HEIGHT="60"></EMBED>
						</OBJECT>
					</TD>
          <TD ALIGN="CENTER" VALIGN="MIDDLE" BGCOLOR="#6699CC"><A HREF="../../../librerias/cierresesion.php" TITLE="Cerrar Sesi&oacute;n"><IMG SRC="../../../librerias/btcerrarsesion.gif" WIDTH="90" HEIGHT="16" BORDER="0"></A></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" BGCOLOR="#000000"><IMG SRC="../../../librerias/intranet.gif" WIDTH="105" HEIGHT="20"></TD>
        </TR>
      </TABLE>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="140" HEIGHT="413" VALIGN="TOP"></TD>
    <TD WIDTH="500" HEIGHT="413" VALIGN="TOP"><STRONG><SPAN CLASS="contenido">CEC</SPAN></STRONG> 
      <TABLE WIDTH="100%" BORDER="1" CELLPADDING="0" CELLSPACING="0" BORDERCOLOR="F1F1F1" BGCOLOR="#FFFFFF">
        <TR>
          <TD>
						<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
              <TR> 
                <TD>&nbsp;</TD>
              </TR>
              <TR> 
                <TD CLASS="destacado"><A HREF="agregar/index.php" TITLE="Ver Agregar CEC"><IMG SRC="../../../librerias/awceleste.gif" WIDTH="12" HEIGHT="7" BORDER="0">Agregar CEC</A></TD>
              </TR>
              <TR> 
                <TD CLASS="contenido">Desde esta opci&oacute;n podr&aacute;s agregar el registro de una nueva junta directiva del CEC de la carrera Ingenier&iacute;a en Computaci&oacute;n de la ULS. Ind&iacute;canos el a&ntilde;o, los integrantes, los cargos, otros y listo!!!.</TD>
              </TR>
              <TR> 
                <TD>&nbsp;</TD>
              </TR>
              <TR> 
                <TD CLASS="destacado"><A HREF="modificar/index.php" TITLE="Ver Modificar CEC"><IMG SRC="../../../librerias/awceleste.gif" WIDTH="12" HEIGHT="7" BORDER="0">Modificar CEC</A></TD>
              </TR>
              <TR> 
                <TD CLASS="contenido">En esta secci&oacute;n podr&aacute;s visualizar y cambiar los datos de las juntas directivas del CEC que registraste anteriormente en nuestro Web.</TD>
              </TR>
              <TR> 
                <TD>&nbsp;</TD>
              </TR>
              <TR> 
                <TD CLASS="destacado"><A HREF="eliminar/index.php" TITLE="Ver Eliminar CEC"><IMG SRC="../../../librerias/awceleste.gif" WIDTH="12" HEIGHT="7" BORDER="0">Eliminar CEC</A></TD>
              </TR>
              <TR> 
                <TD CLASS="contenido">En esta secci&oacute;n podr&aacute;s visualizar y borrar los datos de las juntas directivas del CEC que registraste anteriormente en nuestro Web.</TD>
              </TR>
              <TR> 
                <TD>&nbsp;</TD>
              </TR>
            </TABLE>
					</TD>
        </TR>
      </TABLE>
		</TD>
    <TD WIDTH="140" HEIGHT="413" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="140" HEIGHT="20" VALIGN="TOP"></TD>
    <TD WIDTH="500" HEIGHT="20" VALIGN="TOP"></TD>
    <TD WIDTH="140" HEIGHT="20" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="780" HEIGHT="55" COLSPAN="3" VALIGN="TOP" BGCOLOR="#6699CC">
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
    <TD WIDTH="140" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="140" HEIGHT="1"></TD>
    <TD WIDTH="500" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="500" HEIGHT="1"></TD>
    <TD WIDTH="140" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="140" HEIGHT="1"></TD>
  </TR>
</TABLE>
</BODY>
</HTML>