<?PHP
$nivel_directorio = "../../";
$tipo_permiso = "administrativo";
include("../../../librerias/seguridad.php");
?>
<HTML>
<HEAD>
<TITLE>INTR@NET Escuela Ingenier&iacute;a en Computaci&oacute;n - Administrativo - Antecedentes Personales</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META NAME="author" CONTENT="Héctor Díaz Díaz - Patricio Merino Díaz">
<META NAME="copyright" CONTENT="2004 Escuela Ingeniería en Computación, Universidad de La Serena, Chile">
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
 * Script en donde se verifica la correctitud de los parámetros.
*/

// Cuando los parámetros son válidos.
if (isset($HTTP_POST_VARS['nombres']) && isset($HTTP_POST_VARS['paterno']) && isset($HTTP_POST_VARS['materno']) && isset($HTTP_POST_VARS['email']) && isset($HTTP_POST_VARS['web']) && isset($HTTP_POST_VARS['nueva_clave1']) && isset($HTTP_POST_VARS['nueva_clave2']) && isset($HTTP_POST_VARS['pregunta_secreta']) && isset($HTTP_POST_VARS['respuesta_secreta']) && is_string($HTTP_POST_VARS['nombres']) && is_string($HTTP_POST_VARS['paterno']) && is_string($HTTP_POST_VARS['materno']) && is_string($HTTP_POST_VARS['email']) && is_string($HTTP_POST_VARS['web']) && is_string($HTTP_POST_VARS['nueva_clave1']) && is_string($HTTP_POST_VARS['nueva_clave2']) && is_numeric($HTTP_POST_VARS['pregunta_secreta']) && is_string($HTTP_POST_VARS['respuesta_secreta']))
	$correcto = true;
// Cuando los parámetros no son válidos.
else $correcto = false;
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
			 * Script en donde creamos un objeto usuario interno o bien un error.
			*/
			
			// Cuando los parámetros son válidos.
			if ($correcto)
			{
				// Librerías necesarias.
				include("../../../librerias/conexion.php");
				include("../../../librerias/usuariointerno.php");
				
				// Creamos un objeto conexión y nos conectamos a la base de datos.
				$conexion = new conexion();
				$link = $conexion->conectar();
				
				// Capturamos la variable de sesión, creamos un objeto usuario interno y
				// actualizamos los datos.
				session_register("id_persona");
				$usuario_interno = new usuariointerno($link);
				$usuario_interno->actualizarAntecedentes($id_persona, $HTTP_POST_VARS['nombres'], $HTTP_POST_VARS['paterno'], $HTTP_POST_VARS['materno'], $HTTP_POST_VARS['email'], $HTTP_POST_VARS['web'], $HTTP_POST_VARS['nueva_clave1'], $HTTP_POST_VARS['pregunta_secreta'], $HTTP_POST_VARS['respuesta_secreta']);
				$conexion->desconectar();
			}
			// Cuando los parámetros no son válidos.
			else
			{
				// Librerías necesarias.
				include("../../../librerias/error.php");
				
				// Creamos un objeto error y mostramos el título de error.
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