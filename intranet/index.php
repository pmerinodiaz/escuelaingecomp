<HTML>
<HEAD>
<TITLE>INTR@NET Escuela Ingenier&iacute;a en Computaci&oacute;n - Home</TITLE>
<META HTTP-EQUIV="content-type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META NAME="keywords" CONTENT="intranets, servicios, redes, privadas, internas, internos, locales, escuelas, ingenier�as, computaci�n, universidades, uls, la serena">
<META NAME="description" CONTENT="La Intranet de la Escuela Ingenier�a en Computaci�n ofrece diversos servicios e informaci�n orientada a nuestra comunidad estudiantil de la Escuela.">
<META NAME="author" CONTENT="H�ctor D�az D�az - Patricio Merino D�az">
<META NAME="copyright" CONTENT="2004 Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="All">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/valida.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
<!--
function setearFoco()
{
	document.formulario.usuario.focus();
}
function validarFormulario()
{
	if(validarCampo(document.formulario.usuario,isRUT,false)&& 
		 validarCampo(document.formulario.clave,isAny,false))
		return true;
	else return false;
}
//-->
</SCRIPT>
<LINK REL="stylesheet" HREF="../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/tema.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/descripcion.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/detalle.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/formulario.css" TYPE="text/css">
</HEAD>
<BODY LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0" BACKGROUND="../librerias/bgintranet.gif" onLoad="setearFoco();">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD WIDTH="780" HEIGHT="80" COLSPAN="6" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD BGCOLOR="#6699CC">
						<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" WIDTH="350" HEIGHT="60">
						<PARAM NAME="movie" VALUE="../librerias/logoic.swf">
						<PARAM NAME="quality" VALUE="high">
						<PARAM NAME="menu" VALUE="false">
						<EMBED SRC="../librerias/logoic.swf" QUALITY="high" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer" TYPE="application/x-shockwave-flash" WIDTH="350" HEIGHT="60" MENU="false"></EMBED>
						</OBJECT>
					</TD>
        </TR>
        <TR> 
          <TD BGCOLOR="#000000"><IMG SRC="../librerias/intranet.gif" WIDTH="105" HEIGHT="20" BORDER="0"></TD>
        </TR>
      </TABLE>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="10" HEIGHT="10" VALIGN="TOP"></TD>
    <TD WIDTH="240" HEIGHT="10" VALIGN="TOP"></TD>
    <TD WIDTH="110" HEIGHT="10" VALIGN="TOP"></TD>
    <TD WIDTH="230" HEIGHT="10" VALIGN="TOP"></TD>
    <TD WIDTH="30" HEIGHT="10" VALIGN="TOP"></TD>
    <TD WIDTH="160" HEIGHT="170" ROWSPAN="2" VALIGN="TOP"><A HREF="problemas.php" TITLE="&iquest;Tienes problemas para entrar?"><IMG SRC="activos/icoproblemas.gif" WIDTH="160" HEIGHT="116" BORDER="0"></A></TD>
  </TR>
  <TR>
    <TD WIDTH="10" HEIGHT="160" VALIGN="TOP"></TD>
    <TD WIDTH="350" HEIGHT="160" COLSPAN="2" VALIGN="TOP"><TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD CLASS="descripcion">La Intranet de la Escuela Ingenier&iacute;a en Computaci&oacute;n ofrece diversos servicios e informaci&oacute;n orientada a nuestra comunidad estudiantil de la Escuela.</TD>
				</TR>
				<TR> 
					<TD>&nbsp;</TD>
				</TR>
				<TR>
					<TD>
						<?PHP
						/*
						 * Script para mostrar los mensajes al usuario, dependiendo de los
						 * resultados obtenidos de la validacion de datos del formulario.
						*/
						
						// Dependiendo del error ocurrido, configuramos los mensajes.
						if (isset($_GET['error']))
						{
							switch ($_GET['error'])
							{
								// Error en la identificaci�n.
								case 1: printf("<P CLASS='tema'>Tu nombre de usuario y/o clave no son v&aacute;lidas.</P>"); break;
								// El usuario no es interno.
								case 2: printf("<P CLASS='tema'>No est&aacute;s registrado como usuario interno.</P>"); break;
								// El privilegio no es permitido.
								case 3: printf("<P CLASS='tema'>El permiso al privilegio seleccionado fue denegado.</P>"); break;
								// No se encontraron errores.
								default: printf("<P CLASS='descripcion'>Para acceder a todos los servicios, primero debes ingresar tu nombre de usuario, clave y privilegio.</P>"); break;
							}
						}
						else printf("<P CLASS='descripcion'>Para acceder a todos los servicios, primero debes ingresar tu nombre de usuario, clave y privilegio.</P>");
						?>
					</TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="230" HEIGHT="160" VALIGN="TOP"></TD>
    <TD WIDTH="30" HEIGHT="160" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="10" HEIGHT="132" VALIGN="TOP"></TD>
    <TD WIDTH="240" HEIGHT="132" VALIGN="TOP"></TD>
    <TD WIDTH="340" HEIGHT="132" COLSPAN="2" VALIGN="TOP">
			<TABLE WIDTH="70%" BORDER="0" CELLPADDING="0" CELLSPACING="0" BACKGROUND="../librerias/bglogon.gif" MM_NOCONVERT="TRUE">
        <TR> 
          <TD><IMG SRC="activos/tituloacceso.gif" WIDTH="340" HEIGHT="14"></TD>
        </TR>
        <TR> 
          <TD><IMG SRC="../librerias/pxplomo.gif" WIDTH="1" HEIGHT="1"><IMG SRC="../librerias/pxblanco.gif" WIDTH="98" HEIGHT="1"><IMG SRC="../librerias/pxplomo.gif" WIDTH="240" HEIGHT="1"></TD>
        </TR>
        <TR> 
          <TD>&nbsp;</TD>
        </TR>
        <TR> 
          <TD>
						<FORM ACTION="control.php" METHOD="POST" NAME="formulario" onSubmit="return validarFormulario();">
              <TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
                <TR> 
                  <TD WIDTH="26%" CLASS="descripcion">&nbsp;&nbsp;Usuario:</TD>
                  <TD WIDTH="74%"><INPUT NAME="usuario" TYPE="text" MAXLENGTH="10" CLASS="formtextfield" TITLE="Nombre de usuario (RUT completo)"></TD>
                </TR>
                <TR> 
                  <TD CLASS="descripcion">&nbsp;&nbsp;Clave:</TD>
                  <TD><INPUT NAME="clave" TYPE="password" MAXLENGTH="10" CLASS="formtextfield" TITLE="Clave secreta"></TD>
                </TR>
                <TR> 
                  <TD WIDTH="26%" CLASS="descripcion">&nbsp;&nbsp;Privilegio:</TD>
                  <TD>
									<?PHP
										/*
										 * Script que carga en el select con los privilegios desde la base de datos.
										*/
										
										// Librer�as necesarias.
										include("../librerias/conexion.php");
										include("../librerias/privilegio.php");
										
										// Creamos un objeto conexi�n y nos conectamos a la base de datos.
										$conexion = new conexion();
										$link = $conexion->conectar();
										
										// Creamos un objeto privilegio y creamos el select.
										$privilegio = new privilegio($link);
										$privilegio->select(3);
										$conexion->desconectar();
									?>
									</TD>
                </TR>
                <TR>
                  <TD COLSPAN="2" ALIGN="CENTER"><IMG SRC="../librerias/pxblanco.gif" WIDTH="1" HEIGHT="10"></TD>
                </TR>
                <TR>
                  <TD COLSPAN="2" ALIGN="CENTER"><INPUT NAME="sesion" TYPE="submit" CLASS="formbutton" VALUE="Iniciar sesi&oacute;n" TITLE="Iniciar la sesi&oacute;n"></TD>
                </TR>
                <TR> 
                  <TD COLSPAN="2" ALIGN="CENTER"><IMG SRC="../librerias/pxblanco.gif" WIDTH="1" HEIGHT="10"></TD>
                </TR>
                <TR> 
                  <TD COLSPAN="2" ALIGN="CENTER" CLASS="detalle"><A HREF="recordar.php" TITLE="&iquest;Olvidaste tu clave secreta?">&iquest;Olvidaste tu clave?</A></TD>
                </TR>
              </TABLE>
            </FORM>
					</TD>
        </TR>
        <TR> 
          <TD><IMG SRC="../librerias/pxplomo.gif" WIDTH="340" HEIGHT="1"></TD>
        </TR>
      </TABLE>
		</TD>
    <TD WIDTH="30" HEIGHT="132" VALIGN="TOP"></TD>
    <TD WIDTH="160" HEIGHT="132" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="10" HEIGHT="122" VALIGN="TOP"></TD>
    <TD WIDTH="240" HEIGHT="122" VALIGN="TOP"></TD>
    <TD WIDTH="110" HEIGHT="122" VALIGN="TOP"></TD>
    <TD WIDTH="230" HEIGHT="122" VALIGN="TOP"></TD>
    <TD WIDTH="30" HEIGHT="122" VALIGN="TOP"></TD>
    <TD WIDTH="160" HEIGHT="122" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="780" HEIGHT="55" COLSPAN="6" VALIGN="TOP" BGCOLOR="#6699CC">
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
    <TD WIDTH="10" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="10" HEIGHT="1"></TD>
    <TD WIDTH="240" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="240" HEIGHT="1"></TD>
    <TD WIDTH="110" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="110" HEIGHT="1"></TD>
    <TD WIDTH="230" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="230" HEIGHT="1"></TD>
    <TD WIDTH="30" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="30" HEIGHT="1"></TD>
    <TD WIDTH="160" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="160" HEIGHT="1"></TD>
  </TR>
</TABLE>
</BODY>
</HTML>