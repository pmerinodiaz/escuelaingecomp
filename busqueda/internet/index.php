<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - B&uacute;squeda - Internet</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META NAME="keywords" CONTENT="búsquedas, buscadores, motores, internet, web, vínculos, enlaces, links, buscar, resultados, obtenciones, salidas, buscar">
<META NAME="description" CONTENT="En esta sección podrás utilizar los buscadores más conocidos y famosos de Internet. Tan sólo introduce el texto en tu buscador favorito y luego presiona buscar.">
<META NAME="author" CONTENT="Héctor Díaz Díaz - Patricio Merino Díaz">
<META NAME="copyright" CONTENT="2004 Escuela Ingeniería en Computación, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="All">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/nivel2.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/coolmenu.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/ventanita.js"></SCRIPT>
<LINK REL="stylesheet" HREF="../../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../librerias/tema.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../librerias/formulario.css" TYPE="text/css">
</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/*
 * Script en donde incrementamos el número de visitas del tema 'Búsqueda en Internet'.
*/

// Librerías necesarias.
include("../../librerias/visitas.php");
include("../../librerias/conexion.php");

// Creamos un objeto conexión y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();

// Creamos un objeto visitas e incrementamos las visitas para este tema.
$numero = new visitas($link);
$numero->incrementarTema(63);
$conexion->Desconectar();
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD WIDTH="350" HEIGHT="60" COLSPAN="3" ROWSPAN="2" VALIGN="TOP">
			<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH="350" HEIGHT="60">
    		<PARAM NAME="movie" VALUE="../../librerias/logoic.swf">
    		<PARAM NAME="quality" VALUE="high">
    		<PARAM NAME="menu" VALUE="false">
    		<EMBED SRC="../../librerias/logoic.swf" WIDTH="350" HEIGHT="60" QUALITY="high" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" TYPE="application/x-shockwave-flash" MENU="false">
    		</EMBED>
			</OBJECT>
		</TD>
    <TD WIDTH="10" HEIGHT="60" ROWSPAN="2" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
    <TD WIDTH="20" HEIGHT="17" VALIGN="TOP"><IMG SRC="../../librerias/curva.gif" WIDTH="20" HEIGHT="17"></TD>
    <TD WIDTH="240" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="6" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="17" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="420" HEIGHT="43" COLSPAN="4" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="590" ROWSPAN="3" VALIGN="TOP" BACKGROUND="../../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD><IMG SRC="../../librerias/infogeneral.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="181"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../../librerias/infolocal.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="127"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../../librerias/miscelaneos.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="60" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD WIDTH="76%" CLASS="ubicacion">Ubicaci&oacute;n: <A HREF="../../home/index.php" TITLE="Ver Home">Home</A> / <A HREF="../index.php" TITLE="Ver B&uacute;squeda">B&uacute;squeda</A> / En Internet</TD>
					<TD ROWSPAN="2" WIDTH="24%" VALIGN="TOP"><IMG SRC="activos/bginternet.jpg" WIDTH="110" HEIGHT="45"></TD>
				</TR>
				<TR> 
					<TD WIDTH="76%" CLASS="titulo">B&uacute;squeda en Internet</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2"><IMG SRC="../../librerias/pxgris.gif" WIDTH="460" HEIGHT="1"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="590" ROWSPAN="3" VALIGN="TOP" BACKGROUND="../../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD><IMG SRC="../../librerias/temasrelacionados.gif" WIDTH="154" HEIGHT="19"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../web/index.php" TITLE="Ver B&uacute;squeda en este Web"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">En este Web</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">En Internet</TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD><IMG SRC="../../librerias/herramientas.gif" WIDTH="154" HEIGHT="19"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"> 
            <?PHP
						/*
						 * Script en donde se muestra las opciones de herramientas que tiene el sitio Web.
						*/
						$nivel = "../../";
						require("../../librerias/herramientas.inc");
						?>
          </TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
        </TR>
      </TABLE>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="6" HEIGHT="110" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="110" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" HEIGHT="98" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD WIDTH="31%" HEIGHT="98" ALIGN="CENTER" VALIGN="TOP"><IMG SRC="activos/logointernet.gif" WIDTH="80" HEIGHT="90"></TD>
          <TD CLASS="contenido" VALIGN="TOP" WIDTH="69%">En esta secci&oacute;n podr&aacute;s utilizar los buscadores m&aacute;s conocidos y famosos de Internet. Tan s&oacute;lo introduce el texto en tu buscador favorito y luego presiona BUSCAR.</TD>
        </TR>
      </TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="110" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="6" HEIGHT="420" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="420" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
			<TR>
				<TD>
					<TABLE WIDTH="460" BORDER="0" CELLPADDING="0" CELLSPACING="0">
              <TR> 
                <TD WIDTH="224" ALIGN="CENTER" BGCOLOR="#F1F1F1" CLASS="contenido"><STRONG>Google</STRONG></TD>
                <TD WIDTH="233" ALIGN="CENTER" BGCOLOR="#F1F1F1" CLASS="contenido"><STRONG>Yahoo!</STRONG></TD>
              </TR>
              <TR> 
                <TD>
									<FORM ACTION="http://www.google.com/search" METHOD="GET" NAME="google" TARGET="_blank">
                    <TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
                      <TR> 
                        <TD ALIGN="CENTER" BGCOLOR="#F1F1F1"><INPUT name="q" TYPE="text" value="" size="25" maxlength="255" TITLE="Una palabra o frase de Internet" CLASS="formtextfield"></TD>
                      </TR>
                      <TR> 
                        <TD ALIGN="CENTER" BGCOLOR="#F1F1F1"><INPUT NAME="buscar" TYPE="submit" CLASS="formbutton" VALUE="Buscar" TITLE="Buscar una palabra o frase de Internet"></TD>
                      </TR>
                    </TABLE>
                  </FORM>
								</TD>
                <TD>
									<FORM ACTION="http://search.espanol.yahoo.com/search/espanol" METHOD="GET" NAME="yahoo" TARGET="_blank">
                    <TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
                      <TR> 
                        <TD ALIGN="CENTER" BGCOLOR="#F1F1F1"><INPUT name="p" TYPE="text" size="25" maxlength="255" TITLE="Una palabra o frase de Internet" CLASS="formtextfield"></TD>
                      </TR>
                      <TR> 
                        <TD ALIGN="CENTER" BGCOLOR="#F1F1F1"><INPUT NAME="buscar" TYPE="submit" CLASS="formbutton" VALUE="Buscar" TITLE="Buscar una palabra o frase de Internet"></TD>
                      </TR>
                    </TABLE>
                  </FORM>
								</TD>
              </TR>
              <TR> 
                <TD COLSPAN="2">&nbsp;</TD>
              </TR>
              <TR> 
                <TD ALIGN="CENTER" BGCOLOR="#F1F1F1" CLASS="contenido"><STRONG>Altavista</STRONG></TD>
                <TD ALIGN="CENTER" BGCOLOR="#F1F1F1" CLASS="contenido"><STRONG>WebCrawler</STRONG></TD>
              </TR>
              <TR> 
                <TD>
									<FORM ACTION="http://www.altavista.digital.com/cgi-bin/query" METHOD="GET" NAME="altavista" TARGET="_blank">
                    <TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
                      <TR> 
                        <TD ALIGN="CENTER" BGCOLOR="#F1F1F1"><INPUT TYPE="hidden" NAME="pg" VALUE="q"><INPUT name="q" TYPE="text" ID="q" size="25" maxlength="255" TITLE="Una palabra o frase de Internet" CLASS="formtextfield"></TD>
                      </TR>
                      <TR> 
                        <TD ALIGN="CENTER" BGCOLOR="#F1F1F1"><INPUT NAME="buscar" TYPE="submit" CLASS="formbutton" VALUE="Buscar" TITLE="Buscar una palabra o frase de Internet"></TD>
                      </TR>
                    </TABLE>
                  </FORM>
								</TD>
                <TD>
									<FORM ACTION="http://webcrawler.com/cgi-bin/WebQuery" METHOD="POST" NAME="google" TARGET="_blank">
                    <TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
                      <TR> 
                        <TD ALIGN="CENTER" BGCOLOR="#F1F1F1"><INPUT NAME="searchText" TYPE="text" SIZE="25" MAXLENGTH="255" TITLE="Una palabra o frase de Internet" CLASS="formtextfield"><INPUT TYPE="hidden" NAME="andOr" VALUE="and"><INPUT TYPE="hidden" NAME="maxHits" VALUE="100"></TD>
                      </TR>
                      <TR> 
                        <TD ALIGN="CENTER" BGCOLOR="#F1F1F1"><INPUT NAME="buscar" TYPE="submit" CLASS="formbutton" VALUE="Buscar" TITLE="Buscar una palabra o frase de Internet"></TD>
                      </TR>
                    </TABLE>
                  </FORM>
								</TD>
              </TR>
              <TR> 
                <TD COLSPAN="2">&nbsp;</TD>
              </TR>
              <TR> 
                <TD ALIGN="CENTER" BGCOLOR="#F1F1F1" CLASS="contenido"><STRONG>Lycos</STRONG></TD>
                <TD ALIGN="CENTER" BGCOLOR="#F1F1F1" CLASS="contenido"><STRONG>MSN</STRONG></TD>
              </TR>
              <TR> 
                <TD>
									<FORM ACTION="http://www.es.lycos.de/cgi-bin/pursuit" METHOD="GET" NAME="lycos" TARGET="_blank">
                    <TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
                      <TR> 
                        <TD ALIGN="CENTER" BGCOLOR="#F1F1F1"><INPUT name="query" SIZE="25" maxLength="255" TITLE="Una palabra o frase de Internet" CLASS="formtextfield"><INPUT type="hidden" value="lycos" name="cat"><INPUT type="hidden" value="smn" name="d"><INPUT type="hidden" value="and" name="matchmode"></TD>
                      </TR>
                      <TR> 
                        <TD ALIGN="CENTER" BGCOLOR="#F1F1F1"><INPUT NAME="buscar" TYPE="submit" CLASS="formbutton" VALUE="Buscar" TITLE="Buscar una palabra o frase de Internet"></TD>
                      </TR>
                    </TABLE>
                  </FORM>
								</TD>
                <TD>
									<FORM ACTION="http://search.msn.es/results.asp" METHOD="GET" NAME="msn" TARGET="_blank">
                    <TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
                      <TR> 
                        <TD ALIGN="CENTER" BGCOLOR="#F1F1F1"><INPUT name="q" id="q" SIZE="25" maxLength="255" vcard_name="SearchText" TITLE="Una palabra o frase de Internet" CLASS="formtextfield"><INPUT type="hidden" value="cDWNLD" name="FORM"><INPUT type="hidden" value="CHECKED" name="RS"></TD>
                      </TR>
                      <TR> 
                        <TD ALIGN="CENTER" BGCOLOR="#F1F1F1"><INPUT NAME="buscar" TYPE="submit" CLASS="formbutton" VALUE="Buscar" TITLE="Buscar una palabra o frase de Internet"></TD>
                      </TR>
                    </TABLE>
                  </FORM>
								</TD>
              </TR>
              <TR> 
                <TD COLSPAN="2">&nbsp;</TD>
              </TR>
              <TR> 
                <TD ALIGN="CENTER" BGCOLOR="#F1F1F1" CLASS="contenido"><STRONG>Ozu</STRONG></TD>
                <TD ALIGN="CENTER" BGCOLOR="#F1F1F1" CLASS="contenido"><STRONG>Hotbot</STRONG></TD>
              </TR>
              <TR> 
                <TD>
									<FORM ACTION="http://buscador.ozu.es/ozu_search.php" METHOD="GET" NAME="ozu" TARGET="_blank">
										<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
                      <TR> 
                        <TD ALIGN="CENTER" BGCOLOR="#F1F1F1"><INPUT name="q" SIZE="25" maxLength="255" TITLE="Una palabra o frase de Internet" CLASS="formtextfield"><INPUT type="hidden" name="as_dt"><INPUT type="hidden" name="busqueda"><INPUT type="hidden" name="as_sitesearch"><INPUT type="hidden" value="lang_es name=lr"></TD>
                      </TR>
                      <TR> 
                        <TD ALIGN="CENTER" BGCOLOR="#F1F1F1"><INPUT NAME="buscar" TYPE="submit" CLASS="formbutton" VALUE="Buscar" TITLE="Buscar una palabra o frase de Internet"></TD>
                      </TR>
                    </TABLE>
                  </FORM>
								</TD>
                <TD>
									<FORM ACTION="http://www.hotbot.com/" METHOD="GET" NAME="hotbot" TARGET="_blank">
                    <TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
                      <TR> 
                        <TD ALIGN="CENTER" BGCOLOR="#F1F1F1"><INPUT name="MT" SIZE="25" maxLength="255" TITLE="Una palabra o frase de Internet" CLASS="formtextfield"><INPUT type="hidden" value="2" name="_v"></TD>
                      </TR>
                      <TR> 
                        <TD ALIGN="CENTER" BGCOLOR="#F1F1F1"><INPUT NAME="buscar" TYPE="submit" CLASS="formbutton" VALUE="Buscar" TITLE="Buscar una palabra o frase de Internet"></TD>
                      </TR>
                    </TABLE>
                  </FORM>
								</TD>
              </TR>
            </TABLE>
				</TD>
			</TR>
		</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="420" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="780" HEIGHT="55" COLSPAN="8" VALIGN="TOP" BGCOLOR="#6699CC">
      <?PHP
			/*
			 * Script en donde se muestran los e-mails de referencia a los directores y los derechos de
			 * copia del sitio Web.
			*/
			require("../../librerias/referencia.inc");
			?>
    </TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="190" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="190" HEIGHT="1"></TD>
    <TD WIDTH="10" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="10" HEIGHT="1"></TD>
    <TD WIDTH="20" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="20" HEIGHT="1"></TD>
    <TD WIDTH="240" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="240" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
  </TR>
</TABLE>
</BODY>
</HTML>