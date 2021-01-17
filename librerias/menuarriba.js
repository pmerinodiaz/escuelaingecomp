<!--
/**
 * menuarriba.js.
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
 * Creaci�n del men� que est� en la parte de arriba del Web. Este men� contiene los temas
 * transversales del sitio Web.
 */
arMenu=new makeCoolMenu("arMenu");
arMenu.useframes=0;
arMenu.frame="frmMain";
arMenu.useclick=0;
arMenu.useNS4links=1;
arMenu.NS4padding=2;
arMenu.checkselect=1;
arMenu.offlineUrl="file://C:/apache2/htdocs/escuelaingecomp/home/";
arMenu.onlineUrl="http://www.escuelaingecomp.tk";
arMenu.pagecheck=1;
arMenu.checkscroll=0;
arMenu.resizecheck=1;
arMenu.wait=200;
arMenu.usebar=1;
arMenu.barcolor="#000000";
arMenu.barwidth="menu";
arMenu.barheight="menu";
arMenu.barx="menu";
arMenu.bary="menu";
arMenu.barinheritborder=0;
arMenu.barinheritborder=0;
arMenu.rows=1;
arMenu.pxbetween=0;
arMenu.fromleft=380;
arMenu.fromtop=0;
arMenu.menuplacement=0;
arMenu.NS4hover=1;
arMenu.level[0]=new Array();
arMenu.level[0].width=80;
arMenu.level[0].height=17;
arMenu.level[0].bgcoloroff="#000000";
arMenu.level[0].bgcoloron="#000000";
arMenu.level[0].textcolor="#FFFFFF";
arMenu.level[0].hovercolor="#FF0000";
arMenu.level[0].style="padding:1px;padding-left:1px;font-family:Verdana;font-size:9px;";
arMenu.level[0].border=0;
arMenu.level[0].offsetX=0;
arMenu.level[0].offsetY=17;
arMenu.level[0].NS4font="Tahoma,Arial,Helvetica";
arMenu.level[0].NS4fontSize="2";
arMenu.level[0].clip=1;
arMenu.level[0].clippx=20;
arMenu.level[0].cliptim=1;
arMenu.level[0].align="middle";
arMenu.level[1]=new Array();
arMenu.level[1].width=90;
arMenu.level[1].height=15;
arMenu.makeMenu('contactenos','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Cont&aacute;ctenos','contacto/index.php','',0,0,"","","","","","","","Javascript:window.status='Env�anos tus preguntas, sugerencias y comentarios.';","Javascript:window.status='';");
arMenu.makeMenu('noticias','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Noticias','noticias/index.php','',0,0,"","","","","","","","Javascript:window.status='Muestra las �ltimas novedades e informaciones.';","Javascript:window.status='';");
arMenu.makeMenu('universidad','noticias','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Universidad','noticias/universidad/index.php?pagina=1','',0,0,"","","","","","","","Javascript:window.status='Actualidad y noticias universitarias.';","Javascript:window.status='';");
arMenu.makeMenu('tecnologia','noticias','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Tecnolog&iacute;a','noticias/tecnologia/index.php?pagina=1','',0,0,"","","","","","","","Javascript:window.status='Noticias sobre las nuevas tecnolog�as de la computaci�n.';","Javascript:window.status='';");
arMenu.makeMenu('busqueda','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;B&uacute;squeda','busqueda/index.php','',0,0,"","","","","","","","Javascript:window.status='Busca informaci�n en diferentes recursos.';","Javascript:window.status='';");
arMenu.makeMenu('esteweb','busqueda','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;En este Web','busqueda/web/index.php','',0,0,"","","","","","","","Javascript:window.status='Busca informaci�n en este Web.';","Javascript:window.status='';");
arMenu.makeMenu('internet','busqueda','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;En Internet','busqueda/internet/index.php','',0,0,"","","","","","","","Javascript:window.status='Busca informaci�n en Internet.';","Javascript:window.status='';");
arMenu.makeMenu('mapasitio','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Mapa Sitio','mapa/index.php','',0,0,"","","","","","","","Javascript:window.status='Muestra toda la estructura del sitio.';","Javascript:window.status='';");
arMenu.makeMenu('webmail','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Webmail','webmail/index.php','',0,0,"","","","","","","","Javascript:window.status='Env�a y recibe correo electr�nico desde este Web.';","Javascript:window.status='';");
arMenu.makeStyle();
arMenu.construct();
//-->