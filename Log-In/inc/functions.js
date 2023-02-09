function verify(form)
{
	if (form.pass.value != form.pass2.value)
	{
    	alert(`Las contraseñas no coinciden, por favor escríbelas nuevamente. ${form.pass.value} ${form.pass2.value}`);
		return false;
    }
    else
    {
    	return true;
    }
}

function change()
{
	if (document.getElementById("register").value === "Regístrate aquí")
	{
		document.getElementById("register").value = "Cerrar sesión";
	}
	else
	{
		document.getElementById("register").value = "Regístrate aquí";
		session_destroy();
		header("Location:index.php");
		exit;
	}
}