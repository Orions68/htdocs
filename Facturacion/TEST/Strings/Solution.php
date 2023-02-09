<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How Much Moves</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css" integrity="sha512-CpIKUSyh9QX2+zSdfGP+eWLx23C8Dj9/XmHjZY2uDtfkdLGo0uY12jgcnkX9vXOgYajEKb/jiw67EYm+kBf+6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        label, input
        {
            font-size: 1.2rem; /* Agrando las fuetes de las label, los input y los enlaces a 1.3 rem. */
        }
    </style>
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/js/bootstrap.min.js" integrity="sha512-5BqtYqlWfJemW5+v+TZUs22uigI8tXeVah5S/1Z6qBLVO7gakAOtkOzUtgq6dsIo5c0NJdmGPs0H9I+2OHUHVQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
<!-- Modal Button, Diálogo general, muestra distintos mensajes y se queda en el script en el que está. -->
<button id="alerta" type="button" class="btn btn-primary" style="visibility: hidden;" data-bs-toggle="modal" data-bs-target="#alertDialog">Diálogo</button>

<!-- Modal -->
<div class="modal fade" id="alertDialog" tabindex="-1" aria-labelledby="alertDialogLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="alertDialogLabel">Dialogo de Avisos</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <h4><span id="title"></span></h4>
          <h5 id="message"></h5>
      </div>
      <div class="modal-footer">
      <button type="button" id="close_dialog" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
  </div>
  </div>
