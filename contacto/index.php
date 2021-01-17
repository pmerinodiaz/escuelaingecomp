<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Cont&aacute;ctenos</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META NAME="keywords" CONTENT="contáctos, preguntas, contáctenos, contáctanos, preguntar, consultar, enviar, e-mails, web-mail, webs, mails, escribir, contactar">
<META NAME="description" CONTENT="A través de esta opción podrás realizar tus consultas, sugerencias o reclamos a la Escuela Inigeniería en Computación, lo que constituye un valioso aporte que nos permite mejorar cada día nuestro servicio.">
<META NAME="author" CONTENT="Héctor Díaz Díaz - Patricio Merino Díaz">
<META NAME="copyright" CONTENT="2004 Escuela Ingeniería en Computación, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="All">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/nivel1.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/coolmenu.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/ventanita.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/valida.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
<!--
function setearFoco()
{
	document.formulario.nombres.focus();
}
function validarFormulario()
{
	if(validarCampo(document.formulario.nombres,isName,false)&&
		 validarCampo(document.formulario.paterno,isName,false)&&
		 validarCampo(document.formulario.materno,isName,true)&&
		 validarCampo(document.formulario.email,isEmail,false)&&
		 validarCampo(document.formulario.asunto,isAny,false)&&
		 validarCampo(document.formulario.texto,isAny,false))
  	return true;
	else return false;
}
//-->
</SCRIPT>
<LINK REL="stylesheet" HREF="../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/tema.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/formulario.css" TYPE="text/css">
</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0" onLoad="setearFoco();">
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/*
 * Script en donde incrementamos el número de visitas del tema 'Contáctenos'.
*/

// Librerías necesarias.
include("../librerias/visitas.php");
include("../librerias/conexion.php");

// Creamos un objeto conexión y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();

