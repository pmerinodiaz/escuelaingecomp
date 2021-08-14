<?PHP
/**
 * calendarioevo.php.
 * v. 1.0.
 * Diciembre, 2004.
 *
 * Copyright (C) 2004 por Héctor Díaz Díaz - Patricio Merino Díaz.
 * Escuela Ingeniería en Computacion, Universidad de La Serena, Chile.
 * Todos los derechos reservados.
 *
 * No se asume ninguna  responsabilidad por el  uso o  alteración  de este software.
 * Este software se proporciona como es y sin garantía de ningún tipo de su funcionamiento
 * y en ningún caso será el autor responsable de daños o perjuicios que se deriven del mal
 * uso del software, aún cuando este haya sido notificado de la posibilidad de dicho daño.
 *
 * Script que construye la página que se muestra en el calendario y que contiene la información
 * de la cantidad de visitas diarias para cada día del mes. Esta página se visualiza en forma de
 * ventana popup que se despliegua cuando el usuario pasa el mouse sobre la celda de la tabla
 * que corresponde a un día del año.
 */

// Formato de la fecha.
$dateFormat = 1;

// Verifica la zona horaria.
$tz = date("Z")/3600;
if ($tz<0) $offset = 1;

// Formato de la fecha del evento.
$eDate = date("F d, Y",($ev*86400)+($offset*86400));

// Carga la información de la base de datos mySQL.
if ($readSQL == 1)
{
	// Setea la fecha para realizar la consulta.
	$SQLdate = date("Y-m-d",($ev*86400)+($offset*86400));
	
	// Creamos un objeto conexión y nos conectamos a la base de datos.
	$conexion = new conexion();
	$link = $conexion->conectar();
	
	// Consulta que obtiene las visitas del contador.
	$result = mysql_query("SELECT * FROM contador WHERE fecha_contador <= '$SQLdate' AND fecha_contador >= '$SQLdate'", $link);
	$myrow = mysql_fetch_array($result);
	
	if ($myrow)
	{
		do
		{
			$es .= $myrow["fecha_contador"]."x";
			$ee .= $myrow["fecha_contador"]."x";
			$eTitle .= "N&uacute;mero de Visitas: ".$myrow["visitas_contador"]."||";
		}
		while ($myrow = mysql_fetch_array($result));
	}
	
	// Desconectamos la base de datos.
	$conexion->desconectar();
}

// Cargar la información de el archivo de texto.
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
			$eTitle .= "$datas[2]||";
		}
		while ($datas);
		fclose($fp);
	}
}

// Proceso de despliegue.
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
echo "<table width='100%' border='0' cellpadding='2' cellspacing='0'><tr><td align='left' bgcolor='#336699' class=oLib><font color='#FFFFFF'>$eDate</font></td></tr></table><br>";

// Mostrar los eventos.
$i = 0;
while ($i < $smc)
{
	if (!$es[$i])
		break;
	$es[$i] = str_replace('-','/', $es[$i]);
	$ee[$i] = str_replace('-','/', $ee[$i]);
	$start = intval((strtotime($es[$i])+(date("O", strtotime($es[$i]))*36))/86400);
	$end = intval((strtotime($ee[$i])+(date("O", strtotime($ee[$i]))*36))/86400);
	
	if ($ev >= $start && $ev <= $end)
	{
		if ($dateFormat == 1)
		{
			$eStart = date("m/d/y",($start*86400)+($offset*86400));
			$eEnd = date("m/d/y",($end*86400)+($offset*86400));
		}
		if ($dateFormat == 2)
		{
			$eStart = date("d/m/y",($start*86400)+($offset*86400));
			$eEnd = date("d/m/y",($end*86400)+($offset*86400));
		}
		if ($eStart == $eEnd)
			$eDates = "$eStart";
		else $eDates = "$eStart :: $eEnd";
		
		if ($eStart != $eEnd)
			$eDate = $eStart." to  ".$eEnd;
		else $eDate = "";
		
		echo "<table width='100%'  border='0' cellpadding='3' cellspacing='0'><tr bgcolor='#DDE7F0'><td bgcolor='#B6CEE7' class=oLib>".nl2br($eTitle[$i])."</td></tr></table>";
		echo "<table width='100%'  border='0' cellpadding='0' cellspacing='0'><tr align='center' bgcolor='#EDEEEA'><td bgcolor='#E9EFF5' class=oLib><font color ='#446B93'>$eDate</font></td></tr></table><br>";
	}
	$i++;
}
?>