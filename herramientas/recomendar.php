<HTML>
<HEAD>
<TITLE>Recomendar este Web</TITLE>
<META HTTP-EQUIV="content type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META NAME="keywords" CONTENT="recomendaciones, recomendar, webs, correos, enviar, comentarios">
<META NAME="description" CONTENT="Página en donde se muestra el formulario de recepción de datos para que un usuario pueda enviarle una recomendación de este sitio Web a otro usuario.">
<META NAME="author" CONTENT="Héctor Díaz Díaz - Patricio Merino Díaz">
<META NAME="copyright" CONTENT="2004 Escuela Ingeniería en Computación, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="None">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAJE="JavaScript" SRC="../librerias/valida.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
<!--
function setearFoco()
{
	document.formulario.destino.focus();
}
function validarFormulario()
{
	if(validarCampo(document.formulario.destino,isEmail,false)&&
		 validarCampo(document.formulario.origen,isEmail,false)&&
		 validarCampo(document.formulario.asunto,isAny,false)&&
		 validarCampo(document.formulario.comentario,isAny,false))
  	return true;
	else return false;
}
//-->
</SCRIPT>
<LINK REL="stylesheet" HREF="../librerias/formulario.css" TYPE="text/css">
<BODY BGCOLOR="#E3E9EC" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0" onLoad="setearFoco();">
<TABLE WIDTH="400" BORDER="0" CELLSPACING="0" CELLPADDING="0">
  <TR> 
    <TD ALIGN="CENTER" BGCOLOR="#FFFFFF"><IMG SRC="activos/titulo.gif" WIDTH="225" HEIGHT="50"><IMG SRC="activos/logouls.gif" WIDTH="150" HEIGHT="50"></TD>
  </TR>
  <TR> 
    <TD BGCOLOR="#000066">&nbsp;</TD>
  </TR>
  <TR> 
    <TD>
    	<TR> 
      	<TD>
					<FORM ACTION="enviar.php" NAME="formulario" METHOD="post" onSubmit="return validarFormulario();">
						<TABLE WIDTH="400" BORDER="0" CELLPADDING="0" BGCOLOR="#E3E9EC">
							<TR> 
								<TD COLSPAN="2">&nbsp;</TD>
							</TR>
							<TR> 
								<TD WIDTH="20%" CLASS="formlabel">Enviar a:</TD>
								<TD WIDTH="80%"><INPUT NAME="destino" TYPE="text" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="50" TITLE="Correo electr&oacute;nico al cual va dirigido"></TD>
							</TR>
							<TR> 
								<TD WIDTH="20%" CLASS="formlabel">De:</TD>
								<TD WIDTH="80%"><INPUT NAME="origen" TYPE="text" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="50" TITLE="Correo electr&oacute;nico que remite"></TD>
							</TR>
							<TR> 
								<TD WIDTH="20%" CLASS="formlabel">Asunto:</TD>
								<TD WIDTH="80%"><INPUT NAME="asunto" TYPE="text" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="100" TITLE="Asunto de la recomendaci&oacute;n"></TD>
							</TR>
							<TR> 
								<TD COLSPAN="2">&nbsp;</TD>
							</TR>
							<TR> 
								<TD COLSPAN="2" ALIGN="CENTER" CLASS="formlabel">Comentario:</TD>
							</TR>
							<TR> 
								<TD COLSPAN="2" ALIGN="CENTER"><TEXTAREA NAME="comentario" ROWS="8" CLASS="formtextarea" TABINDEX="1" TITLE="Texto de la recomendaci&oacute;n"></TEXTAREA></TD>
							</TR>
							<TR> 
								<TD COLSPAN="2" ALIGN="CENTER"><INPUT TYPE="submit" NAME="enviar" VALUE="Enviar" CLASS="formbutton" TABINDEX="1" TITLE="Enviar la recomendaci&oacute;n de este Web">&nbsp;<INPUT TYPE="RESET" NAME="limpiar" VALUE="Limpiar" CLASS="formbutton" TABINDEX="1" TITLE="Limpiar el formulario"></TD>
							</TR>
							<TR> 
								<TD COLSPAN="2">&nbsp;</TD>
							</TR>
						</TABLE>
          </FORM>
				</TD>
      </TR>
		</TD>
	</TR>
</TABLE>
</BODY>
</HTML>