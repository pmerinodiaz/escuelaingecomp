<?PHP
session_start();
$_SESSION["nivel_directorio"] = "../../../";
$_SESSION["tipo_permiso"] = "alumno";
include("../../../../librerias/seguridad.php");
?>
<HTML>
<HEAD>
<TITLE>INTR@NET Escuela Ingenier&iacute;a en Computaci&oacute;n - Alumno - Modificar Prueba</TITLE>
<META HTTP-EQUIV="content-type" content="text/html; charset=utf-8">
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
<SCRIPT LANGUAGE="JavaScript" SRC="../../../../librerias/menualumno.js"></SCRIPT>
<?PHP
/*
 * Script en donde se verifica si los par�metros enviados en formulario son enviados o no.
*/

// Cuando los par�metros son v�lidos.
if (isset($_POST['asignatura']) && isset($_POST['numero']) && isset($_POST['anio']) && isset($_POST['formato']) && isset($_POST['semestre']) && isset($_POST['tipo_prueba']) && isset($_POST['archivo_internet']) && isset($_POST['id_prueba']) && is_numeric($_POST['asignatura']) && is_numeric($_POST['numero']) && is_numeric($_POST['anio']) && is_numeric($_POST['formato']) && is_numeric($_POST['semestre']) && is_numeric($_POST['tipo_prueba']) && is_numeric($_POST['archivo_internet']) && is_numeric($_POST['id_prueba']))
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
			 * Script en donde se crea un objeto de prueba y se graba la prueba en la tabla.
			*/
			
			// Cuando los par�metros son v�lidos.
			if ($correcto)
			{
				// Librer�as necesarias.
				include("../../../../librerias/conexion.php");
				include("../../../../librerias/prueba.php");
				
				// Creamos un objeto conexi�n y nos conectamos a la base de datos.
				$conexion = new conexion();
				$link = $conexion->conectar();
				
				// Abrimos la sesi�n, creamos un objeto prueba y agregamos el prueba.
				$prueba = new prueba($link);
				
				// Cuando el archivo ya est� en Internet.
				if ($_POST['archivo_internet'] == 1)
					$prueba->modificar($_SESSION["id_persona"], $_POST['id_prueba'], $_POST['asignatura'], $_POST['formato'], $_POST['semestre'], $_POST['tipo_prueba'], $_POST['numero'], $_POST['anio'], true, $_POST['url_archivo']);
				
				// Cuando el archivo no est� en Internet.
				else $prueba->modificar($_SESSION["id_persona"], $_POST['id_prueba'], $_POST['asignatura'], $_POST['formato'], $_POST['semestre'], $_POST['tipo_prueba'], $_POST['numero'], $_POST['anio'], false, $HTTP_POST_FILES['src_archivo']);
				
				// Nos desconectamos de la base de datos.
				$conexion->desconectar();
			}
			// Cuando los par�metros no son v�lidos.
			else
			{
				// Librer�as necesarias.
				include("../../../../librerias/error.php");
				
				// Creamos un objeto error y mostramos el t�tulo de error.
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
			/*
			 * Script en donde se muestran los e-mails de referencia a los directores y los derechos de
			 * copia del sitio Web.
			*/
			require("../../../../librerias/referencia.inc");
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