<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Admisi&oacute;n - C&aacute;lculo Puntaje</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META NAME="keywords" CONTENT="c�lculos, puntajes, admisiones, postulaciones, pruebas, requisitos, universidades, serena, uls, carreras, ingenier�as, computaci�n, consultas, preguntas, dudas, paa, psu, ingreso, regiones, postular">
<META NAME="description" CONTENT="P�gina que presenta el formulario donde el usuario ingresa sus datos y, posteriormente envi�ndolos, puede calcular su puntaje ponderado de ingreso para la carrera de Ingenier�a en Computaci�n de la ULS.">
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
function setearFoco()
{
	document.formulario.nota.focus();
}
function validarFormulario()
{
	if (validarCampo(document.formulario.lenguaje,isNumberPositive,false)&&
			validarCampo(document.formulario.matematicas,isNumberPositive,false)&&
			validarCampo(document.formulario.ciencias,isNumberPositive,false))
  	return true;
	else return false;
}
//-->
</SCRIPT>
<LINK REL="stylesheet" HREF="../../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../librerias/tema.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../librerias/formulario.css" TYPE="text/css">
</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0" onLoad="setearFoco();">
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/**
 * Script en donde incrementamos el n�mero de visitas del tema 'C�lculo de Puntaje'.
*/

// Librer�as necesarias.
include("../../librerias/visitas.php");
include("../../librerias/conexion.php");

// Creamos un objeto conexi�n y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();

// Creamos un objeto visitas e incrementamos las visitas de este tema.
$visitas = new visitas($link);
$visitas->incrementarTema(21);

