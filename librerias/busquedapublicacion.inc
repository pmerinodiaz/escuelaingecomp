<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
  <TR> 
    <TD>&nbsp;</TD>
  </TR>
  <TR> 
    <TD CLASS="contenido"><STRONG>B&uacute;squeda de Publicaciones</STRONG></TD>
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
                  <TD WIDTH="27%" CLASS="formlabel">T&iacute;tulo publicaci&oacute;n:</TD>
                  <TD COLSPAN="2"><INPUT NAME="titulo" TYPE="text" CLASS="formtextfield" TABINDEX="1" MAXLENGTH="100" TITLE="T&iacute;tulo de la publicaci&oacute;n"></TD>
                </TR>
                <TR> 
                  <TD COLSPAN="3">&nbsp;</TD>
                </TR>
                <TR> 
                  <TD CLASS="formlabel">Filtrar b&uacute;squeda:</TD>
                  <TD COLSPAN="2"><INPUT NAME="filtro" TYPE="checkbox" VALUE="0" TABINDEX="1" onClick="setear();"></TD>
                </TR>
                <TR> 
                  <TD>&nbsp;</TD>
                  <TD WIDTH="25%" CLASS="formlabel">Autor:</TD>
                  <TD WIDTH="51%"><INPUT TYPE="text" NAME="autor" CLASS="formtextfield" TABINDEX="1" DISABLED="true" MAXLENGTH="50" TITLE="Autor de la publicaci&oacute;n"></TD>
                </TR>
                <TR> 
                  <TD>&nbsp;</TD>
                  <TD CLASS="formlabel">A&ntilde;o publicaci&oacute;n:</TD>
                  <TD><INPUT TYPE="text" NAME="anio" CLASS="formtextfield" TABINDEX="1" DISABLED="true" MAXLENGTH="4" TITLE="A&ntilde;o de la publicaci&oacute;n"></TD>
                </TR>
                <TR> 
                  <TD COLSPAN="3">&nbsp;</TD>
                </TR>
                <TR> 
                  <TD>&nbsp;</TD>
                  <TD COLSPAN="2"><INPUT NAME="buscar" TYPE="submit" VALUE="Buscar" CLASS="formbutton" TABINDEX="1" TITLE="Buscar publicaci&oacute;n en la Biblioteca IC">&nbsp;<INPUT NAME="limpiar" TYPE="reset" VALUE="Limpiar" CLASS="formbutton" TABINDEX="1" TITLE="Limpiar el formulario" onClick="deshabilitar();"></TD>
                </TR>
                <TR> 
                  <TD COLSPAN="3"><INPUT TYPE="hidden" NAME="pagina" VALUE="1"></TD>
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
</TABLE>