// Creamos un objeto visitas e incrementamos las visitas para este tema.
$numero = new visitas($link);
$numero->incrementarTema(57);
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD WIDTH="350" HEIGHT="60" COLSPAN="3" ROWSPAN="2" VALIGN="TOP">
			<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH="350" HEIGHT="60">
    		<PARAM NAME="movie" VALUE="../librerias/logoic.swf">
    		<PARAM NAME="quality" VALUE="high">
    		<PARAM NAME="menu" VALUE="false">
    		<EMBED SRC="../librerias/logoic.swf" WIDTH="350" HEIGHT="60" QUALITY="high" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" TYPE="application/x-shockwave-flash" MENU="false"> 
    		</EMBED>
			</OBJECT>
		</TD>
    <TD WIDTH="10" HEIGHT="60" ROWSPAN="2" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
    <TD WIDTH="20" HEIGHT="17" VALIGN="TOP"><IMG SRC="../librerias/curva.gif" WIDTH="20" HEIGHT="17"></TD>
    <TD WIDTH="240" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="6" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="17" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="420" HEIGHT="43" COLSPAN="4" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="640" ROWSPAN="3" VALIGN="TOP" BACKGROUND="../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD><IMG SRC="../librerias/infogeneral.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="181"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../librerias/infolocal.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="127"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../librerias/miscelaneos.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="60" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD WIDTH="76%" CLASS="ubicacion">Ubicaci&oacute;n: <A HREF="../home/index.php" TITLE="Ver Home">Home</A> / Cont&aacute;ctenos</TD>
					<TD ROWSPAN="2" WIDTH="24%" VALIGN="TOP"><IMG SRC="activos/bgcontactenos.jpg" WIDTH="110" HEIGHT="45"></TD>
				</TR>
				<TR> 
					<TD WIDTH="76%" CLASS="titulo">Cont&aacute;ctenos</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2"><IMG SRC="../librerias/pxgris.gif" WIDTH="460" HEIGHT="1"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="640" ROWSPAN="3" VALIGN="TOP" BACKGROUND="../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD BACKGROUND="../librerias/bgbox.gif"><IMG SRC="../librerias/pxblanco.gif" WIDTH="154" HEIGHT="1"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../librerias/herramientas.gif" WIDTH="154" HEIGHT="19"></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../librerias/bgbox.gif"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../librerias/bgbox.gif"> 
            <?PHP
						/*
						 * Script en donde se muestra las opciones de herramientas que tiene el sitio Web.
						*/
						$nivel = "../";
						require("../librerias/herramientas.inc");
						?>
          </TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../librerias/bgbox.gif"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../librerias/bgbox.gif"><IMG SRC="../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
				</TR>
			</TABLE>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="6" HEIGHT="97" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="97" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD WIDTH="25%" ALIGN="CENTER"><IMG SRC="activos/logocontactenos.jpg" WIDTH="82" HEIGHT="90"></TD>
					<TD WIDTH="75%" CLASS="contenido">
						<P>A trav&eacute;s de esta opci&oacute;n podr&aacute;s realizar tus consultas, sugerencias o reclamos, lo que constituye un valioso aporte que nos permite mejorar cada d&iacute;a nuestro servicio.</P>
						<P>Por favor, completa los siguientes datos y pulsa ENVIAR.</P>
						</TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="97" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="6" HEIGHT="483" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="483" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="1" CELLPADDING="0" CELLSPACING="0" BORDERCOLOR="#F1F1F1" MM_NOCONVERT="TRUE">
				<TR>
					<TD>
						<FORM ACTION="grabar.php" METHOD="post" NAME="formulario" onSubmit="return validarFormulario();">
							<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0">
								<TR> 
									<TD COLSPAN="2">&nbsp;</TD>
								</TR>
								<TR> 
									<TD WIDTH="30%" CLASS="formlabel">Nombres:</TD>
									<TD WIDTH="70%"><INPUT NAME="nombres" TYPE="text" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="50" TITLE="Primer y segundo nombre">
                    <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
								</TR>
								<TR> 
									<TD WIDTH="30%" CLASS="formlabel">Apellido Paterno:</TD>
									<TD WIDTH="70%"><INPUT NAME="paterno" TYPE="text" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="25" TITLE="Apellido paterno">
                    <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
								</TR>
								<TR> 
									<TD WIDTH="30%" CLASS="formlabel">Apellido Materno:</TD>
									<TD WIDTH="70%"><INPUT NAME="materno" TYPE="text" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="25" TITLE="Apellido materno"></TD>
								</TR>
								<TR> 
									<TD WIDTH="30%" CLASS="formlabel">E-mail:</TD>
									<TD WIDTH="70%"><INPUT NAME="email" TYPE="text" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="50" TITLE="Correo electr&oacute;nico">
                    <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
								</TR>
								<TR> 
									<TD WIDTH="30%" CLASS="formlabel">Asunto:</TD>
									<TD WIDTH="70%"><INPUT NAME="asunto" TYPE="text" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="100" TITLE="Asunto del mensaje">
                    <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
								</TR>
								<TR> 
									<TD WIDTH="30%" CLASS="formlabel">Tipo de Contacto:</TD>
									<TD WIDTH="70%"> 
                    <?PHP
										/*
										 * Script que imprime el select con los tipos de preguntas existentes
										 * en la base de datos.
										*/
										
										// Librerías necesarias.
										include("../librerias/tipopregunta.php");
										
										// Creamos el objeto tipo pregunta y formamos el select.
										$tipo = new tipopregunta($link);
										$tipo->select(5);
										$conexion->desconectar();
										?>
                    <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
								</TR>
								<TR> 
									<TD COLSPAN="2" CLASS="formlabel">Recibir notificaci&oacute;n por e-mail para la respuesta: 
										<INPUT TYPE="radio" NAME="notificacion" VALUE="Si">Si 
										<INPUT NAME="notificacion" TYPE="radio" VALUE="No" CHECKED>No</TD>
								</TR>
								<TR> 
									<TD COLSPAN="2">&nbsp;</TD>
								</TR>
								<TR> 
									<TD COLSPAN="2" ALIGN="CENTER" CLASS="formlabel">Texto:</TD>
								</TR>
								<TR> 
									<TD COLSPAN="2" ALIGN="CENTER"><TEXTAREA NAME="texto" CLASS="formtextarea" ROWS="8" TABINDEX="1" TITLE="Texto del mensaje"></TEXTAREA>
                    <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
								</TR>
								<TR>
									<TD COLSPAN="2">&nbsp;</TD>
								</TR>
								<TR> 
									<TD COLSPAN="2" CLASS="contenido">&nbsp;<FONT COLOR="#CC0000">*</FONT> Datos obligatorios</TD>
								</TR>
								<TR> 
									<TD COLSPAN="2">&nbsp;</TD>
								</TR>
								<TR> 
									<TD COLSPAN="2" ALIGN="CENTER"><INPUT TYPE="submit" NAME="enviar" VALUE="Enviar" CLASS="formbutton" TABINDEX="1" TITLE="Enviar el mensaje">&nbsp;<INPUT TYPE="RESET" NAME="limpiar" VALUE="Limpiar" CLASS="formbutton" TABINDEX="1" TITLE="Limpiar el formulario"></TD>
								</TR>
							</TABLE>
						</FORM>
					</TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="483" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="780" HEIGHT="55" COLSPAN="8" VALIGN="TOP" BGCOLOR="#6699CC">
      <?PHP
			/*
			 * Script en donde se muestran los e-mails de referencia a los directores y los derechos de
			 * copia del sitio Web.
			*/
			require("../librerias/referencia.inc");
			?>
    </TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="190" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="190" HEIGHT="1"></TD>
    <TD WIDTH="10" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="10" HEIGHT="1"></TD>
    <TD WIDTH="20" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="20" HEIGHT="1"></TD>
    <TD WIDTH="240" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="240" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
  </TR>
</TABLE>
</BODY>
</HTML>