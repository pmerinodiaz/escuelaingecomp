<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Integrantes - Acad&eacute;micos - Media Jornada - Curriculum</TITLE>
<META HTTP-EQUIV="content-type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META NAME="keywords" CONTENT="acad�micos, profesores, estudiosos, profesorado, investigadores, colegiados, expertos, jornadas, medias, alumnos, ex-alumnos, administrativos, ayudantes, integrantes, curriculum, vitae">
<META NAME="description" CONTENT="P�gina en donde se muestra el curriculum de un acad�mico media jornada de la Escuela Ingenier�a en Computaci�n. Se muestra su nombre, grado acad�mico, t�tulo profesional, email, sitio web, asignaturas dictadas y publicaciones.">
<META NAME="author" CONTENT="H�ctor D�az D�az - Patricio Merino D�az">
<META NAME="copyright" CONTENT="2004 Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="None">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/nivel3.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/coolmenu.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/ventanita.js"></SCRIPT>
<LINK REL="stylesheet" HREF="../../../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../../librerias/tema.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../../librerias/tabla.css" TYPE="text/css">
</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/*
 * Script en donde verificamos que vengan todos los par�metros en la URL.
*/

// Cuando los par�metros son v�lidos.
if (isset($_GET['id']) && $_GET['id'] != NULL && is_numeric($_GET['id']))
	$correcto = true;
// Cuando los par�metros no son v�lidos.
else $correcto = false;
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD WIDTH="350" HEIGHT="60" COLSPAN="3" ROWSPAN="2" VALIGN="TOP">
			<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH="350" HEIGHT="60">
    		<PARAM NAME="movie" VALUE="../../../librerias/logoic.swf">
    		<PARAM NAME="quality" VALUE="high">
    		<PARAM NAME="menu" VALUE="false">
    		<EMBED SRC="../../../librerias/logoic.swf" WIDTH="350" HEIGHT="60" QUALITY="high" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" TYPE="application/x-shockwave-flash" MENU="false">
    		</EMBED>
			</OBJECT>
		</TD>
    <TD WIDTH="10" HEIGHT="60" ROWSPAN="2" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
    <TD WIDTH="20" HEIGHT="17" VALIGN="TOP"><IMG SRC="../../../librerias/curva.gif" WIDTH="20" HEIGHT="17"></TD>
    <TD WIDTH="240" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="6" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="17" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="420" HEIGHT="43" COLSPAN="4" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="540" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../../../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
  			<TR> 
  				<TD><IMG SRC="../../../librerias/infogeneral.gif" WIDTH="154" HEIGHT="17"></TD>
  			</TR>
    		<TR> 
      		<TD><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="181"></TD>
    		</TR>
    		<TR> 
      		<TD><IMG SRC="../../../librerias/infolocal.gif" WIDTH="154" HEIGHT="17"></TD>
    		</TR>
    		<TR> 
      		<TD><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="127"></TD>
    		</TR>
    		<TR> 
      		<TD><IMG SRC="../../../librerias/miscelaneos.gif" WIDTH="154" HEIGHT="17"></TD>
    		</TR>
  		</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="60" COLSPAN="4" VALIGN="TOP"> 
            <?PHP
			/*
			 * Script en donde creamos el objeto curriculum o bien el objeto error.
			*/
			
			if ($correcto)
			{
				// Librer�as necesarias.
				include("../../../librerias/conexion.php");
				include("../../../librerias/curriculum.php");
				
				// Creamos un objeto conexi�n y nos conectamos a la base de datos.
				$conexion = new conexion();
				$link = $conexion->conectar();
				
				// Creamos un objeto curriculum y cargamos los datos del acad�mico.
				$vitae = new curriculum($link, $_GET['id']);
				$vitae->cargarAcademico();
				$vitae->tituloAcademico(2);
			}
			else
			{
				// Librer�as necesarias.
				include("../../../librerias/error.php");
				
				// Creamos un objeto error y mostramos el titulo de error.
				$error = new error(1, "../../../", "index.php");
				$error->mostrarTitulo();
			}
			?>
    </TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="540" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../../../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD><IMG SRC="../../../librerias/temasrelacionados.gif" WIDTH="154" HEIGHT="19"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><A HREF="../index.php" title="Ver Acad&eacute;micos"><IMG SRC="../../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Acad&eacute;micos</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../completa/index.php" title="Ver Acad&eacute;micos Jornada Completa">&#149; Jornada Completa</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="8">&#149; Media Jornada</TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../part/index.php" title="Ver Acad&eacute;micos Part-Time">&#149; Part-Time</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><A HREF="../../cec/index.php" title="Ver CEC"><IMG SRC="../../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">CEC</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><A HREF="../../alumnos/index.php" title="Ver Alumnos"><IMG SRC="../../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Alumnos</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><a href="../../ex-alumnos/index.php" title="Ver Ex-Alumnos"><img src="../../../librerias/awtema.gif" width="18" height="10" border="0">Ex-Alumnos</a></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><A HREF="../../administrativos/index.php" title="Ver Administrativos"><IMG SRC="../../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Administrativos</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><A HREF="../../ayudantes/index.php" title="Ver Ayudantes"><IMG SRC="../../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Ayudantes</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD><IMG SRC="../../../librerias/herramientas.gif" WIDTH="154" HEIGHT="19"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"> 
                        <?PHP
						/*
						 * Script en donde se muestra las opciones de herramientas que tiene el sitio Web.
						*/
						$nivel = "../../../";
						require("../../../librerias/herramientas.inc");
						?>
          </TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif"><IMG SRC="../../../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
        </TR>
      </TABLE>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="6" HEIGHT="480" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="480" COLSPAN="4" VALIGN="TOP"> 
            <?PHP
			/*
			 * Script en donde se muestra el curriculum del acad�mico media jornada elegido
			 * por el usuario.
			*/
			
			// Cuando los par�metros son v�lidos.
			if ($correcto)
			{
				$vitae->datosAcademico();
				$conexion->desconectar();
			}
			// Cuando los par�metros no son v�lidos.
			else $error->mostrar();
			?>
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
			require("../../../librerias/referencia.inc");
			?>
    </TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="190" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="190" HEIGHT="1"></TD>
    <TD WIDTH="10" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="10" HEIGHT="1"></TD>
    <TD WIDTH="20" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="20" HEIGHT="1"></TD>
    <TD WIDTH="240" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="240" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
  </TR>
</TABLE>	
</BODY>
</HTML>