// Desconectamos la conexi�n a la base de datos.
$conexion->desconectar();
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD WIDTH="350" HEIGHT="60" COLSPAN="3" ROWSPAN="2" VALIGN="TOP">
			<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH="350" HEIGHT="60">
    		<PARAM NAME="movie" VALUE="../../librerias/logoic.swf">
    		<PARAM NAME="quality" VALUE="high">
    		<PARAM NAME="menu" VALUE="false">
    		<EMBED SRC="../../librerias/logoic.swf" WIDTH="350" HEIGHT="60" QUALITY="high" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" TYPE="application/x-shockwave-flash" MENU="false"></EMBED>
			</OBJECT>
		</TD>
    <TD WIDTH="10" HEIGHT="60" ROWSPAN="2" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
    <TD WIDTH="20" HEIGHT="17" VALIGN="TOP"><IMG SRC="../../librerias/curva.gif" WIDTH="20" HEIGHT="17"></TD>
    <TD WIDTH="240" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="6" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="17" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="420" HEIGHT="43" COLSPAN="4" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="630" ROWSPAN="3" VALIGN="TOP" BACKGROUND="../../librerias/bgmenu.gif">
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
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="60" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD WIDTH="76%" CLASS="ubicacion">Ubicaci&oacute;n: <A HREF="../../home/index.php" TITLE="Ver Home">Home</A> / <A HREF="../index.php" TITLE="Ver Admisi&oacute;n">Admisi&oacute;n</A> / C&aacute;lculo Puntaje</TD>
					<TD ROWSPAN="2" WIDTH="24%" VALIGN="TOP"><IMG SRC="activos/bgcalculopuntaje.jpg" WIDTH="110" HEIGHT="45"></TD>
				</TR>
				<TR> 
					<TD WIDTH="76%" CLASS="titulo">C&aacute;lculo Puntaje</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2"><IMG SRC="../../librerias/pxgris.gif" WIDTH="460" HEIGHT="1"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="630" ROWSPAN="3" VALIGN="TOP" BACKGROUND="../../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD><IMG SRC="../../librerias/temasrelacionados.gif" WIDTH="154" HEIGHT="19"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../postulacion/index.php" TITLE="Ver Postulaci&oacute;n"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Postulaci&oacute;n</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../postulacion/uls/index.php" TITLE="Ver Postulaci&oacute;n a la ULS">&#149; ULS</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../postulacion/carrera/index.php" TITLE="Ver Postulaci&oacute;n a la Carrera">&#149; Carrera</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">C&aacute;lculo Puntaje</TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../consultas/index.php?pagina=1" TITLE="Ver Consultas"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Consultas</A></TD>
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
          <TD BACKGROUND="../../librerias/bgbox.gif"> 
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
          <TD BACKGROUND="../../librerias/bgbox.gif" VALIGN="MIDDLE"><IMG SRC="../../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
        </TR>
      </TABLE>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="6" HEIGHT="90" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="90" COLSPAN="4" VALIGN="TOP">
			<P CLASS="contenido">Conoce en l&iacute;nea y en forma completamente autom&aacute;tica, tus posibilidades de ingresar a la carrera de Ingenier&iacute;a en Computaci&oacute;n. Mediante un software te calcularemos tu puntaje ponderado y tus posibilidades de ingreso.</P>
			<P CLASS="contenido">Completa los datos que te solicitamos y posteriormente haz clic en CALCULAR.</P>
		</TD>
    <TD WIDTH="6" HEIGHT="90" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="6" HEIGHT="460" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="460" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="1" CELLPADDING="0" CELLSPACING="0" BORDERCOLOR="#F1F1F1" MM_NOCONVERT="TRUE">
					<TR>
						<TD>
							<FORM ACTION="calcular.php" METHOD="post" NAME="formulario" onSubmit="return validarFormulario();">
              	<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0">
									<TR> 
										<TD COLSPAN="2" CLASS="formtitulo">Ense&ntilde;anza Media</TD>
									</TR>
									<TR> 
										<TD COLSPAN="2">&nbsp;</TD>
									</TR>
									<TR> 
										<TD WIDTH="45%" CLASS="formlabel">Nota:</TD>
										<TD WIDTH="55%">
											<SELECT NAME="nota" CLASS="formlist" TABINDEX="1">
												<OPTION VALUE="4.0" SELECTED>4.0</OPTION>
												<OPTION VALUE="4.1">4.1</OPTION>
												<OPTION VALUE="4.2">4.2</OPTION>
												<OPTION VALUE="4.3">4.3</OPTION>
												<OPTION VALUE="4.4">4.4</OPTION>
												<OPTION VALUE="4.5">4.5</OPTION>
												<OPTION VALUE="4.6">4.6</OPTION>
												<OPTION VALUE="4.7">4.7</OPTION>
												<OPTION VALUE="4.8">4.8</OPTION>
												<OPTION VALUE="4.9">4.9</OPTION>
												<OPTION VALUE="5.0">5.0</OPTION>
												<OPTION VALUE="5.1">5.1</OPTION>
												<OPTION VALUE="5.2">5.2</OPTION>
												<OPTION VALUE="5.3">5.3</OPTION>
												<OPTION VALUE="5.4">5.4</OPTION>
												<OPTION VALUE="5.5">5.5</OPTION>
												<OPTION VALUE="5.6">5.6</OPTION>
												<OPTION VALUE="5.7">5.7</OPTION>
												<OPTION VALUE="5.8">5.8</OPTION>
												<OPTION VALUE="5.9">5.9</OPTION>
												<OPTION VALUE="6.0">6.0</OPTION>
												<OPTION VALUE="6.1">6.1</OPTION>
												<OPTION VALUE="6.2">6.2</OPTION>
												<OPTION VALUE="6.3">6.3</OPTION>
												<OPTION VALUE="6.4">6.4</OPTION>
												<OPTION VALUE="6.5">6.5</OPTION>
												<OPTION VALUE="6.6">6.6</OPTION>
												<OPTION VALUE="6.7">6.7</OPTION>
												<OPTION VALUE="6.8">6.8</OPTION>
												<OPTION VALUE="6.9">6.9</OPTION>
												<OPTION VALUE="7.0">7.0</OPTION>
											</SELECT>
                    <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
									</TR>
									<TR> 
										<TD WIDTH="45%" CLASS="formlabel">Ubicaci&oacute;n Establecimiento:</TD>
										<TD WIDTH="55%">
											<SELECT NAME="region" CLASS="formlist" TABINDEX="1">
												<OPTION VALUE="1">I Regi&oacute;n</OPTION>
												<OPTION VALUE="2">II Regi&oacute;n</OPTION>
												<OPTION VALUE="3">III Regi&oacute;n</OPTION>
												<OPTION VALUE="4" SELECTED>IV Regi&oacute;n</OPTION>
												<OPTION VALUE="5">V Regi&oacute;n</OPTION>
												<OPTION VALUE="6">VI Regi&oacute;n</OPTION>
												<OPTION VALUE="7">VII Regi&oacute;n</OPTION>
												<OPTION VALUE="8">VIII Regi&oacute;n</OPTION>
												<OPTION VALUE="9">IX Regi&oacute;n</OPTION>
												<OPTION VALUE="10">X Regi&oacute;n</OPTION>
												<OPTION VALUE="11">XI Regi&oacute;n</OPTION>
												<OPTION VALUE="12">XII Regi&oacute;n</OPTION>
												<OPTION VALUE="13">Regi&oacute;n Metropolitana</OPTION>
											</SELECT>
                    <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
									</TR>
									<TR>
										<TD COLSPAN="2">&nbsp;</TD>
									</TR>
									<TR> 
										<TD COLSPAN="2" CLASS="formtitulo">Postulaci&oacute;n a la ULS</TD>
									</TR>
									<TR> 
										<TD COLSPAN="2">&nbsp;</TD>
									</TR>
									<TR> 
										<TD WIDTH="45%" CLASS="formlabel">Preferencia:</TD>
										<TD WIDTH="55%">
											<SELECT NAME="preferencia" CLASS="formlist" TABINDEX="1">
												<OPTION VALUE="1" SELECTED>Primera Preferencia</OPTION>
												<OPTION VALUE="2">Segunda Preferencia</OPTION>
												<OPTION VALUE="3">Tercera Preferencia</OPTION>
												<OPTION VALUE="4">Cuarta Preferencia y Superiores</OPTION>
											</SELECT>
                    <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
									</TR>
									<TR> 
										<TD COLSPAN="2">&nbsp;</TD>
									</TR>
									<TR> 
										<TD COLSPAN="2" CLASS="formtitulo">Puntajes Prueba de Selecci&oacute;n Universitaria (PSU)</TD>
									</TR>
									<TR> 
										<TD COLSPAN="2">&nbsp;</TD>
									</TR>
									<TR> 
										<TD WIDTH="45%" CLASS="formlabel">PSU Lenguaje y Comunicaci&oacute;n:</TD>
										<TD WIDTH="55%"><INPUT NAME="lenguaje" TYPE="text" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="5" TITLE="Puntaje obtenido en PSU Lenguaje y Comunicaci&oacute;n">
                    <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
									</TR>
									<TR> 
										<TD WIDTH="45%" CLASS="formlabel">PSU Matem&aacute;ticas:</TD>
										<TD WIDTH="55%"><INPUT NAME="matematicas" TYPE="text" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="5" TITLE="Puntaje obtenido en PSU Matem&aacute;ticas">
                    <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
									</TR>
									<TR> 
										<TD WIDTH="45%" CLASS="formlabel">PSU Ciencias:</TD>
										<TD WIDTH="55%"><INPUT NAME="ciencias" TYPE="text" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="5" TITLE="Puntaje obtenido en PSU Ciencias">
                    <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
									</TR>
									<TR> 
										<TD COLSPAN="2">&nbsp;</TD>
									</TR>
									<TR> 
										
                  <TD COLSPAN="2" CLASS="contenido">&nbsp;<FONT COLOR="#CC0000">*</FONT> Datos requeridos</TD>
									</TR>
									<TR> 
										<TD COLSPAN="2" ALIGN="CENTER"><INPUT TYPE="submit" NAME="calcular" VALUE="Calcular" CLASS="formbutton" TABINDEX="1" TITLE="Calcular puntaje ponderado y posibilidades de ingreso">&nbsp;<INPUT TYPE="RESET" NAME="limpiar" VALUE="Limpiar" CLASS="formbutton" TABINDEX="1" TITLE="Limpiar el formulario"></TD>
									</TR>
              	</TABLE>
							</FORM>
						</TD>
					</TR>
				</TABLE>
			</TD>
    <TD WIDTH="6" HEIGHT="460" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="780" HEIGHT="55" COLSPAN="8" VALIGN="TOP" BGCOLOR="#6699CC">
			<?PHP
			/**
			 * Script en donde se muestran los e-mails de referencia a los directores y los derechos de
			 * copia del sitio web.
			*/
			require("../../librerias/referencia.inc");
			?>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="190" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="190" HEIGHT="1"></TD>
    <TD WIDTH="10" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="10" HEIGHT="1"></TD>
    <TD WIDTH="20" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="20" HEIGHT="1"></TD>
    <TD WIDTH="240" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="240" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
  </TR>
</TABLE>
</BODY>
</HTML>