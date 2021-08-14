<!--
/**
 * menucec.js
 * v. 1.0.
 * Diciembre, 2004.
 *
 * Copyright (C) 2004 por Héctor Díaz Díaz - Patricio Merino Díaz.
 * Escuela Ingeniería en Computación, Universidad de La Serena, Chile.
 * Todos los derechos reservados.
 *
 * No se asume ninguna  responsabilidad por el  uso o  alteración  de este software.
 * Este software se proporciona como es y sin garantía de ningún tipo de su funcionamiento
 * y en ningún caso será el autor responsable de daños o perjuicios que se deriven del mal
 * uso del software, aún cuando este haya sido notificado de la posibilidad de dicho daño.
 *
 * Creación del menú para los integrantes del CEC en la Intranet.
 */
arMenu=new makeCoolMenu("arMenu");
arMenu.useframes=0;
arMenu.frame="frmMain";
arMenu.useclick=0;
arMenu.useNS4links=1;
arMenu.NS4padding=2;
arMenu.checkselect=1;
arMenu.offlineUrl="file://C:/apache2/htdocs/escuelaingecomp/intranet/cec/";
arMenu.onlineUrl="http://www.escuelaingecomp.tk/intranet/cec/";
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
arMenu.fromleft=132;
arMenu.fromtop=63;
arMenu.menuplacement=0;
arMenu.NS4hover=1;
arMenu.level[0]=new Array();
arMenu.level[0].width=81;
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
arMenu.level[1].width=81;
arMenu.level[1].height=15;
arMenu.makeMenu('principal','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Principal','index.php',"",0,0,"","","","","","","","Javascript:window.status='Página Principal.';","Javascript:window.status='';");
arMenu.makeMenu('antecedentes','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Antecedentes','antecedentes/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar antecedentes personales y CEC.';","Javascript:window.status='';");
arMenu.makeMenu('antecedentes1','antecedentes','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Personales','personales/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar antecedentes personales.';","Javascript:window.status='';");
arMenu.makeMenu('antecedentes2','antecedentes','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;CEC','cec/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar antecedentes CEC.';","Javascript:window.status='';");
arMenu.makeMenu('servicios','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Servicios','ofertas/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar, modificar y eliminar ofertas de servicios.';","Javascript:window.status='';");
arMenu.makeMenu('servicios1','servicios','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Agregar','ofertas/agregar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar oferta de servicio.';","Javascript:window.status='';");
arMenu.makeMenu('servicios2','servicios','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Modificar','ofertas/modificar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar oferta de servicio.';","Javascript:window.status='';");
arMenu.makeMenu('servicios3','servicios','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Eliminar','ofertas/eliminar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Eliminar oferta de servicio.';","Javascript:window.status='';");
arMenu.makeMenu('software','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Software','software/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar, modificar y eliminar software.';","Javascript:window.status='';");
arMenu.makeMenu('software1','software','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Agregar','software/agregar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar software.';","Javascript:window.status='';");
arMenu.makeMenu('software2','software','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Modificar','software/modificar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar software.';","Javascript:window.status='';");
arMenu.makeMenu('software3','software','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Eliminar','software/eliminar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Eliminar software.';","Javascript:window.status='';");
arMenu.makeMenu('tutoriales','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Tutoriales','tutoriales/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar, modificar y eliminar tutoriales.';","Javascript:window.status='';");
arMenu.makeMenu('tutoriales1','tutoriales','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Agregar','tutoriales/agregar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar tutorial.';","Javascript:window.status='';");
arMenu.makeMenu('tutoriales2','tutoriales','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Modificar','tutoriales/modificar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar tutorial.';","Javascript:window.status='';");
arMenu.makeMenu('tutoriales3','tutoriales','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Eliminar','tutoriales/eliminar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Eliminar tutorial.';","Javascript:window.status='';");
arMenu.makeMenu('foros','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Foros','foros/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar, modificar y eliminar foros.';","Javascript:window.status='';");
arMenu.makeMenu('foros1','foros','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Agregar','foros/agregar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar foro.';","Javascript:window.status='';");
arMenu.makeMenu('foros2','foros','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Modificar','foros/modificar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar foro.';","Javascript:window.status='';");
arMenu.makeMenu('foros3','foros','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Eliminar','foros/eliminar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Eliminar foro.';","Javascript:window.status='';");
arMenu.makeMenu('pruebas','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Pruebas','pruebas/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar, modificar y eliminar pruebas.';","Javascript:window.status='';");
arMenu.makeMenu('pruebas1','pruebas','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Agregar','pruebas/agregar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar prueba.';","Javascript:window.status='';");
arMenu.makeMenu('pruebas2','pruebas','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Modificar','pruebas/modificar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar prueba.';","Javascript:window.status='';");
arMenu.makeMenu('pruebas3','pruebas','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Eliminar','pruebas/eliminar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Eliminar prueba.';","Javascript:window.status='';");
arMenu.makeMenu('noticias','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Noticias','noticias/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar, modificar y eliminar noticias.';","Javascript:window.status='';");
arMenu.makeMenu('noticias1','noticias','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Agregar','noticias/agregar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar noticia.';","Javascript:window.status='';");
arMenu.makeMenu('noticias2','noticias','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Modificar','noticias/modificar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar noticia.';","Javascript:window.status='';");
arMenu.makeMenu('noticias3','noticias','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Eliminar','noticias/eliminar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Eliminar noticia.';","Javascript:window.status='';");
arMenu.makeStyle();
arMenu.construct();
//-->