function screen() // Establece el tamaño de las vistas en la pantalla.
{
    let view1 = document.getElementById("view1"); // Recoge las ID de todas las vistas.
    let view2 = document.getElementById("view2");
    let view3 = document.getElementById("view3");
    let view4 = document.getElementById("view4");
    let screen = window.innerHeight; // Obtiene el tamaño vertical de la pantalla.
    var body = document.body, html2 = document.documentElement; // Asigno a la variable body el body y a html2 el contenido.
    var height = Math.max(body.scrollHeight, body.offsetHeight, html2.clientHeight, html2.scrollHeight, html2.offsetHeight); // Asigno a la variable height el valor máximo de la pantalla con todo el contenido.

    if (view1.offsetHeight < screen) // Si el tamaño vertical de la vista es menor que el tamaño vertical de la pantalla.
    {
        view1.style.height = screen + "px"; // Le asigno el tamaño de la pantalla a la vista 1, si es mayor lo dejo como está.
    }

    if (view2 != null) // Si existe el div view2
    {
        if (view2.offsetHeight < screen) // Si el tamaño vertical de la vista es menor que el tamaño vertical de la pantalla.
        {
            view2.style.height = screen + "px"; // Le asigno el tamaño de la pantalla a la vista 2, si es mayor lo dejo como está.
        }
        if (view3 != null)
        {
            if (view3.offsetHeight < screen)
            {
                view3.style.height = screen + "px";
            }
            if (view4 != null)
            {
                if (view4.offsetHeight < screen)
                {
                    view4.style.height = screen - 200 + "px";
                }
            }
            
        }
    }
    else // Si la vista 2 no existe.
    {
        view1.style.height = height - 80 + "px"; // Le asigno a la vista 1 el tamaño de todo el contenido de la pantalla menos 80 pixels.
    }
}

function resolution() // Esta función comprueba si el ancho de la pantalla es de Ordenador o de Móvil.
{
    let mobile = document.getElementById("mobile");
    let pc = document.getElementById("pc");
    let width = innerWidth;
    if (width < 965) // Si el ancho es inferior a 965.
    {
        pc.style.visibility = "hidden"; // Oculta el menú de Ordenador
        mobile.style.visibility = "visible"; // Muestra el menú de Teléfono.
    }
    else // Si es mayor o igual a 965;
    {
        pc.style.visibility = "visible"; // Muestra el menú para Ordenador
        mobile.style.visibility = "hidden"; // Oculta el menú para Teléfono.
    }
}

function toast(warn, ttl, msg) // Función para mostrar el Dialogo con los mensajes de alerta, recibe, Código, Título y Mensaje.
{
    var alerta = document.getElementById("alerta"); // La ID del botón del dialogo.
    var title = document.getElementById("title"); // Asigno a la variable title el h4 con id title.
    var message = document.getElementById("message"); // Asigno a la variable message el h5 con id message;
    if (warn == 1) // Si el código es 1, es una alerta.
    {
        title.style.backgroundColor = "#000000"; // Pongo los atributos, color de fondo negro.
        title.style.color = "yellow"; // Y color del texto amarillo.
    }
    else if (warn == 0) // Si no, si el código es 0 es un mensaje satisfactorio.
    {
        title.style.backgroundColor = "#FFFFFF"; // Pongo los atributos, color de fondo blanco.
        title.style.color = "blue"; // Y el color del texto azul.
    }
    else // Si no, viene un 2, es una alerta de error.
    {
        title.style.backgroundColor = "#000000"; // Pongo los atributos, color de fondo negro.
        title.style.color = "red"; // Y color del texto rojo.
    }
    title.innerHTML = ttl; // Muestro el Título del dialogo.
    message.innerHTML = msg; // Muestro los mensajes en el diálogo.
    alerta.click(); // Lo hago aparecer pulsando el botón con ID alerta.
}