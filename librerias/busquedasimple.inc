<TR> 
	<TD>&nbsp;</TD>
</TR>
<TR> 
	<TD CLASS="contenido"><STRONG><?PHP echo $titulo ?></STRONG></TD>
</TR>
<TR> 
	<TD>
		<TABLE WIDTH="100%" BORDER="1" CELLPADDING="0" CELLSPACING="0" BORDERCOLOR="#F1F1F1">
			<TR> 
				<TD>
					<FORM ACTION="buscar.php" METHOD="GET" NAME="formulario" onSubmit="return validarFormulario();">
						<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0">
							<TR> 
								<TD COLSPAN="3">&nbsp;</TD>
							</TR>
							<TR> 
								<TD WIDTH="30%" CLASS="formlabel">Palabra a buscar:</TD>
								<TD WIDTH="70%" COLSPAN="2"><INPUT NAME="palabra" TYPE="text" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="255" TITLE="Una palabra o frase a buscar en <?PHP echo $comentario ?>">&nbsp;<INPUT NAME="buscar" TYPE="submit" VALUE="Buscar" CLASS="formbutton" TABINDEX="1" TITLE="Buscar la palabra o frase en <?PHP echo $comentario ?>"></TD>
							</TR>
							<TR> 
								<TD COLSPAN="3"><?PHP echo $ocultos ?><INPUT TYPE="hidden" NAME="pagina" VALUE="1"></TD>
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