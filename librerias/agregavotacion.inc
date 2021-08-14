<TR>
	<TD CLASS='contenido'>Por favor, ingresa la nota que le pones a este <?PHP echo $tipo ?> y luego pulsa VOTAR.</TD>
</TR>
<TR>
	<TD>
		<TABLE WIDTH="100%" BORDER="1" CELLPADDING="0" CELLSPACING="0" BORDERCOLOR="#F1F1F1">
			<TR> 
				<TD>
					<FORM ACTION="actualizar.php" METHOD="post" NAME="formulario">
						<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0">
							<TR>
								<TD COLSPAN="8">&nbsp;</TD>
							</TR>
							<TR>
								<TD ALIGN="CENTER" CLASS="formlabel"><INPUT TYPE="radio" NAME="nota" VALUE="1.0"></TD>
								<TD ALIGN="CENTER" CLASS="formlabel"><INPUT TYPE="radio" NAME="nota" VALUE="2.0"></TD>
								<TD ALIGN="CENTER" CLASS="formlabel"><INPUT TYPE="radio" NAME="nota" VALUE="3.0"></TD>
								<TD ALIGN="CENTER" CLASS="formlabel"><INPUT NAME="nota" TYPE="radio" VALUE="4.0" CHECKED></TD>
								<TD ALIGN="CENTER" CLASS="formlabel"><INPUT TYPE="radio" NAME="nota" VALUE="5.0"></TD>
								<TD ALIGN="CENTER" CLASS="formlabel"><INPUT TYPE="radio" NAME="nota" VALUE="6.0"></TD>
								<TD ALIGN="CENTER" CLASS="formlabel"><INPUT TYPE="radio" NAME="nota" VALUE="7.0"></TD>
								<TD ROWSPAN="2" ALIGN="CENTER"><INPUT NAME="votar" TYPE="submit" CLASS="formbutton" TABINDEX="1" VALUE="Votar" TITLE="Votar por el <?PHP echo $tipo ?>"></TD>
							</TR>
							<TR>
								<TD ALIGN="CENTER" CLASS="formlabel">1.0</TD>
								<TD ALIGN="CENTER" CLASS="formlabel">2.0</TD>
								<TD ALIGN="CENTER" CLASS="formlabel">3.0</TD>
								<TD ALIGN="CENTER" CLASS="formlabel">4.0</TD>
								<TD ALIGN="CENTER" CLASS="formlabel">5.0</TD>
								<TD ALIGN="CENTER" CLASS="formlabel">6.0</TD>
								<TD ALIGN="CENTER" CLASS="formlabel">7.0</TD>
							</TR>
							<TR>
								<TD COLSPAN="8"><?PHP echo "<INPUT NAME='id' TYPE='hidden' VALUE='$id'>"; ?></TD>
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