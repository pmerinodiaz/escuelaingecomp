<?PHP
/**
 * calendario.php.
 * v. 1.0.
 * Diciembre, 2004.
 *
 * Copyright (C) 2004 por H�ctor D�az D�az - Patricio Merino D�az.
 * Escuela Ingenier�a en Computacion, Universidad de La Serena, Chile.
 * Todos los derechos reservados.
 *
 * No se asume ninguna  responsabilidad por el  uso o  alteraci�n  de este software.
 * Este software se proporciona como es y sin garant�a de ning�n tipo de su funcionamiento
 * y en ning�n caso ser� el autor responsable de da�os o perjuicios que se deriven del mal
 * uso del software, a�n cuando este haya sido notificado de la posibilidad de dicho da�o.
 *
 * Script que construye un calendario que visualiza la cantidad de visitas diarias recibidas
 * en el sitio Web. Se muestra el mes actual. Adem�s las opciones para que el usuario pueda
 * ir desplazandose entre meses y entre a�os. Las visitas diarias son mostradas en una peque�a
 * ventana generada con lenguaje JavaScript cuando el usuario se sit�a sobre un d�a que ha
 * tenido visitas.
 */

// La zona horaria en GMT.
$gmt = "-5";

// El ancho de la tabla del canlendario.
$tableWidth = 350;

// Espacio entre celdas y columnas de la tabla del calendario.
$cellSpacing = 1;
$cellPadding = 0;

// Si se desea leer eventos de una base de datos mySQL.
$readSQL = 1;

// Si se desea leer eventos de un archivo de texto.
$readFile = 0;

// Si se desea usar la ventana popup para mostrar los eventos.
$standardPop = 1;

// Ancho y alto de la ventana popup de los eventos.
$popupWidth = 250;
$popupHeight = 220;

// Si se desea usar la librer�as overLIB para la ventana popup.
$overLIB = 1;
$olWidth = 170;

// Mostrar las filas del calendario iguales.
$displayEmptyRows = 1;

// Nombre de los d�as.
$day[0] = "D";
$day[1] = "L";
$day[2] = "M";
$day[3] = "M";
$day[4] = "J";
$day[5] = "V";
$day[6] = "S";

// Nombre de los meses.
$mth[1] = "Enero";
$mth[2] = "Febrero";
$mth[3] = "Marzo";
$mth[4] = "Abril";
$mth[5] = "Mayo";
$mth[6] = "Junio";
$mth[7] = "Julio";
$mth[8] = "Agosto";
$mth[9] = "Septiembre";
$mth[10] = "Octubre";
$mth[11] = "Noviembre";
$mth[12] = "Diciembre";

// El primer d�a de la semana.
$weekDayStart = 1;

// Si se desea mostrar el a�o.
$displayYear = 1;

// Mostrar el d�a actual en forma diferente.
$highlightToday = 1;

// Limpiar los eventos del d�a.
$resetEvents = 1;

// Verifica la versi�n del PHP.
$pv = explode(".",phpversion());
$pv = $pv[0].".".$pv[1];
$pv = $pv-4.1;

// Limpiar los eventos
if ($resetEvents == 1)
	unset($es, $ee, $eTitle);

// Setea las variables.
if ($pv >= 0)
{
	if (!isset($mo)) $mo = $_REQUEST["mo"];
  if (!isset($yr)) $yr = $_REQUEST["yr"];
  if (!isset($ee)) $ee = $_REQUEST["ee"];
  if (!isset($es)) $es = $_REQUEST["es"];
}
if ($pv < 0)
{
	if (!isset($mo)) $mo = $_GET["mo"];
  if (!isset($yr)) $yr = $_GET["yr"];
  if (!isset($ee)) $ee = $_GET["ee"];
  if (!isset($es)) $es = $_GET["es"];
}

// Construye la ventana popup con la librer�as overLib.
if (!function_exists('overLib'))
{
	function overLib ($ev)
	{
		global $readSQL, $readFile;
		ob_start(); 
		require("calendarioevo.php");
		$a = ob_get_contents();
		ob_end_clean();
		return addslashes(htmlentities(str_replace("\n", "", str_replace("\r", "", $a))));
	}
}

// Verifica la zona horaria del servidor.
$tz = date("Z")/3600;
if ($tz < 0) $timeZone = 1;
if ($tz >= 0) $timeZone = 0;

// Determina el d�a actual.
$dst = date("I");
$gmt = $gmt + $dst;
$tnum = intval((date("U")+($gmt*3600))/86400);

// Verifica los datos de las variables para l�nea de comandos.
if (!$mo) $mo = date("m",($tnum*86400)+(86400*$timeZone));
if (!$yr) $yr = date("Y",($tnum*86400)+(86400*$timeZone));

// Primer d�a del mes.
$daycount = (intval(date("U", mktime(3,0,0,$mo,1,$yr)/86400)))-$weekDayStart;
// Ajuste del inicio.
$daycount = $daycount + $weekDayStart;