</div>
<br>
<section class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-1" style="width: 2%;"></div>
            <div class="col-md-5">
                <br><br>
                <h1>Primer Desafio</h1>
                <h3>Escribe la Cadena a Cambiar y Debajo el Caracter a Conseguir</h3>
                <br>
                <form action="" method="post">
                    <label><input id="text1" type="text" name="text" maxlength="100000" onkeyup="verify(this.id)" required> Escribe el Texto a Modificar (Entre a y z)</label>
                    <br><br>
                    <label><input id="key1" type="text" name="key" maxlength="1" onkeyup="verify(this.id)" required> Escribe la Clave a Conseguir (Solo 1 Caracter Entre a y z)</label>
                    <br><br>
                    <input type="submit" class="btn btn-primary" value="A Jugar!">
                </form>
            </div>
            <div class="col-md-5">
            <br><br>
                <h1>Segundo Desafio</h1>
                <h3>Escribe la Cadena a Cambiar y Debajo la Cadena a Conseguir</h3>
                <br>
                <form action="" method="post">
                    <label><input id="text2" type="text" name="text" maxlength="100000" onkeyup="verify(this.id)" required> Escribe el Texto a Modificar (Entre a y z)</label>
                    <br><br>
                    <label><input id="key2" type="text" name="key" maxlength="26" onkeyup="verify(this.id)" required> Escribe la Clave a Conseguir (Entre a y z)</label>
                    <br><br>
                    <input type="submit" class="btn btn-primary" value="A Jugar!">
                </form>
            </div>
        <div class="col-md-1" style="width: 2%;"></div>
    </div>
    <br><br>
    <h3>Usa Las Flechas Para Cambiar Las Letras</h3>
    <br><br>
    <div class="row">
    <div class="col-md-1" style="width: 2%;"></div>
    <div class="col-md-10">
    <?php
    if (isset($_POST["text"])) // Cuando se hace click en el botón A Jugar!, enví apor post text y key.
    {
        $text = $_POST["text"]; // Asigno la cadena a la variable $text;
        $key = $_POST["key"]; // Asigno la clave a la variable $key.
        echo "<script>var length = " . strlen($text) . ";</script>"; // Asigno a la variable de javascript length el tamaño de la cadena.
        for ($i = 0; $i < strlen($text); $i++) // Hago un bucle hasta el tamaño de la cadena
        {
            echo "<img id='up" . $i . "' src='https://ticket-es.000webhostapp.com/img/up.png' width='48px' alt='Flecha Arriba:" . $i . "' onclick='letterUp(this.id, length)' style='cursor: pointer;'>"; // Creo tantos flechas hacia arriba como letras tiene la cadena
        }
        echo "<br>";
        for ($i = 0; $i < strlen($text); $i++)
        {
            echo '<input id="' . $i . '" type="text" value="' . $text[$i] . '" style="width: 48px; text-align: center;">'; // Creo tantos input como letras tiene la cadena.
        }
        echo "<br>";
        for ($i = 0; $i < strlen($text); $i++)
        {
            echo "<img id='do" . $i . "' src='https://ticket-es.000webhostapp.com/img/down.png' width='48px' alt='Flecha Abajo:" . $i . "' onclick='letterDown(this.id, length)' style='cursor: pointer;'>"; // Creo tantas flechas hacia abajo como letras tiene la cadena.
        }
        echo "<br>";
        echo "<h1>Conseguir:</h1>";
        echo "<h2 id='result'>" . $key . "</h2>"; // Pongo en el H2 la clave a conseguir.
        echo "<h3 id='moves' style='color: blue;'></h3>";
        echo "<script>
        var array = []; // Este array contiene en las posiciones de cada letra un 1 si ya se consiguió la clave y un 0 mientras no se consiga.
        var moves = 0; // Movimientos por cada letra para cada clave.
        var min_moves = 0; // Movimientos mínimos necesarios.
        var coincidence = 0; // Coincidencias de entrada, de la Clave con la Palabra.
        var distance = 0; // Variable para saber a cuantos cambios está una letra de la de la clave.
        function coincidences() // Esta función verifica antes de empezar cuantas coincidencias hay entre las letras de la Palabra y la Clave.
        {
            let result = document.getElementById('result'); // Asigno a la variable result el elemento H2 con ID result.
            if (result.innerHTML.length == 1) // Si el tamaño del contenido de result es 1.
            {
                for (i = 0; i < " . strlen($text) . "; i++) // Hago un bucle al tamaño de la palabra.
                {
                    array[i] = 0; // Asigno 0 al primer contenido del array.
                    let input = document.getElementById(i); // Asigno a la variable input el elemento con ID 0, 1, 2, etc.
                    if (input.value == result.innerHTML) // Verifico si el contenido en el input es igual a la letra en result.
                    {
                        array[i] = 1; // Asigno un uno al array en el índice de la coincidencia.
                        coincidence++; // incremento en 1 la variable coincidence.
                    }
                }
            }
            else // Si el tamaño en result es mayor que 1.
            {
                for (i = 0; i < " . strlen($text) . "; i++)
                {
                    array[i] = 0;
                    let input = document.getElementById(i); // Asigno a la variable input el elemento con ID 0, 1, 2, etc.
                    for (j = 0; j < result.innerHTML.length; j++) // Este bucle compara todas las letras en la clave con la letra en la cadena.
                    {
                        if (input.value == result.innerHTML[j]) // Verfico si la letra es igual al contenido de cualquiera de las letras en result (la clave).
                        {
                            array[i] = 1;
                            coincidence++;
                        }
                    }
                }
            }
        }
        coincidences(); // Llama a la función coincidences();

        function howMuchMoves() // Esta función verifica cuanto movimientos serán necesarios para conseguir el desafio.
        {
            let result = document.getElementById('result'); // Asigno a result el elemento h2 con ID result.
            let key = result.innerHTML; // Asigno a key el contenido de result.
            let lesser = [];
            for (i = 0; i < " . strlen($text) . "; i++) // Hago un bucle al tamaño de la casdena.
            {
                let letter = document.getElementById(i); // Asigno a input las ID de todos los input que contienen las letras de la cadena a transformar.
                if (key.length > 1) // Si el tamaño de la llave es mayor que 1, es el segundo desafio.
                {
                    for (j = 0; j < key.length; j++)
                    {
                        if (key.charCodeAt(j) > letter.value.charCodeAt(0)) // Verifico si el valor numérico del caracter en la llave key en la posición i es mayor que el valor numérico de la letra.
                        {
                            distance = key.charCodeAt(j) - letter.value.charCodeAt(0); // Asigno a la varible distance la resta del valor de la letra al valor de la llave key.
                            if (distance <= 13) // Si la resta da 13 o menos.
                            {
                                moves = distance; // Adiciono a la variable moves la distancia a recorrer.
                            }
                            else // Si la distancia es mayor que 13.
                            {
                                moves = 26 - distance; // Adiciono a la variable moves la cantidsad de letras(26) menos la distancia.
                            }
                        }
                        else // Si el valor de la letra es mayor que el de la clave key, hago alrevés.
                        {
                            distance = letter.value.charCodeAt(0) - key.charCodeAt(j);
                            if (distance <= 13)
                            {
                                moves = distance;
                            }
                            else
                            {
                                moves = 26 - distance;
                            }
                        }
                        lesser[j] = moves;
                    }
                    min_moves += Math.min(...lesser);
                }
                else // Si el tamaño de key es 1, es el primer desafio.
                {
                    if (key.charCodeAt(0) > letter.value.charCodeAt(0)) // Comparo el valor numérico de la letra en key con el valor numérico de la letra.
                    {
                        distance = key.charCodeAt(0) - letter.value.charCodeAt(0);
                        if (distance <= 13)
                        {
                            min_moves += distance;
                        }
                        else
                        {
                            min_moves += 26 - distance;
                        }
                    }
                    else
                    {
                        distance = letter.value.charCodeAt(0) - key.charCodeAt(0);
                        if (distance <= 13)
                        {
                            min_moves += distance;
                        }
                        else
                        {
                            min_moves += 26 - distance;
                        }
                    }
                }
            }
            let show = document.getElementById('moves'); // Asigno a la variable show el elemento H3 con ID moves.
            show.innerHTML =  'Necesitas: ' + min_moves + ' Movimientos Exactos.'; // Muestro las movidas necesarias para resolver el desafio.
        }
        howMuchMoves(); // Llamo a la función howMuchMoves()
        </script>";
    }
    ?>
    </div>
    <div class="col-md-1" style="width: 2%;"></div>
    </div>
