// function showImg(src) // Not in Use but a Good One
// {
//     var alertaImg = document.getElementById("alertaImg"); // La ID del botón del dialogo.
//     var img = document.getElementById("show_pic"); // Asigno a la variable title el h4 con id title.
        
//     img.src = src; // Muestro los mensajes en el diálogo.
//     alertaImg.click(); // Lo hago aparecer pulsando el botón con ID alerta.
// }
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
    var container = document.getElementById("container"); // Container contiene la ID del div con ID container, donde se crea dinamicamente el contenido del formulario con todas las entradas compradas.

    var input = document.createElement("input"); // Asigno a la variable input la creación de un input.
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