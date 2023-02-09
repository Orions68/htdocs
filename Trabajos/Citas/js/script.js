function connect(date, time, doc) // Función para enviar una entrada al calendar del paciente, para que tenga la fecha de la cita, y le notifique un día antes y unas horas antes, también envía un Whatsapp.
{
    var latin = date.split("-");
    let whatsapp = document.getElementById('whatsapp').value; // Toma la ID del input que tiene el número de teléfono del Paciente.

    var win = window.open('https://wa.me/' + whatsapp + '?text=Tu cita es el día: ' + latin[2] + "/" + latin[1] + "/" + latin[0] + ' a las: ' + time + ' Hs. con: ' + doc + ' en la Clínica de la Calle X Nº x', '_blank'); // Envía un Whatsapp al paciente.
}

function sendDate() // Esta función es llamada cuando se selecciona una fecha en el selector de fecha.
{
    let doc = document.getElementById("doc"); // Obtengo la ID del selector del profesional.
    let date = document.getElementById("date"); // Obtengo la ID del input type date.
    if (doc.value != "") // Si se seleccionó un Profesional.
    {
        let form = document.createElement("form"); // Creo un formulario.
        let input = document.createElement("input"); // Asigno a la variable input la creación de un input.
        let input1 = document.createElement("input"); // Asigno a la variable input la creación de un input.
        let input2 = document.createElement("input"); // Asigno a la variable input la creación de un input.

        const array = doc.value.split(",");

        form.action = ""; // Donde irá el formulario, en blanco a la misma página.
        form.method = "post"; // Por el método post.

        input.type = "hidden"; // Lo hago de tipo hidden, oculto.
        input.name = "doc_id"; // Le asigno el nombre username.
        input.value = array[0]; // Al input hidden le asigno el valor de la variable de javascript username, declarada en el script client.php.
        form.appendChild(input); // Lo agrego al formulario.

        input1.type = "hidden"; // Lo hago de tipo hidden, oculto.
        input1.name = "doc"; // Le asigno el nombre username.
        input1.value = array[1]; // Al input hidden le asigno el valor de la variable de javascript username, declarada en el script client.php.
        form.appendChild(input1); // Lo agrego al formulario.

        input2.type = "hidden"; // Lo hago de tipo hidden, oculto.
        input2.name = "date"; // Le asigno el nombre username.
        input2.value = date.value; // Al input hidden le asigno el valor de la variable de javascript username, declarada en el script client.php.
        form.appendChild(input2); // Lo agrego al formulario.

        document.body.appendChild(form); // Agreo el formulario al body.

        form.submit(); // Lo envío.
    }
    else // Si no se seleccionó un Profesional.
    {
        alert("Por Favor Selecciona un Profesional Primero. Gracias"); // Por favor, selecciona un prefesional.
        date.value = ""; // Vacio el contenido del selector de fecha.
    }
}

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

function goThere() // Cuando cambia el selector del menú para Móvil.
{
    var change = document.getElementById("change").value; // Change obtiene el valor en el selector.
    switch(change)
    {
        case "contact":
            window.open("contact.php", "_blank");
        break;
        case "request":
            window.open("request.php", "_self");
        break;
        case "profile":
            window.open("profile.php", "_self");
        break;
        case "view4":
            window.open("index.php#view4", "_self");
        break;
        case "view3":
            window.open("index.php#view3", "_self");
        break;
        case "view2":
            window.open("index.php#view2", "_self");
        break;
        default :
            window.open("index.php#view1", "_self");
        break;
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

function totNumPages() // Función para la paginación, calcula el número total de páginas según la cantidad de resultados dividido por la cantidad a mostrar.
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
    var length = doctor.length; // La variable length será del tamaño del array id.
    window.length = length; // Hago global la variable length.
    var btn_next = document.getElementById("next"); // Asigno a la variable btn_next la id del botón con id next, que muestra los resultados siguientes.
    var btn_prev = document.getElementById("prev"); // Asigno a la variable btn_prev la id del botón con id prev, que muestra los resultados anteriores.
    var page_span = document.getElementById("page"); // Asigno a la variable page_span la id del span page, que muestra el número de página.
    var table = document.getElementById("table"); // ID del div que contendrá las imágenes de los artículos y los formularios.
    if (length < 3) // Si la cantidad de artículos es menor que 4.
    {
        if (where == "date")
        {
            var html = "<table><tr><th>Profesional:</th><th>Paciente:</th><th>Hora:</th></tr>"; // Muestro una tabla con las facturas del cliente.
        }
        else
        {
            var html = "<table><tr><th>Profesional:</th><th>Fecha:</th><th>Hora:</th></tr>"; // Muestro una tabla con las facturas del cliente.
        }
        var result = ""; // Declaro la variable result y le asigno el valor de texto vacio.
        for (i = 0; i < qtty; i++) // Hago un bucle hasta la cantidad de resultados a mostrar.
        {
            if (i < length) // Mientras i sea menor que el tamaño del array, muestro los resultados en pantalla.
            {
                result += tableProfile(i, where); // Llamo a la función tableProfile(i) y concateno el resultado en result.
            }
            else // Cuando i es igual a la cantidad de datos a mostrar.
            {
                break; // Rompo el bucle.
            }
        }
        html += result + "</table>"; // Concateno result a html, Cierro la tabla.
        table.innerHTML = html; // La muestro en pantalla.
    }
    else // Si hay más de 3 resultados.
    {
        if (where == "date")
        {
            var html = "<table><tr><th>Profesional:</th><th>Paciente:</th><th>Hora:</th></tr>";
        }
        else
        {
            var html = "<table><tr><th>Profesional:</th><th>Fecha:</th><th>Hora:</th></tr>"; // Muestro una tabla con las facturas del cliente.
        }
        var result = "";
        for (i = (page - 1) * qtty; i < qtty + ((page - 1) * qtty); i++) // Aquí hago el bucle desde la página donde esté, a la cantidad de resultados a mostrar.
        {
            if (i < length) // Mientras el valor de i sea menor que el tamaño del array, muestra resultados en pantalla.
            {
                result += tableProfile(i, where);
            }
            else // Si i es igual a length.
            {
                break; // Rompo el bucle for.
            }
        }
        html += result + "</table>";  // Concateno los resultados de la función tableProfile(i) en html, Cierra la tabla en html.
        table.innerHTML = html; // La muestro en pantalla.
    }

    if (length > 6) // Si la cantidad de Artículos es mayor que 6.
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

function tableProfile(i, where) // Esta función crea una tabla con los datos de las facturas del cliente y retorna el resultado, recibe el índice de los arrays.
{
    if (where == "date")
    {
        var result = "<tr><td>" + doctor[i] + "</td><td>" + patient[i] + "</td><td><br>" + time[i] + "</td></tr>"; // Asigno a la variable result el contenido de la tabla con los datos de las facturas del cliente.
    }
    else
    {
        var result = "<tr><td>" + doctor[i] + "</td><td>" + date[i] + "</td><td><br>" + time[i] + "</td></tr>"; // Asigno a la variable result el contenido de la tabla con los datos de las facturas del cliente.
    }
    return result; // Retorno result.
}