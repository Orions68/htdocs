var already = false; // already se usa para verificar si se seleccionó algún icono de las redes.

function screenSize() // Función para dar el tamaño máximo de la pantalla a las vistas.
{
    var page_top = document.getElementById("page_top"); // Asigno a variables las distintas vistas de la página.
    var page_event = document.getElementById("page_event");
    var view1 = document.getElementById("view1");
    var view2 = document.getElementById("view2");
    var view3 = document.getElementById("view3");
    var screenHeight = window.innerHeight; // Declaro la variable screenHeight y le asigno el tamaño interno disponible de la pantalla.
    if (document.title != "Bienvenidos a Ticket.es") // Verifico si no estoy en index.php
    {
        if (document.title == "Procede al Pago de tus Entradas") // Si estoy en Pago de entradas
        {
            page_top.style.height = screenHeight - 190 + "px"; // Asigno el tamaño de la pantalla - 190 pixels a pagetop para ver el footer en la misma vista.
        }
        else // Si no.
        {
            var body = document.body,
            html = document.documentElement;
            var height = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight); // Asigno a la varible height la altura de la pantalla con todo el contenido.
            if (height <= screenHeight) // Si la página completa es de tamaño menor o igual al tamaño máximo de la vista.
            {
                if (view1 != null) // Verifico si existe la vista view1.
                {
                    page_top.style.height = screenHeight + "px"; // Doy el tamaño máximo a la primera vista que es page_top.
                    view1.style.height = screenHeight - 190 + "px"; // Doy el tamaño - 190 pixels a view1, para ver el footer en la misma vista.
                }
                else // Si no existe view1
                {
                    page_top.style.height = screenHeight - 210 + "px"; // Doy el tamaño - 210 pixels a page_top, para ver el footer en la misma vista.
                }
            }
            else // Si el contenido de la página es mayor al tamaño de la pantalla completa.
            {
                if (view1 != null) // Verifico si existe la vista view1.
                {
                    page_top.style.height = screenHeight + (height - screenHeight) + "px"; // Le asigno el espacio máximo + los pixeles necesarios para ver toda la página a page_top.
                    view1.style.height = screenHeight - 190 + "px"; // Doy el tamaño - 190 pixels a view1, para ver el footer en la misma vista.
                }
                else // Si no existe view1.
                {
                    page_top.style.height = screenHeight + (height - screenHeight) + "px"; // Le asigno el espacio máximo + los pixeles necesarios para ver toda la página a page_top.
                }
            }
        }
    }
    else // Si estoy en index.php
    {
        page_top.style.height = screenHeight + "px"; // Le asigno el espacio máximo a la vista page_top.
        page_event.style.height = screenHeight + "px"; // Le asigno el espacio máximo a la vista page_event.
        view1.style.height = screenHeight + "px"; // Asigno el tamaño máximo de la pantalla a view1.
        view2.style.height = screenHeight + "px"; // Asigno el tamaño máximo de la pantalla a view2.
        view3.style.height = screenHeight - 190 + "px"; // Asigno el tamaño máximo de la pantalla - 190 px del footer a view3.
    }
}

