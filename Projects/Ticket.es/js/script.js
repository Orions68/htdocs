var already = false; // already se usa para verificar si se seleccionó algún icono de las redes.
var yet = false; // Declaro y asigno el valor false a la varible booleana yet.
var dontshow = false;

if (localStorage.getItem("article0") == null) // Cada vez que se carga el script compruebo si no hay algún artículo en localStorage.
{
    localStorage.clear(); // Borro localStorage.
    var articles = []; // Asigno un array a la variable global articles.
    var qtties = []; // Asigno un array a la variable global qtties.
    var index = 0; // Inicializo index a 0, se usa como indice de los arrays, de artículos y cantidad.
}
else // Si hay.
{
    var articles = []; // Asigno un array a la variable global articles, se usa solo para contener el texto de los artículos, para mostrarlos en la lista.
    var qtties = []; // Asigno un array a la variable global qtties, se usa solo para contener el texto de las cantidades, para mostrarlos en la lista.
    var index = 0; // Inicializo index a 0, se usa como indice de los arrays, de artículos y cantidad.
    let size = localStorage.length; // Asigno a la variable size el tamaño de localStorage.
    let store = []; // Declaro store como un array;
    for (i = 0; i < size; i++) // Hago un blucle al tamaño de localStorage.
    {
        dontshow = true;
        store[i] = JSON.parse(localStorage.getItem("article" + i)); // Guardo en el array store el contenido de localStorage convertido en Objeto JSON.
        added(store[i].name); // Llamo a la función added y le paso el contenido de store[i].name, el nombre del artículo, se agrega el artículo al carro de la compra, se crean dinamicamente
        // los input con id articulo0, qtty0, que están dentro del formulario que se enviará al efectuar la compra.
        document.getElementById("qtty" + i).value = store[i].qtty; // Al input con ID qtty0 le cambio el valor ya que el valor por defecto es 1 al valor en el array que puede ser de 1 a 5.
        qtties[i] = store[i].qtty; // Pongo en el array qtties[i] el valor del array store[i].qtty, la cantidad de entradas guardada en localStorage.
        articles[i] = store[i].name; // Pongo en el array articles[i] el nombre del artículo en el array store[i].name.
    }
}

function addToCart(article) // Función para comprobar si el articulo ya está en el carro, recibe el artículo como parametro.
{
    if (index > 0) // Si ya hay artículos
    {
        for (i = 0; i < index; i++) // Hago un bucle a la cantidas de artículos en el carro de la compra.
        {
            if (articles[i] == article) // Conparo si el artículo a agregar es igual a los artículos dentro del array articles.
            {
                yet = true; // Si es así, pongo la variable yet a true.
            }
        }
        if (yet) // Verifico si yet está a true.
        {
            var btnopen = document.getElementById("add_dialog");
            var btnclose = document.getElementById("close_add_dialog");
            var addMessage = document.getElementById("add_message");
            yet = false; // Si está lo pongo a false.
            addMessage.innerHTML = "Ya has Agregado ese Artículo, Abre el Carro de la Compra y Modifica la Cantidad de Entradas."; // Uso el diálogo para mostrar los artículos agregados al carro de la compra, para indicar que el artículo ya está en el carro.
            btnopen.click(); // Hago click en el botón para mostrar el diálogo.
            setTimeout(function() // Función que espera 3 segundos.
            {
                btnclose.click(); // Hago click en el botón que cierra el diálogo.
            }, 3000);
        }
        else // Si no Está.
        {
            adding(article); // Llamo a la función adding y le paso el artículo.
        }
    }
    else // Si no hay artículos.
    {
        adding(article); // Llamo a la función adding y le paso el artículo.
    }
}

function adding(article) // Esta Función recibe el articulo, lo agrega al array de articulos y lo almacena en localStorage.
{
    articles[index] = article; // Pongo en el array articles en la posición index el artículo recibido.
    qtties[index] = 1; // Pongo 1 en la posición index, es la cantidad mínima de artículos.

    const thing = {indice: index, name: article, qtty: 1}; // Declaro la constante thing y le asigno un objeto con el índice, el articulo y la cantidad.
    localStorage.setItem("article" + index, JSON.stringify(thing)); // Almaceno en localStorage el valor thing en el item article0, article1, etc.
    added(article); // Llamo a la función added() y le paso el artículo.
}

