<HTML>
<HEAD>
<TITLE>Recomendar este Web</TITLE>
<META HTTP-EQUIV="content type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META NAME="keywords" CONTENT="recomendaciones, recomendar, webs, correos, enviar, comentarios">
<META NAME="description" CONTENT="En esta p�gina se env�a un correo electr�nico a la persona con la direcci�n ingresada anteriormente por el usuario. Se env�a una recomendaci�n de este Web.">
<META NAME="author" CONTENT="H�ctor D�az D�az - Patricio Merino D�az">
<META NAME="copyright" CONTENT="2004 Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile">
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
			 * Script en donde se env�a un e-mail a la persona elegida anteriormente en la p�gina
			 * recomendar.php. Primero verificamos que los datos fueron ingresados por el usuario
			 * en el formulario.
			*/
			
			// Cuando los par�metros son v�lidos.
			if (isset($_POST['destino']) && isset($_POST['origen']) && isset($_POST['asunto']) && isset($_POST['comentario']) && is_string($_POST['destino']) && is_string($_POST['origen']) && is_string($_POST['asunto']) && is_string($_POST['comentario']))
			{
				// Librer�as necesarias.
				include("../librerias/email.php");
				
				// Creamos un objeto email y hacemos la recomendaci�n.
				$email = new email($_POST['origen'], $_POST['destino'], $_POST['asunto'], $_POST['comentario']);
				$email->enviar(1);
				
				// Imprimimos mensajes de �xito de la operaci�n.
				echo "<P ALIGN='center'><B>Tu recomendaci&oacute;n fue enviada correctamente</B></P>";
				echo "<P ALIGN='center'>Gracias por colaborar con nosotros.</P>";
				echo "<P ALIGN='center'><A HREF=\"javascript:self.close();\" TITLE='Cerrar Ventana'><IMG SRC='../librerias/btcerrarventana.gif' BORDER='0'></A></P>";
			}
			// Cuando los par�metros no son v�lidos.
			else
			{
				// Librer�as necesarias.
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