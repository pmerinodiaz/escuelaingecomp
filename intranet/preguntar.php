<HTML>
<HEAD>
<TITLE>INTR@NET Escuela Ingenier&iacute;a en Computaci&oacute;n - Recordar Clave</TITLE>
<META HTTP-EQUIV="content-type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META NAME="keywords" CONTENT="intranets, servicios, redes, internas, internos, locales, escuelas, ingenierias, computacion, universidades, serena, uls, la serena, recordar, claves, recordatorios, contrase�as, preguntas, preguntar, secretas, secretos">
<META NAME="description" CONTENT="En esta p�gina se presenta el formulario para que el usuario pueda responder a su pregunta secreta y as� nosotros le podemos enviar su clave secreta por correo.">
<META NAME="author" CONTENT="H�ctor D�az D�az - Patricio Merino D�az">
<META NAME="copyright" CONTENT="2004 Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="None">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/valida.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
<!--
function setearFoco()
{
	if(document.formulario!=null)
		document.formulario.respuesta.focus();
}
function validarFormulario()
{
	if(validarCampo(document.formulario.respuesta,isAny,false))
		return true;
	return false;
}
//-->
</SCRIPT>
<LINK REL="stylesheet" HREF="../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/descripcion.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/formulario.css" TYPE="text/css">
</HEAD>
<BODY BACKGROUND="../librerias/bgintranet.gif" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0" onLoad="setearFoco();">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD WIDTH="780" HEIGHT="100" COLSPAN="5" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD WIDTH="85%" BGCOLOR="#6699CC">
						<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" WIDTH="350" HEIGHT="60">
						<PARAM NAME="movie" VALUE="../librerias/logoic.swf">
						<PARAM NAME="quality" VALUE="high">
						<PARAM NAME="menu" VALUE="false">
						<EMBED SRC="../librerias/logoic.swf" QUALITY="high" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer" TYPE="application/x-shockwave-flash" WIDTH="350" HEIGHT="60" MENU="false"></EMBED>
						</OBJECT>
					</TD>
					<TD ALIGN="CENTER" BGCOLOR="#6699CC"><A HREF="index.php" TITLE="Volver a la Intranet"><IMG SRC="../librerias/btvolver.gif" WIDTH="50" HEIGHT="16" BORDER="0"></A></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" BGCOLOR="#000000"><IMG SRC="../librerias/intranet.gif" WIDTH="105" HEIGHT="20" BORDER="0"></TD>
				</TR>
			</TABLE>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="10" HEIGHT="158" VALIGN="TOP"></TD>
    <TD WIDTH="350" HEIGHT="158" COLSPAN="2" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD CLASS="descripcion">
						<OL>
              <LI>Ingresa tu nombre de usuario.</LI>
              <LI><FONT COLOR="#CC0000"><STRONG>Responde tu pregunta secreta.</STRONG></FONT></LI>
              <LI>Nosotros te enviaremos tu clave secreta a tu correo.</LI>
            </OL>
					</TD>
        </TR>
      </TABLE>
		</TD>
    <TD WIDTH="229" HEIGHT="158" VALIGN="TOP"></TD>
    <TD WIDTH="191" HEIGHT="158" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="10" HEIGHT="76" VALIGN="TOP"></TD>
    <TD WIDTH="239" HEIGHT="76" VALIGN="TOP"></TD>
    <TD WIDTH="340" HEIGHT="76" COLSPAN="2" VALIGN="TOP">
			<?PHP
			/*
			 * Script en donde mostramos la pregunta secreta del usuario e imprimimos el
			 * formulario para que el usuario ingrese su respuesta secreta.
			*/
			
			// Cuando la variable del formulario existe.
			if (isset($_POST['usuario']) && is_string($_POST['usuario']))
			{
				// Librerias necesarias.
				include("../librerias/conexion.php");
				include("../librerias/usuariointerno.php");
				
				// Creamos un objeto conexi�n y nos conectamos a la base de datos.
				$conexion = new conexion();
				$link = $conexion->conectar();
				
				// Creamos un objeto usuario interno y confirmamos la existencia del usuario.
				$usuario_interno = new usuariointerno($link);
				
				// Cuando el usuario existe.
				if ($usuario_interno->existe($_POST['usuario']))
				{
					// Imprimimos el formulario.
					echo "<TABLE WIDTH='70%' BORDER='0' CELLPADDING='0' CELLSPACING='0' BACKGROUND='../librerias/bglogon.gif' MM_NOCONVERT='TRUE'>";
					echo "<TR>";
					echo "<TD><IMG SRC='activos/tituloacceso.gif' WIDTH='340' HEIGHT='14'></TD>";
					echo "</TR>";
					echo "<TR>";
					echo "<TD><IMG SRC='../librerias/pxplomo.gif' WIDTH='1' HEIGHT='1'><IMG SRC='../librerias/pxblanco.gif' WIDTH='98' HEIGHT='1'><IMG SRC='../librerias/pxplomo.gif' WIDTH='240' HEIGHT='1'></TD>";
					echo "</TR>";
					echo "<TR>";
					echo "<TD>&nbsp;</TD>";
					echo "</TR>";
					echo "<TR>";
					echo "<TD>";
					echo "<FORM ACTION='clave.php' METHOD='post' NAME='formulario' onSubmit='return validarFormulario();'>";
          echo "<TABLE WIDTH='100%' BORDER='0' CELLSPACING='0' CELLPADDING='0'>";
					
					// Imprimimos la pregunta secreta.
					echo "<TR>";
					echo "<TD WIDTH='26%' CLASS='descripcion'>&nbsp;&nbsp;Pregunta:</TD>";
					echo "<TD><INPUT NAME='pregunta' TYPE='text' CLASS='formtextfield' MAXLENGTH='50' TITLE='Pregunta secreta' VALUE='" . $usuario_interno->pregunta() . "' DISABLED='true'></TD>";
					echo "</TR>";
					
					// Ingresar la respuesta.
					echo "<TR>";
					echo "<TD CLASS='descripcion'>&nbsp;&nbsp;Respuesta:</TD>";
					echo "<TD><INPUT NAME='respuesta' TYPE='text' MAXLENGTH='50' CLASS='formtextfield' TITLE='Respuesta secreta' TABINDEX='1'></TD>";
					echo "</TR>";
					
					// Imprimimos un espacio.
					echo "<TR>";
          echo "<TD COLSPAN='2' ALIGN='CENTER'><IMG SRC='../librerias/pxblanco.gif' WIDTH='1' HEIGHT='10'></TD>";
          echo "</TR>";
					
					// Imprimimos el bot�n.
					echo "<TR>";
					echo "<TD COLSPAN='2' ALIGN='CENTER'><INPUT NAME='enviar' TYPE='submit' CLASS='formbutton' VALUE='Responder' TITLE='Responder la pregunta secreta' TABINDEX='1'></TD>";
					echo "</TR>";
					
					// Imprimimos el identificador del usuario.
					echo "<TR>";
					echo "<TD COLSPAN='2'>&nbsp;<IMG SRC='../librerias/pxblanco.gif' WIDTH='1' HEIGHT='10'><INPUT NAME='id' TYPE='hidden' VALUE='" . $usuario_interno->id() . "'></TD>";
					echo "</TR>";
					echo "</TABLE>";
					echo "</FORM>";
					echo "</TD>";
					echo "</TR>";
					echo "<TR>";
          echo "<TD><IMG SRC='../librerias/pxplomo.gif' WIDTH='340' HEIGHT='1'></TD>";
        	echo "</TR>";
					echo "</TABLE>";
				}
				// Cuando el usuario no existe.
				else
				{
					// Imprimimos el mensaje de que el usuario no est� registrado.
					echo "<TABLE WIDTH='70%' BORDER='0' CELLPADDING='0' CELLSPACING='0' BACKGROUND='../librerias/bglogon.gif' MM_NOCONVERT='TRUE'>";
					echo "<TR>";
					echo "<TD><IMG SRC='activos/tituloacceso.gif' WIDTH='340' HEIGHT='14'></TD>";
					echo "</TR>";
					echo "<TR>";
					echo "<TD><IMG SRC='../librerias/pxplomo.gif' WIDTH='1' HEIGHT='1'><IMG SRC='../librerias/pxblanco.gif' WIDTH='98' HEIGHT='1'><IMG SRC='../librerias/pxplomo.gif' WIDTH='240' HEIGHT='1'></TD>";
					echo "</TR>";
					echo "<TR>";
					echo "<TD>&nbsp;</TD>";
					echo "</TR>";
					echo "<TR>";
					echo "<TD ALIGN='center' CLASS='contenido'>El usuario <B>" . $_POST['usuario'] . "</B> no est&aacute; registrado.</TD>";
					echo "</TR>";
					echo "<TR>";
					echo "<TD>&nbsp;</TD>";
					echo "</TR>";
					echo "<TR>";
					echo "<TD ALIGN='center'><A HREF='recordar.php' TITLE='Atr&aacute;s'><IMG SRC='../librerias/btatras.gif' BORDER='0'></A></TD>";
					echo "</TR>";
					echo "<TR>";
					echo "<TD>&nbsp;</TD>";
					echo "</TR>";
					echo "<TR>";
          echo "<TD><IMG SRC='../librerias/pxplomo.gif' WIDTH='340' HEIGHT='1'></TD>";
        	echo "</TR>";
					echo "</TABLE>";
				}
				
				// Desconectamos el enlace a la base de datos.
				$conexion->desconectar();
			}
			// Cuando faltan los datos del formulario.
			else
			{
				echo "<P CLASS='contenido' ALIGN='center'><B>Error</B>: Faltan los datos del formulario.</P>";
				echo "<P ALIGN='center'><A HREF='recordar.php' TITLE='Atr&aacute;'><IMG SRC='../librerias/btatras.gif' BORDER='0'></A></P>";
			}
			?>
		</TD>
    <TD WIDTH="191" HEIGHT="76" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="10" HEIGHT="138" VALIGN="TOP"></TD>
    <TD WIDTH="239" HEIGHT="138" VALIGN="TOP"></TD>
    <TD WIDTH="111" HEIGHT="138" VALIGN="TOP"></TD>
    <TD WIDTH="229" HEIGHT="138" VALIGN="TOP"></TD>
    <TD WIDTH="191" HEIGHT="138" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="780" HEIGHT="55" COLSPAN="5" VALIGN="TOP" BGCOLOR="#6699CC">
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
    <TD WIDTH="239" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="239" HEIGHT="1"></TD>
    <TD WIDTH="111" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="111" HEIGHT="1"></TD>
    <TD WIDTH="229" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="229" HEIGHT="1"></TD>
    <TD WIDTH="191" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="191" HEIGHT="1"></TD>
  </TR>
</TABLE>
</BODY>
</HTML>