</section>
<script>
var counter = 0; // Asigno 0 a la variable counter, se usa para contar la cantidad de cambios necesarios para obtener la clave.
var already = false; // Asigno false a la variable already, se usa para verificar las coinicidencias de las letras de la cadena con las de la clave, se hace solo una vez por cada juego.

function letterUp(id, length) // Función llamada cuando se presiona la flecha hacia arriba, recibe la id de la fecha y el tamaño de la cadena.
{
    let index = -1; // Asigno a la variable index un -1.
    index = getIndex(id); // Asigno a index el retorno de la función getIndex() y le paso la ID de la flecha usada.
    let result = document.getElementById("result"); // Asigno a result el elemento H3 que contiene la clave a igualar.
    counter++; // Se incrementa el contador, cada vez que se presiona una de las flechas hacia arriba o hacia abajo.
    let letter = document.getElementById(index); // Asigno a letter la ID del input que contiene la letra de la flecha usada.
    var which = letter.value; // Asigno a la variable which el valor en el input, la letra.
    if (array[index] == 1) // Verfico si en el array en la posición en que estoy hay un 1.
    {
        toast("1", "Locked", "Esa Clave ya Está Resuelta, Intenta Desbloquear las Demás, Gracias"); // Muestro un mensaje que ya se resolvió la clave.
        return; // Salgo de la función.
    }
    if (which.charCodeAt(0) == 122) // Verifico si el caracter en el input es la z(ASCII = 122).
    {
        letter.value = String.fromCharCode(97); // Si es la z pongo la a(ASCII = 97).
    }
    else // Si no es la z.
    {
        letter.value = String.fromCharCode(which.charCodeAt(0) + 1); // Pongo en el input la letra siguiente, incrementando el valor numérico de la letra en 1.
    }
    if (result.innerHTML.length > 1) // Si el contenido del H2, donde está la clave es mayor que 1.
    {
        for (i = 0; i < result.innerHTML.length; i++)
        {
            if (result.innerHTML[i] == letter.value) // Si el contenido en el elemento result en la ID del input que será la posición de la letra en la clave es igual a la letra que acaba de cambiar.
            {
                check(index, length); // Llamo a la función check y le paso el tamaño de la cadena.
            }
        }
    }
    else // Si el contenido en result es solo un caracter.
    {
        if (result.innerHTML == letter.value) // Si el caracter en result es igual a la letra que acaba de cambiar.
        {
            check(index, length); // Llamo a la función check y le paso el tamaño de la cadena.
        }
    }
}

