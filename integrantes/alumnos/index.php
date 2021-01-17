<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Integrantes - Alumnos</TITLE>
<META HTTP-EQUIV="content-type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META NAME="keywords" CONTENT="directorios, nombres, cec, alumnos, alumnado, disc�pulos, j�venes, estudiantes, computaci�n, universitarios, integrantes, acad�micos, ex-alumnos, administrativos, ayudantes">
<META NAME="description" CONTENT="P�gina en la cual se muestra informaci�n de los alumnos de la carrera. Tambi�n se muestra el directorio de apellidos para que el usuario pueda ver a todos los alumnos cuyo apellido paterno comienza con esa letra.">
<META NAME="author" CONTENT="H�ctor D�az D�az - Patricio Merino D�az">
<META NAME="copyright" CONTENT="2004 Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="All">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/nivel2.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/coolmenu.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/ventanita.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/valida.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
<!--
function validarFormulario()
{
	if(validarCampo(document.formulario.nombres,isName,false)&&
		 validarCampo(document.formulario.apellidos,isName,false))
		return true;
	else return false;
}
//-->
</SCRIPT>
<LINK REL="stylesheet" HREF="../../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../librerias/tema.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../librerias/formulario.css" TYPE="text/css">
</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/*
 * Script en donde incrementamos el n�mero de visitas del tema 'Alumnos'.
*/

// Librer�as necesarias.
include("../../librerias/visitas.php");
include("../../librerias/conexion.php");

// Creamos un objeto conexi�n y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();

// Creamos un objeto visitas e incrementamos las visitas de este tema.
$numero = new visitas($link);
$numero->incrementarTema(30);
$conexion->desconectar();
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
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD WIDTH="76%" CLASS="ubicacion">Ubicaci&oacute;n: <A HREF="../../home/index.php" TITLE="Ver Home">Home</A> / <A HREF="../index.php" TITLE="Ver Integrantes">Integrantes</A> / Alumnos</TD>
					<TD ROWSPAN="2" WIDTH="24%" VALIGN="TOP"><IMG SRC="activos/bgalumnos.jpg" WIDTH="110" HEIGHT="45"></TD>
				</TR>
				<TR> 
					<TD WIDTH="76%" CLASS="titulo">Alumnos</TD>
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
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../academicos/index.php" title="Ver Acad&eacute;micos"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Acad&eacute;micos</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../academicos/completa/index.php" title="Ver Acad&eacute;micos Jornada Completa">&#149; Jornada Completa</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../academicos/media/index.php" title="Ver Acad&eacute;micos Media Jornada">&#149; Media Jornada</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../academicos/part/index.php" title="Ver Acad&eacute;micos Part-Time">&#149; Part-Time</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../cec/index.php" title="Ver CEC"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">CEC</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Alumnos</TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><a href="../ex-alumnos/index.php" title="Ver Ex-Alumnos"><img src="../../librerias/awtema.gif" width="18" height="10" border="0">Ex-Alumnos</a></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../administrativos/index.php" title="Ver Administrativos"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Administrativos</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../ayudantes/index.php" title="Ver Ayudantes"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Ayudantes</A></TD>
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
						 * Script en donde se muestra las opciones de Herramientas que tiene el sitio Web.
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
    <td width="460" height="480" colspan="4" valign="top">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD WIDTH="50%" VALIGN="TOP" CLASS="contenido">En esta secci&oacute;n podr&aacute;s conocer a los m&aacute;s de 160 alumnos que tiene la carrera Ingenier&iacute;a en Computaci&oacute;n de la <A HREF="http://www.userena.cl" TARGET="_blank" TITLE="Visitar Web de Universidad de La Serena">Universidad de La Serena</A>, y que son un pilar fundamental en el desarrollo de esta instituci&oacute;n y del pa&iacute;s, en el futuro.</TD>
          <TD WIDTH="50%" ALIGN="CENTER"><IMG SRC="activos/logoalumnos.jpg" WIDTH="180" HEIGHT="143"></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><STRONG>Directorio de Alumnos</STRONG></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido">Haz clic en una letra para ver informaci&oacute;n de los alumnos cuyo apellido paterno comienza con esa letra.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" ALIGN="CENTER" CLASS="contenido"> 
                        <?PHP
						/*
						 * Script en donde se imprime el abecedario letras para enlazar a la p�gina
						 * donde se muestran los alumnos.
						*/
						
						// Librer�as necesarias.
						include("../../librerias/letras.php");
						
						// Creamos un objeto letras e imprimimos las letras de la A-Z.
						$letra = new letras();
						$letra->mostrar("alumnos.php", "");
						
						// Mostramos el formulario de b�squeda de alumnos.
						require("../../librerias/busquedaalumno.inc");
						?>
          </TD>
        </TR>
      </TABLE>
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