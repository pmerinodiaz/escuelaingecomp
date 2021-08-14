<?PHP
$nivel_directorio = "../../../";
$tipo_permiso = "academico";
include("../../../../librerias/seguridad.php");
?>
<HTML>
<HEAD>
<TITLE>INTR@NET Escuela Ingenier&iacute;a en Computaci&oacute;n - Acad&eacute;mico - Modificar T&iacute;tulo Profesional</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META NAME="author" CONTENT="Héctor Díaz Díaz - Patricio Merino Díaz">
<META NAME="copyright" CONTENT="2004 Escuela Ingeniería en Computación, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="None">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../../../../librerias/nivel4.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../../librerias/coolmenu.js"></SCRIPT>
<LINK REL="stylesheet" HREF="../../../../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../../../librerias/tabla.css" TYPE="text/css">
</HEAD>
<BODY BACKGROUND="../../../../librerias/bgintranet.gif" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<SCRIPT LANGUAGE="JavaScript" SRC="../../../../librerias/menuacademico.js"></SCRIPT>
<table border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="780" height="110" colspan="3" valign="top">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD WIDTH="85%" BGCOLOR="#6699CC">
						<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" WIDTH="350" HEIGHT="60">
							<PARAM NAME="movie" VALUE="../../../../librerias/logoic.swf">
							<PARAM NAME="quality" VALUE="high">
							<PARAM NAME="menu" VALUE="false">
							<EMBED SRC="../../../../librerias/logoic.swf" QUALITY="high" MENU="false" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer" TYPE="application/x-shockwave-flash" WIDTH="350" HEIGHT="60"></EMBED>
						</OBJECT>
					</TD>
          <TD ALIGN="CENTER" VALIGN="MIDDLE" BGCOLOR="#6699CC"><A HREF="../../../../librerias/cierresesion.php" TITLE="Cerrar Sesi&oacute;n"><IMG SRC="../../../../librerias/btcerrarsesion.gif" WIDTH="90" HEIGHT="16" BORDER="0"></A></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" BGCOLOR="#000000"><IMG SRC="../../../../librerias/intranet.gif" WIDTH="105" HEIGHT="20"></TD>
        </TR>
      </TABLE>
		</td>
  </tr>
  <tr> 
    <td width="91" height="413" valign="top"></td>
    <td width="617" HEIGHT="413" ROWSPAN="2" valign="top"> 
      <?PHP
			/*
			 * Script en donde se crea un objeto de título y se muestran los títulos profesionales
			 * que tiene la persona con la sesión abierta.
			*/
			
			// Librerías necesarias.
			include("../../../../librerias/conexion.php");
			include("../../../../librerias/titulo.php");
			
			// Creamos un objeto conexión y nos conectamos a la base de datos.
			$conexion = new conexion();
			$link = $conexion->conectar();
			
			// Abrimos la sesión, creamos un objeto titulo y mostramos los títulos de la persona.
			session_register("id_persona");
			$titulo = new titulo($link);
			$titulo->listar($id_persona, "modificar.php");
			$conexion->desconectar();
			?>
    </td>
    <td width="72" height="413" valign="top"></td>
  </tr>
  <tr> 
    <td width="91" height="20" ROWSPAN="2" valign="top"></td>
    <td width="72" height="20" ROWSPAN="2" valign="top"></td>
  </tr>
  <tr> 
    <td width="617" height="20" valign="top"></td>
  </tr>
  <tr> 
    <td width="780" height="55" colspan="3" valign="top" bgcolor="#6699CC"> 
      <?PHP
			/*
			 * Script en donde se muestran los e-mails de referencia a los directores y los derechos de
			 * copia del sitio Web.
			*/
			require("../../../../librerias/referencia.inc");
			?>
    </td>
  </tr>
  <tr> 
    <td width="91" height="1" valign="top"><img src="../../../../librerias/pxtransparente.gif" width="91" height="1"></td>
    <td width="617" height="1" valign="top"><img src="../../../../librerias/pxtransparente.gif" width="617" height="1"></td>
    <td width="72" height="1" valign="top"><img src="../../../../librerias/pxtransparente.gif" width="72" height="1"></td>
  </tr>
</table>
</BODY>
</HTML>