<!--
/**
 * menuacademico.js
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
 * Creaci�n del men� para los acad�micos en la Intranet.
 */
arMenu=new makeCoolMenu("arMenu");
arMenu.useframes=0;
arMenu.frame="frmMain";
arMenu.useclick=0;
arMenu.useNS4links=1;
arMenu.NS4padding=2;
arMenu.checkselect=1;
arMenu.offlineUrl="file://C:/apache2/htdocs/escuelaingecomp/intranet/academico/";
arMenu.onlineUrl="http://www.escuelaingecomp.tk/intranet/academico/";
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
arMenu.level[1].offsetX=82;
arMenu.level[1].offsetY=3;
arMenu.level[2]=new Array();
arMenu.level[2].width=86;
arMenu.level[2].height=15;
arMenu.makeMenu('principal','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Principal','index.php',"",0,0,"","","","","","","","Javascript:window.status='P�gina Principal.';","Javascript:window.status='';");
arMenu.makeMenu('antecedentes','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Antecedentes','antecedentes/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar antecedentes personales y docentes.';","Javascript:window.status='';");
arMenu.makeMenu('antecedentes1','antecedentes','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Personales','personales/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar antecedentes personales.';","Javascript:window.status='';");
arMenu.makeMenu('antecedentes2','antecedentes','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Docentes','docentes/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar antecedentes docentes.';","Javascript:window.status='';");
arMenu.makeMenu('servicios','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Servicios','servicios/index.php',"",0,0,"","","","","","","","Javascript:window.status='Servicios.';","Javascript:window.status='';");
arMenu.makeMenu('servicios1','servicios','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Ofertas','ofertas/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar, modificar y eliminar ofertas de servicios.';","Javascript:window.status='';");
arMenu.makeMenu('servicios2','servicios','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Solicitudes','solicitudes/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar, modificar y eliminar solicitudes de servicios.';","Javascript:window.status='';");
arMenu.makeMenu('ofertas1','servicios1','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Agregar','ofertas/agregar/index.php',"",0,0,"","",'','',"","","","Javascript:window.status='Agregar oferta de servicio.';","Javascript:window.status='';");
arMenu.makeMenu('ofertas2','servicios1','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Modificar','ofertas/modificar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar oferta de servicio.';","Javascript:window.status='';");
arMenu.makeMenu('ofertas3','servicios1','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Eliminar','ofertas/eliminar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Eliminar oferta de servicio.';","Javascript:window.status='';");
arMenu.makeMenu('solicitud1','servicios2','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Agregar','solicitudes/agregar/index.php',"",0,0,"","",'','',"","","","Javascript:window.status='Agregar solicitud de servicio.';","Javascript:window.status='';");
arMenu.makeMenu('solicitud2','servicios2','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Modificar','solicitudes/modificar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar solicitud de servicio.';","Javascript:window.status='';");
arMenu.makeMenu('solicitud3','servicios2','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Eliminar','solicitudes/eliminar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Eliminar solicitud de servicio.';","Javascript:window.status='';");
arMenu.makeMenu('utilidades','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Utilidades','utilidades/index.php',"",0,0,"","","","","","","","Javascript:window.status='Utilidades.';","Javascript:window.status='';");
arMenu.makeMenu('software','utilidades','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Software','software/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar, modificar y eliminar software.';","Javascript:window.status='';");
arMenu.makeMenu('tutoriales','utilidades','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Tutoriales','tutoriales/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar, modificar y eliminar tutoriales.';","Javascript:window.status='';");
arMenu.makeMenu('foros','utilidades','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Foros','foros/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar, modificar y eliminar foros.';","Javascript:window.status='';");
arMenu.makeMenu('software1','software','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Agregar','software/agregar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar software.';","Javascript:window.status='';");
arMenu.makeMenu('software2','software','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Modificar','software/modificar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar software.';","Javascript:window.status='';");
arMenu.makeMenu('software3','software','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Eliminar','software/eliminar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Eliminar software.';","Javascript:window.status='';");
arMenu.makeMenu('tutoriales1','tutoriales','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Agregar','tutoriales/agregar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar tutorial.';","Javascript:window.status='';");
arMenu.makeMenu('tutoriales2','tutoriales','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Modificar','tutoriales/modificar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar tutorial.';","Javascript:window.status='';");
arMenu.makeMenu('tutoriales3','tutoriales','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Eliminar','tutoriales/eliminar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Eliminar tutorial.';","Javascript:window.status='';");
arMenu.makeMenu('foros1','foros','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Agregar','foros/agregar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar foro.';","Javascript:window.status='';");
arMenu.makeMenu('foros2','foros','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Modificar','foros/modificar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar foro.';","Javascript:window.status='';");
arMenu.makeMenu('foros3','foros','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Eliminar','foros/eliminar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Eliminar foro.';","Javascript:window.status='';");
arMenu.makeMenu('investigacion','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Investigaci&oacute;n','investigacion/index.php',"",0,0,"","","","","","","","Javascript:window.status='Investigaci�n.';","Javascript:window.status='';");
arMenu.makeMenu('publicaciones','investigacion','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Publicaciones','publicaciones/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar, modificar y eliminar publicaciones.';","Javascript:window.status='';");
arMenu.makeMenu('proyectos','investigacion','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Proyectos','proyectos/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar, modificar y eliminar proyectos.';","Javascript:window.status='';");
arMenu.makeMenu('tesis','investigacion','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Ofertas Tesis','tesis/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar, modificar y eliminar ofertas de tesis.';","Javascript:window.status='';");
arMenu.makeMenu('publicaciones1','publicaciones','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Agregar','publicaciones/agregar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar publicaci�n.';","Javascript:window.status='';");
arMenu.makeMenu('publicaciones2','publicaciones','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Modificar','publicaciones/modificar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar publicaci�n.';","Javascript:window.status='';");
arMenu.makeMenu('publicaciones3','publicaciones','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Eliminar','publicaciones/eliminar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Eliminar publicaci�n.';","Javascript:window.status='';");
arMenu.makeMenu('proyectos1','proyectos','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Agregar','proyectos/agregar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar proyecto.';","Javascript:window.status='';");
arMenu.makeMenu('proyectos2','proyectos','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Modificar','proyectos/modificar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar proyecto.';","Javascript:window.status='';");
arMenu.makeMenu('proyectos3','proyectos','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Eliminar','proyectos/eliminar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Eliminar proyecto.';","Javascript:window.status='';");
arMenu.makeMenu('tesis1','tesis','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Agregar','tesis/agregar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar oferta de tesis.';","Javascript:window.status='';");
arMenu.makeMenu('tesis2','tesis','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Modificar','tesis/modificar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar oferta de tesis.';","Javascript:window.status='';");
arMenu.makeMenu('tesis3','tesis','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Eliminar','tesis/eliminar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Eliminar oferta de tesis.';","Javascript:window.status='';");
arMenu.makeMenu('biblioteca','','<img src="'+nivel+'librerias/pxblanco.gif" width="1" height="10">&nbsp;&nbsp;Biblioteca IC','biblioteca/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar, modificar y eliminar publicaciones en Biblioteca IC.';","Javascript:window.status='';");
arMenu.makeMenu('biblioteca1','biblioteca','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Agregar','biblioteca/agregar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Agregar publicaci�n en Biblioteca IC.';","Javascript:window.status='';");
arMenu.makeMenu('biblioteca2','biblioteca','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Modificar','biblioteca/modificar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Modificar publicaci�n en Biblioteca IC.';","Javascript:window.status='';");
arMenu.makeMenu('biblioteca3','biblioteca','<img src="'+nivel+'librerias/pxtransparente.gif" width="1" height="10">&nbsp;&nbsp;Eliminar','biblioteca/eliminar/index.php',"",0,0,"","","","","","","","Javascript:window.status='Eliminar publicaci�n en Biblioteca IC.';","Javascript:window.status='';");
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