function verify()
{
    var pass = document.getElementById("pass");
    var pass2 = document.getElementById("pass2");
    
    if (pass.value != pass2.value)
    {
        alert("Las contraseñas no coinciden, has escrito: " + pass.value + " y " + pass2.value);
        return false;
    }
    else
    {
        return true;
    }
}