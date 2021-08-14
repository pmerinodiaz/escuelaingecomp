<?PHP
$nivel_directorio = "../../";
$tipo_permiso = "administrativo";
include("../../../librerias/seguridad.php");
?>
<HTML>
<HEAD>
<TITLE>INTR@NET Escuela Ingenier&iacute;a en Computaci&oacute;n - Administrativo - Antecedentes Administrativos</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META NAME="author" CONTENT="H�ctor D�az D�az - Patricio Merino D�az">
<META NAME="copyright" CONTENT="2004 Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="None">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/nivel3.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/coolmenu.js"></SCRIPT>
<LINK REL="stylesheet" HREF="../../../librerias/base.css" TYPE="text/css">
</HEAD>
<BODY BACKGROUND="../../../librerias/bgintranet.gif" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/menuadministrativo.js"></SCRIPT>
<?PHP
/*
 * Script en donde se verifica si los par�metros enviados en formulario fueron enviados o no.
*/

// Cuando se quiere cambiar la imagen.
if (isset($HTTP_POST_VARS['cambio']))
{
	// Cuando los par�metros son v�lidos.
	if (isset($HTTP_POST_VARS['cargo']) && isset($HTTP_POST_FILES['imagen']) && isset($HTTP_POST_VARS['fono']) && isset($HTTP_POST_VARS['fax']) && isset($HTTP_POST_VARS['horario']) && is_numeric($HTTP_POST_VARS['cargo']) && is_string($HTTP_POST_VARS['fono']) && is_string($HTTP_POST_VARS['fax']) && is_string($HTTP_POST_VARS['horario']))
		$correcto = true;
	// Cuando los par�metros no son v�lidos.
	else $correcto = false;
}
// Cuando no se quiere cambiar la imagen.
else
{
	// Cuando los par�metros son v�lidos.
	if (isset($HTTP_POST_VARS['cargo']) && isset($HTTP_POST_VARS['fono']) && isset($HTTP_POST_VARS['fax']) && isset($HTTP_POST_VARS['horario']) && is_numeric($HTTP_POST_VARS['cargo']) && is_string($HTTP_POST_VARS['fono']) && is_string($HTTP_POST_VARS['fax']) && is_string($HTTP_POST_VARS['horario']))
		$correcto = true;
	// Cuando los par�metros son v�lidos.
	else $correcto = false;
}
?>
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
    <TD WIDTH="500" HEIGHT="413" VALIGN="TOP"> 
      <?PHP
			/*
			 * Script en donde creamos un objeto administrativo o bien un objeto error. Luego
			 * modificamos los datos del administrativo o mostramos los mensajes de error.
			*/
			
			// Cuando los par�metros no son v�lidos.
			if ($correcto)
			{
				// Librer�as necesarias.
				include("../../../librerias/conexion.php");
				include("../../../librerias/administrativo.php");
				
				// Creamos un objeto conexi�n y nos conectamos a la base de datos.
				$conexion = new conexion();
				$link = $conexion->conectar();
				
				// Capturamos la variable de sesi�n, creamos un objeto administrativo y actualizamos
				// los datos.
				session_register("id_persona");
				$administrativo = new administrativo($link);
				
				// Cuando se quiere cambiar la imagen.
				if (isset($HTTP_POST_VARS['cambio']))
					$administrativo->actualizar($id_persona, $HTTP_POST_VARS['cargo'], $HTTP_POST_FILES['imagen'], $HTTP_POST_VARS['fono'], $HTTP_POST_VARS['fax'], $HTTP_POST_VARS['horario']);
				
				// Cuando no se quiere cambiar la imagen.
				else $administrativo->actualizar($id_persona, $HTTP_POST_VARS['cargo'], NULL, $HTTP_POST_VARS['fono'], $HTTP_POST_VARS['fax'], $HTTP_POST_VARS['horario']);
				
				// Nos desconectamos de la base de datos.
				$conexion->desconectar();
			}
			// Cuando los par�metros son v�lidos.
			else
			{
				// Librer�as necesarias.
				include("../../../librerias/error.php");
				
				// Creamos un objeto error y mostramos el t�tulo de error
				$error = new error(2, "../../../../", "index.php");
				$error->mostrar();
			}
			?>
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