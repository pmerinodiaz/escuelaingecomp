<?PHP
/**
 * control.php.
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
 * Programa que realiza la verificaci�n de que el usuario interno ingres� correctamente su
 * nombre de usuario (RUT completo) y su clave secreta.
 */

session_start();

if (isset($_POST['usuario']) && isset($_POST['clave']) && isset($_POST['privilegio']))
    $correcto = true;
else
    $correcto = false;

// Cuando los par�metros son v�lidos.
if ($correcto) {
	// Librer�as necesarias.
	include("../librerias/control.php");
	include("../librerias/conexion.php");
	
	// Creamos un objeto conexi�n y nos conectamos a la base de datos.
	$conexion = new conexion();
	$link = $conexion->conectar();
	
	// Creamos un objeto control para iniciar sesion si fuese posible.
	$control = new control($link);
	
	// Vemos la validaci�n de los datos.
	$check = $control->validar($_POST['usuario'], $_POST['clave'], $_POST['privilegio']);
	
	// En caso de que el usuario fue encontrado.
	if ($check)
	{
	    // Registramos las variables de la sesi�n.
		$_SESSION['autentificado'] = "si";
		$_SESSION['id_persona'] = $control->idPersona();
		
		// Configuramos el destino y el permiso, dependiendo de los privilegios.
		switch ($_POST['privilegio'])
		{
			// Webmaster.
			case 1:
			{
				$ubicacion = "webmaster/index.php";
				$_SESSION['permiso'] = "webmaster";
				break;
			}
			// Intregante CEC.
			case 2:
			{
				$ubicacion = "cec/index.php";
				$_SESSION['permiso'] = "cec";
				break;
			}
			// Acad�mico.
			case 3:
			{
				$ubicacion = "academico/index.php";
				$_SESSION['permiso'] = "academico";
				break;
			}
			// Alumno.
			case 4:
			{
				$ubicacion = "alumno/index.php";
				$_SESSION['permiso'] = "alumno";
				break;
			}
			// Administrativo.
			case 5:
			{
				$ubicacion = "administrativo/index.php";
				$_SESSION['permiso'] = "administrativo";
				break;
			}
		}
	    // Redireccionamos al Home del tipo de usuario.
		header("Location:$ubicacion");
	}
	// En caso de que el usuario no fue encontrado, entonces volvemos al formulario.
	else {
        // Obtenemos el error y redireccionamos al Home de la Intranet.
		$error = $control->error();
		header("Location:index.php?error=$error");
	}
	
    // Desconectamos la conexi�n a la base de datos.
	$conexion->desconectar();
}

// Cuando los datos del formulario no fueron recibidos.
else
  header("Location:index.php?control_parametros_incorrectos");
?>