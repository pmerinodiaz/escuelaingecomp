<TR>
	<TD CLASS="contenido">Por favor, completa los siguientes datos y pulsa ENVIAR.</TD>
</TR>
<TR>
	<TD>
		<TABLE WIDTH="100%" BORDER="1" CELLPADDING="0" CELLSPACING="0" BORDERCOLOR="#F1F1F1">
			<TR> 
				<TD>
					<FORM ACTION="grabar.php" METHOD="post" NAME="formulario" onSubmit="return validarFormulario();">
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
								<TD COLSPAN="3">&nbsp;</TD>
							</TR>
							<TR> 
								<TD COLSPAN="2" ALIGN="CENTER" CLASS="formlabel">Texto:</TD>
							</TR>
							<TR> 
								<TD COLSPAN="2" ALIGN="CENTER"><TEXTAREA NAME="texto" ROWS="8" TABINDEX="1" CLASS="formtextarea" TITLE="Texto del comentario"></TEXTAREA> <SPAN CLASS="contenido"><FONT COLOR="#CC0000">*</FONT></SPAN></TD>
							</TR>
							<TR> 
								<TD COLSPAN="2">&nbsp;</TD>
							</TR>
							<TR> 
								<TD COLSPAN="2" CLASS="contenido">&nbsp;<FONT COLOR="#CC0000">*</FONT> Datos obligatorios</TD>
							</TR>
							<TR> 
								<TD COLSPAN="2"><?PHP echo "<INPUT NAME='id' TYPE='hidden' VALUE='$id'>"; ?></TD>
							</TR>
							<TR> 
								<TD COLSPAN="2" ALIGN="CENTER"><INPUT TYPE="submit" NAME="enviar" VALUE="Enviar" CLASS="formbutton" TABINDEX="1" TITLE="Enviar el comentario">&nbsp;<INPUT TYPE="RESET" NAME="limpiar" VALUE="Limpiar" CLASS="formbutton" TABINDEX="1" TITLE="Limpiar el formulario"></TD>
							</TR>
						</TABLE>
					</FORM>
				</TD>
			</TR>
		</TABLE>
	</TD>
</TR>
<TR> 
	<TD>&nbsp;</TD>
</TR>