<?PHP
/**
 * search.php.
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
 * Script que realiza una b�squeda de la frase ingresada por el usuario en los archivos .dat
 * que maneja el programa. Los resultados son mostrados en la p�gina buscar.php y son listados
 * por orden de rankeo.
 */

// Cuando los par�metros son v�lidos.
if (isset($_GET['palabra']) && $_GET['palabra'] != NULL && is_string($_GET['palabra']))
{
	// 0: Basic Style, Page Title, Score and URL.
	// 1: Descriptive Stlye, Match number, Page Title, Page description, Score and URL.
	$OutputStyle = 1;
	
	// 0: Search terms are combined with a boolean OR. i.e. Any words must appear on a page.
	// 1: Search terms are combined with a boolean AND. i.e. All words must appear on a page.
	$JoinType = 0;
	
	// 0: No logging of words that a user enter.
	// 1: Words are logged to a file for later analysis. (See documentation for file permission issues).
	$Logging = 0;
	
	// Path and File name of search word log file
	$LogFileName	= "./logs/searchwords.log";
	
	// Maximum line length of a single line in the KeyWords file.
	// Increase, if required, so that   MaxKeyWordLineLen >= Number of web pages in site * 6.
	$MaxKeyWordLineLen = 2000;
	
	// 0: Only split input search phrase into words when a Space character is found.
	// 1: Split input search phrase at Space ' ', UnderScore '_' , Dash '-' and Plus '+' characters
	$WordSplit = 1;
	
	// Compare the two values, used for sorting output results.
	// Results that match all search terms are put first. Then results with highest score.
	function SortCompare($a, $b)
	{
		if ($a[2] < $b[2])
			return 1;
		else
		if ($a[2] > $b[2])
			return -1;
		else
		{
			if ($a[1] < $b[1])
				return 1;
			else
			if ($a[1] > $b[1])
				return -1;
			else
				return 0;
		}
	} 
	
	// Split search phrase into words.
	if ($WordSplit == 1)
		$SearchWords = preg_split('[-_ +]', $_GET['palabra']);
	else $SearchWords = preg_split('[ ]', $_GET['palabra']);
	
	// Open and print start of result page template.
	$template = file('buscar.php');
	$numtlines = count($template); // Number of lines in the template.
	$line = 0;
	while (!stristr($template[$line], "<!--RESULTADOS-->") && $line < $numtlines)
	{
		echo $template[$line];
		$line++;
	}
	$line++; // Replace the key text <!--RESULTADOS--> with the search result.
	
	// Load the entire pages file into an array, all URL's on the site.
	$urls = file('activos/pages.dat');
	
	// Load the entire page titles file into an array.
	$titles = file('activos/titles.dat');
	if ($OutputStyle == 1)
		$descriptions = file('activos/descriptions.dat');
	
	// Print heading.
	printf("<P><B>Se busc&oacute; <EM>%s</EM> en este Web</B></P>", nl2br(strtr($_GET['palabra'], get_html_translation_table(HTML_SPECIALCHARS))));
	
	// Open keywords file.
	$fpkeywords = fopen("activos/keywords.dat", "r");
	
	// Loop through all search words.
	$numwords = count($SearchWords);
	$outputline = 0;
	for ($sw = 0; $sw < $numwords; $sw++)
	{
		// Read in a line at a time from the keywords files.
		while ($data = fgetcsv($fpkeywords, $MaxKeyWordLineLen, ","))
		{
			if (strcasecmp ($data[0], $SearchWords[$sw]) == 0)
			{
				// Keyword found, so include it in the output list.
				$num = count ($data);
				for ($kw=1; $kw < $num; $kw +=2)
				{
					// Check if page is already in output list.
					$pageexists = 0;
					$ipage = $data[$kw];
					for ($ol = 0; $ol < $outputline; $ol++)
					{
						if ($output[$ol][0] == $ipage)
						{
							// Page is already in output list, so add to count + extra.
							$output[$ol][1] += $data[$kw+1];	// Add in score.
							$output[$ol][1] *= 2;				      // Double Score as we have two words matching.
							$output[$ol][2] += 1;				      // Increase word match count.
							$pageexists = 1;
						}
					}
					if ($pageexists == 0)
					{
						// New page to add to list.
						$output[$outputline][0] = $ipage;		    // Page index.
						$output[$outputline][1] = $data[$kw+1];	// Score.
						$output[$outputline][2] = 1;			      // Single word match only so far.
						$outputline++;
					}
				}
				break;	// This search word was found, so skip to next.
			}
		}
		// Return to start of file.
		rewind($fpkeywords);
	}
	
	// Close the files.
	fclose($fpkeywords);
	
	// Get number of pages matched.
	$matches = $outputline;
	
	// Sort results in order of score, use the 'SortCompare' function.
	if ($matches > 1)
		usort($output, "SortCompare");
	
	// Count number of output lines that match ALL search terms.
	$oline = 0;
	$fullmatches = 0;
	while (($oline < $matches) && $numwords > 1)
	{
		if ($output[$oline][2] == $numwords)
			$fullmatches++;
		$oline++;
	}
	$SomeTermMatches = $matches - $fullmatches;
	
	// Display search results.
	if ($matches == 1)
		print"<P><I>Se encontr&oacute; 1 resultado</I></P>";
	else
	if ($matches == 0)
	{
		printf("<P><I>Lo sentimos, no se han encontrado resultados</I></P>", nl2br(strtr($_GET['palabra'], get_html_translation_table(HTML_SPECIALCHARS))));
		printf("<UL>");
		printf("<LI>Revisa la ortograf&iacute;a.</LI>");
		printf("<LI>Prueba con palabras distintas o con menos palabras clave.</LI>");
		printf("<LI>Elimina las comillas y signos m&aacute;s (+).</LI>");
		printf("</UL>");
	}	
	else
	if ($numwords > 1 && $JoinType == 0)	// OR.
		print"<P><I>$fullmatches p&aacute;ginas encontradas que contiene todos los t&eacute;rminos buscados.<BR>$SomeTermMatches p&aacute;ginas encontradas que contiene parte del t&eacute;rmino buscado</I></P>";
	else
	if ($numwords > 1 && $JoinType == 1)	// AND.
		print "<P><I>$fullmatches p&aacute;ginas encontradas que contienen todos los t&eacute;rminos buscados.</I></P>";
	else
		printf("<P><I>Se han encontrado %s resultados</I></P>", $matches);
	
	// Output result.
	$arrayline = 0;
	$oline = 0;
	while ($arrayline < $matches)
	{
		if ($JoinType == 1 && $numwords > 1 && $output[$arrayline][2] < $numwords)
		{
			$arrayline++;
			continue;	// Boolean AND set && multiple search terms used && not all terms matched.
		}
		$ipage = $output[$oline][0];
		$score = $output[$oline][1];
		if ($OutputStyle == 0)
		{
			// Basic style.
			print "<P>P&aacute;gina: <A HREF=".$urls[$ipage].">".$titles[$ipage]."</A><BR>";
			print "Ranking: " . $score ."&nbsp;&nbsp;<SMALL><I>URL:".$urls[$ipage]."</I></SMALL></P>";
		}
		else
		{
			// Descriptive style.
			$PageMatch = $oline + 1;
			print "<P><B>".$PageMatch.".</B>&nbsp;<A HREF=".$urls[$ipage].">".$titles[$ipage]."</A><BR>";
			print $descriptions[$ipage]."<BR>";
			//print "<FONT COLOR=\"#999999\"><small><i>Coincidencias: ". $output[$oline][2]. " Ranking: " . $score ."&nbsp;&nbsp;URL: ".$urls[$ipage]."</I></SMALL></FONT></P>";
			print "<FONT COLOR=\"#999999\"><small><i>Coincidencias: ". $output[$oline][2]. " Ranking: " . $score . "</I></SMALL></FONT></P>";
		}
		$oline++;
		$arrayline++;
	}
	
	// Print out the end of the template.
	while ($line < $numtlines)
	{
		echo $template[$line];
		$line++;
	}
	
	// Log the search words, if required.
	if ($Logging == 1)
	{
		$LogString = Date("d-m-y H:i:s ") . $REMOTE_ADDR . " \"" .$_GET['palabra']  . "\"" . ", Aciertos = " . $matches . "\n";
		$fp = fopen ($LogFileName, "a");
		if ($fp != false)
		{
			fputs ($fp, $LogString);
			fclose ($fp);
		}
	}
}

// Cuando faltan par�metros en la URL.
else header("Location:index.php");
?>