$mo = intval($mo);
// Setea el nombre del mes.
$mn = $mth[$mo];
// Agrega el a�o al nombre del mes.
if ($displayYear == 1) {$mn = $mn." ".$yr;}

// En qu� d�a hace la primera ca�da.
$sd = date("w", mktime(0,0,0,$mo,1-$weekDayStart,$yr));
$cd = 1-$sd;

// N�mero de d�as en el mes.
$nd = mktime(0,0,0,$mo+1,0,$yr);
$nd = (strftime("%d",$nd))+1;

// Cargar la informaci�n del archivo de texto.
if ($readFile == 1)
{
	if (file_exists("esdates.txt"))
	{
		$fp = fopen("esdates.txt","r");
		do
		{
			$datas = fgetcsv($fp, 1000, ",");
			if (!$datas)
				break;
			$es .= "$datas[0]x";
			if ($datas[1] != "")
				$ee .= "$datas[1]x";
			else $ee .= "$datas[0]x";
			if ($datas[2])
			{
				$datas[2] = eregi_replace("\"","''",$datas[2]);
				$eTitle .= "$datas[2]||";
			}
		}
		while ($datas);
		fclose($fp);
	}
}

// Cargar la informaci�n de una base de datos mySQL.
if ($readSQL == 1)
{
	// Setea el n�mero de d�as de la sentencia SQL.
	$daysSQL = $nd - 1;
	
	// Librer�as necesarias.
	include("conexion.php");
	
	// Creamos un objeto conexi�n y nos conectamos a la base de datos.
	$conexion = new conexion();
	$link = $conexion->conectar();
	
	// Consulta que lee datos de la tabla.
	$result = mysql_query("SELECT * FROM contador WHERE fecha_contador<='$yr-$mo-$daysSQL' AND fecha_contador>='$yr-$mo-01'", $link);
  $myrow = mysql_fetch_array($result);
	
  do
	{
		$es .= $myrow["fecha_contador"]."x";
		$ee .= $myrow["fecha_contador"]."x";
		$eTitle .= $myrow["visitas_contador"]."||";
	}
	while ($myrow = mysql_fetch_array($result));
	
	// Desconectamos la base de datos.
	$conexion->desconectar();
}

// Configura el ancho de la celda de la tabla del calendario.
$cellWidth = $tableWidth/7;

// Proceso de marcar los d�as.
if ($es)
{
	$es = explode("x",$es);
	$smc = count($es);
	$ee = explode("x",$ee);
	$eTitle = explode("||",$eTitle);
	if ($smc == 1)
	{
		$es[1] = "3000-01-01";
		$ee[1] = "3000-01-01";
	}
}
$i = 0;
while ($i < $smc)
{
	if (!$es[$i])
		break;
	$es[$i] = str_replace('-','/', $es[$i]);
	$ee[$i] = str_replace('-','/', $ee[$i]);
	$start = intval((strtotime($es[$i])+(date("O", strtotime($es[$i]))*36))/86400);
	$end = intval((strtotime($ee[$i])+(date("O", strtotime($ee[$i]))*36))/86400);
	if ($end > ($daycount-1) && $start < ($daycount+$nd+1))
	{
		if (!$ee[$i] || ($es[$i] == $ee[$i]))
		{
			$bgc[$start] = 2;
			
			if (!$et[$start])
				$et[$start] = $eTitle[$i];
			else $et[$start] = ">> Multiple Events <<";
		}
		else
		{
			if (!$bgc[$start])
				$bgc[$start] = 1;
			else $bgc[$start] = 4;
			
			$bgc[$end] = 3;
			
			if (!$et[$start])
				$et[$start] = $eTitle[$i];
			else $et[$start] = ">> Multiple Events <<";
			
			if (!$et[$end])
				$et[$end] = $eTitle[$i];
			else $et[$end] = ">> Multiple Events <<";
			
			for ($n = ($start+1); $n < $end; $n++)
			{
				$bgc[$n] = 2;
				if (!$et[$n])
					$et[$n] = $eTitle[$i];
				else $et[$n] = ">> Multiple Events <<";
			}
		}
	}
	$i++;
}
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function popupEvent(ev,w,h)
{
	var winl=(screen.width-w)/2;
	var wint=(screen.height-h)/2;
	win=window.open("escalEV.php?ev="+ev+"&readFile=<?php echo $readFile ?>&readSQL=<?php echo $readSQL ?>","ESCalendar","scrollbars=yes,status=no,location=no,toolbar=no,menubar=no,directories=no,resizable=yes,width="+w+",height="+h+",top="+wint+",left="+winl+"");
	if(parseInt(navigator.appVersion)>=4)
		win.window.focus();
} 
//-->
</script>
<?php
// Mostramos el calendario.
$yb = $yr;
$yf = $yr;
$mb = $mo-1;
if ($mb < 1) {$mb=12; $yb=$yr-1;}
$mf = $mo+1;
if ($mf > 12) {$mf=1; $yf=$yr+1;}

