<!--
/**
 * menulocal.js.
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
 * temas relacionados con la 'Informaci�n Local'.
 */
alMenu=new makeCoolMenu("alMenu");
alMenu.useframes=0;
alMenu.frame="frmMain";
alMenu.useclick=0;
alMenu.useNS4links=1;
alMenu.NS4padding=2;
alMenu.checkselect=1;
alMenu.offlineUrl="file://C:/apache2/htdocs/escuelaingecomp/home/";
alMenu.onlineUrl="http://www.escuelaingecomp.tk";
alMenu.pagecheck=1;
alMenu.checkscroll=0;
alMenu.resizecheck=1;
alMenu.wait=200;
alMenu.usebar=1;
alMenu.barcolor="#000000";
alMenu.barwidth="menu";
alMenu.barheight="menu";
alMenu.barx="menu";
alMenu.bary="menu";
alMenu.barinheritborder=0;
alMenu.barinheritborder=0;
alMenu.rows=0;
alMenu.pxbetween=0;
alMenu.fromleft=0;
alMenu.fromtop=275;
alMenu.menuplacement=0;
alMenu.NS4hover=1;
alMenu.level[0]=new Array();
alMenu.level[0].width=152;
alMenu.level[0].height=17;
alMenu.level[0].bgcoloroff="#F1F1F1";
alMenu.level[0].bgcoloron="#CCCCCC";
alMenu.level[0].textcolor="#000000";
alMenu.level[0].hovercolor="#000000";
alMenu.level[0].style="padding:1px;padding-left:1px;font-family:Verdana;font-size:11.5px;";
alMenu.level[0].border=1;
alMenu.level[0].bordercolor="#999999";
alMenu.level[0].offsetX=1;
alMenu.level[0].offsetY=1;
alMenu.level[0].NS4font="Tahoma,Arial,Helvetica";
alMenu.level[0].NS4fontSize="2";
alMenu.level[0].clip=1;
alMenu.level[0].clippx=20;
alMenu.level[0].cliptim=1;
alMenu.level[0].align="right";
alMenu.level[1]=new Array();
alMenu.level[1].width=115;
alMenu.makeMenu('asignaturas','','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Asignaturas','asignaturas/index.php','',0,0,"","","","","","","","Javascript:window.status='Lista de asignaturas del plan de estudio la carrera Ingenier�a en Computaci�n.';","Javascript:window.status='';");
alMenu.makeMenu('pruebas','','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Banco de Pruebas','pruebas/index.php','',0,0,"","","","","","","","Javascript:window.status='Pruebas parciales y ex�menes de los �ltimos a�os.';","Javascript:window.status='';");
alMenu.makeMenu('calendario','','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Calendario','calendario/index.php','',0,0,"","","","","","","","Javascript:window.status='Calendario acad�mico de la Universidad de La Serena.';","Javascript:window.status='';");
alMenu.makeMenu('horario','','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Horarios','horarios/index.php','',0,0,"","","","","","","","Javascript:window.status='Horarios de clases del a�o acad�mico.';","Javascript:window.status='';");
alMenu.makeMenu('intranet','','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Intranet','intranet/visita.php','_blank',0,0,"","","","","","","","Javascript:window.status='Diversos servicios e informaci�n orientada a nuestra comunidad estudiantil.';","Javascript:window.status='';");
alMenu.makeMenu('practica','','&nbsp;&nbsp;<img src="'+nivel+'librerias/awnegra.gif">&nbsp;&nbsp;Pr&aacute;ctica','practica/index.php','',0,0,"","","","","","","","Javascript:window.status='Contiene informaci�n sobre la pr�ctica profesional.';","Javascript:window.status='';");
alMenu.makeMenu('regpractica','practica','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Reglamento','practica/reglamento/index.php','',0,0,"","","","","","","","Javascript:window.status='Reglamento interno de la pr�ctica profesional.';","Javascript:window.status='';");
alMenu.makeMenu('ofepractica','practica','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Ofertas','practica/ofertas/index.php?pagina=1','',0,0,"","","","","","","","Javascript:window.status='Ofertas de pr�ctica profesional.';","Javascript:window.status='';")
alMenu.makeMenu('tesis','','&nbsp;&nbsp;<img src="'+nivel+'librerias/awnegra.gif">&nbsp;&nbsp;Tesis','tesis/index.php','',0,0,"","","","","","","","Javascript:window.status='Contiene informaci�n sobre la tesis de grado.';","Javascript:window.status='';");
alMenu.makeMenu('regtesis','tesis','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Reglamento','tesis/reglamento/index.php','',0,0,"","","","","","","","Javascript:window.status='Reglamento interno de la tesis de grado.';","Javascript:window.status='';");
alMenu.makeMenu('ofetesis','tesis','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Ofertas','tesis/ofertas/index.php?pagina=1','',0,0,"","","","","","","","Javascript:window.status='Temas de tesis ofrecidos por acad�micos de la Escuela Ingenier�a en Computaci�n.';","Javascript:window.status='';");
alMenu.makeMenu('histesis','tesis','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Historial','tesis/historial/index.php?pagina=1','',0,0,"","","","","","","","Javascript:window.status='Historial de las tesis de grado.';","Javascript:window.status='';");
alMenu.makeStyle();
alMenu.construct();
//-->