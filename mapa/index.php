<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Mapa del Sitio</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META NAME="keywords" CONTENT="mapas, sitios, sitemap, contenidos, todas, páginas, webs, completos, todos, temas, tópicos, enlaces, vínculos, links">
<META NAME="description" CONTENT="Página en donde se muestran todos los contenidos de este sitio Web en forma clasificada y ordenada. Cada tema se muestra en forma jerárquica con sus subtemas.">
<META NAME="author" CONTENT="Héctor Díaz Díaz - Patricio Merino Díaz">
<META NAME="copyright" CONTENT="2004 Escuela Ingeniería en Computación, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="All">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/nivel1.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/coolmenu.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/ventanita.js"></SCRIPT>
<LINK REL="stylesheet" HREF="../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../librerias/tema.css" TYPE="text/css">
</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<SCRIPT language="JavaScript" SRC="../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/*
 * Script en donde incrementamos el número de visitas del tema 'Mapa del Sitio'.
*/

// Librerías necesarias.
include("../librerias/visitas.php");
include("../librerias/conexion.php");

// Creamos un objeto conexión y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();

// Creamos un objeto visitas e incrementamos las visitas de este tema.
$numero = new visitas($link);
$numero->incrementarTema(58);
$conexion->desconectar();
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD WIDTH="350" HEIGHT="60" COLSPAN="3" ROWSPAN="2" VALIGN="TOP">
			<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH="350" HEIGHT="60">
    		<PARAM NAME="movie" VALUE="../librerias/logoic.swf">
    		<PARAM NAME="quality" VALUE="high">
    		<PARAM NAME="menu" VALUE="false">
    		<EMBED SRC="../librerias/logoic.swf" WIDTH="350" HEIGHT="60" QUALITY="high" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" TYPE="application/x-shockwave-flash" MENU="false">
    		</EMBED>
			</OBJECT>
		</TD>
    <TD WIDTH="10" HEIGHT="60" ROWSPAN="2" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
    <TD WIDTH="20" HEIGHT="17" VALIGN="TOP"><IMG SRC="../librerias/curva.gif" WIDTH="20" HEIGHT="17"></TD>
    <TD WIDTH="15" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="10" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="1" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="14" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="200" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="6" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="17" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="420" HEIGHT="43" COLSPAN="8" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="870" ROWSPAN="3" VALIGN="TOP" BACKGROUND="../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD><IMG SRC="../librerias/infogeneral.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="181"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../librerias/infolocal.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="127"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../librerias/miscelaneos.gif" WIDTH="154" HEIGHT="17"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="59" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="59" COLSPAN="8" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
		    <TR>
					<TD WIDTH="76%" CLASS="ubicacion">Ubicaci&oacute;n: <A HREF="../home/index.php" TITLE="Ver Home">Home</A> / Mapa del Sitio</TD>
					<TD ROWSPAN="2" WIDTH="24%" VALIGN="TOP"><IMG SRC="activos/bgmapa.jpg" WIDTH="110" HEIGHT="45"></TD>
				</TR>
				<TR> 
					<TD WIDTH="76%" CLASS="titulo">Mapa del Sitio</TD>
				</TR>
				<TR> 
					<TD COLSPAN="2"><IMG SRC="../librerias/pxgris.gif" WIDTH="460" HEIGHT="1"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="59" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="870" ROWSPAN="3" VALIGN="TOP" BACKGROUND="../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD><IMG SRC="../librerias/pxblanco.gif" WIDTH="154" HEIGHT="1"></TD>
				</TR>
				<TR> 
					<TD><IMG SRC="../librerias/herramientas.gif" WIDTH="154" HEIGHT="19"></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../librerias/bgbox.gif"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
				</TR>
				<TR> 
          <TD BACKGROUND="../librerias/bgbox.gif">
            <?PHP
						/*
						 * Script en donde se muestra las opciones de herramientas que tiene el sitio Web.
						*/
						$nivel = "../";
						require("../librerias/herramientas.inc");
						?>
          </TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../librerias/bgbox.gif"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
				</TR>
				<TR> 
					<TD BACKGROUND="../librerias/bgbox.gif"><IMG SRC="../librerias/pxplomo.gif" WIDTH="154" HEIGHT="1"></TD>
				</TR>
			</TABLE>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"></TD>
    <TD WIDTH="190" HEIGHT="1" VALIGN="TOP"></TD>
    <TD WIDTH="10" HEIGHT="1" VALIGN="TOP"></TD>
    <TD WIDTH="20" HEIGHT="1" VALIGN="TOP"></TD>
    <TD WIDTH="15" HEIGHT="1" VALIGN="TOP"></TD>
    <TD WIDTH="10" HEIGHT="1" VALIGN="TOP"></TD>
    <TD WIDTH="1" HEIGHT="811" ROWSPAN="2" VALIGN="TOP"><IMG SRC="../librerias/pxgris.gif" WIDTH="1" HEIGHT="870"></TD>
    <TD WIDTH="14" HEIGHT="1" VALIGN="TOP"></TD>
    <TD WIDTH="200" HEIGHT="1" VALIGN="TOP"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="6" HEIGHT="810" VALIGN="TOP"></TD>
    <TD WIDTH="235" HEIGHT="810" COLSPAN="4" VALIGN="TOP">
		  <TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><STRONG>Informaci&oacute;n General</STRONG></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD VALIGN="TOP" CLASS="tema"><A HREF="../escuela/index.php" TITLE="Ver Escuela">Escuela:</A></TD>
          <TD VALIGN="TOP" CLASS="tema">
						<A HREF="../escuela/historia/index.php" TITLE="Ver Rese&ntilde;a Hist&oacute;rica"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Rese&ntilde;a Hist&oacute;rica</A><BR>
						<A HREF="../escuela/mision/index.php" TITLE="Ver Misi&oacute;n"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Misi&oacute;n</A><BR>
						<A HREF="../escuela/objetivos/index.php" TITLE="Ver Objetivos"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Objetivos</A><BR>
						<IMG SRC="../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../escuela/objetivos/generales/index.php" TITLE="Ver Objetivos Generales">&#8226; Generales</A><BR>
						<IMG SRC="../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../escuela/objetivos/especificos/index.php" TITLE="Ver Objetivos Espec&iacute;ficos">&#8226; Espec&iacute;ficos</A>
					</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD WIDTH="23%" VALIGN="TOP" CLASS="tema"><A HREF="../carrera/index.php" TITLE="Ver Carrera">Carrera:</A></TD>
          <TD WIDTH="77%" VALIGN="TOP" CLASS="tema">
						<A HREF="../carrera/perfil/index.php" TITLE="Ver Perfil Profesional"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Perfil Profesional</A><BR>
						<A HREF="../carrera/roles/index.php" TITLE="Ver Roles"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Roles</A><BR>
						<A HREF="../carrera/objetivos/index.php" TITLE="Ver Objetivos"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Objetivos</A><BR>
						<IMG SRC="../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../carrera/objetivos/generales/index.php" TITLE="Ver Objetivos Generales">&#8226; Generales</A><BR>
						<IMG SRC="../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../carrera/objetivos/especificos/index.php" TITLE="Ver Objetivos Espec&iacute;ficos">&#8226; Espec&iacute;ficos</A><BR>
						<A HREF="../carrera/planestudio/index.php" TITLE="Ver Plan de Estudio"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Plan de Estudio</A><BR>
						<A HREF="../carrera/titulacion/index.php" TITLE="Ver Titulaci&oacute;n"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Titulaci&oacute;n</A><BR>
						<A HREF="../carrera/malla/index.php" TITLE="Ver Malla Curricular"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Malla Curricular</A>
					</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD VALIGN="TOP" CLASS="tema"><A HREF="../infraestructura/index.php" TITLE="Ver Infraestructura">Infraestructura:</A></TD>
          <TD VALIGN="TOP" CLASS="tema">
						<A HREF="../infraestructura/edificio/index.php" TITLE="Ver Edificio"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Edificio</A><BR>
						<A HREF="../infraestructura/laboratorios/index.php" TITLE="Ver Laboratorios"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Laboratorios</A><BR>
						<IMG SRC="../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../infraestructura/laboratorios/1/index.php" TITLE="Ver Laboratorio 1">&#8226; Laboratorio 1</A><BR>
						<IMG SRC="../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../infraestructura/laboratorios/2/index.php" TITLE="Ver Laboratorio 2">&#8226; Laboratorio 2</A><BR>
						<IMG SRC="../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../infraestructura/laboratorios/3/index.php" TITLE="Ver Laboratorio 3">&#8226; Laboratorio 3</A><BR>
						<IMG SRC="../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../infraestructura/laboratorios/4/index.php" TITLE="Ver Laboratorio 4">&#8226; Laboratorio 4</A><BR>
						<A HREF="../infraestructura/biblioteca/index.php?pagina=1" TITLE="Ver Biblioteca IC"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Biblioteca IC</A><BR>
						<A HREF="../infraestructura/campus/index.php" TITLE="Ver Campus"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Campus</A>
					</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD VALIGN="TOP" CLASS="tema"><A HREF="../admision/index.php" TITLE="Ver Admisi&oacute;n">Admisi&oacute;n:</A></TD>
          <TD VALIGN="TOP" CLASS="tema">
						<A HREF="../admision/postulacion/index.php" TITLE="Ver Postulaci&oacute;n"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Postulaci&oacute;n</A><BR>
            <IMG SRC="../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../admision/postulacion/uls/index.php" TITLE="Ver Postulaci&oacute;n a la ULS">&#8226; ULS</A><BR>
            <IMG SRC="../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../admision/postulacion/carrera/index.php" TITLE="Ver Postulaci&oacute;n a la Carrera">&#8226; Carrera</A><BR>
            <A HREF="../admision/calculopuntaje/index.php?pagina=1" TITLE="Ver C&aacute;lculo Puntaje"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">C&aacute;lculo Puntaje</A><BR>
            <A HREF="../admision/consultas/index.php?pagina=1" TITLE="Ver Consultas"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Consultas</A>
					</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD VALIGN="TOP" CLASS="tema"><A HREF="../investigacion/index.php" TITLE="Ver Investigaci&oacute;n">Investigaci&oacute;n:</A></TD>
          <TD VALIGN="TOP" CLASS="tema">
						<A HREF="../investigacion/lineas/index.php" TITLE="Ver L&iacute;neas de Investigaci&oacute;n"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">L&iacute;neas de Investigaci&oacute;n</A><BR>
						<A HREF="../investigacion/proyectos/index.php?pagina=1" TITLE="Ver Proyectos"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Proyectos</A><BR>
						<A HREF="../investigacion/publicaciones/index.php?pagina=1" TITLE="Ver Publicaciones"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Publicaciones</A>
					</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD VALIGN="TOP" CLASS="tema"><A HREF="../integrantes/index.php" TITLE="Ver Integrantes">Integrantes:</A></TD>
          <TD VALIGN="TOP" CLASS="tema">
						<A HREF="../integrantes/academicos/index.php" TITLE="Ver Acad&eacute;micos"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Acad&eacute;micos</A><BR>
            <IMG SRC="../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../integrantes/academicos/completa/index.php" TITLE="Ver Acad&eacute;micos Jornada Completa">&#8226; Jornada Completa</A><BR>
            <IMG SRC="../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../integrantes/academicos/media/index.php" TITLE="Ver Acad&eacute;micos Media Jornada">&#8226; Media Jornada</A><BR>
            <IMG SRC="../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../integrantes/academicos/part/index.php" TITLE="Ver Acad&eacute;micos Part-Time">&#8226; Part-Time</A><BR>
            <A HREF="../integrantes/cec/index.php" TITLE="Ver CEC"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">CEC</A><BR>
            <A HREF="../integrantes/alumnos/index.php" TITLE="Ver Alumnos"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Alumnos</A><BR>
            <A HREF="../integrantes/ex-alumnos/index.php" TITLE="Ver Ex-Alumnos"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Ex-Alumnos</A><BR>
            <A HREF="../integrantes/administrativos/index.php" TITLE="Ver Administrativos"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Administrativos</A><BR>
            <A HREF="../integrantes/ayudantes/index.php" TITLE="Ver Ayudantes"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Ayudantes</A>
					</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD VALIGN="TOP" CLASS="tema"><A HREF="../servicios/index.php" TITLE="Ver Servicios">Servicios:</A></TD>
          <TD VALIGN="TOP" CLASS="tema">
						<A HREF="../servicios/ofertas/index.php" TITLE="Ver Ofertas de Servicios"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Ofertas</A><BR>
            <A HREF="../servicios/solicitudes/index.php" TITLE="Ver Solicitudes de Servicios"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Solicitudes</A>
					</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD VALIGN="TOP" CLASS="tema"><A HREF="../software/index.php" TITLE="Ver Software">Software:</A></TD>
          <TD VALIGN="TOP" CLASS="tema">
						<A HREF="../software/nuestros/index.php" TITLE="Ver Nuestros Software"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Nuestros</A><BR>
            <A HREF="../software/terceros/index.php" TITLE="Ver Software de Terceros"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">De Terceros</A><BR>
            <A HREF="../software/estadisticas/index.php" TITLE="Ver Estad&iacute;sticas de Software"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Estad&iacute;sticas</A>
					</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD VALIGN="TOP" CLASS="tema"><A HREF="../tutoriales/index.php" TITLE="Ver Tutoriales">Tutoriales:</A></TD>
          <TD VALIGN="TOP" CLASS="tema">
						<A HREF="../tutoriales/nuestros/index.php" TITLE="Ver Nuestros Tutoriales"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Nuestros</A><BR>
            <A HREF="../tutoriales/terceros/index.php" TITLE="Ver Tutoriales de Terceros"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">De Terceros</A><BR>
            <A HREF="../tutoriales/estadisticas/index.php" TITLE="Ver Estad&iacute;sticas de Tutoriales"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Estad&iacute;sticas</A>
					</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="tema"><A HREF="../faq/index.php?pagina=1" TITLE="Ver Preguntas Frecuentes"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Preguntas Frecuentes</A></TD>
        </TR>
        <TR>
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
      </TABLE>
		</TD>
    <TD WIDTH="10" HEIGHT="810" VALIGN="TOP"></TD>
    <TD WIDTH="14" HEIGHT="810" VALIGN="TOP"></TD>
    <TD WIDTH="200" HEIGHT="810" VALIGN="TOP">
		  <TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><STRONG>Informaci&oacute;n Local</STRONG></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="tema"><A HREF="../asignaturas/index.php" TITLE="Ver Asignaturas"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Asignaturas</A></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR CLASS="tema"> 
          <TD COLSPAN="2" CLASS="tema"><A HREF="../pruebas/index.php" TITLE="Ver Banco de Pruebas"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Banco de Pruebas</A></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="tema"><A HREF="../calendario/index.php" TITLE="Ver Calendario"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Calendario</A></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="tema"><A HREF="../horarios/index.php" TITLE="Ver Horarios"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Horarios</A></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="tema"><A HREF="../intranet/index.php" TARGET="_blank" TITLE="Ver Intranet"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Intranet</A></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD WIDTH="23%" VALIGN="TOP" CLASS="tema"><A HREF="../practica/index.php" TITLE="Ver Pr&aacute;ctica">Pr&aacute;ctica:</A></TD>
          <TD WIDTH="77%" VALIGN="TOP" CLASS="tema">
						<A HREF="../practica/reglamento/index.php" TITLE="Ver Reglamento de Pr&aacute;ctica"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Reglamento</A><BR> 
            <A HREF="../practica/ofertas/index.php?pagina=1" TITLE="Ver Ofertas de Pr&aacute;ctica"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Ofertas</A>
					</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD VALIGN="TOP" CLASS="tema"><A HREF="../tesis/index.php" TITLE="Ver Tesis">Tesis:</A></TD>
          <TD VALIGN="TOP" CLASS="tema">
						<A HREF="../tesis/reglamento/index.php" TITLE="Ver Reglamento de Tesis"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Reglamento</A><BR> 
            <A HREF="../tesis/ofertas/index.php?pagina=1" TITLE="Ver Ofertas de Tesis"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Ofertas</A><BR> <A HREF="../tesis/historial/index.php?pagina=1" TITLE="Ver Historial de Tesis"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Historial</A>
					</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><STRONG>Miscel&aacute;neos</STRONG></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" VALIGN="TOP" CLASS="tema"><A HREF="../foros/index.php" TITLE="Ver Foros"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Foros</A></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="tema"><A HREF="../encuestas/index.php?pagina=1" TITLE="Ver Encuestas"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Encuestas</A></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="tema"><A HREF="../chat/index.php" TITLE="Ver Chat"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Chat</A></TD>
        </TR>
        <TR>
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR>
          <TD COLSPAN="2" CLASS="tema"><A HREF="../radio/index.php" TITLE="Ver Radio"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Radio</A></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="tema"><A HREF="../sitios/index.php?pagina=1" TITLE="Ver Sitios de Inter&eacute;s"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Sitios de Inter&eacute;s</A></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><STRONG><A HREF="../contacto/index.php" TITLE="Ver Cont&aacute;ctenos">Cont&aacute;ctenos</A></STRONG></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><STRONG><A HREF="../noticias/index.php" TITLE="Ver Noticias">Noticias</A></STRONG></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="tema">
						<A HREF="../noticias/universidad/index.php?pagina=1" TITLE="Ver Noticias de la Universidad"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Universidad</A><BR> 
            <A HREF="../noticias/tecnologia/index.php?pagina=1" TITLE="Ver Noticias de Tecnolog&iacute;a"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Tecnolog&iacute;a</A>
					</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><A HREF="../busqueda/index.php" TITLE="Ver B&uacute;squeda"><STRONG>B&uacute;squeda</STRONG></A></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="tema">
						<A HREF="../busqueda/web/index.php" TITLE="Ver B&uacute;squeda en Este Web"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">En este Web</A><BR>
						<A HREF="../busqueda/internet/index.php" TITLE="Ver B&uacute;squeda en Internet"><IMG SRC="../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">En Internet</A>
					</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><STRONG><A HREF="../webmail/index.php" TITLE="Ver Webmail">Webmail</A></STRONG></TD>
        </TR>
      </TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="810"></TD>
  </TR>
  <TR>
    <TD WIDTH="780" HEIGHT="55" COLSPAN="12" VALIGN="TOP" BGCOLOR="#6699CC">
			<?PHP
			/*
			 * Script en donde se muestran los e-mails de referencia a los directores y los derechos de
			 * copia del sitio Web.
			*/
			require("../librerias/referencia.inc");
	  	?>
		</TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="190" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="190" HEIGHT="1"></TD>
    <TD WIDTH="10" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="10" HEIGHT="1"></TD>
    <TD WIDTH="20" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="20" HEIGHT="1"></TD>
    <TD WIDTH="15" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="15" HEIGHT="1"></TD>
    <TD WIDTH="10" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="10" HEIGHT="1"></TD>
    <TD WIDTH="1" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="1"></TD>
    <TD WIDTH="14" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="14" HEIGHT="1"></TD>
    <TD WIDTH="200" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="200" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
  </TR>
</TABLE>
</BODY>
</HTML>