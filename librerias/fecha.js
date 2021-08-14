<!--
/**
 * fecha.js.
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
 * Rutinas que manejan la fecha del cliente.
 */
/**
 * Constructor de elementos.
 */
function Item()
{
	this.length=Item.arguments.length;
	for (var i=0;i<this.length;i++)
		this[i]=Item.arguments[i];
}
/**
 * Muestra la fecha actual del cliente.
 */
function obtenerFecha()
{
	var ndia=new Item('Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado');
	var nmes=new Item('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
	var ahora;
	var fecha=new Date();
	var anio=fecha.getYear();
	var mes=fecha.getMonth();
	var dia=fecha.getDay();
	var aux=""+fecha;
	if (anio<10) anio2="200"+eval(anio);
	else if(anio<80) anio2="20"+anio;
			 else if(anio<=99) anio2="19"+anio;
						else if(anio<1000) anio2=eval(anio)+eval(1900);
									else anio2=anio;
	ahora=ndia[dia]+", "+eval(aux.substring(7, 10))+" de "+nmes[mes]+" del "+anio2;
	return ahora;
}
//-->