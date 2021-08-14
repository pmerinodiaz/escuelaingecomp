<HTML>
<HEAD>
<TITLE>INTR@NET Escuela Ingenier&iacute;a en Computaci&oacute;n - Recordar Clave</TITLE>
<META HTTP-EQUIV="content-type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META NAME="keywords" CONTENT="intranets, servicios, redes, internas, internos, locales, escuelas, ingenier�as, computaci�n, universidades, uls, la serena, recordar, claves, recordatorios, contrase�as, preguntas, preguntar, secretas, secretos">
<META NAME="description" CONTENT="En esta p�gina se le env�a un correo electr�nico al usuario inform�ndole su clave secreta.">
<META NAME="author" CONTENT="H�ctor D�az D�az - Patricio Merino D�az">
<META NAME="copyright" CONTENT="2004 Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="None">
<META NAME="rating" CONTENT="General">
<LINK REL="stylesheet" HREF="../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/descripcion.css" TYPE="text/css">
</HEAD>
<BODY BACKGROUND="../librerias/bgintranet.gif" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
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
              <LI>Responde tu pregunta secreta.</LI>
              <LI><STRONG><FONT COLOR="#CC0000">Nosotros te enviaremos tu clave secreta a tu correo.</FONT></STRONG></LI>
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
			 * Script en donde mostramos la clave secreta del usuario o bien se la enviamos
			 * por correo electr�nico cuando este tiene habilitado el correo electr�nico en
			 * la base de datos.
			*/
			
			// Cuando la variable del formulario existen.
			if (isset($_POST['id']) && isset($_POST['respuesta']) && is_numeric($_POST['id']) && is_string($_POST['respuesta']))
			{
				// Libreria para conexi�n a la base de datos.
				include("../librerias/conexion.php");
				include("../librerias/usuario.php");
				
				// Creamos un objeto conexi�n y nos conectamos a la base de datos.
				$conexion = new conexion();
				$link = $conexion->conectar();
				
				// Creamos un objeto usuario y confirmamos la respuesta.
				$usuario = new usuario($link);
				
				// Imprimimos el cuadro.
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
				
				// Cuando la respuesta es correcta.
				if ($usuario->confirmarRespuesta($_POST['id'], $_POST['respuesta']))
				{
					// Buscamos si el usuario tiene e-mail.
					$email = $usuario->email();
					
					// Cuando tiene email, el enviamos un e-mail.
					if ($email)
					{
						$usuario->enviarClave();
						echo "<P ALIGN='center' CLASS='contenido'>Tu clave secreta fue enviada a tu e-mail <B>$email</B>.</P>";
					}
					
					// Cuando no tiene email, le mostramos la clave.
					else echo "<P ALIGN='center' CLASS='contenido'>Tu clave secreta es: <B>" . $usuario->clave() . "</B>.</P>";
					
					// Mostramos el bot�n 'Volver'.
					echo "<P ALIGN='center'><A HREF='index.php' TITLE='Volver a Intranet'><IMG SRC='../librerias/btvolver.gif' BORDER='0'></A></P>";
				}
				// Cuando la respuesta es incorrecta.
				else
				{
					echo "<P ALIGN='center' CLASS='contenido'>La respuesta entregada no es la correcta.</P>";
					echo "<P ALIGN='center'><A HREF='recordar.php' TITLE='Atr&aacute;s'><IMG SRC='../librerias/btatras.gif' BORDER='0'></A></P>";
				}
				
				// Cerramos el cuadro.
				echo "</TD>";
				echo "</TR>";
				echo "<TR>";
				echo "<TD>&nbsp;</TD>";
				echo "</TR>";
				echo "<TR>";
				echo "<TD><IMG SRC='../librerias/pxplomo.gif' WIDTH='340' HEIGHT='1'></TD>";
				echo "</TR>";
				echo "</TABLE>";
				
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
    <TD WIDTH="10" HEIGHT="164" VALIGN="TOP"></TD>
    <TD WIDTH="239" HEIGHT="164" VALIGN="TOP"></TD>
    <TD WIDTH="111" HEIGHT="164" VALIGN="TOP"></TD>
    <TD WIDTH="229" HEIGHT="164" VALIGN="TOP"></TD>
    <TD WIDTH="191" HEIGHT="164" VALIGN="TOP"></TD>
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