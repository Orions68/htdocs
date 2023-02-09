function screenSize() // Asigna los tamaños a las vistas según el contenido.
{
    let view1 = document.getElementById("view1"); // view1 es la ID del div view1.
    let view2 = document.getElementById("view2");
    let view3 = document.getElementById("view3");
    let size = document.getElementById("size");
    let height = window.innerHeight; // window.innerHeight es el tamaño vertical de la pantalla.
    size.innerHTML = view1.offsetHeight; // view1.offsetHeight es el tamaño vertical del contenido del div view1.

    if (view1.offsetHeight < height) // Si el tamaño vertical de la vista es menor que el tamaño vertical de la pantalla.
    {
        view1.style.height = height + "px"; // Asigna a la vista el tamaño vertical de la pantalla.
    }

    if (view2 != null) // Si existe el div view2
    {
        if (view2.offsetHeight < height)
        {
            view2.style.height = height + "px";
        }
        if (view3 != null)
        {
            if (view3.offsetHeight < height)
            {
                view3.style.height = height + "px";
            }
            
        }
    }
}

function showSize(view) // Esta función recibe la vista
{
    size.innerHTML = view.offsetHeight; // Muestra el tamaño vertical de la vista en el botón con ID size.
    view.scrollIntoView(); // Hace scroll a la vista.
}

function screen() // Esta función comprueba si el ancho de la pantalla es de Ordenador o de Teléfono.
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

function goThere() // Cuando cambia el selector del menú para Teléfono.
{
    var change = document.getElementById("change").value; // Change obtiene el valor en el selector.
    var element = document.getElementById(change); // Element obtiene la ID de la vista
    element.scrollIntoView(); // Hace scroll a la vista seleccionada.
}