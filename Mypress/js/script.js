function totNumPages() // Función para la paginación
{
    return Math.ceil(window.length / window.qtty); // Calcula la cantidad de páginas que habrá, divide la cantidad de eventos por 6 resultados a mostrar por página.
}

function prev(where) // Función para ir a la página anterior.
{
    if (window.page > 1) // Si la página actual es mayor que la página 1.
    {
        window.page--; // Decrementa la variable page, página anterior.
        change(window.page, window.qtty, where); // Llama a la función change pasandole el número de página a mostrar y la cantidad de eventos a mostrar que siempre es 6.
    }
}

function next(where) // La Función next muestra la página siguiente.
{   
    if (window.page < totNumPages()) // Si la página en la que estoy es menor que la última.
    {
        window.page++; // Incremento la página
        change(window.page, window.qtty, where); // Llamo a la función que muestra los resultados.
    }
}

function change(page, qtty, where) // Función que muestra los resultados de a 6 en filas y columnas de bootstrap, recibe la pagina page y la cantidad de resultados a mostrar qtty.
{
    window.page = page; // Asigno la variable page, a la variable global window.page.
    window.qtty = qtty; // Asigno la variable qtty, a la variable global window.qtty.
    var length = service.length; // La variable length será del tamaño del array id.
    window.length = length; // Hago global la variable length.
    var btn_next = document.getElementById("next"); // Asigno a la variable btn_next la id del botón con id next, que muestra los resultados siguientes.
    var btn_prev = document.getElementById("prev"); // Asigno a la variable btn_prev la id del botón con id prev, que muestra los resultados anteriores.
    var page_span = document.getElementById("page"); // Asigno a la variable page_span la id del span page, que muestra el número de página.
    var table = document.getElementById("table"); // ID del div que contendrá las imágenes de los artículos y los formularios.
    if (length < 4) // Si la cantidad de artículos es menor que 4.
    {
        if (where == "profile") // Si se llama desde el perfil del cliente.
        {
            var html = "<table><tr><th>Servicio</th><th>Precio</th><th>Cantidad</th><th>Total</th><th>Fecha</th><th>Hora</th></tr>"; // Muestro una tabla con las facturas del cliente.
            for (i = 0; i < qtty; i++) // Hago un bucle hasta la cantidad de resultados a mostrar.
            {
                if (i < length) // Si i es menor que el tamaño del array.
                {
                    var my_date = date[i].split("-"); // Hago un split de la fecha, y la invierto para verla dia, mes, año.
                    html += "<tr><td>" + service[i] + "</td><td>" + price[i] + " €</td><td>" + qtties[i] + "</td><td>" + total[i] + "</td><td>" + my_date[2] + "/" + my_date[1] + "/" + my_date[0] + "</td><td>" + time[i] + "</td></tr>";
                }
                else // Cuando i es igual a la cantidad de datos a mostrar.
                {
                    break; // Rompo el bucle.
                }
            }
            html += "</table>"; // Cierro la tabla.
            table.innerHTML = html; // La muestro en pantalla.
        }
        else // Si se llama desde index.
        {
            var html = "<table><tr><th>Servicio</th><th>Precio</th><th>Foto</th></tr>"; // Muestro una tabla con la lista de precios.
            for (i = 0; i < qtty; i++) // Hago un bucle hasta la cantidad de resultados a mostrar.
            {
                if (i < length) // Si i es menor que el tamaño del array.
                {
                    html += "<tr><td>" + service[i] + "</td><td>" + price[i] + " €</td><td><a href='#view2'><img class='mysize' src='" + img[i] + "' alt='" + service[i] + "' onclick='showImg(\"" + img[i] + "\")'></a></td></tr>";
                }
                else // Cuando i es igual a la cantidad de datos a mostrar.
                {
                    break; // Rompo el bucle.
                }
            }
            html += "</table>"; // Cierro la tabla.
            table.innerHTML = html; // Muestro todo en pantalla.
        }
    }
    else // Si hay más de 3 resultados.
    {
        if (where == "profile") // Si se llama desde el perfil del cliente.
        {
            var html = "<table><tr><th>Servicio</th><th>Precio</th><th>Cantidad</th><th>Total</th><th>Fecha</th><th>Hora</th></tr>";
            for (i = (page - 1) * qtty; i < qtty + ((page - 1) * qtty); i++) // Aquí hago el bucle desde la página donde esté, a la cantidad de resultados a mostrar.
            {
                if (i < length) // Si i es menor que el tamaño del array.
                {
                    var my_date = date[i].split("-");
                    html += "<tr><td>" + service[i] + "</td><td>" + price[i] + " €</td><td>" + qtties[i] + "</td><td>" + total[i] + "</td><td>" + my_date[2] + "/" + my_date[1] + "/" + my_date[0] + "</td><td>" + time[i] + "</td></tr>";
                }
                else
                {
                    break;
                }
            }
            html += "</table>";
            table.innerHTML = html; // La muestro en pantalla.
        }
        else // Si se llama desde index.
        {
            var html = "<table><tr><th>Servicio</th><th>Precio</th><th>Foto</th></tr>";
            for (i = (page - 1) * qtty; i < qtty + ((page - 1) * qtty); i++) // Aquí hago el bucle desde la página donde esté, a la cantidad de resultados a mostrar.
            {
                if (i < length) // Si i es menor que el tamaño del array.
                {
                    html += "<tr><td>" + service[i] + "</td><td>" + price[i] + " €</td><td><a href='#view2'><img class='mysize' src='" + img[i] + "' alt='" + service[i] + "' onclick='showImg(\"" + img[i] + "\")'></a></td></tr>";
                }
                else
                {
                    break;
                }
            }
            html += "</table>";
            table.innerHTML = html; // Muestro todo en pantalla.
        }
    }

    if (length > 5) // Si la cantidad de Artículos es mayor que 5.
    {
        page_span.innerHTML = "Página: " + page; // Muestro el número de página.
        if (page == 1) // Si la página es la número 1
        {
            btn_prev.style.visibility = "hidden"; // Escondo el Botón con id prev que mostraría los resultados anteriores.
        }
        else // Si no, estoy en otra página.
        {
            btn_prev.style.visibility = "visible"; // Hago visible el botón para mostrar los resultados anteriores.
        }
        if (page == totNumPages()) // Si estoy en la última página.
        {
            btn_next.style.visibility = "hidden"; // Escondo el botón para mostrar los resultados siguientes.
        }
        else // Si no, estoy en una página intermedia o en la primera.
        {
            btn_next.style.visibility = "visible"; // Hago visible el botón para mostrar los resultados siguientes.
        }
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

function screenSize() // Función para dar el tamaño máximo de la pantalla a las vistas.
{
    var view1 = document.getElementById("view1");
    var view2 = document.getElementById("view2");
    var view3 = document.getElementById("view3");
    var screenHeight = window.innerHeight; // Declaro la variable screenHeight y le asigno el tamaño interno disponible de la pantalla.
    var body = document.body;
    var html2 = document.documentElement;
    var height = Math.max(body.scrollHeight, body.offsetHeight, html2.clientHeight, html2.scrollHeight, html2.offsetHeight); // Asigno a la varible height la altura de la pantalla con todo el contenido.

    if (view2 === null)
    {
        if (height <= screenHeight) // Si la página completa es de tamaño menor o igual al tamaño máximo de la vista.
        {
            view1.style.height = screenHeight + "px"; // Asigno el tamaño máximo de la pantalla a view1.
        }
        else
        {
            view1.style.height = screenHeight + (height - screenHeight) + "px"; // Asigno el tamaño máximo de la pantalla a view1 más el espacio que ocupa todo el contenido a view1.
        }
    }
    else
    {
        view1.style.height = screenHeight + 100 + "px"; // Asigno el tamaño máximo de la pantalla a view1.
        view2.style.height = screenHeight + 250 + "px"; // Asigno el tamaño máximo de la pantalla a view2.
        view3.style.height = screenHeight + 250 + "px"; // Asigno el tamaño máximo de la pantalla + el espacio que ocupa todo el contenido a view3.
    }
}

function verify() // Función para validar las contraseñas de registro de alumnos y las de modificación, también valida el D.N.I.
{
    var pass = document.getElementById("pass1"); // pass es la ID del input pass0.
    var pass2 = document.getElementById("pass2"); // pass2 es la ID del input pass1.

    if (pass.value != pass2.value) // Verifico si los valores en los input pass y pass2 no coinciden.
    {
        toast(1, "Hay un Error", "Las contraseñas no coinciden, has escrito: " + pass.value + " y " + pass2.value); // Si no coinciden muestro error.
        return false; // devulvo false, el formulario no se envía.
    }
    else // Si son iguales.
    {
        return true; // Devuelvo true, envía el formulario.
    }
}

function showEye(which) // Función para mostrar el ojo de los input de las contraseñas, recibe el número del elemento que contiene el ojo.
{
    let eye = document.getElementById("togglePassword" + which); // Asigno a eye la id del elemento que contiene el ojo.
    eye.style.visibility = "visible"; // Hago visible el elemento, el ojo.
}

function spy(which) // Función para el ojito de las Contraseñas al hacer click en el ojito, recibe el número de la ID del input de la password.
{
    const togglePassword = document.querySelector('#togglePassword' + which); // Asigno a la constante togglePassword el input con ID togglePassword + which.
    const password = document.querySelector('#pass' + which); // Asigno a password la ID del input con ID pass + which.
    
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password'; // Asigno a type el resultado de un operador ternario, si presiono el ojito y el tipo del input es password
    // lo cambia a text, si es text lo cambia a password.
    password.setAttribute('type', type); // Le asigno el atributo al input password.
    togglePassword.classList.toggle('fa-eye-slash'); // Cambia el aspecto del ojito, al cambiar el input a tipo texto, el ojo aparece con una raya.
}

function showImg(src) // Not in Use but a Good One
{
    var alertaImg = document.getElementById("alertaImg"); // La ID del botón del dialogo.
    var img = document.getElementById("show_pic"); // Asigno a la variable title el h4 con id title.
        
    img.src = src; // Muestro los mensajes en el diálogo.
    alertaImg.click(); // Lo hago aparecer pulsando el botón con ID alerta.
}

function changeit() // Función para la página de contacto.
{
    var button = document.getElementById("change"); // En la variable button obtengo la ID del input type submit change.
    var contact = document.getElementById("contact"); // En la variable contact obtengo el id del selector.
    var phone = document.getElementById("phone");
    var email = document.getElementById("email");
    var ph = document.getElementById("ph");
    var em = document.getElementById("em");

    if (contact.value != "") // Si el valor en el selector ha cambiado.
    {
        switch (contact.value) // Hago un switch al valor en el selector.
        {
            case "Teléfono":
                email.style.visibility = "hidden";
                phone.style.visibility = "visible";
                em.required = false;
                ph.required = true;
                button.value = "Llamame!";
                break;
            case "Whatsapp":
                email.style.visibility = "hidden";
                phone.style.visibility = "visible";
                em.required = false;
                ph.required = true;
                button.value = "Mandame un Guasap";
                break;
            default:
                email.style.visibility = "visible";
                phone.style.visibility = "hidden";
                ph.required = false;
                ph.value = 1;
                em.required = true;
                button.value = "Espero tu E-mail";
                break;
        }
    }
}

function connect(how)
{
    let mssg = document.getElementById('mssg').value;
    let num = 5492234557972;
    var win = window.open('https://wa.me/' + num + '?text=Por Favor contactame por: ' + how + ' al: ' + mssg + ' Mi nombre es: ', '_blank');
}

var already = false; // Variable para los íconos de las redes sociales.

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