function verify(code) // Función para validar las contraseñas de registro de espectador y empresa y las de modificación de ambos, recibe el código de empresa o de espectador.
{
    if (code == 0) // Si llega el código 0
    {
        var pass = document.getElementById("pass0"); // pass es la ID del input pass0.
        var pass2 = document.getElementById("pass1"); // pass2 es la ID del input pass1.
    }
    else // Si llega el código 1.
    {
        var pass = document.getElementById("pass3"); // pass es la ID del input pass3.
        var pass2 = document.getElementById("pass4"); // pass2 es la ID del input pass4.
    }
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

function toast_disc() // Muestra el diálogo de Bootstrap para los disclaimer de cliente y de empresa. 
{
    disc = document.getElementById("disc"); // Obtengo la ID del botón con id disc.
    disc.click(); // Le hago un click, para mostrar el diálogo.
}

function checkTitle() // Fnción de los scripts de PHP carro y register para ocultar el botón del carro de la compra.
{
    var car_button = document.getElementById("car_button");
    if (document.title != "Ticket.es - Entrada de Espectador") // Verifico si no estoy en la página login.php.
    {
        car_button.style.visibility = "hidden"; // Si no oculto el botón del carro de la compra.
    }
}

function QRGen(index) // Función para generar el código QR, directamente desde una API de google, (seguramente durará muy poco), recibe el numero de entradas compradas, del script checkout.php.
{
    var code = []; // Array que contendrá las rutas con los datos por GET, que se codificarán
    var img = []; // Array que contendrá las imágenes de los códigos
    var link = []; // Array que tendrá los enlaces a los códigos para abrir la imágen y descargarla.
    var qr = []; // Array que tendrá las distintas rutas de los QR.
    var finalURL = []; // Array que contendrá las rutas con los datos por GET de los códigos más la ruta a la API de Google para crear los QR.
    for (i = 0; i < index; i++) // Hago un bucle al número de entradas.
    {
        code[i] = document.getElementById("code" + i); // Obtengo la ID del <input> oculto que contiene la url con los datos de las entradas compradas, lo asigno al array code[i].
        img[i] = document.getElementById("img" + i); // Obtengo las ID de las <img>.
        link[i] = document.getElementById("link" + i); // Obtengo las ID de los enlaces <a>.
        qr[i] = document.getElementById("here" + i); // Obtengo las ID de los input que contendrán la URL completa del código QR.
        
        finalURL[i] ='https://chart.googleapis.com/chart?cht=qr&chl=' + code[i].value + '&chs=160x160&chld=L|0'; // Se lo paso a Google y asigno el resultado a la variable finalURL.
        img[i].src = finalURL[i]; // Lo pongo en la imagen con ID img[i].
        link[i].href = finalURL[i]; // Lo pongo en el enlace con ID link[i].
        qr[i].value = finalURL[i]; // Lo pongo en el input con ID qr[i].
    }
    var btn = document.getElementById("btn"); // ID del input type submit para enviar los datos, está oculto (hidden)
    setTimeout(function() // La función para esperar 2 segundos.
    {
        btn.style.visibility = "visible"; // Después de 2 segundos se hace visible el botón. Espero 2 segundos para dar tiempo a Google a procesar todas las peticiones.
    }, 2000);
}

function changeit() // Función para la página de contacto.
{
    var button = document.getElementById("change"); // En la variable button obtengo la ID del input type submit change.
    var contact = document.getElementById("contact"); // En la variable contact obtengo el id del selector.

    if (contact.value != "") // Si el valor en el selector ha cambiado.
    {
        switch (contact.value) // Hago un switch al valor en el selector.
        {
            case "Telepatía": // Si es Telepatía.
                button.value = "Conecta con mi Cerebro"; // Cambio el contenido del input type submit a Conecta con mi Cerebro.
                break; // Salgo del switch.
            case "Señales":
                button.value = "Envíame las Señales";
                break;
            case "Teléfono":
                button.value = "Llamenme!";
                break;
            case "Whatsapp":
                button.value = "Mandame un Guasap";
                break;
            case "E-mail":
                button.value = "Espero tu E-mail";
                break;
            default:
                button.value = "Que Ilusión una Carta";
                break;
        }
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

function totNumPages() // Función para la paginación
{
    return Math.ceil(window.length / window.qtty); // Calcula la cantidad de páginas que habrá, divide la cantidad de eventos por 5 resultados a mostrar por página.
}

function prev() // Función para ir a la página anterior.
{
    if (window.page > 1) // Si la página actual es mayor que la página 1.
    {
        window.page--; // Decrementa la variable page, página anterior.
        change(window.page, window.qtty, window.from); // Llama a la función change pasandole el número de página a mostrar y la cantidad de eventos a mostrar, siempre es 5.
    }
}

function next() // La Función next muestra la página siguiente.
{
    if (window.page < totNumPages()) // Si la página que estoy mostrando aun es menor que la cantidad total de páginas
    {
        window.page++; // Incrementa la variable page, página siguiente.
        change(window.page, window.qtty, window.from); // Llama a la función change pasandole el número de página a mostrar y la cantidad de eventos a mostrar, siempre es 5.
    }
}

function change(page, qtty, from) // Función que muestra los resultados de a 5 en una tabla, recibe la pagina page, la cantidad de resultados a mostrar qtty y de donde viene la solicitud from.
{
    window.from = from; // Asigno la variable from, a la variable global window.from, from puede ser el script event.php, el perfil de espectador o el perfil de empresa.
    window.page = page; // Asigno la variable page, a la variable global window.page.
    window.qtty = qtty; // Asigno la variable qtty, a la variable global window.qtty.
    var my_path = []; // Declaro el array my_path, contendrá las rutas a las imágenes de los eventos.
    var btn_next = document.getElementById("next"); // Asigno a la variable btn_next la id del botón con id next, que muestra los resultados siguientes.
    var btn_prev = document.getElementById("prev"); // Asigno a la variable btn_prev la id del botón con id prev, que muestra los resultados anteriores.
    var table = document.getElementById("table"); // Asigno a la variable table la id del div con id table, que muestra los resultados en la tabla en event.php, perfil de Espectador o perfil de empresa.
    var page_span = document.getElementById("page"); // Asigno a la variable page_span la id del span page, que muestra el número de página.
    if (from == "events") // Si la petición es desde event.php
    {
        var length = evento.length; // asigno al avaribla length el tamaño del array evento.
        var today = new Date().getTime(); // Asigno a la variable today el día de hoy en milisegundos.
        var myday = []; // Declaro el array myday, contendrá la fecha de finalización del evento.
        var endday = []; // Declaro el array endday, contendrá los milisegundos del día de finalización del evento.
        var html = "<table><tr><th>Evento</th><th>Título</th><th>Descripción</th><th>Precio</th><th>Lugar</th><th>Fecha de Inicio</th><th>Fecha de Finalización</th><th>Hora del Evento</th><th>Imágenes del Evento</th><th>Entradas</th></tr><tr>";
    }
    else if (from == "comp") // Si la petición llega desde el perfil de empresa.
    {
        var length = kind.length; // La variable length será del tamaño del array kind.
        var html = "<table><tr><th>Evento</th><th>Titulo</th><th>Lugar</th><th>Fecha de Inicio</th><th>Precio</th><th>Localidades</th><th>Vendidas</th></tr><tr>";
    }
    else // Si la petición llega desde el perfil de espectador.
    {
        var length = kind.length; // La variable length será del tamaño del array kind.
        var html = "<table><tr><th>Evento</th><th>Descripción</th><th>Cantidad de Entradas</th><th>Pagado</th><th>Fecha de compra</th><th>Fecha de Asistencia</th><th>Entrada</th></tr><tr>";
    }
    window.length = length; // Hagi global la variable length.
    for (var i = (page - 1) * qtty; i < (page * qtty); i++) // Hago un bucle desde 0 la primera vez, hasta 5 la primera vez, ya que qtty siempre es 5 y page es 1.
    {
        if (i < length) // Mientras i sea menor que la cantidad de eventos.
        {
            if (from == "events") // Si la peticion es de event.php, muestro los eventos.
            {
                const myArray = end[i].split("/"); // Hago un split del array end[i] donde está la fecha de finalización del evento, resultado de la base de datos, y lo asigno a myArray.
                myday[i] = myArray[2] + "-" + myArray[1] + "-" + myArray[0]; // Al array myday le asigno el contenido de myArray invertido, concatenado separado por el signo -.
                endday[i] = new Date(myday[i]); // En el array endday[i] obtengo los milisegundos de la fecha de finalización del evento.
                my_path[i] = path[i].split("¡"); // En el array my_path[i] hago un split de path[i], que es el resultado leido en la base de datos, separandolos por el signo ¡.
                if (endday[i].getTime() < (today - 86400000)) // Verifico si la fecha de finalización (que se toma a primera hora, las 0:00) del evento es anterior a ayer.
                {
                    html += "<td>" + kind + "</td><td>" + evento[i] + "</td><td style='color: red;'>Evento Terminado " + desc[i] + "</td><td>" + price[i] + "</td><td>" + where[i] + "</td><td>" + start[i] + "</td><td>" + end[i] + "</td><td>" + hour[i] + " Hs." + "</td><td><a href='javascript:showCarrousel(\"" + path[i] + "\")'><img src='" + my_path[i][0] + "' width='160' height='120' alt='Imágenes del Evento'></a></td><td><small>No Disponible</small></td></tr><tr>";
                    // Si es así, Muestro Evento Terminado y las entradas no estarán disponibles para la venta.
                }
                else // Si no.
                {
                    html += "<td>" + kind + "</td><td>" + evento[i] + "</td><td>" + desc[i] + "</td><td>" + price[i] + "</td><td>" + where[i] + "</td><td>" + start[i] + "</td><td>" + end[i] + "</td><td>" + hour[i] + " Hs." + "</td><td><a href='javascript:showCarrousel(\"" + path[i] + "\")'><img src='" + my_path[i][0] + "' width='160' height='120' alt='Imágenes del Evento'></a></td><td><a href='javascript:addToCart(\"" + id[i] + "-" + evento[i] + "-" + price[i] + "\")'><small class='btn btn-info' role='button'>Comprar Entrada</small></a></td></tr><tr>";
                    // Muestro el evento.
                }
            }
            else if (from == "comp") // Si la petición es del perfil empresa, muestro los eventos publicados con las entradas vendidas.
            {
                html += "<td>" + kind[i] + "</td><td>" + title[i] + "</td><td>" + place[i] + "</td><td>" + start[i] + " " + hour[i] + "Hs." + "</td><td>" + price[i] + "</td><td>" + places[i] + "</td><td>" + sold[i] + "</td></tr><tr>";
            }
            else // Si la peticion es del perfil de espectador, muestro las entradas compradas y los enlaces a los códigos QR.
            {
                html += "<td>" + kind[i] + "</td><td>" + title[i] + "</td><td>" + qtties[i] + "</td><td>" + payed[i] + "</td><td>" + date[i] + "</td><td>" + start[i] + " " + hour[i] + "Hs." + "</td><td><a href='" + ruta[i] + "'>Descarga tu QR</a></td></tr><tr>";
            }
        }
        else // Sí i supera a la cantidad de eventos, ya que estoy mostrando los resultados de 5 en 5 y si hay 8 eventos en la segunda página solo muestro 3.
        {
            break; // Hago un break, para romper el bucle.
        }
    }
    html += "</tr></table>"; // Cierro la tabla en la variable $html, en la que concatené todos los resultados de la base de datos.
    table.innerHTML = html; // La muestro en el div con id table.
    if (length > 5) // Si la cantidad de eventos es mayor que 5.
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
    else // Si hay menos de 5 resultados.
    {
        btn_prev.style.visibility = "hidden"; // Escondo los dos botones.
        btn_next.style.visibility = "hidden";
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