function added(article) // La función added(article) se usa para generar dinamicamente los input del formulario del carro de la compra con el artículo y la cantidad 1.
{
    let container = document.getElementById("container"); // Container contiene la ID del div con ID container, donde se crea dinamicamente el contenido del formulario con todas las entradas compradas.

    let input = document.createElement("input"); // Asigno a la variable input la creación de un input.
    input.type = "hidden"; // Lo hago de tipo hidden, oculto.
    input.name = "article" + index; // Le asigno el nombre article y le concateno el valor de index, article0, article1, etc.
    input.id = "article" + index; // Le asigno el id article y le concateno el valor de index, article0, article1, etc.
    input.value = article; // Al input hidden le asigno el valor del artículo.
    container.appendChild(input); // Lo pongo en el contenedor, un div con id container.

    var input1 = document.createElement("input"); // Creo otro input en la variable input1.
    input1.type = "number"; // Lo hago de tipo number, va a contener la cantidad de artículos agregados al carro de la compra.
    input1.setAttribute("min", 1); // Le doy los atributos de cantidad mínima y máxima.
    input1.setAttribute("max", 5);
    input1.name = "qtty" + index; // Le asigno el nombre qtty y le concateno el valor de index, qtty0, qtty1, etc.
    input1.id = "qtty" + index; // Le asigno la id qtty y le concateno el valor de index, qtty0, qtty1, etc.
    input1.value = 1; // Pongo el mínimo valor en el input una unidad.
    input1.onchange = function(){changeQtty()}; // En caso de que cambie la cantidad del input llamo a la función changeQtty().
    container.appendChild(input1); // Lo agreo al contenedor.

    var label = document.createElement("label"); // Creo una label en la variable label.
    label.id = "label" + index; // Le asigo el id label y le concateno el valor de index, label0, lable1, etc.
    label.innerHTML = " " + article; // Escribo en la label un espacio para separarla de la casilla input de la cantidad y el nombre del artículo seleccionado.
    container.appendChild(label); // La agrego al contenedor.

    var boton = document.createElement("button"); // Creo un button en la variable botón
    boton.type = "button"; // Como esto está dentro de un formulario, lo hago de tipo botón, ya que si no, al hacer click en este botón se envía el formulario.
    boton.id = index; // Le asigo el id index, 0, 1, etc.
    boton.style.fontSize = "10px"; // Le doy stylo al texto del botón para hacerlo más pequeño.
    boton.style.float = "right"; // Lo pongo a la derecha del contenedor.
    boton.innerHTML = "Quitar"; // Pongo el texto Quitar en el botón.
    boton.onclick = function(){removeArticle(this.id)}; // Le agrego un onclick para llamar a la función removeArticle().
    container.appendChild(boton); // Lo pongo en el contenedor.

    var br = document.createElement("br"); // Creo un salto de linea después de la label, el input con la cantidad y el botón.
    br.id = "br0" + index; // Asigno un id al salto de linea para borrarlo en caso que el cliente borre algún artículo.
    container.appendChild(br); // Lo pongo en el contenedor.

    var br = document.createElement("br"); // Creo un salto de linea después de la label, el input con la cantidad y el botón.
    br.id = "br" + index; // Asigno un id al salto de linea para borrarlo en caso que el cliente borre algún artículo.
    container.appendChild(br); // Lo pongo en el contenedor.

    index++; // Incremento index para el próximo artículo.
    if (dontshow)
    {
        dontshow = false;
    }
    else
    {
        carToast(article); // Muestro un diálogo por 2 segundos con el artículo agregado al carro de la compra.
    }
}