// Abrimos la tabla del calendario.
echo "<table width='$tableWidth' border='0' cellspacing='0' cellpadding='0' align='center' BGCOLOR='#FFFFFF'>";
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='center' CLASS='detalle'>";
echo "<a href='index.php?mo=$mo&yr=1' TITLE='Ver primer a&ntilde;o'>|&lt;</a>&nbsp;&nbsp;";
echo "<a href='index.php?mo=$mo&yr=" . ($yr-1) . "' TITLE='Ver a&ntilde;o anterior'>&lt;&lt;</a>&nbsp;&nbsp;";
echo "<a href='index.php' TITLE='Ver fecha actual'>A&ntilde;o Actual</a>&nbsp;&nbsp;";
echo "<a href='index.php?mo=$mo&yr=" . ($yr+1) . "' TITLE='Ver a&ntilde;o siguiente'>&gt;&gt;</a>&nbsp;&nbsp;";
echo "<a href='index.php?mo=$mo&yr=$yr' TITLE='Ver &uacute;ltimo a&ntilde;o'>&gt;|</a>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td><IMG SRC='../../../../librerias/pxtransparente.gif' HEIGHT='5'></td>";
echo "</tr>";
echo "</table>";
echo "<table class=mainTable WIDTH=$tableWidth CELLSPACING=$cellSpacing CELLPADDING=$cellPadding BORDER=0>\n";
echo "<tr>\n";
echo "<td CLASS=\"monthYearText monthYearRow\" colspan=\"7\" title=\"Easily Simple Calendar 4.3\">\n    $mn\n  </td>\n";
echo "</tr>\n";
echo "<tr CLASS=dayNamesText>\n";

for ($I=0; $I<7; $I++)
{
	$dayprint = $weekDayStart+$I;
	if ($dayprint>6)
		$dayprint = $dayprint-7;
	echo "<td class=dayNamesRow WIDTH=$cellWidth>$day[$dayprint]</td>\n";
}
echo "</tr>\n";

// Imprimir el calendario.
for ($i=1; $i<7; $i++)
{
	if ($cd >= $nd && $displayEmptyRows != 1)
		break;
	
	echo "<tr class=rows>\n";
	
	for ($prow = 1; $prow<8; $prow++)
	{
		if ($daycount == $tnum && $highlightToday == 1 && $cd > 0 && $cd < $nd)
		{
			echo "<td class=\"s2$bgc[$daycount] today\"";
			if ($et[$daycount] != "")
			{
				if ($overLIB == 1)
				{
					echo " onmouseover=\"return overlib('".overLib($daycount)."',WIDTH,$olWidth,DELAY,100,FGCOLOR,'#FFFFFF',BGCOLOR,'#AAAAAA');\" onmouseout=\"return nd();\"";
					$et[$daycount]="";
				}
				if ($standardPop == 1)
					echo " title=\"$et[$daycount]\" onClick=\"popupEvent($daycount,$popupWidth,$popupHeight)\" style=\"cursor:hand;\"";
			}
			echo ">$cd</td>\n";
			$daycount++;
			$cd++;
		}
    else
		{
			if ($cd > 0 && $cd < $nd)
			{
				echo "  <td class=s2$bgc[$daycount]";
				if ($et[$daycount]!="")
				{
					if ($overLIB == 1)
					{
						echo " onmouseover=\"return overlib('".overLib($daycount)."',WIDTH,$olWidth,DELAY,100,FGCOLOR,'#FFFFFF',BGCOLOR,'#AAAAAA');\" onmouseout=\"return nd();\"";
						$et[$daycount]="";
					}
					if ($standardPop == 1)
						echo " title=\"$et[$daycount]\" onClick=\"popupEvent($daycount,$popupWidth,$popupHeight)\" style=\"cursor: pointer; cursor: hand;\"";
				}
				echo ">$cd</td>\n";
				$daycount++;
			}
  	  else echo "<td class=s20>&nbsp;</td>\n";
			$cd++;
    }
  }
	echo "</tr>\n";
}

// Cerramos la tabla del calendario.
echo "</table>";
echo "<table width='$tableWidth' border='0' cellspacing='0' cellpadding='0' align='center' BGCOLOR='#FFFFFF'>";
echo "<tr>";
echo "<td><IMG SRC='../../../../librerias/pxtransparente.gif' HEIGHT='5'></td>";
echo "</tr>";
echo "<tr>";
echo "<td align='center' CLASS='detalle'>";
echo "<a href='index.php?mo=1&yr=$yr' TITLE='Ver primer mes'>|&lt;</a>&nbsp;&nbsp;";
echo "<a href='index.php?mo=$mb&yr=$yb' TITLE='Ver mes anterior'>&lt;&lt;</a>&nbsp;&nbsp;";
echo "<a href='index.php' TITLE='Ver fecha actual'>Mes Actual</a>&nbsp;&nbsp;";
echo "<a href='index.php?mo=$mf&yr=$yf' TITLE='Ver mes siguiente'>&gt;&gt;</a>&nbsp;&nbsp;";
echo "<a href='index.php?mo=12&yr=$yr' TITLE='Ver &uacute;ltimo mes'>&gt;|</a>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "</table>";
?>