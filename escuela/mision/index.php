<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Escuela - Misi&oacute;n</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META NAME="keywords" CONTENT="misiones, estudiantes, alumnos, reseñas, historias, escuelas, objetivos, carreras, ingenierías, computación, informática, licenciaturas, software, redes, formaciones,">
<META NAME="description" CONTENT="Página con la información sobre la misión que tiene la Escuela Ingeniería en Computación con nuestros estudiantes y la comunidad.">
<META NAME="author" CONTENT="Héctor Díaz Díaz - Patricio Merino Díaz">
<META NAME="copyright" CONTENT="2004 Escuela Ingeniería en Computación, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="All">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/nivel2.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/coolmenu.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/ventanita.js"></SCRIPT>
<LINK REL="stylesheet" HREF="../../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../librerias/tema.css" TYPE="text/css">
</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/**
 * Script en donde incrementamos el número de visitas del tema 'Misión de la Escuela'.
*/

// Librerías necesarias.
include("../../librerias/conexion.php");
include("../../librerias/visitas.php");

// Creamos un objeto conexión y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();

// Creamos un objeto visitas e incrementamos las visitas de este tema.
$numero = new visitas($link);
$numero->incrementarTema(2);
$conexion->desconectar();
?>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="350" height="60" colspan="3" rowspan="2" valign="top">
			<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH="350" HEIGHT="60">
    		<PARAM NAME="movie" VALUE="../../librerias/logoic.swf">
    		<PARAM NAME="quality" VALUE="high">
    		<PARAM NAME="menu" VALUE="false">
    		<EMBED SRC="../../librerias/logoic.swf" WIDTH="350" HEIGHT="60" QUALITY="high" MENU="false" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" TYPE="application/x-shockwave-flash"> 
    		</EMBED>
			</OBJECT>
		</td>
    <td width="10" height="60" rowspan="2" valign="top" bgcolor="#6699CC">&nbsp;</td>
    <td width="20" height="17" valign="top"><IMG SRC="../../librerias/curva.gif" WIDTH="20" HEIGHT="17"></td>
    <td width="60" height="17" valign="top"></td>
    <td width="20" height="17" valign="top"></td>
    <td width="160" height="17" valign="top"></td>
    <td width="6" height="17" valign="top"></td>
    <td width="154" height="17" valign="top"></td>
  </tr>
  <tr>
    <td width="420" height="43" colspan="6" valign="top" bgcolor="#6699CC">&nbsp;</td>
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
    <td width="460" height="60" colspan="6" valign="top">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
    		<TR>
					<TD WIDTH="76%" CLASS="ubicacion">Ubicaci&oacute;n: <A HREF="../../home/index.php" TITLE="Ver Home">Home</A> / <A HREF="../index.php" TITLE="Ver Escuela">Escuela</A> / Misi&oacute;n</TD>
      		<TD ROWSPAN="2" WIDTH="24%" VALIGN="TOP"><IMG SRC="activos/bgmision.jpg" WIDTH="110" HEIGHT="45"></TD>
    		</TR>
    		<TR> 
      		<TD WIDTH="76%" CLASS="titulo">Misi&oacute;n de la Escuela</TD>
    		</TR>
    		<TR> 
      		<TD COLSPAN="2"><IMG SRC="../../librerias/pxgris.gif" WIDTH="460" HEIGHT="1"></TD>
    		</TR>
  		</TABLE>
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
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../historia/index.php" title="Ver Rese&ntilde;a Hist&oacute;rica"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Rese&ntilde;a Hist&oacute;rica</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Misi&oacute;n</TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../objetivos/index.php" title="Ver Objetivos"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Objetivos</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../objetivos/generales/index.php" title="Ver Objetivos Generales">&#149; Generales</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../objetivos/especificos/index.php" title="Ver Objetivos Espec&iacute;ficos">&#149; Espec&iacute;ficos</A></TD>
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
						/**
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
          <TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
        </TR>
      </TABLE>
		</td>
  </tr>
  <tr>
    <td width="6" height="480" valign="top"></td>
    <td width="460" height="480" colspan="6" valign="top">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD COLSPAN="2" CLASS="contenido">Nuestra misi&oacute;n es formar un profesional con una s&oacute;lida formaci&oacute;n cient&iacute;fica con &eacute;nfasis en la Ingenier&iacute;a de Software, manejo y administraci&oacute;n de Bases de Datos, Comunicaci&oacute;n de Datos y Redes, en conjunto con otras asignaturas, que le permiten:</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2">&nbsp;</TD>
				</TR>
				<TR> 
					<TD CLASS="contenido" WIDTH="50%">Tener autonom&iacute;a intelectual, pero a su vez la capacidad de integrar equipos de trabajo interdisciplinarios, con el objetivo de investigar, asesorar, dise&ntilde;ar, implementar, evaluar y poner en operaci&oacute;n los productos de software requeridos para apoyar los procesos de toma de decisiones y productivos en cualquier nivel de las estructuras organizacionales.</TD>
					<TD ALIGN="RIGHT" VALIGN="TOP"><IMG SRC="activos/logomision.jpg" WIDTH="200" HEIGHT="138"></TD>
				</TR>
				<TR>
					<TD COLSPAN="2">&nbsp;</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido">Por otra parte, dado que nuestro Ingeniero en Computaci&oacute;n obtiene la licenciatura en Ingenier&iacute;a Inform&aacute;tica, lo que le permite ingresar directamente a programas de postgrado, tal como Mag&iacute;ster en Ingenier&iacute;a Inform&aacute;tica o continuar estudios de Ingenier&iacute;a Civil Inform&aacute;tica.</TD>
				</TR>
  		</TABLE>
		</td>
    <td width="6" height="480" valign="top"></td>
  </tr>
  <tr>
    <td width="780" height="55" colspan="10" valign="top" bgcolor="#6699CC">
      <?PHP
			/**
			 * Script en donde se muestran los e-mails de referencia a los directores y los derechos de
			 * copia del sitio Web.
			*/
			require("../../librerias/referencia.inc");
			?>
    </td>
  </tr>
  <tr>
    <td width="154" height="1" valign="top"><img src="../../librerias/pxtransparente.gif"  width="154" height="1"></td>
    <td width="6" height="1" valign="top"><img src="../../librerias/pxtransparente.gif"  width="6" height="1"></td>
    <td width="190" height="1" valign="top"><img src="../../librerias/pxtransparente.gif"  width="190" height="1"></td>
    <td width="10" height="1" valign="top"><img src="../../librerias/pxtransparente.gif"  width="10" height="1"></td>
    <td width="20" height="1" valign="top"><img src="../../librerias/pxtransparente.gif"  width="20" height="1"></td>
    <td width="60" height="1" valign="top"><img src="../../librerias/pxtransparente.gif"  width="60" height="1"></td>
    <td width="20" height="1" valign="top"><img src="../../librerias/pxtransparente.gif"  width="20" height="1"></td>
    <td width="160" height="1" valign="top"><img src="../../librerias/pxtransparente.gif"  width="160" height="1"></td>
    <td width="6" height="1" valign="top"><img src="../../librerias/pxtransparente.gif"  width="6" height="1"></td>
    <td width="154" height="1" valign="top"><img src="../../librerias/pxtransparente.gif"  width="154" height="1"></td>
  </tr>
</table>
</BODY>
</HTML>