function removeArticle(which) // Función para remover un artículo del carro de la compra, recibe de parametro el número de artículo a remover.
{
    var container = document.getElementById("container"); // Container contiene la ID del div con ID container, donde se crea dinamicamente el contenido del formulario con todas las entradas compradas.
    var article = document.getElementById("article" + which); // Asigno a la variable article el input con ID article0, artilce1, etc.
    var qtty = document.getElementById("qtty" + which); // Lo mismo para la cantidad de artículos.
    var label = document.getElementById("label" + which); // Lo mismo para la etiqueta
    var boton = document.getElementById(which); // Lo mismo para el botón quitar, ya que hay que quitar todos los elementos, incluso el input que es de tipo hidden.
    var salto = document.getElementById("br" + which); // Lo mismo para el salto de línea.
    var salto2 = document.getElementById("br0" + which); // Lo mismo para el salto de línea.
    container.removeChild(article); // Remuevo el input hidden con el artículo del contenedor que es un div con ID container.
    container.removeChild(qtty); // Lo mismo para el input qtty.
    container.removeChild(label); // Lo mismo para la etiqueta label.
    container.removeChild(boton); // Lo mismno para el botón.
    container.removeChild(salto); // Lo mismo para el salto de linea.
    container.removeChild(salto2); // Lo mismo para el salto de linea.
    var counter = 0; // Declaro la variable counter y le asigno 0, usada para renombrar todos los elementos html.
    for (i = 0; i < index; i++) // Hago un bucle para cambiar los nombres y los id de los input, label, botón y salto de linea de los otros artículos y cantidades.
    {
        if (document.getElementById("article" + i)) // Si el artículo existe.
        {
            document.getElementById("article" + i).setAttribute("name", "article" + counter); // Cambio el nombre del input por Ej. article1 a article0.
            document.getElementById("qtty" + i).setAttribute("name", "qtty" + counter); // Lo mismo con la cantidad qtty1 a qtty0.
            document.getElementById("article" + i).setAttribute("id", "article" + counter); // Cambio el id del input por Ej. article1 a article0.
            document.getElementById("qtty" + i).setAttribute("id", "qtty" + counter); // Lo mismo con la cantidad qtty1 a qtty0.
            document.getElementById("label" + i).setAttribute("id", "label" + counter); // Cambio el id de la label por Ej. label1 a label0.
            document.getElementById(i).setAttribute("id", counter); // Lo mismo con el botón 1 a 0.
            document.getElementById("br" + i).setAttribute("id", "br" + counter); // Lo mismo con el salto de linea br1 a br0.
            document.getElementById("br0" + i).setAttribute("id", "br0" + counter); // Lo mismo con el salto de linea br01 a br00.
            counter++; // Incremento counter.
        }
        else // Si el artículo no está es el que se borró.
        {
            sortLocalStorage(i); // Llamo a la función sortLocalStorage y le paso el índice.
            articles.splice(which, 1); // Elimino el índice del array articles en la posición borrada.
            qtties.splice(which, 1); // Lo mismo para la cantidad, qtties en la posición borrada.
        }
    }
    index--; // Si se quita un artículo hay que decrementar el índice index.
    if (index == 0)
    {
        localStorage.clear(); // clear() Borra el contenido de localStorage.
    }
    showCar(false); // Llamo a la función showCar(false) pasándole false, ya que se está mostrando el carro, solo para refrescar la vista.
}

function sortLocalStorage(indice) // Esta función recibe el índice del artículo borrado.
{
    let store = []; // Declaro la varible store como un array.
    let size = localStorage.length; // Obtengo el tamaño de todos los artículos guardados en localStorage en la variable size.
    for (i = 0; i < size; i++) // Hago un buble al tamaño de localStorage.
    {
        store[i] = JSON.parse(localStorage.getItem("article" + i)); // Pongo todo el contenido de localStorage en el array store convertido a un objeto JSON.
    }
    store.splice(indice, 1); // hago un splice (borrado) del artículo en indice.
    localStorage.clear(); // Borro localStorage.
    for (i = 0; i < store.length; i++) // Hago un bucle al tamaño del array store.
    {
        localStorage.setItem('article' + i, JSON.stringify(store[i])); // Meto todos los datos del array store convertidos a string en localStorage.
    }
}

