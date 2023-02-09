<?php
$ok = false; // Variable usada para verificar si hay datos o no.
$i = 0; // Índice de los Detalles de los eventos
$k = 0; // Índice de los Eventos.
$kinds = []; // Arrays para contener los valores de los eventos a mostrar.
$event = [];
$desc = [];
$path = [];
$id = [];
$where = [];
$price = [];
$start = [];
$end = [];
$hour = [];
$places = [];
$sold = [];

function fromIndex($conn) // Esta función se llama desde index.php y recibe la conexión con la base de datos.
{
    global $ok, $kinds, $event, $path, $places, $sold; // Declaro globales las variables que necesito en la función.
    lookEvents($conn, "", ""); // Llamo a la función lookEvents(), pasándole la conexión y dos valores vacios, ya que también se usa para buscar por tipo de evento y por localidad.
    if ($ok) // Si lo que pasa en la función lookEvents() pone la variable global $ok a true;
    {
        $size = count($event); // Asigno a la variable $size el tamaño del array $event.
        $left = []; // Declaro un array $left, que contendrá las entradas que quedan por vender.
        $ruta = []; // Declaro un array ruta, para las rutas de las imágenes de los eventos.
        for ($i = 0; $i < $size; $i++) // Hago un bucle al tamaño de los datos guardados, calculo las entradas restantes y separo las rutas a las imágenes.
        {
            $left[$i] = $places[$i] - $sold[$i]; // Calculo la diferencia entre el aforo y las entradas vendidas y lo guardo en el array $left[$i].
            $ruta[$i] = []; // Al array $ruta le asigo un array(es un array bidimensional).
            $ruta[$i] = explode("¡", $path[$i]); // Hago un explode de las rutas en $path[$i] separadas por el caracter ¡ y las voy almacenando en el array ruta[$i][0], ruta[$i][1], ruta[$i][2].
        }
        if ($size > 6) // Si hay más resultados que 6.
        {
            $size = 6; // Solo voy a mostrar 6.
        }
        echo "<div class='row'>"; // Pongo en pantalla un elemento div de la clase row de Bootstrap.
        if ($size < 4) // Verifico si la cantidad de datos a mostrar es menor que 4.
        {
            for ($i = 0; $i < $size; $i++) // Si es así, hago un bucle a la cantidad de datos a mostrar - 1, $size puede valer desde 1 a 3, $i va de 0 a 2.
            {
                if ($left[$i] > 0) // Verifico si aun hay entradas del evento en el que estoy.
                {
                    echo "<div class='col-md-4'>
                    <a href='event.php?kind=" . $kinds[$i] . "'><img src='" . $ruta[$i][0] . "' alt='" . $event[$i] . "' class='mysize'>
                    <br>"; // Pongo en pantalla un div con la clase col de Bootstrap(4 columnas), y un enlace a la página event.php pasándole por GET el tipo de evento del que se trata, con la primera imagen del evento.
                    echo "<small class='btn btn-info' role='button'>Cuando y Donde es el Evento</small></a>"; // Pongo en pantalla un elemento small con una leyenda y cierro el enlace y el div.
                    leftEntrances($left[$i]); // Llamo a la función leftEntrances() pasándole la cantidad de entradas que quedan y verifico si en algún evento quedan menos de 10 entradas.
                    echo "</div>"; // Si hay entradas se muestra el evento en pantalla, si $left[$i] fuera menor o igual a 0 no se muestra el evento.
                }
            }
            echo "</div>"; // Cierro el div de la fila de Bootstrap.
        }
        else // Si $size es mayor que 3, hay más de 3 eventos para mostrar.
        {
            for ($i = 0; $i < 3; $i++) // Hago un bucle de 0 a 2, aquí muestro los primeros 3.
            {
                if ($left[$i] > 0)
                {
                    echo "<div class='col-md-4'>
                    <a href='event.php?kind=" . $kinds[$i] . "'><img src='" . $ruta[$i][0] . "' alt='" . $event[$i] . "' class='mysize'>
                    <br>"; // Pongo en pantalla un div con la clase col de Bootstrap(4 columnas), y un enlace a la página event.php pasándole por GET el tipo de evento del que se trata, con la primera imagen del evento.
                    echo "<small class='btn btn-info' role='button'>Cuando y Donde es el Evento</small></a>"; // Pongo en pantalla un elemento small con una leyenda y cierro el enlace y el div.
                    leftEntrances($left[$i]); // Llamo a la función leftEntrances() pasándole la cantidad de entradas que quedan y verifico si en algún evento quedan menos de 10 entradas.
                    echo "</div>";
                }
            }
            echo "</div>"; // Cierro el div de la fila de Bootstrap.
            echo "<div class='row' style='height: 20px;'></div>"; // Abro una fila de Bootstrap intermedia para separar los resultados, 20 pixels de espacio vertical.
            echo "<div class='row'>"; // Abro una segunda fila de Bootstrap.
            for ($i = 3; $i < $size; $i++) // Hago un bucle desde 3 a la cantidad de eventos -1, contenidos en la variable $size.
            {
                if ($left[$i] > 0)
                {
                    echo "<div class='col-md-4'>
                    <a href='event.php?kind=" . $kinds[$i] . "'><img src='" . $ruta[$i][0] . "' alt='" . $event[$i] . "' class='mysize'>
                    <br>"; // Pongo en pantalla un div con la clase col de Bootstrap(4 columnas), y un enlace a la página event.php pasándole por GET el tipo de evento del que se trata, con la primera imagen del evento.
                    echo "<small class='btn btn-info' role='button'>Cuando y Donde es el Evento</small></a>"; // Pongo en pantalla un elemento small con una leyenda y cierro el enlace y el div.
                    leftEntrances($left[$i]); // Llamo a la función leftEntrances() pasándole la cantidad de entradas que quedan y verifico si en algún evento quedan menos de 10 entradas.
                    echo "</div>";
                }
            }
            echo "</div>"; // Cierro el div de la segunda fila de Bootstrap.
        }
    }
    else // Si no hubo resultados.
    {
        echo "<script>toast(1, 'Nada Para esa fecha', 'Aun No Hay Eventos Publicados.');</script>"; // Aun no hay eventos.
    }
}

