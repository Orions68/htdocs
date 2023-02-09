var already = false; // already se usa para verificar si se cambió lo iconos de las redes.
var already2 = false; // already2 se usa para verificar si se cambió la bandera del idioma.

function screenSize()
{
    var screenHeight = window.innerHeight;
    page_top.style.height = screenHeight + "px";
    if (document.getElementById("view1") != null)
    {
        view1.style.height = screenHeight + "px";
    }
    view2.style.height = screenHeight - 190 + "px";
}

function verify(form)
{
    var user = document.getElementById("username");
    var pass = document.getElementById("pass");
    var pass2 = document.getElementById("pass2");
    
    if (pass.value != pass2.value)
    {
        alert("Las contraseñas no coinciden, has escrito: " + pass.value + " y " + pass2.value);
    }
    else
    {
        if (user.value == "")
        {
            alert("El nombre de Usuario es necesario, no puedes dejarlo en blanco.");
        }
        else
        {
            form.submit();
        }
    }
}

function changeFlag(lang) // Función para cambiar la bandera del idioma
{
    if (lang == "es")
    {
        if (!already2) // Si already2 es false se seleccionó el idioma Inglés.
        {
            flag.className = "flag-icon flag-icon-gb"; // Muestra la bandera del Reino Unido.
            already2 = true; // Pone already2 a true;
            window.open("index-en.php", "_self");
        }
        else // Si no, se seleccionó el idioma Español.
        {
            flag.className = "flag-icon flag-icon-es"; // Muestra la bandera del Reino de España.
            already2 = false; // Pone already2 a false.
            window.open("index.php", "_self");
        }
    }
    else
    {
        already2 = true;
        changeFlag("es");
    }
}

function changeAwesome(name) // Función para cambiar la imagen de los iconos de las redes sociales, recibe el nombre de la imagen.
{
    switch(name) // Cambia a la imagen seleccionada.
    {
        case "face": // Si es face.
            if (!already) // Si already es false, esta seleccionada la imagen de facebook.
            {
                face.className = "fa-brands fa-facebook-square"; // Muestra la imagen de facebook con el recuadro.
                already = true; // Pone already a true.
            }
            else // Si no.
            {
                face.className = "fa-brands fa-facebook-f"; // Muestra la imagen de Facebook solo la F.
                already = false; // Pone already a false;
            }
            break; // Rompe la ejecución del código.
        case "twit":
            if (!already)
            {
                twit.className = "fa-brands fa-twitter-square";
                already = true;
            }
            else
            {
                twit.className = "fa-brands fa-twitter";
                already = false;
            }
            break;
        case "goog":
            if (!already)
            {
                goog.className = "fa-brands fa-goodreads";
                already = true;
            }
            else
            {
                goog.className = "fa-brands fa-google";
                already = false;
            }
            break;
        case "inst":
            if (!already)
            {
                inst.className = "fa-brands fa-instagram-square";
                already = true;
            }
            else
            {
                inst.className = "fa-brands fa-instagram";
                already = false;
            }
            break;
        case "link":
            if (!already)
            {
                link.className = "fa-brands fa-linkedin";
                already = true;
            }
            else
            {
                link.className = "fa-brands fa-linkedin-in";
                already = false;
            }
            break;
        default:
            if (!already)
            {
                enve.className = "fa-solid fa-square-envelope";
                already = true;
            }
            else
            {
                enve.className = "fa-solid fa-envelope";
                already = false;
            }
            break;
    }
}