function showCar(bool) // Función para mostrar el carro de la compra, si recibe true hace click en el botón para mostrar el diálogo, si recibe false solo refresca la vista.
{
    if (index > 0) // Si se ha agregado algún artículo.
    {
        var btnopen = document.getElementById("car");
        var load = document.getElementById("load");
        load.innerHTML = ""; // Limpio la lista de artículos que están en la textarea dentro del diálogo
        for (i = 0; i < index; i++) // Bucle para recorrer todos los artículos agregados.
        {
            if (i == index - 1) // Si es el último artículo imprimo sin salto de línea al final.
            {
                if (articles[i] != "") // Si en articles[i] hay datos los muestra.
                load.innerHTML += articles[i] + ", " + qtties[i]; // Los muestra en la textarea.
            }
            else // Si no, imprimo un salto de línea al final.
            {
                if (articles[i] != "") // Si en articles[i] hay datos los muestra.
                load.innerHTML += articles[i] + ", " + qtties[i] + "\n"; // Los muestra en la textarea y hace un salto de linea.
            }
        }
        if (bool) // Si se pasa true a la función.
        {
            btnopen.click(); // Click en el botón para mostrar el diálogo, el diálogo está oculto, si el diálogo está a la vista se pasa false a la función, ya que si se hace click con el diálogo en pantalla el diálogo se oculta.
        }
    }
    else // Si no se agregó nada.
    {
        var btnopen = document.getElementById("add_dialog");
        var btnclose = document.getElementById("close_add_dialog");
        var addMessage = document.getElementById("add_message");
        addMessage.innerHTML = "Aun no has agregado nada al carro de la compra."; // Uso el diálogo para mostrar los artículos agregados al carro de la compra, para indicar que aun no se ha agregado nada.
        btnopen.click(); // Hago click en el botón para mostrar el diálogo.
        setTimeout(function() // Función que espera 2 segundos.
        {
            btnclose.click(); // Hago click en el botón que cierra el diálogo.
        }, 2000);
    }
}

function showCarrousel(path) // Función que muestra las imágenes de los eventos en los resultados de la busqueda
{
    var each = path.split("¡"); // Las rutas de las imágenes están separadas por el simbolo ¡ ya que es un caracter no admitido en la URL, se separan en el arrray each.
    var alertaCarousel = document.getElementById("alertaCarousel"); // ID del botón del diálogo que muestra las imágenens en un carrusel.
    var img1 = document.getElementById("img1"); // ID de la img1 en el dialogo
    var img2 = document.getElementById("img2");
    var img3 = document.getElementById("img3");

    switch (each.length) // Cambio a la cantidad de indices del array each.
    {
        case 1: // Si sola hay una imagen.
            img1.src = each[0]; // El source de la img1 es el contenido en el array each en el indice 0.
            break; // Salgo del Switch
        case 2: // Si el tamaño del array es 2 hay dos imágenes.
            img1.src = each[0]; // El source de la img1 es el contenido en el array each en el indice 0.
            img2.src = each[1]; // El source de la img2 es el contenido en el array each en el indice 1.
            break;
        default: // Por default es 3, el máximo de imágenes permitidas a subir para las empresas que publican sus eventos.
            img1.src = each[0];
            img2.src = each[1];
            img3.src = each[2];
            break;
    }
    alertaCarousel.click(); // Hace click en el botón con ID alertaCarousel.
}

function carToast(article) // Timer para mostrar mensajes por 3 segundos.
{
    var btnopen = document.getElementById("add_dialog");
    var btnclose = document.getElementById("close_add_dialog");
    var addMessage = document.getElementById("add_message");
    addMessage.innerHTML = "Has agregado: " + article + " al carro de la compra."; // Muestro mensajes en el diálogo para agregar artículos al carro.
    btnopen.click(); // Lo hago aparecer pulsando el botón con ID add_dialog.
    setTimeout(function() // La función para esperar 3 segundos.
    {
        btnclose.click(); // Después de 3 segundos se pulsa el botón para cerrar el diálogo.
    }, 3000);
}

function changeQtty() // Función para cambiar la cantidad de artículos deseados en la lista que se muestra en la textarea.
{
    let store = []; // Declaro la varible store como un array.
    for (i = 0; i < index; i++) // Bucle que recorre todos los artículos agregados al carro.
    {
        store[i] = JSON.parse(localStorage.getItem("article" + i)); // Pongo todo el contenido de localStorage convertido a un objeto JSON en el array store.
        qtties[i] = document.getElementById("qtty" + i).value; // pongo en el array qtties[i] el valor que se encuentra en el input con ID qtty0, qtty1, etc.
        store[i].qtty = qtties[i]; // Pongo el valor del array qtties[i] en el array store[i].qtty, ya que es un array de objetos, accedo al objeto qtty del array store con el . (punto) + qtty.
        localStorage.setItem('article' + i, JSON.stringify(store[i]));  // Meto los datos del array store en el índice i, convertidos a string en localStorage en el item article + i.
    }
    showCar(false); // Llama a la función para mostrar el carro de la compra y le pasa false para que no se haga click en el botón para mostrar el diálogo ya que el diálogo está a la vista.
}