function fromEvents($conn, $tipo, $lugar) // Esta función se llama desde el script event.php.
{
    lookEvents($conn, $tipo, $lugar); // Llamo a la función lookEvents(), pasándole la conexión, el tipo de evento y el lugar, para buscar por tipo de evento y por localidad.
}

function lookEvents($conn, $tipo, $lugar) // Esta función hace la consulta a la base de datos.
{
    global $ok, $i, $k, $kinds, $event, $desc, $path, $id, $where, $price, $start, $end, $hour, $places, $sold; // Hago globales todas las variables que necesita la función.
    if ($tipo == "") // Verifico si la variable $tipo está vacía
    {
        $sql = "SELECT * FROM details GROUP BY kind"; // Si $tipo está vacía, consulto a la base de datos todos los resultados agrupados por tipo de evento, se llamó desde index.php.
    }
    else // Si la variable $tipo tiene algo.
    {
        $sql = "CALL Busqueda_X_Lugar('$lugar', '$tipo')"; // Uso un Procedure que me devuelve las localidades de los eventos, se llamó desde event.php.
    }
    $stmt = $conn->prepare($sql); // Hago la conexión a la base de datos.
    $stmt->execute(); // La ejecuto.
    if ($stmt->rowCount() > 0) // Si hay resultados.
    {
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) // Cargo en la variable $row todos los campos del resultado de la consulta.
        {
            if ($sql == "SELECT * FROM details GROUP BY kind") // Si la consulta fue SELECT *, llamada desde index.php.
            {
                $kinds[$i] = $row->kind; // Asigno al array $kinds[$i] la fila $row->kind, que contiene los tipos de eventos de los que se trata.
            }
            $event[$i] = $row->title; // Los cargo en arrays.
            $desc[$i] = $row->description;
            $path[$i] = $row->path;
            $id[$i] = $row->id_event;
            $i++; // Incremento el indice $i.
        }

        for ($j = 0; $j < $i; $j++) // Hago un bucle a la cantidad de datos encontrados(el indice $i).
        {
            $sql = "SELECT * FROM events WHERE id = '$id[$j]'"; // Preparo una consulta a la tabla events de los eventos encontrados en la tabla details.
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) // Si hay resultados.
            {
                while ($row = $stmt->fetch(PDO::FETCH_OBJ))
                {
                    $id[$k] = $row->id;
                    $where[$k] = $row->place; // Los cargo en arrays.
                    $price[$k] = $row->price;
                    $start[$k] = $row->start; // Asigno la fecha de inicio del evento a la variable array $start[$k].
                    $my_start = explode("-", $start[$k]); // En la variable $my_start hago un explode de la string en $start[$k] por el signo de separación de las fechas "-".
                    $start[$k] = $my_start[2] . "/" . $my_start[1] . "/" . $my_start[0]; // Vuelvo a asignar a la variable $start[$k] los valores del array $my_start invertidos y separados por "/".
                    $end[$k] = $row->end;
                    $my_end = explode("-", $end[$k]);
                    $end[$k] = $my_end[2] . "/" . $my_end[1] . "/" . $my_end[0];
                    $hour[$k] = $row->hour;
                    $places[$k] = $row->places;
                    $sold[$k] = $row->sold;
                    $k++;
                }
            }
        }
        $ok = true; // Pongo $ok a true.
    }
    else // Si no se encotnró ningún resultado en la base de datos.
    {
        $ok = false; // Pongo $ok a false.
    }
}

function leftEntrances($left) // Muestra cuantas entradas quedan, recibe la cantidad de entradas que quedan.
{
    if ($left < 10) // Si quedan menos de 10
    {
        echo "<div style='margin-left: 14px;
        position: relative;
        margin-top: -200px;
        width: 140px;
        height: 140px;
        line-height: 140px;
        border-radius: 50%;
        font-size: 10px;
        color: #fff;
        text-align: center;
        background: red !important;'>"; // Muestro un círculo rojo avisando que quedan pocas entradas.
        echo " SOLO QUEDAN " . $left . " ENTRADAS </div>"; // Si quedan de 9 a 1 muestro la cantidad que quedan.
    }
}
?>