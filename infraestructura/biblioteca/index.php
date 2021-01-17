<HTML>
<HEAD>
<TITLE>Escuela Ingenier&iacute;a en Computaci&oacute;n - Infraestructura - Biblioteca IC</TITLE>
<META HTTP-EQUIV="content-type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="content-language" CONTENT="Es">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META NAME="keywords" CONTENT="bibliotecas, libros, tesis, revistas, documentaciones, publicaciones, laboratorios, equipamientos, campus, salas, dependencias, edificios, infraestructuras, recursos">
<META NAME="description" CONTENT="P�gina en donde se muestran las libros, revistas y tesis que tiene a su disposici�n la Escuela Ingenier�a en Computaci�n para sus alumnos y profesores. Se despliega una la lista de publicaciones y adem�s se presenta un formulario de b�squeda de libros.">
<META NAME="author" CONTENT="H�ctor D�az D�az - Patricio Merino D�az">
<META NAME="copyright" CONTENT="2004 Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="None">
<META NAME="rating" CONTENT="General">
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/nivel2.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/coolmenu.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/ventanita.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/valida.js"></SCRIPT>
<SCRIPT LANGUAJE="JavaScript">
<!--
function setear()
{
	if(document.formulario.filtro.checked)
	{
		document.formulario.autor.disabled=false;
		document.formulario.anio.disabled=false;
		document.formulario.filtro.value=1;
	}
	else
	{
		document.formulario.autor.disabled=true;
		document.formulario.anio.disabled=true;
		document.formulario.filtro.value=0;
	}
}
function deshabilitar()
{
	document.formulario.autor.disabled=true;
	document.formulario.anio.disabled=true;
	document.formulario.filtro.value=0;
}
function validarFormulario()
{
	if(validarCampo(document.formulario.titulo,isAny,false))
	{
		if(document.formulario.filtro.checked)
		{
			if(validarCampo(document.formulario.autor,isName,false)&&
				 validarCampo(document.formulario.anio,isIntegerUnsigned,false))
				return true;
			else return false;
		}
		else return true;
	}
	else return false;	
}
//-->
</SCRIPT>
<LINK REL="stylesheet" HREF="../../librerias/base.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../librerias/tema.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../librerias/tabla.css" TYPE="text/css">
<LINK REL="stylesheet" HREF="../../librerias/formulario.css" TYPE="text/css">
</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menuarriba.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menugeneral.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menulocal.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../../librerias/menumiscelaneos.js"></SCRIPT>
<?PHP
/**
 * Script en donde incrementamos el n�mero de visitas del tema 'Biblioteca IC'.
*/

// Verificamos que vengan todos los par�metros en la URL.
if (isset($_GET['pagina']) && $_GET['pagina'] != NULL && is_numeric($_GET['pagina']))
{
	// Librer�as necesarias.
	include("../../librerias/visitas.php");
	include("../../librerias/conexion.php");
	
	// Decimos que los par�metros son v�lidos.
	$correcto = true;
	
	// Creamos un objeto conexi�n y nos conectamos a la base de datos.
	$conexion = new conexion();
	$link = $conexion->conectar();
	
	// Creamos un objeto visitas e incrementamos las visitas de este tema.
	$numero = new visitas($link);
	$numero->incrementarTema(17);
}
else $correcto = false;
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
    <TD WIDTH="60" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="20" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="160" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="6" HEIGHT="17" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="17" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="420" HEIGHT="43" COLSPAN="6" VALIGN="TOP" BGCOLOR="#6699CC">&nbsp;</TD>
  </TR>
  <TR>
    <TD WIDTH="154" HEIGHT="540" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../../librerias/bgmenu.gif">
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
    <TD WIDTH="460" HEIGHT="60" COLSPAN="6" VALIGN="TOP"> 
            <?PHP
			/*
			 * Script en donde creamos el objeto publicacion o bien el objeto error, dependiendo
			 * de si los par�metros son v�lidos.
			*/
			
			// Cuando los par�metros son v�lidos.
			if ($correcto)
			{
				// Librer�as necesarias.
				include("../../librerias/publicacion.php");
				
				// Creamos un objeto publicacion y mostramos el t�tulo de esta secci�n.
				$publicacion = new publicacion($link);
				$publicacion->mostrarTitulo();
			}
			else
			{
				// Librer�as necesarias.
				include("../../librerias/error.php");
				
				// Creamos un objeto error y mostramos el titulo de error.
				$error = new error(1, "../../", "index.php?pagina=1");
				$error->mostrarTitulo();
			}
			?>
    </TD>
    <TD WIDTH="6" HEIGHT="60" VALIGN="TOP"></TD>
    <TD WIDTH="154" HEIGHT="540" ROWSPAN="2" VALIGN="TOP" BACKGROUND="../../librerias/bgmenu.gif">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD><IMG SRC="../../librerias/temasrelacionados.gif" WIDTH="154" HEIGHT="19"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="1" HEIGHT="10"></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../edificio/index.php" TITLE="Ver Edificio"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Edificio</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../laboratorios/index.php" TITLE="Ver Laboratorios"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Laboratorios</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../laboratorios/1/index.php" TITLE="Ver Laboratorio 1">&#149; Laboratorio 1</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../laboratorios/2/index.php" TITLE="Ver Laboratorio 2">&#149; Laboratorio 2</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../laboratorios/3/index.php" TITLE="Ver Laboratorio 3">&#149; Laboratorio 3</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="25" HEIGHT="1"><A HREF="../laboratorios/4/index.php" TITLE="Ver Laboratorio 4">&#149; Laboratorio 4</A></TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Biblioteca IC</TD>
        </TR>
        <TR> 
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"><A HREF="../campus/index.php" TITLE="Ver Campus"><IMG SRC="../../librerias/awtema.gif" WIDTH="18" HEIGHT="10" BORDER="0">Campus</A></TD>
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
          <TD BACKGROUND="../../librerias/bgbox.gif" CLASS="tema"> 
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
    <TD WIDTH="6" HEIGHT="480" VALIGN="TOP"></TD>
    <TD WIDTH="460" HEIGHT="480" COLSPAN="6" VALIGN="TOP">
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" MM_NOCONVERT="TRUE">
        <TR> 
          <TD> 
                        <?PHP
						/**
						 * Script en donde se listan (en forma paginada) las publicaciones que tiene la
						 * Biblioteca IC.
						*/
						
						// Cuando los par�metros son v�lidos.
						if ($correcto)
						{
							$publicacion->mostrar($_GET['pagina']);
							$conexion->desconectar();
						}
						// Cuando los par�metros no son v�lidos.
						else $error->mostrar();									
						?>
          </TD>
        </TR>
      </TABLE>
		</TD>
    <TD WIDTH="6" HEIGHT="480" VALIGN="TOP"></TD>
  </TR>
  <TR>
    <TD WIDTH="780" HEIGHT="55" COLSPAN="10" VALIGN="TOP" BGCOLOR="#6699CC">
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
    <TD WIDTH="60" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="60" HEIGHT="1"></TD>
    <TD WIDTH="20" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="20" HEIGHT="1"></TD>
    <TD WIDTH="160" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="160" HEIGHT="1"></TD>
    <TD WIDTH="6" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="6" HEIGHT="1"></TD>
    <TD WIDTH="154" HEIGHT="1" VALIGN="TOP"><IMG SRC="../../librerias/pxtransparente.gif" WIDTH="154" HEIGHT="1"></TD>
  </TR>
</TABLE>
</BODY>
</HTML>