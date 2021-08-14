<!--
/**
 * herramientas.js.
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
 * Contiene las rutinas para la captura y el manejo de diversa información que se obtiene
 * de la máquina del cliente (Sistema Operativo, Navegador, Idioma y Plugin Flash).
 */
/**
 * Detecta si el plugin de Flash está instalado.
 */
function detectarFlash()
{
	var no_instalado=false;
	var flash=false;
	if(navigator.appName=="Microsoft Internet Explorer"&&(navigator.appVersion.indexOf("Mac")!=-1||navigator.appVersion.indexOf("3.1")!=-1))
		no_instalado=true;
	if(navigator.appName=="Microsoft Internet Explorer"&&!no_instalado)
		flash=true;
	else
		if(navigator.plugins)
		{
			if(navigator.plugins["Shockwave Flash"])
				flash=true;
			else flash=false;
		}
		else flash=false;
	return flash;
}
/**
 * Obtiene el nombre del sistema operativo usado en la máquina cliente.
 */
function detectarSistema()
{
	var sistema="";
	var agente=navigator.userAgent;
	if(agente.indexOf('HP')!=-1||agente.indexOf('HP-UX')!=-1||agente.indexOf('9000/720')!=-1)
		sistema="Hewlett-Packard Unix";
	else
	if(agente.indexOf('Linux')!=-1)
		sistema="Linux";
	else
	if(agente.indexOf('Macintosh')!=-1||agente.indexOf('PPC')!=-1||agente.indexOf('Mac_PowerPC')!=-1)
		sistema="Macintosh PowerPC";
	else
	if(agente.indexOf('Macintosh 68K')!=-1||agente.indexOf('68K')!=-1||agente.indexOf('Mac_68')!=-1)
		sistema="Macintosh 68K";
	else
	if(agente.indexOf('OS/2')!=-1)
		sistema="OS/2";
	else
	if(agente.indexOf('SunOS')!=-1)
		sistema="SunOS";
	else
	if(agente.indexOf('Win16')!=-1||agente.indexOf('Windows 3.1')!=-1)
		sistema="Windows 3.1";
	else
	if(agente.indexOf('Win95')!=-1||agente.indexOf('Windows 95')!=-1||agente.indexOf('Win98')!=-1||agente.indexOf('Windows 98')!=-1||agente.indexOf('WinME')!=-1||agente.indexOf('Windows ME')!=-1)
		sistema="Windows 95/98/ME";
	else
	if(agente.indexOf('WinNT')!=-1||agente.indexOf('Windows NT')!=-1||agente.indexOf('Win2000')!=-1||agente.indexOf('Windows 2000')!=-1||agente.indexOf('WinXP')!=-1||agente.indexOf('Windows XP')!=-1)
		sistema="Windows NT/2000/XP";
	else
	if(agente.indexOf('QNX')!=-1)
		sistema="QNX";
	else
	if(agente.indexOf('FreeBSD')!=-1)
		sistema="FreeBSD";
	else
	if(agente.indexOf('BeOS')!=-1)
		sistema="BeOS";
	else sistema="Otros";
	return sistema;
}
/**
 * Obtiene el nombre del navegador usado en la máquina cliente.
 */
function detectarNavegador()
{
	var navegador="";
	var agente=navigator.userAgent;
	var aplicacion=navigator.appName;
	if(aplicacion.indexOf('Microsoft Internet Explorer')!=-1||agente.indexOf('MSIE')!=-1)
	{
		if(aplicacion.indexOf('Opera')!=-1||agente.indexOf('Opera')!=-1)
			navegador="Opera";
		else
		if(agente.indexOf('MSIE 2')!=-1)
			navegador="Internet Explorer 2.x";
		else
		if(agente.indexOf('MSIE 3')!=-1)
			navegador="Internet Explorer 3.x";
		else
		if(agente.indexOf('MSIE 4')!=-1)
			navegador="Internet Explorer 4.x";
		else
		if(agente.indexOf('MSIE 5')!=-1)
			navegador="Internet Explorer 5.x";
		else
		if(agente.indexOf('MSIE 6')!=-1)
			navegador="Internet Explorer 6.x";
	}
	else
	{
		if(aplicacion.indexOf('Netscape')||agente.indexOf('Netscape')!=-1)
		{
			if(agente.indexOf('Mozilla/2')!=-1)
				navegador="Netscape 2.x";
			else
			if(agente.indexOf('Mozilla/3')!= -1)
				navegador="Netscape 3.x";
			else
			if(agente.indexOf("Mozilla/4")!= -1)
				navegador='Netscape 4.x';
			else
			if(agente.indexOf('Mozilla/5')!=-1&&agente.indexOf('Netscape5')!=-1)
				navegador="Netscape 5.x";
			else
			if(agente.indexOf('Netscape6')!=-1)
				navegador="Netscape 6.x";
			else
			if(agente.indexOf('Netscape/7')!=-1)
				navegador="Netscape 7.x";
		}
		else
		{
			if(agente.indexOf('Mozilla/5')!=-1&&agente.indexOf('Netscape5')==-1)
				navegador="Mozilla 1.x";
			else navegador="Otros";
		}
	}
	return navegador;
}
/**
 * Obtiene el código del idioma usado en la máquina cliente.
 */
function detectarIdioma()
{
	var idioma="";
	if(navigator.appName.indexOf('Microsoft Internet Explorer')!=-1||navigator.userAgent.indexOf('MSIE')!=-1)
		idioma=navigator.userLanguage.substring(0,2);
	else idioma=navigator.language.substring(0,2);
	return idioma;
}
//-->