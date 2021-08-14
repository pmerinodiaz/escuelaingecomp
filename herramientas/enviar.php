<HTML>
<HEAD>
<TITLE>Recomendar este Web</TITLE>
<META HTTP-EQUIV="content type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META NAME="keywords" CONTENT="recomendaciones, recomendar, webs, correos, enviar, comentarios">
<META NAME="description" CONTENT="En esta página se envía un correo electrónico a la persona con la dirección ingresada anteriormente por el usuario. Se envía una recomendación de este Web.">
<META NAME="author" CONTENT="Héctor Díaz Díaz - Patricio Merino Díaz">
<META NAME="copyright" CONTENT="2004 Escuela Ingeniería en Computación, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="None">
<META NAME="rating" CONTENT="General">
<LINK REL="stylesheet" HREF="../librerias/base.css" TYPE="TEXT/CSS">
<BODY BGCOLOR="#E3E9EC" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<TABLE WIDTH="400" BORDER="0" CELLSPACING="0" CELLPADDING="0">
  <TR> 
    <TD ALIGN="CENTER" BGCOLOR="#FFFFFF"><IMG SRC="activos/titulo.gif" WIDTH="225" HEIGHT="50"><IMG SRC="activos/logouls.gif" WIDTH="150" HEIGHT="50"></TD>
  </TR>
  <TR> 
    <TD BGCOLOR="#000066">&nbsp;</TD>
  </TR>
  <TR> 
    <TD BGCOLOR="#FFFFFF" CLASS="contenido"> 
      <?PHP
			/*
			 * Script en donde se envía un e-mail a la persona elegida anteriormente en la página
			 * recomendar.php. Primero verificamos que los datos fueron ingresados por el usuario
			 * en el formulario.
			*/
			
			// Cuando los parámetros son válidos.
			if (isset($HTTP_POST_VARS['destino']) && isset($HTTP_POST_VARS['origen']) && isset($HTTP_POST_VARS['asunto']) && isset($HTTP_POST_VARS['comentario']) && is_string($HTTP_POST_VARS['destino']) && is_string($HTTP_POST_VARS['origen']) && is_string($HTTP_POST_VARS['asunto']) && is_string($HTTP_POST_VARS['comentario']))
			{
				// Librerías necesarias.
				include("../librerias/email.php");
				
				// Creamos un objeto email y hacemos la recomendación.
				$email = new email($HTTP_POST_VARS['origen'], $HTTP_POST_VARS['destino'], $HTTP_POST_VARS['asunto'], $HTTP_POST_VARS['comentario']);
				$email->enviar(1);
				
				// Imprimimos mensajes de éxito de la operación.
				echo "<P ALIGN='center'><B>Tu recomendaci&oacute;n fue enviada correctamente</B></P>";
				echo "<P ALIGN='center'>Gracias por colaborar con nosotros.</P>";
				echo "<P ALIGN='center'><A HREF=\"javascript:self.close();\" TITLE='Cerrar Ventana'><IMG SRC='../librerias/btcerrarventana.gif' BORDER='0'></A></P>";
			}
			// Cuando los parámetros no son válidos.
			else
			{
				// Librerías necesarias.
				include("../librerias/error.php");
				
				$error = new error(2, "../", "recomendar.php");
				$error->mostrar();
			}
			?>
    </TD>
  </TR>
  <TR>
    <TD BGCOLOR="#FFFFFF">&nbsp;</TD>
  </TR>
</TABLE>
</BODY>
</HTML>