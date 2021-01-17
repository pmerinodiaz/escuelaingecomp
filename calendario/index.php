<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Calendario</TITLE>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META NAME="keywords" CONTENT="calendarios, académicos, docentes, programación, fechas, plazos, acontecimientos, universidades, serena, la serena, departamentos, matemáticas, escuelas, ingenierías, computación, uls, noticias, novedades">
<META NAME="description" CONTENT="En esta página se muestra el calendario académico del año actual. El calendario académico es el único informativo de fechas y plazos para diversos acontecimientos en nuestra Escuela y Universidad.">
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
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/*
 * Script en donde incrementamos el número de visitas del tema 'Calendario Académico'.
*/

// Librerías necesarias.
include("../librerias/visitas.php");
include("../librerias/conexion.php");

// Creamos un objeto conexión y nos conectamos a la base de datos.
$conexion = new conexion();
$link = $conexion->conectar();

// Creamos un objeto visitas e incrementamos las vistas de este tema.
$numero = new visitas($link);
$numero->incrementarTema(45);
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
    <TD WIDTH="240" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="6" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="17" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="420" HEIGHT="43" COLSPAN="4" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="2160" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../librerias/bgmenu.gif">
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
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="60" COLSPAN="4" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
				<TR> 
					<TD WIDTH="76%" CLASS="ubicacion">Ubicaci&oacute;n: <A HREF="../home/index.php" TITLE="Ver Home">Home</A> / Calendario</TD>
					<TD ROWSPAN="2" WIDTH="24%" VALIGN="TOP"><IMG SRC="activos/bgcalendario.jpg" WIDTH="110" HEIGHT="45"></TD>
				</TR>
				<TR> 
					<TD WIDTH="76%" CLASS="titulo">Calendario Acad&eacute;mico <?PHP echo date("Y") ?></TD>
				</TR>
				<TR> 
					<TD COLSPAN="2"><IMG SRC="../librerias/pxgris.gif" WIDTH="460" HEIGHT="1"></TD>
				</TR>
			</TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="2160" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../librerias/bgmenu.gif">
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
    <TD WIDTH="6" HEIGHT="1995" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="1995" COLSPAN="4" VALIGN="TOP"> 
      <TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>ENERO</B></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD WIDTH="15%" CLASS="contenido" VALIGN="TOP">05-06-07</TD>
          <TD WIDTH="85%" CLASS="contenido">Periodo de Postulaci&oacute;n a las Universidades.</TD>
        </TR>
        <TR> 
          <TD WIDTH="15%" CLASS="contenido" VALIGN="TOP">19-20-21</TD>
          <TD WIDTH="85%" CLASS="contenido">Primer periodo de matr&iacute;cula e inscripci&oacute;n de asignaturas alumnos nuevos (seleccionados).</TD>
        </TR>
        <TR> 
          <TD WIDTH="15%" CLASS="contenido" VALIGN="TOP">23-24</TD>
          <TD WIDTH="85%" CLASS="contenido">Segundo periodo de matr&iacute;cula e inscripci&oacute;n de asignaturas alumnos nuevos.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">26</TD>
          <TD CLASS="contenido">Tercer periodo de matr&iacute;cula e inscripci&oacute;n de asignaturas alumnos nuevos.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">26</TD>
          <TD CLASS="contenido">Inicio del receso de verano.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>FEBRERO</B></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR CLASS="contenido"> 
          <TD>27</TD>
          <TD>Finalizaci&oacute;n del receso de Verano.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>MARZO</B></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD WIDTH="15%" CLASS="contenido" VALIGN="TOP">11-12</TD>
          <TD WIDTH="85%" CLASS="contenido">Matr&iacute;cula e inscripci&oacute;n de asignaturas alumnos antiguos.</TD>
        </TR>
        <TR> 
          <TD WIDTH="15%" CLASS="contenido" VALIGN="TOP">15</TD>
          <TD WIDTH="85%" CLASS="contenido">Inicio de clases primer semestres 2003.</TD>
        </TR>
        <TR> 
          <TD WIDTH="15%" CLASS="contenido" VALIGN="TOP">19</TD>
          <TD WIDTH="85%" CLASS="contenido">Inauguraci&oacute;n A&ntilde;o Acad&eacute;mico 2003.</TD>
        </TR>
        <TR> 
          <TD WIDTH="15%" CLASS="contenido" VALIGN="TOP">19</TD>
          <TD WIDTH="85%" CLASS="contenido">D&iacute;a aniversario Universidad de La Serena.</TD>
        </TR>
        <TR> 
          <TD WIDTH="15%" CLASS="contenido" VALIGN="TOP">31</TD>
          <TD WIDTH="85%" CLASS="contenido">Ultimo d&iacute;a para la asignaci&oacute;n del Fondo Solidario para alumnos antiguos.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">31</TD>
          <TD CLASS="contenido">Ultimo d&iacute;a para la solicitar postergaci&oacute;n de estudios por el primer semestre 2003 (Alumnos con Asignaturas de R&eacute;gimen Semestral).</TD>
        </TR>
        <TR> 
          <TD WIDTH="15%" CLASS="contenido" VALIGN="TOP">31</TD>
          <TD WIDTH="85%" CLASS="contenido">Inicio Recepci&oacute;n de Papayos.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>ABRIL</B></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD WIDTH="15%" CLASS="contenido" VALIGN="TOP">01-02</TD>
          <TD WIDTH="85%" CLASS="contenido">Recepci&oacute;n de Papayos.</TD>
        </TR>
        <TR> 
          <TD WIDTH="15%" CLASS="contenido" VALIGN="TOP">23</TD>
          <TD WIDTH="85%" CLASS="contenido">Ultimo d&iacute;a para presentar renuncia a asignaturas inscritas (R&eacute;gimen Semestral).</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>MAYO</B></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD WIDTH="15%" CLASS="contenido" VALIGN="TOP">12</TD>
          <TD WIDTH="85%" CLASS="contenido">Talleres de Reflexi&oacute;n.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">14</TD>
          <TD CLASS="contenido">Ultimo d&iacute;a para solicitar postergaci&oacute;n de estudios por el a&ntilde;o 2004 (Alumnos con Asignaturas de R&eacute;gimen Anual).</TD>
        </TR>
        <TR> 
          <TD WIDTH="15%" CLASS="contenido" VALIGN="TOP">28</TD>
          <TD WIDTH="85%" CLASS="contenido">Ultimo d&iacute;a para solicitar suspensi&oacute;n de estudios del Primer Semestre 2004.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>JUNIO</B></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">18</TD>
          <TD CLASS="contenido">Ultimo d&iacute;a para presentar renuncias a asignaturas inscritas (Asignaturas de R&eacute;gimen Anual).</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">18</TD>
          <TD CLASS="contenido">Primera reuni&oacute;n Comisi&oacute;n Central de Jerarquizaci&oacute;n.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>JULIO</B></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">02</TD>
          <TD CLASS="contenido">T&eacute;rmino de clases del primer semestre 2004 (Alumnos con Asignaturas de R&eacute;gimen Semestral).</TD>
        </TR>
        <TR> 
          <TD VALIGN="TOP" CLASS="contenido">12-23</TD>
          <TD CLASS="contenido">Periodo de ex&aacute;menes del primer semestre 2004 (Asignaturas de R&eacute;gimen Semestral).</TD>
        </TR>
        <TR> 
          <TD VALIGN="TOP" CLASS="contenido">16</TD>
          <TD CLASS="contenido">T&eacute;rmino de clases primer periodo carreras con Asignaturas de R&eacute;gimen Anual inicio de Receso Estudiantil de Invierno.</TD>
        </TR>
        <TR> 
          <TD VALIGN="TOP" CLASS="contenido">23</TD>
          <TD CLASS="contenido">T&eacute;rmino primer semestre 2004.</TD>
        </TR>
        <TR> 
          <TD VALIGN="TOP" CLASS="contenido">26</TD>
          <TD CLASS="contenido">Inicio receso estudiantil de invierno, alumnos de r&eacute;gimen semestral.</TD>
        </TR>
        <TR> 
          <TD VALIGN="TOP" CLASS="contenido">26</TD>
          <TD CLASS="contenido">Ultimo d&iacute;a para entregar Actas de Calificaciones.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>AGOSTO</B></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">09-10</TD>
          <TD CLASS="contenido">Inscripci&oacute;n de asignaturas segundo semestre 2004.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">11</TD>
          <TD CLASS="contenido">Inicio de clases Segundo Semestre 2004.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">31</TD>
          <TD CLASS="contenido">Ultimo d&iacute;a para solicitar postergaci&oacute;n de estudios por el Segundo Semestre 2004 (Alumnos con Asignaturas de R&eacute;gimen Semestral).</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>SEPTIEMBRE</B></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">03</TD>
          <TD CLASS="contenido">Acto de Graduaci&oacute;n de la Facultar de Ciencias.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">13-17</TD>
          <TD CLASS="contenido">Receso de Fiestas Patrias.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">28</TD>
          <TD CLASS="contenido">Ultimo d&iacute;a para presentar renuncias a asignaturas inscritas (Asignaturas de R&eacute;gimen Semestral).</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>OCTUBRE</B></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">06</TD>
          <TD CLASS="contenido">Talleres de Reflexi&oacute;n.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">08</TD>
          <TD CLASS="contenido">Acto de Graduaci&oacute;n Facultad de Ingenier&iacute;a.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">15</TD>
          <TD CLASS="contenido">D&iacute;a del Funcionario Universitario.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">15</TD>
          <TD CLASS="contenido">Receso Estudiantil.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>NOVIEMRBE</B></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">05</TD>
          <TD CLASS="contenido">Acto de Graduaci&oacute;n de la Facultad de Humanidades.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">09</TD>
          <TD CLASS="contenido">Ultimo d&iacute;a para solicitar suspensi&oacute;n de estudios del Segundo Semestre 2004 para alumnos con asignaturas de R&eacute;gimen Semestral y del a&ntilde;o 2004 para los alumnos con asignaturas de R&eacute;gimen Semestral.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">19</TD>
          <TD CLASS="contenido">Segunda Reuni&oacute;n Comisi&oacute;n Central de Jerarquizaci&oacute;n.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">26</TD>
          <TD CLASS="contenido">Acto Graduaci&oacute;n Facultad de Ciencias Sociales y Econ&oacute;micas.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">26</TD>
          <TD CLASS="contenido">Ultimo d&iacute;a para entregar la oferta de Cursos Extraordinarios de Verano.</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD COLSPAN="2" CLASS="contenido"><B>DICIEMBRE</B></TD>
        </TR>
        <TR> 
          <TD COLSPAN="2">&nbsp;</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">07</TD>
          <TD CLASS="contenido">T&eacute;rmino de clases del Segundo Semestre 2004 (Alumnos con asignaturas de R&eacute;gimen Semestral y R&eacute;gimen Anual).</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">10</TD>
          <TD CLASS="contenido">Acto Graduaci&oacute;n Programas de Postgrado.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">13-24</TD>
          <TD CLASS="contenido">Periodo de ex&aacute;menes correspondiente al Segundo Semestre 2004 y ex&aacute;menes finales de las carreras con asignaturas de R&eacute;gimen Anual.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">24</TD>
          <TD CLASS="contenido">T&eacute;rmino del Segundo Semestre 2004.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">27</TD>
          <TD CLASS="contenido">Inicio del receso estudiantil de Verano.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">23-24</TD>
          <TD CLASS="contenido">Inscripci&oacute;n de los Cursos Extraordinarios de Verano Enero 2004.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">27</TD>
          <TD CLASS="contenido">Ultimo d&iacute;a para entrega de Actas de Calificaciones.</TD>
        </TR>
        <TR> 
          <TD CLASS="contenido" VALIGN="TOP">30-31</TD>
          <TD CLASS="contenido">Inscripci&oacute;n de Cursos Extraordinarios de Verano Enero de 2005.</TD>
        </TR>
        <TR> 
          <TD HEIGHT="19" COLSPAN="2" VALIGN="TOP">&nbsp;</TD>
        </TR>
      </TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="1995" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="780" HEIGHT="55" COLSPAN="8" VALIGN="TOP" BGCOLOR="#6699CC">
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
    <TD WIDTH="240" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="240" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
  </TR>
</TABLE>
</BODY>
</HTML>