function checkFiles(files) // Función que verifica la cantidad de fotos que se subieron para un evento, máximo 3, recibe el array files, el nombre del input.
{
    if(files.length > 3) // Si la cantidad de archivos agregados es mayor que 3.
    {
        toast(1, "Se ha Superado el Limite", "Has Selecionado Archivos de Más; Se Limitará la Subida Automáticamente a 3 fotos Ordenadas por Nombre o por Número Ascendentemente.");
        // Muestro un diálogo que solo se aceptarán 3 fotos y serán las tres primeras por orden alfabetico o numérico, ascendente.
        let list = new DataTransfer; // Creo una lista nueva del tipo DataTransfer.
        for(let i = 0; i < 3; i++) // Hago un bucle de 0 a 2.
           list.items.add(files[i])  // Agrego a la lista los 3 primeros archivos subidos.

        document.getElementById('files').files = list.files // Pongo en el input type file, que tiene la ID files, la lista con los tres archivos.
    }       
}

function screenSize() // Función para dar el tamaño máximo de la pantalla a las vistas.
{
    var page_top = document.getElementById("page_top"); // Asigno a variables las distintas vistas de la página.
    var page_event = document.getElementById("page_event");
    var view1 = document.getElementById("view1");
    var view2 = document.getElementById("view2");
    var view3 = document.getElementById("view3");
    let screen = window.innerHeight; // Obtiene el tamaño vertical de la pantalla.
    var body = document.body, html2 = document.documentElement; // Asigno a la variable body el body y a html2 el contenido.
    var height = Math.max(body.scrollHeight, body.offsetHeight, html2.clientHeight, html2.scrollHeight, html2.offsetHeight); // Asigno a la variable height el valor máximo de la pantalla con todo el contenido.

    if (page_top.offsetHeight <= screen) // Si el tamaño vertical de la vista es menor que el tamaño vertical de la pantalla.
    {
        views(page_top, screen, height);

        if (page_event != null) // Si existe el div view2
        {
            views(page_event, screen, height);
            if (view1 != null)
            {
                views(view1, screen, height);
                if (view2 != null)
                {
                    views(view2, screen, height);
                    if (view3 != null)
                    {
                        views(view3, screen, height);
                    }
                }
                
            }
        }
    }
}

function views(view, size, bigsize)
{
    if (view <= size)
    {
        if (view == view3)
        {
            view.style.height = size - 160 + "px";
        }
        else
        {
            view.style.height = size + "px";
        }
    }
    else
    {
        view.style.height = bigsize - 80 + "px";
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

// function checkTitle() // Fnción de los scripts de PHP carro y register para ocultar el botón del carro de la compra.
// {
//     var car_button = document.getElementById("car_button");
//     if (document.title != "Ticket.es - Entrada de Espectador") // Verifico si no estoy en la página login.php.
//     {
//         car_button.style.visibility = "hidden"; // Si no oculto el botón del carro de la compra.
//     }
// }

function QRGen(index) // Función para generar el código QR, directamente desde una API de google, (seguramente durará muy poco), recibe el numero de entradas compradas, del script checkout.php.
{
    var code = []; // Array que contendrá las rutas con los datos por GET, que se codificarán.
    var qr = []; // Array que tendrá las distintas rutas de los QR.
    var finalURL = []; // Array que contendrá las rutas con los datos por GET de los códigos más la ruta a la API de Google para crear los QR.
    for (i = 0; i < index; i++) // Hago un bucle al número de entradas.
    {
        code[i] = document.getElementById("code" + i); // Obtengo la ID del <input> oculto que contiene la url con los datos de las entradas compradas, lo asigno al array code[i].
        qr[i] = document.getElementById("here" + i); // Obtengo las ID de los input que contendrán la URL completa del código QR.
        
        finalURL[i] ='https://chart.googleapis.com/chart?cht=qr&chl=' + code[i].value + '&chs=160x160&chld=L|0'; // Se lo paso a Google y asigno el resultado a la variable finalURL.
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
                html += "<td>" + kind[i] + "</td><td>" + title[i] + "</td><td>" + qtties[i] + "</td><td>" + payed[i] + " €</td><td>" + date[i] + "</td><td>" + start[i] + " " + hour[i] + "Hs." + "</td><td><a href='" + ruta[i] + "' target='_blank'>Descarga tu QR</a></td></tr><tr>";
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