<?PHP echo $descripcion ?>
<TABLE WIDTH="100%" BORDER="1" CELLPADDING="0" CELLSPACING="0" BORDERCOLOR="#F1F1F1">
	<TR> 
		<TD>
			<FORM ACTION=<?PHP echo $destino ?> METHOD="post" NAME="formulario" onSubmit="return validarFormulario();">
				<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0">
					<TR> 
						<TD COLSPAN="3">&nbsp;</TD>
					</TR>
					<TR> 
						<TD WIDTH="30%" CLASS="formlabel">Nombres:</TD>
						<TD><INPUT NAME="nombres" TYPE="text" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="50" TITLE="Primer y segundo nombre"> <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
					</TR>
					<TR> 
						<TD CLASS="formlabel">Apellido Paterno:</TD>
						<TD><INPUT NAME="paterno" TYPE="text" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="25" TITLE="Apellido paterno"> <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
					</TR>
					<TR> 
						<TD CLASS="formlabel">Apellido Materno:</TD>
						<TD WIDTH="70%"><INPUT NAME="materno" TYPE="text" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="25" TITLE="Apellido materno"></TD>
					</TR>
					<TR> 
						<TD CLASS="formlabel">E-mail:</TD>
						<TD WIDTH="70%"><INPUT TYPE="text" NAME="email" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="50" TITLE="Correo electr&oacute;nico"> <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
					</TR>
					<TR> 
						<TD CLASS="formlabel">Asunto:</TD>
						<TD WIDTH="70%"><INPUT TYPE="text" NAME="asunto" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="100" TITLE="Asunto del mensaje"> <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
					</TR>
					<TR> 
						<TD COLSPAN="3" CLASS="formlabel">Recibir notificaci&oacute;n por e-mail para la respuesta 
							<INPUT TYPE="radio" NAME="notificacion" VALUE="Si" TABINDEX="1">Si 
							<INPUT NAME="notificacion" TYPE="radio" VALUE="No" TABINDEX="1" CHECKED>No</TD>
					</TR>
					<TR> 
						<TD COLSPAN="3">&nbsp;</TD>
					</TR>
					<TR> 
						<TD COLSPAN="2" ALIGN="CENTER" CLASS="formlabel">Texto:</TD>
					</TR>
					<TR> 
						<TD COLSPAN="2" ALIGN="CENTER"><TEXTAREA NAME="texto" ROWS="8" TABINDEX="1" CLASS="formtextarea" TITLE="Texto del mensaje"></TEXTAREA> <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
					</TR>
					<TR>
						<TD COLSPAN="2">&nbsp;</TD>
					</TR>
					<TR> 
						<TD COLSPAN="2" CLASS="contenido">&nbsp;<FONT COLOR="#CC0000">*</FONT> Datos obligatorios</TD>
					</TR>
					<TR> 
						<TD COLSPAN="2">&nbsp;<?PHP echo $ocultos ?></TD>
					</TR>
					<TR> 
						<TD COLSPAN="2" ALIGN="CENTER"><INPUT TYPE="submit" NAME="enviar" VALUE="Enviar" CLASS="formbutton" TABINDEX="1" TITLE="Enviar el mensaje">&nbsp;<INPUT TYPE="RESET" NAME="limpiar" VALUE="Limpiar" CLASS="formbutton" TABINDEX="1" TITLE="Limpiar el formulario"></TD>
					</TR>
				</TABLE>
			</FORM>
		</TD>
	</TR>
</TABLE>