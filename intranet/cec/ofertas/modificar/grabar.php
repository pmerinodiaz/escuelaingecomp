<?PHP
$nivel_directorio = "../../../";
$tipo_permiso = "cec";
include("../../../../librerias/seguridad.php");
?>
<HTML>
<HEAD>
<TITLE>INTR@NET Escuela Ingenier&iacute;a en Computaci&oacute;n - Integrante CEC - Modificar Oferta de Servicio</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META NAME="author" CONTENT="H�ctor D�az D�az - Patricio Merino D�az">
<META NAME="copyright" CONTENT="2004 Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="None">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../../../../librerias/nivel4.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../../librerias/coolmenu.js"></SCRIPT>
<LINK REL="stylesheet" HREF="../../../../librerias/base.css" TYPE="text/css">
</HEAD>
<BODY BACKGROUND="../../../../librerias/bgintranet.gif" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<SCRIPT LANGUAGE="JavaScript" SRC="../../../../librerias/menucec.js"></SCRIPT>
<?PHP
/*
 * Script en donde se verifica si los par�metros enviados en formulario son enviados o no.
*/

// Cuando los par�metros son v�lidos.
if (isset($HTTP_POST_VARS['titulo']) && isset($HTTP_POST_VARS['inicio']) && isset($HTTP_POST_VARS['termino']) && isset($HTTP_POST_VARS['tipo_servicio']) && isset($HTTP_POST_VARS['descripcion']) && isset($HTTP_POST_VARS['id_envio']) && is_string($HTTP_POST_VARS['titulo']) && is_string($HTTP_POST_VARS['inicio']) && is_string($HTTP_POST_VARS['termino']) && is_numeric($HTTP_POST_VARS['tipo_servicio']) && is_string($HTTP_POST_VARS['descripcion']) && is_numeric($HTTP_POST_VARS['id_envio']))
	$correcto = true;
// Cuando los par�metros no son v�lidos.
else $correcto = false;
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD WIDTH="780" HEIGHT="110" COLSPAN="3" VALIGN="TOP">
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
		</TD>
  </TR>
  <TR>
    <TD WIDTH="140" HEIGHT="413" VALIGN="TOP"></TD>
    <TD WIDTH="500" HEIGHT="413" VALIGN="TOP"> 
      <?PHP
			/*
			 * Script en donde se crea un objeto de oferta de servicio y se actualizan los datos
			 * de una oferta de servicios efectuada por una persona interna.
			*/
			
			// Cuando los par�metros son v�lidos.
			if ($correcto)
			{
				// Librer�as necesarias.
				include("../../../../librerias/conexion.php");
				include("../../../../librerias/ofertaservicio.php");
				
				// Creamos un objeto conexi�n y nos conectamos a la base de datos.
				$conexion = new conexion();
				$link = $conexion->conectar();
				
				// Abrimos la sesi�n, creamos un objeto servicio y actualizamos la oferta.
				session_register("id_persona");
				$servicio = new ofertaservicio($link);
				$servicio->modificar($id_persona, $HTTP_POST_VARS['titulo'], $HTTP_POST_VARS['inicio'], $HTTP_POST_VARS['termino'], $HTTP_POST_VARS['tipo_servicio'], $HTTP_POST_VARS['descripcion'], $HTTP_POST_VARS['id_envio']);
				$conexion->desconectar();
			}
			// Cuando los par�metros no son v�lidos.
			else
			{
				// Librer�as necesarias.
				include("../../../../librerias/error.php");
				
				// Creamos un objeto error y mostramos el titulo de error.
				$error = new error(2, "../../../../","index.php");
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
			// Script en donde se muestran los e-mails de referencia a los Directores
			// y los derechos de copia del sitio web.
			require("../../../../librerias/Referencia.inc");
			?>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="140" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../../librerias/pxtransparente.gif" WIDTH="140" HEIGHT="1"></TD>
    <TD WIDTH="500" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../../librerias/pxtransparente.gif" WIDTH="500" HEIGHT="1"></TD>
    <TD WIDTH="140" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../../librerias/pxtransparente.gif" WIDTH="140" HEIGHT="1"></TD>
  </TR>
</TABLE>
</BODY>
</HTML>