<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Infraestructura - Laboratorios - Laboratorio 4</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META NAME="keywords" CONTENT="laboratorios, internet, software, redes, docencias, capacitaciones, software, computadores, pcs, sistemas, operativos, servidores, instrumentos, equipamientos, bibliotecas, campus, salas, dependencias, edificios, infraestructuras, recursos">
<META NAME="description" CONTENT="P�gina que contiene la informaci�n sobre el laboratorio 3 (Docencia y Capacitaci�n) de la Escuela Ingenier�a en Computaci�n. Se detallan sus objetivos, su equipamiento, la forma de acceso y la persona encargada.">
<META NAME="author" CONTENT="H�ctor D�az D�az - Patricio Merino D�az">
<META NAME="copyright" CONTENT="2004 Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="All">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/nivel3.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/coolmenu.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/ventanita.js"></SCRIPT>
<LINK REL="stylesheet" HREF="../../../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../../librerias/tema.css" TYPE="text/css">
</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/**
 * Script en donde incremenatamos el n�mero de visitas del tema 'Laboratorio 4'.
*/

include("../../../librerias/visitas.php");
include("../../../librerias/conexion.php");

// Creamos un objeto conexi�n y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();

// Creamos un objeto visitas e incrementamos las visitas de este tema.
$numero = new visitas($link);
$numero->incrementarTema(16);
$conexion->desconectar();
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD WIDTH="350" HEIGHT="60" COLSPAN="3" ROWSPAN="2" VALIGN="TOP">
			<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH="350" HEIGHT="60">
    		<PARAM NAME="movie" VALUE="../../../librerias/logoic.swf">
    		<PARAM NAME="quality" VALUE="high">
    		<PARAM NAME="menu" VALUE="false">
    		<EMBED SRC="../../../librerias/logoic.swf" WIDTH="350" HEIGHT="60" QUALITY="high" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" TYPE="application/x-shockwave-flash" MENU="false">
    		</EMBED>
			</OBJECT>
		</TD>
    <TD WIDTH="10" HEIGHT="60" ROWSPAN="2" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
    <TD WIDTH="20" HEIGHT="17" VALIGN="TOP"><IMG SRC="../../../librerias/curva.gif" WIDTH="20" HEIGHT="17"></TD>
    <TD WIDTH="240" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="6" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="17" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="420" HEIGHT="43" COLSPAN="4" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="545" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../../../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD><IMG SRC="../../../librerias/infogeneral.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="181"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../../../librerias/infolocal.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="127"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../../../librerias/miscelaneos.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="60" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD WIDTH="76%" CLASS="ubicacion">Ubicaci&oacute;n: <A HREF="../../../home/index.php" TITLE="Ver Home">Home</A> / <A HREF="../../index.php" TITLE="Ver Infraestructura">Infraestructura</A> / <A HREF="../index.php" TITLE="Ver Laboratorios">Laboratorios</A> / Laboratorio 4</TD>
					<TD ROWSPAN="2" WIDTH="24%" VALIGN="TOP"><IMG SRC="activos/bg4.jpg" WIDTH="110" HEIGHT="45"></TD>
				</TR>
				<TR> 
					<TD WIDTH="76%" CLASS="titulo">Laboratorio 4</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2"><IMG SRC="../../../librerias/pxgris.gif" WIDTH="460" HEIGHT="1"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="545" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../../../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD><IMG SRC="../../../librerias/temasrelacionados.gif" WIDTH="154" HEIGHT="19"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><A HREF="../../edificio/index.php" TITLE="Ver Edificio"><IMG SRC="../../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Edificio</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><A HREF="../index.php" TITLE="Ver Laboratorios"><IMG SRC="../../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Laboratorios</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../1/index.php" TITLE="Ver Laboratorio 1">&#149; Laboratorio 1</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../2/index.php" TITLE="Ver Laboratorio 2">&#149; Laboratorio 2</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../3/index.php" TITLE="Ver Laboratorio 3">&#149; Laboratorio 3</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1">&#149; Laboratorio 4</TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><A HREF="../../biblioteca/index.php?pagina=1" TITLE="Ver Biblioteca IC"><IMG SRC="../../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Biblioteca IC</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"><A HREF="../../campus/index.php" TITLE="Ver Campus"><IMG SRC="../../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Campus</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD><IMG SRC="../../../librerias/herramientas.gif" WIDTH="154" HEIGHT="19"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" CLASS="tema"> 
                        <?PHP
						/*
						 * Script en donde se muestra las opciones de herramientas que tiene el sitio Web.
						*/
						$nivel = "../../../";
						require("../../../librerias/herramientas.inc");
						?>
          </TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../../librerias/bgbox.gif" VALIGN="MIDDLE"><IMG SRC="../../../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
        </TR>
      </TABLE>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="6" HEIGHT="485" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="485" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD WIDTH="65%" CLASS="contenido"> 
						<P>Este laboratorio tiene como objetivo cubrir las necesidades de <B>Docencia y Capacitaci&oacute;n</B> frente al computador, en las asignaturas correspondientes de los alumnos de Ingenier&iacute;a en Computaci&oacute;n y de las carreras a las cuales se les presta servicio. Se cuenta con:</P>
						<UL>
							<LI>13 PC <A HREF="http://www.intel.com" TARGET="_blank" TITLE="Visitar Web de Intel Pentium">Pentium</A> II 350 MHz, 64 MB RAM.</LI>
							<LI>1 PC <A HREF="http://www.intel.com" TARGET="_blank" TITLE="Visitar Web de Intel Celeron">Celeron</A> 400 MHz, 32 MB RAM.</LI>
							<LI>Impresora <A HREF="http://www.panasonic.com" TARGET="_blank" TITLE="Visitar Web de Panasonic">Panasonic</A> KXP1190i (Carro ancho).</LI>
							<LI>1 Proyector Multimedia.</LI>
							<LI>Sistemas Operativos <A HREF="http://www.microsoft.com/windows/" TARGET="_blank" TITLE="Visitar Web de Microsoft Windows">Windows 95/98</A>.</LI>
							<LI>Instalaci&oacute;n de Red local conectada a Internet.</LI>
						</UL>
					</TD>
					<TD WIDTH="35%" ALIGN="CENTER" VALIGN="TOP"><IMG SRC="activos/logo4.jpg" WIDTH="150" HEIGHT="245"></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2">&nbsp;</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido"><B>Acceso</B></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido">Este laboratorio est&aacute; abierto solamente para los alumnos de Ingenier&iacute;a en Computaci&oacute;n que est&aacute;n cursando la (o las) asignaturas, cuyas pr&aacute;cticas se realicen all&iacute;.</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2">&nbsp;</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido"><B>Horario de Atenci&oacute;n</B></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido">Lunes a Viernes: 8:00 - 19:30 hr. S&aacute;bado: 9:30 - 13:00 hr.</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2">&nbsp;</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido"><B>Encargado</B></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2" CLASS="contenido">Profesora Danitza Altamirano (<A HREF="mailto:daltamirano@userena.cl" TITLE="daltamirano@userena.cl">daltamirano@userena.cl</A>).</TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="485" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="780" HEIGHT="55" COLSPAN="8" VALIGN="TOP" BGCOLOR="#6699CC">
            <?PHP
			/*
			 * Script en donde se muestran los e-mails de referencia a los directores y los derechos de
			 * copia del sitio Web.
			*/
			require("../../../librerias/referencia.inc");
			?>
    </TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="190" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="190" HEIGHT="1"></TD>
    <TD WIDTH="10" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="10" HEIGHT="1"></TD>
    <TD WIDTH="20" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="20" HEIGHT="1"></TD>
    <TD WIDTH="240" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="240" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
  </TR>
</TABLE>
</BODY>
</HTML>