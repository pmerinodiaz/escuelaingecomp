<!--
/**
 * menugeneral.js.
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
 * temas relacionados con la 'Informaci�n General'.
 */
geMenu=new makeCoolMenu("geMenu");
geMenu.useframes=0;
geMenu.frame="frmMain";
geMenu.useclick=0;
geMenu.useNS4links=1;
geMenu.NS4padding=2;
geMenu.checkselect=1;
geMenu.offlineUrl="file://C:/apache2/htdocs/escuelaingecomp/home/";
geMenu.onlineUrl="http://www.escuelaingecomp.tk";
geMenu.pagecheck=1;
geMenu.checkscroll=0;
geMenu.resizecheck=1;
geMenu.wait=200;
geMenu.usebar=1;
geMenu.barcolor="#000000";
geMenu.barwidth="menu";
geMenu.barheight="menu";
geMenu.barx="menu";
geMenu.bary="menu";
geMenu.barinheritborder=0;
geMenu.barinheritborder=0;
geMenu.rows=0;
geMenu.pxbetween=0;
geMenu.fromleft=0;
geMenu.fromtop=77;
geMenu.menuplacement=0;
geMenu.NS4hover=1;
geMenu.level[0]=new Array();
geMenu.level[0].width=152;
geMenu.level[0].height=17;
geMenu.level[0].bgcoloroff="#F1F1F1";
geMenu.level[0].bgcoloron="#CCCCCC";
geMenu.level[0].textcolor="#000000";
geMenu.level[0].hovercolor="#000000";
geMenu.level[0].style="padding:1px;padding-left:1px;font-family:Verdana;font-size:11.5px;";
geMenu.level[0].border=1;
geMenu.level[0].bordercolor="#999999";
geMenu.level[0].offsetX=1;
geMenu.level[0].offsetY=1;
geMenu.level[0].NS4font="Tahoma,Arial,Helvetica";
geMenu.level[0].NS4fontSize="2";
geMenu.level[0].clip=1;
geMenu.level[0].clippx=20;
geMenu.level[0].cliptim=1;
geMenu.level[0].align="right";
geMenu.level[1]=new Array();
geMenu.level[1].width=180;
geMenu.level[2]=new Array();
geMenu.level[2].width=150;
geMenu.makeMenu('escuela','','&nbsp;&nbsp;<img src="'+nivel+'librerias/awnegra.gif">&nbsp;&nbsp;Escuela','escuela/index.php','',0,0,"","","","","","","","Javascript:window.status='Contiene informaci�n sobre la Escuela Ingenier�a en Computaci�n de la ULS.';","Javascript:window.status='';");
geMenu.makeMenu('historia','escuela','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Rese&ntilde;a Hist&oacute;rica','escuela/historia/index.php','',0,0,"","","","","","","","Javascript:window.status='Muestra informaci�n de c�mo naci� y se forj� la Escuela Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('mision','escuela','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Misi&oacute;n','escuela/mision/index.php','',0,0,"","","","","","","","Javascript:window.status='Misi�n que tiene la Escuela con los estudiantes y la comunidad.';","Javascript:window.status='';");
geMenu.makeMenu('objescuela','escuela','&nbsp;&nbsp;<img src="'+nivel+'librerias/awnegra.gif">&nbsp;&nbsp;Objetivos','escuela/objetivos/index.php','',0,0,"","","","","","","","Javascript:window.status='Contiene informaci�n sobre los objetivos que tiene la Escuela Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('genescuela','objescuela','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Generales','escuela/objetivos/generales/index.php','',0,0,"","","","","","","","Javascript:window.status='Descripci�n de los objetivos generales de la Escuela Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('espescuela','objescuela','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Espec&iacute;ficos','escuela/objetivos/especificos/index.php','',0,0,"","","","","","","","Javascript:window.status='Descripci�n de los objetivos espec�ficos de la Escuela Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('carrera','','&nbsp;&nbsp;<img src="'+nivel+'librerias/awnegra.gif">&nbsp;&nbsp;Carrera','carrera/index.php','',0,0,"","","","","","","","Javascript:window.status='Contiene informaci�n sobre la carrera Ingenier�a en Computaci�n de la Universidad de La Serena.';","Javascript:window.status='';");
geMenu.makeMenu('perfil','carrera','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Perfil Profesional','carrera/perfil/index.php','',0,0,"","","","","","","","Javascript:window.status='Perfil profesional del Ingeniero en Computaci�n de la Universidad de La Serena.';","Javascript:window.status='';");
geMenu.makeMenu('roles','carrera','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Roles','carrera/roles/index.php','',0,0,"","","","","","","","Javascript:window.status='Roles que cumple el Ingeniero en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('objcarrera','carrera','&nbsp;&nbsp;<img src="'+nivel+'librerias/awnegra.gif">&nbsp;&nbsp;Objetivos','carrera/objetivos/index.php','',0,0,"","","","","","","","Javascript:window.status='Contiene informaci�n sobre los objetivos que tiene la carrera Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('gencarrera','objcarrera','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Generales','carrera/objetivos/generales/index.php','',0,0,"","","","","","","","Javascript:window.status='Descripci�n de los objetivos generales de la carrera Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('espcarrera','objcarrera','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Espec&iacute;ficos','carrera/objetivos/especificos/index.php','',0,0,"","","","","","","","Javascript:window.status='Descripci�n de los objetivos espec�ficos de la carrera Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('plan','carrera','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Plan de Estudio','carrera/planestudio/index.php','',0,0,"","","","","","","","Javascript:window.status='Muestra las asignaturas del plan de estudio de la carrera Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('titulacion','carrera','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Titulaci&oacute;n','carrera/titulacion/index.php','',0,0,"","","","","","","","Javascript:window.status='Requisitos necesarios para ser Ingeniero en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('malla','carrera','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Malla Curricular','carrera/malla/index.php','',0,0,"","","","","","","","Javascript:window.status='Asignaturas y actividades que conforman la malla curricular de la carrera.';","Javascript:window.status='';");
geMenu.makeMenu('infraestructura','','&nbsp;&nbsp;<img src="'+nivel+'librerias/awnegra.gif">&nbsp;&nbsp;Infraestructura','infraestructura/index.php','',0,0,"","","","","","","","Javascript:window.status='Contiene informaci�n sobre la tecnolog�a e infraestructura con que cuenta la Escuela.';","Javascript:window.status='';");
geMenu.makeMenu('edificio','infraestructura','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Edificio','infraestructura/edificio/index.php','',0,0,"","","","","","","","Javascript:window.status='Edificio en el cual la Escuela de Ingenier�a en Computaci�n desenvuelve sus actividades.';","Javascript:window.status='';");
geMenu.makeMenu('laboratorios','infraestructura','&nbsp;&nbsp;<img src="'+nivel+'librerias/awnegra.gif">&nbsp;&nbsp;Laboratorios','infraestructura/laboratorios/index.php','',0,0,"","","","","","","","Javascript:window.status='Laboratorios con que cuenta la Escuela Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('lab1','laboratorios','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Laboratorio 1','infraestructura/laboratorios/1/index.php','',0,0,"","","","","","","","Javascript:window.status='Laboratorio 1 de comunicaci�n de datos y redes.';","Javascript:window.status='';");
geMenu.makeMenu('lab2','laboratorios','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Laboratorio 2','infraestructura/laboratorios/2/index.php','',0,0,"","","","","","","","Javascript:window.status='Laboratorio 2 de pr�ctica.';","Javascript:window.status='';");
geMenu.makeMenu('lab3','laboratorios','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Laboratorio 3','infraestructura/laboratorios/3/index.php','',0,0,"","","","","","","","Javascript:window.status='Laboratorio 3 de �rea de desarrollo de software.';","Javascript:window.status='';");
geMenu.makeMenu('lab4','laboratorios','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Laboratorio 4','infraestructura/laboratorios/4/index.php','',0,0,"","","","","","","","Javascript:window.status='Laboratorio 4 de docencia y capacitaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('biblioteca','infraestructura','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Biblioteca IC','infraestructura/biblioteca/index.php?pagina=1','',0,0,"","","","","","","","Javascript:window.status='Libros, revistas y tesis con que cuenta la biblioteca de Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('campus','infraestructura','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Campus','infraestructura/campus/index.php','',0,0,"","","","","","","","Javascript:window.status='Campus en el cual la Escuela Ingenier�a en Computaci�n desenvuelve sus actividades.';","Javascript:window.status='';");
geMenu.makeMenu('admision','','&nbsp;&nbsp;<img src="'+nivel+'librerias/awnegra.gif">&nbsp;&nbsp;Admisi&oacute;n','admision/index.php','',0,0,"","","","","","","","Javascript:window.status='Contiene informaci�n sobre el proceso de admisi�n.';","Javascript:window.status='';");
geMenu.makeMenu('postulacion','admision','&nbsp;&nbsp;<img src="'+nivel+'librerias/awnegra.gif">&nbsp;&nbsp;Postulaci&oacute;n','admision/postulacion/index.php','',0,0,"","","","","","","","Javascript:window.status='Contiene informaci�n sobre el proceso de postulaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('posuls','postulacion','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;ULS','admision/postulacion/uls/index.php','',0,0,"","","","","","","","Javascript:window.status='Muestra informaci�n sobre el proceso de postulaci�n a la Universidad de La Serena.';","Javascript:window.status='';");
geMenu.makeMenu('poscarrera','postulacion','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Carrera','admision/postulacion/carrera/index.php','',0,0,"","","","","","","","Javascript:window.status='Requisitos, n�mero de vacantes, puntajes, aranceles de la carrera y mucho m�s.';","Javascript:window.status='';");
geMenu.makeMenu('calculo','admision','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;C&aacute;lculo Puntaje','admision/calculopuntaje/index.php','',0,0,"","","","","","","","Javascript:window.status='Calcula tu puntaje ponderado y tus posibilidades de ingreso.';","Javascript:window.status='';");
geMenu.makeMenu('consultas','admision','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Consultas','admision/consultas/index.php?pagina=1','',0,0,"","","","","","","","Javascript:window.status='Muestra todas las consultas que hemos recibido sobre el tema admisi�n.';","Javascript:window.status='';");
geMenu.makeMenu('investigacion','','&nbsp;&nbsp;<img src="'+nivel+'librerias/awnegra.gif">&nbsp;&nbsp;Investigaci&oacute;n','investigacion/index.php','',0,0,"","","","","","","","Javascript:window.status='Contiene informaci�n sobre la investigaci�n llevada a cabo por la Escuela Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('lineas','investigacion','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;L&iacute;neas de Investigaci&oacute;n','investigacion/lineas/index.php','',0,0,"","","","","","","","Javascript:window.status='Muestra las l�neas de investigaci�n de la Escuela Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('proyectos','investigacion','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Proyectos','investigacion/proyectos/index.php?pagina=1','',0,0,"","","","","","","","Javascript:window.status='Proyectos de investigaci�n desarrollados en la Escuela Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('publicaciones','investigacion','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Publicaciones','investigacion/publicaciones/index.php?pagina=1','',0,0,"","","","","","","","Javascript:window.status='Publicaciones realizadas en la Escuela Ingenier�a en Computaci�n.';","Javascript:window.status='';")
geMenu.makeMenu('integrantes','','&nbsp;&nbsp;<img src="'+nivel+'librerias/awnegra.gif">&nbsp;&nbsp;Integrantes','integrantes/index.php','',0,0,"","","","","","","","Javascript:window.status='Contiene informaci�n de los integrantes de la Escuela.';","Javascript:window.status='';");
geMenu.makeMenu('academicos','integrantes','&nbsp;&nbsp;<img src="'+nivel+'librerias/awnegra.gif">&nbsp;&nbsp;Acad&eacute;micos','integrantes/academicos/index.php','',0,0,"","","","","","","","Javascript:window.status='Cuerpo acad�mico de la Escuela Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('completa','academicos','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Jornada Completa','integrantes/academicos/completa/index.php','',0,0,"","","","","","","","Javascript:window.status='Acad�micos jornada completa de la Escuela en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('media','academicos','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Media Jornada','integrantes/academicos/media/index.php','',0,0,"","","","","","","","Javascript:window.status='Acad�micos media jornada de la Escuela en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('part','academicos','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Part-Time','integrantes/academicos/part/index.php','',0,0,"","","","","","","","Javascript:window.status='Acad�micos part-time de la Escuela en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('cec','integrantes','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;CEC','integrantes/cec/index.php','',0,0,"","","","","","","","Javascript:window.status='Centro de Estudiantes de Computaci�n (CEC).';","Javascript:window.status='';");
geMenu.makeMenu('alumnos','integrantes','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Alumnos','integrantes/alumnos/index.php','',0,0,"","","","","","","","Javascript:window.status='Alumnos de la carrera Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('exalumnos','integrantes','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Ex-Alumnos','integrantes/ex-alumnos/index.php','',0,0,"","","","","","","","Javascript:window.status='Ex-alumnos destacados de la carrera Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('administrativos','integrantes','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Administrativos','integrantes/administrativos/index.php','',0,0,"","","","","","","","Javascript:window.status='Personal administrativo de la Escuela Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('ayudantes','integrantes','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Ayudantes','integrantes/ayudantes/index.php','',0,0,"","","","","","","","Javascript:window.status='Ayudantes de asignaturas en la carrera Ingenier�a en Computaci�n.';","Javascript:window.status='';")
geMenu.makeMenu('servicios','','&nbsp;&nbsp;<img src="'+nivel+'librerias/awnegra.gif">&nbsp;&nbsp;Servicios','servicios/index.php','',0,0,"","","","","","","","Javascript:window.status='Contiene informaci�n de diversos servicios que se ofrecen y solicitan.';","Javascript:window.status='';");
geMenu.makeMenu('ofeservicios','servicios','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Ofertas','servicios/ofertas/index.php','',0,0,"","","","","","","","Javascript:window.status='Ofertas de servicios realizadas por la comunidad estudiantil.';","Javascript:window.status='';");
geMenu.makeMenu('solservicios','servicios','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Solicitudes','servicios/solicitudes/index.php','',0,0,"","","","","","","","Javascript:window.status='Personas, empresas, organizaciones y dem�s solicitan servicios a la comunidad estudiantil y acad�mica.';", "Javascript:window.status='';")
geMenu.makeMenu('software','','&nbsp;&nbsp;<img src="'+nivel+'librerias/awnegra.gif">&nbsp;&nbsp;Software','software/index.php','',0,0,"","","","","","","","Javascript:window.status='Diversos software que te ser�n de gran utilidad.';","Javascript:window.status='';");
geMenu.makeMenu('nuesoftware','software','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Nuestros','software/nuestros/index.php','',0,0,"","","","","","","","Javascript:window.status='Software creados por alumnos y/o acad�micos de la Escuela Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('tersoftware','software','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;De Terceros','software/terceros/index.php','',0,0,"","","","","","","","Javascript:window.status='Software y utilidades encontrados en Internet.';","Javascript:window.status='';");
geMenu.makeMenu('estsoftware','software','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Estad&iacute;sticas','software/estadisticas/index.php','',0,0,"","","","","","","","Javascript:window.status='Diversas estad�sticas de los software.';","Javascript:window.status='';");
geMenu.makeMenu('tutoriales','','&nbsp;&nbsp;<img src="'+nivel+'librerias/awnegra.gif">&nbsp;&nbsp;Tutoriales','tutoriales/index.php','',0,0,"","","","","","","","Javascript:window.status='Tutoriales, manuales, cursos y documentaci�n variada.';","Javascript:window.status='';");
geMenu.makeMenu('nuetutoriales','tutoriales','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Nuestros','tutoriales/nuestros/index.php','',0,0,"","","","","","","","Javascript:window.status='Tutoriales creados por alumnos y/o acad�micos de la Escuela Ingenier�a en Computaci�n.';","Javascript:window.status='';");
geMenu.makeMenu('tertutoriales','tutoriales','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;De Terceros','tutoriales/terceros/index.php','',0,0,"","","","","","","","Javascript:window.status='Tutoriales encontrados en Internet.';","Javascript:window.status='';");
geMenu.makeMenu('esttutoriales','tutoriales','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Estad&iacute;sticas','tutoriales/estadisticas/index.php','',0,0,"","","","","","","","Javascript:window.status='Diversas estad�sticas de los tutoriales.';","Javascript:window.status='';")
geMenu.makeMenu('faq','','&nbsp;&nbsp;<img src="'+nivel+'librerias/pxtransparente.gif" width="4" height="7">&nbsp;&nbsp;Preguntas Frecuentes','faq/index.php?pagina=1','',0,0,"","","","","","","","Javascript:window.status='Preguntas m�s frecuentes sobre nuestro servicio.';","Javascript:window.status='';");
geMenu.makeStyle();
geMenu.construct();
//-->