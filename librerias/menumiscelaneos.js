<!--
/**
 * menumiscelaneos.js.
 * v. 1.0.
 * Diciembre, 2004.
 *
 * Copyright (C) 2004 por H�ctor D�az D�az - Patricio Merino D�az.
 * Escuela Ingenier�a en Computaci�n, Universidad de La Serena, Chile.
 * Todos los derechos reservados.
 *
 * No se asume ninguna  responsabilidad por el  uso o  alteraci�n  de este software.
 * Este software se proporciona como es y sin garant�a de ning�n tipo de su funcionamiento
 * y en ning�n caso ser� el autor responsable de da�os o perjuicios que se deriven del mal
 * uso del software, a�n cuando este haya sido notificado de la posibilidad de dicho da�o.
 *
 * Creaci�n del men� que est� en la parte de izquierda del Web. Este men� contiene los
 * temas relacionados con 'Informaci�n Miscel�nea'.
 */
otMenu=new makeCoolMenu("otMenu");
otMenu.useframes=0;
otMenu.frame="frmMain";
otMenu.useclick=0;
otMenu.useNS4links=1;
otMenu.NS4padding=2;
otMenu.checkselect=1;
otMenu.offlineUrl="file://C:/apache2/htdocs/escuelaingecomp/home/";
otMenu.onlineUrl="http://www.escuelaingecomp.tk";
otMenu.pagecheck=1;
otMenu.checkscroll=0;
otMenu.resizecheck=1;
otMenu.wait=200;
otMenu.usebar=1;
otMenu.barcolor="#000000";
otMenu.barwidth="menu";
otMenu.barheight="menu";
otMenu.barx="menu";
otMenu.bary="menu";
otMenu.barinheritborder=0;
otMenu.barinheritborder=0;
otMenu.rows=0;
otMenu.pxbetween=0;
otMenu.fromleft=0;
otMenu.fromtop=419;
otMenu.menuplacement=0;
otMenu.NS4hover=1;
otMenu.level[0]=new Array();
otMenu.level[0].width=152;
otMenu.level[0].height=17;
otMenu.level[0].bgcoloroff="#F1F1F1";
otMenu.level[0].bgcoloron="#CCCCCC";
otMenu.level[0].textcolor="#000000";
otMenu.level[0].hovercolor="#000000";
otMenu.level[0].style="padding:1px;padding-left:1px;font-family:Verdana;font-size:11.5px;";
otMenu.level[0].border=1;
otMenu.level[0].bordercolor="#999999";
otMenu.level[0].offsetX=1;
otMenu.level[0].offsetY=1;
otMenu.level[0].NS4font="Tahoma,Arial,Helvetica";
otMenu.level[0].NS4fontSize="2";
otMenu.level[0].clip=1;
otMenu.level[0].clippx=20;
otMenu.level[0].cliptim=1;
otMenu.level[0].align="right";
otMenu.level[1]=new Array();
otMenu.level[1].width=145;
otMenu.makeMenu('foros','','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Foros','foros/index.php','',0,0,"","","","","","","","Javascript:window.status='Foros de discusi�n, en donde podr�s publicar tus inquietudes y comentarios sobre diversos temas.';","Javascript:window.status='';");
otMenu.makeMenu('encuestas','','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Encuestas','encuestas/index.php?pagina=1','',0,0,"","","","","","","","Javascript:window.status='Encuestas realizadas en este sitio Web.';","Javascript:window.status='';");
otMenu.makeMenu('chat','','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Chat','chat/index.php','',0,0,"","","","","","","","Javascript:window.status='Participa, conoce y chatea con gente como t�.';","Javascript:window.status='';");
otMenu.makeMenu('radio','','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Radio','radio/index.php','',0,0,"","","","","","","","Javascript:window.status='Escucha la mejor m�sica on-line.';","Javascript:window.status='';");
otMenu.makeMenu('sitios','','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Sitios de Inter&eacute;s','sitios/index.php?pagina=1','',0,0,"","","","","","","","Javascript:window.status='Direcciones de p�ginas Web interesantes para la comunidad estudiantil.';","Javascript:window.status='';");
otMenu.makeStyle();
otMenu.construct();
//-->