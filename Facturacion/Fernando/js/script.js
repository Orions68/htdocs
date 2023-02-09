function printIt(form, number)
{
    window ["prtContent" + number] = document.getElementById("printable" + number);
	var WinPrint = window.open('', '', '');
	WinPrint.document.write('<html><head><title>Print Invoice</title>');
	WinPrint.document.write('<link rel="stylesheet" type="text/css" href="css/style.css" />');
	WinPrint.document.write('</head><body>');
    WinPrint.document.write(eval("prtContent" + number).innerHTML);
    WinPrint.document.write('</body></html>');
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
    if (form != null)
    {
	    form.submit();
    }
}

function prices(howmany)
{
    let container = document.getElementById("prices");
    container.innerHTML = "";

    for (i = 0; i < howmany; i++)
    {
        window ["input" + i] = document.createElement("input");
        window ["br" + i] = document.createElement("br");
        window ["br2" + i] = document.createElement("br");
        window ["br3" + i] = document.createElement("br");
        window ["br4" + i] = document.createElement("br");
        window ["input2" + i] = document.createElement("input");
        window ["label" + i] = document.createElement("label");
        window ["label2" + i] = document.createElement("label");

        eval("label" + i).innerHTML = " Nombre del Repuesto";
        eval("label2" + i).innerHTML = " Precio del Repuesto";
        eval("input" + i).type = "text";
        eval("input" + i).name = "material" + i;
        eval("input2" + i).type = "number";
        eval("input2" + i).name = "price" + i;
        eval("input2" + i).step = ".05";

        container.appendChild(eval("input" + i));
        container.appendChild(eval("label" + i));
        container.appendChild(eval("br" + i));
        container.appendChild(eval("br2" + i));
        container.appendChild(eval("input2" + i));
        container.appendChild(eval("label2" + i));
        container.appendChild(eval("br3" + i));
        container.appendChild(eval("br4" + i));
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
                ph.value = "";
                button.value = "Llámame!";
                break;
            case "Whatsapp":
                email.style.visibility = "hidden";
                phone.style.visibility = "visible";
                em.required = false;
                ph.required = true;
                ph.value = "";
                button.value = "Envíame un Watsapp";
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

function connect(how) // Función para enviar un Whatsapp a la tienda, para que se ponga en contacto con el cliente, recibe la forma de comunicación, Teléfono o E-mail.
{
    let mssg = document.getElementById('mssg').value;
    let num = +34680579175;
    console.log("La forma de contacto es: " + how);
    if (how == "E-mail") // Esto es solo para que aparezca cpntactame a en lugar de al.
    {
        var win = window.open(`https://wa.me/${num}?text=Por Favor contactame por: ${how} a: ${mssg} Mi nombre es: `, '_blank');
    }
    else
    {
        var win = window.open('https://wa.me/' + num + '?text=Por Favor contactame por: ' + how + ' al: ' + mssg + ' Mi nombre es: ', '_blank');
    }
}