function letterDown(id, length) // La función letterDown es llamada cuando se preciona una flecha hacia abajo, recibe la id y el tamaño de la cadena.
{
    let index = -1; // Asigno a la variable index un -1.
    index = getIndex(id); // Asigno a index el retorno de la función getIndex() y le paso la ID de la flecha usada.
    let result = document.getElementById("result"); // Asugno a result el elemento con ID result, el H2 donde está la clave.
    counter++; // Se incrementa el contador, cada vez que se presiona una de las flechas hacia arriba o hacia abajo.
    let letter = document.getElementById(index); // Asigno a letter la ID del input que contiene la letra de la flecha usada.
    var which = letter.value; // Asigno a la variable which el valor en el input, la letra.
    if (array[index] == 1) // Verfico si en el array en la posición en que estoy hay un 1.
    {
        toast("1", "Locked", "Esa Clave ya Está Resuelta, Intenta Desbloquear las Demás, Gracias"); // Muestro un mensaje que ya se resolvió la clave.
        return; // Salgo de la función.
    }
    if (which.charCodeAt(0) == 97) // Verifico si el caracter en el input es la a(ASCII = 97).
    {
        letter.value = String.fromCharCode(122); // Si es la a pongo la z(ASCII = 122).
    }
    else // Si no es la a.
    {
        letter.value = String.fromCharCode(which.charCodeAt(0) - 1); // Pongo en el input la letra anterior descontando 1 al valor numérico de la letra que estaba.
    }
    if (result.innerHTML.length > 1) // Si el contenido del H2, donde está la clave es mayor que 1.
    {
        for (i = 0; i < result.innerHTML.length; i++)
        {
            if (result.innerHTML[i] == letter.value) // Si el contenido en el elemento result en la ID del input que será la posición de la letra en la clave es igual a la letra que acaba de cambiar.
            {
                check(index, length); // Llamo a la función check y le paso el tamaño de la cadena.
            }
        }
    }
    else // Si el contenido en result es solo un caracter.
    {
        if (result.innerHTML == letter.value) // Si el caracter en result es igual a la letra que acaba de cambiar.
        {
            check(index, length); // Llamo a la función check y le paso el tamaño de la cadena.
        }
    }
}

function getIndex(id) // La función getIndex asigna el índice adecuado según el tamaño de la cadena ingresada, recibe la ID de los input de las flechas: up0, up1, up2 o do0, do1, do2, etc.
{
    let index = -1; // Asigno a la variable index -1.
    if (id.length == 3) // Verifco si el tamaño de la ID es 3.
    {
        // index = id[id.length - 1]; // Asigno a index el último caracter de la cadena de la ID.
        index = id.slice(-1);
    }
    else if (id.length == 4)
    {
        index = id.slice(-2); // Asigno a index los dos últimos caracteres de la cadena de la ID.
    }
    else if (id.length == 5)
    {
        index = id.slice(-3); // Asigno a index los 3 últimos caracteres de la cadena de la ID.
    }
    else if (id.length == 6)
    {
        index = id.slice(-4); // Asigno a index los 4 últimos caracteres de la cadena de la ID.
    }
    else if (id.length == 7)
    {
        index = id.slice(-5); // Asigno a index los 5 últimos caracteres de la cadena de la ID.
    }
    return index; // Retorna el valor numérico del índice.
}

function verify(id) // La función verify recibe la ID, comprueba si se están escribiendo las letras admitidas, de la a a la z en minúsculas.
{
    let letter = document.getElementById(id); // Asigno a la variable letter la ID del input donde se está escribiendo la cadena.
    let word = letter.value; // Asigno a word el contenido del input.
    let length = word.length; // Obtengo el tamaño de la cadena en la variable length.
    for (i = 0; i < length; i++) // Hago un bucle al tamaño de la cadena.
    {
        if (word.charCodeAt(i) < 97 || word.charCodeAt(i) > 122) // Si el carácter ingresado es menor que la letra a o es mayor que la z.
        {
            letter.value = letter.value.slice(0, -1); // Lo elimino del input.
            toast("2", "ERROR", "Solo puedes escribir letras entre la a y la z, asegurate de que no tienes activadas las mayusculas. Gracias"); // Muestro un mensaje que no es un carácter admitido.
        }
    }
}

function check(index, length) // La función check recibe el tamaño de la cadena y el indice de la letra, verifica si ya se hallaron todas las coincidencias y muestra en cuantos movimientos se consiguió.
{
    array[index] = 1;
    coincidence++; // Incrementa la variable coincidence
    if (coincidence == length) // Compruebo si coincidence es del mismo tamaño que el tamaño de la cadena.
    {
        if (counter == min_moves)
        {
            toast("0", "YOU WIN!" ,"Ganaste, Usaste Los Movimientos Exactos Para Terminar."); // Muestro el mensaje que has terminado con los cambios justos.
        }
        else
        {
            toast("1", "YOU WIN! BUT" ,"Usaste: " + counter + " de " + min_moves + " Movimientos Para Terminar, Podrías Hacerlo Mejor."); // Muestro el mensaje que has terminado y cuantos cambios hiciste.
        }
        counter = 0; // Pongo las variables a 0.
        coincidence = 0;
        min_moves = 0;
        distance = 0;
        already = false;
        for (i = 0; i < length; i++)
        {
            array[i] = 0;
        }
        coincidences();
        howMuchMoves();
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
</script>
</body>
</html>